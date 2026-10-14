<?php
/**
 * Read-only access to the shipment database.
 *
 * The back-office Laravel application (Projects/kasabazaar) owns this database and is
 * the only thing that writes to it. This site reads a deliberately narrow slice of it so
 * tracking.php can answer "where is my shipment?" directly, instead of handing the
 * visitor off to another site.
 *
 * Rules for anything added here:
 *   - SELECT only. Never write. The credentials in includes/db-config.php should not
 *     even be able to.
 *   - Expose only what a person holding a tracking number is entitled to see: the
 *     reference, the status, the branch names and the dates — plus, only when the
 *     lookup was by the random tracking number (not the sequential, guessable
 *     shipping reference), item names and masked receiver names via
 *     kr_shipment_items(). No client records, no addresses, no phone numbers, no
 *     costs, no payment state.
 *   - Fail soft. A database that is unreachable must degrade to "we can't look that up
 *     right now", never a fatal error on a public page.
 */

require_once __DIR__ . '/config.php';   // BACKOFFICE_URL, used when building blog image URLs

/**
 * Shared PDO handle, or null when the database is unreachable or unconfigured.
 */
function kr_db(): ?PDO
{
    static $pdo = null;
    static $tried = false;

    if ($tried) {
        return $pdo;
    }
    $tried = true;

    $config = __DIR__ . '/db-config.php';
    if (!is_readable($config)) {
        error_log('kr_db: includes/db-config.php is missing — tracking is disabled.');
        return null;
    }
    require_once $config;

    try {
        $pdo = new PDO(
            sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_DATABASE),
            DB_USERNAME,
            DB_PASSWORD,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_TIMEOUT            => 5,
            ]
        );
    } catch (PDOException $e) {
        error_log('kr_db: connection failed — ' . $e->getMessage());
        $pdo = null;
    }

    return $pdo;
}

/**
 * Look up one shipment by its tracking number or its shipping reference.
 *
 * Returns null when nothing matches, and false when the lookup could not be
 * performed at all — the caller must tell those two apart, because "not found"
 * is the visitor's problem and "lookup failed" is ours.
 *
 * @return array|null|false
 */
function kr_find_shipment(string $query)
{
    $query = trim($query);
    if ($query === '') {
        return null;
    }

    $pdo = kr_db();
    if ($pdo === null) {
        return false;
    }

    $sql = 'SELECT s.id,
                   s.shipping_reference,
                   s.tracking_number,
                   s.status,
                   s.is_received,
                   s.shipped_at,
                   s.estimated_delivery_date,
                   s.delivered_at,
                   s.created_at,
                   -- origin/destination_branch_id normally hold a place name picked in
                   -- the back office (Michigan, Illinois, ... Ghana), not a branch id
                   COALESCE(ob.name, s.origin_branch_id)      AS origin_name,
                   ob.country                                 AS origin_country,
                   COALESCE(db.name, s.destination_branch_id) AS destination_name,
                   db.country                                 AS destination_country
            FROM shipments s
            LEFT JOIN branches ob ON ob.id = s.origin_branch_id
            LEFT JOIN branches db ON db.id = s.destination_branch_id
            WHERE s.tracking_number = :tracking OR s.shipping_reference = :reference
            LIMIT 1';

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':tracking' => $query, ':reference' => $query]);
        $row = $stmt->fetch();
    } catch (PDOException $e) {
        error_log('kr_find_shipment: ' . $e->getMessage());
        return false;
    }

    return $row ?: null;
}

/**
 * The shipment's status history, newest first.
 *
 * Two tables record movement and the Laravel app writes to both, so both are read:
 * `trackings` logs a branch-scoped status change, `shipment_updates` logs a free-text
 * location. Neither is authoritative on its own.
 */
function kr_shipment_timeline(string $reference): array
{
    $pdo = kr_db();
    if ($pdo === null) {
        return [];
    }

    $sql = "SELECT t.status,
                   t.description               AS note,
                   COALESCE(b.name, '')        AS location,
                   t.status_updated_at         AS happened_at
            FROM trackings t
            LEFT JOIN branches b ON b.id = t.branch_id
            JOIN shipments s ON s.id = t.shipment_id
            WHERE s.tracking_number = :tracking1 OR s.shipping_reference = :reference1
            UNION ALL
            SELECT u.status,
                   u.remarks                   AS note,
                   COALESCE(u.location, '')    AS location,
                   u.updated_at                AS happened_at
            FROM shipment_updates u
            JOIN shipments s2 ON s2.id = u.shipment_id
            WHERE s2.tracking_number = :tracking2 OR s2.shipping_reference = :reference2
            ORDER BY happened_at DESC";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':tracking1'  => $reference, ':reference1' => $reference,
            ':tracking2'  => $reference, ':reference2' => $reference,
        ]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log('kr_shipment_timeline: ' . $e->getMessage());
        return [];
    }
}

/**
 * Whether the receiver has confirmed taking the shipment.
 *
 * shipments.is_received is the flag: staff set it with "Mark as Received" in the admin,
 * and "Record Delivery" (admin or mobile API) sets it whenever a receiver signature is
 * uploaded. The signature check below also covers deliveries recorded before that rule
 * existed. (receiver_verifications is never written by the back office — don't use it.)
 */
function kr_shipment_received(array $shipment): bool
{
    if (!empty($shipment['is_received'])) {
        return true;
    }

    $pdo = kr_db();
    if ($pdo === null || empty($shipment['id'])) {
        return false;
    }

    try {
        $stmt = $pdo->prepare("SELECT 1 FROM shipment_deliveries
                               WHERE shipment_id = :id
                                 AND receiver_signature IS NOT NULL AND receiver_signature <> ''
                               LIMIT 1");
        $stmt->execute([':id' => $shipment['id']]);
        return (bool) $stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log('kr_shipment_received: ' . $e->getMessage());
        return false;
    }
}

/**
 * The items on a shipment, grouped by receiver, for the tracking page.
 *
 * Exposes only what helps a recipient recognise their goods: item name, quantity,
 * box number and a vehicle's make/model/year. Receiver names are cut to first name
 * plus last initial by kr_mask_name(). No phone, address, ID, VIN, value or cost.
 *
 * @return array<int, array{receiver: string, items: array<int, array>}>
 */
function kr_shipment_items(string $shipmentId): array
{
    $pdo = kr_db();
    if ($pdo === null || $shipmentId === '') {
        return [];
    }

    // shipment_items.shipment_id is back-filled by the Laravel model after save, so
    // older rows may only be linked through their receiver — accept either.
    $sql = "SELECT r.id                       AS receiver_id,
                   COALESCE(r.receiver_name, '') AS receiver_name,
                   COALESCE(p.name, '')       AS item_name,
                   i.quantity,
                   i.box_no,
                   i.is_vehicle,
                   i.vehicle_make,
                   i.vehicle_model,
                   i.vehicle_year
            FROM shipment_items i
            LEFT JOIN receivers r ON r.id = i.receiver_id
            LEFT JOIN products  p ON p.id = i.product_id
            WHERE i.shipment_id = :id1 OR r.shipment_id = :id2
            ORDER BY r.receiver_name, i.box_no";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id1' => $shipmentId, ':id2' => $shipmentId]);
        $rows = $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log('kr_shipment_items: ' . $e->getMessage());
        return [];
    }

    $groups = [];
    foreach ($rows as $row) {
        $key = (string) ($row['receiver_id'] ?? '');
        if (!isset($groups[$key])) {
            $groups[$key] = ['receiver' => kr_mask_name($row['receiver_name']), 'items' => []];
        }

        $name = trim($row['item_name']);
        if (!empty($row['is_vehicle'])) {
            $vehicle = trim(implode(' ', array_filter([
                $row['vehicle_year'], $row['vehicle_make'], $row['vehicle_model'],
            ])));
            $name = $vehicle !== '' ? $vehicle : ($name ?: 'Vehicle');
        }

        $groups[$key]['items'][] = [
            'name'     => $name !== '' ? $name : 'Item',
            'quantity' => (int) $row['quantity'],
            'box'      => trim((string) $row['box_no']),
            'vehicle'  => !empty($row['is_vehicle']),
        ];
    }

    return array_values($groups);
}

/**
 * "Kwame Asante Mensah" -> "Kwame M.". Enough for a recipient to recognise their own
 * name, not enough to identify a stranger's.
 */
function kr_mask_name(?string $name): string
{
    $parts = preg_split('/\s+/u', trim((string) $name), -1, PREG_SPLIT_NO_EMPTY);
    if (!$parts) {
        return 'Receiver';
    }
    $first = $parts[0];
    if (count($parts) === 1) {
        return $first;
    }
    return $first . ' ' . mb_strtoupper(mb_substr(end($parts), 0, 1)) . '.';
}

/**
 * The five public stages on the tracking page, in order, with their images.
 * Images are hand-drawn SVGs in images/tracking/, in the brand navy and red.
 */
function kr_tracking_stages(): array
{
    return [
        1 => ['label' => 'Picked',         'image' => 'images/tracking/stage-picked.svg'],
        2 => ['label' => 'Shipped',        'image' => 'images/tracking/stage-shipped.svg'],
        3 => ['label' => 'Harbour / Port', 'image' => 'images/tracking/stage-port.svg'],
        4 => ['label' => 'Delivery',       'image' => 'images/tracking/stage-delivery.svg'],
        5 => ['label' => 'Received',       'image' => 'images/tracking/stage-received.svg'],
    ];
}

/**
 * Presentation metadata for a shipments.status value (the back office's
 * App\Enums\ShippingStatus). `step` indexes kr_tracking_stages(): 0 means booked
 * but not yet picked up; cancelled sits outside the tracker entirely (null).
 *
 * `$received` lifts a delivered shipment to the final Received stage.
 */
function kr_status_meta(string $status, bool $received = false): array
{
    switch (strtolower(trim($status))) {
        case 'pending':
            return ['label' => 'Booked — Awaiting Pickup', 'step' => 0, 'class' => 'warning', 'icon' => 'fa-clipboard-list'];
        case 'pickup':
            return ['label' => 'Picked Up',  'step' => 1, 'class' => 'warning', 'icon' => 'fa-box'];
        case 'shipped':
        case 'in transit':   // legacy value, renamed to 'shipped' in August 2026
            return ['label' => 'Shipped',    'step' => 2, 'class' => 'info',    'icon' => 'fa-ship'];
        case 'cleared':
            return ['label' => 'At Port — Customs Cleared', 'step' => 3, 'class' => 'info', 'icon' => 'fa-anchor'];
        case 'delivered':
            return $received
                ? ['label' => 'Received',  'step' => 5, 'class' => 'success', 'icon' => 'fa-circle-check']
                : ['label' => 'Delivered', 'step' => 4, 'class' => 'success', 'icon' => 'fa-truck-fast'];
        case 'cancelled':
            return ['label' => 'Cancelled',  'step' => null, 'class' => 'danger', 'icon' => 'fa-circle-xmark'];
        default:
            return ['label' => ucfirst($status), 'step' => 0, 'class' => 'secondary', 'icon' => 'fa-box'];
    }
}

/**
 * Display label for a status-history row, matching the tracker badge wording.
 * History rows carry the shipment status at the time, plus 'received', which the
 * back office logs when a receiver confirms receipt.
 */
function kr_history_label(string $status): string
{
    return strtolower(trim($status)) === 'received' ? 'Received' : kr_status_meta($status)['label'];
}

/**
 * Format a database datetime for display, or return null when it is empty.
 */
function kr_date(?string $value, string $format = 'M j, Y'): ?string
{
    if (empty($value) || str_starts_with($value, '0000')) {
        return null;
    }
    $ts = strtotime($value);
    return $ts ? date($format, $ts) : null;
}

/* -----------------------------------------------------------------------------
 * News / blog
 *
 * Posts are authored by staff in the back-office Filament admin and stored in the
 * same database. This site only reads published ones (`status` = 1). Uploaded
 * images live on the back-office host, so they are addressed through BACKOFFICE_URL.
 * -------------------------------------------------------------------------- */

/**
 * Published posts, newest first. $limit = 0 means "all".
 */
function kr_blog_posts(int $limit = 0): array
{
    $pdo = kr_db();
    if ($pdo === null) {
        return [];
    }

    $sql = "SELECT b.slug, b.title, b.description, b.img, b.postedby, b.views,
                   COALESCE(b.published_at, b.created_at) AS posted_at,
                   COALESCE(c.cat, '') AS category
            FROM blogs b
            LEFT JOIN blog_categories c ON c.id = b.cat_id
            WHERE b.status = 1
            ORDER BY posted_at DESC";
    if ($limit > 0) {
        $sql .= ' LIMIT ' . (int) $limit;   // cast, not a bound param: LIMIT can't be bound
    }

    try {
        return $pdo->query($sql)->fetchAll();
    } catch (PDOException $e) {
        error_log('kr_blog_posts: ' . $e->getMessage());
        return [];
    }
}

/**
 * One published post by slug, or null.
 */
function kr_blog_post(string $slug): ?array
{
    $pdo = kr_db();
    if ($pdo === null || trim($slug) === '') {
        return null;
    }

    $sql = "SELECT b.slug, b.title, b.description, b.content, b.img, b.keywords,
                   b.postedby, b.views, b.`references`, b.updated_at,
                   COALESCE(b.published_at, b.created_at) AS posted_at,
                   COALESCE(c.cat, '') AS category
            FROM blogs b
            LEFT JOIN blog_categories c ON c.id = b.cat_id
            WHERE b.slug = :slug AND b.status = 1
            LIMIT 1";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':slug' => trim($slug)]);
        return $stmt->fetch() ?: null;
    } catch (PDOException $e) {
        error_log('kr_blog_post: ' . $e->getMessage());
        return null;
    }
}

/**
 * Absolute URL for an uploaded blog image, or a local placeholder when there is none.
 */
function kr_blog_image(?string $path): string
{
    $path = trim((string) $path);
    if ($path === '') {
        return 'images/gallery/shipping-01.jpg';
    }
    if (preg_match('#^https?://#i', $path)) {
        return $path;
    }
    return rtrim(BACKOFFICE_URL, '/') . '/storage/' . ltrim($path, '/');
}

/**
 * Render post body HTML from the back-office rich-text editor.
 *
 * The content is staff-authored and therefore trusted enough to render as HTML —
 * escaping it would show visitors raw tags. It is still reduced to a known tag set
 * and stripped of event handlers and javascript: URLs, so that a compromised or
 * careless admin account cannot turn a news post into stored XSS on this domain.
 */
function kr_rich_text(?string $html): string
{
    $allowed = '<p><br><strong><b><em><i><u><s><ul><ol><li><h1><h2><h3><h4>'
             . '<blockquote><a><img><hr><code><pre><table><thead><tbody><tr><th><td>';
    $clean = strip_tags((string) $html, $allowed);
    $clean = preg_replace('/\son[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $clean);
    $clean = preg_replace('/(href|src)\s*=\s*(["\']?)\s*javascript:[^"\'>\s]*/i', '$1=$2#', $clean);
    return $clean;
}
