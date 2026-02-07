<style>
  .gridview-card {
    display: flex;
    width: 100%;
    background: #ffffff33;
    padding: 18px;
    border-radius: 14px;
    border: 1px solid #eaeaea;
    gap: 20px;
    margin-bottom: 20px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease-in-out;
  }

  /* Left image area */
  .gridview-left {
    width: 25%;
  }

  .gridview-left .wishlist-image-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: auto;
    overflow: hidden;
    border-radius: 10px;
  }

  .gridview-left img {
    width: 100%;
    height: 100%;
    border-radius: 12px;
    object-fit: cover;
  }

  /* Right content area */
  .gridview-right {
    width: 75%;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  /* Top: Status + Heart */
  .gridview-top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .gridview-badge {
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 13px;
    color: #fff;
  }

  .gridview-badge.active {
    background: #28a745;
  }

  .gridview-badge.sold {
    background: #dc3545;
  }

  /* Title + Category */
  .gridview-title-row {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: start;
  }

  .gridview-title-row h3 {
    font-size: 22px;
  }

  .gridview-category {
    background: #ffffff;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
  }

  /* Owner + Views */
  .gridview-owner-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #5a5a5a;
  }

  .views {
    color: #007bff;
  }

  /* Summary Fields */
  .gridview-summary {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 18px;
  }

  .gridview-summary-item {
    display: flex;
    gap: 8px;
    align-items: center;
    padding: 10px;
    background: #ffffff;
    border-radius: 7px;
  }

  .gridview-summary-item .label {
    font-size: 11px;
    color: #777;
    margin: 0;
  }

  .gridview-summary-item .value {
    font-size: 14px;
    margin: 0;
    color: #000;
  }

  /* Bottom Row */
  .gridview-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .gridview-bottom h2 {
    font-size: 22px;
    color: #000;
  }
</style>

<div id="submissions-container">

  
  <div class="submission-group wishlist-card" data-group="all">
    <?php if($allSubmissions->count() > 0): ?>
      <?php $__currentLoopData = $allSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $catSlug = $submission['category']->slug ?? 'uncategorized';
          $catName = $submission['category']->name ?? '';

          $fields = json_decode($submission['data'], true);
          $productTitle = $fields['product_title']['value'] ?? 'No Title';

          $imageFile = $submission['allImages'][0] ?? null;
          $summaryFields = $submission['summaryFields'] ?? [];
        ?>
        <div class="wishlist-product-card" data-category="<?php echo e($catSlug); ?>">
          <?php if($imageFile): ?>
            <div class="wishlist-image-wrapper">

              <div class="wishlist-main-slider">
                <?php $__currentLoopData = $submission['allImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <img src="<?php echo e(asset('storage/' . $img['file_path'])); ?>" class="slide-img" />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <!-- Navigation Arrows -->
              <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
              <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>

            </div>

          <?php else: ?>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
          <?php endif; ?>
          <div class="wishlist-budge">
            <div class="d-flex justify-content-between align-items-center">
              <?php if(in_array($submission['id'], $soldSubmissionIds)): ?>
                
                <div class="budge-soldout">
                  <p><i class="fa-solid fa-ban"></i> Sold Out</p>
                </div>
              <?php else: ?>
                
                <div class="budge-active">
                  <p><i class="fa-solid fa-circle-check"></i> Active</p>
                </div>
              <?php endif; ?>
              <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i></h4>

            </div>

          </div>
          <div class="product-details-hover">
            <div class="wishlist-button">
              <p><?php echo e($catName); ?></p>
              <!--<div class="budge-active1">-->
              <!--  <p><i class="fa-solid fa-circle-check"></i> Verified</p>-->
              <!--</div>-->

            </div>
            <h3 class="mt-2 " style="color: #000;"><?php echo e($productTitle); ?></h3>
            <div class="d-flex justify-content-between align-items-center">
              <p class="m-0" style="font-size:12px;">
                By
                <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?>


                <?php if(!empty($submission['is_premium']) && $submission['is_premium']): ?>
                  <span class="text-warning ms-1" data-toggle="tooltip" data-placement="top"
                    title="<?php echo e(setting('premium_seller_note', 'Premium Seller')); ?>">
                    <i class="fa-solid fa-crown"></i>
                  </span>
                <?php elseif(!empty($submission['is_verified']) && $submission['is_verified']): ?>
                  <span class="text-success ms-1" title="Verified Seller">
                    <i class="fa-solid fa-circle-check"></i>
                  </span>
                <?php endif; ?>
              </p>

              <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> <?php echo e($submission->total_views ?? 0); ?>

              </p>
            </div>
            <div class="wishlist-item-card <?php echo e(count($summaryFields) == 2 ? 'two-items' : ''); ?>">
              <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="wishlist-left">
                  <p class="m-0" style="color: <?php echo e($field['color'] ?? 'green'); ?>;">
                    <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                  </p>

                  <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 10px;line-height: 12px;">
                      <?php echo e($field['label']); ?>

                    </p>
                    <h5 class="m-0" style="color: #000; font-size: 14px;">
                      <?php echo e($field['value']); ?>

                    </h5>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="wishlist-price d-flex justify-content-between mt-3">
              <h2 style="color:#000;">
                <?php echo e($submission['currency_symbol']); ?>

                <?php echo e($submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']); ?>

              </h2>


              <button type="button" class="btn btn-dark"
                onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                View Listing
              </button>
            </div>
          </div>
          <!--                <div class="more-info" data-aos="fade-up" data-aos-duration="500">-->
          <!--                    <div class="wishlist-button">-->
          <!--                        <p><?php echo e($catName); ?></p>-->
          <!--                        <div class="budge-active1">-->
          <!--                            <p><i class="fa-solid fa-circle-check"></i> Verified</p>-->
          <!--                        </div>-->

          <!--                    </div>-->
          <!--                    <h3 class="mt-2" style="color: #000;"><?php echo e($productTitle ?? ''); ?></h3>-->
          <!--                    <div class="d-flex justify-content-between align-items-center">-->
          <!--                        <p class="m-0">By-->
          <!--                            <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?>-->
          <!--                        </pre>-->
          <!--                        <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>-->
          <!--                    </div>-->
          <!--                    <div class="wishlist-item-card">-->
          <!--                           <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
          <!--  <div class="wishlist-left">-->
          <!--   <p class="m-0" style="color: <?php echo e($field['color'] ?? '#000000'); ?>;">-->
          <!--      <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>-->
          <!--    </p>-->
          <!--    <div class="d-flex flex-column">-->
          <!--      <p class="m-0" style="font-size: 16px;">-->
          <!--        <?php echo e($field['label']); ?>-->
          <!--      </p>-->
          <!--      <h5 class="m-0" style="color: #000; font-size: 16px;">-->
          <!--        <?php echo e($field['value']); ?>-->
          <!--      </h5>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
          <!--                    </div>-->
          <!--                    <div class="wishlist-price d-flex justify-content-between mt-3">-->
          <!--                        <h2 style="color: #000;"><i-->
          <!--                                class="fa-solid fa-indian-rupee-sign"></i><?php echo e($submission['currency_symbol']); ?><?php echo e(number_format($submission['display_price'], 2)); ?></h2>-->
          <!--                        <button type="button" class="btn btn-dark"-->
          <!--                            onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">-->
          <!--                            View Detail-->
          <!--                        </button>-->
          <!--                    </div>-->
          <!--                </div>-->
        </div>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  </div>

  
  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="submission-group wishlist-card" data-group="<?php echo e($category->slug); ?>" style="display:none;">
      <?php if(isset($submissionsByCategory[$category->id])): ?>
        <?php $__currentLoopData = $submissionsByCategory[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $fields = json_decode($submission->data, true);
            $productTitle = $fields['product_title']['value'] ?? 'No Title';

            $imageFile = $submission['allImages'][0] ?? null;
            $summaryFields = $submission->summaryFields ?? [];

          ?>
          <div class="wishlist-product-card" data-category="<?php echo e($category->slug); ?>">
            <?php if($imageFile): ?>
              <div class="wishlist-image-wrapper">

                <div class="wishlist-main-slider">
                  <?php $__currentLoopData = $submission['allImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(asset('storage/' . $img['file_path'])); ?>" class="slide-img" />
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Navigation Arrows -->
                <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>

              </div>

            <?php else: ?>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
            <?php endif; ?>

            <div class="wishlist-budge">
              <div class="d-flex justify-content-between align-items-center">
                <?php if(in_array($submission['id'], $soldSubmissionIds)): ?>
                  
                  <div class="budge-soldout">
                    <p><i class="fa-solid fa-ban"></i> Sold Out</p>
                  </div>
                <?php else: ?>
                  
                  <div class="budge-active">
                    <p><i class="fa-solid fa-circle-check"></i> Active</p>
                  </div>
                <?php endif; ?>
                <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i></h4>

              </div>

            </div>
            <div class="product-details-hover">
              <div class="wishlist-button">
                <p><?php echo e($catName); ?></p>
                <!--<div class="budge-active1">-->
                <!--  <p><i class="fa-solid fa-circle-check"></i> Verified</p>-->
                <!--</div>-->

              </div>
              <h3 class="mt-2 " style="color: #000;"><?php echo e($productTitle); ?></h3>
              <div class="d-flex justify-content-between align-items-center">
                <p class="m-0" style="font-size:12px;">
                  By
                  <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?>


                  <?php if(!empty($submission['is_premium']) && $submission['is_premium']): ?>
                    <span class="text-warning ms-1" data-toggle="tooltip" data-placement="top"
                      title="<?php echo e(setting('premium_seller_note', 'Premium Seller')); ?>">
                      <i class="fa-solid fa-crown"></i>
                    </span>
                  <?php elseif(!empty($submission['is_verified']) && $submission['is_verified']): ?>
                    <span class="text-success ms-1" title="Verified Seller">
                      <i class="fa-solid fa-circle-check"></i>
                    </span>
                  <?php endif; ?>
                </p>

                <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> <?php echo e($submission->total_views ?? 0); ?>

                </p>
              </div>
              <div class="wishlist-item-card <?php echo e(count($summaryFields) == 2 ? 'two-items' : ''); ?>">
                <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="wishlist-left">
                    <p class="m-0" style="color: <?php echo e($field['color'] ?? 'green'); ?>;">
                      <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                    </p>

                    <div class="d-flex flex-column">
                      <p class="m-0" style="font-size: 10px;line-height: 12px;">
                        <?php echo e($field['label']); ?>

                      </p>
                      <h5 class="m-0" style="color: #000; font-size: 14px;">
                        <?php echo e($field['value']); ?>

                      </h5>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <div class="wishlist-price d-flex justify-content-between mt-3">
                <h2 style="color:#000;">
                  <?php echo e($submission['currency_symbol']); ?>

                  <?php echo e($submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']); ?>

                </h2>


                <button type="button" class="btn btn-dark"
                  onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                  View Listing
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <p>No submission available.</p>
      <?php endif; ?>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


  <div class="submission-group-grid" data-group="all" style="display:none;">
    <?php if($allSubmissions->count() > 0): ?>
      <?php $__currentLoopData = $allSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $catSlug = $submission['category']->slug ?? 'uncategorized';
          $catName = $submission['category']->name ?? '';

          $fields = json_decode($submission['data'], true);
          $productTitle = $fields['product_title']['value'] ?? 'No Title';

          $imageFile = $submission['allImages'][0] ?? null;
          $summaryFields = $submission['summaryFields'] ?? [];
        ?>

        <div class="gridview-card">

          
          <div class="gridview-left">
            <?php if($imageFile): ?>
              <div class="wishlist-image-wrapper">
                <div class="wishlist-main-slider">
                  <?php $__currentLoopData = $submission['allImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(asset('storage/' . $img['file_path'])); ?>" class="slide-img" />
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>
              </div>
            <?php else: ?>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s" />
            <?php endif; ?>
          </div>

          
          <div class="gridview-right">

            
            <div class="gridview-top-row">
              <span class="gridview-category"><?php echo e($catName); ?></span>
              <?php if(in_array($submission['id'], $soldSubmissionIds)): ?>
                <span class="gridview-badge sold">Sold Out</span>
              <?php else: ?>
                <span class="gridview-badge active">Active</span>
              <?php endif; ?>

              <!--<i class="fa-regular fa-heart"></i>-->
            </div>

            
            <div class="gridview-title-row">
              <h3><?php echo e($productTitle); ?></h3>

            </div>

            
            <div class="gridview-owner-row">
              <p>
                By <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?>


                <?php if(!empty($submission['is_premium']) && $submission['is_premium']): ?>
                  <i class="fa-solid fa-crown text-warning"></i>
                <?php elseif(!empty($submission['is_verified']) && $submission['is_verified']): ?>
                  <i class="fa-solid fa-circle-check text-success"></i>
                <?php endif; ?>
              </p>

              <p class="views"><i class="fa-solid fa-eye"></i> <?php echo e($submission->total_views ?? 0); ?></p>
            </div>

            
            <div class="gridview-summary">
              <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="gridview-summary-item">
                  <i class="<?php echo e($field['icon'] ?? ''); ?>" style="color: <?php echo e($field['color'] ?? 'green'); ?>"></i>
                  <div>
                    <p class="label"><?php echo e($field['label']); ?></p>
                    <p class="value"><?php echo e($field['value']); ?></p>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="gridview-bottom">
              <h2>
                <?php echo e($submission['currency_symbol']); ?>

                <?php echo e($submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']); ?>

              </h2>

              <button type="button" class="btn btn-dark"
                onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                View Listing
              </button>
            </div>

          </div>

        </div>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  </div>

  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="submission-group-grid" data-group="<?php echo e($category->slug); ?>" style="display:none;">
     <?php if(isset($submissionsByCategory[$category->id])): ?>
        <?php $__currentLoopData = $submissionsByCategory[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $fields = json_decode($submission->data, true);
            $productTitle = $fields['product_title']['value'] ?? 'No Title';

            $imageFile = $submission['allImages'][0] ?? null;
            $summaryFields = $submission->summaryFields ?? [];

          ?>

          <div class="gridview-card">

            
            <div class="gridview-left">
              <?php if($imageFile): ?>
                <div class="wishlist-image-wrapper">
                  <div class="wishlist-main-slider">
                    <?php $__currentLoopData = $submission['allImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <img src="<?php echo e(asset('storage/' . $img['file_path'])); ?>" class="slide-img" />
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>

                  <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                  <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>
                </div>
              <?php else: ?>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s" />
              <?php endif; ?>
            </div>

            
            <div class="gridview-right">

              
              <div class="gridview-top-row">
                <span class="gridview-category"><?php echo e($catName); ?></span>
                <?php if(in_array($submission['id'], $soldSubmissionIds)): ?>
                  <span class="gridview-badge sold">Sold Out</span>
                <?php else: ?>
                  <span class="gridview-badge active">Active</span>
                <?php endif; ?>

                <!--<i class="fa-regular fa-heart"></i>-->
              </div>

              
              <div class="gridview-title-row">
                <h3><?php echo e($productTitle); ?></h3>

              </div>

              
              <div class="gridview-owner-row">
                <p>
                  By <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?>


                  <?php if(!empty($submission['is_premium']) && $submission['is_premium']): ?>
                    <i class="fa-solid fa-crown text-warning"></i>
                  <?php elseif(!empty($submission['is_verified']) && $submission['is_verified']): ?>
                    <i class="fa-solid fa-circle-check text-success"></i>
                  <?php endif; ?>
                </p>

                <p class="views"><i class="fa-solid fa-eye"></i> <?php echo e($submission->total_views ?? 0); ?></p>
              </div>

              
              <div class="gridview-summary">
                <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="gridview-summary-item">
                    <i class="<?php echo e($field['icon'] ?? ''); ?>" style="color: <?php echo e($field['color'] ?? 'green'); ?>"></i>
                    <div>
                      <p class="label"><?php echo e($field['label']); ?></p>
                      <p class="value"><?php echo e($field['value']); ?></p>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              
              <div class="gridview-bottom">
                <h2>
                  <?php echo e($submission['currency_symbol']); ?>

                  <?php echo e($submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']); ?>

                </h2>

                <button type="button" class="btn btn-dark"
                  onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                  View Listing
                </button>
              </div>

            </div>

          </div>

       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <p>No submission available.</p>
      <?php endif; ?>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/partials/filtered-listings.blade.php ENDPATH**/ ?>