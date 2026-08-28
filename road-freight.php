<?php
$page_title = 'Road Freight';
$meta_description = 'Road freight and last-mile delivery from KASAROSE LOGISTICS — dependable local and regional transport.';
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
                  <h1 class="display-2 text-info">Road Freight</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Road Freight</li>
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
                  <img src="images/gallery/shipping-21.jpg" alt="One of our delivery vans out on its round" class="img-fluid round">
               </div>
               <h2 class="display-3">Road Freight &amp; Last-Mile Delivery</h2>
               <p>Not every shipment needs to cross an ocean. Our road freight service covers local and regional
                  transport, including the last-mile delivery leg that gets a shipment from the port or warehouse
                  to its final destination.</p>
               <p>It's a practical complement to our air and ocean freight services, and to the package forwarding
                  we handle through ecommerce logistics.</p>
               <h3 class="display-3">Estimated Delivery Time</h3>
               <p class="mb-2"><strong><?php echo $delivery_timeframes[2]['estimate']; ?></strong>
                  &mdash; <?php echo $delivery_timeframes[2]['notes']; ?></p>
               <p>This is an estimate, not a guarantee; customs clearance, carrier schedules and weather
                  can affect transit. We confirm the delivery window for your shipment
                  <?php echo QUOTE_RESPONSE_TIME; ?> of your <a href="quote.php">quote request</a>. See our
                  <a href="delivery-policy.php">Delivery Policy</a> for full details.</p>

               <h3 class="display-3">Why Choose Our Road Freight Service</h3>
               <div class="d-sm-flex list-single">
                  <ul class="ct-list">
                     <li>Reliable local &amp; regional delivery.</li>
                     <li>Last-mile support for larger shipments.</li>
                     <li>Flexible scheduling around your timeline.</li>
                  </ul>
                  <ul class="ct-list">
                     <li>Works alongside our air &amp; ocean freight services.</li>
                     <li>Backed by our group's broader logistics network.</li>
                     <li>Real-time shipment tracking on our <a href="tracking.php">Tracking</a> page.</li>
                  </ul>
               </div>
               <div class="d-sm-flex gap-4 gallery-single mb-5 pt-2">
                  <img src="images/gallery/shipping-09.jpg" alt="A consignment wrapped for the road" class="img-fluid round" loading="lazy">
                  <img src="images/gallery/shipping-10.jpg" alt="A van loaded for the day's deliveries" class="img-fluid round" loading="lazy">
               </div>
               <a href="quote.php" class="btn btn-primary">Request a Road Freight Quote <i class="fa fa-arrow-right"></i><span></span></a>
            </div>
         </div>
      </div>
   </div>
   <!-- Services Section End -->

<?php
$cta_eyebrow = 'Get Started';
$cta_heading = 'Need cargo moved overland?';
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
