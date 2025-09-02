

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

          <div id="signupForm" style="padding: 30px 20px;">
            <div class="text-center">
              <h4 class="font-size-28 font-weight-semi-bold mb-1 mt-4">Register your account</h4>
              <p class="card-text">with your social network</p>
              <div class="d-flex flex-wrap align-items-center justify-content-between my-4 sign-g">
                <a href="<?php echo e(route('google.redirect')); ?>" class="theme-btn flex-grow-1 mx-1 my-1" style="color: #000;">
                  <img src="https://images.icon-icons.com/2699/PNG/512/google_logo_icon_169090.png"> Sign Up with Google
                </a>
              </div>
            </div>

            <div class="d-flex align-items-center">
              <hr class="border-top-gray flex-grow-1" />
              <span class="mx-1 text-uppercase">or</span>
              <hr class="border-top-gray flex-grow-1" />
            </div>
            <div id="step1" class="mt-3">

              <!-- Main Input -->
              <div class="input-group mb-3">
                <input type="text" id="signupInput" class="form-control" placeholder="Sign up with Mobile / Email Id">
                <button type="button" class="btn btn-primary" id="nextBtn">Next ➔</button>
              </div>
              <small class="text-danger d-none" id="signupError"></small> <!-- error placeholder -->

              <!-- Country code (shown if phone) -->
              <div id="countryCodeSection" class="d-none mb-3">
                <label class="small text-muted">Select Country Code</label>
                <select class="form-select" id="countryCode" style="max-width:150px;">
                  <option value="+91">🇮🇳 +91</option>
                  <!-- <option value="+1">🇺🇸 +1</option> -->
                  <!-- <option value="+44">🇬🇧 +44</option> -->
                </select>
                <button type="button" class="btn btn-primary mt-2" id="sendOtpBtn">Send OTP</button>
              </div>

              <!-- OTP Field -->
              <div id="otpSection" class="d-none mt-3">
                <div class="d-flex mb-2">
                  <input type="text" class="form-control me-2" placeholder="Enter OTP" id="otpField" style="width: 70%;">
                  <button type="button" class="btn btn-outline-secondary" id="resendOtpBtn">Resend OTP</button>
                </div>
                <small class="text-danger d-none" id="otpError"></small> <!-- error placeholder -->
                <button type="button" class="btn btn-success w-100" id="verifyOtpBtn">Verify Now</button>
              </div>

            </div>


            <!-- <div id="step1" class="mt-3">
                                                  <div class="input-group mb-3">
                                                    <select class="form-select" style="max-width:120px;">
                                                    <option value="+91">+91</option>
                                                    <option value="+1">+1</option>
                                                    <option value="+44">+44</option>
                                                    </select>
                                                    <input type="text" class="form-control" placeholder="Sign up with Mobile / Email Id">
                                                    <button type="button" class="btn btn-primary" id="sendOtpBtn">➔</button>
                                                  </div>
                                                  <small class="text-muted d-block mb-3">In case of outside India, enter your WhatsApp number.</small> -->

            <!-- OTP Field (Hidden Initially) -->
            <!-- <div id="otpSection" class="d-none">
                                                            <div class="d-flex mb-2">
                                                            <input type="text" class="form-control me-2" placeholder="Enter OTP" style="width: 70%;">
                                                            <button type="button" class="btn btn-outline-secondary" id="resendOtpBtn">Resend OTP</button>
                                                            </div>
                                                            <button type="button" class="btn btn-success w-100" id="verifyOtpBtn">Verify Now</button>
                                                          </div>
                                                          </div> -->

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

              <input type="hidden" id="redirectUrl" value="<?php echo e(request()->query('redirect', url('/'))); ?>">

              <!-- Other Fields -->
              <input type="text" class="form-control mb-3" placeholder="First Name">
              <input type="text" class="form-control mb-3" placeholder="Last Name">
              <input type="email" class="form-control mb-3" placeholder="Email Id">
              <!-- 
                        <select class="form-select mb-3" name="country" id="inputSelectCountry" required>
                          <option value="">Select Country</option>
                          <?php $countries = countrylist(); ?>
                          <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select> -->

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
              <button type="button" id="finalSubmitBtn" class="btn btn-primary w-100">Submit</button>
            </div>
          </div>
        </div>

        <!-- Script -->

      </div>
  </section>

  <!-- end contact-area -->
  <!-- ================================
                                              END CONTACT AREA
                                            ================================= -->

  <script>
    document.addEventListener("DOMContentLoaded", function () {

      // Handle Next button
      document.getElementById('nextBtn').addEventListener('click', function () {
        const input = document.getElementById('signupInput').value.trim();
        const errorEl = document.getElementById('signupError');
        errorEl.classList.add('d-none'); // reset

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isEmail = emailPattern.test(input);

        if (isEmail) {
          document.getElementById('step1').classList.add('d-none');
          document.getElementById('step2').classList.remove('d-none');
        } else if (/^\d{8,15}$/.test(input)) {
          document.getElementById('countryCodeSection').classList.remove('d-none');
        } else {
          errorEl.textContent = "Please enter a valid email or phone number";
          errorEl.classList.remove('d-none');
        }
      });

      // OTP Verify
      document.getElementById('verifyOtpBtn').addEventListener('click', function () {
        const otp = document.getElementById('otpField').value.trim();
        const errorEl = document.getElementById('otpError');
        errorEl.classList.add('d-none');

        if (otp.length !== 6) {
          errorEl.textContent = "Please enter a valid 6-digit OTP";
          errorEl.classList.remove('d-none');
          return;
        }

        this.disabled = true;
        this.innerText = "Verifying...";

        fetch("<?php echo e(route('verify.otp')); ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
          },
          body: JSON.stringify({
            mobile: document.getElementById('signupInput').value.trim(),
            otp: otp,
            country_code: document.getElementById('countryCode').value
          })
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              document.getElementById('step1').classList.add('d-none');
              document.getElementById('step2').classList.remove('d-none');
            } else {
              Swal.fire({
                icon: "error",
                title: "OTP Verification Failed",
                text: data.error || "Please try again."
              });
              document.getElementById('verifyOtpBtn').disabled = false;
              document.getElementById('verifyOtpBtn').innerText = "Verify Now";
            }
          })
          .catch(err => {
            Swal.fire({
              icon: "error",
              title: "Server Error",
              text: "Something went wrong. Try again."
            });
            document.getElementById('verifyOtpBtn').disabled = false;
            document.getElementById('verifyOtpBtn').innerText = "Verify Now";
          });
      });


      // Handle Next button

      document.getElementById('sendOtpBtn').addEventListener('click', function () {
        const input = document.getElementById('signupInput').value.trim();
        const code = document.getElementById('countryCode').value;

        if (input === "") {
          alert("Please enter your phone number");
          return;
        }

        // Disable button to prevent multiple clicks
        this.disabled = true;
        this.innerText = "Sending...";

        // Send AJAX request
        fetch("<?php echo e(route('send.otp')); ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
          },
          body: JSON.stringify({
            mobile: input,
            country_code: code
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // ✅ Hide country code section
              document.getElementById('countryCodeSection').classList.add('d-none');

              // ✅ Show OTP section
              document.getElementById('otpSection').classList.remove('d-none');

            } else {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: data.error || "Failed to send OTP. Try again."
              });
              document.getElementById('sendOtpBtn').disabled = false;
              document.getElementById('sendOtpBtn').innerText = "Send OTP";
            }
          })

          .catch(error => {
            console.error("Error:", error);
            alert("Something went wrong. Try again later.");
            document.getElementById('sendOtpBtn').disabled = false;
            document.getElementById('sendOtpBtn').innerText = "Send OTP";
          });
      });

      // Resend OTP
      document.getElementById('resendOtpBtn').addEventListener('click', function () {
        const input = document.getElementById('signupInput').value.trim();
        const code = document.getElementById('countryCode').value;

        if (input === "") {
          alert("Please enter your phone number");
          return;
        }

        this.disabled = true;
        this.innerText = "Resending...";

        fetch("<?php echo e(route('send.otp')); ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
          },
          body: JSON.stringify({
            mobile: input,
            country_code: code
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire({
                icon: "success",
                title: "OTP Resent",
                text: "A new OTP has been sent to your number."
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: data.error || "Failed to resend OTP."
              });
            }
            document.getElementById('resendOtpBtn').disabled = false;
            document.getElementById('resendOtpBtn').innerText = "Resend OTP";
          })
          .catch(error => {
            console.error("Error:", error);
            alert("Something went wrong. Try again.");
            document.getElementById('resendOtpBtn').disabled = false;
            document.getElementById('resendOtpBtn').innerText = "Resend OTP";
          });
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


      // FIXED: Account type toggle
      document.getElementById('accountType').addEventListener('change', function () {
        if (this.value === 'entity') {
          document.getElementById('legalNameField').classList.remove('d-none');
        } else {
          document.getElementById('legalNameField').classList.add('d-none');
        }
      });


      document.getElementById("finalSubmitBtn").addEventListener("click", function (e) {
        e.preventDefault();

        const accountType = document.getElementById("accountType").value;
        const legalName = document.getElementById("legalNameField").classList.contains("d-none")
          ? null : document.querySelector("#legalNameField input").value;

        const firstName = document.querySelector('input[placeholder="First Name"]').value.trim();
        const lastName = document.querySelector('input[placeholder="Last Name"]').value.trim();
        const emailInput = document.querySelector('input[placeholder="Email Id"]').value.trim();
        // const countryId = document.getElementById("inputSelectCountry").value;

        const password = document.getElementById("passwordField").value;
        const confirmPass = document.getElementById("confirmPasswordField").value;

        if (password !== confirmPass) {
          alert("Passwords do not match");
          return;
        }

        // Get Step 1 input (email or mobile)
        const signupInput = document.getElementById("signupInput").value.trim();
        const code = document.getElementById("countryCode").value;

        // Decide whether email or mobile
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let finalEmail = null;
        let mobile = null;

        if (emailPattern.test(signupInput)) {
          finalEmail = signupInput; // typed email in step 1
        } else {
          mobile = code + signupInput; // typed phone
          finalEmail = emailInput || null; // optional additional email
        }
        const redirectUrl = document.getElementById('redirectUrl').value;

        // ✅ send to backend
        fetch("<?php echo e(route('customer.register')); ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
          },
          body: JSON.stringify({
            accountType: accountType,
            legal_name: legalName,
            first_name: firstName,
            last_name: lastName,
            email: finalEmail,
            mobile: mobile,
            password: password,
            password_confirmation: confirmPass,
            redirect: redirectUrl,
            // country: countryId // <-- now sends country.id (not +91)
          })
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              window.location.href = data.redirect;
            } else {
              Swal.fire({
                icon: "error",
                title: "Registration Failed",
                text: data.error || "Please try again."
              });
            }
          })
          .catch(err => {
            console.error("Error:", err);
            alert("Something went wrong. Try again.");
          });
      });



    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/authentication-signup.blade.php ENDPATH**/ ?>