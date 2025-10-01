@extends('layouts.new-master')

@section('title')
    {{ $page->meta_title ?? 'Pricing' }}
@endsection

<style>
    .subscription-page {
        padding: 0px 40px;
        /* font-family: Arial, sans-serif;
  text-align: center; */
    }

    .subscription-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
    }

    .subscription-cards {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .subscription-card {
        flex: 1;
        min-width: 49%;
        /* max-width: 350px; */
        height: 280px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s;
        background: #fff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 25px;
    }

    .subscription-card:hover {
        transform: translateY(-5px);
    }

    /* Active Subscription */
    .active-subscription {
        background: #e6f4ea;
        /* light green pastel */
        text-align: left;
    }

    .active-subscription h3 {
        margin-bottom: 15px;
        color: #059669;
    }

    .subscription-card-content p {
        margin-bottom: 5px;
        padding-left: 30px;
    }

    /* Outline Subscription */
    .outline-subscription {
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 280px;
    }

    .subscription-outline-content {
        text-align: center;
    }

    /* Button */
    .subscription-btn {
        margin-top: 10px;
        padding: 10px 20px;
        background: #059669;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
    }

    .subscription-btn:hover {
        background: #047857;
    }

    /* Empty Subscription Case */
    .subscription-empty {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    /* Modal */
    .subscription-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .subscription-modal-box {
        background: #fff;
        width: 400px;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .subscription-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .subscription-modal-close {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .subscription-modal-body {
        font-size: 15px;
        color: #444;
    }

    .subscription-modal-body {
        padding: 20px;
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
    }

    .package-card {
        background: #f9f9ff;
        /* pastel base */
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 20px;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }

    .package-card h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #333;
    }

    /* Price styling */
    .package-card .price {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #444;
    }

    /* Features list */
    .package-card ul {
        min-height: 252px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .package-card ul li {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        font-size: 14px;
        color: #555;
    }

    .package-card ul li:last-child {
        border-bottom: none;
    }

    /* Button */
    .subscription-btn {
        margin-top: 15px;
        background: #4a6cf7;
        color: #fff;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
    }

    .subscription-btn:hover {
        background: #3653d6;
    }

    /* Badge on top */
    .package-card::before {
        content: attr(data-badge);
        position: absolute;
        top: -12px;
        left: 20px;
        background: #ff6b6b;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        display: none;
    }

    /* Show badge if data-badge is set */
    .package-card[data-badge]:before {
        display: inline-block;
    }

    /* Different background for "popular" */
    .package-card.popular {
        background: #fff9f0;
        border: 2px solid #f7a541;
    }

    .price {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #444;
    }

    .old-price {
        text-decoration: line-through;
        color: #999;
        font-size: 18px;
        margin-right: 8px;
    }

    .new-price {
        color: #e63946;
        /* red highlight */
        font-size: 22px;
        font-weight: 700;
    }
</style>
@section('content')

    <section class="team-area section--padding" style="margin-top:130px;">
        <div class="container">
            <div class="text-center">
                <h2 class="sec__title mb-3">Plans</h2>
                <p class="sec__desc">
                    Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
                    libero, <br />
                    a feugiat eros. Nunc ut lacinia tortors.
                </p>
            </div>

            {{-- 🚨 Flash messages --}}
            @if(request('error'))
                <div class="alert alert-danger" style="margin:20px 0; padding:12px; border-radius:6px;">
                    {{ request('error') }}
                </div>
            @endif


            <div class="subscription-page">

                <div class="subscription-modal-body">
                    <div class="packages-grid">

                        <!-- Free Plan -->
                        <!-- <div class="package-card" data-badge="Free">

                                                                                    <h3>Temporary Free Option</h3>
                                                                                    <p class="price">₹0</p>
                                                                                    <hr>
                                                                                    <ul>
                                                                                        <li>✅ 1 Listing Free On Signup</li>
                                                                                        <li>✅ Listings Duration - For 30 days</li>
                                                                                    </ul>
                                                                                    <button class="subscription-btn">Get Started</button>
                                                                                </div> -->

                        {{-- Dynamic packages from database --}}
                        @forelse($packages as $package)
                                        <div class="package-card {{ $package->is_popular ? 'popular' : '' }}"
                                            data-badge="{{ $package->is_popular ? 'Popular' : 'Regular' }}">

                                            <h3>{{ $package->name }}</h3>

                                            {{-- Price & Discount --}}
                                            <p class="price">
                                                @if($package->discount > 0)
                                                    <span class="old-price">₹{{ $package->mrp }}</span>
                                                    <span class="new-price">
                                                        ₹{{ $package->offered_price }}
                                                        <span style="font-size:14px; color:green;font-weight:500;">
                                                            (You save {{ $package->discount }}%)
                                                        </span>
                                                    </span>
                                                @else
                                                    ₹{{ $package->mrp }}
                                                @endif
                                            </p>

                                            <hr>

                                            {{-- Features --}}
                                            <ul>
                                                <li>✅ {{ $package->listings ? $package->listings_display : 0 }}</li>
                                                <li>✅ Listings Duration - {{ $package->listing_duration ?
                            $package->listing_duration_display : 0 }}</li>
                                                <li>
                                                    @if($package->whatsapp === 'yes' && $package->whatsapp_frequency > 0)
                                                        ✅ promotion - {{ $package->whatsapp_display ?? ''}}
                                                    @else
                                                        ❌ No Promotion
                                                    @endif
                                                </li>
                                                <li>
                                                    @if($package->sponsored === 'yes' && $package->sponsored_frequency > 0)
                                                        ✅ Sponsor - {{ $package->sponsored_display ?? ''}}
                                                    @else
                                                        ❌ No Sponsor
                                                    @endif
                                                </li>
                                                <li>
                                                    @if($package->alerts === 'yes')
                                                        ✅ {{ $package->alerts_display ?? '' }}
                                                    @else
                                                        ❌ No Email Alerts
                                                    @endif
                                                </li>
                                            </ul>

                                            <button class="subscription-btn choose-plan" data-id="{{ $package->id }}"
                                                data-name="{{ $package->name }}" data-amount="{{ $package->offered_price * 100 }}"
                                                data-description="{{ $package->listings_display }} listings for {{ $package->listing_duration_display }}">
                                                Choose Plan
                                            </button>
                                        </div>
                        @empty
                            <div class="subscription-empty">
                                <p>No active packages available right now.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->

        <!-- Payment Choice Modal -->
        <div class="modal fade" id="paymentChoiceModal" tabindex="-1" aria-labelledby="paymentChoiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius:12px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentChoiceModalLabel">Choose Payment Method</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-center">
                        <p>
                            <strong>Wallet Balance:</strong> ₹{{ number_format($walletBalance, 2) }}
                            <br>
                            <a class="text-primary" id="addMoneyButton" data-amount="0"
                                style="text-decoration: underline; cursor: pointer; display:none;">
                                ➕ Add Funds
                            </a>
                        </p>

                        <hr>
                        <button class="btn btn-success w-100 mb-2" id="payFromWalletBtn">💰 Pay from Wallet</button>
                        <button class="btn btn-primary w-100" id="payOnlineBtn">💳 Pay Online</button>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        const isLoggedIn = @json(Auth::guard('customer')->check());
        const loginUrl = "{{ route('authentication-signup', ['redirect' => 'pricing']) }}";


        let redirectAfterPayment = "{{ request('redirect') ?? route('dashboard.index') }}";

        let selectedPackage = {};

        document.addEventListener("DOMContentLoaded", function () {

            document.querySelectorAll(".choose-plan").forEach(button => {
                button.addEventListener("click", function () {
                      // 🔒 If not logged in, redirect
                if (!isLoggedIn) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please Login',
                        text: 'You need to login to choose a subscription plan.',
                        showCancelButton: true,
                        confirmButtonText: 'Login / Signup',
                        cancelButtonText: 'Cancel'
                    }).then(result => {
                        if (result.isConfirmed) {
                            window.location.href = loginUrl;
                        }
                    });
                    return;
                }
                
                    selectedPackage = {
                        id: this.getAttribute("data-id"),
                        name: this.getAttribute("data-name"),
                        amount: this.getAttribute("data-amount"),
                        description: this.getAttribute("data-description"),
                    };

                    // Show modal
                    let modal = new bootstrap.Modal(document.getElementById('paymentChoiceModal'));
                    modal.show();
                });
            });

            // Wallet Payment
            document.getElementById("payFromWalletBtn").addEventListener("click", function () {
                fetch("{{ route('subscription.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        package_id: selectedPackage.id,
                        payment_method: "wallet"
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Subscription Activated!',
                                text: 'Paid via Wallet successfully.'
                            }).then(() => {
                                window.location.href = redirectAfterPayment;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Wallet Payment Failed',
                                text: data.message || 'Insufficient balance.'
                            });
                        }
                    });
            });

            // Online Payment
            document.getElementById("payOnlineBtn").addEventListener("click", function () {
                let options = {
                    key: "{{ config('services.razorpay.key') }}",
                    amount: selectedPackage.amount,
                    currency: "INR",
                    name: "Flippingo",
                    description: selectedPackage.description,
                    image: "{{ asset('logo.png') }}",
                    handler: function (response) {
                        fetch("{{ route('subscription.store') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                razorpay_payment_id: response.razorpay_payment_id,
                                package_id: selectedPackage.id,
                                payment_method: "razorpay"
                            })
                        })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Subscription Activated!',
                                        text: 'Your subscription has been activated successfully.'
                                    }).then(() => {
                                        window.location.href = redirectAfterPayment;
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops!',
                                        text: 'Payment was successful but saving subscription failed.'
                                    });
                                }
                            });
                    }
                };

                let rzp = new Razorpay(options);
                rzp.open();
            });


            let walletBalance = parseFloat("{{ $walletBalance }}");

            document.querySelectorAll(".choose-plan").forEach(button => {
                button.addEventListener("click", function () {
                    selectedPackage = {
                        id: this.getAttribute("data-id"),
                        name: this.getAttribute("data-name"),
                        amount: parseFloat(this.getAttribute("data-amount")), // in paise
                        description: this.getAttribute("data-description"),
                    };

                    let packagePrice = selectedPackage.amount / 100; // convert back to INR
                    let requiredAmount = Math.max(0, packagePrice - walletBalance);

                    let addBtn = document.getElementById("addMoneyButton");

                    if (requiredAmount > 0) {
                        addBtn.style.display = "inline";
                        addBtn.setAttribute("data-amount", requiredAmount * 100); // paise
                        addBtn.textContent = "➕ Add ₹" + requiredAmount.toFixed(2) + " to Wallet";
                    } else {
                        addBtn.style.display = "none";
                    }

                    // Show modal
                    let modal = new bootstrap.Modal(document.getElementById('paymentChoiceModal'));
                    modal.show();
                });
            });


            let addMoneyButton = document.getElementById("addMoneyButton");

            if (addMoneyButton) {
                addMoneyButton.addEventListener("click", function () {
                    let amount = this.getAttribute("data-amount");

                    let options = {
                        key: "{{ config('services.razorpay.key') }}",
                        amount: amount,
                        currency: "INR",
                        name: "Flippingo Wallet",
                        description: "Add funds to wallet",
                        image: "{{ asset('logo.png') }}",
                        handler: function (response) {
                            fetch("{{ route('wallet.add_funds') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    amount: amount
                                })
                            })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('Success', 'Wallet funded successfully.', 'success')
                                            .then(() => location.reload());
                                    } else {
                                        Swal.fire('Error', data.message || 'Funding failed.', 'error');
                                    }
                                })
                                .catch(() => {
                                    Swal.fire('Error', 'Server error occurred.', 'error');
                                });
                        },
                        prefill: {
                            name: "Test",
                            email: "abc@gmail.com",
                            contact: ""
                        },
                        theme: { color: "#2979ff" }
                    };

                    let rzp = new Razorpay(options);
                    rzp.open();
                });
            }


        });

    </script>

@endsection