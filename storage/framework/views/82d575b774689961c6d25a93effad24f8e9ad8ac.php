

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="second-top-header d-flex justify-content-between">
            <div class="second-top-left-text d-flex flex-column">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Manage your buyer and seller activities
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
            <div class="second-top-left d-flex " style="gap: 10px;">
                <button class="refresh-button"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
                <button id='create-listing-btn'>+ Create Listing</button>
            </div>


        </div>
        <div class="dashboard-switching">
            <ul class="dashboard-tabs">
                <li class="tab-item active" data-tab="buyer">Buyer Dashboard</li>
                <li class="tab-item" data-tab="seller">Seller Dashboard</li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <div class="tab-pane active" id="buyer">
                <div class="seller-dashboard-cards">
                    <!-- Wallet -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Wallet Balance</h4>
                        <h2 class="seller-card-number">₹0</h2>
                        <p class="seller-card-desc">Available for purchases</p>
                        <a href="#" class="seller-card-footer seller-purple">
                            <span>Manage Wallet</span>
                            <i class="fas fa-wallet"></i>
                        </a>
                    </div>

                    <!-- Active Orders -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Active Orders</h4>
                        <h2 class="seller-card-number">0</h2>
                        <p class="seller-card-desc">In progress</p>
                        <a href="#" class="seller-card-footer seller-blue">
                            <span>View Orders</span>
                            <i class="fas fa-box"></i>
                        </a>
                    </div>

                    <!-- Purchases -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Completed Purchases</h4>
                        <h2 class="seller-card-number">0</h2>
                        <p class="seller-card-desc">Successfully acquired</p>
                        <a href="#" class="seller-card-footer seller-green">
                            <span>View Purchases</span>
                            <i class="fas fa-check-circle"></i>
                        </a>
                    </div>

                    <!-- Watchlist -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Watchlist</h4>
                        <h2 class="seller-card-number">0</h2>
                        <p class="seller-card-desc">Saved items</p>
                        <a href="#" class="seller-card-footer seller-red">
                            <span>View Watchlist</span>
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                </div>
                <div class="container-fluid" style="width: 96%; margin: auto; margin-top: 20px;">
                    <!-- *************************************************************** -->
                    <!-- Start First Cards -->
                    <!-- *************************************************************** -->

                    <!-- *************************************************************** -->
                    <!-- End First Cards -->
                    <!-- *************************************************************** -->
                    <!-- *************************************************************** -->
                    <!-- Start Sales Charts Section -->
                    <!-- *************************************************************** -->
                    <div class="row">
                        <!-- <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Total Sales</h4>
                                        <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                                        <ul class="list-style-none mb-0">
                                            <li>
                                                <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                                <span class="text-muted">Direct Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$2346</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                                <span class="text-muted">Referral Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$2108</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                                                <span class="text-muted">Affiliate Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$1204</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        <div class="col-lg-8 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enquiry Revenues</h4>
                                    <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                                    <ul class="list-inline text-center mt-5 mb-2">
                                        <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Earning by Location</h4>
                                    <div class="" style="height:180px">
                                        <div id="visitbylocate" style="height:100%"></div>
                                    </div>
                                    <div class="row mb-3 align-items-center mt-1 mt-5">
                                        <div class="col-4 text-right">
                                            <span class="text-muted font-14">India</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="mb-0 font-14 text-dark font-weight-medium">28%</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-4 text-right">
                                            <span class="text-muted font-14">UK</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 74%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="mb-0 font-14 text-dark font-weight-medium">21%</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-4 text-right">
                                            <span class="text-muted font-14">USA</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-cyan" role="progressbar" style="width: 60%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="mb-0 font-14 text-dark font-weight-medium">18%</span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 text-right">
                                            <span class="text-muted font-14">China</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="mb-0 font-14 text-dark font-weight-medium">12%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Sell</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <!-- <th>Order ID</th> -->
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>04 Sep 2025, 11:30 AM</td>
                                                    <!-- <td>#ORD12345</td> -->
                                                    <td><span class="product-name">Premium T-Shirt</span></td>
                                                    <td>$120</td>
                                                    <td>Paid</td>
                                                    <td>Delivered</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                                <tr>
                                                    <td>03 Sep 2025, 05:10 PM</td>
                                                    <!-- <td>#ORD12344</td> -->
                                                    <td><span class="product-name">Business Mug</span></td>
                                                    <td>$45</td>
                                                    <td>Pending</td>
                                                    <td>Processing</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Transactions</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <!-- <th>Order ID</th> -->
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>04 Sep 2025, 11:30 AM</td>
                                                    <!-- <td>#ORD12345</td> -->
                                                    <td><span class="product-name">Premium T-Shirt</span></td>
                                                    <td>$120</td>
                                                    <td>Paid</td>
                                                    <td>Delivered</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                                <tr>
                                                    <td>03 Sep 2025, 05:10 PM</td>
                                                    <!-- <td>#ORD12344</td> -->
                                                    <td><span class="product-name">Business Mug</span></td>
                                                    <td>$45</td>
                                                    <td>Pending</td>
                                                    <td>Processing</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Order Status</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <!-- <th>Order ID</th> -->
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>04 Sep 2025, 11:30 AM</td>
                                                    <!-- <td>#ORD12345</td> -->
                                                    <td><span class="product-name">Premium T-Shirt</span></td>
                                                    <td>$120</td>
                                                    <td>Paid</td>
                                                    <td>Delivered</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                                <tr>
                                                    <td>03 Sep 2025, 05:10 PM</td>
                                                    <!-- <td>#ORD12344</td> -->
                                                    <td><span class="product-name">Business Mug</span></td>
                                                    <td>$45</td>
                                                    <td>Pending</td>
                                                    <td>Processing</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- *************************************************************** -->
                    <!-- End Sales Charts Section -->
                    <!-- *************************************************************** -->
                    <!-- *************************************************************** -->
                    <!-- Start Location and Earnings Charts Section -->
                    <!-- *************************************************************** -->
                    <div class="row">
                        <div class="col-md-6 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <h4 class="card-title mb-0">Earning Statistics</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                    id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="#">Insert</a>
                                                    <a class="dropdown-item" href="#">Update</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pl-4 mb-5">
                                        <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                                    </div>
                                    <ul class="list-inline text-center mt-4 mb-0">
                                        <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Recent Activity</h4>
                                    <div class="mt-4 activity">
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                    <i data-feather="shopping-cart"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                                <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                                    Camera.
                                                </p>
                                                <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger btn-circle mb-2 btn-item">
                                                    <i data-feather="message-square"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                                <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                                    ticket</p>
                                                <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start border-left-line">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                                    <i data-feather="bell"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                                </h5>
                                                <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                                <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                                    Ago</span>
                                                <a href="javascript:void(0)"
                                                    class="font-14 border-bottom pb-1 border-info">Load More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="tab-pane" id="seller">
                <div class="seller-dashboard-cards">
                    <!-- Wallet -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Wallet Balance</h4>
                        <h2 class="seller-card-number">₹0</h2>
                        <p class="seller-card-desc">Available for purchases</p>
                        <a href="#" class="seller-card-footer seller-purple">
                            <span>Manage Wallet</span>
                            <i class="fas fa-wallet"></i>
                        </a>
                    </div>

                    <!-- Active Orders -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Active Orders</h4>
                        <h2 class="seller-card-number">0</h2>
                        <p class="seller-card-desc">In progress</p>
                        <a href="#" class="seller-card-footer seller-blue">
                            <span>View Orders</span>
                            <i class="fas fa-box"></i>
                        </a>
                    </div>

                    <!-- Purchases -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Completed Purchases</h4>
                        <h2 class="seller-card-number">0</h2>
                        <p class="seller-card-desc">Successfully acquired</p>
                        <a href="#" class="seller-card-footer seller-green">
                            <span>View Purchases</span>
                            <i class="fas fa-check-circle"></i>
                        </a>
                    </div>

                    <!-- Watchlist -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Watchlist</h4>
                        <h2 class="seller-card-number">0</h2>
                        <p class="seller-card-desc">Saved items</p>
                        <a href="#" class="seller-card-footer seller-red">
                            <span>View Watchlist</span>
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                </div>
                <div class="container-fluid" style="width: 96%; margin: auto; margin-top: 20px;">

                    <div class="row">
                        <!-- <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Total Sales</h4>
                                        <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                                        <ul class="list-style-none mb-0">
                                            <li>
                                                <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                                <span class="text-muted">Direct Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$2346</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                                <span class="text-muted">Referral Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$2108</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                                                <span class="text-muted">Affiliate Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$1204</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        <div class="col-lg-8 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enquiry Revenues</h4>
                                    <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                                    <ul class="list-inline text-center mt-5 mb-2">
                                        <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Earning by Location</h4>
                                    <div class="" style="height:180px">
                                        <div id="visitbylocate" style="height:100%"></div>
                                    </div>
                                    <div class="row mb-3 align-items-center mt-1 mt-5">
                                        <div class="col-4 text-right">
                                            <span class="text-muted font-14">India</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="mb-0 font-14 text-dark font-weight-medium">28%</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-4 text-right">
                                            <span class="text-muted font-14">UK</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 74%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="mb-0 font-14 text-dark font-weight-medium">21%</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-4 text-right">
                                            <span class="text-muted font-14">USA</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-cyan" role="progressbar" style="width: 60%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="mb-0 font-14 text-dark font-weight-medium">18%</span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-4 text-right">
                                            <span class="text-muted font-14">China</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="mb-0 font-14 text-dark font-weight-medium">12%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Sell</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <!-- <th>Order ID</th> -->
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>04 Sep 2025, 11:30 AM</td>
                                                    <!-- <td>#ORD12345</td> -->
                                                    <td><span class="product-name">Premium T-Shirt</span></td>
                                                    <td>$120</td>
                                                    <td>Paid</td>
                                                    <td>Delivered</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                                <tr>
                                                    <td>03 Sep 2025, 05:10 PM</td>
                                                    <!-- <td>#ORD12344</td> -->
                                                    <td><span class="product-name">Business Mug</span></td>
                                                    <td>$45</td>
                                                    <td>Pending</td>
                                                    <td>Processing</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Transactions</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <!-- <th>Order ID</th> -->
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>04 Sep 2025, 11:30 AM</td>
                                                    <!-- <td>#ORD12345</td> -->
                                                    <td><span class="product-name">Premium T-Shirt</span></td>
                                                    <td>$120</td>
                                                    <td>Paid</td>
                                                    <td>Delivered</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                                <tr>
                                                    <td>03 Sep 2025, 05:10 PM</td>
                                                    <!-- <td>#ORD12344</td> -->
                                                    <td><span class="product-name">Business Mug</span></td>
                                                    <td>$45</td>
                                                    <td>Pending</td>
                                                    <td>Processing</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Order Status</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <!-- <th>Order ID</th> -->
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>04 Sep 2025, 11:30 AM</td>
                                                    <!-- <td>#ORD12345</td> -->
                                                    <td><span class="product-name">Premium T-Shirt</span></td>
                                                    <td>$120</td>
                                                    <td>Paid</td>
                                                    <td>Delivered</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                                <tr>
                                                    <td>03 Sep 2025, 05:10 PM</td>
                                                    <!-- <td>#ORD12344</td> -->
                                                    <td><span class="product-name">Business Mug</span></td>
                                                    <td>$45</td>
                                                    <td>Pending</td>
                                                    <td>Processing</td>
                                                    <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- *************************************************************** -->
                    <!-- End Sales Charts Section -->
                    <!-- *************************************************************** -->
                    <!-- *************************************************************** -->
                    <!-- Start Location and Earnings Charts Section -->
                    <!-- *************************************************************** -->
                    <div class="row">
                        <div class="col-md-6 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <h4 class="card-title mb-0">Earning Statistics</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                    id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="#">Insert</a>
                                                    <a class="dropdown-item" href="#">Update</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pl-4 mb-5">
                                        <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                                    </div>
                                    <ul class="list-inline text-center mt-4 mb-0">
                                        <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Recent Activity</h4>
                                    <div class="mt-4 activity">
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                    <i data-feather="shopping-cart"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                                <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                                    Camera.
                                                </p>
                                                <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger btn-circle mb-2 btn-item">
                                                    <i data-feather="message-square"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                                <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                                    ticket</p>
                                                <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start border-left-line">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                                    <i data-feather="bell"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                                </h5>
                                                <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                                <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                                    Ago</span>
                                                <a href="javascript:void(0)"
                                                    class="font-14 border-bottom pb-1 border-info">Load More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- *************************************************************** -->
            <!-- Start First Cards -->
            <!-- *************************************************************** -->

            <!-- *************************************************************** -->
            <!-- End First Cards -->
            <!-- *************************************************************** -->
            <!-- *************************************************************** -->
            <!-- Start Sales Charts Section -->
            <!-- *************************************************************** -->
            <div class="row">
                <!-- <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Total Sales</h4>
                                        <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                                        <ul class="list-style-none mb-0">
                                            <li>
                                                <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                                <span class="text-muted">Direct Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$2346</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                                <span class="text-muted">Referral Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$2108</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                                                <span class="text-muted">Affiliate Sales</span>
                                                <span class="text-dark float-right font-weight-medium">$1204</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Enquiry Revenues</h4>
                            <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                            <ul class="list-inline text-center mt-5 mb-2">
                                <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Earning by Location</h4>
                            <div class="" style="height:180px">
                                <div id="visitbylocate" style="height:100%"></div>
                            </div>
                            <div class="row mb-3 align-items-center mt-1 mt-5">
                                <div class="col-4 text-right">
                                    <span class="text-muted font-14">India</span>
                                </div>
                                <div class="col-5">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <span class="mb-0 font-14 text-dark font-weight-medium">28%</span>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-4 text-right">
                                    <span class="text-muted font-14">UK</span>
                                </div>
                                <div class="col-5">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 74%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <span class="mb-0 font-14 text-dark font-weight-medium">21%</span>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-4 text-right">
                                    <span class="text-muted font-14">USA</span>
                                </div>
                                <div class="col-5">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-cyan" role="progressbar" style="width: 60%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <span class="mb-0 font-14 text-dark font-weight-medium">18%</span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-4 text-right">
                                    <span class="text-muted font-14">China</span>
                                </div>
                                <div class="col-5">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <span class="mb-0 font-14 text-dark font-weight-medium">12%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wishlist-card">
                <div class="wishlist-product-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                    <div class="wishlist-budge">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="budge-active">
                                <p><i class="fa-solid fa-circle-check"></i> Active</p>
                            </div>
                            <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i>
                            </h4>

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
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                    <div class="wishlist-budge">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="budge-active">
                                <p><i class="fa-solid fa-circle-check"></i> Active</p>
                            </div>
                            <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i>
                            </h4>

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
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                    <div class="wishlist-budge">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="budge-active">
                                <p><i class="fa-solid fa-circle-check"></i> Active</p>
                            </div>
                            <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i>
                            </h4>

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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="card-title">Recent Sell</h4>

                            </div>
                            <div class="table-wrapper">

                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <!-- <th>Order ID</th> -->
                                            <th>Product Detail</th>
                                            <th>Paid Amount</th>
                                            <th>Payment Status</th>
                                            <th> Status</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>04 Sep 2025, 11:30 AM</td>
                                            <!-- <td>#ORD12345</td> -->
                                            <td><span class="product-name">Premium T-Shirt</span></td>
                                            <td>$120</td>
                                            <td>Paid</td>
                                            <td>Delivered</td>
                                            <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                        </tr>
                                        <tr>
                                            <td>03 Sep 2025, 05:10 PM</td>
                                            <!-- <td>#ORD12344</td> -->
                                            <td><span class="product-name">Business Mug</span></td>
                                            <td>$45</td>
                                            <td>Pending</td>
                                            <td>Processing</td>
                                            <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="card-title">Recent Transactions</h4>

                            </div>
                            <div class="table-wrapper">

                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <!-- <th>Order ID</th> -->
                                            <th>Product Detail</th>
                                            <th>Paid Amount</th>
                                            <th>Payment Status</th>
                                            <th> Status</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>04 Sep 2025, 11:30 AM</td>
                                            <!-- <td>#ORD12345</td> -->
                                            <td><span class="product-name">Premium T-Shirt</span></td>
                                            <td>$120</td>
                                            <td>Paid</td>
                                            <td>Delivered</td>
                                            <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                        </tr>
                                        <tr>
                                            <td>03 Sep 2025, 05:10 PM</td>
                                            <!-- <td>#ORD12344</td> -->
                                            <td><span class="product-name">Business Mug</span></td>
                                            <td>$45</td>
                                            <td>Pending</td>
                                            <td>Processing</td>
                                            <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="card-title">Order Status</h4>

                            </div>
                            <div class="table-wrapper">

                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <!-- <th>Order ID</th> -->
                                            <th>Product Detail</th>
                                            <th>Paid Amount</th>
                                            <th>Payment Status</th>
                                            <th> Status</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>04 Sep 2025, 11:30 AM</td>
                                            <!-- <td>#ORD12345</td> -->
                                            <td><span class="product-name">Premium T-Shirt</span></td>
                                            <td>$120</td>
                                            <td>Paid</td>
                                            <td>Delivered</td>
                                            <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                        </tr>
                                        <tr>
                                            <td>03 Sep 2025, 05:10 PM</td>
                                            <!-- <td>#ORD12344</td> -->
                                            <td><span class="product-name">Business Mug</span></td>
                                            <td>$45</td>
                                            <td>Pending</td>
                                            <td>Processing</td>
                                            <!-- <td class="actions">
                    <i class="fas fa-eye" title="View Order Detail"></i>
                    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                    <i class="fas fa-undo" title="Request Refund"></i>
                  </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- *************************************************************** -->
            <!-- End Sales Charts Section -->
            <!-- *************************************************************** -->
            <!-- *************************************************************** -->
            <!-- Start Location and Earnings Charts Section -->
            <!-- *************************************************************** -->
            <div class="row">
                <div class="col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <h4 class="card-title mb-0">Earning Statistics</h4>
                                <div class="ml-auto">
                                    <div class="dropdown sub-dropdown">
                                        <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                            <a class="dropdown-item" href="#">Insert</a>
                                            <a class="dropdown-item" href="#">Update</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-4 mb-5">
                                <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                            </div>
                            <ul class="list-inline text-center mt-4 mb-0">
                                <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Activity</h4>
                            <div class="mt-4 activity">
                                <div class="d-flex align-items-start border-left-line pb-3">
                                    <div>
                                        <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                            <i data-feather="shopping-cart"></i>
                                        </a>
                                    </div>
                                    <div class="ml-3 mt-2">
                                        <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                        <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                            Camera.
                                        </p>
                                        <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start border-left-line pb-3">
                                    <div>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-circle mb-2 btn-item">
                                            <i data-feather="message-square"></i>
                                        </a>
                                    </div>
                                    <div class="ml-3 mt-2">
                                        <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                        <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                            ticket</p>
                                        <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start border-left-line">
                                    <div>
                                        <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                            <i data-feather="bell"></i>
                                        </a>
                                    </div>
                                    <div class="ml-3 mt-2">
                                        <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                        </h5>
                                        <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                        <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                            Ago</span>
                                        <a href="javascript:void(0)" class="font-14 border-bottom pb-1 border-info">Load
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center text-muted">
            All Rights Reserved by Adminmart. Designed and Developed by
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
     document.addEventListener("DOMContentLoaded", function () {

    function setActiveTab(tabName) {
        // Update tab UI
        document.querySelectorAll('.dashboard-tabs .tab-item').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
        let selectedTab = document.querySelector('.dashboard-tabs .tab-item[data-tab="' + tabName + '"]');
        let selectedPane = document.getElementById(tabName);
        if (selectedTab && selectedPane) {
            selectedTab.classList.add('active');
            selectedPane.classList.add('active');
        }

        // Update sidebar visibility
        if(tabName === "buyer") {
            document.getElementById("buyer-section").style.display = "block";
            document.getElementById("seller-section").style.display = "none";
        } else if(tabName === "seller") {
            document.getElementById("buyer-section").style.display = "none";
            document.getElementById("seller-section").style.display = "block";
        }
    }

    // Get current tab from URL or localStorage or default
    let urlParams = new URLSearchParams(window.location.search);
    let currentTab = urlParams.get('tab') || localStorage.getItem("activeDashboardTab") || 'buyer';

    setActiveTab(currentTab);

    // Update URL and localStorage
    let url = new URL(window.location.href);
    url.searchParams.set('tab', currentTab);
    window.history.replaceState(null, '', url.toString());
    localStorage.setItem("activeDashboardTab", currentTab);

    // Add click listeners to tabs
    document.querySelectorAll('.dashboard-tabs .tab-item').forEach(item => {
        item.addEventListener('click', function () {
            let selectedTab = this.getAttribute('data-tab');

            setActiveTab(selectedTab);

            // Update URL without reload
            let url = new URL(window.location.href);
            url.searchParams.set('tab', selectedTab);
            window.history.pushState(null, '', url.toString());

            // Save selected tab to localStorage
            localStorage.setItem("activeDashboardTab", selectedTab);
        });
    });

    // Update tab/sidebar on browser back/forward
    window.addEventListener('popstate', () => {
        let urlParams = new URLSearchParams(window.location.search);
        let tab = urlParams.get('tab') || 'buyer';
        setActiveTab(tab);
        localStorage.setItem("activeDashboardTab", tab);
    });

    // Create listing button redirect (existing code)
    document.getElementById("create-listing-btn").addEventListener("click", function () {
        let url = "<?php echo e(route('add-listing', ['from' => 'dashboard'])); ?>";
        window.location.href = url;
    });

});

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/dashboard.blade.php ENDPATH**/ ?>