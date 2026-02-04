@extends('layouts.master')

@section('title', 'Subscription Cancellation Requests')

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
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Cancellation Requests</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Orders Cancellation Requests</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="cancel-requests-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Order ID</th>
                                                <th>Buyer Info</th>
                                                <th>Seller Info</th>
                                                <th>Product Detail</th>
                                                <th>Product Cost</th>
                                                <th>Cancel Reason</th>
                                                <th>Requested At</th>
                                                <th>Requested By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                                @php $currentStatus = $order->currentStatus ?? 'N/A'; @endphp
                                                <tr id="sub-row-{{ $order->id }}">
                                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}
                                                    </td>
                                                    <td>{{ $order->order_number }}</td>
                                                    <!-- Buyer Info -->
                                                    <td>
                                                        ID: {{ $order->customer->customer_id ?? '-' }}<br>
                                                        {{ $order->customer->first_name ?? '-' }}
                                                        {{ $order->customer->last_name ?? '-' }}<br>
                                                        {{ $order->customer->email ?? '-' }}
                                                    </td>

                                                    <!-- Seller Info -->
                                                    <td>
                                                        ID: {{ $order->seller->customer_id ?? '-' }}<br>
                                                        {{ $order->seller->first_name ?? '-' }}
                                                        {{ $order->seller->last_name ?? '-' }}<br>
                                                        {{ $order->seller->email ?? '-' }}
                                                    </td>
                                                    <td>
                                                        <span class="product-name">{{ $order->product_title }}</span><br>
                                                        <small>{{ $order->category_name }}</small><br>
                                                        @if ($order->product_photo)
                                                            <img src="{{ asset('storage/' . $order->product_photo) }}"
                                                                alt="Product Photo" width="50">
                                                        @endif
                                                    </td>
                                                    <!-- Product Cost -->
                                                    <td>₹{{ $order->total ?? '-' }}</td>

                                                    <!-- Cancel Reason -->
                                                    <td>
                                                        @if($currentStatus)
                                                            <strong>{{ $currentStatus->cancellation_reason }}</strong>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>

                                                     <!-- Requested At -->
        <td>
            @if($currentStatus)
                {{ \Carbon\Carbon::parse($currentStatus->requested_at)->format('Y-m-d H:i') }}
            @else
                -
            @endif
        </td>

          <td>
            @if($currentStatus)
                @php 
                    $requestedBy = \App\Models\Customer::find($currentStatus->requested_by); 
                @endphp
                {{ $requestedBy->first_name ?? '-' }} {{ $requestedBy->last_name ?? '-' }}<br>
                (ID: {{ $requestedBy->customer_id ?? $currentStatus->requested_by }})
            @else
                -
            @endif
        </td>

                                                    <td>
                                                        @if($currentStatus->status === 'cancel_requested')
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                onclick="openRefundModal({{ $order->id }})">Approve</button>
                                                            <form
                                                                action="{{ route('admin.product-orders.rejectCancellation', $order->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Refund Modal -->
    <div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="refundModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="refundForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="subscription_id" id="subscription_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="refundModalLabel">Process Refund</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Refund Method</label>
                            <select name="refund_method" id="refund_method" class="form-control"
                                onchange="toggleRefundFields()">
                                <option value="">Select Refund Method</option>
                                <option value="source_account">Process Refund to Source Account</option>
                                <option value="wallet">Process Refund to User Wallet</option>
                            </select>
                        </div>

                        <div id="sourceAccountFields" style="display:none;">
                            <div class="form-group">
                                <label>Payment Date</label>
                                <input type="date" name="payment_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Reference ID</label>
                                <input type="text" name="reference_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea name="remarks" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload Screenshot</label>
                                <input type="file" name="screenshot" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitRefund()">Submit Refund &
                            Approve</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        let currentSubId = null;

        function openRefundModal(subId) {
            currentSubId = subId;
            document.getElementById('subscription_id').value = subId;
            document.getElementById('refund_method').value = '';
            document.getElementById('sourceAccountFields').style.display = 'none';
            $('#refundModal').modal('show');
        }

        function toggleRefundFields() {
            const method = document.getElementById('refund_method').value;
            const sourceFields = document.getElementById('sourceAccountFields');
            sourceFields.style.display = method === 'source_account' ? 'block' : 'none';
        }

        function submitRefund() {
            const form = document.getElementById('refundForm');
            const formData = new FormData(form);

            fetch("{{ route('admin.product-orders.approveCancellation', ['subscription' => 'SUB_ID']) }}".replace('SUB_ID', currentSubId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token')
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Approved!',
                            'Refund processed and request approved.',
                            'success'
                        );
                        $('#refundModal').modal('hide');
                        const row = document.getElementById('sub-row-' + currentSubId);
                        row.querySelector('td:nth-child(5) span').innerText = 'Cancelled';
                        row.querySelector('td:nth-child(5) span').className = 'badge badge-secondary';
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Something went wrong!', 'error');
                });
        }
    </script>
@endpush