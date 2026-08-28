<?php
$page_title = 'Privacy Policy';
$meta_description = 'Privacy Policy for the KASAROSE LOGISTICS website — what information we collect through our contact and quote forms, how we use it, and how it relates to our sister companies Neoride Africa and KROSEMARKET.';
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
                  <h1 class="display-2 text-info">Privacy Policy</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
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

               <p>This Privacy Policy explains what information KASAROSE LOGISTICS (formerly KasaBazaar Group of
                  Companies &mdash; "we", "us") collects through this website, how we use it, and the choices you
                  have.</p>

               <p><strong>It applies to this website only.</strong> The group's other companies are separately
                  operated, hold their own customer data and publish their own privacy policies on their own sites:
               </p>
               <ul class="ct-list">
                  <li><strong>Neoride Africa</strong> &mdash; tricycle mobility and last-mile transport
                     (<a href="<?php echo SITE_URL_NEORIDE; ?>" target="_blank" rel="noopener">neorideafrica.com</a>).</li>
                  <li><strong>KROSEMARKET</strong> &mdash; the group's ecommerce marketplace
                     (<a href="<?php echo SITE_URL_KROSEMARKET; ?>" target="_blank" rel="noopener">krosemarket.com</a>).
                     If you have shopped or sold there, that account and its order history are governed by the
                     KROSEMARKET privacy policy, not this one.</li>
               </ul>

               <h3 class="display-5 mt-5">Information We Collect</h3>
               <p>We only collect information you choose to give us directly through this website's forms:</p>
               <ul class="ct-list">
                  <li>Contact form: your name, email address, phone number and message.</li>
                  <li>Quote request form: your name, email address, phone number, and shipment details you provide
                     (such as service type, weight, dimensions, origin and destination).</li>
               </ul>
               <p>We do not use tracking cookies, analytics scripts, or advertising pixels on this website beyond
                  what your browser sends automatically as part of a normal page request (such as your IP address
                  and browser type, visible only in standard web server logs).</p>

               <h3 class="display-5 mt-5">Shipment Tracking</h3>
               <p>Our <a href="tracking.php">Tracking</a> page does not ask you to create an account or log in.
                  When you enter a tracking number or shipment reference, we look that number up in our shipment
                  records and show you the status of that one shipment: its reference, its current status, the
                  branches it is travelling between, the dates it moved, and any status notes our staff have
                  recorded against it.</p>
               <p>We deliberately do not show anything else held against a shipment &mdash; no sender or recipient
                  names, no addresses, no contents, and no prices or payment information. Anyone holding the
                  tracking number can see the status, so treat your tracking number as you would any other
                  reference to your shipment. We do not store the numbers you type into the tracking form beyond
                  ordinary web server logs.</p>

               <h3 class="display-5 mt-5">How We Use Your Information</h3>
               <p>Information submitted through our forms is used only to respond to your inquiry or quote
                  request &mdash; for example, to call or email you back, or to prepare a shipping quote. We do not
                  sell your information.</p>

               <p>Freight and shipping inquiries are handled by us directly. We share your information with
                  another company in the group only where that is necessary to answer you &mdash; passing a mobility
                  question to Neoride Africa, or a marketplace order question to KROSEMARKET. We share the minimum
                  needed to handle the request, and marketing lists are never shared between group companies.</p>

               <h3 class="display-5 mt-5">How We Store &amp; Protect Your Information</h3>
               <p>Form submissions are sent by email to our support team. We take reasonable steps to protect the
                  information you share with us, but no method of electronic transmission or storage is completely
                  secure, and we cannot guarantee absolute security.</p>

               <h3 class="display-5 mt-5">Your Choices</h3>
               <p>You can ask us what information we hold about you, ask us to correct it, or ask us to delete it,
                  by emailing <a href="mailto:<?php echo CONTACT_EMAIL_SUPPORT; ?>"><?php echo CONTACT_EMAIL_SUPPORT; ?></a>.
                  We will respond to reasonable requests within a reasonable timeframe.</p>

               <h3 class="display-5 mt-5">Children's Privacy</h3>
               <p>This website is intended for businesses and individuals seeking shipping, real estate or
                  property management services, and is not directed at children. We do not knowingly collect
                  information from children.</p>

               <h3 class="display-5 mt-5">Changes to This Policy</h3>
               <p>We may update this Privacy Policy from time to time. Changes will be posted on this page with an
                  updated "Last updated" date.</p>

               <h3 class="display-5 mt-5">Contact Us</h3>
               <p>Questions about this Privacy Policy can be sent to
                  <a href="mailto:<?php echo CONTACT_EMAIL_SUPPORT; ?>"><?php echo CONTACT_EMAIL_SUPPORT; ?></a>
                  or via our <a href="contact.php">Contact page</a>.</p>
            </div>
         </div>
      </div>
   </section>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
