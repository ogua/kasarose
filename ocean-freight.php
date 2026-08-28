<?php
$page_title = 'Ocean Freight';
$meta_description = 'Ocean/sea freight shipping from KASAROSE LOGISTICS — cost-effective freight for bulk and oversized international shipments.';
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
                  <h1 class="display-2 text-info">Ocean Freight</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ocean Freight</li>
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
                  <img src="images/ship.jpg" alt="Ocean Freight" class="img-fluid round">
               </div>
               <h2 class="display-3">Ocean &amp; Sea Freight Services</h2>
               <p>For bulk, heavy or oversized cargo, ocean freight remains one of the most cost-effective ways to
                  ship internationally. We handle the coordination, documentation and scheduling so your goods move
                  reliably from origin to destination.</p>
               <p>Whether you're shipping commercial cargo or a large personal shipment, our sea freight service is
                  built around predictable schedules and clear communication at every step.</p>
               <h3 class="display-3">Estimated Delivery Time</h3>
               <p class="mb-2"><strong><?php echo $delivery_timeframes[1]['estimate']; ?></strong>
                  &mdash; <?php echo $delivery_timeframes[1]['notes']; ?></p>
               <p>This is an estimate, not a guarantee; customs clearance, carrier schedules and weather
                  can affect transit. We confirm the delivery window for your shipment
                  <?php echo QUOTE_RESPONSE_TIME; ?> of your <a href="quote.php">quote request</a>. See our
                  <a href="delivery-policy.php">Delivery Policy</a> for full details.</p>

               <h3 class="display-3">Why Choose Our Ocean Freight Service</h3>
               <div class="d-sm-flex list-single">
                  <ul class="ct-list">
                     <li>Cost-effective for bulk and oversized cargo.</li>
                     <li>Predictable shipping schedules.</li>
                     <li>Support with customs &amp; shipping documentation.</li>
                  </ul>
                  <ul class="ct-list">
                     <li>Ideal for large or non-urgent shipments.</li>
                     <li>Backed by our group's broader logistics network.</li>
                     <li>Real-time shipment tracking on our <a href="tracking.php">Tracking</a> page.</li>
                  </ul>
               </div>
               <div class="d-sm-flex gap-4 gallery-single mb-5 pt-2">
                  <img src="images/gallery/shipping-01.jpg" alt="Loading a container for export by sea" class="img-fluid round" loading="lazy">
                  <img src="images/gallery/shipping-04.jpg" alt="A vehicle secured inside a container" class="img-fluid round" loading="lazy">
               </div>
               <a href="quote.php" class="btn btn-primary">Request an Ocean Freight Quote <i class="fa fa-arrow-right"></i><span></span></a>
            </div>
         </div>
      </div>
   </div>
   <!-- Services Section End -->

<?php
$cta_eyebrow = 'Get Started';
$cta_heading = 'Shipping something large by sea?';
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
