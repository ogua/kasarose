<?php
$page_title = 'Property Management';
$meta_description = 'Property management services from KASAROSE LOGISTICS — day-to-day management support so property owners can invest with confidence.';
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
                  <h1 class="display-2 text-info">Property Management</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Property Management</li>
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
<?php $sidebar_cta = ['label' => 'Talk to Our Team', 'href' => 'contact.php']; ?>
<?php require 'partials/service-sidebar.php'; ?>
            </div>
            <div class="col-lg-8 order-lg-2 order-1">
               <div class="service-thumb">
                  <img src="images/gallery/shipping-20.jpg" alt="A residential property and its grounds" class="img-fluid round">
               </div>
               <h2 class="display-3">Day-to-Day Property Management</h2>
               <p>Owning property is easier when someone reliable is looking after it. KASAROSE LOGISTICS' property
                  management service handles the day-to-day so owners can invest with confidence, whether that's a
                  single property or a small portfolio.</p>
               <p>We work directly with owners to understand what "well managed" looks like for their property, and
                  build our support around that.</p>
               <h3 class="display-3">How We Can Help</h3>
               <div class="d-sm-flex list-single">
                  <ul class="ct-list">
                     <li>Day-to-day property oversight.</li>
                     <li>Clear, responsive communication with owners.</li>
                     <li>Support for both single properties &amp; small portfolios.</li>
                  </ul>
                  <ul class="ct-list">
                     <li>Works alongside our real estate team.</li>
                     <li>Part of the broader KASAROSE LOGISTICS group.</li>
                     <li>Available across our service regions.</li>
                  </ul>
               </div>
               <a href="contact.php" class="btn btn-primary">Contact Us About Property Management <i class="fa fa-arrow-right"></i><span></span></a>
            </div>
         </div>
      </div>
   </div>
   <!-- Services Section End -->

<?php
$cta_eyebrow = 'Let&rsquo;s Talk';
$cta_heading = 'Own a property you would rather not manage alone?';
$cta_buttons = [['label' => 'Contact Us', 'href' => 'contact.php', 'style' => 'primary']];
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
