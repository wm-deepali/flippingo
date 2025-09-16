@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Raise Ticket' }}
@endsection

<style>
    .raise-ticket {
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    /* Top Cards */
    .ticket-cards {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .ticket-card {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        color: #333;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .ticket-card .ticket-left span {
        font-size: 18px;
        color: #666;
    }

    .ticket-card .ticket-left h3 {
        margin: 0;
        font-size: 28px !important;
        font-weight: 600 !important;
    }

    .ticket-card .ticket-icon {
        font-size: 28px;
    }

    /* pastel background */
    .ticket-card.new {
        background: #e0f7fa;
    }

    .ticket-card.progress {
        background: #fff3e0;
    }

    .ticket-card.resolved {
        background: #e8f5e9;
    }

    /* Header */
    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .ticket-header h2 {
        margin: 0;
    }

    .ticket-header p {
        flex: 1;
        /* margin: 0 15px;  */
        color: #555;
    }

    .btn-create {
        background: #059669;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-create:hover {
        background: #047857;
    }

    /* Table */
    .ticket-table {
        width: 100%;
        border-collapse: collapse;
    }

    .ticket-table th,
    .ticket-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        vertical-align: top;
    }

    .ticket-table th {
        background: #f9fafb;
    }

    .status {
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
    }

    .status.in-progress {
        background: #fef3c7;
        color: #92400e;
    }

    .status.resolved {
        background: #d1fae5;
        color: #065f46;
    }

    .status.new {
        background: #e0f7fa;
        color: #047857;
    }

    .btn-view,
    .btn-reply {
        padding: 6px 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin: 2px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-view {
        background: #3b82f6;
        color: #fff;
    }

    .btn-reply {
        background: #10b981;
        color: #fff;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 400px;
    }

    .modal-box form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .modal-box input,
    .modal-box textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .modal-actions {
        text-align: right;
        margin-top: 10px;
    }

    .btn-close {
        background: #f87171;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
    }

    .btn-submit {
        background: #059669;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
    }

    .btn-mark-resolved {
    margin-left: 5px;
}

</style>

@section('content')

    @include('user.sidebar')
    <div class="page-wrapper">

        <div class="raise-ticket">
            <!-- Top Cards -->
            <div class="ticket-cards">
                <div class="ticket-card new">
                    <div class="ticket-left">
                        <span>New Ticket</span>
                        <h3>{{ $countNew }}</h3>

                    </div>
                    <div class="ticket-icon"><i class="fas fa-plus-circle"></i></div>
                </div>
                <div class="ticket-card ">
                    <div class="ticket-left">
                        <span>In Progress</span>
                        <h3>{{ $countProgress }}</h3>
                    </div>
                    <div class="ticket-icon"><i class="fas fa-spinner"></i></div>
                </div>

                <div class="ticket-card resolved">
                    <div class="ticket-left">
                        <span>Resolved</span>
                        <h3>{{ $countResolved }}</h3>
                    </div>
                    <div class="ticket-icon"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>

            <!-- Heading & Description -->
            <div class="ticket-header mt-5">
                <div class="d-flex flex-column gap-1">
                    <h2>Support Tickets</h2>
                    <p>Track your tickets and raise new requests if you need assistance.</p>
                </div>

                <button class="btn-create" onclick="openCreateModal()">+ Create New Ticket</button>
            </div>

            <!-- Tickets Table -->
            <table class="ticket-table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Ticket ID</th>
                        <th>Detail</th>
                        <th>Status</th>
                        <th>Replies</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->created_at->format('d-M-Y h:i A') }}</td>
                                    <td>#TCKT{{ $ticket->id }}</td>
                                    <td>
                                        <strong style="font-weight: 600;">{{ $ticket->subject }}</strong><br>
                                        {{ $ticket->detail }}
                                    </td>
                                    <td>
                                        <span class="status
                                                                                                        {{ $ticket->status == 'Resolved' ? 'resolved' :
                        ($ticket->status == 'In Progress' ? 'in-progress' :
                            ($ticket->status == 'New' ? 'new' : '')) }}" style="white-space: nowrap;">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->replies->count() }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn-view btn btn-sm btn-info"><i
                                                class="fas fa-eye"></i> View</a>
                                        <button class="btn-reply"><i class="fas fa-reply"></i> Reply</button>
                                      @if($ticket->status !== 'Resolved')
    <button class="btn btn-sm btn-success btn-mark-resolved" data-ticket-id="{{ $ticket->id }}">
    <i class="fas fa-check"></i> Mark as Resolved
</button>

@endif



                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="5">No tickets found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create Ticket Modal -->
        <div class="modal-overlay" id="createModal">
            <div class="modal-box">
                <h3>Create New Ticket</h3>
                <hr>
                <form id="ticketForm" enctype="multipart/form-data">
                    <label for="ticket_type" class="m-0">Ticket Type</label>
                    <select class="form-control" name="ticket_type" id="ticket_type" required>
                        <option value="">Select Ticket Type</option>
                        <option value="order_related">Order Related</option>
                        <option value="enquiry_related">Enquiry Related</option>
                        <option value="wallet_issue">Wallet Issue</option>
                        <option value="customer_related">Customer Related</option>
                        <option value="payment_related">Payment Related</option>
                        <option value="others">Others</option>
                    </select>

                    <label for="subject" class="m-0">Subject</label>
                    <input type="text" name="subject" id="subject" required placeholder="Enter subject">

                    <label for="order_id" class="m-0">Order ID (if any)</label>
                    <input type="text" name="order_id" id="order_id" placeholder="Enter Order ID">

                    <label for="detail" class="m-0">Detail</label>
                    <textarea name="detail" id="detail" required
                        placeholder="Enter detailed description of your issue"></textarea>

                    <label for="file" class="m-0">Attach Screenshot / File</label>
                    <input type="file" name="file" id="file">

                    <div class="modal-actions">
                        <button type="button" class="btn-close" onclick="closeCreateModal()">Cancel</button>
                        <button type="submit" class="btn-submit">Submit</button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Reply Modal -->
        <div class="modal-overlay" id="replyModal">
            <div class="modal-box">
                <h3>Reply to Ticket</h3>
                <hr>
                <form id="replyForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ticket_id" id="reply_ticket_id" />
                    <textarea name="reply" id="reply_text" required placeholder="Type your reply..."></textarea>
                    <input type="file" name="file" id="reply_file" />
                    <div class="modal-actions">
                        <button type="button" class="btn-close" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Font Awesome CDN -->
    </div>


@endsection

@push('scripts')


    <script>
        // Open reply modal and set ticket id and clear fields
        document.querySelectorAll('.btn-reply').forEach(btn => {
            btn.addEventListener('click', () => {
                const ticketId = btn.closest('tr').querySelector('td:nth-child(2)').innerText.replace('#TCKT', '').trim();
                document.getElementById('reply_ticket_id').value = ticketId;
                document.getElementById('reply_text').value = '';
                document.getElementById('reply_file').value = '';
                document.getElementById('replyModal').style.display = 'flex';
            });
        });

        // Close modal
        function closeModal() {
            document.getElementById('replyModal').style.display = 'none';
        }

        // Submit reply form with AJAX
        document.getElementById('replyForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route("tickets.reply") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Reply Sent',
                            text: 'Your reply has been submitted successfully.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        closeModal();
                        // Optionally, reload the page or update UI dynamically
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Failed to send reply. Please try again.'
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Network error. Please try again.'
                    });
                });
        });


        // Create Ticket Modal
        function openCreateModal() {
            document.getElementById("createModal").style.display = "flex";
        }
        function closeCreateModal() {
            document.getElementById("createModal").style.display = "none";
        }

        // Submit Ticket Form
        document.getElementById("ticketForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form); // Handles file upload automatically

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('tickets.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show SweetAlert success
                        Swal.fire({
                            icon: 'success',
                            title: 'Ticket Created!',
                            text: 'Your ticket has been raised successfully.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        closeCreateModal(); // Close modal
                        form.reset(); // Reset form

                        // Optional: Add ticket to table dynamically here
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message || 'Something went wrong. Please try again.'
                        });
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error submitting ticket. Please try again.'
                    });
                });
        });


    document.querySelectorAll('.btn-mark-resolved').forEach(button => {
        button.addEventListener('click', () => {
            const ticketId = button.getAttribute('data-ticket-id');
            
            Swal.fire({
                title: 'Mark ticket as resolved?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, resolve it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch(`/dashboard/tickets/${ticketId}/status`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({status: 'Resolved'})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire('Resolved!', 'Your ticket has been marked as resolved.', 'success');
                            // Optionally reload page or update UI dynamically
                            location.reload();
                        } else {
                            Swal.fire('Oops!', data.message || 'Failed to update status.', 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error!', 'Network error. Please try again.', 'error');
                    });
                }
            });
        });
    });


    </script>
@endpush