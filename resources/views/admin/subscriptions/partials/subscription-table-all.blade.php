<div class="table-responsive">
    <table class="table table-bordered" id="orders-table-active">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Seller Info</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Subscription Status</th>
                <th>Subscription Expiry</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $sub)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($sub->created_at)->format('Y-m-d H:i') }}
                    </td>
                    <td>{{ $sub->order_number }}</td>
                    <td>
                        ID: {{ $sub->customer->customer_id ?? '-' }}<br>
                        {{ $sub->customer->first_name ?? '-' }}
                        {{ $sub->customer->last_name ?? '-' }}<br>
                        {{ $sub->customer->email ?? '-' }}
                    </td>
                    <td>{{ $sub->payment->payment_id ?? '-' }}</td>
                    <td>{{ ucfirst($sub->payment->gateway ?? '-') }}</td>
                    <td>
                        @if($sub->payment->status === 'success')
                            <span class="badge badge-success">Paid</span>
                        @elseif($sub->payment->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">Failed</span>
                        @endif
                    </td>
                    <td>
    @switch($sub->status)
        @case('active')
            <span class="badge badge-primary">Active</span>
            @break
        @case('expired')
            <span class="badge badge-secondary">Expired</span>
            @break
        @case('cancel_requested')
            <span class="badge badge-warning">Cancel Requested</span>
            @break
        @case('cancelled')
            <span class="badge badge-danger">Cancelled</span>
            @break
        @default
            <span class="badge badge-light">{{ ucfirst($sub->status) }}</span>
    @endswitch
</td>

                    <td>{{ \Carbon\Carbon::parse($sub->end_date)->format('Y-m-d') }}
                    </td>
                    <td>
                       <a href="{{ route('admin.subscriptions.show', $sub->id) }}"
                                class="btn btn-sm btn-secondary">
                                View Order Detail
                            </a>
                             <a href="{{ route('admin.customers.show', $sub->customer->id ) }}"
                            target="_blank" class="btn btn-sm btn-info">
                            View Seller Detail
                        </a>
                          <a href="{{ route('admin.orders.invoice', ['type' => 'subscription' , 'id' => $sub->id ]) }}"
                            target="_blank" class="btn btn-sm btn-primary">
                            View Invoice
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>