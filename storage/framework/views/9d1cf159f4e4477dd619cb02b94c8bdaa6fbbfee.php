

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<style>
    .wishlist-page {
        width: 93%;
        margin: auto;
        margin-top: 30px;
    }

    .wishlist-card {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 40px;
        padding-bottom: 50px;
    }

    .wishlist-product-card {
        width: 100%;
        height: 560px;
        background: white;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .wishlist-product-card img {
        width: 100%;
        height: 270px;
    }

    .wishlist-budge {
        position: relative;
        top: -264px;
        left: 6px;
    }

    .budge-active {
        width: fit-content;
        padding: 2px 10px;
        background-color: #0080002b;
        color: green;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 4px;
    }

    .budge-active p {
        margin: 0;
    }

    .wishlist-button {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .wishlist-button p {
        width: 50%;
        margin: 0;
        padding: 0px 10px;
        border: 1px solid lightgray;
        background: #a19f9f33;
    }

    .wishlist-button .budge-active1 p {
        width: fit-content;
        padding: 2px 10px;
        background-color: #0080002b;
        color: green;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 4px;
    }

    .wishlist-item-card {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 10px;
    }

    .wishlist-left {
        width: 100%;
        height: 60px;
        background-color: #d3d3d32b;
        border-radius: 3px;
        padding: 10px;
        display: flex;
        align-items: center;
        gap: 10px;

    }

    .wishlist-price button {
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 3px;
        padding: 0px 20px;
    }

    .product-details-hover {
        padding: 10px;
        display: block;
        /* Default visible */
        transition: opacity 0.3s ease;
        margin-top: -20px;
    }

    .wishlist-product-card:hover .product-details-hover {
        display: none;
        /* Hide on card hover */
    }

    .more-info {
        display: none;
        padding: 10px;
        margin-top: -20px;
        /* position: absolute;
            bottom: 0;
            left: 0;
            width: 100%; */
        /* background: white;
            padding: 10px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1); */
        text-align: left;
        z-index: 1;
        /* Ensure it stays above other content */
        transition: transform 0.3s ease;
        transform: translateY(100%);
    }

    .wishlist-product-card:hover .more-info {
        display: block;
        transform: translateY(0);
    }

    @keyframes  slideUp {
        from {
            transform: translateY(100%);
        }

        to {
            transform: translateY(0);
        }
    }
    .tabs-wrapper {
  display: flex;
  align-items: center;
  position: relative;
  max-width: 100%;
  overflow: hidden;
}

.tabs-container {
  display: flex;
  overflow-x: auto;
  scroll-behavior: smooth;
  gap: 10px;
  scrollbar-width: none; /* Firefox */
}
.tabs-container::-webkit-scrollbar {
  display: none; /* Chrome, Safari */
}

.tab-btn {
  white-space: nowrap;
  padding: 10px 15px;
  border: none;
  background: #f3f3f3;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
}

.scroll-btn {
  background: black;
  color: white;
  border: none;
  padding: 8px 12px;
  cursor: pointer;
  font-size: 18px;
}
.scroll-btn.prev {
  margin-right: 5px;
}
.scroll-btn.next {
  margin-left: 5px;
}
.icon-element-sm {
    width: 35px;
    height: 35px;
    line-height: 35px;
    font-size: 16px;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}
</style>
<?php $__env->startSection('content'); ?>
                                                                                                                           
    <section class="card-area " style="padding-top:60px; padding-bottom:90px; margin-top:130px;">
        <div class="container">
            <div class="card">
                <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                    <p class="card-text py-2">Showing 1 to 6 of 30 entries</p>
                    <div class="d-flex align-items-center">
                       <form id="sortForm" method="GET" action="<?php echo e(url()->current()); ?>" class="d-inline">
    <?php $__currentLoopData = request()->except('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <select class="form-select" id="sort" name="sort" onchange="this.form.submit()">
            <option value="">Default</option>
            <option value="price-low-to-high" <?php echo e(request('sort') == 'price-low-to-high' ? 'selected' : ''); ?>>Price: Low to High</option>
            <option value="price-high-to-low" <?php echo e(request('sort') == 'price-high-to-low' ? 'selected' : ''); ?>>Price: High to Low</option>
            <option value="new-first" <?php echo e(request('sort') == 'new-first' ? 'selected' : ''); ?>>Newest Listings</option>
            <option value="most-popular" <?php echo e(request('sort') == 'most-popular' ? 'selected' : ''); ?>>Most Popular</option>
            <option value="most-rated" <?php echo e(request('sort') == 'most-rated' ? 'selected' : ''); ?>>Most Rated</option>
        </select>
</form>

                        <ul class="filter-nav ms-2">
                            <li>
                                <a href="" class="active icon-element icon-element-sm"><i class="fal fa-list"></i></a>
                            </li>
                            <li>
                                <a href="" class="icon-element icon-element-sm" data-bs-toggle="tooltip"
                                    data-placement="top" title="Grid View"><i class="fal fa-th-large"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-lg-3">
    <div class="sidebar">
        <!-- Search & Clear buttons at topmost -->
        <div class="d-flex justify-content-between mb-3">
            <button type="submit" form="filter-form" class="theme-btn border-0 w-75">Search</button>
            <button type="button" class="theme-btn border-0 w-20" id="clear-filters">Clear</button>
        </div>

        <form id="filter-form" method="GET" action="<?php echo e(route('listing-list')); ?>">
            <?php echo csrf_field(); ?>

            
            <div class="form-group mb-3">
                <span class="fal fa-search form-icon"></span>
                <input name="search" class="form-control form--control" type="text"
                       placeholder="What are you looking for?"
                       value="<?php echo e(request('search')); ?>">
            </div>

            
            <div class="form-group mb-3">
                <label for="country">Country</label>
                <select name="country" class="form-select">
                    <option value="">Select Country</option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->name); ?>" <?php echo e(request('country') == $country->name ? 'selected' : ''); ?>>
                            <?php echo e($country->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            
            <div class="form-group mb-3">
                <label for="for_sale">For Sale</label>
                <select name="for_sale" class="form-select">
                    <option value="">Select</option>
                    <option value="Yes" <?php echo e(request('for_sale') == 'Yes' ? 'selected' : ''); ?>>Yes</option>
                    <option value="No" <?php echo e(request('for_sale') == 'No' ? 'selected' : ''); ?>>No</option>
                </select>
            </div>

            
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Price</h4>
                    <div class="d-flex align-items-center">
                        <div class="form-group me-2">
                            <input name="price_min" class="form-control form--control ps-3" type="text" placeholder="₹3"
                                   value="<?php echo e(request('price_min')); ?>">
                        </div>
                        <div class="form-group me-2">
                            <input name="price_max" class="form-control form--control ps-3" type="text" placeholder="₹269"
                                   value="<?php echo e(request('price_max')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Ratings</h4>
                    <?php for($i=5; $i>=1; $i--): ?>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="<?php echo e($i); ?>StarRadio" name="rating" value="<?php echo e($i); ?>"
                                   <?php echo e(request('rating') == $i ? 'checked' : ''); ?> />
                            <label class="custom-control-label" for="<?php echo e($i); ?>StarRadio">
                                <span class="star-rating d-inline-block line-height-24 font-size-15" data-rating="<?php echo e($i); ?>"></span>
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Dynamic Category Filters -->
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="category-filters" data-category="<?php echo e($category['slug'] ?? ''); ?>" style="display:none;">
                    <?php if(isset($category['filters']) && count($category['filters'])): ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Category Filters</h4>
                                <?php $__currentLoopData = $category['filters']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mb-3">
                                        <?php
                                            $fieldKey = $filter['field_key'] ?? $filter['field_id'];
                                            $oldValue = request()->input("filters.$fieldKey");
                                        ?>
                                        <?php switch($filter['type'] ?? ''):
                                            case ('text'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <input type="text" name="filters[<?php echo e($fieldKey); ?>]" class="form-control"
                                                   placeholder="Enter <?php echo e($filter['label'] ?? ''); ?>"
                                                   value="<?php echo e($oldValue); ?>">
                                            <?php break; ?>

                                            <?php case ('number'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <input type="number" name="filters[<?php echo e($fieldKey); ?>]" class="form-control"
                                                   placeholder="Enter <?php echo e($filter['label'] ?? ''); ?>"
                                                   value="<?php echo e($oldValue); ?>">
                                            <?php break; ?>

                                            <?php case ('date'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <input type="date" name="filters[<?php echo e($fieldKey); ?>]" class="form-control"
                                                   value="<?php echo e($oldValue); ?>">
                                            <?php break; ?>

                                            <?php case ('email'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <input type="email" name="filters[<?php echo e($fieldKey); ?>]" class="form-control"
                                                   placeholder="Enter <?php echo e($filter['label'] ?? ''); ?>"
                                                   value="<?php echo e($oldValue); ?>">
                                            <?php break; ?>

                                            <?php case ('textarea'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <textarea name="filters[<?php echo e($fieldKey); ?>]" class="form-control" rows="2"
                                                      placeholder="Enter <?php echo e($filter['label'] ?? ''); ?>"><?php echo e($oldValue); ?></textarea>
                                            <?php break; ?>

                                            <?php case ('checkbox'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <?php $__currentLoopData = $filter['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $optionId = 'filter_'.$filter['field_id'].'_'.$index;
                                                    $optionLabel = explode('|', $option)[0];
                                                    $checked = is_array($oldValue) && in_array($optionLabel, $oldValue) ? 'checked' : '';
                                                ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="<?php echo e($optionId); ?>"
                                                           name="filters[<?php echo e($filter['field_id']); ?>][]"
                                                           value="<?php echo e($optionLabel); ?>" <?php echo e($checked); ?>>
                                                    <label class="custom-control-label" for="<?php echo e($optionId); ?>"><?php echo e($optionLabel); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php break; ?>

                                            <?php case ('radio'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <?php $__currentLoopData = $filter['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $optionId = 'filter_'.$filter['field_id'].'_'.$index;
                                                    $optionLabel = explode('|', $option)[0];
                                                    $checked = $oldValue == $optionLabel ? 'checked' : '';
                                                ?>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="<?php echo e($optionId); ?>"
                                                           name="filters[<?php echo e($filter['field_id']); ?>]"
                                                           value="<?php echo e($optionLabel); ?>" <?php echo e($checked); ?>>
                                                    <label class="custom-control-label" for="<?php echo e($optionId); ?>"><?php echo e($optionLabel); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php break; ?>

                                            <?php case ('selectlist'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <select name="filters[<?php echo e($fieldKey); ?>]" class="form-select">
                                                <option value="">Select <?php echo e($filter['label'] ?? ''); ?></option>
                                                <?php $__currentLoopData = $filter['options'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($option); ?>" <?php echo e($oldValue == $option ? 'selected' : ''); ?>><?php echo e($option); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php break; ?>
                                        <?php endswitch; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </form>
    </div>
</div>

                <!-- end col-lg-4 -->
                <div class="col-lg-9">
                    <div class="tabs-wrapper" style="margin-bottom: 30px;">
    <button class="scroll-btn prev" onclick="scrollTabs(-200)">&#10094;</button>

    <div class="tabs-container" id="tabsContainer">
        <button class="tab-btn active" data-category="all">All</button>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button class="tab-btn" data-category="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <button class="scroll-btn next" onclick="scrollTabs(200)">&#10095;</button>
</div>

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
                                    $summaryFields = $submission['summaryFields'] ?? null;
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
                                            <div class="budge-active">
                                                <p><i class="fa-solid fa-circle-check"></i> Active</p>
                                            </div>
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
                                  <?php if(!empty($summaryFields)): ?>
    <?php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    ?>

    <?php if(!empty($textFields)): ?>
        <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?></h5>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php endif; ?>


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
                                       <?php if(!empty($summaryFields)): ?>
    <?php
        // Filter textarea fields using array_filter
        $textareaFields = array_filter($summaryFields, function($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'textarea');
        });
    ?>

    <?php if(!empty($textareaFields)): ?>
        <p style="font-size: 13px;">
            <?php $__currentLoopData = $textareaFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($field['icon'])): ?>
                    <i class="<?php echo e($field['icon']); ?>" style="margin-right: 4px;"></i>
                <?php endif; ?>
                <?php echo e(\Illuminate\Support\Str::limit($field['value'], 100, '...')); ?>


                
                <?php if($index !== array_key_last($textareaFields)): ?>
                    &nbsp;|&nbsp;
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </p>
    <?php endif; ?>
<?php endif; ?>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">By
                                                <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?>

                                            </pre>
                                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                        </div>
                                        <div class="wishlist-item-card">
                                              <?php if(!empty($summaryFields)): ?>
    <?php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    ?>

    <?php if(!empty($textFields)): ?>
        <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?></h5>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php endif; ?>
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
                                    $summaryFields = $submission->summaryFields ?? null;

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
                                                    <div class="budge-active">
                                                        <p><i class="fa-solid fa-circle-check"></i> Active</p>
                                                    </div>
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
                                                    <?php if(!empty($summaryFields)): ?>
                                                    <?php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    ?>

    <?php if(!empty($textFields)): ?>
        <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?></h5>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>
<?php endif; ?>
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
                                                <?php if(!empty($summaryFields)): ?>
    <?php
        // Filter textarea fields using array_filter
        $textareaFields = array_filter($summaryFields, function($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'textarea');
        });
    ?>

    <?php if(!empty($textareaFields)): ?>
        <p style="font-size: 13px;">
            <?php $__currentLoopData = $textareaFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($field['icon'])): ?>
                    <i class="<?php echo e($field['icon']); ?>" style="margin-right: 4px;"></i>
                <?php endif; ?>
                <?php echo e(\Illuminate\Support\Str::limit($field['value'], 100, '...')); ?>


                
                <?php if($index !== array_key_last($textareaFields)): ?>
                    &nbsp;|&nbsp;
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </p>
    <?php endif; ?>
<?php endif; ?>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0">By
                                                        <?php echo e(($submission['customer']->first_name ?? '') . ' ' . ($submission['customer']->last_name ?? '')); ?>

                                                    </p>
                                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                                </div>
                                                <div class="wishlist-item-card">
                                               <?php if(!empty($summaryFields)): ?>
    <?php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    ?>

    <?php if(!empty($textFields)): ?>
        <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?></h5>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <?php endif; ?>
<?php endif; ?>

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

                    </div>
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <section class="subscriber-area mb-n5 position-relative z-index-2">
        <div class="container">
            <div class="subscriber-box d-flex flex-wrap align-items-center justify-content-between bg-dark overflow-hidden">
                <div class="section-heading my-2">
                    <h2 class="sec__title text-white mb-2">Subscribe to Newsletter!</h2>
                    <p class="sec__desc text-white-50">
                        Subscribe to get latest updates and information.
                    </p>
                </div>
                <!-- end section-heading -->
                <form method="post">
                    <div class="input-group">
                        <span class="fal fa-envelope form-icon"></span>
                        <input class="form-control form--control" type="email" placeholder="Enter your email" />
                        <div class="input-group-append">
                            <button class="theme-btn" type="submit">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end subscriber-box -->
        </div>
        <!-- end container -->
    </section>
                                                                                                                                      

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Get URL parameters
    const params = new URLSearchParams(window.location.search);
    const selectedCategory = params.get('category') || 'all'; // default to 'all' if none

    // Trigger click on the corresponding tab
    const tabToOpen = document.querySelector(`.tab-btn[data-category="${selectedCategory}"]`);
    if (tabToOpen) {
        tabToOpen.click();
    } else {
        // fallback to all
        document.querySelector('.tab-btn[data-category="all"]').click();
    }
});

document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Remove active class from all buttons
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const category = btn.getAttribute('data-category');
        const groups = document.querySelectorAll('.submission-group');
        const filters = document.querySelectorAll('.category-filters');

        // Show/hide submissions
        groups.forEach(group => {
            if (category === 'all') {
                group.style.display = group.getAttribute('data-group') === 'all' ? '' : 'none';
            } else {
                group.style.display = group.getAttribute('data-group') === category ? '' : 'none';
            }
        });

        // Show/hide filters
        filters.forEach(div => {
            if (category === 'all' || div.getAttribute('data-category') === category) {
                div.style.display = '';
            } else {
                div.style.display = 'none';
            }
        });
    });
});

function scrollTabs(amount) {
    const container = document.getElementById("tabsContainer");
    container.scrollBy({ left: amount, behavior: "smooth" });
}

document.getElementById('clear-filters').addEventListener('click', function() {
    const form = document.getElementById('filter-form');
    form.querySelectorAll('input[type="text"], input[type="number"], input[type="date"], input[type="email"], textarea, select')
        .forEach(el => el.value = '');
    form.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(el => el.checked = false);

    const url = window.location.href.split('?')[0];
    window.location.href = url;
});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/listing-list.blade.php ENDPATH**/ ?>