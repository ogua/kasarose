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
 *     reference, the status, the branch names and the dates. No client records, no
 *     addresses, no costs, no payment state.
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

    $sql = 'SELECT s.shipping_reference,
                   s.tracking_number,
                   s.status,
                   s.shipped_at,
                   s.estimated_delivery_date,
                   s.delivered_at,
                   s.created_at,
                   ob.name    AS origin_name,
                   ob.country AS origin_country,
                   db.name    AS destination_name,
                   db.country AS destination_country
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
 * Presentation metadata for a shipments.status enum value.
 * `step` drives the three-stage progress bar; cancelled sits outside it.
 */
function kr_status_meta(string $status): array
{
    switch (strtolower(trim($status))) {
        case 'pending':
            return ['label' => 'Booked',     'step' => 1, 'class' => 'warning', 'icon' => 'fa-box'];
        case 'in transit':
            return ['label' => 'In Transit', 'step' => 2, 'class' => 'info',    'icon' => 'fa-truck-fast'];
        case 'delivered':
            return ['label' => 'Delivered',  'step' => 3, 'class' => 'success', 'icon' => 'fa-circle-check'];
        case 'cancelled':
            return ['label' => 'Cancelled',  'step' => 0, 'class' => 'danger',  'icon' => 'fa-circle-xmark'];
        default:
            return ['label' => ucfirst($status), 'step' => 1, 'class' => 'secondary', 'icon' => 'fa-box'];
    }
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
