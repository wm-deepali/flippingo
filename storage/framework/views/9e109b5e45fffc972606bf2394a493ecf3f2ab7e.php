

<?php $__env->startSection('title'); ?>
  <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<style>
  .purchase-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 20px;
    width: 100%;
    max-width: 360px;
    font-family: 'Inter', sans-serif;
  }

  .purchase-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
  }

  /* Price Section */
  .purchase-price-box {
    background: linear-gradient(135deg, #e0f0ff, #f0f8ff);
    border-radius: 10px;
    padding: 16px;
    margin-bottom: 20px;
    text-align: center;
  }

  .purchase-price {
    font-size: 28px;
    font-weight: 700;
    color: #1a73e8;
    margin: 0;
  }

  .purchase-secure {
    margin: 6px 0 2px;
    font-size: 14px;
    font-weight: 600;
    color: #444;
  }

  .purchase-note {
    font-size: 12px;
    color: #666;
    display: block;
  }

  /* Wallet Box */
  .purchase-wallet-box {
    background: #f0f7ff;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 15px;
  }

  .purchase-wallet-title {
    font-size: 14px;
    font-weight: 600;
    color: #444;
    margin: 0 0 4px;
  }

  .purchase-wallet-amount {
    font-size: 16px;
    font-weight: 700;
    color: #1a73e8;
  }

  /* Warning Box */
  .purchase-warning-box {
    background: #fff7e6;
    border: 1px solid #ffcd94;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 15px;
  }

  .purchase-warning-title {
    font-size: 14px;
    font-weight: 600;
    color: #d97706;
    margin: 0 0 6px;
  }

  .purchase-warning-text {
    font-size: 13px;
    color: #555;
  }

  /* Buttons */
  .purchase-btn {
    width: 100%;
    background: #1a73e8;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
    margin-bottom: 12px;
  }

  .purchase-btn:hover {
    background: #1557b0;
  }

  .purchase-wishlist-btn {
    width: 100%;
    background: #f9fafb;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    cursor: pointer;
    transition: background 0.3s;
  }

  .purchase-wishlist-btn:hover {
    background: #f1f1f1;
  }

  .performance-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px;
    font-family: 'Inter', sans-serif;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
  }

  .performance-title {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    display: inline-block;
    background: #1a73e8;
    color: #fff;
    padding: 6px 14px;
    border-radius: 6px;
  }

  .performance-metrics {
    display: flex;
    gap: 16px;
    margin-bottom: 15px;
  }

  .performance-box {
    flex: 1;
    text-align: center;
    border-radius: 10px;
    padding: 18px 12px;
    min-height: 120px;
  }

  .performance-revenue {
    background: #eafbf0;
    color: #166534;
  }

  .performance-visitors {
    background: #eef5ff;
    color: #1a56db;
  }

  .performance-icon {
    font-size: 28px;
    margin-bottom: 8px;
  }

  .performance-value {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
  }

  .performance-label {
    font-size: 13px;
    color: #555;
  }

  .performance-footer {
    border-top: 1px solid #eee;
    padding-top: 10px;
    font-size: 13px;
    color: #666;
  }

  .performance-footer span {
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
  }

  .seller-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 18px;
    font-family: 'Inter', sans-serif;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
    margin-top: 20px;
  }

  .seller-title {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin-bottom: 12px;
  }

  .seller-box {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #f5f7ff;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
  }

  .seller-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }

  .seller-details {
    flex: 1;
  }

  .seller-name {
    font-size: 15px;
    font-weight: 600;
    margin: 0;
  }

  .seller-status {
    font-size: 13px;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 500;
  }

  .seller-status.online {
    background: #e6f7f0;
    color: #16a34a;
  }

  .seller-status.offline {
    background: #f2f4f7;
    color: #555;
  }

  .seller-rating {
    background: #fff9f3;
    border-radius: 10px;
    padding: 12px;
  }

  .seller-rating-header {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .seller-rating-header span {
    font-weight: 400;
    color: #555;
  }

  .seller-rating-breakdown {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .seller-rating-row {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
  }

  .seller-bar {
    flex: 1;
    height: 6px;
    background: #eee;
    border-radius: 4px;
    overflow: hidden;
  }

  .seller-fill {
    height: 100%;
    background: #fbbf24;
  }

  .seller-info-card {
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 15px;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    max-width: 350px;
  }

  .seller-header {
    display: flex;
    align-items: center;
    gap: 15px;
  }

  .seller-photo {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
  }

  .seller-details {
    flex: 1;
  }

  .seller-name {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .verified-tag {
    background: #28a745;
    color: #fff;
    font-size: 12px;
    padding: 2px 6px;
    border-radius: 5px;
  }

  .seller-location {
    margin: 5px 0 0;
    font-size: 14px;
    color: #666;
  }

  .seller-location i {
    color: #d33;
    margin-right: 5px;
  }

  .seller-meta {
    margin-top: 15px;
  }

  .meta-box {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 8px 12px;
    text-align: center;
    border: 1px solid #eee;
  }

  .meta-box small {
    display: block;
    font-size: 12px;
    color: #888;
  }

  .meta-box p {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
  }
</style>
<?php $__env->startSection('content'); ?>
    <?php
  $isLoggedIn = Auth::guard('customer')->check();
    ?>

    <?php
  $submittedValues = json_decode($submission->data, true) ?? [];

  $productTitle = $submittedValues['product_title']['value'] ?? 'No Title';
  $offeredPrice = $submittedValues['offered_price']['value'] ?? '0';
  $mrp = $submittedValues['mrp']['value'] ?? 0;
  $discount = $submittedValues['discount']['value'] ?? 0;

    ?>


    <!-- ================================
                                                                                START CARD AREA
                                                                              ================================= -->
    <div class="page-wrapper" style="position: relative;">

      <?php if(!$isLoggedIn): ?>
        <div class="blur-overlay" style="
                                                                                            position: fixed;
                                                                                            inset: 0;
                                                                                            background: rgba(255,255,255,0.7);
                                                                                            backdrop-filter: blur(8px);
                                                                                            z-index: 9999;
                                                                                            display: flex;
                                                                                            justify-content: center;
                                                                                            align-items: center;
                                                                                            font-size: 1.5rem;
                                                                                            color: #333;
                                                                                            pointer-events: auto;
                                                                                          ">
          Please <a href="<?php echo e(route('authentication-signin')); ?>" style="color: #007bff; text-decoration: underline;">login</a>
          to view
          this content.
        </div>
      <?php endif; ?>



      <section class="card-area padding-top-60px padding-bottom-90px" style="margin-top: 150px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mb-4">
              <div class="listing-wrapper ">

                <!-- end listing-single-panel -->
                <div class="listing-single-panel mb-5 ">

                  <h1 class="product-title mb-3"><?php echo e($productTitle); ?></h1>

                  <div class="gallery-carousel owl-carousel owl-theme border">
                    <?php $__currentLoopData = $submission->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(in_array(pathinfo($file->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp'])): ?>
                        <div class="gallery-item">
                          <img src="<?php echo e(asset('storage/' . $file->file_path)); ?>"
                            alt="<?php echo e($file->original_name ?? 'gallery image'); ?>" />
                        </div>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>

                  <div class="d-flex justify-content-between">
                    <p style="color: blue;">ID: <?php echo e($submission->id); ?></p>
                    <p style="color: blue;">Published: <?php echo e($submission->created_at->format('F d, Y')); ?></p>
                    <p style="color: blue;">Views: <?php echo e($submission->views ?? 0); ?></p>
                  </div>

                </div>

                <div class="details-card">
                  <?php
  $assocFields = [];
  foreach ($fields as $field) {
    $assocFields[$field['id']] = $field;
  }
                  ?>

                  <?php if(isset($layout) && is_array($layout) && $assocFields): ?>
                 <?php $__currentLoopData = $layout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $field = $assocFields[$fieldId] ?? null;
      if (!$field) continue;

      $type = $field['type'] ?? 'text';

      if ($type === 'heading') {
          // Show heading only once
          $label = $field['properties']['text'] ?? '';
      } elseif ($type === 'paragraph') {
          // Show paragraph only once
          $label = $field['properties']['text'] ?? '';
      } else {
          // Normal fields with label and value
          $label = $field['properties']['label'] ?? $field['label'] ?? '';
          $FieldData = $submittedValues[$fieldId] ?? null;
          $value = is_array($FieldData) ? ($FieldData['value'] ?? '') : '';
      }
    ?>

    <?php if($type === 'heading'): ?>
      <h4 class="font-size-26 font-weight-semi-bold mb-2 mt-2"><?php echo e($label); ?></h4>
    <?php elseif($type === 'paragraph'): ?>
      <p class="mb-3"><?php echo e($label); ?></p>
    <?php else: ?>
      <button class="details-card-button"><?php echo e($label); ?>: <?php echo e($value); ?></button>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                  <?php else: ?>
                    <p>No details available.</p>
                  <?php endif; ?>
                </div>



                <!-- end listing-single-panel -->
                <?php $videoExtensions = ['mp4', 'webm', 'ogg'];
                ?>

                <?php $__currentLoopData = $submission->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
    $ext = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                  ?>
                  <?php if(in_array($ext, $videoExtensions)): ?>
                    <section class="listing-single-panel mb-5">
                      <h4 class="font-size-20 font-weight-semi-bold mb-3">Video</h4>
                      <div class="video-box text-center position-relative">
                        <div class="overlay z-index-0 rounded"></div>
                        <video controls width="100%" height="400" class="rounded">
                          <source src="<?php echo e(asset('storage/' . $file->file_path)); ?>" type="video/<?php echo e($ext); ?>">
                          Your browser does not support the video tag.
                        </video>
                      </div>
                    </section>
                    <?php break; ?> 
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- end listing-single-panel -->

                <!-- end listing-single-panel -->
                <!-- <div class="listing-single-panel mb-5">
                                              <h4 class="font-size-20 font-weight-semi-bold mb-4">
                                                Customer feedback
                                              </h4>
                                              <div class="rating-content row mb-4">
                                                <div class="col-lg-4 align-self-center">
                                                  <div class="rating-summary text-center border-right border-right-gray">
                                                    <span class="rating-total">4.5</span>
                                                    <span class="rating-percent d-block my-2">out of 5.0</span>
                                                    <div class="star-rating d-inline-block" data-rating="4.5"></div>
                                                  </div>
                                                </div>
                                                <div class="col-lg-8">
                                                  <div class="mb-2 d-flex align-items-center">
                                                    <span class="progress-bar-text text-uppercase me-2">5 starts</span>
                                                    <div class="progress flex-grow-1">
                                                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="85"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                  </div>
                                                  <div class="mb-2 d-flex align-items-center">
                                                    <span class="progress-bar-text text-uppercase me-2">4 starts</span>
                                                    <div class="progress flex-grow-1">
                                                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="75"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                  </div>
                                                  <div class="mb-2 d-flex align-items-center">
                                                    <span class="progress-bar-text text-uppercase me-2">3 starts</span>
                                                    <div class="progress flex-grow-1">
                                                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="65"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                  </div>
                                                  <div class="mb-2 d-flex align-items-center">
                                                    <span class="progress-bar-text text-uppercase me-2">2 starts</span>
                                                    <div class="progress flex-grow-1">
                                                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="50"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                  </div>
                                                  <div class="mb-2 d-flex align-items-center">
                                                    <span class="progress-bar-text text-uppercase me-2">1 starts</span>
                                                    <div class="progress flex-grow-1">
                                                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="4" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="reviews">
                                                <h4 class="font-size-20 font-weight-semi-bold mb-4">
                                                  Reviews <span class="badge badge-light">(5)</span>
                                                </h4>
                                                <div class="comments-wrapper">
                                                  <div class="comment media mb-5">
                                                    <a href="<?php echo e(Route('user-profile')); ?>" class="user-avatar flex-shrink-0 d-block me-3">
                                                      <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="author-img" />
                                                    </a>
                                                    <div class="comment-body media-body">
                                                      <div class="d-flex align-items-center justify-content-between">
                                                        <div class="pe-2">
                                                          <h4 class="comment-title">
                                                            <a href="<?php echo e(Route('user-profile')); ?>">Adam Smith</a>
                                                          </h4>
                                                          <span class="comment-meta">San Francisco, CA</span>
                                                        </div>
                                                        <div class="star-rating" data-rating="4"></div>
                                                      </div>
                                                      <p class="comment-desc mt-2">
                                                        It is a long established fact that a reader will be
                                                        distracted by the readable content of a page when
                                                        looking at its layout.
                                                      </p>
                                                      <div class="review-photos d-flex flex-wrap align-items-center mt-3">
                                                        <a href="<?php echo e(asset('assets')); ?>/images/img1.jpg" class="d-inline-block"
                                                          data-fancybox="review-gallery">
                                                          <img class="lazy" src="<?php echo e(asset('assets')); ?>/images/img-loading.jpg"
                                                            data-src="<?php echo e(asset('assets')); ?>/images/img1.jpg" alt="review image" />
                                                        </a>
                                                        <a href="<?php echo e(asset('assets')); ?>/images/img2.jpg" class="d-inline-block"
                                                          data-fancybox="review-gallery">
                                                          <img class="lazy" src="<?php echo e(asset('assets')); ?>/images/img-loading.jpg"
                                                            data-src="<?php echo e(asset('assets')); ?>/images/img2.jpg" alt="review image" />
                                                        </a>
                                                      </div>
                                                      <div class="comment-actions d-flex align-items-center justify-content-between mt-3">
                                                        <a class="btn-link" href="#">
                                                          <i class="fas fa-reply me-1"></i> Reply
                                                        </a>
                                                        <div class="feedback-box">
                                                          <button type="button" class="theme-btn theme-btn-sm">
                                                            <i class="fal fa-thumbs-up me-1"></i> Helpful
                                                          </button>
                                                          <button type="button" class="theme-btn theme-btn-sm">
                                                            <i class="fal fa-smile me-1"></i> Funny
                                                          </button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="comment media mb-5 comment-reply">
                                                    <div class="comment-body media-body">
                                                      <h4 class="comment-title">Kamran Adi</h4>
                                                      <span class="comment-meta">Business owner</span>
                                                      <p class="comment-desc mt-2">
                                                        It is a long established fact that a reader will be
                                                        distracted by the readable content of a page when
                                                        looking at its layout.
                                                      </p>
                                                    </div>
                                                  </div>
                                                  <div class="comment media mb-5">
                                                    <a href="<?php echo e(Route('user-profile')); ?>" class="user-avatar flex-shrink-0 d-block me-3">
                                                      <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="author-img" />
                                                    </a>
                                                    <div class="comment-body media-body">
                                                      <div class="d-flex align-items-center justify-content-between">
                                                        <div class="pe-2">
                                                          <h4 class="comment-title">
                                                            <a href="<?php echo e(Route('user-profile')); ?>">Adam Smith</a>
                                                          </h4>
                                                          <span class="comment-meta">San Francisco, CA</span>
                                                        </div>
                                                        <div class="star-rating" data-rating="4"></div>
                                                      </div>
                                                      <p class="comment-desc mt-2">
                                                        It is a long established fact that a reader will be
                                                        distracted by the readable content of a page when
                                                        looking at its layout.
                                                      </p>
                                                      <div class="review-photos d-flex flex-wrap align-items-center mt-3">
                                                        <a href="<?php echo e(asset('assets')); ?>/images/img3.jpg" class="d-inline-block"
                                                          data-fancybox="review-gallery-two">
                                                          <img class="lazy" src="<?php echo e(asset('assets')); ?>/images/img-loading.jpg"
                                                            data-src="<?php echo e(asset('assets')); ?>/images/img3.jpg" alt="review image" />
                                                        </a>
                                                      </div>
                                                      <div class="comment-actions d-flex align-items-center justify-content-between mt-3">
                                                        <a class="btn-link" href="#">
                                                          <i class="fas fa-reply me-1"></i> Reply
                                                        </a>
                                                        <div class="feedback-box">
                                                          <button type="button" class="theme-btn theme-btn-sm">
                                                            <i class="fal fa-thumbs-up me-1"></i> Helpful
                                                          </button>
                                                          <button type="button" class="theme-btn theme-btn-sm">
                                                            <i class="fal fa-smile me-1"></i> Funny
                                                          </button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <hr class="border-top-gray mt-0" />
                                                <nav aria-label="Page navigation example">
                                                  <ul class="pagination justify-content-center pagination-list">
                                                    <li class="page-item">
                                                      <a class="page-link" href="#" aria-label="Previous">
                                                        <span aria-hidden="true" class="fal fa-angle-left"></span>
                                                        <span class="sr-only">Previous</span>
                                                      </a>
                                                    </li>
                                                    <li class="page-item active">
                                                      <a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item">
                                                      <a class="page-link" href="#">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                      <a class="page-link" href="#">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                      <a class="page-link" href="#" aria-label="Next">
                                                        <span aria-hidden="true" class="fal fa-angle-right"></span>
                                                        <span class="sr-only">Next</span>
                                                      </a>
                                                    </li>
                                                  </ul>
                                                </nav>
                                              </div>
                                            </div>
                                            <div class="listing-single-panel">
                                              <h4 class="font-size-20 font-weight-semi-bold mb-1">
                                                Add a Review
                                              </h4>
                                              <p class="font-size-15">
                                                Your email address will not be published. Required fields are
                                                marked *
                                              </p>
                                              <hr class="border-top-gray my-4" />
                                              <div class="add-review-wrap" id="review">
                                                <form class="leave-rating">
                                                  <input type="radio" name="rating" id="rating-1" value="1" />
                                                  <label for="rating-1" class="fas fa-star"></label>
                                                  <input type="radio" name="rating" id="rating-2" value="2" />
                                                  <label for="rating-2" class="fas fa-star"></label>
                                                  <input type="radio" name="rating" id="rating-3" value="3" />
                                                  <label for="rating-3" class="fas fa-star"></label>
                                                  <input type="radio" name="rating" id="rating-4" value="4" />
                                                  <label for="rating-4" class="fas fa-star"></label>
                                                  <input type="radio" name="rating" id="rating-5" value="5" />
                                                  <label for="rating-5" class="fas fa-star"></label>
                                                </form>
                                                <form method="post" class="row mt-4">
                                                  <div class="col-lg-6 col-md-6">
                                                    <label class="label-text">Name</label>
                                                    <div class="form-group">
                                                      <span class="fal fa-user form-icon"></span>
                                                      <input class="form-control form--control" type="text" name="name" placeholder="Your Name" />
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-6 col-md-6">
                                                    <label class="label-text">Email</label>
                                                    <div class="form-group">
                                                      <span class="fal fa-envelope form-icon"></span>
                                                      <input class="form-control form--control" type="email" name="email" placeholder="Email Address" />
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-12">
                                                    <label class="label-text">Review</label>
                                                    <div class="form-group">
                                                      <textarea class="form-control form--control ps-3" rows="5" name="message"
                                                        placeholder="Tell about your experience or leave a tip for others"></textarea>
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-12">
                                                    <div class="file-upload-wrap file-upload-wrap-layout-2">
                                                      <input type="file" name="files[]" class="multi file-upload-input with-preview" multiple />
                                                      <span class="file-upload-text"><i class="fal fa-image me-2"></i>Add Photos</span>
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-12">
                                                    <button class="theme-btn border-0" type="submit">
                                                      Submit Review
                                                    </button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div> -->
              </div>
              <div class="performance-card">
                <h3 class="performance-title"> Performance Metrics</h3>

                <div class="performance-metrics">
                  <!-- Revenue Box -->

                   <?php if(!empty($summaryFields)): ?>
                                                    <?php $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    ?>

    <?php if(!empty($textFields)): ?>
        <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="performance-box performance-revenue">
                      <div class="performance-icon"><i class="<?php echo e($field['icon'] ?? ''); ?>"></i></div>
                    <p class="performance-value"><?php echo e($field['value'] ?? 'Not disclosed'); ?></p>
                    <span class="performance-label"><?php echo e($field['label'] ?? ''); ?></span>
                  </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>
<?php endif; ?>
                  <!-- <div class="performance-box performance-revenue">
                    <div class="performance-icon">$</div>
                    <p class="performance-value">Not disclosed</p>
                    <span class="performance-label">Monthly Revenue</span>
                  </div> -->

                  <!-- Visitors Box -->
                  <!-- <div class="performance-box performance-visitors">
                    <div class="performance-icon">👥</div>
                    <p class="performance-value">Not disclosed</p>
                    <span class="performance-label">Monthly Visitors</span>
                  </div> -->
                </div>

                <!-- Footer Note -->
                <div class="performance-footer">
                  <span>📊 Performance Data</span>
                  <p>These metrics are self-reported by the seller and represent recent performance. Actual results may
                    vary.</p>
                </div>
              </div>

            </div>
            <div class="col-lg-4">
              <div class="sidebar">

                <!--<div class="card">-->
                <!--  <div class="card-body">-->
                <!--    <h4 class="card-title border-bottom pb-3"-->
                <!--      style="font-size: 30px; font-weight: 700; padding-left: 20px;">-->
                <!--      ₹<?php echo e(number_format($offeredPrice)); ?></h4>-->

                <!-- end form-group -->

                <!-- end form-group -->

                <!--    <div class="card-body">-->

                <!--      <div class="media mt-4">-->
                <!--        <img src="<?php echo e(asset('storage/' . ($submission->customer->profile_pic ?? 'defaults/avatar.png'))); ?>"-->
                <!--          alt="avatar" class="user-avatar flex-shrink-0 me-3" />-->
                <!--        <div class="media-body align-self-center">-->
                <!--          <h4 class="font-size-18 font-weight-semi-bold mb-1">-->
                <!--            <a href="<?php echo e(Route('user-profile')); ?>" class="btn-link text-black">-->
                <!--              <?php echo e($submission->customer->first_name ?? '-'); ?>-->
                <!--              <?php echo e($submission->customer->last_name ?? '-'); ?></a>-->
                <!--          </h4>-->
                <!--          <p class="font-size-14">-->
                <!--            Member since: <?php echo e($submission->customer->created_at->diffForHumans()); ?>-->
                <!--          </p>-->

                <!--          <p class="font-size-14">Account Type: <?php echo e($submission->customer->account_type); ?></p>-->
                <!--        </div>-->
                <!--      </div>-->

                <!--    </div>-->
                <!-- end card-body -->

                <!-- end quantity-wrap -->
                <!--    <div class="d-flex gap-3">-->
                <!--      <a href="" class="theme-btn w-50" data-bs-toggle="modal" data-bs-target="#shareModal">Chat</a>-->
                <!--      <a id="enquireBtn" class="theme-btn w-50" type="button" data-bs-toggle="modal"-->
                <!--        data-bs-target="#enquiryModal">Send Enquiry</a>-->
                <!--    </div>-->
                <!--  </div>-->
                <!-- end card-body -->
                <!--</div>-->
                <!-- end card -->

                <!-- end card -->


                <!--<div class="card">-->
                <!--  <div class="card-body">-->
                <!--    <h4 class="card-title mb-3">Hosted by</h4>-->
                <!--    <div class="media mt-4">-->
                <!--      <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="avatar"-->
                <!--        class="user-avatar flex-shrink-0 me-3" />-->
                <!--      <div class="media-body align-self-center">-->
                <!--        <h4 class="font-size-18 font-weight-semi-bold mb-1">-->
                <!--          <a href="<?php echo e(Route('user-profile')); ?>" class="btn-link text-black">Mark Hardson</a>-->
                <!--        </h4>-->
                <!--        <p class="font-size-14">20 listing hosted</p>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--    <ul class="list-items mt-4">-->
                <!--      <li>-->
                <!--        <span-->
                <!--          class="fal fa-envelope icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span><a-->
                <!--          href="mailto:example@gmail.com">example@gmail.com</a>-->
                <!--      </li>-->
                <!--      <li>-->
                <!--        <span-->
                <!--          class="fal fa-phone icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span>-->
                <!--        +7(111)123456789-->
                <!--      </li>-->
                <!--      <li>-->
                <!--        <span-->
                <!--          class="fal fa-external-link icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span><a-->
                <!--          href="#">www. Flippingo.com</a>-->
                <!--      </li>-->
                <!--    </ul>-->
                <!--  </div>-->
                <!-- end card -->
                <!--</div>-->

                <?php
  $offeredPrice = (float) ($submittedValues['offered_price']['value'] ?? 0);
   $requiredAmount = max(0, $offeredPrice - $walletBalance);
                ?>

                <!--<div class="card mt-4">-->
                <!--  <div class="card-body">-->
                <!--    <button class="btn btn-primary w-100 mb-2">Add Funds to Wallet</button>-->

                <!--    <?php if($walletBalance < $offeredPrice): ?>-->
                <!--      <div class="alert alert-warning p-3 mb-3 d-flex flex-column align-items-start" role="alert"-->
                <!--        style="border-radius: 5px;">-->
                <!--        <strong>Insufficient Balance</strong>-->
                <!--        <small>Your wallet balance is ₹<?php echo e(number_format($walletBalance, 2)); ?>.</small>-->
                <!--        <a href="#" class="btn btn-link p-0 mt-1">Add Balance</a>-->
                <!--      </div>-->
                <!--    <?php endif; ?>-->
                <!--    <a href="<?php echo e(route('checkout', ['submission_id' => $submission->id])); ?>"-->
                <!--      class="btn btn-success w-100 mb-2">Buy Online</a>-->
                <!--    <button class="btn btn-outline-secondary w-100">Add to Wishlist</button>-->
                <!--  </div>-->
                <!--</div>-->

                <!-- end sidebar -->
              </div>
              <div class="purchase-card">
                <h3 class="purchase-title">Purchase Options</h3>

                <!-- Price Box -->
                <div class="purchase-price-box">
                  <p class="purchase-price">₹<?php echo e(number_format($offeredPrice)); ?></p>
                  <p class="purchase-secure">🔒 Secure Escrow Transaction</p>
                  <span class="purchase-note">Your payment is held securely by Flippingo until you confirm satisfaction. We
                    take care of your purchase.</span>
                </div>
                <a href="<?php echo e(route('checkout', ['submission_id' => $submission->id])); ?>"
                  class="btn btn-success w-100 mb-2">Buy Online</a>
                <div class="d-flex align-items-center">
                  <hr class="border-top-gray flex-grow-1" />
                  <span class="mx-1 text-uppercase">or</span>
                  <hr class="border-top-gray flex-grow-1" />
                </div>
                <!-- Wallet Balance -->
                <div class="purchase-wallet-box">
                  <p class="purchase-wallet-title">💳 Your Wallet Balance</p>
                  <p class="purchase-wallet-amount">₹<?php echo e(number_format($walletBalance, 2)); ?></p>
                </div>


<?php if($walletBalance < $offeredPrice): ?>
    <!-- Insufficient Balance -->
    <div class="purchase-warning-box">
        <p class="purchase-warning-title">⚠️ Insufficient Balance</p>
        <span class="purchase-warning-text">
            You need an additional <b>₹<?php echo e(number_format($requiredAmount)); ?></b> to complete this purchase.
        </span>
    </div>

    <!-- Add Money Button -->
    <button id="addMoneyButton" class="purchase-btn" data-amount="<?php echo e($requiredAmount * 100); ?>">
  + Add ₹<?php echo e($requiredAmount); ?> to Wallet
</button>

<?php endif; ?>


                <!-- Wishlist -->
              <button id="wishlistButton" class="purchase-wishlist-btn" data-submission="<?php echo e($submission->id); ?>">
    <?php echo $isInWishlist ? '❤️ Added to Wishlist' : '♡ Add to Wishlist'; ?>

</button>


              </div>
              <div class="seller-card">
                <h3 class="seller-title">👤 Seller Information</h3>

                <!-- Seller Box -->
                <div class="seller-info-card">
                  <div class="seller-header">
                    <?php if($submission->customer->profile_pic): ?>
                      <img src="<?php echo e(asset('storage/' . $submission->customer->profile_pic)); ?>" alt="Seller Photo"
                        class="seller-photo">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="Seller Photo" class="seller-photo">
                    <?php endif; ?>
                    <div class="seller-details">
                      <h4 class="seller-name">
                        <?php echo e(($submission->customer->first_name ?? '') . ' ' . ($submission->customer->last_name ?? '')); ?>

                        <span class="verified-tag">✔ Verified</span>
                      </h4>
                      <p class="seller-location"><i
                          class="fas fa-map-marker-alt"></i><?php echo e(($submission->customer->city ?? '') . " " . ($submission->customer->state ?? '') . ' ' . ($submission->customer->country ?? '')); ?>

                      </p>
                      <span class="seller-status online">Online</span>
                    </div>

                  </div>

                  <div class="seller-meta">
                    <div class="meta-box">
                      <small>Member Since</small>
                      <p><?php echo e(optional($submission->customer->created_at)->format('F Y') ?? 'N/A'); ?></p>
                    </div>
                  </div>

                </div>




              </div>
              <div class="d-flex flex-column gap-3 mt-4">
                <a href="" class="theme-btn w-100" data-bs-toggle="modal" data-bs-target="#shareModal">Chat</a>
                <a id="enquireBtn" class="theme-btn w-100" type="button" data-bs-toggle="modal"
                  data-bs-target="#enquiryModal" style="background:gray;">Send Enquiry</a>
              </div>


            </div>
          </div>
      </section>

      <section class="card-area bg-gray section-padding">
        <div class="container">
          <h4 class="font-size-25 font-weight-semi-bold">More from this user</h4>
          <div class="card-carousel owl-carousel owl-theme mt-4 mx-lg-n2">
            <div class="card mb-0 hover-y">
              <a href="<?php echo e(Route('listing-details')); ?>" class="card-image">
                <img src="<?php echo e(asset('assets')); ?>/images/s1.webp" class="card-img-top" alt="card image" />
                <span class="badge text-bg-success badge-pill">Verified</span>
              </a>
              <div class="card-body position-relative">
                <a href="<?php echo e(Route('user-profile')); ?>" class="author-img">
                  <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="author-img" />
                </a>
                <a href="#" class="card-cat mb-2">

                  Website</a>
                <div class="d-flex align-items-center mb-1">
                  <h4 class="card-title mb-0">
                    <a href="<?php echo e(Route('listing-details')); ?>">Fresh AdSense Approved Website With 6$ Balance</a>
                  </h4>
                  <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                    title="Claimed"></i>
                </div>
                <p class="card-text">₹16,000</p>
                <!-- <ul class="info-list mt-3">
                                                                                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                                                                                      <li>
                                                                                        <span class="fal fa-link icon"></span>
                                                                                        <a href="#">www.mysitelink.com</a>
                                                                                      </li>
                                                                                      <li>
                                                                                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                                                                                      </li>
                                                                                      </ul> -->
              </div>
              <!-- end card-body -->
              <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
                <div class="star-rating" data-rating="4.5">
                  <div class="rating-counter">4.5</div>
                </div>
                <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
                  data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
                  <i class="fal fa-bookmark"></i>
                </a>
              </div>
              <!-- end card-footer -->
            </div>
            <div class="card mb-0 hover-y">
              <a href="<?php echo e(Route('listing-details')); ?>" class="card-image">
                <img src="<?php echo e(asset('assets')); ?>/images/s1.webp" class="card-img-top" alt="card image" />
                <span class="badge text-bg-success badge-pill">Verified</span>
              </a>
              <div class="card-body position-relative">
                <a href="<?php echo e(Route('user-profile')); ?>" class="author-img">
                  <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="author-img" />
                </a>
                <a href="#" class="card-cat mb-2">

                  Website</a>
                <div class="d-flex align-items-center mb-1">
                  <h4 class="card-title mb-0">
                    <a href="<?php echo e(Route('listing-details')); ?>">Fresh AdSense Approved Website With 6$ Balance</a>
                  </h4>
                  <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                    title="Claimed"></i>
                </div>
                <p class="card-text">₹16,000</p>
                <!-- <ul class="info-list mt-3">
                                                                                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                                                                                      <li>
                                                                                        <span class="fal fa-link icon"></span>
                                                                                        <a href="#">www.mysitelink.com</a>
                                                                                      </li>
                                                                                      <li>
                                                                                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                                                                                      </li>
                                                                                      </ul> -->
              </div>
              <!-- end card-body -->
              <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
                <div class="star-rating" data-rating="4.5">
                  <div class="rating-counter">4.5</div>
                </div>
                <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
                  data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
                  <i class="fal fa-bookmark"></i>
                </a>
              </div>
              <!-- end card-footer -->
            </div>
            <div class="card mb-0 hover-y">
              <a href="<?php echo e(Route('listing-details')); ?>" class="card-image">
                <img src="<?php echo e(asset('assets')); ?>/images/s1.webp" class="card-img-top" alt="card image" />
                <span class="badge text-bg-success badge-pill">Verified</span>
              </a>
              <div class="card-body position-relative">
                <a href="<?php echo e(Route('user-profile')); ?>" class="author-img">
                  <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="author-img" />
                </a>
                <a href="#" class="card-cat mb-2">

                  Website</a>
                <div class="d-flex align-items-center mb-1">
                  <h4 class="card-title mb-0">
                    <a href="<?php echo e(Route('listing-details')); ?>">Fresh AdSense Approved Website With 6$ Balance</a>
                  </h4>
                  <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                    title="Claimed"></i>
                </div>
                <p class="card-text">₹16,000</p>
                <!-- <ul class="info-list mt-3">
                                                                                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                                                                                      <li>
                                                                                        <span class="fal fa-link icon"></span>
                                                                                        <a href="#">www.mysitelink.com</a>
                                                                                      </li>
                                                                                      <li>
                                                                                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                                                                                      </li>
                                                                                      </ul> -->
              </div>
              <!-- end card-body -->
              <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
                <div class="star-rating" data-rating="4.5">
                  <div class="rating-counter">4.5</div>
                </div>
                <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
                  data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
                  <i class="fal fa-bookmark"></i>
                </a>
              </div>
              <!-- end card-footer -->
            </div>
            <div class="card mb-0 hover-y">
              <a href="<?php echo e(Route('listing-details')); ?>" class="card-image">
                <img src="<?php echo e(asset('assets')); ?>/images/s1.webp" class="card-img-top" alt="card image" />
                <span class="badge text-bg-success badge-pill">Verified</span>
              </a>
              <div class="card-body position-relative">
                <a href="<?php echo e(Route('user-profile')); ?>" class="author-img">
                  <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="author-img" />
                </a>
                <a href="#" class="card-cat mb-2">

                  Website</a>
                <div class="d-flex align-items-center mb-1">
                  <h4 class="card-title mb-0">
                    <a href="<?php echo e(Route('listing-details')); ?>">Fresh AdSense Approved Website With 6$ Balance</a>
                  </h4>
                  <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                    title="Claimed"></i>
                </div>
                <p class="card-text">₹16,000</p>
                <!-- <ul class="info-list mt-3">
                                                                                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                                                                                      <li>
                                                                                        <span class="fal fa-link icon"></span>
                                                                                        <a href="#">www.mysitelink.com</a>
                                                                                      </li>
                                                                                      <li>
                                                                                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                                                                                      </li>
                                                                                      </ul> -->
              </div>
              <!-- end card-body -->
              <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
                <div class="star-rating" data-rating="4.5">
                  <div class="rating-counter">4.5</div>
                </div>
                <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
                  data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
                  <i class="fal fa-bookmark"></i>
                </a>
              </div>
              <!-- end card-footer -->
            </div>
            <div class="card mb-0 hover-y">
              <a href="<?php echo e(Route('listing-details')); ?>" class="card-image">
                <img src="<?php echo e(asset('assets')); ?>/images/s1.webp" class="card-img-top" alt="card image" />
                <span class="badge text-bg-success badge-pill">Verified</span>
              </a>
              <div class="card-body position-relative">
                <a href="<?php echo e(Route('user-profile')); ?>" class="author-img">
                  <img src="<?php echo e(asset('assets')); ?>/images/small-team1.jpg" alt="author-img" />
                </a>
                <a href="#" class="card-cat mb-2">

                  Website</a>
                <div class="d-flex align-items-center mb-1">
                  <h4 class="card-title mb-0">
                    <a href="<?php echo e(Route('listing-details')); ?>">Fresh AdSense Approved Website With 6$ Balance</a>
                  </h4>
                  <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                    title="Claimed"></i>
                </div>
                <p class="card-text">₹16,000</p>
                <!-- <ul class="info-list mt-3">
                                                                                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                                                                                      <li>
                                                                                        <span class="fal fa-link icon"></span>
                                                                                        <a href="#">www.mysitelink.com</a>
                                                                                      </li>
                                                                                      <li>
                                                                                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                                                                                      </li>
                                                                                      </ul> -->
              </div>
              <!-- end card-body -->
              <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
                <div class="star-rating" data-rating="4.5">
                  <div class="rating-counter">4.5</div>
                </div>
                <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
                  data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
                  <i class="fal fa-bookmark"></i>
                </a>
              </div>
              <!-- end card-footer -->
            </div>
            <!-- end card -->
          </div>
          <!-- end card-carousel -->
        </div>
        <!-- end container -->
      </section>
      <!-- end card-area -->
      <!-- ================================
                                                                                END CARD AREA
                                                                              ================================= -->

    </div>

    <!-- Enquiry Modal -->
    <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="enquiryForm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="enquiryModalLabel">Send Enquiry</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="submission_id" value="<?php echo e($submission->id); ?>">
              <div class="mb-3">
                <label for="enquiryMessage" class="form-label">Message (optional)</label>
                <textarea class="form-control" id="enquiryMessage" name="message" rows="4"
                  placeholder="Write your message here..."></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Send Enquiry</button>
            </div>
          </div>
        </form>
      </div>
    </div>


    <style>
      .blur-page {
        filter: blur(6px);
        pointer-events: none;
        user-select: none;
      }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $(document).ready(function () {
        $('#enquiryForm').on('submit', function (e) {
          e.preventDefault();

          const formData = $(this).serialize();

          $.ajax({
            url: "<?php echo e(route('send-enquiry')); ?>",
            method: 'POST',
            data: formData,
            headers: {
              'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            success: function (response) {
              if (response.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Enquiry sent',
                  text: 'Your enquiry was sent successfully!',
                });
                $('#enquiryModal').modal('hide');
                $('#enquiryForm')[0].reset();
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: response.message || 'Something went wrong!',
                });
              }
            },
            error: function () {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to send enquiry. Try again later.',
              });
            }
          });
        });
      });


      document.addEventListener('DOMContentLoaded', function() {
  var wishlistBtn = document.getElementById('wishlistButton');
  if (wishlistBtn) {
    wishlistBtn.addEventListener('click', function() {
       var button = this;
    var submissionId = button.getAttribute('data-submission');

    <?php if(!auth('customer')->check()): ?>
        alert('Please login to manage your wishlist.');
        return;
    <?php endif; ?>

    fetch("<?php echo e(route('wishlist.toggle')); ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
        },
        body: JSON.stringify({ submission_id: submissionId })
    }).then(response => response.json())
    .then(data => {
        if (data.added) {
            button.textContent = '❤️ Added to Wishlist';
        } else {
            button.textContent = '♡ Add to Wishlist';
        }
    }).catch(() => {
        alert('Could not update wishlist. Please try again.');
    });
    });
  }

var addMoneyButton = document.getElementById('addMoneyButton');
  if (addMoneyButton) {
  addMoneyButton.addEventListener('click', function() {
 var amount = this.getAttribute('data-amount');

    var options = {
        key: "<?php echo e(config('services.razorpay.key')); ?>", // Your Razorpay key
        amount: amount, // Amount in paise
        currency: "INR",
        name: "Flippingo Wallet",
        description: "Add funds to your wallet",
        image: "<?php echo e(asset('logo.png')); ?>",
        handler: function (response) {
            // On successful payment
            fetch("<?php echo e(route('wallet.add_funds')); ?>", { // Your server route for wallet top-up
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    razorpay_payment_id: response.razorpay_payment_id,
                    amount: amount
                })
            }).then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Funds Added!',
                        text: 'Your wallet top-up was successful.',
                    }).then(() => {
                        location.reload(); // Refresh page to update wallet balance
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: data.message || 'Could not update wallet balance. Please contact support.',
                    });
                }
            }).catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Error',
                    text: 'Error verifying payment. Please contact support.',
                });
            });
        },
        prefill: {
            name: "<?php echo e(auth()->user()->name); ?>",
            email: "<?php echo e(auth()->user()->email); ?>",
            contact: "<?php echo e(auth()->user()->phone ?? ''); ?>"
        },
        theme: {
            color: "#4a90e2"
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();
  });
  }
});




</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/listing-details.blade.php ENDPATH**/ ?>