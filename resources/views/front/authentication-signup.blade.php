@extends('layouts.new-master')

@section('title')
{{ $page->meta_title ?? 'Flippingo' }}
@endsection
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
@section('content')

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

        <div id="signupForm" style="padding: 30px 20px;    background: #f9f9f9;">
          <div class="text-center">
            <h4 class="font-size-28 font-weight-semi-bold mb-1 mt-4">Register your account</h4>
            <p class="card-text">with your social network</p>
            <div class="d-flex flex-wrap align-items-center justify-content-between my-4 sign-g">
              <a href="{{ route('google.redirect') }}" class="theme-btn flex-grow-1 mx-1 my-1" style="color: #000;">
                <img src="https://images.icon-icons.com/2699/PNG/512/google_logo_icon_169090.png"> Signup with Google
              </a>
            </div>
          </div>
          <hr>
          <!--<div class="d-flex align-items-center">-->
          <!--  <hr class="border-top-gray flex-grow-1" />-->
          <!--  <span class="mx-1 text-uppercase">or</span>-->
          <!--  <hr class="border-top-gray flex-grow-1" />-->
          <!--</div>-->
          <div id="step1" class="mt-3">
          

            <div class="form-group position-relative mt-3">
              <label class="label-text">Signup with Mobile</label>
              <div class="input-group">
                <select id="countryCode" class="form-select country-code col-3">
                  <option value="+91"> +91</option>
                  <option value="+1"> +1</option>
                  <option value="+44"> +44</option>
                  <option value="+971"> +971</option>
                </select>
                <input class="form-control form--control" type="text" name="loginPhone" id="phone"
                  placeholder="Enter Mobile Number" />
                <button type="button" class="arrow-btn" id="nextBtnPhone">→</button>
              </div>
            </div>

            <div id="otpSectionPhone" class="d-none mt-3">
              <label class="label-text">Enter OTP</label>
              <div class="d-flex mb-2">
                <input type="text" class="form-control me-2" placeholder="Enter OTP" id="otpField" style="width: 70%;">
                <button type="button" class="btn btn-outline-secondary" id="verifyOtpBtn">Verify OTP</button>
              </div>
              <button type="button" class="btn btn-outline-primary w-100 mt-2" id="resendOtpBtn">Resend OTP</button>
            </div>

            <div class="d-flex align-items-center">
              <hr class="border-top-gray flex-grow-1" />
              <span class="mx-1 text-uppercase">or</span>
              <hr class="border-top-gray flex-grow-1" />
            </div>

  <div class="form-group position-relative mt-4">
              <label class="label-text">Signup in With E-mail </label>
              <input class="form-control form--control ps-3" type="text" name="loginEmail" id="email"
                placeholder="Enter E-mail Id " />
              <button type="button" class="arrow-btn" id="nextBtnEmail">→</button>
            </div>

            <!-- Step 2: Hidden initially -->
            <!-- <div class="form-group" id="passwordBox" style="display:none;">
              <label class="label-text">Password / OTP</label>
              <div class="position-relative">
                <input class="form-control form--control ps-3" type="password" name="password"
                  placeholder="Enter Password / OTP" />
              </div>
            </div> -->

            <!-- OTP Section -->
            <div id="otpSectionEmail" class="d-none mt-3">
              <label class="label-text">Enter OTP</label>
              <div class="d-flex mb-2">
                <input type="text" class="form-control me-2" placeholder="Enter OTP" id="otpField" style="width: 70%;">
                <button type="button" class="btn btn-outline-secondary" id="verifyOtpBtn">Verify OTP</button>
              </div>
              <button type="button" class="btn btn-outline-primary w-100 mt-2" id="resendOtpBtn">Resend OTP</button>
            </div>


            <div class="form-group d-flex align-items-center justify-content-between hidden" id="rememberBox">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="RememberMe" />
                <label class="custom-control-label" for="RememberMe">I accept Terms & Conditions mentioned in
                  Flippingo</label>
              </div>

            </div>
          </div>

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

            <input type="hidden" id="redirectUrl" value="{{ request()->query('redirect', 'dashboard.index') }}">

            <!-- Other Fields -->
            <input type="text" class="form-control mb-3" placeholder="First Name">
            <input type="text" class="form-control mb-3" placeholder="Last Name">
            <!-- 
                        <select class="form-select mb-3" name="country" id="inputSelectCountry" required>
                          <option value="">Select Country</option>
                          @php $countries = countrylist(); @endphp
                          @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                          @endforeach
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



          <p class="mt-5 text-center">
            Already registered with us? Please
            <a href="{{ Route('authentication-signin') }}" class="btn-link" style="color:blue;">Login here</a>
          </p>

        </div>


        <!-- Step 2 (Hidden Initially) -->

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
    let signupMethod = null; // 'email' or 'mobile'
    let signupValue = null;  // email or full mobile with country code

    // Email Next
    document.getElementById('nextBtnEmail').addEventListener('click', function () {
      const input = document.getElementById('email').value.trim();
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailPattern.test(input)) {
        Swal.fire("Please enter a valid email");
        return;
      }

      signupMethod = 'email';
      signupValue = input;

      sendOtp(signupMethod, signupValue, 'otpSectionEmail');
    });

    // Mobile Next
    document.getElementById('nextBtnPhone').addEventListener('click', function () {
      const input = document.getElementById('phone').value.trim();
      const countryCode = document.getElementById('countryCode').value;

      if (!/^\d{8,15}$/.test(input)) {
        Swal.fire("Please enter a valid phone number");
        return;
      }

      signupMethod = 'mobile';
      signupValue = input;

      sendOtp(signupMethod, signupValue, 'otpSectionPhone');
    });

    function sendOtp(method, value, otpSectionId) {
      fetch("{{ route('send.otp') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
          type: method,
          value: value,
          country_code: method === 'mobile' ? document.getElementById('countryCode').value : null
        })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire("OTP sent successfully!");
            document.getElementById(otpSectionId).classList.remove('d-none');

          } else {
            Swal.fire("OTP sending failed: " + (data.error || ""));
          }
        })
        .catch(() => {
          Swal.fire("Something went wrong. Try again.");
        });
    }


    // OTP Verify
    // OTP Verify
    document.querySelectorAll('#otpSectionEmail button,#otpSectionPhone button').forEach(btn => {
      btn.addEventListener('click', function () {
        const otpSectionId = this.closest('div[id^="otpSection"]').id;
        const otp = this.closest('div[id^="otpSection"]').querySelector('#otpField').value.trim();

        if (otp.length !== 6) return Swal.fire("Enter a valid 6-digit OTP");

        fetch("{{ route('verify.otp') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({
            type: signupMethod,
            value: signupValue,
            otp: otp,
            country_code: signupMethod === 'mobile' ? document.querySelector('.country-code').value : null
          })
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              Swal.fire("OTP verified successfully!");

              // ✅ Remove Step 1 completely
              document.getElementById("step1").remove();

              // ✅ Store the Step 1 verified value (hidden input in Step 2)
              let hiddenInput = document.getElementById("step1Value");
              if (!hiddenInput) {
                hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.id = "step1Value";
                hiddenInput.name = "step1Value";
                document.getElementById("step2").appendChild(hiddenInput);
              }
              hiddenInput.dataset.method = signupMethod; // 'email' or 'mobile'
              hiddenInput.value = signupValue;

              // ✅ Show Step 2
              document.getElementById("step2").classList.remove("d-none");

              // Add the "other input" dynamically
              let otherInputContainer = document.getElementById("otherInputContainer");
              if (!otherInputContainer) {
                otherInputContainer = document.createElement("div");
                otherInputContainer.id = "otherInputContainer";
                otherInputContainer.className = "mb-3";
                document.getElementById("step2").prepend(otherInputContainer);
              }
              otherInputContainer.innerHTML = "";

              if (signupMethod === "email") {
                // If step1 was email → now ask mobile
                otherInputContainer.innerHTML = `
        <label class="label-text">Mobile Number</label>
        <div class="input-group">
            <select id="step2CountryCode" class="form-select country-code col-3">
                <option value="+91">🇮🇳 +91</option>
                <option value="+1">🇺🇸 +1</option>
                <option value="+44">🇬🇧 +44</option>
                <option value="+971">🇦🇪 +971</option>
            </select>
            <input type="text" class="form-control" placeholder="Enter Mobile Number" id="step2Phone">
        </div>
      `;
              } else if (signupMethod === "mobile") {
                // If step1 was mobile → now ask email
                otherInputContainer.innerHTML = `
        <label class="label-text">Email Id</label>
        <input type="email" class="form-control" placeholder="Enter Email Id" id="step2Email">
      `;
              }
            } else {
              Swal.fire("OTP verification failed: " + (data.error || ""));
            }
          });

      });
    });


    // Resend OTP
    // Resend OTP (only for email)
    document.getElementById('resendOtpBtn').addEventListener('click', function () {

      const btn = this;
      btn.disabled = true;
      btn.innerText = "Resending...";

      fetch("{{ route('send.otp') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
          type: signupMethod,
          value: signupValue
        })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              icon: "success",
              title: "OTP Resent",
              text: "A new OTP has been sent to your email."
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: data.error || "Failed to resend OTP."
            });
          }
          btn.disabled = false;
          btn.innerText = "Resend OTP";
        })
        .catch(() => {
          Swal.fire("Something went wrong. Try again.");
          btn.disabled = false;
          btn.innerText = "Resend OTP";
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
      const password = document.getElementById("passwordField").value;
      const confirmPass = document.getElementById("confirmPasswordField").value;

      if (password !== confirmPass) {
        Swal.fire("Passwords do not match");
        return;
      }

      // ✅ Step 1 verified value (from hidden input)
      const step1Value = document.getElementById("step1Value").value;
      const step1Method = document.getElementById("step1Value").dataset.method;

      // ✅ Step 2 input (other value)
      let email = null, mobile = null;

      if (step1Method === "email") {
        email = step1Value; // verified email
        const step2Phone = document.getElementById("step2Phone").value.trim();
        const step2Code = document.getElementById("step2CountryCode").value;
        if (step2Phone) mobile = step2Code + step2Phone;
      } else if (step1Method === "mobile") {
        mobile = step1Value; // verified mobile
        const step2Email = document.getElementById("step2Email").value.trim();
        if (step2Email) email = step2Email;
      }

      const redirectUrl = document.getElementById("redirectUrl").value;

      // ✅ send to backend
      fetch("{{ route('customer.register') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
          accountType,
          legal_name: legalName,
          first_name: firstName,
          last_name: lastName,
          email,
          mobile,
          password,
          password_confirmation: confirmPass,
          redirect: redirectUrl
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
          Swal.fire("Something went wrong. Try again.");
        });
    });

  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endsection