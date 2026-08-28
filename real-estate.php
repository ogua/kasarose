<?php
$page_title = 'Real Estate';
$meta_description = 'Real estate services from KASAROSE LOGISTICS — guidance and support for buying, selling and investing in property.';
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
                  <h1 class="display-2 text-info">Real Estate</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Real Estate</li>
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
                  <img src="images/gallery/construction-1.jpg" alt="A residential development under construction, plans on site" class="img-fluid round">
               </div>
               <h2 class="display-3">Real Estate Sales &amp; Investment Guidance</h2>
               <p>Alongside our import &amp; export shipping business, KASAROSE LOGISTICS offers real estate services for
                  clients looking to buy, sell or invest in property. We provide honest, practical guidance to help
                  you make confident decisions.</p>
               <p>Every situation is different, so we start with a conversation about what you're looking for
                  rather than a one-size-fits-all pitch.</p>
               <h3 class="display-3">How We Can Help</h3>
               <div class="d-sm-flex list-single">
                  <ul class="ct-list">
                     <li>Guidance on buying &amp; selling property.</li>
                     <li>Investment property advice.</li>
                     <li>Straightforward, honest communication.</li>
                  </ul>
                  <ul class="ct-list">
                     <li>Support alongside our property management team.</li>
                     <li>Part of the broader KASAROSE LOGISTICS group.</li>
                     <li>Available across our service regions.</li>
                  </ul>
               </div>
               <a href="contact.php" class="btn btn-primary">Contact Us About Real Estate <i class="fa fa-arrow-right"></i><span></span></a>
            </div>
         </div>
      </div>
   </div>
   <!-- Services Section End -->

<?php
$cta_eyebrow = 'Let&rsquo;s Talk';
$cta_heading = 'Thinking about buying, selling or investing?';
$cta_buttons = [['label' => 'Contact Us', 'href' => 'contact.php', 'style' => 'primary']];
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
