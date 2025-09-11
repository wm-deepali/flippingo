<div class="table-responsive">
    <table class="table table-bordered" id="orders-table-active">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Buyer Info</th>
                <th>Seller Info</th>
                <th>Product Cost</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
                <th>Order Status</th>

                {{-- Delivered-specific columns --}}
                @if($orders->first()?->currentStatus->status === 'delivered')
                    <th>Delivery Date</th>
                    <th>Delivery Method</th>
                @endif

                {{-- Cancelled-specific columns --}}
                @if($orders->first()?->currentStatus->status === 'cancelled')
                    <th>Cancelled By</th>
                    <th>Cancellation Reason</th>
                    <th>Cancellation Date</th>
                @endif

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
                        Buyer ID: {{ $order->customer->id ?? '-' }}<br>
                        {{ $order->customer->first_name ?? '-' }} {{ $order->customer->last_name ?? '-' }}<br>
                        {{ $order->customer->email ?? '-' }}
                    </td>

                    <!-- Seller Info -->
                    <td>
                        Seller ID: {{ $order->seller->id ?? '-' }}<br>
                        {{ $order->seller->first_name ?? '-' }} {{ $order->seller->last_name ?? '-' }}<br>
                        {{ $order->seller->email ?? '-' }}
                    </td>

                    <!-- Product Cost -->
                    <td>{{ $order->total ?? '-' }}</td>

                    <!-- Transaction ID -->
                    <td>{{ $order->payment->payment_id ?? '-' }}</td>

                    <!-- Payment Method -->
                    <td>{{ ucfirst($order->payment->gateway ?? '-') }}</td>

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

                    {{-- Delivered-specific columns --}}
                    @if($status === 'delivered')
                        <td>{{ $order->currentStatus->delivery_date ?? '-' }}</td>
                        <td>{{ $order->currentStatus->delivery_method ?? '-' }}</td>
                    @endif

                    {{-- Cancelled-specific columns --}}
                   {{-- Cancelled-specific columns --}}
@if($status === 'cancelled')
    <td>
        @php
            $cancelledById = $order->currentStatus->cancelled_by ?? null;
            $cancelledByName = '-';
        @endphp

        @if($cancelledById)
            @if($cancelledById == $order->seller_id)
                {{ $order->seller->first_name ?? '-' }} {{ $order->customer->last_name ?? '' }}
            @else
                {{-- assume it's admin --}}
                {{ \App\Models\User::find($cancelledById)->name ?? 'Admin' }}
            @endif
        @endif
    </td>
    <td>{{ $order->currentStatus->cancellation_reason ?? '-' }}</td>
    <td>{{ \Carbon\Carbon::parse($order->currentStatus->cancelled_at ?? $order->currentStatus->updated_at)->format('Y-m-d') }}</td>
@endif


                    <!-- Action Buttons -->
                    <td>
                        <a href="{{ route('admin.product-orders.show', $order->id) }}" class="btn btn-sm btn-secondary">
                            View Order Detail
                        </a>

                        <a href="{{ route('admin.customers.view', ['id' => $order->customer->id]) }}" target="_blank" class="btn btn-sm btn-info">
                            View Seller Info
                        </a>

                        <a href="{{ route('admin.customers.view', ['id' => $order->seller_id]) }}" target="_blank" class="btn btn-sm btn-primary">
                            View Customer Info
                        </a>

                          <a href="{{ route('admin.product-orders.invoice', ['id' => $order->id]) }}" target="_blank" class="btn btn-sm btn-primary">
                            View Invoice
                        </a>

                        <button class="btn btn-sm btn-warning changeStatusBtn"
                            data-id="{{ $order->id }}"
                            data-status="{{ $order->currentStatus->status ?? '' }}"
                            data-remarks="{{ $order->currentStatus->remarks ?? '' }}"
                            data-delivery-date="{{ $order->currentStatus->delivery_date ?? '' }}"
                            data-delivery-method="{{ $order->currentStatus->delivery_method ?? '' }}"
                            data-cancellation-reason="{{ $order->currentStatus->cancellation_reason ?? '' }}">
                            Change Order Status
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
