<?php
$page_title = 'News';
$meta_description = 'News and updates from KASAROSE LOGISTICS — shipping schedules, service announcements and company news.';
require 'partials/head.php';
require __DIR__ . '/includes/db.php';

// Posts are written by staff in the back-office Filament admin; this page only reads
// the published ones. An empty list can mean either "nothing published yet" or "the
// database is unreachable" — both are shown the same way, because neither is
// something a visitor can act on.
$posts = kr_blog_posts();

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
                  <h1 class="display-2 text-info">News</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">News</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Promo Section End -->

   <!-- Blog Section Start -->
   <section class="blog-standard sec-padding">
      <div class="container">

         <?php if (!$posts): ?>
            <div class="sec-intro mx-auto text-center">
               <h2 class="sec-title">No news just yet</h2>
               <p class="lead">We haven't published anything here yet. In the meantime, our
                  <a href="services.php">services</a> pages cover what we do, and our team is always reachable
                  on the <a href="contact.php">contact page</a>.</p>
            </div>
         <?php else: ?>
            <div class="row gy-5">
               <?php foreach ($posts as $post): ?>
                  <div class="col-lg-4 col-md-6">
                     <article class="blog-entry h-100">
                        <div class="entry-thumb">
                           <a href="news-detail.php?slug=<?php echo urlencode($post['slug']); ?>">
                              <img src="<?php echo htmlspecialchars(kr_blog_image($post['img'])); ?>"
                                 alt="<?php echo htmlspecialchars($post['title']); ?>" class="img-fluid w-100"
                                 loading="lazy">
                           </a>
                        </div>
                        <div class="entry-meta">
                           <?php if (!empty($post['category'])): ?>
                              <span><i class="fa fa-folder"></i> <?php echo htmlspecialchars($post['category']); ?></span>
                           <?php endif; ?>
                           <?php if ($when = kr_date($post['posted_at'])): ?>
                              <span><i class="fa fa-calendar"></i> <?php echo htmlspecialchars($when); ?></span>
                           <?php endif; ?>
                        </div>
                        <h3 class="display-5 mb-3">
                           <a href="news-detail.php?slug=<?php echo urlencode($post['slug']); ?>">
                              <?php echo htmlspecialchars($post['title']); ?>
                           </a>
                        </h3>
                        <?php if (!empty($post['description'])): ?>
                           <p><?php echo htmlspecialchars($post['description']); ?></p>
                        <?php endif; ?>
                        <a class="link-btn" href="news-detail.php?slug=<?php echo urlencode($post['slug']); ?>">
                           Read More <i class="fa fa-arrow-right"></i>
                        </a>
                     </article>
                  </div>
               <?php endforeach; ?>
            </div>
         <?php endif; ?>

      </div>
   </section>
   <!-- Blog Section End -->

<?php
$cta_eyebrow = 'Get Started';
$cta_heading = 'Ready to ship with us?';
require 'partials/cta.php';
?>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
