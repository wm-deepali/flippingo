@extends('layouts.master')

<style>
    .card-reply {
    background-color: #f9fafb; /* light gray background */
    border: 1px solid #ddd;
    border-radius: 6px;
}

.card-reply .card-header {
    font-weight: 600;
    background-color: #e9ecef;
}

.card-reply.admin-reply .card-header {
    background-color: #d1e7dd;
}

.card-reply.customer-reply .card-header {
    background-color: #cff4fc;
}

</style>
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.tickets.index') }}">Tickets</a></li>
                                <li class="breadcrumb-item active">View Ticket Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-primary btn-sm">Back to Tickets</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Basic Information</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Ticket ID</dt>
                    <dd class="col-sm-9">#TCKT{{ $ticket->id }}</dd>

                    <dt class="col-sm-3">Customer</dt>
                    <dd class="col-sm-9">
                        ID: {{ $ticket->customer->customer_id ?? '-' }}<br>
                        {{ $ticket->customer->first_name ?? '-' }} {{ $ticket->customer->last_name ?? '-' }}<br>
                        {{ $ticket->customer->email ?? '-' }}
                    </dd>

                    <dt class="col-sm-3">Created On</dt>
                    <dd class="col-sm-9">{{ $ticket->created_at->format('d M Y H:i') }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        @switch($ticket->status)
                            @case('New')
                                <span class="badge badge-primary">New</span>
                                @break
                            @case('In Progress')
                                <span class="badge badge-warning">In Progress</span>
                                @break
                            @case('Resolved')
                                <span class="badge badge-success">Resolved</span>
                                @break
                            @default
                                <span class="badge badge-secondary">{{ ucfirst($ticket->status) }}</span>
                        @endswitch
                    </dd>
                </dl>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Ticket Details</h4>
            </div>
            <div class="card-body">
                <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
                <p><strong>Detail:</strong></p>
                <p>{{ $ticket->detail }}</p>

                @if ($ticket->file_path)
                    <p><strong>Attachment:</strong> <a href="{{ asset('storage/' . $ticket->file_path) }}" target="_blank">View File</a></p>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Replies ({{ $ticket->replies->count() }})</h4>
            </div>
            <div class="card-body">
            @forelse ($ticket->replies as $reply)
    <div class="reply-card mb-3 p-3" 
         style="background: #e1f3ec; border-radius: 8px; border: 1px solid #d1e7dd; max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <strong style="font-size:15px;">{{ $reply->replier ? ($reply->replier->first_name ?? 'Admin') : 'Admin' }}</strong>
                @if($reply->replied_type == 'admin')
                    <span class="badge badge-success" style="font-size:13px;">Admin</span>
                @else
                    <span class="badge badge-info" style="font-size:13px;">Customer</span>
                @endif
            </div>
            <div>
                <span class="text-muted" style="font-size:13px;">{{ $reply->created_at->format('d M Y H:i') }}</span>
            </div>
        </div>
        <div style="font-size:15px; color: #444;">
            {{ $reply->reply }}
        </div>
    </div>
@empty
    <p>No replies yet.</p>
@endforelse


            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Add Reply</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tickets.reply') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <div class="form-group">
                        <textarea name="reply" rows="4" class="form-control" placeholder="Type your reply here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Send Reply</button>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary mt-2">Back to Tickets</a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
