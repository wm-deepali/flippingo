

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
    <div class="container ">
    <div class="row align-items-center">



      <!-- Right side form -->
      <div class="col-lg-12 login-page">
      <div class="loginimg">
        <img
        src="https://img.freepik.com/free-vector/user-verification-unauthorized-access-prevention-private-account-authentication-cyber-security-people-entering-login-password-safety-measures_335657-3530.jpg"
        alt="Login illustration" class="img-fluid rounded ">
      </div>

      <form action="#" class="" style="padding: 30px 20px;">
        <div class="card-body">
        <div class="text-center">
          <h4 class="font-size-28 font-weight-semi-bold mb-1 mt-4">Login to your account</h4>
          <p class="card-text">with your social network</p>
          <div class="d-flex flex-wrap align-items-center justify-content-between my-4 sign-g">
          <a href="#" class="theme-btn flex-grow-1 mx-1 my-1  ">
            <img src="https://images.icon-icons.com/2699/PNG/512/google_logo_icon_169090.png"> Sign In with Google
          </a>
          </div>
        </div>

        <div class="d-flex align-items-center">
          <hr class="border-top-gray flex-grow-1" />
          <span class="mx-1 text-uppercase">or</span>
          <hr class="border-top-gray flex-grow-1" />
        </div>

        <!-- Step 1: Username / Email / Mobile -->
        <div class="form-group position-relative mt-4">
          <label class="label-text">Sign in with Mobile / Username / Email Id</label>
          <input class="form-control form--control ps-3" type="text" name="loginId" id="loginId"
          placeholder="Enter Mobile / Username / Email" />
          <button type="button" class="arrow-btn" onclick="showNextField()">➜</button>
        </div>

        <!-- Step 2: Hidden initially -->
        <div class="form-group hidden" id="passwordBox">
          <label class="label-text">Password / OTP</label>
          <div class="position-relative">
          <input class="form-control form--control ps-3" type="password" name="password"
            placeholder="Enter Password / OTP" />
          </div>
        </div>

        <!-- Remember + Forgot -->
        <div class="form-group d-flex align-items-center justify-content-between hidden" id="rememberBox">
          <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="RememberMe" />
          <label class="custom-control-label" for="RememberMe">Remember Me</label>
          </div>
          <a href="<?php echo e(Route('recover')); ?>" class="btn-link">Forgot password?</a>
        </div>

        <!-- Submit Button -->
        <button class="theme-btn border-0 w-100 hidden" id="submitBtn" type="submit">
          Login Now
        </button>

        <p class="mt-5 text-center">
          Not a member?
          <a href="<?php echo e(Route('authentication-signup')); ?>" class="btn-link">Register</a>
        </p>
        </div>
      </form>
      </div>

      <!-- Styles -->


      <!-- Script -->



    </div>
    </div>
  </section>

  <!-- end contact-area -->
  <!-- ================================
    END CONTACT AREA
  ================================= -->
    <script>
  function showNextField() {
    let loginId = document.getElementById("loginId").value.trim();
    if (loginId === "") {
      alert("Please enter Mobile / Username / Email Id");
      return;
    }

    // Show password/OTP + extra options
    document.getElementById("passwordBox").classList.remove("hidden");
    document.getElementById("rememberBox").classList.remove("hidden");
    document.getElementById("submitBtn").classList.remove("hidden");

    // Hide arrow button
    document.querySelector(".arrow-btn").classList.add("hidden");
  }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/authentication-signin.blade.php ENDPATH**/ ?>