

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

  /* MAIN OUTER WRAPPER (Center + Max Width) */


  /* Wave Animation Layer */



  /* INNER FLEX WRAPPER */
  .newlogin-content {
    display: flex;
    gap: 50px;
    align-items: flex-start;
  }

  /* LEFT SECTION */
  .newlogin-left {
    flex: 1;
  }

  /* RIGHT SIDE IMAGE */
  .newlogin-right {
    flex: 1;
    display: flex;
    justify-content: center;
  }

  .newlogin-right img {
    width: 100%;
    max-width: 450px;
    border-radius: 22px;
  }

  /* LABEL */
  .newlogin-label {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
  }

  /* INPUT + SELECT GROUP */
  .newlogin-input-group {
    margin-bottom: 10px;
  }

  /* COUNTRY SELECT */
  .newlogin-country {
    padding: 10px;
    border-radius: 12px 0 0 12px;
    background: #f3f3f3;
    border: 1px solid #ddd;
    width: 90px;
  }

  /* INPUT */
  .newlogin-input {
    border-radius: 0 12px 12px 0;
    border: 1px solid #ddd;
    padding: 10px 14px;
    width: 100%;
    font-size: 14px;
  }

  .newlogin-input1 {
    border-radius: 12px;
    border: 1px solid #ddd;
    padding: 10px 14px;
    width: 100%;
    font-size: 14px;
  }

  /* SMALL ARROW BUTTON */
  .newlogin-go {
    background: #3d3df5;
    color: #fff;
    padding: 9px 14px;
    border-radius: 12px;
    border: none;
    margin-left: 10px;
  }

  /* DIVIDER */
  .newlogin-divider {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 10px 0;
    color: #666;
  }

  .newlogin-divider hr {
    flex: 1;
  }

  /* GOOGLE BUTTON */
  .newlogin-google {
    background: #fff;
    border: 1px solid #ddd;
    padding: 10px 16px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
  }

  /* SUBMIT BUTTON */
  .newlogin-submit {
    margin-top: 25px;
    width: 100%;
    background: #111827;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 12px;
    font-size: 16px;
  }

  /* MOBILE */
  @media(max-width: 768px) {
    .newlogin-content {
      flex-direction: column-reverse;
    }

    .newlogin-wrapper {
      margin-top: 10px;
      padding: 10px 18px;
    }
  }

  .hidden {
    display: none;
  }

  .newlogin-wrapper {
    max-width: 1100px;
    margin: 40px auto;
    padding: 30px 40px;

    /* ⭐ Glass Effect */
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);

    /* ⭐ Soft Border */
    border: 1px solid rgba(255, 255, 255, 0.35);
    border-radius: 25px;

    /* ⭐ Glowing Shadow */
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);

    /* ⭐ Wave Animation Background */
    position: relative;
    overflow: hidden;
  }

  /* Wave Animation Layer */
  .newlogin-wrapper::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;

    background: radial-gradient(circle,
        rgba(255, 255, 255, 0.25) 0%,
        rgba(255, 255, 255, 0) 70%);

    animation: glassWave 6s infinite linear;
  }

  /* Wave Keyframes */
  /*@keyframes  glassWave {*/
  /*    0% { transform: translate(0, 0) rotate(0deg); }*/
  /*    50% { transform: translate(10%, 10%) rotate(180deg); }*/
  /*    100% { transform: translate(0, 0) rotate(360deg); }*/
  /*}*/

  .newlogin-content {
    display: flex;
    gap: 50px;
  }

  .newlogin-left {
    flex: 1;
    color: #ffffff;
  }

  .newlogin-left h2 {
    color: #ffffff;
  }

  .newlogin-right {
    flex: 1;
    display: flex;
    justify-content: center;
  }

  .newlogin-right img {
    width: 100%;
    max-width: 450px;
    border-radius: 22px;
  }

  .newlogin-google {
    background: #fff;
    border: 1px solid #ddd;
    padding: 10px 16px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .newlogin-divider {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0px 0;
  }

  .newlogin-divider hr {
    flex: 1;
  }

  .newlogin-label {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 4px;
  }

  .newlogin-country {
    padding: 10px;
    border-radius: 10px 0 0 10px;
    border: 1px solid #ddd;
    background: #f3f3f3;
  }

  .newlogin-input {
    border-radius: 0 10px 10px 0;
    border: 1px solid #ddd;
    padding: 10px 14px;
    width: 100%;
  }

  .newlogin-go {
    background: #3d3df5;
    color: #fff;
    padding: 10px 14px;
    border-radius: 12px;
    border: none;
    margin-left: 10px;
  }

  .newlogin-submit {
    margin-top: 20px;
    width: 100%;
    background: #111827;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 12px;
  }

  .zorcha-container {
    position: relative;
    width: 100%;
    max-width: 820px;
    margin: auto;
    margin-top: 190px;
    margin-bottom: 60px;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.4);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    padding: 40px 32px;
    text-align: start;
  }

  .zorcha-bg-image {
    position: absolute;
    inset: 0;
    background: url('https://images.unsplash.com/photo-1585487000160-6ebcfceb0d26?auto=format&fit=crop&q=80') center/cover no-repeat;
    opacity: 0.12;
    z-index: -1;
  }

  .zorcha-h1 {
    font-size: 2.1rem;
    margin-bottom: 8px;
    color: #2d1a47;
    font-weight: 700;
  }

  .zorcha-subtitle {
    font-size: 1rem;
    color: #555;
    margin-bottom: 32px;
  }

  .zorcha-toggle-link {
    color: #6a4aff;
    font-weight: 600;
    cursor: pointer;
    text-decoration: underline;
    margin-left: 8px;
  }

  .zorcha-google-btn {
    display: flex;
    align-items: center;
    /*justify-content: center;*/
    gap: 12px;
    width: 100%;
    padding: 14px;
    margin: 20px 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
  }

  .zorcha-google-btn:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .zorcha-input-group {
    position: relative;
    margin: 24px 0;
    text-align: left;
  }

  .zorcha-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #444;
  }

  .zorcha-input,
  .zorcha-otp-box {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #ddd;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.2s;
  }

  .zorcha-input:focus,
  .zorcha-otp-box:focus {
    outline: none;
    border-color: #6a4aff;
    box-shadow: 0 0 0 3px rgba(106, 74, 255, 0.2);
  }

  .zorcha-phone-prefix {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 14px 16px;
    background: #f8f9fa;
    border: 2px solid #ddd;
    border-right: none;
    border-radius: 12px 0 0 12px;
    font-weight: 500;
  }

  .zorcha-phone-input-wrapper {
    display: flex;
  }

  .zorcha-phone-input-wrapper .zorcha-input {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    flex: 1;
  }

  .zorcha-checkbox-group {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 16px 0;
    font-size: 0.95rem;
    color: #555;
  }

  .zorcha-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(90deg, #5a3aff, #7c5eff);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 6px 20px rgba(90, 58, 255, 0.3);
  }

  .zorcha-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(90, 58, 255, 0.4);
  }

  .zorcha-terms {
    margin-top: 24px;
    font-size: 0.85rem;
    color: #666;
  }

  .zorcha-terms a {
    color: #6a4aff;
    text-decoration: none;
  }

  /* OTP specific */
  .zorcha-otp-grid {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin: 32px 0;
  }

  .zorcha-otp-box {
    width: 54px;
    height: 60px;
    background: rgba(255, 255, 255, 0.7);
    border: 2px solid #ddd;
    border-radius: 12px;
    font-size: 1.8rem;
    font-weight: 600;
    text-align: center;
  }

  .zorcha-otp-box.filled {
    border-color: #6a4aff;
    background: rgba(106, 74, 255, 0.08);
  }

  .zorcha-resend {
    color: #888;
    font-size: 0.95rem;
    margin-top: 8px;
  }

  .zorcha-resend span {
    color: #6a4aff;
    cursor: pointer;
  }

  .zorcha-change-link {
    color: #6a4aff;
    cursor: pointer;
    font-weight: 500;
    margin-top: 16px;
    display: inline-block;
  }

  .login-image img {
    width: 380px;
    margin-left: 20px;
  }
</style>


<?php $__env->startSection('content'); ?>

  <div class="zorcha-container">
    <div class="login-image" style="display:flex; justify-content:space-between;">

      <div class="loginleft-side">
        <div class="zorcha-bg-image"></div>

        <!-- PAGE 1 : SIGN UP -->
        <div id="signUpPage">
          <h1 class="zorcha-h1">Create Account</h1>

          <p class="zorcha-subtitle">
            Already have an account?
            <a href="<?php echo e(route('authentication-signin')); ?>" style="color:#6a4aff;font-weight:600;">Sign In</a>
          </p>

          <button class="zorcha-google-btn" onclick="window.location.href='<?php echo e(route('google.redirect')); ?>'">
            <i class="fab fa-google"></i> Sign up with Google
          </button>

          <!-- PHONE MODE -->
          <div id="phoneMode">
            <div class="zorcha-input-group">
              <div style="display:flex;justify-content:space-between;">
                <label class="zorcha-label">Phone number</label>
                <a href="#" id="switchToEmail" class="zorcha-toggle-link">Use email</a>
              </div>

              <div class="zorcha-phone-input-wrapper">
                <select class="zorcha-phone-prefix" id="countryCode">
                  <option value="+91">IN +91</option>
                  <option value="+1">US +1</option>
                  <option value="+44">UK +44</option>
                  <option value="+971">UAE +971</option>
                </select>
                <input type="tel" class="zorcha-input" placeholder="Enter phone number" id="phoneInput">
              </div>
            </div>

            <div class="zorcha-checkbox-group">
              <input type="checkbox" id="whatsappOtp" checked />
              <label for="whatsappOtp">OTP Via Whatsapp</label>
            </div>
            <button class="zorcha-btn" onclick="goToOtp('mobile')">
              Send OTP
            </button>
          </div>

          <!-- EMAIL MODE -->
          <div id="emailMode" style="display:none;">
            <div class="zorcha-input-group">
              <div style="display:flex;justify-content:space-between;">
                <label class="zorcha-label">Email address</label>
                <a href="#" id="switchToPhone" class="zorcha-toggle-link">Use phone</a>
              </div>
              <input type="email" class="zorcha-input" placeholder="Enter your email" id="emailInput">
            </div>

            <button class="zorcha-btn" onclick="goToOtp('email')">
              Send OTP
            </button>
          </div>

          <p class="zorcha-terms">
            By proceeding you acknowledge that you have read, understood and agree to our
            <a href="#">Terms and Conditions</a>.
          </p>
        </div>

        <!-- PAGE 2 : OTP -->
        <div id="otpPage" style="display:none;">
          <h1 class="zorcha-h1">Verify OTP</h1>
          <p class="zorcha-subtitle">
            Enter the 6-digit code sent to
          </p>

          <div style="margin:15px 0;font-weight:500">
            <span id="contactDisplay"></span>
            <a href="#" onclick="backToSignup()" class="zorcha-toggle-link">Change</a>
          </div>

          <div class="zorcha-otp-grid" id="otpGrid"></div>

          <p class="zorcha-resend">
            Resend OTP <span id="resendOtp">Resend in 11s</span>
          </p>

          <button class="zorcha-btn" onclick="verifyOtp()">
            Verify OTP
          </button>
        </div>

        <!-- PAGE 3 : SIGNUP DETAILS -->
        <div id="detailsPage" style="display:none;">

          <h1 class="zorcha-h1">Almost Done</h1>

          <input type="hidden" id="redirectUrl" value="<?php echo e(request()->query('redirect', 'dashboard.index')); ?>">

          <div class="zorcha-input-group">
            <label class="zorcha-label">Account Type</label>
            <select id="accountType" name="accountType" class="zorcha-input">
              <option value="">Select</option>
              <option value="individual">Individual</option>
              <option value="entity">Entity</option>
            </select>
          </div>

          <div class="zorcha-input-group hidden" id="legalNameField">
            <input class="zorcha-input" placeholder="Legal Name">
          </div>

          <!-- DYNAMIC CONTACT FIELD -->
          <div class="zorcha-input-group" id="secondaryContactField"></div>

          <div class="zorcha-input-group">
            <input class="zorcha-input" placeholder="First Name" id="firstName">
          </div>

          <div class="zorcha-input-group">
            <input class="zorcha-input" placeholder="Last Name" id="lastName">
          </div>

          <div class="zorcha-input-group">
            <input type="password" class="zorcha-input" placeholder="Create Password" id="password">
          </div>

          <div class="zorcha-input-group">
            <input type="password" class="zorcha-input" placeholder="Confirm Password" id="confirmPassword">
          </div>

          <button class="zorcha-btn" onclick="finalSignup()">
            Create Account
          </button>
        </div>

      </div>

      <!-- RIGHT IMAGE -->
      <img src="https://img.freepik.com/free-vector/abstract-bright-geometric-line-modern-wallpaper-design_1017-60099.jpg"
        alt="">
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {

      /* ======================
         DOM REFERENCES
      ====================== */
      const switchToEmail = document.getElementById('switchToEmail');
      const switchToPhone = document.getElementById('switchToPhone');
      const phoneMode = document.getElementById('phoneMode');
      const emailMode = document.getElementById('emailMode');
      const phoneInput = document.getElementById('phoneInput');
      const emailInput = document.getElementById('emailInput');
      const countryCode = document.getElementById('countryCode');

      const signUpPage = document.getElementById('signUpPage');
      const otpPage = document.getElementById('otpPage');
      const detailsPage = document.getElementById('detailsPage');

      const otpGrid = document.getElementById('otpGrid');
      const contactDisplay = document.getElementById('contactDisplay');
      const resendOtp = document.getElementById('resendOtp');

      const accountType = document.getElementById('accountType');
      const legalNameField = document.getElementById('legalNameField');

      /* ======================
         STATE
      ====================== */
      let signupMethod = null; // 'mobile' | 'email'
      let signupValue = null;  // verified value
      let resendTimer;
      let resendSeconds = 11;

      /* ======================
         TOGGLE PHONE / EMAIL
      ====================== */
      switchToEmail?.addEventListener('click', e => {
        e.preventDefault();
        phoneMode.style.display = 'none';
        emailMode.style.display = 'block';
      });

      switchToPhone?.addEventListener('click', e => {
        e.preventDefault();
        emailMode.style.display = 'none';
        phoneMode.style.display = 'block';
      });

      /* ======================
         STEP 1 → SEND OTP
      ====================== */
      window.goToOtp = function (mode) {

        signupMethod = mode;

        if (mode === 'mobile') {
          const phone = phoneInput.value.trim();
          if (!/^\d{6,15}$/.test(phone)) {
            Swal.fire('Invalid phone number');
            return;
          }
          signupValue = phone;
        }

        if (mode === 'email') {
          const email = emailInput.value.trim();
          if (!email.includes('@')) {
            Swal.fire('Invalid email');
            return;
          }
          signupValue = email;
        }

        sendOtp();
      };

      function sendOtp() {
        fetch("<?php echo e(route('send.otp')); ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
          },
          body: JSON.stringify({
            type: signupMethod,
            value: signupValue
          })
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              showOtpPage();
            } else {
              Swal.fire(data.message || 'Failed to send OTP');
            }
          })
          .catch(() => Swal.fire('Server error'));
      }

      /* ======================
         SHOW OTP PAGE
      ====================== */
      function showOtpPage() {
        signUpPage.style.display = 'none';
        otpPage.style.display = 'block';

        contactDisplay.innerText = signupValue;
        otpGrid.innerHTML = '';

        for (let i = 0; i < 6; i++) {
          otpGrid.innerHTML += `<input class="zorcha-otp-box" maxlength="1">`;
        }

        startResendTimer();
      }

      /* ======================
         VERIFY OTP
      ====================== */
      window.verifyOtp = function () {
        let otp = '';
        document.querySelectorAll('.zorcha-otp-box').forEach(i => otp += i.value);

        if (otp.length !== 6) {
          Swal.fire('Enter complete OTP');
          return;
        }

        fetch("<?php echo e(route('verify.otp')); ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
          },
          body: JSON.stringify({
            type: signupMethod,
            value: signupValue,
            otp: otp
          })
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              otpPage.style.display = 'none';
              detailsPage.style.display = 'block';

              /* Inject secondary contact field */
              const container = document.getElementById('secondaryContactField');
              container.innerHTML = '';

              if (signupMethod === 'mobile') {
                container.innerHTML = `
        <input type="email" class="zorcha-input" id="secondaryEmail"
          placeholder="Enter your email">
      `;
              }

              if (signupMethod === 'email') {
                container.innerHTML = `
        <div class="zorcha-phone-input-wrapper">
          <select class="zorcha-phone-prefix" id="secondaryCountryCode">
            <option value="+91">IN +91</option>
            <option value="+1">US +1</option>
            <option value="+44">UK +44</option>
            <option value="+971">UAE +971</option>
          </select>
          <input type="tel" class="zorcha-input" id="secondaryMobile"
            placeholder="Enter mobile number">
        </div>
      `;
              }

            } else {
              Swal.fire('Invalid OTP');
            }
          });
      };

      /* ======================
         FINAL SIGNUP
      ====================== */
      window.finalSignup = function () {

        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        const accountTypeVal = accountType.value;
        const legalNameInput = legalNameField.querySelector('input');
        const legalName = !legalNameField.classList.contains('hidden')
         ? legalNameInput.value.trim()
          : null;
        const redirectUrl = document.getElementById("redirectUrl").value;

        
        if (!firstName || !lastName) {
          Swal.fire('Please enter first and last name');
          return;
        }

        if (!accountTypeVal) {
          Swal.fire('Please select account type');
          return;
        }

        if (accountTypeVal === 'entity' && !legalName) {
          Swal.fire('Please enter legal name');
          return;
        }

        if (password !== confirmPassword) {
          Swal.fire('Passwords do not match');
          return;
        }

        /* ✅ Build payload correctly */
        const payload = {
          account_type: accountTypeVal,
          legal_name: legalName,
          first_name: firstName,
          last_name: lastName,
          password: password,
          password_confirmation: confirmPassword,
          redirect: redirectUrl
        };



        /* ✅ Add verified + secondary contact */
        if (signupMethod === 'mobile') {
          // verified mobile
          payload.mobile = countryCode.value + signupValue;

          // secondary email
          const secEmail = document.getElementById('secondaryEmail')?.value.trim();
          if (!secEmail || !secEmail.includes('@')) {
            Swal.fire('Please enter a valid email');
            return;
          }
          payload.email = secEmail;
        }

        if (signupMethod === 'email') {
          // verified email
          payload.email = signupValue;

          // secondary mobile
          const secMobile = document.getElementById('secondaryMobile')?.value.trim();
          const secCode = document.getElementById('secondaryCountryCode')?.value;

          if (!/^\d{6,15}$/.test(secMobile)) {
            Swal.fire('Please enter a valid mobile number');
            return;
          }
          payload.mobile = secCode + secMobile;
        }


        console.log('FINAL SIGNUP PAYLOAD:', payload); // 🔥 DEBUG

        fetch("<?php echo e(route('customer.register')); ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
          },
          body: JSON.stringify(payload)
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              window.location.href = data.redirect;
            } else {
              Swal.fire(data.message || 'Signup failed');
            }
          })
          .catch(() => Swal.fire('Server error'));
      };

      /* ======================
         ACCOUNT TYPE TOGGLE
      ====================== */
      accountType?.addEventListener('change', function () {
        if (this.value === 'entity') {
          legalNameField.classList.remove('hidden');
        } else {
          legalNameField.classList.add('hidden');
        }
      });

      /* ======================
         RESEND TIMER
      ====================== */
      function startResendTimer() {
        let t = resendSeconds;
        resendOtp.innerText = `Resend in ${t}s`;

        resendTimer = setInterval(() => {
          t--;
          resendOtp.innerText = `Resend in ${t}s`;
          if (t <= 0) {
            clearInterval(resendTimer);
            resendOtp.innerText = 'Resend OTP';
          }
        }, 1000);
      }

    });
  </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/authentication-signup.blade.php ENDPATH**/ ?>