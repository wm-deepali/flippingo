

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
      <h2 class="sec__title text-white mb-3">Sign Up</h2>
      <ul class="bread-list">
      <li><a href="<?php echo e(Route('home')); ?>">home</a></li>
      <li>Sign Up</li>
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

      <form id="signupForm" style="padding: 30px 20px;">
        <div class="text-center">
        <h4 class="font-size-28 font-weight-semi-bold mb-1 mt-4">Register your account</h4>
        <p class="card-text">with your social network</p>
        <div class="d-flex flex-wrap align-items-center justify-content-between my-4 sign-g">
          <a href="#" class="theme-btn flex-grow-1 mx-1 my-1" style="color: #000;">
          <img src="https://images.icon-icons.com/2699/PNG/512/google_logo_icon_169090.png"> Sign In with Google
          </a>
        </div>
        </div>

        <div class="d-flex align-items-center">
        <hr class="border-top-gray flex-grow-1" />
        <span class="mx-1 text-uppercase">or</span>
        <hr class="border-top-gray flex-grow-1" />
        </div>

        <!-- Step 1 -->
        <div id="step1" class="mt-3">
        <div class="input-group mb-3">
          <select class="form-select" style="max-width:120px;">
          <option value="+91">+91</option>
          <option value="+1">+1</option>
          <option value="+44">+44</option>
          </select>
          <input type="text" class="form-control" placeholder="Enter your mobile number">
          <button type="button" class="btn btn-primary" id="sendOtpBtn">➔</button>
        </div>
        <small class="text-muted d-block mb-3">In case of outside India, enter your WhatsApp number.</small>

        <!-- OTP Field (Hidden Initially) -->
        <div id="otpSection" class="d-none">
          <div class="d-flex mb-2">
          <input type="text" class="form-control me-2" placeholder="Enter OTP" style="width: 70%;">
          <button type="button" class="btn btn-outline-secondary" id="resendOtpBtn">Resend OTP</button>
          </div>
          <button type="button" class="btn btn-success w-100" id="verifyOtpBtn">Verify Now</button>
        </div>
        </div>

        <!-- Step 2 (Hidden Initially) -->
        <div id="step2" class="d-none">

        <!-- Individual / Entity -->
        <label for="accountType">Select Type:</label>
        <select id="accountType" name="accountType" class="form-control mb-3">
          <option value="">-- Select --</option>
          <option value="individual">Individual</option>
          <option value="entity">Entity</option>
        </select>


        <!-- Legal Name (Only if Entity) -->
        <div class="mb-3 d-none" id="legalNameField">
          <input type="text" class="form-control" placeholder="Enter Legal Name">
        </div>

        <!-- Other Fields -->
        <input type="text" class="form-control mb-3" placeholder="Full Name">
        <input type="email" class="form-control mb-3" placeholder="Email Id">
        <input type="text" class="form-control mb-3" placeholder="Username">

        <!-- Password with Eye Icon -->
        <div class="mb-3 position-relative">
          <input type="password" class="form-control" placeholder="Create Password" id="passwordField">
          <button type="button"
          class="btn position-absolute end-0 top-0 h-100 border-0 bg-transparent toggle-password"
          data-target="passwordField">
          <i class="fa fa-eye"></i>
          </button>
        </div>

        <div class="mb-3 position-relative">
          <input type="password" class="form-control" placeholder="Confirm Password" id="confirmPasswordField">
          <button type="button"
          class="btn position-absolute end-0 top-0 h-100 border-0 bg-transparent toggle-password"
          data-target="confirmPasswordField">
          <i class="fa fa-eye"></i>
          </button>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
      </form>
      </div>

      <!-- Script -->


    </div>
  </section>

  <!-- end contact-area -->
  <!-- ================================
    END CONTACT AREA
  ================================= -->
  <script>
    // Show OTP input after clicking arrow
    document.getElementById('sendOtpBtn').addEventListener('click', function () {
    document.getElementById('otpSection').classList.remove('d-none');
    });

    // Resend OTP
    document.getElementById('resendOtpBtn').addEventListener('click', function () {
    alert('OTP Resent!');
    });

    // Move to Step 2 after OTP verification
    document.getElementById('verifyOtpBtn').addEventListener('click', function () {
    document.getElementById('step1').classList.add('d-none');
    document.getElementById('step2').classList.remove('d-none');
    });

    // Show Legal Name if Entity selected
    document.getElementById('entity').addEventListener('change', function () {
    document.getElementById('legalNameField').classList.remove('d-none');
    });
    document.getElementById('individual').addEventListener('change', function () {
    document.getElementById('legalNameField').classList.add('d-none');
    });

    // Toggle Password Visibility

    document.querySelectorAll(".toggle-password").forEach(btn => {
    btn.addEventListener("click", function () {
      let target = document.getElementById(this.dataset.target);
      if (target.type === "password") {
      target.type = "text";
      this.innerHTML = '<i class="fa fa-eye-slash"></i>';
      } else {
      target.type = "password";
      this.innerHTML = '<i class="fa fa-eye"></i>';
      }
    });
    });


  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/authentication-signup.blade.php ENDPATH**/ ?>