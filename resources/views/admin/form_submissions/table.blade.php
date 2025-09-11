<div class="table-responsive">
    <table class="table table-bordered" id="orders-table-active">
        <thead>
            <tr>
                <th>Submitted At</th>
                <th>Category</th>
                <th>Seller Info</th>
                <th>Submission ID</th>
                <th>Title</th>
                <th>Product Cost</th>
                <th>Total Sales</th>
                <th>Expiry Date</th>
                
                <th>Status</th>
                {{-- Rejected-specific columns --}}
@if($submissions->first()?->status === 'rejected')
    <th>Remarks</th>
@endif
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $submission)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($submission->created_at)->format('Y-m-d H:i') }}</td>
                       <td>{{ $submission['category_name'] }}</td>
                    <!-- Seller Info -->
                    <td>
                        Seller ID: {{ $submission->customer->id ?? '-' }}<br>
                        {{ $submission->customer->first_name ?? '-' }} {{ $submission->customer->last_name ?? '-' }}<br>
                        {{ $submission->customer->email ?? '-' }}
                    </td>

  <td>{{ $submission->id}}</td>
                <td>{{ $submission->product_title }}</td>
                <td>{{ number_format($submission->offered_price, 2) }}</td>
               <td>{{ $submission->total_sales }}</td>

                   <td>{{ \Carbon\Carbon::parse($submission->expires_at)->format('Y-m-d H:i') }}</td>

                    <!-- Order Status -->
                    <td>
                        @switch($submission->status)
                            @case('pending')
                                <span class="badge badge-secondary">Recent</span>
                                @break
                            @case('published')
                                <span class="badge badge-success">Published</span>
                                @break
                            @case('expired')
                                <span class="badge badge-warning">Expired</span>
                                @break
                            @case('rejected')
                                <span class="badge badge-danger">Rejected</span>
                                @break
                            @default
                                <span class="badge badge-light">{{ ucfirst($submission->status) }}</span>
                        @endswitch
                    </td>

                {{-- Rejected-specific columns --}}
@if($submission->status === 'rejected')
    <td>{{ $submission->currentStatus->remarks ?? '-' }}</td>
@endif

                    <!-- Action Buttons -->
                    <td>
                        <a href="{{ route('admin.form-submissions.show', $submission->id) }}" class="btn btn-sm btn-secondary">
                            View Listing Detail
                        </a>
                         <button class="btn btn-sm btn-warning changeStatusBtn"
                          data-id="{{ $submission->id }}"
                            data-status="{{ $submission->status ?? '' }}"
                             >
                            Change Status
                        </button>
                        <a href="{{ route('admin.customers.view', ['id' => $submission->customer->id ?? '']) }}" target="_blank" class="btn btn-sm btn-info">
                            View Seller Info
                        </a>
                        <a href="#" target="_blank" class="btn btn-sm btn-primary">
                            Edit Listing
                        </a>
                          <a href="{{ route('admin.form-submissions.sales',$submission->id ) }}" target="_blank" class="btn btn-sm btn-primary">
                           View All Sales
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
