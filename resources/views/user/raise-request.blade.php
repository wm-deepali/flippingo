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
                        <h3>12</h3>
                    </div>
                    <div class="ticket-icon"><i class="fas fa-plus-circle"></i></div>
                </div>
                <div class="ticket-card ">
                    <div class="ticket-left">
                        <span>In Progress</span>
                        <h3>12</h3>
                    </div>
                    <div class="ticket-icon"><i class="fas fa-spinner"></i></div>
                </div>
                <!-- <div class="ticket-card progress">
          <div class="ticket-left">
            <span>In Progress</span>
            <h3>8</h3>
          </div>
          <div class="ticket-icon"><i class="fas fa-spinner"></i></div>
        </div> -->
                <div class="ticket-card resolved">
                    <div class="ticket-left">
                        <span>Resolved</span>
                        <h3>25</h3>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>05-Sep-2025 10:30 AM</td>
                        <td>#TCKT1234</td>
                        <td>
                            <strong style="font-weight: 600;">Password Reset Issue</strong><br>
                            I am unable to reset my password using the reset link.
                        </td>
                        <td><span class="status in-progress" style="white-space: nowrap;">In Progress</span></td>
                        <td class="d-flex gap-2">
                            <button class="btn-view"><i class="fas fa-eye"></i> View</button>
                            <button class="btn-reply"><i class="fas fa-reply"></i> Reply</button>
                        </td>
                    </tr>
                    <tr>
                        <td>04-Sep-2025 02:15 PM</td>
                        <td>#TCKT1229</td>
                        <td>
                            <strong style="font-weight: 600;">Payment Not Received</strong><br>
                            I have made the payment but it's not reflecting.
                        </td>
                        <td><span class="status resolved">Resolved</span></td>
                        <td class="d-flex gap-2">
                            <button class="btn-view"><i class="fas fa-eye"></i> View</button>
                            <button class="btn-reply"><i class="fas fa-reply"></i> Reply</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create Ticket Modal -->
        <div class="modal-overlay" id="createModal">
            <div class="modal-box">
                <h3>Create New Ticket</h3>
                <hr>
                <form id="ticketForm">
                    <label class="m-0">Title</label>
                    <input type="text" required>

                    <label class="m-0">Subject</label>
                    <input type="text" required>

                    <label class="m-0">Description</label>
                    <textarea required></textarea>

                    <label class="m-0">Attach File</label>
                    <input type="file">

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
                <textarea placeholder="Type your reply..."></textarea>
                <input type="file" />
                <div class="modal-actions">
                    <button class="btn-close" onclick="closeModal()">Cancel</button>
                    <button class="btn-submit">Submit</button>
                </div>
            </div>
        </div>

        <!-- Font Awesome CDN -->
    </div>


@endsection

@push('scripts')


    <script>// Open Reply Modal
        // Reply Modal
        document.querySelectorAll(".btn-reply").forEach(btn => {
            btn.addEventListener("click", () => {
                document.getElementById("replyModal").style.display = "flex";
            });
        });
        function closeModal() {
            document.getElementById("replyModal").style.display = "none";
        }

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
            alert("New Ticket Created Successfully!");
            closeCreateModal();
        });

    </script>

@endpush