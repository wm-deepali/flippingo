

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
</style>
<?php $__env->startSection('content'); ?>


    <!-- ================================
                                                START BREADCRUMB AREA
                                            ================================= -->

    <!-- end breadcrumb-area -->
    <!-- ================================
                                                END BREADCRUMB AREA
                                            ================================= -->
    <section class="card-area " style="padding-top:60px; padding-bottom:90px; margin-top:130px;">
        <div class="container">
            <div class="card">
                <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                    <p class="card-text py-2">Showing 1 to 6 of 30 entries</p>
                    <div class="d-flex align-items-center">
                        <select class="select-picker select-picker-sm me-3" data-width="160" data-size="5">
                            <option value="">Short by</option>
                            <option value="short-by-default">Short by default</option>
                            <option value="high-rated">High Rated</option>
                            <option value="most-reviewed">Most Reviewed</option>
                            <option value="popular-Listing">Popular Listing</option>
                            <option value="newest-Listing">Newest Listing</option>
                            <option value="older-Listing">Older Listing</option>
                            <option value="price-low-to-high">Price: low to high</option>
                            <option value="price-high-to-low">Price: high to low</option>
                            <option value="random-listing">Random listing</option>
                        </select>
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Search</h4>
                                <div class="form-group">
                                    <span class="fal fa-search form-icon"></span>
                                    <input class="form-control form--control" type="text"
                                        placeholder="What are you looking for?" />
                                </div>
                                <!-- end form-group -->
                                <div class="form-group">
                                    <span class="fal fa-map-marker-alt form-icon"></span>
                                    <input class="form-control form--control" type="text" placeholder="Location" />
                                </div>
                                <!-- end form-group -->
                                <div class="form-group select2-container-wrapper">
                                    <select class="select-picker" data-width="100%" data-size="5">
                                        <option value>Select a Category</option>
                                        <option value="1">Shops</option>
                                        <option value="2">Hotels</option>
                                        <option value="3">Foods & Restaurants</option>
                                        <option value="4">Fitness</option>
                                        <option value="5">Travel</option>
                                        <option value="6">Salons</option>
                                        <option value="7">Event</option>
                                        <option value="8">Business</option>
                                    </select>
                                </div>
                                <!-- end form-group -->
                                <button class="theme-btn border-0 w-100" type="submit">
                                    Search
                                </button>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Price</h4>
                                <form action="#" class="d-flex align-items-center">
                                    <div class="form-group me-2">
                                        <input class="form-control form--control ps-3" type="text" placeholder="$3" />
                                    </div>
                                    <div class="form-group me-2">
                                        <input class="form-control form--control ps-3" type="text" placeholder="$269" />
                                    </div>
                                    <button class="theme-btn theme-btn-gray border-0 mb-3" type="submit">
                                        <i class="fal fa-angle-right"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Tags</h4>
                                <ul class="tag-list">
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Hotel</a></li>
                                    <li><a href="#">Food</a></li>
                                    <li><a href="#">Bars</a></li>
                                    <li><a href="#">Salon</a></li>
                                    <li><a href="#">Cleaning</a></li>
                                    <li><a href="#">Fashion</a></li>
                                </ul>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Features</h4>
                                <div class="mb-2">
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="ElevatorInBuilding" />
                                        <label class="custom-control-label" for="ElevatorInBuilding">Elevator in
                                            building</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="FriendlyWorkspace" />
                                        <label class="custom-control-label" for="FriendlyWorkspace">Friendly
                                            workspace</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="InstantBook" />
                                        <label class="custom-control-label" for="InstantBook">Instant Book</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="WirelessInternet" />
                                        <label class="custom-control-label" for="WirelessInternet">Wireless Internet</label>
                                    </div>
                                </div>
                                <div class="collapse" id="moreFeatureCollapse">
                                    <div class="more-content-wrap">
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input"
                                                id="FreeParkingOnPremises" />
                                            <label class="custom-control-label" for="FreeParkingOnPremises">Free parking on
                                                premises</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="FreeParkingOnStreet" />
                                            <label class="custom-control-label" for="FreeParkingOnStreet">Free parking on
                                                street</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="SmokingAllowed" />
                                            <label class="custom-control-label" for="SmokingAllowed">Smoking allowed</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="Events" />
                                            <label class="custom-control-label" for="Events">Events</label>
                                        </div>
                                    </div>
                                    <!-- end more-content-wrap -->
                                </div>
                                <!-- end collapse -->
                                <a class="collapse-btn btn-link" data-bs-toggle="collapse" href="#moreFeatureCollapse"
                                    role="button" aria-expanded="false" aria-controls="moreFeatureCollapse">
                                    <span class="collapse-icon-show">Show more <i class="fal fa-angle-down"></i></span>
                                    <span class="collapse-icon-hide">Show less <i class="fal fa-angle-up"></i></span>
                                </a>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Ratings</h4>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="fiveStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="fiveStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="5"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="fourStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="fourStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="4"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="threeStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="threeStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="3"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="twoStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="twoStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="2"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="oneStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="oneStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="1"></span>
                                    </label>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end sidebar -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-9">
                    <div class=" " style="margin-bottom: 30px;">
                        <button class="tab-btn active" data-category="all">All</button>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button class="tab-btn" data-category="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="wishlist-card" id="submissions-container">

                        
                        <div class="submission-group" data-group="all">
                            <?php $__currentLoopData = $allSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $catSlug = $submission->form->category->slug ?? 'uncategorized';
                                    $catName = $submission->form->category->name ?? '';
                                ?>
                                <div class="wishlist-product-card" data-category="<?php echo e($catSlug); ?>">
                                    <?php
                                        $fields = json_decode($submission->data, true);
                                        $imageFile = $submission->files->firstWhere('show_on_summary', true); // Assuming relation 'files' loaded

                                        $productTitle = $fields['product_title']['value'] ?? 'No Title';
                                        $offeredPrice = $fields['offered_price']['value'] ?? '0';
                                        // Filter fields that show on summary and are not image files
                                        $summaryFields = collect($fields)->filter(function ($field) use ($imageFile) {
                                            if (empty($field['show_on_summary'])) {
                                                return false;
                                            }
                                            return true;
                                        });
                                      ?>
                                    <?php if($imageFile): ?>
                                        <img
                                           src="<?php echo e(asset('storage/' . $imageFile['file_path'])); ?>">
                                    <?php else: ?>
                                        <img
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                                    <?php endif; ?>
                                    <img
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
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
                                            <p class="m-0">By  <?php echo e($submission->customer->first_name ?? " "); ?><?php echo e($submission->customer->last_name ?? ''); ?></p>
                                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                        </div>
                                        <div class="wishlist-item-card">
                                            <div class="wishlist-left">
                                                <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                                <div class="d-flex flex-column ">
                                                    <p class="m-0" style="font-size: 16px;">Revenue</p>
                                                    <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                                </div>

                                            </div>
                                            <div class="wishlist-left">
                                                <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i>
                                                </p>
                                                <div class="d-flex flex-column ">
                                                    <p class="m-0" style="font-size: 16px;">Traffic</p>
                                                    <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="wishlist-price d-flex justify-content-between mt-3">
                                            <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>
                                            <a href="<?php echo e(route('listing-details', ['id' => $submission->id])); ?>">
                      <button> View Detail</button>
                    </a>

                                        </div>

                                    </div>
                                    <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                                        <h3 class="mt-2" style="color: #000;">More Information</h3>
                                        <p style="font-size: 13px;">Free consultation | Fast Approval | 100% Transparent Process
                                            |
                                            No Hidden Cost</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">By Rohan Wagha</p>
                                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                        </div>
                                        <div class="wishlist-item-card">
                                            <div class="wishlist-left">
                                                <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                                <div class="d-flex flex-column ">
                                                    <p class="m-0" style="font-size: 16px;">Revenue</p>
                                                    <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                                </div>

                                            </div>
                                            <div class="wishlist-left">
                                                <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i>
                                                </p>
                                                <div class="d-flex flex-column ">
                                                    <p class="m-0" style="font-size: 16px;">Traffic</p>
                                                    <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="wishlist-price d-flex justify-content-between mt-3">
                                            <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                                            <button> View Detail</button>

                                        </div>
                                    </div>
                                   

                                    

                                 
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="wishlist-product-card" data-group="<?php echo e($category->slug); ?>" style="display:none;">
                                <?php if(isset($submissionsByCategory[$category->id])): ?>
                                    <?php $__currentLoopData = $submissionsByCategory[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flippa-card" data-category="<?php echo e($category->slug); ?>">
                                            <?php
                                                $fields = json_decode($submission->data, true);
                                                $imageFile = $submission->files->firstWhere('show_on_summary', true);
                                                $productTitle = $fields['product_title']['value'] ?? 'No Title';
                                                $offeredPrice = $fields['offered_price']['value'] ?? '0';
                                                $summaryFields = collect($fields)->filter(fn($field) => !empty($field['show_on_summary']));
                                            ?>

                                            <div class="flippa-card-left">
                                                <div class="flippa-image-wrapper">
                                                    <?php if($imageFile): ?>
                                                        <img src="<?php echo e(asset('storage/' . $imageFile['file_path'])); ?>"
                                                            alt="<?php echo e($imageFile['label'] ?? 'Image'); ?>"
                                                            style="height: 230px; object-fit: cover;" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/images/hero-bg2.jpg')); ?>" alt="Confidential"
                                                            style="height: 230px;" />
                                                    <?php endif; ?>
                                                    <div class="flippa-overlay">Confidential<br /><span>Sign NDA to view</span></div>
                                                    <div class="flippa-sponsored">Sponsored</div>
                                                </div>
                                            </div>

                                            <div class="flippa-card-center">
                                                <div class="flippa-title"><?php echo e($productTitle); ?></div>
                                                <div class="flippa-badges">
                                                    <span class="flippa-badge blue">Verified Listing</span>
                                                    <span class="flippa-icon"><?php echo e($submission->customer->countryname ?? '-'); ?></span>
                                                </div>

                                                <div class="flippa-details">
                                                    <?php if($fields): ?>
                                                        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(!empty($field['show_on_summary'])): ?>
                                                                <div>
                                                                    <strong><?php echo e($field['label'] ?? ucfirst($field['field_id'])); ?>:</strong>
                                                                    <?php echo e($field['value']); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="flippa-card-right justify-content-between">
                                                <div>
                                                    <div class="flippa-price-label">Asking Price</div>
                                                    <div class="flippa-price">₹<?php echo e(number_format($offeredPrice)); ?></div>
                                                </div>
                                                <div class="flippa-buttons">
                                                    <button class="flippa-btn outline">👁 Watch</button>
                                                    <a href="<?php echo e(route('listing-details', ['id' => $submission->id])); ?>">
                                                        <button class="flippa-btn filled">View Listing</button>
                                                    </a>
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
                    <div class="wishlist-card">
                        <div class="wishlist-product-card">
                            <img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
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
                                    <p>Website</p>
                                    <div class="budge-active1">
                                        <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                    </div>

                                </div>
                                <h3 class="mt-2 " style="color: #000;">Demo Content</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By Rohan Wagha</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Revenue</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                        </div>

                                    </div>
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Traffic</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                        </div>

                                    </div>

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                                    <button> View Detail</button>

                                </div>

                            </div>
                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                                <h3 class="mt-2" style="color: #000;">More Information</h3>
                                <p style="font-size: 13px;">Free consultation | Fast Approval | 100% Transparent Process |
                                    No Hidden Cost</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By Rohan Wagha</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Revenue</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                        </div>

                                    </div>
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Traffic</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                        </div>

                                    </div>

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                                    <button> View Detail</button>

                                </div>
                            </div>
                        </div>
                        <div class="wishlist-product-card">
                            <img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
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
                                    <p>Website</p>
                                    <div class="budge-active1">
                                        <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                    </div>

                                </div>
                                <h3 class="mt-2 " style="color: #000;">Demo Content</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By Rohan Wagha</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Revenue</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                        </div>

                                    </div>
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Traffic</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                        </div>

                                    </div>

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                                    <button> View Detail</button>

                                </div>

                            </div>
                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                                <h3 class="mt-2" style="color: #000;">More Information</h3>
                                <p style="font-size: 13px;">Free consultation | Fast Approval | 100% Transparent Process |
                                    No Hidden Cost</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By Rohan Wagha</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Revenue</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                        </div>

                                    </div>
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Traffic</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                        </div>

                                    </div>

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                                    <button> View Detail</button>

                                </div>
                            </div>
                        </div>
                        <div class="wishlist-product-card">
                            <img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
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
                                    <p>Website</p>
                                    <div class="budge-active1">
                                        <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                    </div>

                                </div>
                                <h3 class="mt-2 " style="color: #000;">Demo Content</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By Rohan Wagha</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Revenue</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                        </div>

                                    </div>
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Traffic</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                        </div>

                                    </div>

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                                    <button> View Detail</button>

                                </div>

                            </div>
                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                                <h3 class="mt-2" style="color: #000;">More Information</h3>
                                <p style="font-size: 13px;">Free consultation | Fast Approval | 100% Transparent Process |
                                    No Hidden Cost</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By Rohan Wagha</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Revenue</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                        </div>

                                    </div>
                                    <div class="wishlist-left">
                                        <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i></p>
                                        <div class="d-flex flex-column ">
                                            <p class="m-0" style="font-size: 16px;">Traffic</p>
                                            <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                        </div>

                                    </div>

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                                    <button> View Detail</button>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- ================================
                                                START CARD AREA
                                            ================================= -->

    <!-- end card-area -->
    <!-- ================================
                                                END CARD AREA
                                            ================================= -->

    <!-- ================================
                                                START SUBSCRIBER AREA
                                            ================================= -->
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
    <!-- end subscriber-area -->
    <!-- ================================
                                                END SUBSCRIBER AREA
                                            ================================= -->

    <script>
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const category = btn.getAttribute('data-category');
                const groups = document.querySelectorAll('.submission-group');

                groups.forEach(group => {
                    if (category === 'all') {
                        group.style.display = group.getAttribute('data-group') === 'all' ? 'block' : 'none';
                    } else {
                        group.style.display = group.getAttribute('data-group') === category ? 'block' : 'none';
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/listing-list.blade.php ENDPATH**/ ?>