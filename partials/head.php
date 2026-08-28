<?php
/**
 * Shared <head>. Entry pages set $page_title and $meta_description before including this file.
 */
require_once __DIR__ . '/../includes/config.php';

$page_title = $page_title ?? SITE_NAME;
$meta_description = $meta_description ?? 'KASAROSE LOGISTICS — door-to-door air and sea freight between the US and Ghana, ecommerce package forwarding, shipment tracking, real estate and property management.';

$current_path = basename($_SERVER['SCRIPT_NAME']);
$canonical_url = SITE_URL . '/' . ($current_path === 'index.php' ? '' : $current_path);
$og_image = SITE_URL . '/images/kasarose-logistics-logo.png';
$full_title = htmlspecialchars($page_title) . ' | ' . SITE_NAME;
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>">
   <meta name="author" content="KASAROSE LOGISTICS">
   <meta name="theme-color" content="#052240">
   <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
   <title><?php echo $full_title; ?></title>

   <!-- Open Graph / Facebook -->
   <meta property="og:type" content="website">
   <meta property="og:site_name" content="<?php echo SITE_NAME; ?>">
   <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
   <meta property="og:title" content="<?php echo $full_title; ?>">
   <meta property="og:description" content="<?php echo htmlspecialchars($meta_description); ?>">
   <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">

   <!-- Twitter -->
   <meta name="twitter:card" content="summary">
   <meta name="twitter:title" content="<?php echo $full_title; ?>">
   <meta name="twitter:description" content="<?php echo htmlspecialchars($meta_description); ?>">
   <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">

   <!-- Favicons -->
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">
   <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
   <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
   <link rel="manifest" href="images/site.webmanifest">

   <script type="application/ld+json">
   {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "<?php echo SITE_NAME; ?>",
      "alternateName": "KasaBazaar Group of Companies",
      "url": "<?php echo SITE_URL; ?>",
      "logo": "<?php echo htmlspecialchars($og_image); ?>",
      "contactPoint": [
         {
            "@type": "ContactPoint",
            "telephone": "<?php echo CONTACT_PHONE_US_1_TEL; ?>",
            "contactType": "customer service",
            "areaServed": "US"
         },
         {
            "@type": "ContactPoint",
            "telephone": "<?php echo CONTACT_PHONE_GH_1_TEL; ?>",
            "contactType": "customer service",
            "areaServed": "GH"
         }
      ],
      "email": "<?php echo CONTACT_EMAIL_SUPPORT; ?>",
      "subOrganization": [
         {
            "@type": "Organization",
            "name": "Neoride Africa",
            "url": "<?php echo SITE_URL_NEORIDE; ?>"
         },
         {
            "@type": "OnlineStore",
            "name": "KROSEMARKET",
            "url": "<?php echo SITE_URL_KROSEMARKET; ?>"
         }
      ],
      "sameAs": [
         "<?php echo SITE_URL_NEORIDE; ?>",
         "<?php echo SITE_URL_KROSEMARKET; ?>"
      ]
   }
   </script>

   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap"
      rel="stylesheet">
   <!-- CSS Files -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/fancybox.css">
   <link rel="stylesheet" href="css/swiper-bundle.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/jarallax.min.css">
   <link rel="stylesheet" href="css/nice-select.css">
   <link rel="stylesheet" href="css/jquery.datepicker.css">
   <link rel="stylesheet" href="css/jquery.timepicker.min.css">
   <!-- Style CSS -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <div class="main-overlay"></div>
   <!-- Preloader -->
   <div id="preloader">
      <div class="preloader">
         <span></span>
         <span></span>
      </div>
   </div>
