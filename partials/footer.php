   <!-- Footer Start -->
   <footer class="footer footer-2 bg-cover jarallax" data-jarallax data-speed=".7">
      <img src="images/footer-bg.jpg" alt="" class="jarallax-img">
      <div class="parallax-overly"></div>
      <div class="container">
         <div class="row footer-widgets pt-5 gy-5">
            <div class="col-lg-3 col-12">
               <div class="footer-widget about-footer">
                  <div class="f-logo mb-3">
                     <a href="index.php" class="d-inline-block">
                        <img src="images/kasarose-logistics-logo-h-white.png" alt="<?php echo SITE_NAME; ?>" style="max-width:210px;">
                     </a>
                  </div>
                  <p>KASAROSE LOGISTICS: door-to-door air and sea freight, ecommerce package forwarding,
                     real estate and property management &mdash; alongside our sister companies Neoride Africa
                     and KROSEMARKET.</p>
               </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
               <div class="footer-widget">
                  <h3 class="widget-title">Quick Links</h3>
                  <ul>
                     <li><a href="about.php">About Us</a></li>
                     <li><a href="our-companies.php">Our Companies</a></li>
                     <li><a href="services.php">Our Services</a></li>
                     <li><a href="projects.php">Our Work</a></li>
                     <li><a href="news.php">News</a></li>
                     <li><a href="faq.php">FAQ's</a></li>
                     <li><a href="feedback.php">Feedback</a></li>
                     <li><a href="contact.php">Contact Us</a></li>
                  </ul>
               </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
               <div class="footer-widget">
                  <h3 class="widget-title">Our Companies</h3>
                  <ul>
                     <li><a href="our-companies.php">KASAROSE LOGISTICS</a></li>
                     <li><a href="<?php echo SITE_URL_NEORIDE; ?>" target="_blank" rel="noopener">Neoride Africa</a></li>
                     <li><a href="<?php echo SITE_URL_KROSEMARKET; ?>" target="_blank" rel="noopener">KROSEMARKET</a></li>
                  </ul>
               </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
               <div class="footer-widget">
                  <h3 class="widget-title">Our Services</h3>
                  <ul>
                     <?php foreach ($site_services as $href => $label): ?>
                     <li><a href="<?php echo $href; ?>"><?php echo $label; ?></a></li>
                     <?php endforeach; ?>
                  </ul>
               </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-6">
               <div class="footer-widget contact-widget">
                  <h3 class="widget-title">Get In Touch</h3>
                  <div class="opening-inner">
                     <div class="mb-3">
                        <span class="d-block">United States</span>
                        <a href="tel:<?php echo CONTACT_PHONE_US_1_TEL; ?>"><?php echo CONTACT_PHONE_US_1; ?></a><br>
                        <a href="tel:<?php echo CONTACT_PHONE_US_2_TEL; ?>"><?php echo CONTACT_PHONE_US_2; ?></a>
                     </div>
                     <div class="mb-3">
                        <span class="d-block">Ghana</span>
                        <a href="tel:<?php echo CONTACT_PHONE_GH_1_TEL; ?>"><?php echo CONTACT_PHONE_GH_1; ?></a><br>
                        <a href="tel:<?php echo CONTACT_PHONE_GH_2_TEL; ?>"><?php echo CONTACT_PHONE_GH_2; ?></a>
                     </div>
                     <div>
                        <a href="mailto:<?php echo CONTACT_EMAIL_SUPPORT; ?>"><?php echo CONTACT_EMAIL_SUPPORT; ?></a>
                     </div>
                  </div>
                  <a href="contact.php" class="btn btn-info btn-xs mt-4">Contact Us <span></span></a>
               </div>
            </div>
         </div>
      </div>
      <div class="footer-bottom">
         <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
               <p class="text-info copy-right mb-0">
                  Copyright &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All Rights Reserved.</p>
               <nav class="footer-nav">
                  <ul>
                     <li><a href="privacy-policy.php">Privacy Policy</a></li>
                     <li><a href="terms.php">Terms &amp; Conditions</a></li>
                     <li><a href="delivery-policy.php">Delivery Policy</a></li>
                     <li><a href="<?php echo ADMIN_URL; ?>" target="_blank" rel="noopener">Staff Login</a></li>
                     <li><a href="<?php echo STAFF_MAIL_URL; ?>" target="_blank" rel="noopener">Staff Mail</a></li>
                  </ul>
               </nav>
            </div>
         </div>
      </div>
   </footer>
   <!-- Footer End -->

   <!-- Scroll Top -->
   <div class="scroll-top">
      <svg class="progress-circle svg-content" height="100%" viewBox="-1 -1 102 102" width="100%">
         <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" fill="none" stroke="black" stroke-width="2"></path>
      </svg>
   </div>
