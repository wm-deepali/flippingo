

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

          <form id='loginForm' action="#" class="" style="padding: 30px 20px;">
            <div class="card-body">
              <div class="text-center">
                <h4 class="font-size-28 font-weight-semi-bold mb-1 mt-4">Login to your account</h4>
                <p class="card-text">with your social network</p>
                <div class="d-flex flex-wrap align-items-center justify-content-between my-4 sign-g">
                  <a href="<?php echo e(route('google.redirect')); ?>" class="theme-btn flex-grow-1 mx-1 my-1  ">
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
                <label class="label-text">Sign in with Mobile / Email Id</label>
                <input class="form-control form--control ps-3" type="text" name="loginId" id="loginId"
                  placeholder="Enter Mobile / Email" />
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

              <button class="theme-btn border-0 w-100 hidden" type="submit" id="submitBtn" style="display:none;">Login
                Now</button>

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
    function showNextField() {
      let loginId = document.getElementById("loginId").value.trim();
      if (loginId === "") {
        Swal.fire({ icon: "error", title: "Required", text: "Please enter Mobile / Username / Email Id" });
        return;
      }

      // Regex to check if input is a phone number
      let phoneRegex = /^[0-9]{10,15}$/;

      if (phoneRegex.test(loginId)) {
        // Phone detected → Send OTP
        sendOtp(loginId);
      } else {
        // Email/username → show password field
        document.getElementById("passwordBox").classList.remove("hidden");
        document.getElementById("rememberBox").classList.remove("hidden");
        document.getElementById("submitBtn").style.display = "block";
      }

      // Hide arrow button after step 1
      document.querySelector(".arrow-btn").style.display = "none";
    }

    function sendOtp(phone) {
      fetch("<?php echo e(route('send.otp')); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
        },
        body: JSON.stringify({ mobile: phone })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {

            // Reuse same password box → make it OTP input
            document.querySelector("#passwordBox label").innerText = "Enter OTP";
            document.querySelector("#passwordBox input").setAttribute("type", "text");
            document.querySelector("#passwordBox input").setAttribute("placeholder", "Enter OTP");

            document.getElementById("passwordBox").classList.remove("hidden");
            document.getElementById("submitBtn").style.display = "block";
          } else {
            Swal.fire({ icon: "error", title: "Failed", text: data.message || "Failed to send OTP" });
            // show arrow button again for retry
            document.querySelector(".arrow-btn").style.display = "inline-block";
          }
        })
        .catch(err => {
          console.error(err);
          Swal.fire({ icon: "error", title: "Error", text: "Error sending OTP" });
          document.querySelector(".arrow-btn").style.display = "inline-block";
        });
    }

    // Final submit via AJAX
    // Final submit via AJAX
    document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();

      let loginId = document.getElementById("loginId").value.trim();
      let passwordOrOtp = document.querySelector("#passwordBox input").value.trim();

      fetch("<?php echo e(route('customer.authenticate')); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
        },
        body: JSON.stringify({
          loginId: loginId,
          password: passwordOrOtp
        })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            window.location.href = data.redirect ?? "<?php echo e(route('dashboard.index')); ?>";
          } else if (data.pending_deletion) {
            // Show SweetAlert for pending deletion
            Swal.fire({
              title: 'Account Pending Deletion',
              text: data.message,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, restore account',
              cancelButtonText: 'Cancel'
            }).then((result) => {
              if (result.isConfirmed) {
                // Call route to restore account
                fetch("<?php echo e(route('customer.restore')); ?>", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                  },
                  body: JSON.stringify({ loginId: loginId }) // optional
                })
                  .then(res => res.json())
                  .then(resData => {
                    if (resData.success) {
                      Swal.fire('Restored!', resData.message, 'success')
                        .then(() => {
                          // After restore, attempt login again
                          document.getElementById("loginForm").dispatchEvent(new Event('submit'));
                        });
                    } else {
                      Swal.fire('Error!', resData.message, 'error');
                    }
                  })
                  .catch(err => {
                    console.error(err);
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                  });
              }
            });
          } else {
            Swal.fire({ icon: "error", title: "Login Failed", text: data.message || "Invalid credentials/OTP" });
          }
        })
        .catch(err => {
          console.error(err);
          Swal.fire({ icon: "error", title: "Error", text: "Error during login" });
        });
    });

  </script>

  <?php if(session('pending_deletion')): ?>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        let loginId = "<?php echo e(session('loginId')); ?>";
        Swal.fire({
          title: 'Account Pending Deletion',
          text: "<?php echo e(session('pending_message')); ?>",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, restore account',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            // Call restore route
            fetch("<?php echo e(route('customer.restore')); ?>", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
              },
              body: JSON.stringify({ loginId: loginId })
            })
              .then(res => res.json())
              .then(resData => {
                if (resData.success) {
                  Swal.fire('Restored!', resData.message, 'success')
                    .then(() => {
                      // Log in automatically
                      fetch("<?php echo e(route('customer.authenticate')); ?>", {
                        method: "POST",
                        headers: {
                          "Content-Type": "application/json",
                          "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                        },
                        body: JSON.stringify({ loginId: loginId, password: '' }) // no password needed for Google
                      })
                        .then(r => r.json())
                        .then(d => {
                          if (d.success) {
                            window.location.href = d.redirect ?? "<?php echo e(route('dashboard.index')); ?>";
                          } else {
                            Swal.fire('Error', d.message, 'error');
                          }
                        });
                    });
                } else {
                  Swal.fire('Error!', resData.message, 'error');
                }
              })
              .catch(err => {
                console.error(err);
                Swal.fire('Error!', 'Something went wrong.', 'error');
              });
          }
        });
      });
    </script>
  <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/authentication-signin.blade.php ENDPATH**/ ?>