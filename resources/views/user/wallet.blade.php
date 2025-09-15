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

    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="wallet-section container">
            <h2 class="wallet-title">Wallet</h2>
            <p class="wallet-subtitle">Manage your funds and view transaction history</p>

            <!-- Balance Cards -->
            <div class="wallet-cards">
                <div class="wallet-card wallet-green">
                    <h4>Available Balance</h4>
                    <p class="wallet-amount">₹{{ $availableBalance }}</p>
                    <small>Ready to use funds</small>
                </div>
                <div class="wallet-card wallet-purple">
                    <h4>Escrow Balance</h4>
                    <p class="wallet-amount">₹{{ $escrowBalance }}</p>
                    <small>Funds held in escrow</small>
                </div>
                <div class="wallet-card wallet-orange">
                    <h4>Pending Balance</h4>
                    <p class="wallet-amount">₹{{ $pendingBalance }}</p>
                    <small>Deposits awaiting verification</small>
                </div>
                <div class="wallet-card wallet-blue">
                    <h4>Total Transactions</h4>
                    <p class="wallet-amount">{{  $totalTransactions }}</p>
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
            </div>

            <!-- Transaction Table -->
            <div class="wallet-table">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Transaction Type</th>
                            <th>Details</th>
                            <th>Refrence Id</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="wallet-tbody">
                        @forelse($transactions as $txn)
                            <tr data-type="{{ strtolower($txn->type) }}"
                                data-transaction-type="{{ strtolower($txn->transaction_type) }}">
                                <td>{{ $txn->created_at->format('Y-m-d') }}</td>
                                <td>{{ ucfirst($txn->type) }}</td>
                                <td>{{ ucfirst($txn->transaction_type) }}</td>
                                <td>{{ $txn->remarks ?? '-' }}</td>
                                <td>{{ $txn->reference_id }}</td>
                                <td>₹{{ number_format($txn->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="wallet-no-data">No transactions found.</td>
                            </tr>
                        @endforelse
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
                    <span class="logo-text">F</span>
                    <span class="wallet-brand">Flippingo</span>
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

    <div class="wallet-modal-overlay" id="withdrawModal">
        <div class="wallet-modal-box">
            <div class="wallet-modal-header" style="background:#fff; color:#000; border-bottom:1px solid #eee;">
                <h3 style="font-size:16px; font-weight:600; display:flex; align-items:center; gap:6px;">
                    ⬇ Select a Payment Method to Withdraw Funds
                </h3>
                <button class="wallet-modal-close" onclick="closeWithdrawModal()" style="color:#000;">×</button>
            </div>

            <div class="wallet-modal-body" style="padding:20px;">
                <!-- Method list -->
                <div id="methodList">
                    <div class="wallet-method-card" onclick="selectMethod('bank')">
                        <div class="wallet-method-icon">🏦</div>
                        <div class="wallet-method-info">
                            <h4>Bank Account</h4>
                        </div>
                        <div class="wallet-arrow">→</div>
                    </div>

                    <div class="wallet-method-card" onclick="selectMethod('upi')">
                        <div class="wallet-method-icon">📱</div>
                        <div class="wallet-method-info">
                            <h4>UPI</h4>
                        </div>
                        <div class="wallet-arrow">→</div>
                    </div>

                    <div class="wallet-method-card" onclick="selectMethod('wire')">
                        <div class="wallet-method-icon">💳</div>
                        <div class="wallet-method-info">
                            <h4>Wire Transfer</h4>
                        </div>
                        <div class="wallet-arrow">→</div>
                    </div>

                    <div class="wallet-method-card" onclick="selectMethod('paypal')">
                        <div class="wallet-method-icon">💰</div>
                        <div class="wallet-method-info">
                            <h4>Paypal</h4>
                        </div>
                        <div class="wallet-arrow">→</div>
                    </div>

                    <button class="wallet-btn" style="margin-top:15px;" onclick="openAddPaymentMethod()">+ Add New Payment
                        Method</button>
                </div>

                <!-- Forms container -->
                <div id="formContainer" style="display:none;">

                    <!-- Bank Form -->
                    <form id="bankForm" style="display:none; margin-top:20px;">
                        <!-- your bank form markup here as provided, add IDs to inputs -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Account Holder Name</label>
                                <input id="bank_holder" name="bank_holder" type="text" class="form-control" placeholder="Full Name"   />
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Account Number</label>
                                <input id="bank_account"  name="bank_account" type="text" class="form-control" placeholder="Account Number"
                                      />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>IFSC Code</label>
                                <input id="bank_ifsc" name="bank_ifsc" type="text" class="form-control" placeholder="IFSC Code" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bank Name</label>
                                <input id="bank_name" name="bank_name" type="text" class="form-control" placeholder="Bank Name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Branch Name</label>
                                <input id="branch_name" name="branch_name" type="text" class="form-control" placeholder="Branch Name" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Account Type</label>
                                <select id="bank_type" name="bank_type" class="form-control">
                                    <option value="">Select Account Type</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Current">Current</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- UPI Form -->
                    <form id="upiForm" style="display:none; margin-top:20px;">
                        <label>UPI ID</label>
                        <input id="upi_id" name="upi_id" type="text" class="wallet-input" placeholder="example@upi"   />
                    </form>

                    <!-- Wire Form -->
                    <form id="wireForm" style="display:none; margin-top:20px;">
                        <label>Account Number</label>
                        <input id="wire_account" name="wire_account"  type="text" placeholder="Enter Account Number"   />
                        <label>Bank Name</label>
                        <input id="wire_bank" name="wire_bank" type="text" placeholder="Enter Bank Name"   />
                        <label>Swift Code</label>
                        <input id="wire_swift" name="wire_swift" type="text" placeholder="Enter Swift Code" />
                        <label>IBAN Number</label>
                        <input id="wire_iban" name="wire_iban"  type="text" placeholder="Enter IBAN Number" />
                    </form>

                    <!-- Paypal Form -->
                    <form id="paypalForm" style="display:none; margin-top:20px;">
                        <label>Paypal Email</label>
                        <input id="paypal_email" name="paypal_email" type="email" placeholder="Enter Paypal Email"   />
                    </form>

                    <label style="margin-top:20px;">Withdraw Amount</label>
                    <input id="withdrawAmount" name='withdrawAmount' type="number" min="100" placeholder="Enter amount ≥ 100"  
                        class="wallet-input" />

                    <div style="margin-top:20px; display:flex; justify-content:space-between;">
                        <button class="wallet-btn wallet-cancel-btn" type="button"
                            onclick="backToMethodList()">Back</button>
                        <button class="wallet-btn" id="continueBtn" type="submit" disabled form="bankForm">Continue</button>
                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection

@push('scripts')

    <script>
        const tabs = document.querySelectorAll(".wallet-tab");
        const rows = document.querySelectorAll("#wallet-tbody tr");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                tabs.forEach(t => t.classList.remove("active"));
                tab.classList.add("active");

                const filter = tab.dataset.filter;

                rows.forEach(row => {
                    const txnType = row.dataset.transactionType.toLowerCase();
                    const type = row.dataset.type.toLowerCase();

                    if (filter === "all") {
                        row.style.display = "";
                    } else if (filter === "deposit") {
                        if (txnType === "money added to wallet" || txnType === "refund") {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    } else if (filter === "withdrawal") {
                        if (txnType === "refund debit" || txnType === "withdrawal") {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    } else if (filter === "purchase") {
                        // Show specific purchase types
                        if (txnType === "purchase subscription" || txnType === "purchase products") {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    } else if (filter === "sale") {
                        // Show sales transactions
                        if (txnType === "product sales") {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    } else {
                        // Fallback for other filters if any
                        row.style.display = txnType === filter ? "" : "none";
                    }
                });
            });
        });


        function openWithdrawModal() {
            document.getElementById("withdrawModal").style.display = "flex";
        }
        function closeWithdrawModal() {
            document.getElementById("withdrawModal").style.display = "none";
        }

        // Example button bind
        document.querySelector(".wallet-withdraw").addEventListener("click", openWithdrawModal);



        document.querySelectorAll('.wallet-quick-select button').forEach(button => {
            button.addEventListener('click', function () {
                const amountText = this.textContent.trim(); // e.g., "₹500"
                const numericAmount = amountText.replace('₹', '').replace(/,/g, '').trim(); // Remove ₹ and commas
                const amountInput = document.querySelector('.wallet-input');
                if (amountInput) {
                    amountInput.value = numericAmount;
                }
            });
        });

        function openWalletModal() {
            document.getElementById("walletModal").style.display = "flex";
        }
        function closeWalletModal() {
            document.getElementById("walletModal").style.display = "none";
        }

        // Bind button click (example)
        document.querySelector(".wallet-add").addEventListener("click", openWalletModal);

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector('.wallet-proceed-btn').addEventListener('click', function () {
                const amountInput = document.querySelector('.wallet-input');
                const amount = parseFloat(amountInput.value);

                if (!amount || amount <= 0) {
                    Swal.fire('Error', 'Please enter a valid amount.', 'error');
                    return;
                }

                const options = {
                    key: "{{ config('services.razorpay.key') }}",
                    amount: amount * 100, // amount in paise
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
                                    closeWalletModal();
                                    Swal.fire('Success', 'Wallet funded successfully.', 'success').then(() => location.reload());
                                } else {
                                    Swal.fire('Error', data.message || 'Funding failed.', 'error');
                                }
                            }).catch(() => {
                                Swal.fire('Error', 'Server error occurred.', 'error');
                            });
                    },
                    prefill: {
                        name: "{{ auth()->user()->name }}",
                        email: "{{ auth()->user()->email }}",
                        contact: "{{ auth()->user()->phone ?? '' }}"
                    },
                    theme: { color: "#2979ff" }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            });

        });
    </script>

    <script>

        let paymentMethods = @json($methods);
        let selectedMethod = null;

        function selectMethod(type) {
            selectedMethod = type;

            // Hide method list, show form container
            document.getElementById('methodList').style.display = 'none';
            document.getElementById('formContainer').style.display = 'block';

            // Hide all forms first
            ['bankForm', 'upiForm', 'wireForm', 'paypalForm'].forEach(id => {
                document.getElementById(id).style.display = 'none';
            });

            // Show the selected form
            document.getElementById(`${type}Form`).style.display = 'block';

            // Prefill with saved data
            let data = paymentMethods.find(m => m.type === type) || {};

            if (type === 'bank') {
                document.getElementById('bank_holder').value = data.account_holder_name || '';
                document.getElementById('bank_account').value = data.account_number || '';
                document.getElementById('bank_ifsc').value = data.ifsc_code || '';
                document.getElementById('bank_name').value = data.bank_name || '';
                document.getElementById('bank_branch').value = data.branch_name || '';
                document.getElementById('bank_type').value = data.account_type || '';
            } else if (type === 'upi') {
                document.getElementById('upi_id').value = data.upi_id || '';
            } else if (type === 'wire') {
                document.getElementById('wire_account').value = data.account_number || '';
                document.getElementById('wire_bank').value = data.bank_name || '';
                document.getElementById('wire_swift').value = data.swift_code || '';
                document.getElementById('wire_iban').value = data.iban_number || '';
            } else if (type === 'paypal') {
                document.getElementById('paypal_email').value = data.paypal_email || '';
            }

            // Reset amount and disable continue button
            const amountInput = document.getElementById('withdrawAmount');
            amountInput.value = '';
            document.getElementById('continueBtn').disabled = true;

            // Enable continue button on valid amount input
            amountInput.oninput = function () {
                document.getElementById('continueBtn').disabled = !(parseFloat(this.value) >= 100);
            };
        }

        function backToMethodList() {
            selectedMethod = null;
            document.getElementById('methodList').style.display = 'block';
            document.getElementById('formContainer').style.display = 'none';

            // Hide all forms
            ['bankForm', 'upiForm', 'wireForm', 'paypalForm'].forEach(id => {
                document.getElementById(id).style.display = 'none';
            });

            document.getElementById('withdrawAmount').value = '';
            document.getElementById('continueBtn').disabled = true;
        }

        function closeWithdrawModal() {
            backToMethodList();
            document.getElementById('withdrawAmount').value = '';
            document.getElementById('withdrawModal').style.display = 'none';
        }

        document.querySelector(".wallet-withdraw").addEventListener("click", () => {
            document.getElementById('withdrawModal').style.display = 'flex';
        });

        document.getElementById('bankForm').addEventListener('submit', submitWithdraw);
        document.getElementById('upiForm').addEventListener('submit', submitWithdraw);
        document.getElementById('wireForm').addEventListener('submit', submitWithdraw);
        document.getElementById('paypalForm').addEventListener('submit', submitWithdraw);

        function submitWithdraw(evt) {
            evt.preventDefault();

            if (!selectedMethod) {
                alert('Please select a payment method');
                return;
            }

            const amount = parseFloat(document.getElementById('withdrawAmount').value);
            if (!amount || amount < 100) {
                alert('Enter valid amount ≥ 100');
                return;
            }

            let data = { method: selectedMethod, amount };

            if (selectedMethod === 'bank') {
                data.account_holder_name = document.getElementById('bank_holder').value.trim();
                data.account_number = document.getElementById('bank_account').value.trim();
                data.ifsc_code = document.getElementById('bank_ifsc').value.trim();
                data.bank_name = document.getElementById('bank_name').value.trim();
                data.account_type = document.getElementById('bank_type').value;
            } else if (selectedMethod === 'upi') {
                data.upi_id = document.getElementById('upi_id').value.trim();
            } else if (selectedMethod === 'wire') {
                data.account_number = document.getElementById('wire_account').value.trim();
                data.bank_name = document.getElementById('wire_bank').value.trim();
                data.swift_code = document.getElementById('wire_swift').value.trim();
                data.iban_number = document.getElementById('wire_iban').value.trim();
            } else if (selectedMethod === 'paypal') {
                data.paypal_email = document.getElementById('paypal_email').value.trim();
            }

            fetch('{{ Route('wallet.withdraw.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        Swal.fire('Success', 'Withdrawal requested successfully!', 'success');
                        closeWithdrawModal();
                        location.reload();
                    } else {
                        closeWithdrawModal();
                        Swal.fire('Error', response.message || 'Failed to submit withdrawal request', 'error');
                    }
                })
                .catch(() => Swal.fire('Error', 'Server Error', 'error'));
        }
    </script>

    </script>
@endpush