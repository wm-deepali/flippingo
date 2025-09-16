<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Created At</th>
      <th>Ticket ID</th>
      <th>Customer</th>
      <th>Details</th>
      <th>Status</th>
      <th>Replies Count</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse($tickets as $ticket)
      <tr>
        <td>{{ $ticket->created_at->format('d-M-Y h:i A') }}</td>
        <td>#TCKT{{ $ticket->id }}</td>
        <td>
          ID: {{ $ticket->customer->customer_id ?? '-' }}<br>
          {{ $ticket->customer->first_name ?? '-' }} {{ $ticket->customer->last_name ?? '-' }}<br>
          {{ $ticket->customer->email ?? '-' }}
        </td>
        <td>
          <strong style="font-weight: 600;">{{ $ticket->subject }}</strong><br>
          {{ $ticket->detail }}
        </td>
        <td>
          <span class="badge 
                                    {{ $ticket->status == 'Resolved' ? 'badge-success' :
      ($ticket->status == 'In Progress' ? 'badge-warning' :
        ($ticket->status == 'New' ? 'badge-primary' : 'badge-secondary')) }}">
            {{ $ticket->status }}
          </span>
        </td>
        <td>{{ $ticket->replies->count() }}</td>
        <td>
          <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-sm btn-info">View</a>
          <button class="btn btn-sm btn-success btn-reply" data-ticket-id="{{ $ticket->id }}"
            data-ticket-subject="{{ $ticket->subject }}">
            Reply
          </button>
          <button class="btn btn-sm btn-warning btn-change-status" data-ticket-id="{{ $ticket->id }}"
            data-ticket-status="{{ $ticket->status }}">
            Change Status
          </button>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="7" class="text-center">No tickets found.</td>
      </tr>
    @endforelse
  </tbody>
</table>

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="statusForm" method="POST" action="">
      @csrf
      @method('PATCH')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalLabel">Change Ticket Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="ticket_id" id="modal_ticket_id">
          <div class="form-group">
            <label for="statusSelectModal">Select Status</label>
            <select name="status" id="statusSelectModal" class="form-control" required>
              <option value="New">New</option>
              <option value="In Progress">In Progress</option>
              <option value="Resolved">Resolved</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Status</button>
        </div>
      </div>
    </form>
  </div>
</div>



<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="replyForm" method="POST" action="{{ route('admin.tickets.reply') }}">
      @csrf
      <input type="hidden" name="ticket_id" id="reply_ticket_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="replyModalLabel">Reply to Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
          <p><strong id="ticket_subject"></strong></p>
          <textarea name="reply" id="reply_text" rows="4" class="form-control" placeholder="Enter your reply"
            required></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send Reply</button>
        </div>
      </div>
    </form>
  </div>
</div>