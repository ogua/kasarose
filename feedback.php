<?php
$page_title = 'Customer Feedback';
$meta_description = 'Tell KASAROSE LOGISTICS how we did — rate your shipment, report a problem with a delivery, or send us a compliment.';
require 'partials/head.php';

// Categories carried over from the back-office feedback form, minus the mobility-only
// ones (driver conduct, tricycle maintenance, route efficiency) — those belong to
// Neoride Africa and are collected on their own site.
$feedback_categories = [
    'Delivery Speed',
    'Item Condition',
    'Late Delivery',
    'Wrong Address',
    'Damaged Item',
    'Damaged Packaging',
    'Wrong Item Sent',
    'Missing Item',
    'Ignored Instructions',
    'Other',
];

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
                  <h1 class="display-2 text-info">Customer Feedback</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Feedback</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Promo Section End -->

   <!-- Intro Section Start -->
   <section class="sec-padding pb-0">
      <div class="container">
         <div class="sec-intro mx-auto text-center">
            <span class="sub-title2 fadeInUp">We're Listening</span>
            <h2 class="sec-title">Tell Us How We Did</h2>
            <p class="lead">Whether something went wrong or someone on our team did a good job, we want to hear
               it. Feedback goes straight to our management team, and we respond to complaints directly.</p>
         </div>
         <div class="row g-4">
            <div class="col-lg-4 col-md-6">
               <div class="bg-shade round p-4 h-100 text-center">
                  <span class="icon-lg bg-primary rounded-circle text-white d-inline-flex mb-3">
                     <i class="fa-solid fa-comment-dots"></i>
                  </span>
                  <h3 class="display-6">Rate a Shipment</h3>
                  <p class="mb-0">Quote your tracking number and tell us how the delivery went.</p>
               </div>
            </div>
            <div class="col-lg-4 col-md-6">
               <div class="bg-shade round p-4 h-100 text-center">
                  <span class="icon-lg bg-primary rounded-circle text-white d-inline-flex mb-3">
                     <i class="fa-solid fa-phone-volume"></i>
                  </span>
                  <h3 class="display-6">Rather Talk?</h3>
                  <p class="mb-1"><a href="tel:<?php echo CONTACT_PHONE_US_1_TEL; ?>"><?php echo CONTACT_PHONE_US_1; ?></a> (US)</p>
                  <p class="mb-0"><a href="tel:<?php echo CONTACT_PHONE_GH_1_TEL; ?>"><?php echo CONTACT_PHONE_GH_1; ?></a> (Ghana)</p>
               </div>
            </div>
            <div class="col-lg-4 col-md-6">
               <div class="bg-shade round p-4 h-100 text-center">
                  <span class="icon-lg bg-primary rounded-circle text-white d-inline-flex mb-3">
                     <i class="fa-solid fa-envelope"></i>
                  </span>
                  <h3 class="display-6">Email Us</h3>
                  <p class="mb-0"><a href="mailto:<?php echo CONTACT_EMAIL_SUPPORT; ?>"><?php echo CONTACT_EMAIL_SUPPORT; ?></a></p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Intro Section End -->

   <!-- Feedback Form Start -->
   <section class="contact-sec sec-padding">
      <div class="container-fluid">
         <div class="row contact-form-wrap justify-content-center">
            <div class="col-lg-8">
               <div class="contact-form round"
                  style="background: url(images/form-bg2.jpg)no-repeat center center / cover;">
                  <div class="form-inner round">
                     <form id="ajax-contact" method="post" action="mailer.php">
                        <input type="hidden" name="form_type" value="feedback">
                        <div class="row">

                           <!-- Full Name -->
                           <div class="form-group col-lg-12">
                              <input type="text" id="name" name="name" class="form-control" placeholder="Your name"
                                 autocomplete="name" required>
                              <i class="fa fa-user"></i>
                           </div>

                           <!-- Email -->
                           <div class="form-group col-lg-6">
                              <input type="email" id="email" name="email" class="form-control" placeholder="Your email"
                                 autocomplete="email" required>
                              <i class="fa fa-envelope"></i>
                           </div>

                           <!-- Phone -->
                           <div class="form-group col-lg-6">
                              <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone no"
                                 autocomplete="tel" required>
                              <i class="fa fa-phone"></i>
                           </div>

                           <!-- Tracking number -->
                           <div class="form-group col-lg-6">
                              <input type="text" id="tracking_ref" name="tracking_ref" class="form-control"
                                 placeholder="Tracking number (optional)">
                              <i class="fa fa-barcode"></i>
                           </div>

                           <!-- What it's about -->
                           <div class="form-group col-lg-6 top-0">
                              <select id="feedback_about" name="feedback_about" class="form-control">
                                 <option value="">What is this about?</option>
                                 <option value="Shipping &amp; Delivery">Shipping &amp; Delivery</option>
                                 <option value="Ecommerce Package Forwarding">Ecommerce Package Forwarding</option>
                                 <option value="Warehousing">Warehousing</option>
                                 <option value="Real Estate">Real Estate</option>
                                 <option value="Property Management">Property Management</option>
                                 <option value="Something Else">Something Else</option>
                              </select>
                           </div>

                           <!-- Category -->
                           <div class="form-group col-lg-6 top-0">
                              <select id="feedback_category" name="feedback_category" class="form-control">
                                 <option value="">Category (optional)</option>
                                 <?php foreach ($feedback_categories as $category): ?>
                                    <option value="<?php echo htmlspecialchars($category); ?>">
                                       <?php echo htmlspecialchars($category); ?>
                                    </option>
                                 <?php endforeach; ?>
                              </select>
                           </div>

                           <!-- Rating -->
                           <div class="form-group col-lg-6 top-0">
                              <select id="rating" name="rating" class="form-control">
                                 <option value="">Rate us (optional)</option>
                                 <option value="5">5 &mdash; Excellent</option>
                                 <option value="4">4 &mdash; Good</option>
                                 <option value="3">3 &mdash; Okay</option>
                                 <option value="2">2 &mdash; Poor</option>
                                 <option value="1">1 &mdash; Very poor</option>
                              </select>
                           </div>

                           <!-- Message -->
                           <div class="form-group col-lg-12 top-0">
                              <textarea id="message" name="message" class="form-control" rows="6"
                                 placeholder="Tell us what happened" required></textarea>
                              <i class="fa fa-pen"></i>
                           </div>

                           <div class="col-lg-12">
                              <button type="submit" class="btn btn-primary w-100">Send Feedback <i
                                    class="fa fa-arrow-right"></i></button>
                           </div>
                           <div class="col-lg-12 mt-3">
                              <div id="form-messages"></div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Feedback Form End -->

<?php
$cta_eyebrow = 'Need Something Else?';
$cta_heading = 'A shipping question rather than feedback?';
$cta_buttons = [['label' => 'Contact Us', 'href' => 'contact.php', 'style' => 'primary']];
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
