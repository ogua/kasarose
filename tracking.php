<?php
$page_title = 'Track Your Shipment';
$meta_description = 'Track a KASAROSE LOGISTICS shipment — enter your tracking number or shipment reference for a live status update.';
require 'partials/head.php';
require __DIR__ . '/includes/db.php';

// A GET so results are linkable: tracking links in our emails and SMS can point
// straight at tracking.php?ref=... and land the customer on the result.
$ref       = trim($_GET['ref'] ?? '');
$searched  = $ref !== '';
$shipment  = null;
$timeline  = [];
$lookupErr = false;

if ($searched) {
    $result = kr_find_shipment($ref);
    if ($result === false) {
        $lookupErr = true;                       // database unreachable — our problem, not theirs
    } elseif ($result !== null) {
        $shipment = $result;
        $timeline = kr_shipment_timeline($ref);
    }
}

$status = $shipment ? kr_status_meta((string) $shipment['status']) : null;

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
                  <h1 class="display-2 text-info">Track Your Shipment</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tracking</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Promo Section End -->

   <!-- Tracking Section Start -->
   <section class="tracking-page sec-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-10 mx-auto">

               <div class="tracking-form-wrapper">
                  <div class="sec-intro text-center mb-0">
                     <span class="sub-title2 fadeInUp">Where Is My Shipment?</span>
                     <h2 class="sec-title">Enter Your Tracking Number</h2>
                     <p>Use the tracking number or the shipment reference on your invoice or receipt.</p>
                  </div>
                  <form method="get" action="tracking.php" class="tracking-form d-sm-flex">
                     <label for="ref" class="visually-hidden">Tracking number or shipment reference</label>
                     <input type="text" id="ref" name="ref" class="form-control"
                        value="<?php echo htmlspecialchars($ref, ENT_QUOTES); ?>"
                        placeholder="Tracking number or reference" required autofocus>
                     <button type="submit" class="btn btn-primary">
                        Track <i class="fa fa-arrow-right"></i><span></span>
                     </button>
                  </form>
               </div>

               <?php if ($lookupErr): ?>
                  <div class="alert alert-warning mt-5" role="alert">
                     <h3 class="display-6 mb-2">We can't reach our tracking system right now</h3>
                     <p class="mb-0">This is a problem on our side, not with your tracking number. Please try
                        again shortly, or <a href="contact.php">contact our team</a> and we'll look it up for
                        you.</p>
                  </div>

               <?php elseif ($searched && $shipment === null): ?>
                  <div class="alert alert-danger mt-5" role="alert">
                     <h3 class="display-6 mb-2">No shipment found</h3>
                     <p>We couldn't find a shipment matching
                        <strong><?php echo htmlspecialchars($ref); ?></strong>. Please check the number and try
                        again &mdash; it should match the tracking number or shipment reference exactly as it
                        appears on your paperwork.</p>
                     <p class="mb-0">Still stuck? <a href="contact.php">Contact our team</a> and we'll help.</p>
                  </div>

               <?php elseif ($shipment !== null): ?>
                  <div class="mt-5">
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div>
                           <p class="mb-1">Shipment</p>
                           <h2 class="display-4 mb-0">
                              <?php echo htmlspecialchars($shipment['tracking_number'] ?: $shipment['shipping_reference']); ?>
                           </h2>
                           <?php if ($shipment['tracking_number'] && $shipment['shipping_reference']): ?>
                              <p class="mb-0">Reference <?php echo htmlspecialchars($shipment['shipping_reference']); ?></p>
                           <?php endif; ?>
                        </div>
                        <span class="badge bg-<?php echo $status['class']; ?> fs-6 px-4 py-2 mt-3 mt-sm-0">
                           <i class="fa-solid <?php echo $status['icon']; ?>"></i>
                           <?php echo htmlspecialchars($status['label']); ?>
                        </span>
                     </div>

                     <?php if ($status['step'] > 0): ?>
                        <?php $stages = ['Booked' => 1, 'In Transit' => 2, 'Delivered' => 3]; ?>
                        <div class="row g-3 mb-5">
                           <?php foreach ($stages as $name => $n): $done = $status['step'] >= $n; ?>
                              <div class="col-4">
                                 <div class="progress" style="height:6px;">
                                    <div class="progress-bar<?php echo $done ? ' bg-primary' : ' bg-light'; ?>"
                                       role="progressbar" style="width:100%"
                                       aria-valuenow="<?php echo $done ? 100 : 0; ?>" aria-valuemin="0"
                                       aria-valuemax="100"></div>
                                 </div>
                                 <p class="mt-2 mb-0 small<?php echo $done ? ' fw-bold text-dark' : ' text-muted'; ?>">
                                    <?php echo $name; ?>
                                 </p>
                              </div>
                           <?php endforeach; ?>
                        </div>
                     <?php endif; ?>

                     <div class="row g-4 mb-5">
                        <?php
                        $origin = trim(($shipment['origin_name'] ?? '') . ' ' . ($shipment['origin_country'] ?? ''));
                        $dest   = trim(($shipment['destination_name'] ?? '') . ' ' . ($shipment['destination_country'] ?? ''));
                        $facts = [
                            'Origin'             => $origin ?: null,
                            'Destination'        => $dest ?: null,
                            'Shipped'            => kr_date($shipment['shipped_at']),
                            'Estimated Delivery' => kr_date($shipment['estimated_delivery_date']),
                            'Delivered'          => kr_date($shipment['delivered_at'], 'M j, Y g:i A'),
                        ];
                        foreach ($facts as $label => $value):
                            if ($value === null) {
                                continue;
                            } ?>
                           <div class="col-md-4 col-sm-6">
                              <div class="bg-shade round p-4 h-100">
                                 <p class="mb-1 small text-uppercase"><?php echo $label; ?></p>
                                 <p class="mb-0 fw-bold"><?php echo htmlspecialchars($value); ?></p>
                              </div>
                           </div>
                        <?php endforeach; ?>
                     </div>

                     <?php if ($timeline): ?>
                        <h3 class="display-5 mb-4">Status History</h3>
                        <ul class="list-unstyled">
                           <?php foreach ($timeline as $i => $event): ?>
                              <li class="d-flex gap-3 pb-4">
                                 <div class="text-center" style="flex:0 0 24px;">
                                    <span class="d-inline-block rounded-circle <?php echo $i === 0 ? 'bg-primary' : 'bg-secondary'; ?>"
                                       style="width:12px;height:12px;"></span>
                                 </div>
                                 <div>
                                    <p class="mb-1 fw-bold"><?php echo htmlspecialchars(ucfirst((string) $event['status'])); ?></p>
                                    <?php if (!empty($event['location'])): ?>
                                       <p class="mb-1"><i class="fa-solid fa-location-dot"></i>
                                          <?php echo htmlspecialchars($event['location']); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($event['note'])): ?>
                                       <p class="mb-1"><?php echo htmlspecialchars($event['note']); ?></p>
                                    <?php endif; ?>
                                    <p class="mb-0 small text-muted">
                                       <?php echo htmlspecialchars(kr_date($event['happened_at'], 'M j, Y g:i A') ?? ''); ?>
                                    </p>
                                 </div>
                              </li>
                           <?php endforeach; ?>
                        </ul>
                     <?php else: ?>
                        <p>No movement has been logged against this shipment yet. Check back once it has left
                           our facility, or <a href="contact.php">contact our team</a> for an update.</p>
                     <?php endif; ?>

                     <p class="mt-4 mb-0">Something look wrong? <a href="contact.php">Contact our team</a> and
                        quote your tracking number.</p>
                  </div>
               <?php endif; ?>

            </div>
         </div>
      </div>
   </section>
   <!-- Tracking Section End -->

<?php
$cta_eyebrow = 'Not Shipped Yet?';
$cta_heading = 'Get a quote and we&rsquo;ll take it from there.';
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
