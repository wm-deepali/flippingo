@extends('layouts.user-master')

@section('title', 'My Subscription')

<style>
    .subscription-modal-overlay {
        display: none;
        /* hide by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .subscription-modal-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        max-width: 500px;
        width: 90%;
        position: relative;
    }

    .subscription-modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }
</style>

@section('content')
    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="subscription-page">
            <h2 class="subscription-title">My Subscription</h2>

            @if($subscription)
                <div class="subscription-cards" id="withSubscription">
                    <div class="subscription-card active-subscription">
                        <div class="subscription-card-content">
                            <h3>⭐ Subscription</h3>
                            <p><strong>Plan:</strong> {{ $subscription->package->name }}</p>
                            <p><strong>Start Date:</strong>
                                {{ \Carbon\Carbon::parse($subscription->start_date)->format('d-M-Y') }}</p>
                            <p><strong>Expiry Date:</strong>
                                {{ \Carbon\Carbon::parse($subscription->end_date)->format('d-M-Y') }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($subscription->status) }}</p>
                        </div>
                        <div class="subscription-card-footer">
                            @if($subscription->status === 'active')
                                <button class="subscription-btn" onclick="openRenewModal()">Renew</button>
                                @if($canCancel)
                                    <button class="subscription-btn cancel-btn" onclick="openCancelModal()">Cancel</button>
                                @endif
                            @elseif($subscription->status === 'cancel_requested')
                                <p class="text-warning">Cancellation requested on
                                    {{ \Carbon\Carbon::parse($subscription->cancel_requested_at)->format('d-M-Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Upgrade Card -->
                    <div class="subscription-card outline-subscription">
                        <div class="subscription-outline-content">
                            <select id="upgradePlan" class="subscription-btn">
                                <option value="">Upgrade Now</option>
                                @foreach($packages as $package)
                                    @if($package->id !== $subscription->package_id)
                                        <option value="{{ $package->id }}">{{ $package->name }} - ₹{{ $package->offered_price }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @else
                <div class="subscription-empty" id="noSubscription">
                    <div class="subscription-card outline-subscription">
                        <div class="subscription-outline-content">
                            <select id="newPlan" class="subscription-btn">
                                <option value="">Get Subscription</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }} - ₹{{ $package->offered_price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <!-- Renew Modal -->
        <div class="subscription-modal-overlay" id="renewModal">
            <div class="subscription-modal-box">
                <div class="subscription-modal-header">
                    <h3>🔄 Renew Subscription</h3>
                    <button class="subscription-modal-close" onclick="closeRenewModal()">×</button>
                </div>
                <div class="subscription-modal-body">
                    @if($subscription)
                        <p>Your current plan is <strong>{{ $subscription->package->name }}</strong>.</p>
                        <p>Renew for <strong>{{ $subscription->package->validity }}
                                {{ $subscription->package->validity_unit }}</strong> at
                            <strong>₹{{ $subscription->package->offered_price }}</strong>.
                        </p>
                        <form action="{{ route('subscription.renew') }}" method="POST">
                            @csrf
                            <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                            <button type="submit" class="subscription-btn">Confirm Renewal</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Cancel Modal -->
        <div class="subscription-modal-overlay" id="cancelModal">
            <div class="subscription-modal-box">
                <div class="subscription-modal-header">
                    <h3>❌ Cancel Subscription</h3>
                    <button class="subscription-modal-close" onclick="closeCancelModal()">×</button>
                </div>
                <div class="subscription-modal-body">
                    <p>You are requesting to cancel your subscription. Please provide a reason:</p>
                    <form action="{{ route('subscription.cancelRequest') }}" method="POST">
                        @csrf
                        @if($subscription)
                            <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                        @endif

                        <textarea name="reason" required class="subscription-textarea"></textarea>
                        <button type="submit" class="subscription-btn">Submit Cancel Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openCancelModal() {
            document.getElementById("cancelModal").style.display = "flex";
        }
        function closeCancelModal() {
            document.getElementById("cancelModal").style.display = "none";
        }

        function openRenewModal() {
            document.getElementById("renewModal").style.display = "flex";
        }
        function closeRenewModal() {
            document.getElementById("renewModal").style.display = "none";
        }
    </script>
@endpush