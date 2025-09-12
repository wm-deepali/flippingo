<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-brand-center"
  data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="<?php echo e(url('admin/home')); ?>">
          <span class="brand-logo">
            <?php if(\Auth::user()->logo_img): ?>
              <img src="<?php echo e(asset('images/logo/' . \Auth::user()->logo_img)); ?>" alt=""
                style="background-color: #000; border-radius: 7px; padding: 7px 10px;">
            <?php else: ?>
              <img src="<?php echo e(asset('admin_assets')); ?>/images/logo.png" alt=""
                style="background-color: #000; border-radius: 7px; padding: 7px 10px;">
            <?php endif; ?>
          </span>
        </a>
      </li>
    </ul>
  </div>
  <div class="navbar-container d-flex content align-items-center">
    <div class="bookmark-wrapper d-flex align-items-center">
      <ul class="nav navbar-nav d-xl-none">
        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
              data-feather="menu"></i></a></li>
      </ul>
    </div>
    <ul class="nav navbar-nav align-items-center ml-auto">
      <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
            data-feather="search"></i></a>
        <div class="search-input">
          <div class="search-input-icon"><i data-feather="search"></i></div>
          <input class="form-control input" type="text" placeholder="Search..." tabindex="-1" data-search="search">
          <div class="search-input-close"><i data-feather="x"></i></div>
          <ul class="search-list search-list-main"></ul>
        </div>
      </li>



      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name font-weight-bolder"><?php echo e(\Auth::user()->name); ?></span>
            <span class="user-status"><?php echo e(ucfirst(\Auth::user()->username)); ?></span>
          </div>
          <span class="avatar">
            <?php if(\Auth::user()->profile_img): ?>
              <img class="round" src="<?php echo e(asset('images/profiles/' . \Auth::user()->profile_img)); ?>" alt="Robert Downey"
                height="40" width="40">
            <?php else: ?>
              <img class="round" src="<?php echo e(asset('admin_assets')); ?>/images/admin-profile.png" alt="Robert Downey"
                height="40" width="40">
            <?php endif; ?>
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
          <a class="dropdown-item" href="<?php echo e(route('profile.show')); ?>">
            <i class="mr-50" data-feather="user"></i> Profile
          </a>

          <a class="dropdown-item" href="<?php echo e(route('profile.account-setting')); ?>">
            <i class="mr-50" data-feather="settings"></i> Account Settings
          </a>

          <a class="dropdown-item" href="<?php echo e(route('admin.settings.index')); ?>">
            <i class="mr-50" data-feather="sliders"></i> Admin Settings
          </a>

          <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="mr-50" data-feather="power"></i> <?php echo e(__('Logout')); ?>

          </a>

          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
          </form>
        </div>

      </li>
    </ul>
  </div>
</nav>

<div class="horizontal-menu-wrapper">
  <div
    class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border"
    role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
          <a class="navbar-brand" href="index.html">
            <span class="brand-logo">
              <img src="<?php echo e(asset('admin_assets')); ?>/images/logo.png" alt="">
            </span>
          </a>
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
              class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item active"><a class="nav-link d-flex align-items-center"
            href="<?php echo e(route('admin.home')); ?>"><span>Dashboard</span></a></li>
        <!--li class="nav-item"><a class="nav-link d-flex align-items-center" href="<?php echo e(route('slider.index')); ?>"><span>Slider</span></a></li-->
        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Master</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.manage-categories.index')); ?>"><span>Categories</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.form.index')); ?>"><span>Form
                  Builder</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.form-templates.index')); ?>"><span>Templates</span></a></li>
          </ul>
        </li>

        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Buyers & Sellers</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.customers.index')); ?>"><span>Manage Users</span></a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.seller-income')); ?>">
                <span>Seller Income Detail</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.admin-commission')); ?>">
                <span>Commission & Income</span>
              </a>
            </li>


            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.account_deletion_requests.index')); ?>"><span>Account Delete Request</span></a>
            </li>

          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Wallet</span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.wallets.index')); ?>">
                <span>Manage User Wallet</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.withdrawal-requests.index')); ?>">
                <span>Withdrawal Request</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.seller_payouts.index')); ?>">
                <span>Seller Payout</span>
              </a>
            </li>
          </ul>
        </li>


        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Subscriptions & Orders</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.packages.index')); ?>"><span>Manage Subscriptions</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.subscriptions.orders')); ?>"><span>Subscriptions Orders</span></a></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.product-orders.index')); ?>">
                Sales Orders
              </a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.subscriptions.cancellationRequests')); ?>"><span>Subscription Cancellation
                  Request</span></a></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.payments.index')); ?>">
                Manage Order Payments
              </a>
            </li>
          </ul>
        </li>
        <!--  <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Orders & Sales</span>
          </a>
          <ul class="dropdown-menu">
            
            
            
          </ul>
        </li> -->

        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Listings & Enquiries</span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.form-submissions.index')); ?>">
                Manage Listing
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.enquiry.index')); ?>">
                Listing Enquiry
              </a>
            </li>
          </ul>
        </li>

        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Analytics & Reports</span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.subscriptions.reports')); ?>">
                Subscription Reports
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.sales.reports')); ?>">
                Sales Reports
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.form-submissions.index')); ?>">
                Analytics
              </a>
            </li>

          </ul>
        </li>

        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Tickets</span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.form-submissions.index')); ?>">
                Buyer Tickets
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.form-submissions.index')); ?>">
                Seller Tickets
              </a>
            </li>

          </ul>
        </li>

        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Content Management</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.content.dynamic.pages')); ?>"><span>Dynamic Page Creations</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.testimonials.index')); ?>"><span>Testimonials Content</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.client-reels.index')); ?>"><span>Client Reels</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.client-reels.index')); ?>"><span>Listing Rejection Reasons</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.client-reels.index')); ?>"><span>Order Cancellation Reasons</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.deletion_reasons.index')); ?>"><span> Account Delete Reasons</span></a>
            </li>
          </ul>
        </li>


        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>FAQ & Blogs</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.faq-categories.index')); ?>"><span>FAQ Category</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.faqs.index')); ?>"><span>Manage
                  FAQ</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="<?php echo e(route('admin.blog-categories.index')); ?>"><span>Blogs Category</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('admin.blogs.index')); ?>"><span>Manage
                  Blogs</span></a>
            </li>
          </ul>
        </li>


      </ul>
    </div>
  </div>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/partials/header.blade.php ENDPATH**/ ?>