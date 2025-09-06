@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Subscription Plan' }}
@endsection



@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">

        <div class="subscription-page">
            <h2 class="subscription-title">Subscription Plan</h2>
            <div class="subscription-modal-body">
                <div class="packages-grid">

                    <!-- Free Plan -->
                    <div class="package-card" data-badge="Free">
                        <h3>Temporary Free Option</h3>
                        <p class="price">₹0</p>
                        <hr>
                        <ul>
                            <li>✅ 1 Listing Free On Signup</li>
                            <li>✅ Listings Duration - For 30 days</li>
                        </ul>
                        <button class="subscription-btn">Get Started</button>
                    </div>

                    <!-- Basic Plan -->
                    <div class="package-card" data-badge="Regular">
                        <h3>Basic Plan</h3>
                        <p class="price">₹99</p>
                        <hr>
                        <ul>
                            <li>✅ 2X Listings</li>
                            <li>✅ Listings Duration - 90 days</li>
                            <li>✅ Promotion - Once in a Month (Whatsapp Group)</li>
                            <li>❌ Sponsor on Front Page</li>
                            <li>❌ Email Alerts</li>
                        </ul>
                        <button class="subscription-btn">Choose Plan</button>
                    </div>

                    <!-- Standard Plan -->
                    <div class="package-card popular" data-badge="Popular">
                        <h3>Standard Plan</h3>
                        <p class="price">₹499</p>
                        <hr>
                        <ul>
                            <li>✅ 10X Listings</li>
                            <li>✅ Listings Duration - 180 days (6 months)</li>
                            <li>✅ Promotion - Twice a Month (Whatsapp Group)</li>
                            <li>✅ Sponsor - 24 Hours on Front Page</li>
                            <li>❌ Email Alerts</li>
                        </ul>
                        <button class="subscription-btn">Choose Plan</button>
                    </div>

                    <!-- Ultimate Plan -->
                    <div class="package-card" data-badge="Best Value">
                        <h3>Ultimate Plan</h3>
                        <p class="price">₹999</p>
                        <hr>
                        <ul>
                            <li>✅ 20X Listings</li>
                            <li>✅ Listings Duration - 365 days (1 year)</li>
                            <li>✅ Weekly Promotion (Whatsapp Group)</li>
                            <li>✅ Sponsor - 72 Hours on Front Page</li>
                            <li>✅ Email Alerts to Buyers</li>
                        </ul>
                        <button class="subscription-btn">Choose Plan</button>
                    </div>

                    <!-- Custom Plan -->
                    <div class="package-card" data-badge="Custom">
                        <h3>Custom Plan</h3>
                        <p class="price">Contact Sales</p>
                        <p style="margin:10px 0; font-size:14px;">Get a tailored plan as per your needs</p>
                        <button class="subscription-btn">Contact Us</button>
                    </div>

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

@endpush