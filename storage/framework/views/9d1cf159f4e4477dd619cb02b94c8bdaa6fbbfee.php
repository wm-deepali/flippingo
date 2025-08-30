

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area bread-bg" style="margin-top: 40px;">
    <div class="overlay"></div>
    <!-- end overlay -->
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2 class="sec__title text-white mb-3">Listing List</h2>
            <ul class="bread-list">
                <li><a href=<?php echo e(Route('home')); ?>>home</a></li>
                <li>listing</li>
                <li>listing list</li>
            </ul>
        </div>
        <!-- end breadcrumb-content -->
    </div>
    <!-- end container -->
    <div class="bread-svg">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
        </svg>
    </div>
    <!-- end bread-svg -->
</section>
<!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->
<section class="card-area padding-top-60px padding-bottom-90px">
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
                    <button class="tab-btn" data-category="saas">SaaS</button>
                    <button class="tab-btn" data-category="ecommerce">E-Commerce</button>
                </div>
                <div class="flippa-card-wrapper">
                    <div class="flippa-card" data-category="saas">
                        <div class="flippa-card-left">
                            <div class="flippa-image-wrapper">
                                <img src="<?php echo e(asset('assets')); ?>/images/bg1.png" alt="Confidential" style="height: 230px;" />
                                <div class="flippa-overlay">Confidential<br /><span>Sign NDA to view</span></div>
                                <div class="flippa-sponsored">Sponsored</div>
                            </div>
                        </div>
                        <div class="flippa-card-center">
                            <div class="flippa-title">SaaS | Business</div>
                            <div class="flippa-badges">
                                <span class="flippa-badge blue">Verified Listing</span>
                                <span class="flippa-icon">📍 GA, United States</span>
                            </div>
                            <div class="flippa-description">
                                Proprietary AI-powered Consumer Lending SaaS for Small to Mid Size Businesses.
                            </div>
                            <div class="flippa-details">
                                <div><strong>Type:</strong> SaaS</div>
                                <div><strong>Industry:</strong> Business</div>
                                <div><strong>Monetization:</strong> Affiliate Sales</div>
                                <div><strong>Site Age:</strong> 3 years</div>
                                <div><strong>Net Profit:</strong> USD $2,482 /mo</div>
                            </div>
                        </div>
                        <div class="flippa-card-right justify-content-between">
                            <div>
                                <div class="flippa-price-label">Asking Price</div>
                                <div class="flippa-price">USD $1,200,000</div>
                            </div>
                            <div class="flippa-buttons">
                                <button class="flippa-btn outline">👁 Watch</button>
                                <button class="flippa-btn filled">View Listing</button>
                            </div>
                        </div>
                    </div>

                    <div class="flippa-card" data-category="ecommerce">
                        <div class="flippa-card-left">
                            <div class="flippa-image-wrapper">
                                <img src="<?php echo e(asset('assets')); ?>/images/bg1.png" alt="Confidential" style="height: 230px;" />
                                <div class="flippa-overlay">Confidential<br /><span>Sign NDA to view</span></div>
                                <div class="flippa-sponsored">Sponsored</div>
                            </div>
                        </div>
                        <div class="flippa-card-center">
                            <div class="flippa-title">E-Commerce | Home & Living</div>
                            <div class="flippa-badges">
                                <span class="flippa-badge blue">Featured Listing</span>
                                <span class="flippa-icon">📍 Austin, TX</span>
                            </div>
                            <div class="flippa-description">
                                Profitable DTC brand selling sustainable home products with a loyal customer base and
                                20K email subscribers.
                            </div>
                            <div class="flippa-details">
                                <div><strong>Type:</strong> E-Commerce</div>
                                <div><strong>Industry:</strong> Home & Living</div>
                                <div><strong>Monetization:</strong> Product Sales</div>
                                <div><strong>Site Age:</strong> 4 years</div>
                                <div><strong>Net Profit:</strong> USD $18,750 /mo</div>
                            </div>
                        </div>
                        <div class="flippa-card-right justify-content-between">
                            <div>
                                <div class="flippa-price-label">Asking Price</div>
                                <div class="flippa-price">USD $1,200,000</div>
                            </div>
                            <div class="flippa-buttons">
                                <button class="flippa-btn outline">👁 Watch</button>
                                <button class="flippa-btn filled">View Listing</button>
                            </div>
                        </div>
                    </div>
                    <div class="flippa-card" data-category="ecommerce">
                        <div class="flippa-card-left">
                            <div class="flippa-image-wrapper">
                                <img src="<?php echo e(asset('assets')); ?>/images/bg1.png" alt="Confidential" style="height: 230px;" />
                                <div class="flippa-overlay">Confidential<br /><span>Sign NDA to view</span></div>
                                <div class="flippa-sponsored">Sponsored</div>
                            </div>
                        </div>
                        <div class="flippa-card-center">
                            <div class="flippa-title">E-Commerce | Home & Living</div>
                            <div class="flippa-badges">
                                <span class="flippa-badge blue">Featured Listing</span>
                                <span class="flippa-icon">📍 Austin, TX</span>
                            </div>
                            <div class="flippa-description">
                                Profitable DTC brand selling sustainable home products with a loyal customer base and
                                20K email subscribers.
                            </div>
                            <div class="flippa-details">
                                <div><strong>Type:</strong> E-Commerce</div>
                                <div><strong>Industry:</strong> Home & Living</div>
                                <div><strong>Monetization:</strong> Product Sales</div>
                                <div><strong>Site Age:</strong> 4 years</div>
                                <div><strong>Net Profit:</strong> USD $18,750 /mo</div>
                            </div>
                        </div>
                        <div class="flippa-card-right justify-content-between">
                            <div>
                                <div class="flippa-price-label">Asking Price</div>
                                <div class="flippa-price">USD $1,200,000</div>
                            </div>
                            <div class="flippa-buttons">
                                <button class="flippa-btn outline">👁 Watch</button>
                                <button class="flippa-btn filled">View Listing</button>
                            </div>
                        </div>
                    </div>
                    <div class="flippa-card" data-category="ecommerce">
                        <div class="flippa-card-left">
                            <div class="flippa-image-wrapper">
                                <img src="<?php echo e(asset('assets')); ?>/images/bg1.png" alt="Confidential" style="height: 230px;" />
                                <div class="flippa-overlay">Confidential<br /><span>Sign NDA to view</span></div>
                                <div class="flippa-sponsored">Sponsored</div>
                            </div>
                        </div>
                        <div class="flippa-card-center">
                            <div class="flippa-title">E-Commerce | Home & Living</div>
                            <div class="flippa-badges">
                                <span class="flippa-badge blue">Featured Listing</span>
                                <span class="flippa-icon">📍 Austin, TX</span>
                            </div>
                            <div class="flippa-description">
                                Profitable DTC brand selling sustainable home products with a loyal customer base and
                                20K email subscribers.
                            </div>
                            <div class="flippa-details">
                                <div><strong>Type:</strong> E-Commerce</div>
                                <div><strong>Industry:</strong> Home & Living</div>
                                <div><strong>Monetization:</strong> Product Sales</div>
                                <div><strong>Site Age:</strong> 4 years</div>
                                <div><strong>Net Profit:</strong> USD $18,750 /mo</div>
                            </div>
                        </div>
                        <div class="flippa-card-right justify-content-between">
                            <div>
                                <div class="flippa-price-label">Asking Price</div>
                                <div class="flippa-price">USD $1,200,000</div>
                            </div>
                            <div class="flippa-buttons">
                                <button class="flippa-btn outline">👁 Watch</button>
                                <a href="<?php echo e(Route('listing-details')); ?>">
                                    <button class="flippa-btn filled">View Listing</button>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="flippa-card" data-category="ecommerce">
                        <div class="flippa-card-left">
                            <div class="flippa-image-wrapper">
                                <img src="<?php echo e(asset('assets')); ?>/images/bg1.png" alt="Confidential" style="height: 230px;" />
                                <div class="flippa-overlay">Confidential<br /><span>Sign NDA to view</span></div>
                                <div class="flippa-sponsored">Sponsored</div>
                            </div>
                        </div>
                        <div class="flippa-card-center">
                            <div class="flippa-title">E-Commerce | Home & Living</div>
                            <div class="flippa-badges">
                                <span class="flippa-badge blue">Featured Listing</span>
                                <span class="flippa-icon">📍 Austin, TX</span>
                            </div>
                            <div class="flippa-description">
                                Profitable DTC brand selling sustainable home products with a loyal customer base and
                                20K email subscribers.
                            </div>
                            <div class="flippa-details">
                                <div><strong>Type:</strong> E-Commerce</div>
                                <div><strong>Industry:</strong> Home & Living</div>
                                <div><strong>Monetization:</strong> Product Sales</div>
                                <div><strong>Site Age:</strong> 4 years</div>
                                <div><strong>Net Profit:</strong> USD $18,750 /mo</div>
                            </div>
                        </div>
                        <div class="flippa-card-right justify-content-between">
                            <div>
                                <div class="flippa-price-label">Asking Price</div>
                                <div class="flippa-price">USD $1,200,000</div>
                            </div>
                            <div class="flippa-buttons">
                                <button class="flippa-btn outline">👁 Watch</button>
                                <a href="<?php echo e(Route('listing-details')); ?>">
                                    <button class="flippa-btn filled">View Listing</button>
                                </a>
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
    const tabButtons = document.querySelectorAll('.tab-btn');
    const cards = document.querySelectorAll('.flippa-card');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active from all buttons
            tabButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const category = btn.getAttribute('data-category');

            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/listing-list.blade.php ENDPATH**/ ?>