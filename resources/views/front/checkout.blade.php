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
          <li><a href="{{ route('home') }}">home</a></li>
          <li>Checkout</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="card-area padding-top-60px padding-bottom-90px">
    <div class="container">
      <div class="row justify-content-center">

        <!-- LEFT -->
        <div class="col-lg-7 mb-4">

          <!-- PRODUCT -->
          <div class="card shadow-sm mb-4">
            <div class="card-body d-flex align-items-center">
              @if($productPhoto)
                <img src="{{ asset('storage/' . $productPhoto) }}" class="rounded me-3" style="max-width:120px;">
              @endif
              <div>
                <h5>{{ $productTitle }}</h5>
                <p class="text-muted small">Category: {{ $category ?? 'N/A' }}</p>
              </div>
            </div>
          </div>

          <!-- PAYMENT -->
          <div class="card shadow-sm">
            <div class="card-body">
              <form id="checkoutForm" method="POST"
                action="{{ route('checkout.place-order', ['id' => $submission->id]) }}">
                @csrf


                <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                <input type="hidden" name="viewer_currency" value="{{ $viewerCurrency }}">

                <input type="hidden" id="total_inr" value="{{ number_format($totalINR, 2, '.', '') }}">
                <input type="hidden" id="wallet_inr" value="{{ number_format($walletRaw, 2, '.', '') }}">

                <h5 class="mb-3">Payment Options</h5>

                <!-- ✅ Razorpay for ALL currencies -->
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="payment_method" value="pay_online" checked>
                  <label class="form-check-label">
                    Pay Online (Card / UPI / Netbanking)
                  </label>
                </div>

                <!-- Wallet -->
                <div class="form-check mt-2">
                  <input class="form-check-input" type="radio" name="payment_method" value="wallet">
                  <label class="form-check-label">
                    Use Wallet Balance ({{ $currencySymbol }}{{ number_format($walletBalance, 2) }})
                    &nbsp;
                    <a class="text-primary" id="addMoneyButton" data-amount="{{ $requiredAmountINR * 100 }}"
                      style="text-decoration: underline; cursor: pointer;">
                      Add Funds
                    </a>
                  </label>
                </div>

                <button class="btn btn-primary w-100 mt-4">
                  Place Order
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="col-lg-5">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4>Order Summary</h4>

              <div class="d-flex justify-content-between">
                <span>Price</span>
                <span>{{ $currencySymbol }}{{ number_format($displayPrice, 2) }}</span>
              </div>

              @if($gstType === 'cgst_sgst')
                <div class="d-flex justify-content-between">
                  <span>CGST</span>
                  <span>{{ $currencySymbol }}{{ number_format($cgstDisplay ?? 0, 2) }}</span>
                </div>

                <div class="d-flex justify-content-between">
                  <span>SGST</span>
                  <span>{{ $currencySymbol }}{{ number_format($sgstDisplay ?? 0, 2) }}</span>
                </div>
              @endif

              @if($gstType === 'igst')
                <div class="d-flex justify-content-between">
                  <span>IGST</span>
                  <span>{{ $currencySymbol }}{{ number_format($igstDisplay ?? 0, 2) }}</span>
                </div>
              @endif

              <hr>

              <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>{{ $currencySymbol }}{{ number_format($total, 2) }}</span>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {

      const checkoutForm = document.getElementById('checkoutForm');
      var addMoneyButton = document.getElementById('addMoneyButton');

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

      checkoutForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const method = document.querySelector('input[name="payment_method"]:checked').value;

        // WALLET PAYMENT (INR only)
        if (method === 'wallet') {
          const walletINR = parseFloat(document.getElementById('wallet_inr').value);
          const totalINR = parseFloat(document.getElementById('total_inr').value);

          if (walletINR < totalINR) {
            Swal.fire('Insufficient wallet balance');
            return;
          }

          placeOrder();
          return;
        }

        // RAZORPAY (ALWAYS INR)
        let razorpayAmount = parseFloat(
          document.getElementById('total_inr').value
        );

        razorpayAmount = Math.round(razorpayAmount * 100); // paise

        const options = {
          key: "{{ config('services.razorpay.key') }}",
          amount: razorpayAmount,
          currency: "INR",
          name: "Flippingo",
          description: "{{ $productTitle }}",
          handler: function (response) {
            const formData = new FormData(checkoutForm);
            formData.append('razorpay_payment_id', response.razorpay_payment_id);
            placeOrder(formData);
          }
        };

        new Razorpay(options).open();
      });

      function placeOrder(formData = new FormData(checkoutForm)) {
        fetch(checkoutForm.action, {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          body: formData
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              window.location.href = data.redirect_url;
            } else {
              Swal.fire(data.message || 'Order failed');
            }
          });
      }
    });
  </script>


@endsection