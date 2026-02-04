<div class="table-responsive">
    @php
        $hasDelivered = $orders->contains(fn($o) => optional($o->currentStatus)->status === 'delivered');
        $hasCancelled = $orders->contains(fn($o) => optional($o->currentStatus)->status === 'cancelled');
    @endphp

    <table class="table table-bordered" id="orders-table-active">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Buyer Info</th>
                <th>Seller Info</th>
                <th>Product Detail</th>
                <th>Product Cost</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
                <th>Order Status</th>

                @if($hasDelivered)
                    <th>Delivery Date</th>
                    <th>Delivery Method</th>
                @endif

                @if($hasCancelled)
                    <th>Cancelled By</th>
                    <th>Cancellation Reason</th>
                    <th>Cancellation Date</th>
                @endif

                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
                @php
                    $status = optional($order->currentStatus)->status ?? 'N/A';
                @endphp

                <tr>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>

                    <td>{{ $order->order_number }}</td>

                    {{-- Buyer Info --}}
                    <td>
                        ID: {{ $order->customer->customer_id ?? '-' }}<br>
                        {{ $order->customer->first_name ?? '-' }} {{ $order->customer->last_name ?? '-' }}<br>
                        {{ $order->customer->email ?? '-' }}
                    </td>

                    {{-- Seller Info --}}
                    <td>
                        ID: {{ $order->seller->customer_id ?? '-' }}<br>
                        {{ $order->seller->first_name ?? '-' }} {{ $order->seller->last_name ?? '-' }}<br>
                        {{ $order->seller->email ?? '-' }}
                    </td>

                    {{-- Product --}}
                    <td>
                        <span class="product-name">{{ $order->product_title }}</span><br>
                        <small>{{ $order->category_name }}</small><br>
                        @if($order->product_photo)
                            <img src="{{ asset('storage/'.$order->product_photo) }}" width="50">
                        @endif
                    </td>

                    {{-- Cost (Admin = INR) --}}
                    <td>₹{{ number_format($order->total ?? 0, 2) }}</td>

                    {{-- Transaction --}}
                    <td>{{ optional($order->payment)->payment_id ?? '-' }}</td>

                    {{-- Payment Method --}}
                    <td>
                        {{ optional($order->payment)->gateway
                            ? ucfirst(optional($order->payment)->gateway)
                            : '-' }}
                    </td>

                    {{-- Status --}}
                    <td>
                        @switch($status)
                            @case('recent') <span class="badge badge-primary">Recent</span> @break
                            @case('approved') <span class="badge badge-secondary">Approved</span> @break
                            @case('processing') <span class="badge badge-info">Processing</span> @break
                            @case('delivered') <span class="badge badge-success">Delivered</span> @break
                            @case('cancel_requested') <span class="badge badge-warning">Cancel Requested</span> @break
                            @case('cancelled') <span class="badge badge-danger">Cancelled</span> @break
                            @default <span class="badge badge-light">{{ ucfirst($status) }}</span>
                        @endswitch
                    </td>

                    {{-- Delivered Columns --}}
                    @if($hasDelivered)
                        <td>{{ $status === 'delivered' ? optional($order->currentStatus)->delivery_date : '-' }}</td>
                        <td>{{ $status === 'delivered' ? optional($order->currentStatus)->delivery_method : '-' }}</td>
                    @endif

                    {{-- Cancelled Columns --}}
                    @if($hasCancelled)
                        <td>
                            @if($status === 'cancelled')
                                @php $cancelledBy = optional($order->currentStatus)->cancelled_by; @endphp

                                @if($cancelledBy == $order->seller_id)
                                    {{ $order->seller->first_name ?? '-' }} {{ $order->seller->last_name ?? '' }}
                                @else
                                    {{ optional(\App\Models\User::find($cancelledBy))->name ?? 'Admin' }}
                                @endif
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $status === 'cancelled' ? optional($order->currentStatus)->cancellation_reason : '-' }}</td>

                        <td>
                            {{ $status === 'cancelled'
                                ? \Carbon\Carbon::parse(
                                    optional($order->currentStatus)->cancelled_at
                                    ?? optional($order->currentStatus)->updated_at
                                  )->format('Y-m-d')
                                : '-' }}
                        </td>
                    @endif

                    {{-- Actions --}}
                    <td>
                        <a href="{{ route('admin.product-orders.show', $order->id) }}"
                           class="btn btn-sm btn-secondary">View Order</a>

                        <a href="{{ route('admin.customers.show', $order->seller_id) }}"
                           class="btn btn-sm btn-info" target="_blank">Seller</a>

                        <a href="{{ route('admin.customers.show', $order->customer_id) }}"
                           class="btn btn-sm btn-primary" target="_blank">Buyer</a>

                        <a href="{{ route('admin.product-orders.invoice', $order->id) }}"
                           class="btn btn-sm btn-dark" target="_blank">Invoice</a>

                        <button class="btn btn-sm btn-warning changeStatusBtn"
                            data-id="{{ $order->id }}"
                            data-status="{{ optional($order->currentStatus)->status }}"
                            data-remarks="{{ optional($order->currentStatus)->remarks }}"
                            data-delivery-date="{{ optional($order->currentStatus)->delivery_date }}"
                            data-delivery-method="{{ optional($order->currentStatus)->delivery_method }}"
                            data-cancellation-reason="{{ optional($order->currentStatus)->cancellation_reason }}">
                            Change Status
                        </button>

                        <button class="btn btn-sm btn-danger deleteOrderBtn"
                            data-id="{{ $order->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $orders->links() }}
