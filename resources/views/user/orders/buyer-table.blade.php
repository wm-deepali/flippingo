<div class="table-wrapper">
    <table class="order-table">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Product Detail</th>
                <th>Billed Amount</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                @php $status = $order->currentStatus->status ?? 'N/A'; @endphp
                <tr>
                    <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                    <td>#{{ $order->order_number }}</td>
                    <td>
                        <span class="product-name">{{ $order->product_title }}</span><br>
                        <small>{{ $order->category_name }}</small><br>
                        @if ($order->product_photo)
                            <img src="{{ asset('storage/' . $order->product_photo) }}" alt="Product Photo" width="50">
                        @endif
                    </td>
                    <td>₹{{ $order->total }}</td>
                    <td>{{ ucfirst($order->payment->status) }}</td>
                    <td>
   @switch($status)
                            @case('recent')
                                <span class="badge badge-primary">Recent</span>
                                @break
                            @case('approved')
                                <span class="badge badge-secondary">Approved</span>
                                @break
                            @case('processing')
                                <span class="badge badge-info">Processing</span>
                                @break
                            @case('delivered')
                                <span class="badge badge-success">Delivered</span>
                                @break
                            @case('cancel_requested')
                                <span class="badge badge-warning">Cancel Requested</span>
                                @break
                            @case('cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                                @break
                            @default
                                <span class="badge badge-light">{{ ucfirst($status) }}</span>
                        @endswitch
                    </td>
                    <td class="actions">
                       <a href="{{ route('orders.detail', $order->id) }}">
    <i class="fas fa-eye" title="View Order Detail"></i>
</a>

<a href="{{ route('orders.invoice', $order->id) }}">
    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
</a>

                          @if(in_array($status, ['recent', 'approved', 'processing']))
                          <a class="action-btn cancel-order-btn" data-order-id="{{ $order->id }}">
                                 <i class="fas fa-undo" title="Cancel Order"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>