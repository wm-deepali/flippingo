@extends('layouts.master')
@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Admin</a></li>
                                    <li class="breadcrumb-item active">Settings</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="page-admin-settings">
                    <div class="row">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column nav-left">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#gst-setting">
                                        <i data-feather="percent" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">GST Setting</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#invoice-setting">
                                        <i data-feather="file-text" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Invoice Setting</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#smtp-setting">
                                        <i data-feather="mail" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">SMTP</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#sms-setting">
                                        <i data-feather="message-square" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">SMS</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#payment-setting">
                                        <i data-feather="credit-card" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Payment Gateway</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#commission-setting">
                                        <i data-feather="dollar-sign" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">Seller Commission</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">

                                        {{-- GST --}}
                                        <div class="tab-pane active" id="gst-setting">
                                            <form method="POST" action="{{ route('admin.settings.update') }}">
                                                @csrf

                                                <div class="form-group">
                                                    <label>IGST (%)</label>
                                                    <input type="text" class="form-control" name="igst"
                                                        value="{{ $settings['igst'] ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>CGST (%)</label>
                                                    <input type="text" class="form-control" name="cgst"
                                                        value="{{ $settings['cgst'] ?? '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>SGST (%)</label>
                                                    <input type="text" class="form-control" name="sgst"
                                                        value="{{ $settings['sgst'] ?? '' }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save GST</button>
                                            </form>
                                        </div>

                                        {{-- Invoice --}}
                                        <div class="tab-pane fade" id="invoice-setting">
                                            <form method="POST" action="{{ route('admin.settings.update') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label>Invoice Prefix</label>
                                                    <input type="text" class="form-control" name="invoice_prefix"
                                                        value="{{ $settings['invoice_prefix'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Serial Number</label>
                                                    <input type="text" class="form-control" name="invoice_serial"
                                                        value="{{ $settings['invoice_serial'] ?? '' }}">
                                                </div>

                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="useRandomDigits"
                                                        name="use_random_digits" value="1" {{ !empty($settings['use_random_digits']) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="useRandomDigits">Use Random
                                                        Digits?</label>
                                                </div>

                                                <div class="form-group" id="randomDigitsBox" style="display:none;">
                                                    <label>Number of Random Digits</label>
                                                    <input type="number" class="form-control" name="invoice_random_digits"
                                                        value="{{ $settings['invoice_random_digits'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Include Financial Year?</label>
                                                    <select class="form-control" name="include_financial_year">
                                                        <option value="0" {{ ($settings['include_financial_year'] ?? '') == 0 ? 'selected' : '' }}>No</option>
                                                        <option value="1" {{ ($settings['include_financial_year'] ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                                                    </select>
                                                </div>

                                                <hr>
                                                <h5 class="mb-1 mt-2">Billing Details</h5>

                                                <div class="form-group">
                                                    <label>Billing Address</label>
                                                    <textarea class="form-control"
                                                        name="billing_address">{{ $settings['billing_address'] ?? '' }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" name="billing_country"
                                                        value="{{ $settings['billing_country'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="billing_state"
                                                        value="{{ $settings['billing_state'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name="billing_city"
                                                        value="{{ $settings['billing_city'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Pin Code</label>
                                                    <input type="text" class="form-control" name="billing_pincode"
                                                        value="{{ $settings['billing_pincode'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Contact Numbers</label>
                                                    <input type="text" class="form-control" name="billing_contact"
                                                        value="{{ $settings['billing_contact'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Email ID</label>
                                                    <input type="email" class="form-control" name="billing_email"
                                                        value="{{ $settings['billing_email'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Website URL</label>
                                                    <input type="text" class="form-control" name="billing_website"
                                                        value="{{ $settings['billing_website'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Terms & Conditions</label>
                                                    <textarea id="billing_terms" class="form-control"
                                                        name="billing_terms">{{ $settings['billing_terms'] ?? '' }}</textarea>
                                                </div>


                                                <div class="form-group">
                                                    <label>Upload Logo</label>
                                                    @if(!empty($settings['billing_logo']))
                                                        <p>Current Logo:</p>
                                                        <img src="{{ asset('storage/' . $settings['billing_logo']) }}"
                                                            height="50">
                                                    @endif
                                                    <input type="file" class="form-control" name="billing_logo">

                                                </div>

                                                <button type="submit" class="btn btn-primary">Save Invoice</button>
                                            </form>
                                        </div>

                                        {{-- SMTP --}}
                                        <div class="tab-pane fade" id="smtp-setting">
                                            <form method="POST" action="{{ route('admin.settings.update') }}">
                                                @csrf

                                                <div class="form-group">
                                                    <label>SMTP Host</label>
                                                    <input type="text" class="form-control" name="smtp_host"
                                                        value="{{ $settings['smtp_host'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>SMTP Port</label>
                                                    <input type="text" class="form-control" name="smtp_port"
                                                        value="{{ $settings['smtp_port'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>SMTP Username</label>
                                                    <input type="text" class="form-control" name="smtp_username"
                                                        value="{{ $settings['smtp_username'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>SMTP Password</label>
                                                    <input type="password" class="form-control" name="smtp_password"
                                                        value="{{ $settings['smtp_password'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Encryption</label>
                                                    <select class="form-control" name="mail_encryption">
                                                        <option value="" {{ empty($settings['mail_encryption']) ? 'selected' : '' }}>None</option>
                                                        <option value="tls" {{ ($settings['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                                        <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>From Address</label>
                                                    <input type="email" class="form-control" name="mail_from_address"
                                                        value="{{ $settings['mail_from_address'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>From Name</label>
                                                    <input type="text" class="form-control" name="mail_from_name"
                                                        value="{{ $settings['mail_from_name'] ?? '' }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save SMTP</button>
                                            </form>
                                        </div>


                                        {{-- SMS --}}
                                        <div class="tab-pane fade" id="sms-setting">
                                            <form method="POST" action="{{ route('admin.settings.update') }}">
                                                @csrf

                                                {{-- Common SMS Details --}}
                                                <div class="form-group">
                                                    <label>PE ID (Entity Registration ID)</label>
                                                    <input type="text" class="form-control" name="pe_id"
                                                        value="{{ $settings['pe_id'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Sender ID</label>
                                                    <input type="text" class="form-control" name="sender_id"
                                                        value="{{ $settings['sender_id'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Auth Key</label>
                                                    <input type="text" class="form-control" name="auth_key"
                                                        value="{{ $settings['auth_key'] ?? '' }}">
                                                </div>

                                                @php
                                                    $templates = !empty($settings['sms_templates'])
                                                        ? json_decode($settings['sms_templates'], true)
                                                        : [
                                                            [
                                                                'type' => 'verify_otp',
                                                                'id' => '',
                                                                'text' => '',
                                                                'variables' => 'otp,mobile,name,website'
                                                            ]
                                                        ];
                                                @endphp

                                                {{-- Dynamic Templates --}}
                                                <h5 class="mt-2 mb-1">Templates</h5>
                                                <div id="template-wrapper">
                                                    @foreach($templates as $i => $template)
                                                        <div class="form-group template-row border rounded p-3 mb-2">
                                                            {{-- Template Type --}}
                                                            <label>Template Type</label>
                                                            <select class="form-control mb-2" name="sms_templates[{{ $i }}][type]">
                                                                <option value="verify_otp" {{ ($template['type'] ?? '') == 'verify_otp' ? 'selected' : '' }}>Verify OTP</option>
                                                                <option value="custom" {{ ($template['type'] ?? '') == 'custom' ? 'selected' : '' }}>Custom</option>
                                                            </select>

                                                            {{-- Template ID --}}
                                                            <label>Template ID</label>
                                                            <input type="text" class="form-control mb-2" name="sms_templates[{{ $i }}][id]"
                                                                value="{{ $template['id'] ?? '' }}"
                                                                placeholder="DLT Template ID">

                                                            {{-- Template Text --}}
                                                            <label>Template Text</label>
                                                            <textarea class="form-control mb-2" name="sms_templates[{{ $i }}][text]"
                                                                placeholder="Enter Template Message">{{ $template['text'] ?? '' }}</textarea>

                                                            {{-- Variables --}}
                                                            <label>Available Variables</label>
                                                            <p class="text-muted mb-1">
                                                                You can use these placeholders in your template:
                                                                <code>{otp}</code>, <code>{mobile}</code>, <code>{name}</code>,
                                                                <code>{website}</code>
                                                            </p>
                                                            <input type="hidden" name="sms_templates[{{ $i }}][variables]"
                                                                value="otp,mobile,website">


                                                            {{-- Remove Button --}}
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger mt-2 removeTemplate">Remove</button>
                                                        </div>


                                                    @endforeach
                                                </div>

                                                <button type="button" class="btn btn-sm btn-secondary" id="addTemplate">
                                                    + Add More Templates
                                                </button>

                                                <button type="submit" class="btn btn-primary mt-2">Save SMS</button>
                                            </form>
                                        </div>


                                        {{-- Payment Gateway --}}
                                        <div class="tab-pane fade" id="payment-setting">
                                            <form method="POST" action="{{ route('admin.settings.update') }}">
                                                @csrf

                                                {{-- Razorpay --}}
                                                <h5>Razorpay Settings</h5>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="razorpay_enabled"
                                                        name="razorpay_enabled" value="1" {{ !empty($settings['razorpay_enabled']) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="razorpay_enabled">Enable
                                                        Razorpay</label>
                                                </div>
                                                <div class="gateway-box border p-2 mb-2">
                                                    <div class="form-group">
                                                        <label>Razorpay Key ID</label>
                                                        <input type="text" class="form-control" name="razorpay_key_id"
                                                            value="{{ $settings['razorpay_key_id'] ?? '' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Razorpay Key Secret</label>
                                                        <input type="text" class="form-control" name="razorpay_key_secret"
                                                            value="{{ $settings['razorpay_key_secret'] ?? '' }}">
                                                    </div>
                                                </div>

                                                <hr>

                                                {{-- Stripe --}}
                                                <h5>Stripe Settings</h5>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="stripe_enabled"
                                                        name="stripe_enabled" value="1" {{ !empty($settings['stripe_enabled']) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="stripe_enabled">Enable
                                                        Stripe</label>
                                                </div>
                                                <div class="gateway-box border p-2 mb-2">
                                                    <div class="form-group">
                                                        <label>Stripe Publishable Key</label>
                                                        <input type="text" class="form-control"
                                                            name="stripe_publishable_key"
                                                            value="{{ $settings['stripe_publishable_key'] ?? '' }}">

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Stripe Secret Key</label>
                                                        <input type="text" class="form-control" name="stripe_secret_key"
                                                            value="{{ $settings['stripe_secret_key'] ?? '' }}">
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save Payment Gateways</button>
                                            </form>
                                        </div>


                                        {{-- Seller Commission --}}
                                        <div class="tab-pane fade" id="commission-setting">
                                            <form method="POST" action="{{ route('admin.settings.update') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Default Commission (%)</label>
                                                    <input type="text" class="form-control" name="commission"
                                                        value="{{ $settings['default_commission'] ?? '' }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Commission</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                fetch(this.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'

                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again.'
                        });
                    });

            });
        });


        document.addEventListener("DOMContentLoaded", function () {
            if (document.getElementById('billing_terms')) {
                CKEDITOR.replace('billing_terms', {
                    height: 200,
                    removeButtons: 'PasteFromWord'
                });
            }

            const checkbox = document.getElementById('useRandomDigits');
            const box = document.getElementById('randomDigitsBox');

            checkbox.addEventListener('change', function () {
                box.style.display = this.checked ? 'block' : 'none';
            });

            // Add template
            document.getElementById('addTemplate').addEventListener('click', function () {
                let wrapper = document.getElementById('template-wrapper');
                let newRow = document.querySelector('.template-row').cloneNode(true);

                // Reset inputs
                newRow.querySelectorAll('input, textarea, select').forEach(el => {
                    if (el.tagName === "SELECT") {
                        el.selectedIndex = 0;
                    } else {
                        el.value = '';
                    }
                });

                wrapper.appendChild(newRow);
            });

            // Remove template
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('removeTemplate')) {
                    let row = e.target.closest('.template-row');
                    if (row && document.querySelectorAll('.template-row').length > 1) {
                        row.remove();
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'At least one template is required',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            });

            document.addEventListener("change", function (e) {
                if (e.target.matches('select[name="template_type[]"]')) {
                    const row = e.target.closest('.template-row');
                    const varInput = row.querySelector('input[name="template_variables[]"]');
                    if (e.target.value === 'verify_otp') {
                        varInput.value = 'otp,mobile,name,website';
                    } else if (e.target.value === 'custom') {
                        varInput.value = '';
                    }
                }
            });


        });


    </script>

@endpush