<?php
$page_title = 'Terms & Conditions';
$meta_description = 'Terms of Use and Terms & Conditions for the KASAROSE LOGISTICS website.';
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
                  <h1 class="display-2 text-info">Terms &amp; Conditions</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Terms &amp; Conditions</li>
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
         <div class="row justify-content-center">
            <div class="col-lg-9">
               <p class="text-mute">Last updated: August 20, 2026</p>

               <p>These Terms &amp; Conditions ("Terms of Use") govern your use of this website, operated by
                  KASAROSE LOGISTICS (formerly KasaBazaar Group of Companies &mdash; "we", "us"). By using this
                  website, you agree to these Terms.</p>

               <h3 class="display-5 mt-5">About This Website</h3>
               <p>This website provides information about KASAROSE LOGISTICS' door-to-door freight, import &amp;
                  export shipping, real estate and property management services, and about our sister companies
                  Neoride Africa and KROSEMARKET. Submitting a contact or quote request through this website is an
                  inquiry only
                  &mdash; it is not a binding contract, order or reservation. Any shipping quote, service pricing
                  or engagement is confirmed separately, directly with our team.</p>

               <h3 class="display-5 mt-5">Our Sister Companies</h3>
               <p>KASAROSE LOGISTICS comprises three separately operated companies:</p>
               <ul class="ct-list">
                  <li><strong>KASAROSE LOGISTICS</strong> &mdash; door-to-door air and sea freight, ecommerce package
                     forwarding, import &amp; export shipping, real estate and property management (this website).</li>
                  <li><strong>Neoride Africa</strong> &mdash; tricycle mobility and last-mile transport
                     (<a href="<?php echo SITE_URL_NEORIDE; ?>" target="_blank" rel="noopener">neorideafrica.com</a>).</li>
                  <li><strong>KROSEMARKET</strong> &mdash; the group's multi-vendor ecommerce marketplace
                     (<a href="<?php echo SITE_URL_KROSEMARKET; ?>" target="_blank" rel="noopener">krosemarket.com</a>).</li>
               </ul>
               <p>Each company holds its own contracts and its own liabilities. Links to their websites are provided
                  for your convenience; once you leave this site, your use of their websites &mdash; including buying
                  or selling on KROSEMARKET &mdash; is governed by their own terms and privacy practices, not these
                  Terms.</p>

               <h3 class="display-5 mt-5">Website Content</h3>
               <p>The text, images, logos and design on this website belong to KASAROSE LOGISTICS or are used with
                  permission, and may not be copied or reused without our consent. Service descriptions on this
                  site are provided for general information and are subject to change without notice.</p>

               <h3 class="display-5 mt-5">Acceptable Use</h3>
               <p>You agree not to misuse this website &mdash; for example, by attempting to disrupt it, submitting
                  false information through our forms, or using it for any unlawful purpose.</p>

               <h3 class="display-5 mt-5">No Warranty &amp; Limitation of Liability</h3>
               <p>This website and its content are provided "as is," without warranties of any kind. To the extent
                  permitted by law, KASAROSE LOGISTICS is not liable for any indirect or consequential loss arising
                  from your use of this website. Nothing in these Terms limits liability that cannot legally be
                  limited.</p>

               <h3 class="display-5 mt-5">Changes to These Terms</h3>
               <p>We may update these Terms from time to time. Continued use of this website after changes are
                  posted means you accept the updated Terms.</p>

               <h3 class="display-5 mt-5">Contact Us</h3>
               <p>Questions about these Terms can be sent to
                  <a href="mailto:<?php echo CONTACT_EMAIL_SUPPORT; ?>"><?php echo CONTACT_EMAIL_SUPPORT; ?></a>
                  or via our <a href="contact.php">Contact page</a>. See also our
                  <a href="privacy-policy.php">Privacy Policy</a>.</p>
            </div>
         </div>
      </div>
   </section>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
