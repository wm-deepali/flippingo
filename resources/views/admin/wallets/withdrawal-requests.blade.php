@extends('layouts.master')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Withdrawal Requests</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Withdrawal Requests</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer</th>
                                                <th>Amount (₹)</th>
                                                <th>Status</th>
                                                <th>Payment Method</th>
                                                <th>Requested At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($requests as $req)
                                                <tr>
                                                    <td>{{ $req->id }}</td>
                                                    <td>
                                                        {{ $req->customer->customer_id ?? '-' }}<br>
                                                        {{ $req->customer->first_name ?? '' }}
                                                        {{ $req->customer->last_name ?? '' }}<br>
                                                        {{ $req->customer->email ?? '-' }}
                                                    </td>
                                                    <td>₹{{ number_format($req->amount, 2) }}</td>
                                                    <td>
                                                        <span
                                                            class="badge 
                                                                        {{ $req->status == 'pending' ? 'bg-warning' : ($req->status == 'approved' ? 'bg-success' : 'bg-danger') }}">
                                                            {{ ucfirst($req->status) }}
                                                        </span>
                                                    </td>
                                                   <td>
    @if($req->paymentMethod)
        <strong>Type:</strong> {{ $req->paymentMethod->type }}<br>

        @switch($req->paymentMethod->type)
            @case('bank')
                <strong>Account Name:</strong> {{ $req->paymentMethod->account_holder_name ?? '-' }}<br>
                <strong>Account Number:</strong> {{ $req->paymentMethod->account_number ?? '-' }}<br>
                <strong>Bank:</strong> {{ $req->paymentMethod->bank_name ?? '-' }}<br>
                <strong>IFSC:</strong> {{ $req->paymentMethod->ifsc_code ?? '-' }}
                @break

            @case('upi')
                <strong>Receiver Name:</strong> {{ $req->paymentMethod->receiver_name ?? '-' }}<br>
                <strong>UPI ID:</strong> {{ $req->paymentMethod->upi_id ?? '-' }}
                @break

            @case('paypal')
                <strong>PayPal Email:</strong> {{ $req->paymentMethod->paypal_email ?? '-' }}
                @break

                @case('wire')
                <strong>Account Name:</strong> {{ $req->paymentMethod->account_holder_name ?? '-' }}<br>
                <strong>Account Number:</strong> {{ $req->paymentMethod->account_number ?? '-' }}<br>
                <strong>Bank:</strong> {{ $req->paymentMethod->bank_name ?? '-' }}<br>
                <strong>Bank Address:</strong> {{ $req->paymentMethod->bank_address ?? '-' }}
                <strong>Bank Swift Code:</strong> {{ $req->paymentMethod->swift_code ?? '-' }}
                <strong>IBAN Number:</strong> {{ $req->paymentMethod->iban_number ?? '-' }}
                @break


            @default
                Details not available
        @endswitch
    @else
        -
    @endif
</td>

                                                    <td>{{ $req->created_at->format('Y-m-d H:i') }}</td>
                                                  
                                                    <td>
    @if($req->status == 'pending')
        <button type="button" class="btn btn-success btn-sm approve-btn" 
            data-id="{{ $req->id }}">
            Approve
        </button>

        <button type="button" class="btn btn-danger btn-sm reject-btn" 
            data-id="{{ $req->id }}">
            Reject
        </button>
    @else
        <span class="badge bg-secondary">{{ ucfirst($req->status) }}</span>
    @endif
</td>

                                                   
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $requests->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="approveForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="request_id" id="approve_request_id">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Withdrawal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Payment Date</label>
                        <input type="date" name="payment_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Reference ID</label>
                        <input type="text" name="reference_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea name="remarks" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Screenshot</label>
                        <input type="file" name="screenshot" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Confirm Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
$(document).ready(function() {

    // Open modal and set request ID
    $('.approve-btn').click(function() {
        var id = $(this).data('id');
        $('#approve_request_id').val(id);
        $('#approveModal').modal('show');
    });

    // Open modal and set request ID
    $('.approve-btn').click(function() {
        var id = $(this).data('id');
        $('#approve_request_id').val(id);
        $('#approveModal').modal('show');
    });

    // Submit approve form via AJAX
    $('#approveForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var requestId = $('#approve_request_id').val();

        $.ajax({
            url: '{{ route("admin.withdrawals.approve", ":id") }}'.replace(':id', requestId),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#approveModal').modal('hide');
                Swal.fire('Success', response.message, 'success');
                setTimeout(function() { location.reload(); }, 1000);
            },
            error: function(xhr) {
                let err = xhr.responseJSON?.message || 'Something went wrong';
                Swal.fire('Error', err, 'error');
            }
        });
    });

    // Reject via AJAX
    $('.reject-btn').click(function() {
        var requestId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This will reject the withdrawal request.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, reject it!'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: '{{ route("admin.withdrawals.reject", ":id") }}'.replace(':id', requestId),
                    method: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        Swal.fire('Rejected!', response.message, 'success');
                        setTimeout(function() { location.reload(); }, 1000);
                    },
                    error: function(xhr){
                        Swal.fire('Error', 'Something went wrong', 'error');
                    }
                });
            }
        });
    });

});
</script>
@endpush
