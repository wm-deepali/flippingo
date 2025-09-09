

<?php $__env->startSection('title'); ?>
  <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<style>
  .country-code {
    max-width: 120px;
    border-radius: 6px 0 0 6px;
    border-right: none;
    background: #f9f9f9;
    padding: 6px;
    font-size: 14px;
  }
  
</style>
<?php $__env->startSection('content'); ?>
  <!-- ================================
                                  START BREADCRUMB AREA
                                ================================= -->

  <!-- end breadcrumb-area -->
  <!-- ================================
                                  END BREADCRUMB AREA
                                ================================= -->

  <!-- ================================
                                  START CONTACT AREA
                                ================================= -->
  <section class="contact-area" style="padding-top:220px; padding-bottom:90px;">
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
                  <a href="<?php echo e(route('google.redirect')); ?>" class="theme-btn flex-grow-1 mx-1 my-1  " style="color:#000;">
                    <img src="https://images.icon-icons.com/2699/PNG/512/google_logo_icon_169090.png"> Sign In with Google
                  </a>
                </div>
              </div>

              <hr>

              <!--<div class="d-flex align-items-center">-->
              <!--  <hr class="border-top-gray flex-grow-1" />-->
              <!--  <span class="mx-1 text-uppercase">or</span>-->
              <!--  <hr class="border-top-gray flex-grow-1" />-->
              <!--</div>-->

             
              
              
              <div class="form-group position-relative mt-3">
                <label class="label-text">Sign in with Mobile</label>
                <div class="input-group">
                  <select class="form-select country-code col-3" id="countryCode" name="countryCode">
                    <option value="+91"> +91</option>
                    <option value="+1"> +1</option>
                    <option value="+44"> +44</option>
                    <option value="+971"> +971</option>
                  </select>
                  <input class="form-control form--control" type="text" name="loginPhone" id="loginPhone"
                    placeholder="Enter Mobile Number" />
                  <button type="button" class="arrow-btn" onclick="showNextField('phone')">→</button>
                </div>
              </div>

              <div class="form-group hidden" id="passwordBoxPhone">
                <label class="label-text">Enter OTP</label>
                <div class="position-relative">
                  <input class="form-control form--control ps-3" type="password" name="password"
                    placeholder="Enter Password / OTP" />
                </div>
              </div>

              
              <div class="d-flex align-items-center">
                <hr class="border-top-gray flex-grow-1" />
                <span class="mx-1 text-uppercase">or</span>
                <hr class="border-top-gray flex-grow-1" />
              </div>

               <!-- Step 1: Username / Email / Mobile -->

              <div class="form-group position-relative mt-4">
                <label class="label-text">Sign in With E-mail / Username</label>
                <input class="form-control form--control ps-3" type="text" name="loginEmail" id="loginEmail"
                  placeholder="Enter E-mail Id / Username" />
                <button type="button" class="arrow-btn" onclick="showNextField('email')">→</button>
              </div>

              <!-- Step 2: Hidden initially -->
              <div class="form-group hidden" id="passwordBoxEmail">
                <label class="label-text">Enter Password</label>
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
                <a href="<?php echo e(Route('authentication-signup')); ?>" class="btn-link" style="color:blue;">Register</a>
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
document.addEventListener("DOMContentLoaded", function () {
  const emailInput = document.getElementById("loginEmail");
  const phoneInput = document.getElementById("loginPhone");
  const countryCode = document.getElementById("countryCode");
  const emailArrowBtn = document.querySelector("button.arrow-btn[onclick*='email']");
  const phoneArrowBtn = document.querySelector("button.arrow-btn[onclick*='phone']");

  emailInput.addEventListener("input", function () {
    if (emailInput.value.trim() !== "") {
      phoneInput.disabled = true;
      countryCode.disabled = true;
      phoneArrowBtn.disabled = true;
    } else {
      phoneInput.disabled = false;
      countryCode.disabled = false;
      phoneArrowBtn.disabled = false;
    }
  });

  phoneInput.addEventListener("input", function () {
    if (phoneInput.value.trim() !== "") {
      emailInput.disabled = true;
      emailArrowBtn.disabled = true;
    } else {
      emailInput.disabled = false;
      emailArrowBtn.disabled = false;
    }
  });
});


    function showNextField(type) {
      let loginId = "";

      if (type === 'email') {
        loginId = document.getElementById("loginEmail").value.trim();
      } else if (type === 'phone') {
        let code = document.getElementById("countryCode").value;
        let phone = document.getElementById("loginPhone").value.trim();
        loginId = phone;
      }

      if (loginId === "") {
        Swal.fire({ icon: "error", title: "Required", text: "Please enter Mobile / Username / Email Id" });
        return;
      }

      let phoneRegex = /^[0-9]{10,15}$/;
      let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (phoneRegex.test(loginId)) {
        // ✅ Mobile → send OTP
        sendOtp(loginId, 'mobile');
      } else {
        // ✅ Email OR Username → normal password
        document.querySelector("#passwordBoxEmail label").innerText = "Password";
        document.querySelector("#passwordBoxEmail input").setAttribute("type", "password");
        document.querySelector("#passwordBoxEmail input").setAttribute("placeholder", "Enter Password");

        document.getElementById("passwordBoxEmail").classList.remove("hidden");
        document.getElementById("passwordBoxEmail").classList.remove("hidden");
        document.getElementById("submitBtn").style.display = "block";
      }

      // hide arrows
   
    }



    function sendOtp(mobile, type) {
      fetch("<?php echo e(route('send.otp')); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
        },
        body: JSON.stringify({ value: mobile, type: 'mobile' })
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // turn passwordBox into OTP box
            //   document.querySelectorAll(".arrow-btn").forEach(btn => btn.style.display = "none");
            document.querySelector("#passwordBoxPhone label").innerText = "Enter OTP";
            document.querySelector("#passwordBoxPhone input").setAttribute("type", "text");
            document.querySelector("#passwordBoxPhone input").setAttribute("placeholder", "Enter OTP");

            document.getElementById("passwordBoxPhone").classList.remove("hidden");
            document.getElementById("submitBtn").style.display = "block";
          } else {
            Swal.fire({ icon: "error", title: "Failed", text: data.message || "Failed to send OTP" });
          }
        })
        .catch(err => {
          console.error(err);
          Swal.fire({ icon: "error", title: "Error", text: "Error sending OTP" });
        });
    }


    // Final submit via AJAX
    document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();

      let loginId = "";
      let passwordOrOtp = "";
      if (document.getElementById("loginEmail").value.trim() !== "") {
        loginId = document.getElementById("loginEmail").value.trim();
        passwordOrOtp = document.querySelector("#passwordBoxEmail input").value.trim();

      } else {
        loginId = document.getElementById("loginPhone").value.trim();
        passwordOrOtp = document.querySelector("#passwordBoxPhone input").value.trim();
      }


      fetch("<?php echo e(route('customer.authenticate')); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
        },
        body: JSON.stringify({ loginId: loginId, password: passwordOrOtp })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            window.location.href = data.redirect ?? "<?php echo e(route('dashboard.index')); ?>";
          } else {
            Swal.fire({ icon: "error", title: "Login Failed", text: data.message || "Invalid credentials/OTP" });
          }
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