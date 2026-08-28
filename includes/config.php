<?php
/**
 * Site-wide constants and shared data for the KASAROSE LOGISTICS group site.
 * Included by every partials/head.php via the page entry files.
 */

define('SITE_NAME', 'KASAROSE LOGISTICS');
define('SITE_URL', 'https://kasarose.com'); // production domain — used for canonical/Open Graph URLs and sitemap.xml

// The group was renamed from "KasaBazaar Group of Companies" to "KASAROSE LOGISTICS" in August 2026.
// kasabazaar.com should 301-redirect here; nothing on this site should link to it any more.
//
// RDD Shipping (Rose Door-to-Door Shipping & Delivery Service) was absorbed into
// KASAROSE LOGISTICS in August 2026 and is no longer a separate company. Its
// freight services — air, sea, ecommerce package forwarding and shipment
// tracking — are now offered by this company directly, and its public website
// content lives on this site. The Laravel application at Projects/kasabazaar is
// retained as the back-office (Filament admin, client and investor portals,
// mobile API) and owns the shipment database this site reads for tracking.
// Nothing here should describe RDD as a sister company or link to rddshipping.com.

// Sister-company domains. Every cross-link on this site must use these constants
// rather than a hardcoded URL, so a domain change is a one-line edit here.
// The same roster is mirrored in the other repositories — see the
// "Group of Companies" section of CLAUDE.md before changing any of them.
define('SITE_URL_KROSEMARKET', 'https://krosemarket.com');
define('SITE_URL_NEORIDE', 'https://neorideafrica.com');

// The back-office Laravel application (Projects/kasabazaar). It owns the shipment
// database this site reads for tracking, and serves the uploaded blog images that
// news.php renders, from BACKOFFICE_URL/storage/<path>.
// CONFIRM BEFORE LAUNCH: still on the rddshipping.com host — repoint if the
// application moves to a kasarose.com subdomain.
define('BACKOFFICE_URL', 'https://rddshipping.com');
define('ADMIN_URL', BACKOFFICE_URL . '/admin');          // staff login (Filament)
define('STAFF_MAIL_URL', 'https://mail.hostinger.com');

// The group's published numbers. Each has a display form and a dialable _TEL form —
// keep the pair in step. These are mirrored in the other repos' contact blocks and on
// both letterheads (kasarose-logistics-letterhead*.docx); update all of them together.
define('CONTACT_PHONE_US_1', '+1 (574) 440-7460');
define('CONTACT_PHONE_US_1_TEL', '+15744407460');
define('CONTACT_PHONE_US_2', '+1 (773) 970-0129');
define('CONTACT_PHONE_US_2_TEL', '+17739700129');
define('CONTACT_PHONE_GH_1', '+233 54 517 0568');
define('CONTACT_PHONE_GH_1_TEL', '+233545170568');
define('CONTACT_PHONE_GH_2', '+233 50 972 5081');
define('CONTACT_PHONE_GH_2_TEL', '+233509725081');

define('CONTACT_EMAIL_SUPPORT', 'support@kasarose.com');

// Every inbox that receives a form submission (contact, quote, feedback). mailer.php
// addresses all of them on every send, so adding or removing a colleague is a one-line
// change here and nowhere else — never hardcode a recipient in mailer.php. Entries that
// are blank, malformed or duplicated are skipped at send time rather than aborting the
// send, so a typo here costs that one recipient, not the whole submission.
$form_recipients = [
    'kasabazaar109@gmail.com',   // original catch-all inbox
    'support@kasarose.com',      // the published support address (CONTACT_EMAIL_SUPPORT)
    'support@kasabazaar.com',    // old-domain account; also the SMTP sender
];

define('CONTACT_REGIONS', 'United States &bull; Ghana');

// Ghana office, carried over from the RDD Shipping site.
define('CONTACT_ADDRESS_GH', 'Adako Jachie, Ejisu, Kumasi');
define('CONTACT_MAP_EMBED', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3962.377613898537!2d-1.510474!3d6.723694!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdbeac7c67646f1%3A0x7f50d40c195153d1!2sAdako%20Jachie%20Rd%2C%20Ejisu%2C%20Ghana!5e0!3m2!1sen!2sus!4v1737047181287!5m2!1sen!2sus');

// The group's companies, shared by index.php (teaser) and our-companies.php (full cards).
// Order matters — it is the order the cards render in on both pages.
// Three companies since August 2026; the copy that counts them lives in
// our-companies.php, about.php, faq.php and partials/footer.php.
$group_companies = [
    [
        'name' => 'KASAROSE LOGISTICS',
        'tagline' => 'Door-to-door freight, real estate and property management.',
        'description' => 'The group\'s founding company — known as KasaBazaar until 2026, and incorporating the door-to-door freight business formerly run as RDD Shipping. Air and sea freight, ecommerce package forwarding and shipment tracking between the United States and Ghana, alongside real estate sales and property management.',
        'url' => 'services.php',
        'url_label' => 'View Our Services',
        'external' => false,
        'logo' => 'images/kasarose-logistics-logo.png',
    ],
    [
        'name' => 'Neoride Africa',
        'tagline' => "Driving Africa's Mobility Revolution.",
        'description' => 'A tricycle mobility and transport company operating in Ghana since 2025, focused on affordable rides, last-mile connectivity, and youth employment.',
        'url' => SITE_URL_NEORIDE,
        'url_label' => 'Visit neorideafrica.com',
        'external' => true,
        'logo' => null,
    ],
    [
        'name' => 'KROSEMARKET',
        'tagline' => "Ghana's multi-vendor marketplace, delivered.",
        'description' => "The group's ecommerce marketplace, where vetted Ghanaian vendors sell direct to shoppers nationwide. Orders are carried by the group's own logistics network, so a small seller can reach the whole country without owning a single vehicle.",
        'url' => SITE_URL_KROSEMARKET,
        'url_label' => 'Visit krosemarket.com',
        'external' => true,
        // Built from the KASAROSE brand assets so the two read as one family —
        // see tools/make-krosemarket-logo.py.
        'logo' => 'images/krosemarket-logo.png',
    ],
];

// Estimated delivery time frames, published on delivery-policy.php / faq.php / quote.php
// and required for payment-processor compliance. Update here, not in individual pages.
define('QUOTE_RESPONSE_TIME', 'within 1 business day');

$delivery_timeframes = [
    [
        'service' => 'Air Freight',
        'estimate' => '7&ndash;14 business days',
        'notes' => 'Door-to-door between the United States and Ghana, from collection to final delivery.',
    ],
    [
        'service' => 'Ocean Freight',
        'estimate' => '45&ndash;60 days',
        'notes' => 'Port-to-port sailing time plus customs clearance and inland delivery.',
    ],
    [
        'service' => 'Road Freight &amp; Last-Mile Delivery',
        'estimate' => '1&ndash;3 business days',
        'notes' => 'Local and regional transport once cargo has cleared the port or left our warehouse.',
    ],
    [
        'service' => 'Ecommerce Package Forwarding',
        'estimate' => '10&ndash;21 business days',
        'notes' => 'Measured from the day your package is received at our US address, not from the date you ordered it from the retailer.',
    ],
];

// The service pages, in the order they appear in the nav dropdown, the footer's
// "Our Services" column, the offcanvas canvas-menu and each service page's own
// sidebar. Every one of those lists used to be hand-maintained and had drifted:
// warehousing.php was in the nav but missing from the footer and the canvas menu,
// and the five freight pages each carried their own copy of the same array.
$site_services = [
    'air-freight.php'        => 'Air Freight',
    'ocean-freight.php'      => 'Ocean Freight',
    'road-freight.php'       => 'Road Freight',
    'warehousing.php'        => 'Warehousing',
    'ecommerce-logistics.php' => 'Ecommerce Logistics',
    'real-estate.php'        => 'Real Estate',
    'property-management.php' => 'Property Management',
];

/**
 * The file name of the page currently being rendered, e.g. "about.php".
 * Used to mark the active item in the main nav and the service sidebars.
 */
function kr_current_page(): string
{
    return basename($_SERVER['SCRIPT_NAME'] ?? '');
}

/**
 * ' active' when $page (or any of several pages, for a dropdown parent) is the
 * page being rendered, so it can be interpolated straight into a class attribute.
 */
function kr_active(string ...$pages): string
{
    return in_array(kr_current_page(), $pages, true) ? ' active' : '';
}
