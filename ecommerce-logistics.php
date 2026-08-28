<?php
$page_title = 'Ecommerce Logistics';
$meta_description = 'Ecommerce package forwarding from KASAROSE LOGISTICS — shop Amazon, eBay, Walmart and Best Buy, we forward your packages.';
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
                  <h1 class="display-2 text-info">Ecommerce Logistics</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ecommerce Logistics</li>
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
                  <img src="images/gallery/shipping-17.jpg" alt="Forwarded ecommerce parcels being unloaded for delivery" class="img-fluid round">
               </div>
               <h2 class="display-3">Ecommerce Package Forwarding</h2>
               <p>Shop from Amazon, eBay, Walmart, Best Buy and other US retailers, and let us forward your
                  purchases to your doorstep. Our ecommerce logistics service is built for anyone who wants access
                  to US online shopping without a US address.</p>
               <p>We consolidate and forward packages as part of the group's broader freight network, so you get
                  the same reliability and tracking as our air and ocean freight services.</p>
               <h3 class="display-3">Estimated Delivery Time</h3>
               <p class="mb-2"><strong><?php echo $delivery_timeframes[3]['estimate']; ?></strong>
                  &mdash; <?php echo $delivery_timeframes[3]['notes']; ?></p>
               <p>This is an estimate, not a guarantee; customs clearance, carrier schedules and weather
                  can affect transit. We confirm the delivery window for your shipment
                  <?php echo QUOTE_RESPONSE_TIME; ?> of your <a href="quote.php">quote request</a>. See our
                  <a href="delivery-policy.php">Delivery Policy</a> for full details.</p>

               <h3 class="display-3">Why Choose Our Ecommerce Logistics Service</h3>
               <div class="d-sm-flex list-single">
                  <ul class="ct-list">
                     <li>Forwarding from major US retailers.</li>
                     <li>Package consolidation options.</li>
                     <li>Real-time shipment tracking on our <a href="tracking.php">Tracking</a> page.</li>
                  </ul>
                  <ul class="ct-list">
                     <li>Works alongside our air, ocean &amp; road freight.</li>
                     <li>Clear communication from pickup to delivery.</li>
                     <li>Backed by our group's broader logistics network.</li>
                  </ul>
               </div>
               <div class="d-sm-flex gap-4 gallery-single mb-5 pt-2">
                  <img src="images/gallery/shipping-12.jpg" alt="Forwarded parcels palletised at our US address" class="img-fluid round" loading="lazy">
                  <img src="images/gallery/shipping-13.jpg" alt="Parcels moved through to dispatch" class="img-fluid round" loading="lazy">
               </div>
               <a href="quote.php" class="btn btn-primary">Request a Shipping Quote <i class="fa fa-arrow-right"></i><span></span></a>
            </div>
         </div>
      </div>
   </div>
   <!-- Services Section End -->

<?php
$cta_eyebrow = 'Get Started';
$cta_heading = 'Ready to forward your first package?';
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
