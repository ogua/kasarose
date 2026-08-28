<?php
require_once __DIR__ . '/includes/db.php';   // pulls in includes/config.php

$slug = trim($_GET['slug'] ?? '');
$post = kr_blog_post($slug);

if ($post === null) {
    // Unknown or unpublished slug — 404 rather than render an empty article, so
    // search engines don't index a shell page.
    http_response_code(404);
    $page_title = 'Article Not Found';
    $meta_description = 'The article you were looking for could not be found.';
} else {
    $page_title = $post['title'];
    // The post's own summary is a better meta description than anything generic.
    $meta_description = trim((string) $post['description']) !== ''
        ? mb_substr(strip_tags($post['description']), 0, 300)
        : 'News from KASAROSE LOGISTICS.';
}

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
                  <h1 class="display-2 text-info"><?php echo $post ? 'News' : 'Not Found'; ?></h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="news.php">News</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                           <?php echo htmlspecialchars($post ? $post['title'] : 'Not Found'); ?>
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Promo Section End -->

   <!-- Post Section Start -->
   <section class="post-single sec-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-9 mx-auto">

               <?php if ($post === null): ?>
                  <div class="text-center">
                     <h2 class="sec-title">We couldn't find that article</h2>
                     <p class="lead">It may have been removed, or the link may be incorrect.</p>
                     <a href="news.php" class="btn btn-primary mt-3">All News <i class="fa fa-arrow-right"></i><span></span></a>
                  </div>

               <?php else: ?>
                  <article>
                     <div class="post-header mb-4">
                        <div class="entry-meta d-flex gap-4 mb-3">
                           <?php if (!empty($post['category'])): ?>
                              <span><i class="fa fa-folder"></i> <?php echo htmlspecialchars($post['category']); ?></span>
                           <?php endif; ?>
                           <?php if ($when = kr_date($post['posted_at'])): ?>
                              <span><i class="fa fa-calendar"></i> <?php echo htmlspecialchars($when); ?></span>
                           <?php endif; ?>
                           <?php if (!empty($post['postedby'])): ?>
                              <span><i class="fa fa-user"></i> <?php echo htmlspecialchars($post['postedby']); ?></span>
                           <?php endif; ?>
                        </div>
                        <h2 class="sec-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                     </div>

                     <?php if (!empty($post['img'])): ?>
                        <div class="entry-thumb mb-5 round overflow-hidden">
                           <img src="<?php echo htmlspecialchars(kr_blog_image($post['img'])); ?>"
                              alt="<?php echo htmlspecialchars($post['title']); ?>" class="img-fluid w-100">
                        </div>
                     <?php endif; ?>

                     <?php if (!empty($post['description'])): ?>
                        <p class="lead"><?php echo htmlspecialchars($post['description']); ?></p>
                     <?php endif; ?>

                     <div class="post-body">
                        <?php echo kr_rich_text($post['content']); ?>
                     </div>

                     <?php if (!empty($post['references'])): ?>
                        <div class="article-footer mt-5 pt-4 border-top">
                           <h3 class="display-6">References</h3>
                           <p class="mb-0"><?php echo htmlspecialchars($post['references']); ?></p>
                        </div>
                     <?php endif; ?>

                     <div class="mt-5">
                        <a href="news.php" class="btn btn-primary">
                           <i class="fa fa-arrow-left"></i> All News<span></span>
                        </a>
                     </div>
                  </article>
               <?php endif; ?>

            </div>
         </div>
      </div>
   </section>
   <!-- Post Section End -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/scripts.php'; ?>
