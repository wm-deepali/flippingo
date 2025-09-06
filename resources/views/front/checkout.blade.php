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

  <section class="card-area padding-top-60px padding-bottom-90px">
    <div class="container">
      <div class="row justify-content-center">
        <!-- LEFT SIDE: PRODUCT DETAILS + PAYMENT -->
        <div class="col-lg-7 mb-4">
          <div class="card shadow-sm mb-4">
            <div class="card-body d-flex align-items-center">
              @if($productPhoto)
                <img src="{{ asset('storage/' . $productPhoto) }}" 
                     alt="{{ $productTitle }}" 
                     class="img-fluid rounded me-3" 
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
              <form method="POST" action="#">
                @csrf
                <h2 class="h5 mb-4">Payment Options</h2>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" value="pay_online" id="payOnline" checked>
                    <label class="form-check-label" for="payOnline">Pay Online</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" value="wallet" id="walletPay">
                    <label class="form-check-label" for="walletPay">
                      Use Wallet Balance (Balance: ₹{{ number_format($walletBalance, 2) ?? '0.00' }})
                    </label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Complete Payment</button>
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
                <span>₹{{ number_format($offeredPrice, 2) }}</span>
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
@endsection
