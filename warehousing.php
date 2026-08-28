<?php
$page_title = 'Warehousing';
$meta_description = 'Warehousing and storage support from KASAROSE LOGISTICS, coming soon alongside our freight logistics services.';
require 'partials/head.php';
require 'partials/header.php';
?>

   <!-- Promo Section Start -->
   <section class="promo-sec bg-cover jarallax" data-jarallax data-speed=".4">
      <img src="images/promo.jpg" alt="" class="jarallax-img">
      <div class="parallax-overly"></div>
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="promo-wrap">
                  <h1 class="display-2 text-info">Warehousing</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Warehousing</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Promo Section End -->

   <!-- Services Section Start -->
   <div class="single-service bg-shade sec-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 order-lg-1 order-2">
<?php require 'partials/service-sidebar.php'; ?>
            </div>
            <div class="col-lg-8 order-lg-2 order-1">
               <div class="service-thumb">
                  <img src="images/gallery/shipping-18.jpg" alt="Our warehouse, where consignments are consolidated before export" class="img-fluid round">
               </div>
               <span class="badge bg-primary mb-3">Coming Soon</span>
               <h2 class="display-3">Warehousing &amp; Storage</h2>
               <p>We're building out warehousing and storage capacity to give clients more flexibility around when
                  and how their shipments move &mdash; useful for consolidating ecommerce orders, holding inventory,
                  or bridging the gap between arrival and final delivery.</p>
               <p>This service is currently in development. If warehousing or storage support is something your
                  business needs now, reach out and we'll let you know as it becomes available.</p>
               <a href="contact.php" class="btn btn-primary">Contact Us About Warehousing <i class="fa fa-arrow-right"></i><span></span></a>
            </div>
         </div>
      </div>
   </div>
   <!-- Services Section End -->

<?php
$cta_eyebrow = 'Get In Touch';
$cta_heading = 'Want to know when warehousing goes live?';
$cta_buttons = [['label' => 'Contact Us', 'href' => 'contact.php', 'style' => 'primary']];
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
