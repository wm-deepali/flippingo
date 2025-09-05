<!DOCTYPE html>
<html dir="ltr" lang="en">



<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content=" Flippingo" />
    <meta name="description" content="Flippingo Admin">
    <meta name="keywords" content="Flippingo Admin">

    <?php echo $__env->yieldPushContent('before-styles'); ?>
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('user_assets')); ?>/images/favicon.png">
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('user_assets')); ?>/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('user_assets')); ?>/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('user_assets')); ?>/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('user_assets')); ?>/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="index.html">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="<?php echo e(asset('user_assets')); ?>/images/logo-icon.png" alt="homepage"
                                    class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="<?php echo e(asset('user_assets')); ?>/images/logo-icon.png" alt="homepage"
                                    class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="<?php echo e(asset('user_assets')); ?>/images/logo-text.png" alt="homepage"
                                    class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="<?php echo e(asset('user_assets')); ?>/images/logo-light-text.png" class="light-logo"
                                    alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <!-- Notification -->
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form>
                            </a>
                        </li>
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="customize-input">
                                    <select
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>EN</option>

                                    </select>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge badge-primary notify-no rounded-circle">5</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="message-center notifications position-relative">
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-danger rounded-circle btn-circle"><i
                                                        data-feather="airplay" class="text-white"></i></div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Luanch Admin</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">Just see
                                                        the my new
                                                        admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success text-white rounded-circle btn-circle"><i
                                                        data-feather="calendar" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Event today</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted text-truncate">Just
                                                        a reminder that you have event</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-info rounded-circle btn-circle"><i
                                                        data-feather="settings" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Settings</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted text-truncate">You
                                                        can customize this template
                                                        as you want</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-primary rounded-circle btn-circle"><i
                                                        data-feather="box" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Pavan kumar</h6> <span
                                                        class="font-12 text-nowrap d-block text-muted">Just
                                                        see the my admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                                            <strong>Check all notifications</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Notification -->
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="settings" class="svg-icon"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <?php
                            $customer = auth('customer')->user();
                        ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo e($customer->profile_pic ? asset('storage/' . $customer->profile_pic) : asset('user_assets/images/users/profile-pic.jpg')); ?>"
                                    alt="user" class="rounded-circle" width="40">
                                <span class="ml-2 d-none d-lg-inline-block">
                                    <span
                                        class="text-dark"><?php echo e($customer->first_name . ' ' . $customer->last_name); ?></span>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="dropdown-header px-3 py-2">
                                    <h6 class="mb-0 font-weight-bold">
                                        <?php echo e($customer->first_name . ' ' . $customer->last_name); ?>

                                    </h6>
                                    <small class="text-muted"><?php echo e($customer->email); ?></small>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item d-flex align-items-center"
                                    href="<?php echo e(route('dashboard.profile')); ?>">
                                    <i data-feather="user" class="svg-icon mr-2" style="width: 40px;height: 40px;display: flex;justify-content: center;align-items: center;
                       border-radius: 50%;background-color: rgba(0,0,0,0.116);font-size: 20px;padding: 7px;"></i>
                                    <span class="d-flex justify-content-center flex-column">
                                        Profile
                                        <small class="text-muted">Manage your account</small>
                                    </span>
                                </a>

                                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('dashboard.wallet')); ?>">
                                    <i data-feather="credit-card" class="svg-icon mr-2" style="width: 40px;height: 40px;display: flex;justify-content: center;align-items: center;
                       border-radius: 50%;background-color: #036b081e;font-size: 20px;padding: 7px;"></i>
                                    <span class="d-flex justify-content-center flex-column" style="color: green;">
                                        Wallet
                                        <small class="text-muted">Manage your fund</small>
                                    </span>
                                </a>

                                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('dashboard.contact')); ?>">
                                    <i data-feather="help-circle" class="svg-icon mr-2" style="width: 40px;height: 40px;display: flex;justify-content: center;align-items: center;
                       border-radius: 50%;background-color: rgba(0,255,255,0.116);font-size: 20px;padding: 7px;"></i>
                                    <span class="d-flex justify-content-center flex-column">
                                        Support
                                        <small class="text-muted">Update your setting</small>
                                    </span>
                                </a>

                                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(Route('account-logout')); ?>"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out" class="svg-icon mr-2" style="width: 40px;height: 40px;display: flex;justify-content: center;align-items: center;
                       border-radius: 50%;background-color: rgba(160,23,5,0.116);font-size: 20px;padding: 7px;"></i>
                                    <span class="d-flex justify-content-center flex-column" style="color: red;">
                                        Logout
                                        <small class="text-muted">Sign out of your account</small>
                                    </span>
                                </a>

                            </div>
                        </li>

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo e(asset('user_assets')); ?>/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- apps -->
    <!-- apps -->
    <script src="<?php echo e(asset('user_assets')); ?>/js/app-style-switcher.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/js/feather.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo e(asset('user_assets')); ?>/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="<?php echo e(asset('user_assets')); ?>/extra-libs/c3/d3.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/extra-libs/c3/c3.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/libs/chartist/dist/chartist.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo e(asset('user_assets')); ?>/js/pages/dashboards/dashboard1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>


<!-- Mirrored from technext.github.io/adminmart/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Sep 2025 12:10:03 GMT -->

</html><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/layouts/user-master.blade.php ENDPATH**/ ?>