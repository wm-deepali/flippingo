@extends('layouts.user-master')

@section('title')
  {{ $page->meta_title ?? 'Subscription Plan' }}
@endsection

<style>
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

  @include('user.sidebar')

  <div class="page-wrapper">

    <div class="subscription-page">
      <h2 class="subscription-title">Subscription Plan</h2>
      <div class="subscription-modal-body">
        <div class="packages-grid">

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

                  <button class="subscription-btn choose-plan" data-id="{{ $package->id }}" data-name="{{ $package->name }}"
                    data-amount="{{ $package->offered_price * 100 }}"
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
    <!-- Packages Modal -->
  </div>

@endsection

@push('scripts')

  <script>
    let hasSubscription = true; // backend se check karna hoga

    // Page pe check
    window.onload = function () {
      if (hasSubscription) {
        document.getElementById("withSubscription").style.display = "flex";
        document.getElementById("noSubscription").style.display = "none";
      } else {
        document.getElementById("withSubscription").style.display = "none";
        document.getElementById("noSubscription").style.display = "block";
      }
    };

    // Modal Functions
    function openRenewModal() {
      document.getElementById("renewModal").style.display = "flex";
    }
    function closeRenewModal() {
      document.getElementById("renewModal").style.display = "none";
    }

    function openPackagesModal() {
      document.getElementById("packagesModal").style.display = "flex";
    }
    function closePackagesModal() {
      document.getElementById("packagesModal").style.display = "none";
    }
  </script>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    let redirectAfterPayment = "{{request('redirect') ? route(request('redirect')) : route('dashboard.subscriptions') }}";

    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".choose-plan").forEach(button => {
        button.addEventListener("click", function () {
          let packageId = this.getAttribute("data-id");
          let packageName = this.getAttribute("data-name");
          let packageAmount = this.getAttribute("data-amount");
          let packageDesc = this.getAttribute("data-description");

          let options = {
            key: "{{ config('services.razorpay.key') }}", // from config/services.php
            amount: packageAmount,
            currency: "INR",
            name: "Flippingo",
            description: packageDesc,
            image: "{{ asset('logo.png') }}", // optional
            handler: function (response) {
              fetch("{{ route('subscription.store') }}", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                  razorpay_payment_id: response.razorpay_payment_id,
                  package_id: packageId
                })
              })
                .then(res => res.json())
                .then(data => {
                  if (data.success) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Subscription Activated!',
                      text: 'Your subscription has been activated successfully.',
                      confirmButtonText: 'Continue'
                    }).then(() => {
                      window.location.href = redirectAfterPayment;
                    });
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'Payment was successful but there was an error saving your subscription.'
                    });
                  }
                });
            }
          };

          let rzp = new Razorpay(options);
          rzp.open();
        });
      });
    });
  </script>

@endpush