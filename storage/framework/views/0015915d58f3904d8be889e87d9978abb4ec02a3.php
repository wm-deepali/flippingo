

<?php $__env->startSection('title'); ?>
  <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- ================================
    START BREADCRUMB AREA
  ================================= -->
  <section class="breadcrumb-area bread-bg" style="margin-top: 50px;">
    <div class="overlay"></div>
    <!-- end overlay -->
    <div class="container">
    <div class="breadcrumb-content text-center">
      <h2 class="sec__title text-white mb-3">Login</h2>
      <ul class="bread-list">
      <li><a href="<?php echo e(Route('home')); ?>">home</a></li>
      <li>login</li>
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
    START CONTACT AREA
  ================================= -->
  <section class="contact-area padding-top-60px padding-bottom-90px">
    <div class="container">
    <div class="col-lg-5 mx-auto">
      <form action="#" class="card">
      <div class="card-body">
        <div class="text-center">
        <h4 class="font-size-28 font-weight-semi-bold mb-1">
          Login to your account
        </h4>
        <p class="card-text">with your social network</p>
        <div class="d-flex flex-wrap align-items-center justify-content-between my-4">
          <a href="#" class="theme-btn flex-grow-1 mx-1 my-1"><i class="fab fa-google me-2"></i>Google</a>
          <!-- <a href="#" class="theme-btn flex-grow-1 mx-1 my-1 bg-5"
            ><i class="fab fa-facebook-f me-2"></i>Facebook</a
            >
            <a href="#" class="theme-btn flex-grow-1 mx-1 my-1 bg-6"
            ><i class="fab fa-twitter me-2"></i>Twitter</a
            > -->
        </div>
        </div>
        <div class="d-flex align-items-center">
        <hr class="border-top-gray flex-grow-1" />
        <span class="mx-1 text-uppercase">or</span>
        <hr class="border-top-gray flex-grow-1" />
        </div>
        <div class="form-group">
        <label class="label-text">Username, or email</label>
        <input class="form-control form--control ps-3" type="text" name="name" placeholder="Username, or email" />
        </div>
        <!-- end form-group -->
        <div class="form-group">
        <label class="label-text">Password</label>
        <div class="position-relative">
          <input class="form-control form--control ps-3 password-field" type="password" name="password"
          placeholder="Password" />
          <a href="javascript:void(0)" class="position-absolute top-0 right-0 h-100 toggle-password"
          title="toggle show/hide password">
          <i class="far fa-eye eye-on"></i>
          <i class="far fa-eye-slash eye-off"></i>
          </a>
        </div>
        </div>
        <!-- end form-group -->
        <div class="form-group d-flex align-items-center justify-content-between">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="RememberMe" />
          <label class="custom-control-label" for="RememberMe">Remember Me</label>
        </div>
        <a href="<?php echo e(Route('recover')); ?>" class="btn-link">Forgot password?</a>
        </div>
        <!-- end form-group -->
        <button class="theme-btn border-0" type="submit">
        Login Now
        </button>
        <p class="mt-3">
        Not a member?
        <a href="<?php echo e(Route('authentication-signup')); ?>" class="btn-link">Register</a>
        </p>
      </div>
      </form>
    </div>
    <!-- end col-lg-7 -->
    </div>
    <!-- end container -->
  </section>
  <!-- end contact-area -->
  <!-- ================================
    END CONTACT AREA
  ================================= -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\flippingo\resources\views/front/authentication-signin.blade.php ENDPATH**/ ?>