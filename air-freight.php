<?php
$page_title = 'Air Freight';
$meta_description = 'Air freight shipping from KASAROSE LOGISTICS — fast, reliable international air cargo for time-sensitive shipments.';
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
                  <h1 class="display-2 text-info">Air Freight</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Air Freight</li>
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
                  <img src="images/air.jpg" alt="Air Freight" class="img-fluid round">
               </div>
               <h2 class="display-3">International Air Freight Services</h2>
               <p>When speed matters, air freight is the fastest way to move cargo across borders. Our air freight
                  service handles booking, documentation and coordination so your shipment gets to its destination
                  quickly and safely, whether it's a single parcel or a larger commercial shipment.</p>
               <p>We work with individuals and businesses shipping internationally, keeping you informed from pickup
                  through to delivery so there are no surprises along the way.</p>
               <h3 class="display-3">Estimated Delivery Time</h3>
               <p class="mb-2"><strong><?php echo $delivery_timeframes[0]['estimate']; ?></strong>
                  &mdash; <?php echo $delivery_timeframes[0]['notes']; ?></p>
               <p>This is an estimate, not a guarantee; customs clearance, carrier schedules and weather
                  can affect transit. We confirm the delivery window for your shipment
                  <?php echo QUOTE_RESPONSE_TIME; ?> of your <a href="quote.php">quote request</a>. See our
                  <a href="delivery-policy.php">Delivery Policy</a> for full details.</p>

               <h3 class="display-3">Why Choose Our Air Freight Service</h3>
               <div class="d-sm-flex list-single">
                  <ul class="ct-list">
                     <li>Fast transit times for time-sensitive cargo.</li>
                     <li>Clear communication from booking to delivery.</li>
                     <li>Support with customs documentation.</li>
                  </ul>
                  <ul class="ct-list">
                     <li>Suitable for parcels and commercial shipments.</li>
                     <li>Backed by our group's broader logistics network.</li>
                     <li>Real-time shipment tracking on our <a href="tracking.php">Tracking</a> page.</li>
                  </ul>
               </div>
               <div class="d-sm-flex gap-4 gallery-single mb-5 pt-2">
                  <img src="images/gallery/shipping-03.jpg" alt="A wrapped pallet at the loading bay, ready to fly" class="img-fluid round" loading="lazy">
                  <img src="images/gallery/shipping-07.jpg" alt="Oversized freight staged for departure" class="img-fluid round" loading="lazy">
               </div>
               <a href="quote.php" class="btn btn-primary">Request an Air Freight Quote <i class="fa fa-arrow-right"></i><span></span></a>
            </div>
         </div>
      </div>
   </div>
   <!-- Services Section End -->

<?php
$cta_eyebrow = 'Get Started';
$cta_heading = 'Need a price for an air freight shipment?';
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
