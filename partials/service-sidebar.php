<?php
/**
 * Sidebar shared by the seven service detail pages.
 *
 * The five freight pages each carried their own copy of the same five-item array
 * and titled it "Our Services"; real-estate.php and property-management.php
 * hand-listed three items under "Related Services" and were the only two linking
 * back to services.php. All seven now render the full roster from
 * $site_services with the current page marked, plus an "All Services" link.
 *
 * $sidebar_cta optionally overrides the button under the contact block, for the
 * pages where a quote form isn't the right next step.
 */
$sidebar_cta = $sidebar_cta ?? ['label' => 'Request a Quote', 'href' => 'quote.php'];
$current_service = kr_current_page();
?>
               <aside class="sidebar services-sidebar">
                  <div class="widget">
                     <h3 class="widget-title">Our Services</h3>
                     <nav class="service-nav">
                        <ul>
                           <?php foreach ($site_services as $href => $label): ?>
                           <li class="<?php echo $href === $current_service ? 'active' : ''; ?>">
                              <a href="<?php echo $href; ?>"><?php echo $label; ?></a>
                              <span><i class="fa fa-arrow-right"></i></span>
                           </li>
                           <?php endforeach; ?>
                           <li><a href="services.php">All Services</a> <span><i class="fa fa-arrow-right"></i></span></li>
                        </ul>
                     </nav>
                  </div> <!-- Widget End -->
                  <div class="widget">
                     <h3 class="widget-title">Contact Info</h3>
                     <div class="social-contact">
                        <p><i class="me-2 fa fa-phone"></i> <a href="tel:<?php echo CONTACT_PHONE_US_1_TEL; ?>"><?php echo CONTACT_PHONE_US_1; ?></a></p>
                        <p><i class="me-2 fa fa-envelope-open"></i><a href="mailto:<?php echo CONTACT_EMAIL_SUPPORT; ?>"><?php echo CONTACT_EMAIL_SUPPORT; ?></a></p>
                     </div>
                     <a href="<?php echo $sidebar_cta['href']; ?>" class="btn btn-primary w-100 mt-3"><?php echo $sidebar_cta['label']; ?> <i class="fa fa-arrow-right"></i><span></span></a>
                  </div>
               </aside>
<?php unset($sidebar_cta); ?>
