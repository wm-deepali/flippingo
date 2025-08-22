

<?php $__env->startSection('title'); ?>
  <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- ================================
    START BREADCRUMB AREA
  ================================= -->
  <section class="breadcrumb-area bread-bg">
    <div class="overlay"></div>
    <!-- end overlay -->
    <div class="container">
    <div class="breadcrumb-content text-center">
      <h2 class="sec__title text-white mb-3">Recover Password</h2>
      <ul class="bread-list">
      <li><a href="<?php echo e(Route('home')); ?>">home</a></li>
      <li>Recover Password</li>
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

  <!-- ================================
    START RECOVERY AREA
  ================================= -->
  <section class="recovery-area padding-top-60px padding-bottom-90px">
    <div class="container">
    <div class="col-lg-7 mx-auto">
      <div class="card">
      <div class="card-body">
        <h4 class="card-title">Recover Password!</h4>
        <p class="card-text">
        Enter the email of your account to reset password. Then you will
        receive a link to email to reset the password.If you have any
        issue about reset password
        <a href="<?php echo e(Route('contact')); ?>" class="btn-link">Contact Us <i class="fal fa-angle-right ms-1"></i></a>
        </p>
        <hr class="border-top-gray" />
        <div class="form-group">
        <label class="label-text">Your Email</label>
        <input id="email" class="form-control form--control ps-3" type="email" name="email"
          placeholder="Enter email address" />
        </div>
        <button class="theme-btn border-0" type="submit">
        Reset Password
        </button>
        <p class="mt-3">
        <a href="<?php echo e(Route('authentication-signin')); ?>" class="btn-link">Login</a>
        or
        <a href="<?php echo e(Route('authentication-signup')); ?>" class="btn-link">Register</a>
        </p>
      </div>
      </div>
      <!-- end card -->
    </div>
    <!-- end col-lg-8 -->
    </div>
    <!-- end container -->
  </section>
  <!-- end recovery-area -->
  <!-- ================================
    END RECOVERY AREA
  ================================= -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\flippingo\resources\views/front/recover.blade.php ENDPATH**/ ?>