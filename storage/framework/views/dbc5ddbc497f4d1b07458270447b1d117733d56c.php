<div id="submissions-container">

                        
                        <div class="submission-group wishlist-card" data-group="all">
                            <?php $__currentLoopData = $allSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $catSlug = $submission['category']->slug ?? 'uncategorized';
                                    $catName = $submission['category']->name ?? '';

                                    $fields = json_decode($submission['data'], true);
                                    $productTitle = $fields['product_title']['value'] ?? 'No Title';
                                   $offeredPrice = ($fields['urgent_sale']['value'] ?? '') === 'Yes'
    ? ($fields['offered_price']['value'] ?? '0')
    : ($fields['mrp']['value'] ?? '0');


                                   $imageFile = $submission['imageFile'] ?? null; 
                                    $summaryFields = $submission['summaryFields'] ?? [];
                                  ?>
                                <div class="wishlist-product-card" data-category="<?php echo e($catSlug); ?>">
                                    <?php if($imageFile): ?>
                                        <img src="<?php echo e(asset('storage/' . $imageFile['file_path'])); ?>" />
                                    <?php else: ?>
                                        <img
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
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
                                            <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i
                                                    class="fa-regular fa-heart"></i></h4>
                                        </div>
                                    </div>
                                    <div class="product-details-hover">
                                        <div class="wishlist-button">
                                            <p><?php echo e($catName); ?></p>
                                            <div class="budge-active1">
                                                <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                            </div>

                                        </div>
                                        <h3 class="mt-2 " style="color: #000;"><?php echo e($productTitle); ?></h3>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">By
                                                <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?>

                                            </p>

                                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                        </div>
                                        <div class="wishlist-item-card">
                                  <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="wishlist-left">
                        <p class="m-0" style="color: green;">
                          <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                        </p>
                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 16px;">
                            <?php echo e($field['label']); ?>

                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 16px;">
                            <?php echo e($field['value']); ?>

                          </h5>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="wishlist-price d-flex justify-content-between mt-3">
                                            <h2 style="color: #000;"><i
                                                    class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>
                                            <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                                                View Detail
                                            </button>
                                        </div>

                                    </div>
                                    <div class="more-info" data-aos="fade-up" data-aos-duration="500">
                                        <div class="wishlist-button">
                                            <p><?php echo e($catName); ?></p>
                                            <div class="budge-active1">
                                                <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                            </div>

                                        </div>
                                        <h3 class="mt-2" style="color: #000;"><?php echo e($productTitle ?? ''); ?></h3>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">By
                                                <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?>

                                            </pre>
                                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                        </div>
                                        <div class="wishlist-item-card">
                                               <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="wishlist-left">
                        <p class="m-0" style="color: green;">
                          <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                        </p>
                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 16px;">
                            <?php echo e($field['label']); ?>

                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 16px;">
                            <?php echo e($field['value']); ?>

                          </h5>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="wishlist-price d-flex justify-content-between mt-3">
                                            <h2 style="color: #000;"><i
                                                    class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>
                                            <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                                                View Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="submission-group wishlist-card" data-group="<?php echo e($category->slug); ?>"
                                style="display:none;">
                                <?php if(isset($submissionsByCategory[$category->id])): ?>
                                    <?php $__currentLoopData = $submissionsByCategory[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $fields = json_decode($submission->data, true);
                                            $productTitle = $fields['product_title']['value'] ?? 'No Title';
                                             $offeredPrice = ($fields['urgent_sale']['value'] ?? '') === 'Yes'
    ? ($fields['offered_price']['value'] ?? '0')
    : ($fields['mrp']['value'] ?? '0');

                                    $imageFile = $submission->imageFile ?? null; 
                                    $summaryFields = $submission->summaryFields ?? [];

                                        ?>
                                        <div class="wishlist-product-card" data-category="<?php echo e($category->slug); ?>">
                                            <?php if($imageFile): ?>
                                                <img src="<?php echo e(asset('storage/' . $imageFile['file_path'])); ?>" />
                                            <?php else: ?>
                                                <img
                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
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

                                                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i
                                                            class="fa-regular fa-heart"></i></h4>
                                                </div>
                                            </div>
                                            <div class="product-details-hover">
                                                <div class="wishlist-button">
                                                    <p><?php echo e($category->name); ?></p>
                                                    <div class="budge-active1">
                                                        <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                                    </div>
                                                </div>
                                                <h3 class="mt-2 " style="color: #000;"><?php echo e($productTitle); ?></h3>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0">By
                                                        <?php echo e(($submission['customer']->first_name ?? '') . ' ' . ($submission['customer']->last_name ?? '')); ?>

                                                    </p>
                                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                                </div>
                                                <div class="wishlist-item-card">
                                                 <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="wishlist-left">
                        <p class="m-0" style="color: green;">
                          <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                        </p>
                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 16px;">
                            <?php echo e($field['label']); ?>

                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 16px;">
                            <?php echo e($field['value']); ?>

                          </h5>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                                    <h2 style="color: #000;"><i
                                                            class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>
                                                    <button type="button" class="btn btn-dark"
                                                        onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                                                        View Detail
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">
                                                <div class="wishlist-button">
                                                    <p><?php echo e($category->name); ?></p>
                                                    <div class="budge-active1">
                                                        <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                                    </div>

                                                </div>
                                                <h3 class="mt-2" style="color: #000;"><?php echo e($productTitle ?? ''); ?></h3>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0">By
                                                        <?php echo e(($submission['customer']->first_name ?? '') . ' ' . ($submission['customer']->last_name ?? '')); ?>

                                                    </p>
                                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                                </div>
                                                <div class="wishlist-item-card">
                                             <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="wishlist-left">
                        <p class="m-0" style="color: green;">
                          <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                        </p>
                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 16px;">
                            <?php echo e($field['label']); ?>

                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 16px;">
                            <?php echo e($field['value']); ?>

                          </h5>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </div>
                                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                                    <h2 style="color: #000;"><i
                                                            class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>
                                                    <button type="button" class="btn btn-dark"
                                                        onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                                                        View Detail
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