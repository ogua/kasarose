<?php
$page_title = 'Page Not Found';
$meta_description = 'The page you were looking for could not be found on the KASAROSE LOGISTICS website.';
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
                  <h1 class="display-2 text-info">Error 404</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">404 Error</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Promo Section End -->

   <section class="error-sec sec-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="error-wrap text-center mx-auto">
                  <img class="img-fluid" src="images/404.svg" alt="404">
                  <div class="errot-txt">
                     <h2 class="display-3">Oops, that page can't be found</h2>
                     <p>It looks like nothing was found at this location. Try one of the links below.</p>
                     <a href="index.php" class="btn btn-dark"><i class="fa-solid fa-house"></i> Back to Home</a>
                     <a href="contact.php" class="btn btn-primary ms-2"><i class="fa-solid fa-envelope"></i> Contact Us</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
