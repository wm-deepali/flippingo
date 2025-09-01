

<?php $__env->startSection('title'); ?>
    Flippingo -Dashboard
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
 <section class="breadcrumb-area bread-bg" style="margin-top: 50px;">
    <div class="overlay"></div>
    <!-- end overlay -->
    <div class="container">
      <div class="breadcrumb-content text-center">
        <h2 class="sec__title text-white mb-3">Dashboard</h2>
        <ul class="bread-list">
          <li><a href="<?php echo e(Route('home')); ?>">home</a></li>
          <li>Dashboard</li>
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
    <section class="contact-area padding-top-60px padding-bottom-90px">
        <div class="container">
            <div class="row align-items-center">
                <h3 class="d-none">Account</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body">
                                        <p>Hello <strong>Madison Ruiz</strong> (not <strong>Madison Ruiz?</strong> <a
                                                href="<?php echo e(route('account-logout')); ?>">Logout</a>)</p>
                                        <p>From your account dashboard you can view your Recent Orders, manage your
                                            shipping and billing addesses and edit your password and account details</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </section>

 <!-- <div class="page-wrapper">
        <div class="page-content">
            <section class="py-3 border-bottom d-none d-md-flex">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">My Orders</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Account</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-4">
                <div class="container">
                    <h3 class="d-none">Account</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                               	<?php echo $__env->make('layouts.includes.user-sidebar', ['activeMenu' => 'dashboard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="col-lg-8">
                                    <div class="card shadow-none mb-0">
                                        <div class="card-body">
                                            <p>Hello <strong>Madison Ruiz</strong> (not <strong>Madison Ruiz?</strong> <a
                                                    href="javascript:;">Logout</a>)</p>
                                            <p>From your account dashboard you can view your Recent Orders, manage your
                                                shipping and billing addesses and edit your password and account details</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div> -->

    <!--end page wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/dashboard.blade.php ENDPATH**/ ?>