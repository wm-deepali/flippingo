<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Subscription Name</th>
                <th>Seller Info</th>
                <th>Listing</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $sub)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($sub->created_at)->format('d M Y H:i') }}</td>
                    <td>#{{ $sub->order_number }}</td>
                    <td>{{ $sub->package->name ?? 'N/A' }}</td>
                    <td>
                        Seller ID: {{ $sub->customer->id ?? '-' }}<br>
                        {{ $sub->customer->first_name ?? '-' }}
                        {{ $sub->customer->last_name ?? '-' }}<br>
                        {{ $sub->customer->email ?? '-' }}
                    </td>
                    <td>{{ $sub->listings_count ?? 0 }}</td>
                    <td>{{ \Carbon\Carbon::parse($sub->end_date)->format('d M Y') }}</td>
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
                        <a href="{{ route('admin.subscriptions.show', $sub->id) }}" class="btn btn-primary btn-sm">View 
                            Order Details</a>
                        <a href="#" class="btn btn-info btn-sm">View Ads</a>
                        <a href="{{ route('admin.customers.view', $sub->customer_id) }}"
                            class="btn btn-secondary btn-sm">View Seller Details</a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>