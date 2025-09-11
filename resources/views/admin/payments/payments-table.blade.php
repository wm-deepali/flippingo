<div class="table-responsive">
    <table class="table table-bordered" id="payments-table">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order Type</th>
                <th>Order ID</th>
                <th>Invoice Number</th>
                <th>Seller Info</th>
                <th>Buyer Info</th>
                <th>Paid Amount</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                @php
                    // Determine order type. Example: check related models existence or a type field
                    $orderType = $payment->subscription_id ? 'Subscription Order' : 'Product Order';
                    // Seller info and Buyer info based on order type
                    $seller = $orderType == 'Subscription Order' ? $payment->subscription->customer ?? null : $payment->product->seller ?? null;
                    $buyer = $orderType == 'Product Order' ? $payment->product->customer ?? null : null;
                    $invoice = $orderType == 'Subscription Order' ?  $payment->subscription->invoice : $payment->product->invoice;
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('Y-m-d H:i') }}</td>
                    <td>{{ $orderType }}</td>
                    <td>{{ $orderType == 'Subscription Order' ? ($payment->subscription->order_number ?? '-') : ($payment->product->order_number ?? '-') }}
                    </td>
                    <td>{{ $invoice->invoice_number ?? '-' }}</td>
                    <td>
                        @if($seller)
                            {{ $seller->first_name ?? '-' }} {{ $seller->last_name ?? '' }}<br>
                            {{ $seller->email ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($buyer)
                            {{ $buyer->first_name ?? '-' }} {{ $buyer->last_name ?? '' }}<br>
                            {{ $buyer->email ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ ucfirst($payment->gateway) }}</td>
                    <td>
                        @if($payment->status === 'success')
                            <span class="badge badge-success">Paid</span>
                        @elseif($payment->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($payment->status === 'cancelled')
                            <span class="badge badge-danger">Cancelled</span>
                        @else
                            <span class="badge badge-danger">Failed</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.invoice', ['type' => $payment->subscription_id ? 'subscription' : 'product', 'id' => $payment->subscription_id ?? $payment->product_order_id]) }}"
                            target="_blank" class="btn btn-sm btn-primary">
                            View Invoice
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>