@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('content')

<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <section id="dashboard-ecommerce">
        <div class="dashboard-boxes">
          <div class="row">
            <div class="col-md-3">
              <div class="card card-statistics">
                <div class="boxes-block">
                  <a href="#">
                   <i class="fa-brands fa-product-hunt"></i>
                    <h4><span>120K</span> Active Listings</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-statistics">
                <div class="boxes-block">
                  <a href="#">
                    <i class="fa-solid fa-users"></i>
                    <h4><span>234</span> Buyers </h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-statistics">
                <div class="boxes-block">
                  <a href="#">
                    <i class="fa-solid fa-receipt"></i>
                    <h4><span>344</span> Sellers</h4>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-statistics">
                <div class="boxes-block">
                  <a href="#">
                    <i class="fa-solid fa-money-bill"></i>
                    <h4><span>₹ 987654</span> Subscriptions Orders</h4>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row match-height">
          <div class="col-lg-8 col-12">
            <div class="card card-revenue-budget">
              <div class="row mx-0">
                <div class="col-md-8 col-12 revenue-report-wrapper">
                  <div class="d-sm-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-50 mb-sm-0">Listing Sales Report</h4>
                    <!--<div class="d-flex align-items-center">-->
                    <!--  <div class="d-flex align-items-center mr-2">-->
                    <!--    <span class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span>-->
                    <!--    <span>Earningss</span>-->
                    <!--  </div>-->
                    <!--  <div class="d-flex align-items-center ml-75">-->
                    <!--    <span class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span>-->
                    <!--    <span>Refund</span>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>
                  <div id="revenue-report-chart"></div>
                </div>
                <div class="col-md-4 col-12 budget-wrapper">
                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          2025
                        </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript:void(0);">2024</a>
                      <a class="dropdown-item" href="javascript:void(0);">2023</a>
                      <a class="dropdown-item" href="javascript:void(0);">2022</a>
                    </div>
                  </div>
                  <h2 class="mb-25">₹ 25852000</h2>
                  <div class="d-flex justify-content-center">
                    <span class="font-weight-bolder mr-25"> Last Month:</span>
                    <span>₹ 445354</span>
                  </div>
                  <div id="budget-chart"></div>
                  <button type="button" class="btn btn-primary">View Orders</button>
                </div>
              </div>
            </div>
          </div>
          
          
            <!-- RIGHT SIDE (4 columns for Live Chat) -->
<div class="col-xl-4 col-md-4 col-12">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title">Live Chat</h4>
      <button class="btn btn-sm btn-primary">View All</button>
    </div>
    <div class="card-body p-0" style="max-height: 800px; overflow-y: auto;">
      
      <!-- Chat List -->
      <div class="list-group list-group-flush">

        <!-- Odd -->
        <a href="chat.php?user_id=1" class="list-group-item list-group-item-action d-flex align-items-start bg-light">
          <img src="https://via.placeholder.com/45" class="rounded-circle mr-2" alt="User Photo">
          <div class="w-100">
            <div class="d-flex justify-content-between">
              <h6 class="mb-0">John Doe <span class="badge badge-success ml-1">Buyer</span></h6>
              <small class="text-muted">2025-09-09 14:30</small>
            </div>
            <small class="text-muted">Hey, can we schedule a call tomorrow?</small>
          </div>
        </a>

        <!-- Even -->
        <a href="chat.php?user_id=2" class="list-group-item list-group-item-action d-flex align-items-start">
          <img src="https://via.placeholder.com/45" class="rounded-circle mr-2" alt="User Photo">
          <div class="w-100">
            <div class="d-flex justify-content-between">
              <h6 class="mb-0">Jane Smith <span class="badge badge-primary ml-1">Seller</span></h6>
              <small class="text-muted">2025-09-09 15:00</small>
            </div>
            <small class="text-muted">I’ve sent the payment, please confirm.</small>
          </div>
        </a>

        <!-- Odd -->
        <a href="chat.php?user_id=3" class="list-group-item list-group-item-action d-flex align-items-start bg-light">
          <img src="https://via.placeholder.com/45" class="rounded-circle mr-2" alt="User Photo">
          <div class="w-100">
            <div class="d-flex justify-content-between">
              <h6 class="mb-0">Alice Brown <span class="badge badge-success ml-1">Buyer</span></h6>
              <small class="text-muted">2025-09-09 16:10</small>
            </div>
            <small class="text-muted">Looking forward to the demo session.</small>
          </div>
        </a>

        <!-- Even -->
        <a href="chat.php?user_id=4" class="list-group-item list-group-item-action d-flex align-items-start">
          <img src="https://via.placeholder.com/45" class="rounded-circle mr-2" alt="User Photo">
          <div class="w-100">
            <div class="d-flex justify-content-between">
              <h6 class="mb-0">Michael Lee <span class="badge badge-primary ml-1">Seller</span></h6>
              <small class="text-muted">2025-09-09 17:45</small>
            </div>
            <small class="text-muted">Thanks for the quick update!</small>
          </div>
        </a>

      </div>
    </div>
  </div>
</div>

<style>
  /* Custom hover color */
  .list-group-item-action:hover {
    background-color: #f1f7ff !important; /* Light blue on hover */
  }
</style>
        </div>

     <div class="row match-height">
  <!-- LEFT SIDE (8 columns for both tables) -->
  <div class="col-xl-8 col-md-8 col-12">
    
    <!-- First Table: Recent Subscription Orders -->
    <div class="card mb-2">
      <div class="card-header">
        <h4 class="card-title">Recent Subscription Orders</h4>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="quoteTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="seven-days-tab" data-toggle="tab" href="#seven-days" role="tab" aria-controls="seven-days" aria-selected="true">7 Days</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="fifteen-days-tab" data-toggle="tab" href="#fifteen-days" role="tab" aria-controls="fifteen-days" aria-selected="false">15 Days</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="thirty-days-tab" data-toggle="tab" href="#thirty-days" role="tab" aria-controls="thirty-days" aria-selected="false">30 Days</a>
          </li>
          <li class="nav-item ml-auto">
            <button class="btn btn-primary">Show All</button>
          </li>
        </ul>
        <div class="tab-content mt-2">
          <div class="tab-pane active" id="seven-days" role="tabpanel" aria-labelledby="seven-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Order Id</th>
                    <th>Buyer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-09-10 14:30</td>
                    <td>#345446<br>Books > Basic Plan</td>
                    <td>John Doe<br>john.doe@example.com<br>+1-555-123-4567</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                  <tr>
                    <td>2025-09-10 14:30</td>
                    <td>#345446<br>Books > Basic Plan</td>
                    <td>John Doe<br>john.doe@example.com<br>+1-555-123-4567</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                  <tr>
                    <td>2025-09-10 14:30</td>
                    <td>#345446<br>Books > Basic Plan</td>
                    <td>John Doe<br>john.doe@example.com<br>+1-555-123-4567</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane" id="fifteen-days" role="tabpanel" aria-labelledby="fifteen-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Order Id </th>
                    <th>Buyer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-09-05 09:15</td>
                    <td>#345447<br>Standard Plan </td>
                    <td>Jane Smith<br>jane.smith@example.com<br>+1-555-987-6543</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane" id="thirty-days" role="tabpanel" aria-labelledby="thirty-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Order Id</th>
                    <th>Buyer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-09-25 16:45</td>
                    <td>#345448<br>Basic Plan</td>
                    <td>Alice Brown<br>alice.brown@example.com<br>+1-555-456-7890</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Second Table: Recent Listing Sales -->
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Recent Listing Sales</h4>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="quoteTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="seven-days-tab" data-toggle="tab" href="#seven-days-sales" role="tab" aria-controls="seven-days-sales" aria-selected="true">7 Days</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="fifteen-days-tab" data-toggle="tab" href="#fifteen-days-sales" role="tab" aria-controls="fifteen-days-sales" aria-selected="false">15 Days</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="thirty-days-tab" data-toggle="tab" href="#thirty-days-sales" role="tab" aria-controls="thirty-days-sales" aria-selected="false">30 Days</a>
          </li>
          <li class="nav-item ml-auto">
            <button class="btn btn-primary">Show All</button>
          </li>
        </ul>
        <div class="tab-content mt-2">
          <div class="tab-pane active" id="seven-days-sales" role="tabpanel" aria-labelledby="seven-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Order Id </th>
                    <th>Buyer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-08-25 16:45</td>
                    <td>#345448<br>Blogs > New Blog for Sales</td>
                    <td>Alice Brown<br>alice.brown@example.com<br>+1-555-456-7890</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane" id="fifteen-days-sales" role="tabpanel" aria-labelledby="fifteen-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Order Id </th>
                    <th>Buyer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-08-25 16:45</td>
                    <td>#345448<br>Instagram > New Channel for Sales</td>
                    <td>Alice Brown<br>alice.brown@example.com<br>+1-555-456-7890</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane" id="thirty-days-sales" role="tabpanel" aria-labelledby="thirty-days-tab">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Date & Time</th>
                    <th>Order Id </th>
                    <th>Buyer Info</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-08-25 16:45</td>
                    <td>#345448<br>Youtube > New Channel for Sales</td>
                    <td>Alice Brown<br>alice.brown@example.com<br>+1-555-456-7890</td>
                    <td><button class="btn btn-sm btn-info">Show Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>





<div class="col-lg-4 col-12">
            <div class="row match-height">
              <div class="col-lg-6 col-md-3 col-6">
                <div class="card">
                  <div class="card-body pb-50">
                    <h6>Total Users</h6>
                    <h2 class="font-weight-bolder mb-1">2,76K</h2>
                    <div id="statistics-order-chart"></div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-3 col-6">
                <div class="card card-tiny-line-stats">
                  <div class="card-body pb-50">
                    <h6>Earnings
</h6>
                    <h2 class="font-weight-bolder mb-1">6,24K</h2>
                    <div id="statistics-profit-chart"></div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-6 col-12">
                <div class="card earnings-card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <h4 class="card-title mb-1">Orders</h4>
                        <div class="font-small-2">This Month</div>
                        <h5 class="mb-1">₹ 405545</h5>
                        <p class="card-text text-muted font-small-2">
                          <span class="font-weight-bolder">68.2%</span><span> more revenue than last month.</span>
                        </p>
                      </div>
                      <div class="col-6">
                        <div id="earnings-chart"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              
              
              
                 <div class="col-lg-12 col-md-6 col-12">
                <div class="card earnings-card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <h4 class="card-title mb-1">Orders</h4>
                        <div class="font-small-2">This Month</div>
                        <h5 class="mb-1">₹ 405545</h5>
                        <p class="card-text text-muted font-small-2">
                          <span class="font-weight-bolder">68.2%</span><span> more revenue than last month.</span>
                        </p>
                      </div>
                      <div class="col-6">
                        <div id="earnings-chart"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

      </section>
    </div>
  </div>
</div>
@endsection
