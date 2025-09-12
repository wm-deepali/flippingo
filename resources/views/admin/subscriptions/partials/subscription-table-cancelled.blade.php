<div class="table-responsive">
    <table class="table table-bordered" id="orders-table-inactive">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Seller Info</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Subscription Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $sub)
                @if($sub->status == 'cancelled')
                    <div class="modal fade" id="refundModal{{ $sub->id }}" tabindex="-1"
                        aria-labelledby="refundModalLabel{{ $sub->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="refundModalLabel{{ $sub->id }}">
                                        Refund Details for Order #ORD{{ $sub->id }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    @if($sub->refund)
                                        <p><strong>Refund
                                                Method:</strong>
                                            {{ ucfirst($sub->refund->refund_method) }}
                                        </p>
                                        <p><strong>Refund
                                                Amount:</strong>
                                            {{ $sub->refund->amount }}
                                        </p>
                                        @if($sub->refund->payment_date)
                                            <p><strong>Payment
                                                    Date:</strong>
                                                {{ \Carbon\Carbon::parse($sub->refund->payment_date)->format('Y-m-d') }}
                                            </p>
                                        @endif
                                        @if($sub->refund->reference_id)
                                            <p><strong>Reference
                                                    ID:</strong>
                                                {{ $sub->refund->reference_id }}
                                            </p>
                                        @endif
                                        @if($sub->refund->remarks)
                                            <p><strong>Remarks:</strong>
                                                {{ $sub->refund->remarks }}
                                            </p>
                                        @endif
                                        @if($sub->refund->screenshot)
                                            <p><strong>Screenshot:</strong>
                                                <a href="{{ asset('storage/' . $sub->refund->screenshot) }}" target="_blank"
                                                    rel="noopener noreferrer">View
                                                    Image</a>
                                            </p>
                                        @endif
                                    @else
                                        <p>No refund details
                                            available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($sub->created_at)->format('Y-m-d H:i') }}
                        </td>
                        <td>{{ $sub->order_number }}</td>
                        <td>
                            ID:
                            {{ $sub->customer->customer_id ?? '-' }}<br>
                            {{ $sub->customer->first_name ?? '-' }}
                            {{ $sub->customer->last_name ?? '-' }}<br>
                            {{ $sub->customer->email ?? '-' }}
                        </td>
                        <td>{{ $sub->refund->refund_method === 'source_account' ? $sub->refund->reference_id : '-' }}
                        </td>
                        <td>{{ ucfirst($sub->refund->refund_method ?? '-') }}
                        </td>
                        <td>
                            @if($sub->refund)
                                <span class="badge badge-success">Paid</span>
                            @else
                                <span class="badge badge-danger">Failed</span>
                            @endif
                        </td>
                        <td><span class="badge badge-danger">Cancelled</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#refundModal{{ $sub->id }}">
                                View Refund Detail
                            </button>


                            <a href="{{ route('admin.subscriptions.show', $sub->id) }}"
                                class="btn btn-sm btn-secondary">
                                View Order Detail
                            </a>
                            <a href="{{ route('admin.customers.show', $sub->customer->id) }}" target="_blank"
                                class="btn btn-sm btn-info">
                                View Seller Detail
                            </a>
                            <a href="{{ route('admin.orders.invoice', ['type' => 'subscription', 'id' => $sub->id]) }}"
                                target="_blank" class="btn btn-sm btn-primary">
                                View Invoice
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>