@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'User Profile' }}
@endsection

<style>
    .profile-pic-wrapper {
        margin-bottom: 10px;
    }

    .profile-pic-preview {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid #ccc;
        display: block;
    }

    #kycForm {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px 20px;
    }
</style>

@section('content')

    @include('user.sidebar')
    <div class="page-wrapper">
        <div class="profile-setting">
            <!-- Tabs -->
            <div class="profile-tabs">
                <div class="profile-tab active" data-tab="personal">Personal Info</div>
                <div class="profile-tab" data-tab="account">Account Setting</div>
                <div class="profile-tab" data-tab="kyc">KYC</div>
            </div>

            <!-- Content -->
            <div class="profile-content">

                <div class="profile-card active" id="personal">
                    <div class="personal-info-card">
                        <h3>Personal Information</h3>
                        <p class="small">Update your personal and business details</p>
                        <hr>
                        <form id="profileForm" class="personal-info-form" method="POST"
                            action="{{ route('dashboard.profile.update') }}">
                            @csrf

                            {{-- Profile Picture --}}
                            <div class="info-group profile-pic-group">
                                <label>Profile Picture</label>
                                <div class="profile-pic-wrapper">
                                    @if($customer->profile_pic)
                                        <img src="{{ asset('storage/' . $customer->profile_pic) }}" alt="Profile Picture"
                                            class="profile-pic-preview">
                                    @else
                                        <img src="https://via.placeholder.com/150" alt="Profile Picture"
                                            class="profile-pic-preview">
                                    @endif
                                </div>
                                <input type="file" name="profile_pic" id="profilePicInput" accept="image/*">
                            </div>


                            {{-- User Name --}}
                            <div class="info-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $customer->first_name) }}"
                                    placeholder="Enter First Name">
                            </div>

                            {{-- Full Name --}}
                            <div class="info-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $customer->last_name) }}"
                                    placeholder="Enter Last Name">
                            </div>

                            {{-- Email --}}
                            <div class="info-group">
                                <label>Email Id</label>
                                <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                                    placeholder="Enter Email Id">
                                <button type="button" class="change-btn" onclick="changeField('email')">Change Email
                                    Id</button>
                            </div>

                            {{-- Mobile --}}
                            <div class="info-group">
                                <label>Mobile Number</label>
                                <input type="text" name="mobile" value="{{ old('mobile', $customer->mobile) }}"
                                    placeholder="Enter Mobile Number">
                                <button type="button" class="change-btn" onclick="changeField('mobile')">Change Mobile
                                    Number</button>
                            </div>

                            {{-- WhatsApp --}}
                            <div class="info-group">
                                <label>WhatsApp Number</label>
                                <input type="text" name="whatsapp_number"
                                    value="{{ old('whatsapp_number', $customer->whatsapp_number) }}"
                                    placeholder="Enter WhatsApp Number">
                            </div>

                            {{-- Entity Legal Name --}}
                            <div class="info-group">
                                <label>Entity Legal Name</label>
                                <input type="text" name="legal_name"
                                    value="{{ old('legal_name', $customer->legal_name ?? '') }}"
                                    placeholder="Enter Entity Legal Name">
                            </div>

                            {{-- Business Email --}}
                            <div class="info-group">
                                <label>Business Email Id</label>
                                <input type="email" name="business_email"
                                    value="{{ old('business_email', $customer->business_email ?? '') }}"
                                    placeholder="Enter Business Email">
                            </div>

                            {{-- Full Address --}}
                            <div class="info-group" style="grid-column: span 2;">
                                <label>Full Address</label>
                                <textarea name="full_address"
                                    placeholder="Enter Full Address">{{ old('full_address', $customer->full_address ?? '') }}</textarea>
                            </div>

                            {{-- Country --}}
                            <div class="info-group">
                                <label>Country</label>
                                <input type="text" name="country" value="{{ old('country', $customer->country) }}"
                                    placeholder="Enter Country">
                            </div>

                            {{-- State --}}
                            <div class="info-group">
                                <label>State</label>
                                <input type="text" name="state" value="{{ old('state', $customer->state ?? '') }}"
                                    placeholder="Enter State">
                            </div>

                            {{-- City --}}
                            <div class="info-group">
                                <label>City</label>
                                <input type="text" name="city" value="{{ old('city', $customer->city ?? '') }}"
                                    placeholder="Enter City">
                            </div>

                            {{-- Zip Code --}}
                            <div class="info-group">
                                <label>Zip Code</label>
                                <input type="text" name="zip_code" value="{{ old('zip_code', $customer->zip_code ?? '') }}"
                                    placeholder="Enter Zip Code">
                            </div>

                            {{-- Actions --}}
                            <div class="personal-info-actions">
                                <button class="btn-cancel" type="reset">Cancel</button>
                                <button class="btn-save" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <!-- Popup Modal -->
                    <div class="modal-overlay" id="modalOverlay">
                        <div class="modal-box">
                            <h4 style="font-weight: 600;" id="modalTitle">Change</h4>
                            <hr>
                            <div class="info-group">
                                <label id="newFieldLabel">Enter New</label>
                                <input type="text" id="newFieldInput">
                            </div>
                            <div class="info-group">
                                <label>Enter OTP</label>
                                <input type="text" placeholder="Enter OTP">
                            </div>

                            <!-- Timer Line -->
                            <div id="otp-timer" class="text-start" style="margin: 10px 0; color: gray; font-size: 14px;">
                                Resend OTP in <span id="countdown">30</span>s
                            </div>
                            <button id="resend-btn" class="btn-resend"
                                style="display:none; background:none; border:none; color:#007bff; cursor:pointer;">
                                Resend OTP
                            </button>

                            <div class="modal-actions">
                                <button class="btn-close" onclick="closeModal()">Close</button>
                                <button class="btn-verify">Verify & Update</button>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- </div> -->

                <div class="profile-card" id="account">
                    <h3>Account Setting</h3>
                    <p>Manage your password, configure your security settings here.</p>

                    <div class="account-top-card">
                        <!-- Card 1: Account Info -->
                        <div class="account-settings-card">
                            <h4>Account Info</h4>
                            <div class="account-info">
                                <div class="info-row">
                                    <strong>Account Type</strong>
                                    <span>{{ ucfirst($customer->account_type ?? 'Free') }}</span>
                                </div>
                                <div class="info-row">
                                    <strong>Member Since</strong>
                                    <span>{{ $customer->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="info-row">
                                    <strong>Account Status</strong>
                                    <span>{{ $customer->status == 'active' ? 'Active' : 'Inactive' }}</span>
                                </div>
                                <div class="info-row">
                                    <strong>Email Verified</strong>
                                    <span>{{ $customer->email_verified_at ? 'Yes' : 'No' }}</span>
                                </div>
                                <div class="info-row">
                                    <strong>Mobile Verified</strong>
                                    <span>{{ $customer->mobile_verified_at ? 'Yes' : 'No' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Change Password -->
                        <div class="account-settings-card">
                            <h4>Change Password</h4>
                            <div class="password-group">
                                <label>Enter New Password</label>
                                <input type="password" id="newPassword" placeholder="Enter New Password">
                                <span class="toggle-view" onclick="togglePassword('newPassword')">👁</span>
                                <div class="password-note">
                                    Password should be alphanumeric with at least one special character.
                                </div>
                            </div>
                            <div class="password-group">
                                <label>Confirm New Password</label>
                                <input type="password" id="confirmPassword" placeholder="Confirm Password">
                                <span class="toggle-view" onclick="togglePassword('confirmPassword')">👁</span>
                            </div>
                            <button class="btn-save" id="updatePasswordBtn">Update Password</button>
                        </div>
                    </div>

                    <!-- Card 3: Delete Account -->
                    <div class="account-settings-card delete-card">
                        <h4>Delete Account</h4>
                        <button class="delete-btn">Delete My Account</button>
                    </div>
                </div>


                <script>
                    function togglePassword(id) {
                        const field = document.getElementById(id);
                        field.type = field.type === "password" ? "text" : "password";
                    }
                </script>


                <div class="profile-card" id="kyc">
                    <h3>KYC</h3>
                    <p>Please upload your KYC documents to verify your account.</p>

                    <form id="kycForm" method="POST" action="{{ route('kyc.update') }}" enctype="multipart/form-data">
                        @csrf

                        @php $isIndian = strtolower($customer->country) === 'india'; @endphp

                        @if($isIndian)
                            {{-- PAN --}}
                            <div class="info-group">
                                <label>PAN Number</label>
                                <input type="text" name="pan_number"
                                    value="{{ old('pan_number', $customer->kyc?->pan_number ?? '') }}"
                                    placeholder="Enter PAN Number" required>
                            </div>

                            {{-- Aadhaar --}}
                            <div class="info-group">
                                <label>Aadhaar Number</label>
                                <input type="text" name="aadhaar_number"
                                    value="{{ old('aadhaar_number', $customer->kyc?->aadhaar_number ?? '') }}"
                                    placeholder="Enter Aadhaar Number" required>
                            </div>

                            {{-- GST --}}
                            <div class="info-group">
                                <label>GST Number</label>
                                <input type="text" name="gst_number"
                                    value="{{ old('gst_number', $customer->kyc?->gst_number ?? '') }}">
                            </div>

                            <div class="info-group">
                                <label>PAN Card Document</label>
                                <input type="file" id="panDocInput" name="pan_document" accept="image/*,application/pdf">
                                @if($customer->kyc && $customer->kyc->pan_document)
                                    <img id="panDocPreview" src="{{ asset('storage/' . $customer->kyc->pan_document) }}"
                                        style="display:block; width:100px; margin-top:5px;">
                                @else
                                    <img id="panDocPreview" style="display:none; width:100px; margin-top:5px;">
                                @endif
                            </div>

                            <div class="info-group">
                                <label>Aadhaar Front Document</label>
                                {{-- Aadhaar Front --}}
                                <input type="file" id="aadhaarFrontInput" name="aadhaar_front" accept="image/*,application/pdf">
                                @if($customer->kyc && $customer->kyc->aadhaar_front)
                                    <img id="aadhaarFrontPreview" src="{{ asset('storage/' . $customer->kyc->aadhaar_front) }}"
                                        style="display:block; width:100px; margin-top:5px;">
                                @else
                                    <img id="aadhaarFrontPreview" style="display:none; width:100px; margin-top:5px;">
                                @endif
                            </div>

                            <div class="info-group">
                                <label>Aadhaar Back Document</label>
                                <input type="file" id="aadhaarBackInput" name="aadhaar_back" accept="image/*,application/pdf">
                                @if($customer->kyc && $customer->kyc->aadhaar_back)
                                    <img id="aadhaarBackPreview" src="{{ asset('storage/' . $customer->kyc->aadhaar_back) }}"
                                        style="display:block; width:100px; margin-top:5px;" />
                                @else
                                    <img id="aadhaarBackPreview" style="display:none; width:100px; margin-top:5px;" />
                                @endif
                            </div>


                            <div class="info-group">
                                <label>GST Certificate</label>
                                <input type="file" id="gstDocInput" name="gst_document" accept="image/*,application/pdf">
                                @if($customer->kyc && $customer->kyc->gst_document)
                                    <img id="gstDocPreview" src="{{ asset('storage/' . $customer->kyc->gst_document) }}"
                                        style="display:block; width:100px; margin-top:5px;" />
                                @else
                                    <img id="gstDocPreview" style="display:none; width:100px; margin-top:5px;" />
                                @endif
                            </div>

                        @else
                            {{-- Personal ID --}}
                            <div class="info-group">
                                <label>Personal ID Number</label>
                                <input type="text" name="personal_id_number"
                                    value="{{ old('personal_id_number', $customer->kyc?->personal_id_number ?? '') }}">
                            </div>
                            {{-- Entity Registration --}}
                            <div class="info-group">
                                <label>Entity Registration Number</label>
                                <input type="text" name="entity_registration_number"
                                    value="{{ old('entity_registration_number', $customer->kyc?->entity_registration_number ?? '') }}">
                            </div>

                            {{-- Tax --}}
                            <div class="info-group">
                                <label>Tax Registration Number</label>
                                <input type="text" name="tax_registration_number"
                                    value="{{ old('tax_registration_number', $customer->kyc?->tax_registration_number ?? '') }}">
                            </div>

                            <div class="info-group">
                                <label>Govt. ID Document</label>
                                <input type="file" id="personalIdInput" name="personal_id_document"
                                    accept="image/*,application/pdf">
                                @if($customer->kyc && $customer->kyc->personal_id_document)
                                    <img id="personalIdPreview" src="{{ asset('storage/' . $customer->kyc->personal_id_document) }}"
                                        style="display:block; width:100px; margin-top:5px;" />
                                @else
                                    <img id="personalIdPreview" style="display:none; width:100px; margin-top:5px;" />
                                @endif
                            </div>

                            <div class="info-group">
                                <label>Entity Registration Certificate</label>
                                <input type="file" id="entityRegInput" name="entity_registration_document"
                                    accept="image/*,application/pdf">
                                @if($customer->kyc && $customer->kyc->entity_registration_document)
                                    <img id="entityRegPreview"
                                        src="{{ asset('storage/' . $customer->kyc->entity_registration_document) }}"
                                        style="display:block; width:100px; margin-top:5px;" />
                                @else
                                    <img id="entityRegPreview" style="display:none; width:100px; margin-top:5px;" />
                                @endif
                            </div>


                        @endif

                        <div class="personal-info-actions">
                            <button class="btn-cancel" type="reset">Cancel</button>
                            <button class="btn-save" type="submit">Save KYC</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <footer class="footer text-center text-muted">
            All Rights Reserved by Adminmart. Designed and Developed by
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>

@endsection

@push('scripts')
    <script>

        const tabs = document.querySelectorAll(".profile-tab");
        const cards = document.querySelectorAll(".profile-card");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                // remove active from all tabs
                tabs.forEach(t => t.classList.remove("active"));
                // add active to clicked tab
                tab.classList.add("active");

                // hide all cards
                cards.forEach(card => card.classList.remove("active"));
                // show selected card
                document.getElementById(tab.dataset.tab).classList.add("active");
            });
        });



        // Indian KYC
        previewFile('panDocInput', 'panDocPreview');
        previewFile('aadhaarFrontInput', 'aadhaarFrontPreview');
        previewFile('aadhaarBackInput', 'aadhaarBackPreview');
        previewFile('gstDocInput', 'gstDocPreview');

        // Non-Indian KYC
        previewFile('personalIdInput', 'personalIdPreview');
        previewFile('entityRegInput', 'entityRegPreview');

        // Live preview for KYC documents
        function previewFile(inputId, imgId) {
            const inputEl = document.getElementById(inputId);
            const imgEl = document.getElementById(imgId);

            if (!inputEl || !imgEl) return; // exit if either element doesn't exist

            inputEl.addEventListener('change', function (event) {
                const [file] = event.target.files;
                if (file) {
                    if (file.type.startsWith('image/')) {
                        imgEl.src = URL.createObjectURL(file);
                        imgEl.style.display = 'block';
                    } else {
                        imgEl.style.display = 'none';
                    }
                }
            });
        }


        document.getElementById('profilePicInput').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                document.querySelector('.profile-pic-preview').src = URL.createObjectURL(file);
            }
        });


        function changeField(type) {
            let fieldName = type === "email" ? "Email Id" : "Mobile Number";
            let inputType = type === "email" ? "email" : "text";
            let placeholder = type === "email" ? "Enter New Email Id" : "Enter New Mobile Number";

            // Step 1: Ask for new email/mobile
            Swal.fire({
                title: `Change ${fieldName}`,
                input: inputType,
                inputLabel: `New ${fieldName}`,
                inputPlaceholder: placeholder,
                showCancelButton: true,
                confirmButtonText: "Send OTP",
                preConfirm: (newValue) => {
                    if (!newValue) {
                        Swal.showValidationMessage(`Please enter a valid ${fieldName}`);
                    }
                    return newValue;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let newValue = result.value;
                    let url = "{{ route('send.otp.both') }}";

                    // Step 2: Send OTP via AJAX
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            type: type,
                            value: newValue,
                            _token: $('meta[name="csrf-token"]').attr("content")
                        },
                        success: function (res) {
                            // Step 3: OTP input
                            Swal.fire({
                                title: `Verify ${fieldName}`,
                                text: `We sent an OTP to ${newValue}`,
                                input: "text",
                                inputPlaceholder: "Enter OTP",
                                showCancelButton: true,
                                confirmButtonText: "Verify OTP",
                                preConfirm: (otp) => {
                                    if (!otp) {
                                        Swal.showValidationMessage("Please enter the OTP");
                                    }
                                    return otp;
                                }
                            }).then((verifyResult) => {
                                if (verifyResult.isConfirmed) {
                                    let otp = verifyResult.value;
                                    let url = "{{ route('verify.otp.both') }}";

                                    // Step 4: Verify OTP AJAX
                                    $.ajax({
                                        url: url,
                                        method: "POST",
                                        data: {
                                            type: type,
                                            value: newValue,
                                            otp: otp,
                                            _token: $('meta[name="csrf-token"]').attr("content")
                                        },
                                        success: function (verifyRes) {
                                            Swal.fire({
                                                icon: "success",
                                                title: `${fieldName} Updated!`,
                                                text: verifyRes.message || `${fieldName} changed successfully`
                                            }).then(() => {
                                                // Reload or update field in DOM
                                                if (type === "email") {
                                                    $("input[name='email']").val(newValue);
                                                } else {
                                                    $("input[name='mobile']").val(newValue);
                                                }
                                            });
                                        },
                                        error: function (xhr) {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Invalid OTP",
                                                text: xhr.responseJSON?.message || "OTP verification failed!"
                                            });
                                        }
                                    });
                                }
                            });
                        },
                        error: function () {
                            Swal.fire({
                                icon: "error",
                                title: "Failed",
                                text: `Could not send OTP to ${newValue}`
                            });
                        }
                    });
                }
            });
        }


        function openModal(type) {
            document.getElementById("modalOverlay").style.display = "flex";
            if (type === "email") {
                document.getElementById("modalTitle").innerText = "Change Email Id";
                document.getElementById("newFieldLabel").innerText = "Enter New Email Id";
                document.getElementById("newFieldInput").type = "email";
                document.getElementById("newFieldInput").placeholder = "New Email Id";
            } else if (type === "mobile") {
                document.getElementById("modalTitle").innerText = "Change Mobile Number";
                document.getElementById("newFieldLabel").innerText = "Enter New Mobile Number";
                document.getElementById("newFieldInput").type = "text";
                document.getElementById("newFieldInput").placeholder = "New Mobile Number";
            }
        }
        function closeModal() {
            document.getElementById("modalOverlay").style.display = "none";
        }

        let countdownEl = document.getElementById("countdown");
        let timerEl = document.getElementById("otp-timer");
        let resendBtn = document.getElementById("resend-btn");
        let otpTimer;

        function startTimer(duration) {
            let timeLeft = duration;
            timerEl.style.display = "block";
            resendBtn.style.display = "none";

            otpTimer = setInterval(() => {
                countdownEl.textContent = timeLeft;
                timeLeft--;

                if (timeLeft < 0) {
                    clearInterval(otpTimer);
                    timerEl.style.display = "none";
                    resendBtn.style.display = "block";
                }
            }, 1000);
        }

        // Modal open hone par timer start karo
        function openModal() {
            document.getElementById("modalOverlay").style.display = "flex";
            startTimer(30); // 30 sec timer
        }

        function closeModal() {
            document.getElementById("modalOverlay").style.display = "none";
            clearInterval(otpTimer); // Stop timer jab modal close ho
        }

        // Resend OTP button
        resendBtn.addEventListener("click", () => {
            alert("OTP Resent!");
            startTimer(30); // Timer reset
        });
    </script>

    <script>
        $(document).ready(function () {

            // Update Password with SweetAlert
            $("#updatePasswordBtn").on("click", function (e) {
                e.preventDefault();

                let newPassword = $("#newPassword").val();
                let confirmPassword = $("#confirmPassword").val();

                if (newPassword !== confirmPassword) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Password Mismatch',
                        text: 'New password and confirm password do not match.',
                        confirmButtonColor: '#d33',
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('update.password') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        password: newPassword,
                        password_confirmation: confirmPassword
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                        });

                        $("#newPassword").val('');
                        $("#confirmPassword").val('');
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMsg = "";
                            $.each(errors, function (key, value) {
                                errorMsg += value[0] + "\n";
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: errorMsg,
                                confirmButtonColor: '#d33',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                confirmButtonColor: '#d33',
                            });
                        }
                    }
                });
            });

            // Profile Form (you already had this)
            $('#profileForm').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                        });
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMsg = "";
                            $.each(errors, function (key, value) {
                                errorMsg += value[0] + "\n";
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: errorMsg,
                                confirmButtonColor: '#d33',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                confirmButtonColor: '#d33',
                            });
                        }
                    }
                });
            });


            // Delete Account
            $(".delete-btn").on("click", function (e) {
                e.preventDefault();

                // Get reasons from backend as JSON
                let reasons = @json(\App\Models\DeletionReason::pluck('reason')->toArray());
                reasons.push("My reason is not mentioned here");

                // Prepare options for SweetAlert select
                let options = {};
                reasons.forEach((r, i) => { options[i] = r; });

                Swal.fire({
                    title: 'Select a reason for account deletion',
                    input: 'select',
                    inputOptions: options,
                    inputPlaceholder: 'Select a reason',
                    showCancelButton: true,
                    confirmButtonText: 'Next',
                    cancelButtonText: 'Cancel',
                    preConfirm: (selectedIndex) => {
                        let selectedReason = reasons[selectedIndex];

                        if (selectedReason === "My reason is not mentioned here") {
                            // Ask for custom reason
                            return Swal.fire({
                                title: 'Enter your reason',
                                input: 'text',
                                inputPlaceholder: 'Your custom reason',
                                showCancelButton: true,
                                confirmButtonText: 'Submit',
                                cancelButtonText: 'Cancel',
                                preConfirm: (customReason) => {
                                    if (!customReason) {
                                        Swal.showValidationMessage('Please enter a reason!');
                                    }
                                    return customReason;
                                }
                            }).then(result => result.value);
                        } else {
                            return selectedReason;
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        let reason = result.value;

                        $.ajax({
                            url: "{{ route('delete.account') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                reason: reason
                            },
                            beforeSend: function () {
                                Swal.fire({
                                    title: 'Sending request...',
                                    text: 'Please wait while we send your account deletion request.',
                                    allowOutsideClick: false,
                                    didOpen: () => Swal.showLoading()
                                });
                            },
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Request Sent!',
                                    text: response.message,
                                    confirmButtonColor: '#3085d6',
                                }).then(() => window.location.href = "{{ route('home') }}");
                            },
                            error: function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong while sending your request!',
                                    confirmButtonColor: '#d33',
                                });
                            }
                        });
                    }
                });
            });

            $('#kycForm').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Uploading KYC...',
                            text: 'Please wait while we verify your documents.',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'KYC Submitted!',
                            text: response.message || 'Your KYC documents have been submitted successfully.',
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                            // Optional: reload page or reset form
                            // location.reload();
                            $('#kycForm')[0].reset();
                        });
                    },
                    error: function (xhr) {
                        Swal.close(); // close loading
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMsg = '';
                            $.each(errors, function (key, value) {
                                errorMsg += value[0] + "\n";
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: errorMsg,
                                confirmButtonColor: '#d33'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: xhr.responseJSON?.message || 'Something went wrong while submitting your KYC!',
                                confirmButtonColor: '#d33'
                            });
                        }
                    }
                });
            });

        });
    </script>

@endpush