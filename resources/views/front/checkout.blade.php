@extends('layouts.new-master')

@section('title')
  Checkout | Flippingo
@endsection

@section('content')
  <section class="breadcrumb-area bread-bg" style="margin-top: 40px;">
    <div class="overlay"></div>
    <div class="container">
      <div class="breadcrumb-content text-center">
        <h2 class="sec__title text-white mb-3">Checkout</h2>
        <ul class="bread-list">
          <li><a href={{ Route('home') }}>home</a></li>
          <li>Checkout</li>
        </ul>
      </div>
    </div>
    <div class="bread-svg">
      <svg viewBox="0 0 500 150" preserveAspectRatio="none">
        <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
      </svg>
    </div>
  </section>


  @php
    $requiredAmount = max(0, $total - $walletBalance);
  @endphp

  <section class="card-area padding-top-60px padding-bottom-90px">
    <div class="container">
      <div class="row justify-content-center">
        <!-- LEFT SIDE: PRODUCT DETAILS + PAYMENT -->
        <div class="col-lg-7 mb-4">
          <div class="card shadow-sm mb-4">
            <div class="card-body d-flex align-items-center">
              @if($productPhoto)
                <img src="{{ asset('storage/' . $productPhoto) }}" alt="{{ $productTitle }}" class="img-fluid rounded me-3"
                  style="max-width: 120px;">
              @endif
              <div>
                <h5 class="mb-1">{{ $productTitle }}</h5>
                <p class="text-muted small mb-0">Category: {{ $category ?? 'N/A' }}</p>
              </div>
            </div>
          </div>

          <div class="card shadow-sm">
            <div class="card-body">
              <form id="checkoutForm" method="POST"
                action="{{ route('checkout.place-order', ['id' => $submission->id]) }}">
                @csrf
                <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                <input type="hidden" name="subtotal" value="{{ number_format($mrp, 2, '.', '') }}">
                <input type="hidden" name="discount" value="{{ number_format($discount ?? 0, 2, '.', '') }}">
                <input type="hidden" name="igst" value="{{ number_format($igst ?? 0, 2, '.', '') }}">
                <input type="hidden" name="cgst" value="{{ number_format($cgst ?? 0, 2, '.', '') }}">
                <input type="hidden" name="sgst" value="{{ number_format($sgst ?? 0, 2, '.', '') }}">
                <input type="hidden" name="total" value="{{ number_format($total, 2, '.', '') }}">


                <h2 class="h5 mb-4">Payment Options</h2>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" value="pay_online" id="payOnline"
                      checked>
                    <label class="form-check-label" for="payOnline">Pay Online</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" value="wallet" id="walletPay">
                    <label class="form-check-label" for="walletPay">
                      Use Wallet Balance (Balance: ₹{{ number_format($walletBalance, 2) ?? '0.00' }})
                      &nbsp;
                      <a class="text-primary" id="addMoneyButton" data-amount="{{ $requiredAmount * 100 }}"
                        style="text-decoration: underline; cursor: pointer;">
                        Add Funds
                      </a>
                    </label>
                  </div>

                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Plac Order</button>
              </form>
            </div>
          </div>
        </div>

        <!-- RIGHT SIDE: ORDER SUMMARY -->
        <div class="col-lg-5">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="mb-4">Order Summary</h4>

              <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>₹{{ number_format($mrp, 2) }}</span>
              </div>

              @if(!empty($discount) && $discount > 0)
                <div class="d-flex justify-content-between">
                  <span>Discount</span>
                  <span>- ₹{{ number_format($discount, 2) }}</span>
                </div>
              @endif

              <!-- GST details -->
              @if($gstType === 'igst')
                <div class="d-flex justify-content-between">
                  <span>IGST</span>
                  <span>₹{{ number_format($igst, 2) }}</span>
                </div>
              @elseif($gstType === 'cgst_sgst')
                <div class="d-flex justify-content-between">
                  <span>CGST</span>
                  <span>₹{{ number_format($cgst, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span>SGST</span>
                  <span>₹{{ number_format($sgst, 2) }}</span>
                </div>
              @endif

              <hr>
              <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>₹{{ number_format($total, 2) }}</span>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>

    document.addEventListener('DOMContentLoaded', function () {
      var addMoneyButton = document.getElementById('addMoneyButton');
      var checkoutForm = document.getElementById('checkoutForm');

      // For Razorpay wallet topup button (existing code)
      if (addMoneyButton) {
        addMoneyButton.addEventListener('click', function () {
          var amount = this.getAttribute('data-amount');
          var options = {
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
              }).then(res => res.json())
                .then(data => {
                  if (data.success) {
                    Swal.fire('Success', 'Wallet funded', 'success')
                      .then(() => location.reload());
                  } else {
                    Swal.fire('Error', data.message || 'Failed', 'error');
                  }
                }).catch(() => {
                  Swal.fire('Error', 'Verification failed', 'error');
                });
            },
            prefill: {
              name: "{{ auth()->user()->name }}",
              email: "{{ auth()->user()->email }}",
              contact: "{{ auth()->user()->phone ?? '' }}"
            },
            theme: { color: "#2979ff" }
          };
          var rzp = new Razorpay(options);
          rzp.open();
        });
      }

      // Handle checkout form AJAX submit
      checkoutForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(form);
        var paymentMethod = form.querySelector('input[name="payment_method"]:checked').value;

        if (paymentMethod === 'pay_online') {
          // Start Razorpay payment
          var amountInPaise = parseInt({{ intval($total * 100) }});

          var options = {
            key: "{{ config('services.razorpay.key') }}",
            amount: amountInPaise,
            currency: "INR",
            name: "Flippingo",
            description: "{{ $productTitle }}",
            image: "{{ asset('logo.png') }}",
            handler: function (response) {
              // Append payment id to form data
              formData.append('razorpay_payment_id', response.razorpay_payment_id);

              // Send AJAX to place order
              placeOrder(form.action, formData);
            },
            prefill: {
              name: "{{ auth()->user()->name }}",
              email: "{{ auth()->user()->email }}",
              contact: "{{ auth()->user()->phone ?? '' }}"
            },
            theme: { color: "#2979ff" }
          };
          var rzp = new Razorpay(options);
          rzp.open();

        } else if (paymentMethod === 'wallet') {
          // Check wallet balance client side
          var walletBalance = parseFloat({{ $walletBalance }});
          var totalAmount = parseFloat({{ $total }});

          if (walletBalance < totalAmount) {
            Swal.fire('Insufficient wallet balance.');
            return;
          }

          // No razorpay_payment_id for wallet payment
          placeOrder(form.action, formData);
        }
      });

      // AJAX function to place order
      function placeOrder(url, formData) {
        fetch(url, {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire('Order Successful', 'Your order has been placed.', 'success')
                .then(() => window.location.href = data.redirect_url );
            } else {
              Swal.fire('Error', data.message || 'Order placement failed.', 'error');
            }
          })
          .catch(() => {
            Swal.fire('Error', 'Server error occurred.', 'error');
          });
      }
    });


  </script>



@endsection