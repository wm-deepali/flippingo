@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Orders' }}
@endsection

@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="order-invoice">
            <!-- Order Tabs -->

            <div class="order-tabs">
                <div class="order-card recent">
                    <h4>Total Enquiries</h4>
                    <p>{{ $totalEnquiries ?? '0' }}</p>
                </div>
                <div class="order-card active">
                    <h4>Total Customers</h4>
                    <p>{{ $totalCustomers ?? '0' }}</p>
                </div>
            </div>

            <div class="filters mb-3 d-flex justify-content-between align-items-center">
                <!-- Filters -->
                <form method="GET" action="{{ route('dashboard.enquiries') }}" class="d-flex gap-3 flex-wrap">

                    <!-- Business Category -->
                    <select name="business_category" class="form-control">
                        <option value="">All Business Categories</option>
                        @foreach($businessCategories as $cat)
                            <option value="{{ $cat->id }}" {{ request('business_category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Listings -->
                    <select name="submission_id" class="form-control">
                        <option value="">All Listings</option>
                        @foreach($submissionsList as $listing)
                            <option value="{{ $listing->id }}" {{ request('submission_id') == $listing->id ? 'selected' : '' }}>
                                {{ $listing->product_title ?? 'Listing #' . $listing->id }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Date Range -->
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">

                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('dashboard.enquiries') }}" class="btn btn-secondary">Reset</a>
                </form>

                <!-- Sorting -->
                <form method="GET" action="{{ route('dashboard.enquiries') }}">
                    <select name="sort" class="form-control" onchange="this.form.submit()">
                        <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Recent First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </form>
            </div>


            <div class="table-wrapper">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Enquiry ID</th>
                            <th>Buyer Info</th>
                            <th>Product Info</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enquiries as $enquiry)
                            <tr>
                                <td>{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>
                                <td>#{{ $enquiry->id }}</td>
                                <td>
                                    ID: {{ $enquiry->customer->customer_id ?? '-' }}<br>
                                    {{ $enquiry->customer->first_name ?? '-' }} {{ $enquiry->customer->last_name ?? '-' }}<br>
                                    {{ $enquiry->customer->email ?? '-' }}
                                </td>
                                <td>
                                    <span class="product-name">{{ $enquiry->submission->product_title ?? '' }}</span><br>
                                    <small>{{ $enquiry->submission->category_name }}</small><br>
                                    @if ($enquiry->submission->product_photo)
                                        <img src="{{ asset('storage/' . $enquiry->submission->product_photo) }}" alt="Product Photo"
                                            width="50">
                                    @endif
                                </td>
                                <td>{{ Str::limit($enquiry->message, 100) }}</td>
                                <td>
                                    @if($enquiry->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($enquiry->status == 'completed')
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($enquiry->status) }}</span>
                                    @endif
                                </td>

                                <td class="actions">
                                    <a href="{{ route('listing.show', $enquiry->submission->id) }}">
                                        <i class="fas fa-eye" title="View Product"></i>
                                    </a>

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

        </div>

        <!-- Font Awesome -->

        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>


    <!-- Cancel Order Modal -->
    <div id="cancelOrderModal" class="modal" style="display:none;">
        <div class="modal-content"
            style="padding:20px; border-radius:8px; width:400px; background:#fff; margin:auto; margin-top:100px;">
            <h4>Cancel Order</h4>
            <form id="cancelOrderForm">
                @csrf
                <input type="hidden" name="order_id" id="cancelOrderId">

                <div class="form-group">
                    <label>Reason</label>
                    <select name="reason" class="form-control" required>
                        <option value="">Select reason</option>
                        <option value="wrong_item">Ordered wrong item</option>
                        <option value="delay">Delay in delivery</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-danger">Submit</button>
                <button type="button" class="btn btn-secondary close-modal">Close</button>
            </form>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Open modal
            document.querySelectorAll('.cancel-order-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const orderId = this.dataset.orderId;
                    document.getElementById('cancelOrderId').value = orderId;
                    document.getElementById('cancelOrderModal').style.display = 'block';
                });
            });

            // Close modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('cancelOrderModal').style.display = 'none';
                });
            });

            // Optional: close on outside click
            window.addEventListener('click', function (e) {
                if (e.target.id === 'cancelOrderModal') {
                    document.getElementById('cancelOrderModal').style.display = 'none';
                }
            });
        });


        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

                button.classList.add('active');
                document.getElementById(button.dataset.tab).classList.add('active');
            });
        });

        // Submit cancel form
        document.getElementById('cancelOrderForm').addEventListener('submit', function (e) {
            e.preventDefault();

            fetch("{{ route('orders.cancel') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    order_id: document.getElementById('cancelOrderId').value,
                    reason: this.reason.value,
                    remarks: this.remarks.value,
                })
            })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });

    </script>
@endpush