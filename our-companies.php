<?php
$page_title = 'Our Companies';
$meta_description = 'The three companies of KASAROSE LOGISTICS: KASAROSE LOGISTICS (freight, real estate, property management), Neoride Africa (mobility) and KROSEMARKET (ecommerce marketplace).';
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
                  <h1 class="display-2 text-info">Our Companies</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Our Companies</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Promo Section End -->

   <section class="sec-padding">
      <div class="container">
         <div class="sec-intro mx-auto text-center">
            <span class="sub-title2 fadeInUp">One Group, Three Companies</span>
            <h2 class="sec-title">The KASAROSE LOGISTICS Group</h2>
            <p class="lead">Three companies, one group &mdash; each focused on a different way of moving people,
               goods and property forward.</p>
         </div>
      </div>
   </section>

   <!-- KASAROSE LOGISTICS -->
   <section class="about-sec2 overflow-hidden pt-0 sec-padding">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-6">
               <div class="company-media round">
                  <img src="images/gallery/shipping-01.jpg" alt="Loading a KASAROSE container for export">
               </div>
            </div>
            <div class="col-lg-6 ps-lg-5 mt-5 mt-lg-0">
               <div class="about-content">
                  <span class="sub-title2 fadeInUp single">The Founding Company</span>
                  <h2 class="sec-title">KASAROSE LOGISTICS</h2>
                  <p class="text-primary fw-bold">Your Trusted Partner for Global Shipments.</p>
                  <p class="lead">Our founding company, incorporated in 2020 and known as KasaBazaar until 2026. We
                     move freight door to door between the United States and Ghana &mdash; the business we ran for
                     years as Rose Door-to-Door Shipping &amp; Delivery &mdash; alongside real estate sales and
                     property management.</p>
                  <ul class="check">
                     <li>Air &amp; sea freight, door to door</li>
                     <li>Ecommerce shipments from Amazon, eBay, Walmart &amp; Best Buy</li>
                     <li>Real-time shipment tracking</li>
                     <li>Real estate sales &amp; investment guidance</li>
                     <li>Day-to-day property management</li>
                  </ul>
                  <a href="services.php" class="btn btn-primary">View Our Services <i class="fa fa-arrow-right"></i><span></span></a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- Neoride Africa -->
   <section class="about-sec2 overflow-hidden sec-padding bg-shade">
      <div class="container">
         <div class="row align-items-center flex-lg-row-reverse">
            <div class="col-lg-6">
               <div class="company-media round">
                  <img src="images/road.jpg" alt="Neoride Africa">
               </div>
            </div>
            <div class="col-lg-6 pe-lg-5 mt-5 mt-lg-0">
               <div class="about-content">
                  <span class="sub-title2 fadeInUp single">Our Mobility Company</span>
                  <h2 class="sec-title">Neoride Africa</h2>
                  <p class="text-primary fw-bold">Driving Africa's Mobility Revolution.</p>
                  <p class="lead">Operating in Ghana since 2025, Neoride Africa provides tricycle mobility solutions
                     focused on affordable rides, first- and last-mile connectivity, and youth employment. Based in
                     Adako Jachie, Ejisu, Kumasi, Ghana.</p>
                  <ul class="check">
                     <li>Smart tricycle &amp; electric tricycle solutions</li>
                     <li>First- and last-mile connectivity</li>
                     <li>Youth employment &amp; entrepreneurship programs</li>
                  </ul>
                  <a href="<?php echo SITE_URL_NEORIDE; ?>" target="_blank" rel="noopener" class="btn btn-primary">Visit
                     neorideafrica.com <i class="fa fa-arrow-right"></i><span></span></a>
               </div>
            </div>
         </div>
      </div>
   </section>


   <!-- KROSEMARKET -->
   <section class="about-sec2 overflow-hidden sec-padding">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-6">
               <div class="company-media company-media-logo round">
                  <img src="<?php echo htmlspecialchars($group_companies[2]['logo']); ?>" alt="KROSEMARKET logo">
               </div>
            </div>
            <div class="col-lg-6 ps-lg-5 mt-5 mt-lg-0">
               <div class="about-content">
                  <span class="sub-title2 fadeInUp single">Our Ecommerce Marketplace</span>
                  <h2 class="sec-title">KROSEMARKET</h2>
                  <p class="text-primary fw-bold">Ghana's multi-vendor marketplace, delivered.</p>
                  <p class="lead">KROSEMARKET is the group's retail arm &mdash; an online marketplace where vetted
                     Ghanaian vendors sell direct to shoppers nationwide. Payment is held until delivery, and orders
                     move on the group's own logistics network, so a small seller can reach the whole country without
                     owning a single vehicle.</p>
                  <ul class="check">
                     <li>Thousands of products from vetted local vendors</li>
                     <li>One cart across multiple vendors, one payment</li>
                     <li>Nationwide delivery carried by KASAROSE LOGISTICS and Neoride Africa</li>
                  </ul>
                  <a href="<?php echo SITE_URL_KROSEMARKET; ?>" target="_blank" rel="noopener" class="btn btn-primary">Visit
                     krosemarket.com <i class="fa fa-arrow-right"></i><span></span></a>
               </div>
            </div>
         </div>
      </div>
   </section>

<?php
$cta_eyebrow = 'Questions?';
$cta_heading = 'Not sure which company can help? Just ask us.';
$cta_buttons = [['label' => 'Contact Us', 'href' => 'contact.php', 'style' => 'primary']];
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
