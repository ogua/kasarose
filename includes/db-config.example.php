<?php
/**
 * Template for includes/db-config.php, which is gitignored (see .gitignore).
 * Copy this file to includes/db-config.php and fill in real values.
 *
 * This site reads the shipment database owned by the back-office Laravel
 * application (Projects/kasabazaar) so that tracking.php can resolve a tracking
 * number without going through that application. It only ever issues SELECTs.
 *
 * Use a dedicated MySQL account with SELECT granted on just the tables the
 * website reads — never the account the Laravel app writes with:
 *
 *   CREATE USER 'kasarose_web_ro'@'localhost' IDENTIFIED BY '...';
 *   GRANT SELECT ON kasabazaar.shipments        TO 'kasarose_web_ro'@'localhost';
 *   GRANT SELECT ON kasabazaar.branches         TO 'kasarose_web_ro'@'localhost';
 *   GRANT SELECT ON kasabazaar.trackings        TO 'kasarose_web_ro'@'localhost';
 *   GRANT SELECT ON kasabazaar.shipment_updates TO 'kasarose_web_ro'@'localhost';
 *   FLUSH PRIVILEGES;
 *
 * If this file is absent the site still runs; tracking.php degrades to a notice
 * telling visitors to contact us, rather than fataling (see includes/db.php).
 */

define('DB_HOST', '127.0.0.1');
define('DB_PORT', 3306);
define('DB_DATABASE', 'kasabazaar');
define('DB_USERNAME', 'kasarose_web_ro');
define('DB_PASSWORD', '');
