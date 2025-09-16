<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Buyer Info</th>
                <th>Seller Info</th>
                <th>Product Cost</th>
                <th>Order Status</th>
          
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
              @php $status = $order->currentStatus->status ?? 'N/A'; @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                    <td>{{ $order->order_number }}</td>
                    
                    <!-- Buyer Info -->
                    <td>
                         ID: {{ $order->customer->customer_id ?? '-' }}<br>
                        {{ $order->customer->first_name ?? '-' }} {{ $order->customer->last_name ?? '-' }}<br>
                        {{ $order->customer->email ?? '-' }}
                    </td>

                    <!-- Seller Info -->
                    <td>
                         ID: {{ $order->seller->customer_id ?? '-' }}<br>
                        {{ $order->seller->first_name ?? '-' }} {{ $order->seller->last_name ?? '-' }}<br>
                        {{ $order->seller->email ?? '-' }}
                    </td>

                    <!-- Product Cost -->
                    <td>{{ $order->total ?? '-' }}</td>

                  
                    <!-- Order Status -->
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

           

                    <!-- Action Buttons -->
                    <td>
                        <a href="{{ route('admin.product-orders.show', $order->id) }}" class="btn btn-sm btn-secondary">
                            View Order Detail
                        </a>

                        <a href="{{ route('admin.customers.show',$order->customer->id) }}" target="_blank" class="btn btn-sm btn-info">
                            View Seller Info
                        </a>

                        <a href="{{ route('admin.customers.show',  $order->seller_id) }}" target="_blank" class="btn btn-sm btn-primary">
                            View Customer Info
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>