

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
<style>
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
</style>
<style>
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
</style>
<style>
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
    <div class="login-image " style="display:flex; justify-content:space-between;">
      <div class="loginleft-side">
        <div class="zorcha-bg-image"></div>

        <!-- Page 1: Sign In -->
        <div id="signInPage">
          <h1 class="zorcha-h1">Sign In</h1>
          <p class="zorcha-subtitle">Don't have an account? <a href="#"
              style="color:#6a4aff; text-decoration:none; font-weight:600;">Sign Up</a></p>

          <button class="zorcha-google-btn" onclick="window.location.href='<?php echo e(route('google.redirect')); ?>'">
            <i class="fab fa-google"></i> Google
          </button>

          <div id="phoneMode">
            <div class="zorcha-input-group">
              <div style="display:flex;justify-content:space-between;">
                <label class="zorcha-label">Phone number</label>
                <p style="text-align:left; font-size:0.9rem; color:#555;">
                  <a href="#" id="switchToEmail" class="zorcha-toggle-link">Use email</a>
                </p>
              </div>

              <div class="zorcha-phone-input-wrapper">
                <div class="zorcha-phone-prefix">
                  <span>🇮🇳</span> +91
                </div>
                <input type="tel" class="zorcha-input" maxlength="10" placeholder="Enter phone number" id="phoneInput" />
              </div>
            </div>

            <div class="zorcha-checkbox-group">
              <input type="checkbox" id="whatsappOtp" checked />
              <label for="whatsappOtp">OTP Via Whatsapp</label>
            </div>
            <button class="zorcha-btn" onclick="goToOtp('phone')">Send OTP</button>
          </div>

          <div id="emailMode" style="display:none;">
            <div class="zorcha-input-group">
              <div style="display:flex;justify-content:space-between;">
                <label class="zorcha-label">Email address</label>
                <p style="text-align:left; font-size:0.9rem; color:#555;">
                  <a href="#" id="switchToPhone" class="zorcha-toggle-link">Use phone</a>
                </p>
              </div>
              <input type="email" class="zorcha-input" placeholder="Enter your email address" id="emailInput" />
            </div>

            <button class="zorcha-btn" onclick="goToOtp('email')">Sign In</button>
          </div>

          <p class="zorcha-terms">
            By proceeding you acknowledge that you have read, understood and agree to our
            <a href="#">Terms and Conditions</a>.
          </p>
        </div>

        <!-- Page 2: OTP Verification -->
        <div id="otpPage" style="display:none;">
          <h1 class="zorcha-h1">Check your phone</h1>
          <p class="zorcha-subtitle">We sent you a verification code via SMS. Please enter the code below.</p>

          <div style="margin:20px 0; font-weight:500; color:#444;">
            <span id="contactDisplay"></span>
            <a href="#" class="zorcha-toggle-link" onclick="backToSignIn()">Change</a>
          </div>

          <div class="zorcha-otp-grid">
            <input type="text" class="zorcha-otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
            <input type="text" class="zorcha-otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
            <input type="text" class="zorcha-otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
            <input type="text" class="zorcha-otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
            <input type="text" class="zorcha-otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
            <input type="text" class="zorcha-otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
          </div>

          <p class="zorcha-resend">Resend OTP <span>Resend in 11s</span></p>

          <button class="zorcha-btn">Verify Code</button>
        </div>
      </div>
      <img
        src="https://img.freepik.com/free-vector/abstract-bright-geometric-line-modern-wallpaper-design_1017-60099.jpg?semt=ais_hybrid&w=740&q=80"
        alt="">
    </div>
  </div>
  <!-- end contact-area -->
  <!-- ================================
                                          END CONTACT AREA

                                          ================================= -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    /* ===============================
       ELEMENTS
    ================================ */
    const signInPage = document.getElementById('signInPage');
    const otpPage = document.getElementById('otpPage');
    const contactDisplay = document.getElementById('contactDisplay');

    const phoneInput = document.getElementById('phoneInput');
    const emailInput = document.getElementById('emailInput');

    const otpGrid = document.querySelector('.zorcha-otp-grid');
    const verifyBtn = document.querySelector('#otpPage .zorcha-btn');
    const resendBox = document.querySelector('.zorcha-resend');
    const resendSpan = document.querySelector('.zorcha-resend span');

    let currentMode = ''; // phone | email
    let resendTimer = null;
    let resendSeconds = 11;

    /* ===============================
       TOGGLE PHONE / EMAIL
    ================================ */
    document.getElementById('switchToEmail').onclick = e => {
      e.preventDefault();
      document.getElementById('phoneMode').style.display = 'none';
      document.getElementById('emailMode').style.display = 'block';
    };

    document.getElementById('switchToPhone').onclick = e => {
      e.preventDefault();
      document.getElementById('emailMode').style.display = 'none';
      document.getElementById('phoneMode').style.display = 'block';
    };

    /* ===============================
       STEP 1 SUBMIT
    ================================ */
    function goToOtp(mode) {
      currentMode = mode;

      if (mode === 'phone') {
        const phone = phoneInput.value.trim();

        if (!/^[0-9]{10,15}$/.test(phone)) {
          Swal.fire('Error', 'Enter valid mobile number', 'error');
          return;
        }

        sendOtp(phone);
        showOtpPage(`+91 ${phone}`, true);
      }

      if (mode === 'email') {
        const email = emailInput.value.trim();

        if (email.length < 3) {
          Swal.fire('Error', 'Enter valid email / username', 'error');
          return;
        }

        showOtpPage(email, false);
      }
    }

    /* ===============================
       SHOW OTP / PASSWORD PAGE
    ================================ */
    function showOtpPage(text, isOtp) {
      signInPage.style.display = 'none';
      otpPage.style.display = 'block';
      contactDisplay.innerText = text;

      if (isOtp) {
        // PHONE OTP MODE
        document.querySelector('#otpPage h1').innerText = 'Check your phone';
        document.querySelector('#otpPage p').innerText =
          'We sent you a verification code via SMS. Please enter the code below.';

        otpGrid.innerHTML = '';
        for (let i = 0; i < 6; i++) {
          otpGrid.innerHTML += `
          <input type="text" class="zorcha-otp-box" maxlength="1" inputmode="numeric">
        `;
        }

        resendBox.style.display = 'block';
        setupOtpInputs();
        startResendTimer();
      } else {
        // EMAIL PASSWORD MODE
        document.querySelector('#otpPage h1').innerText = 'Enter your password';
        document.querySelector('#otpPage p').innerText =
          'Please enter your account password to continue.';

        otpGrid.innerHTML = `
        <input type="password"
          id="emailPassword"
          class="zorcha-input"
          placeholder="Enter password"
          style="max-width:340px;margin:auto;display:block;">
      `;

        resendBox.style.display = 'none';
      }
    }

    /* ===============================
       SEND OTP API
    ================================ */
    function sendOtp(mobile) {
      fetch("<?php echo e(route('send.otp')); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
        },
        body: JSON.stringify({ value: mobile, type: 'mobile' })
      })
        .then(r => r.json())
        .then(r => {
          if (!r.success) {
            Swal.fire('Error', r.message || 'Failed to send OTP', 'error');
          }
        });
    }

    /* ===============================
       RESEND TIMER
    ================================ */
    function startResendTimer() {
      clearInterval(resendTimer);
      let timeLeft = resendSeconds;

      resendSpan.style.pointerEvents = 'none';
      resendSpan.style.opacity = '0.5';
      resendSpan.innerText = `Resend in ${timeLeft}s`;

      resendTimer = setInterval(() => {
        timeLeft--;
        resendSpan.innerText = `Resend in ${timeLeft}s`;

        if (timeLeft <= 0) {
          clearInterval(resendTimer);
          resendSpan.innerText = 'Resend OTP';
          resendSpan.style.pointerEvents = 'auto';
          resendSpan.style.opacity = '1';
        }
      }, 1000);
    }

    /* ===============================
       RESEND CLICK
    ================================ */
    resendSpan.onclick = () => {
      if (currentMode !== 'phone') return;

      const phone = phoneInput.value.trim();
      if (!phone) return;

      sendOtp(phone);
      startResendTimer();
    };

    /* ===============================
       VERIFY BUTTON
    ================================ */
    verifyBtn.onclick = () => {
      if (currentMode === 'phone') {
        let otp = '';
        document.querySelectorAll('.zorcha-otp-box').forEach(i => otp += i.value);

        if (otp.length !== 6) {
          Swal.fire('Error', 'Enter complete OTP', 'error');
          return;
        }

        authenticate(phoneInput.value.trim(), otp);
      }

      if (currentMode === 'email') {
        const pwd = document.getElementById('emailPassword').value.trim();

        if (!pwd) {
          Swal.fire('Error', 'Password required', 'error');
          return;
        }

        authenticate(emailInput.value.trim(), pwd);
      }
    };

    /* ===============================
       AUTH LOGIN
    ================================ */
    function authenticate(loginId, password) {
      fetch("<?php echo e(route('customer.authenticate')); ?>", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
        },
        body: JSON.stringify({ loginId, password })
      })
        .then(r => r.json())
        .then(r => {
          if (r.success) {
            window.location.href = r.redirect ?? "<?php echo e(route('dashboard.index')); ?>";
          } else {
            Swal.fire('Login Failed', r.message || 'Invalid credentials', 'error');
          }
        });
    }

    /* ===============================
       OTP AUTO MOVE
    ================================ */
    function setupOtpInputs() {
      const inputs = document.querySelectorAll('.zorcha-otp-box');
      inputs.forEach((input, i) => {
        input.addEventListener('input', () => {
          if (input.value && inputs[i + 1]) inputs[i + 1].focus();
        });
        input.addEventListener('keydown', e => {
          if (e.key === 'Backspace' && !input.value && inputs[i - 1]) {
            inputs[i - 1].focus();
          }
        });
      });
    }

    /* ===============================
       BACK TO SIGN IN
    ================================ */
    function backToSignIn() {
      clearInterval(resendTimer);
      otpPage.style.display = 'none';
      signInPage.style.display = 'block';
    }
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