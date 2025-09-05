@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Wallet' }}
@endsection

<style>
    .wallet-section {
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    .wallet-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin: 20px 0;
    }

    .wallet-card {
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .wallet-card h4 {
        margin-bottom: 10px;
        font-size: 16px;
    }

    .wallet-card .wallet-amount {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .wallet-green {
        border-top: 4px solid green;
    }

    .wallet-purple {
        border-top: 4px solid purple;
    }

    .wallet-orange {
        border-top: 4px solid orange;
    }

    .wallet-blue {
        border-top: 4px solid blue;
    }

    .wallet-actions {
        margin: 20px 0;
    }

    .wallet-btn {
        padding: 10px 20px;
        margin-right: 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
    }

    .wallet-add {
        background: black;
        color: #fff;
    }

    .wallet-withdraw {
        background: #b7b7b7;
        border: 1px solid #ddd;
    }

    .wallet-history-heading {
        margin: 20px 0 10px;
        font-size: 18px;
        font-weight: bold;
    }

    .wallet-tabs {
        margin: 10px 0 20px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .wallet-tab {
        background: #f5f5f5;
        border: 1px solid #ddd;
        padding: 8px 15px;
        border-radius: 6px;
        cursor: pointer;
    }

    .wallet-tab.active {
        background: black;
        color: #fff;
        border-color: black;
    }

    .wallet-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .wallet-table th,
    .wallet-table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .wallet-table th {
        background: #f5f5f5;
        font-weight: bold;
    }

    .wallet-no-data {
        text-align: center;
        color: gray;
    }

    .wallet-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* Modal Box */
    .wallet-modal-box {
        background: #fff;
        width: 400px;
        border-radius: 10px;
        overflow: hidden;
        animation: fadeIn 0.3s ease-in-out;
    }

    /* Header */
    .wallet-modal-header {
        background: #2b5cff;
        padding: 15px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .wallet-modal-logo .logo-text {
        background: #fff;
        color: #2b5cff;
        font-weight: bold;
        padding: 4px 8px;
        border-radius: 6px;
        margin-right: 6px;
    }

    .wallet-modal-logo .wallet-brand {
        font-weight: bold;
        font-size: 16px;
    }

    .wallet-modal-logo small {
        display: block;
        font-size: 12px;
        opacity: 0.8;
    }

    .wallet-modal-close {
        background: transparent;
        border: none;
        font-size: 22px;
        color: #fff;
        cursor: pointer;
    }

    /* Title */
    .wallet-modal-title {
        text-align: center;
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .wallet-modal-title h3 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .wallet-modal-title p {
        font-size: 14px;
        color: #555;
    }

    /* Body */
    .wallet-modal-body {
        padding: 20px;
    }

    .wallet-input {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        margin: 10px 0 20px;
        font-size: 16px;
    }

    /* Quick Select */
    .wallet-quick-select {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }

    .wallet-quick-select button {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        cursor: pointer;
        background: #f8f8f8;
        font-weight: bold;
    }

    .wallet-quick-select button:hover {
        background: #e9f0ff;
        border-color: #2b5cff;
    }

    /* Proceed Button */
    .wallet-proceed-btn {
        width: 100%;
        background: #2b5cff;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .wallet-proceed-btn:hover {
        background: #2348d9;
    }

    /* Footer Note */
    .wallet-secure-note {
        text-align: center;
        font-size: 12px;
        color: gray;
        margin-top: 15px;
    }

    @keyframes fadeIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>
<style>
    .wallet-cancel-btn {
        padding: 8px 16px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: #f8f8f8;
        cursor: pointer;
    }

    .wallet-cancel-btn:hover {
        background: #eee;
    }

    .wallet-disabled-btn {
        padding: 8px 16px;
        border-radius: 6px;
        background: #ddd;
        color: #666;
        border: none;
        cursor: not-allowed;
    }
</style>
<style>
    .wallet-method-card {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: 0.3s;
    }

    .wallet-method-card:hover {
        border-color: #059669;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .wallet-method-icon {
        font-size: 28px;
    }

    .wallet-method-info h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .wallet-method-info p {
        margin: 4px 0;
        font-size: 13px;
        color: #555;
    }

    .wallet-method-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 5px;
    }

    .wallet-method-tags span {
        font-size: 11px;
        background: #f1f5f9;
        padding: 3px 6px;
        border-radius: 4px;
        color: #444;
    }

    .wallet-method-arrow {
        margin-left: auto;
        font-size: 18px;
        color: #666;
        align-self: center;
    }

    .wallet-badge {
        background: #059669;
        color: #fff;
        font-size: 10px;
        padding: 2px 5px;
        border-radius: 4px;
        margin-left: 6px;
    }
</style>

@section('content')

    @include('user.sidebar', ['activeTab' => request('tab', 'buyer')])

    <div class="page-wrapper">
        <div class="wallet-section container">
            <h2 class="wallet-title">Wallet</h2>
            <p class="wallet-subtitle">Manage your funds and view transaction history</p>

            <!-- Balance Cards -->
            <div class="wallet-cards">
                <div class="wallet-card wallet-green">
                    <h4>Available Balance</h4>
                    <p class="wallet-amount">₹0</p>
                    <small>Ready to use funds</small>
                </div>
                <div class="wallet-card wallet-purple">
                    <h4>Escrow Balance</h4>
                    <p class="wallet-amount">₹0</p>
                    <small>Funds held in escrow</small>
                </div>
                <div class="wallet-card wallet-orange">
                    <h4>Pending Balance</h4>
                    <p class="wallet-amount">₹0</p>
                    <small>Deposits awaiting verification</small>
                </div>
                <div class="wallet-card wallet-blue">
                    <h4>Total Transactions</h4>
                    <p class="wallet-amount">3</p>
                    <small>All time transactions</small>
                </div>
            </div>

            <!-- Buttons -->
            <div class="wallet-actions " style="margin-top: 40px;margin-bottom: 40px;">
                <button class="wallet-btn wallet-add">+ Add Funds</button>
                <button class="wallet-btn wallet-withdraw">↗ Withdraw</button>
            </div>

            <!-- Transaction History Heading -->
            <h3 class="wallet-history-heading">Transaction History</h3>

            <!-- Tabs -->
            <div class="wallet-tabs">
                <button class="wallet-tab active" data-filter="all">All</button>
                <button class="wallet-tab" data-filter="deposit">Deposits</button>
                <button class="wallet-tab" data-filter="withdrawal">Withdrawals</button>
                <button class="wallet-tab" data-filter="purchase">Purchases</button>
                <button class="wallet-tab" data-filter="sale">Sales</button>
                <button class="wallet-tab" data-filter="plan">Pricing Plan</button>
                <button class="wallet-tab" data-filter="fee">Success Fee</button>
            </div>

            <!-- Transaction Table -->
            <div class="wallet-table">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="wallet-tbody">
                        <!-- Dummy Data -->
                        <tr data-type="deposit">
                            <td>2025-09-01</td>
                            <td>#TXN1001</td>
                            <td>Deposit</td>
                            <td>Funds Added</td>
                            <td>Completed</td>
                            <td>₹500</td>
                        </tr>
                        <tr data-type="withdrawal">
                            <td>2025-09-02</td>
                            <td>#TXN1002</td>
                            <td>Withdrawal</td>
                            <td>Bank Transfer</td>
                            <td>Pending</td>
                            <td>₹300</td>
                        </tr>
                        <tr data-type="purchase">
                            <td>2025-09-03</td>
                            <td>#TXN1003</td>
                            <td>Purchase</td>
                            <td>Digital Asset</td>
                            <td>Completed</td>
                            <td>₹200</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



    </div>
    <div class="wallet-modal-overlay" id="walletModal">
        <div class="wallet-modal-box">

            <!-- Header -->
            <div class="wallet-modal-header">
                <div class="wallet-modal-logo">
                    <span class="logo-text">FT</span>
                    <span class="wallet-brand">FlippingTraders</span>
                    <small>Secure Payment</small>
                </div>
                <button class="wallet-modal-close" onclick="closeWalletModal()">×</button>
            </div>

            <!-- Title -->
            <div class="wallet-modal-title">
                <h3>₹ Add Funds to Wallet</h3>
                <p>Enter the amount you want to add to your wallet</p>
            </div>

            <!-- Body -->
            <div class="wallet-modal-body">
                <label>Enter Amount</label>
                <input type="number" placeholder="₹ 0" class="wallet-input" />

                <!-- Quick Select -->
                <div class="wallet-quick-select">
                    <button>₹100</button>
                    <button>₹500</button>
                    <button>₹1,000</button>
                    <button>₹5,000</button>
                    <button>₹10,000</button>
                </div>

                <!-- Proceed Button -->
                <button class="wallet-proceed-btn">Proceed to Payment →</button>

                <!-- Footer Note -->
                <p class="wallet-secure-note">
                    ✅ Secured by PhonePe & Cashfree • 256-bit SSL encryption
                </p>
            </div>
        </div>
    </div>
    <!-- Withdraw Funds Modal -->
    <div class="wallet-modal-overlay" id="withdrawModal">

        <div class="wallet-modal-box">

            <!-- Header -->
            <div class="wallet-modal-header" style="background:#fff; color:#000; border-bottom:1px solid #eee;">
                <h3 style="font-size:16px; font-weight:600; display:flex; align-items:center; gap:6px;">
                    ⬇ Withdraw Funds
                </h3>
                <button class="wallet-modal-close" onclick="closeWithdrawModal()" style="color:#000;">×</button>
            </div>

            <!-- Body -->
            <div class="wallet-modal-body" style="text-align:center; padding:30px 20px;">
                <div style="font-size:40px; margin-bottom:10px;">💳</div>
                <h4 style="margin:0; font-size:18px; font-weight:600;">No Payment Methods</h4>
                <p style="color:#666; font-size:14px; margin:10px 0;">
                    You need to add a payment method to withdraw funds
                </p>

                <!-- Add Payment Method Button -->
                <button class="wallet-btn" onclick="openAddPaymentMethod()">
                    + Add Payment Method
                </button>
            </div>

            <!-- Footer -->
            <div style="display:flex; justify-content:space-between; padding:15px 20px; border-top:1px solid #eee;">
                <button onclick="closeWithdrawModal()" class="wallet-cancel-btn">
                    Cancel
                </button>
                <button class="wallet-disabled-btn" disabled>
                    Continue
                </button>
            </div>
        </div>

    </div>


@endsection

@push('scripts')

    <script>
        // Tabs Filter Function
        const tabs = document.querySelectorAll(".wallet-tab");
        const rows = document.querySelectorAll("#wallet-tbody tr");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                // remove active class from all tabs
                tabs.forEach(t => t.classList.remove("active"));
                tab.classList.add("active");

                const filter = tab.dataset.filter;

                rows.forEach(row => {
                    if (filter === "all" || row.dataset.type === filter) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>
    <script>
        function openWalletModal() {
            document.getElementById("walletModal").style.display = "flex";
        }
        function closeWalletModal() {
            document.getElementById("walletModal").style.display = "none";
        }

        // Bind button click (example)
        document.querySelector(".wallet-add").addEventListener("click", openWalletModal);
    </script>
    <!-- Withdraw Funds Modal -->




    <script>
        function openWithdrawModal() {
            document.getElementById("withdrawModal").style.display = "flex";
        }
        function closeWithdrawModal() {
            document.getElementById("withdrawModal").style.display = "none";
        }

        // Example button bind
        document.querySelector(".wallet-withdraw").addEventListener("click", openWithdrawModal);
    </script>
    <script>
        function openWithdrawModal() {
            document.getElementById("withdrawModal").style.display = "flex";
        }
        function closeWithdrawModal() {
            document.getElementById("withdrawModal").style.display = "none";
        }

        function openAddPaymentMethod() {
            // Withdraw modal close + Payment modal open
            closeWithdrawModal();
            document.getElementById("paymentMethodModal").style.display = "flex";
        }
        function closePaymentMethodModal() {
            document.getElementById("paymentMethodModal").style.display = "none";
        }
    </script>
    <script>
        let hasPaymentMethods = true; // 🚩 Condition yahan set karo (true = show list, false = add method)

        // Open Modal
        function openPaymentMethodModal() {
            document.getElementById("paymentMethodModal").style.display = "flex";
            if (hasPaymentMethods) {
                document.getElementById("methodList").style.display = "block";
                document.getElementById("addMethod").style.display = "none";
                document.getElementById("modalTitle").innerText = "💳 Select Payment Method";
            } else {
                document.getElementById("methodList").style.display = "none";
                document.getElementById("addMethod").style.display = "block";
                document.getElementById("modalTitle").innerText = "💳 Add Payment Method";
            }
        }

        // Close Modal
        function closePaymentMethodModal() {
            document.getElementById("paymentMethodModal").style.display = "none";
        }

        // Switch to Add New
        // function showAddMethod() {
        //   document.getElementById("methodList").style.display = "none";
        //   document.getElementById("addMethod").style.display = "block";
        //   document.getElementById("modalTitle").innerText = "💳 Add Payment Method";
        // }

        // Show Bank Form
        // function showBankForm() {
        //   document.getElementById("bankForm").style.display = "block";
        //   document.getElementById("upiForm").style.display = "none";
        // }

        // Show UPI Form
        // function showUpiForm() {
        //   document.getElementById("upiForm").style.display = "block";
        //   document.getElementById("bankForm").style.display = "none";
        // }
    </script>
    <script>
        function backToAddMethod() {
            document.getElementById("bankForm").style.display = "none";
            document.getElementById("upiForm").style.display = "none";
            document.getElementById("addMethod").style.display = "block";
        }
    </script>

    <script>
        function showAddMethod() {
            document.getElementById("methodList").style.display = "none";
            document.getElementById("addMethod").style.display = "block";
            document.getElementById("methodTabs").style.display = "block";
            document.getElementById("bankForm").style.display = "none";
            document.getElementById("upiForm").style.display = "none";
        }

        function showBankForm() {
            document.getElementById("methodTabs").style.display = "none";
            document.getElementById("bankForm").style.display = "block";
        }

        function showUpiForm() {
            document.getElementById("methodTabs").style.display = "none";
            document.getElementById("upiForm").style.display = "block";
        }

        function backToTabs() {
            document.getElementById("methodTabs").style.display = "block";
            document.getElementById("bankForm").style.display = "none";
            document.getElementById("upiForm").style.display = "none";
        }
    </script>

@endpush