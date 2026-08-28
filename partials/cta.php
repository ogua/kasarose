<?php
/**
 * The closing call-to-action band.
 *
 * It was copy-pasted into five pages and absent from the other sixteen, so most of
 * the site simply ran out of content into the footer. Set $cta_eyebrow, $cta_heading
 * and optionally $cta_buttons before including this file:
 *
 *   $cta_eyebrow = 'Get Started';
 *   $cta_heading = 'Ready to ship?';
 *   require 'partials/cta.php';
 *
 * $cta_buttons is a list of ['label' =>, 'href' =>, 'style' => 'primary'|'outline'].
 * The default pair — Request a Quote / Contact Us — is what most pages want.
 * The variables are unset afterwards so a page including this twice can't inherit
 * the previous block's copy.
 */
$cta_eyebrow = $cta_eyebrow ?? 'Get Started';
$cta_heading = $cta_heading ?? 'Ready to ship, invest, or move smarter?';
$cta_buttons = $cta_buttons ?? [
    ['label' => 'Request a Quote', 'href' => 'quote.php',   'style' => 'primary'],
    ['label' => 'Contact Us',      'href' => 'contact.php', 'style' => 'outline'],
];
?>
   <!-- CTA Section Start -->
   <section class="video-sec2 sec-padding jarallax" data-jarallax data-speed=".2">
      <div class="parallax-overly">
         <img src="images/serv-bg2.jpg" alt="" class="jarallax-img">
      </div>
      <div class="container text-center">
         <span class="sub-title2 fadeInUp"><?php echo $cta_eyebrow; ?></span>
         <h2 class="sec-title text-info"><?php echo $cta_heading; ?></h2>
         <div class="d-flex justify-content-center gap-4 flex-wrap mt-4">
            <?php foreach ($cta_buttons as $btn): ?>
            <a href="<?php echo $btn['href']; ?>"
               class="btn <?php echo $btn['style'] === 'outline' ? 'btn-outline' : 'btn-hover btn-primary'; ?>">
               <?php echo $btn['label']; ?> <i class="fa fa-arrow-right"></i><span></span>
            </a>
            <?php endforeach; ?>
         </div>
      </div>
   </section>
   <!-- CTA Section End -->
<?php unset($cta_eyebrow, $cta_heading, $cta_buttons); ?>
