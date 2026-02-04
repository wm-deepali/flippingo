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
    <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><?php echo e($ticket->created_at->format('d-M-Y h:i A')); ?></td>
        <td>#TCKT<?php echo e($ticket->id); ?></td>
        <td>
          ID: <?php echo e($ticket->customer->customer_id ?? '-'); ?><br>
          <?php echo e($ticket->customer->first_name ?? '-'); ?> <?php echo e($ticket->customer->last_name ?? '-'); ?><br>
          <?php echo e($ticket->customer->email ?? '-'); ?>

        </td>
        <td>
          <strong style="font-weight: 600;"><?php echo e($ticket->subject); ?></strong><br>
          <?php echo e($ticket->detail); ?>

        </td>
        <td>
          <span class="badge 
                                    <?php echo e($ticket->status == 'Resolved' ? 'badge-success' :
      ($ticket->status == 'In Progress' ? 'badge-warning' :
        ($ticket->status == 'New' ? 'badge-primary' : 'badge-secondary'))); ?>">
            <?php echo e($ticket->status); ?>

          </span>
        </td>
        <td><?php echo e($ticket->replies->count()); ?></td>
        <td>
          <a href="<?php echo e(route('admin.tickets.show', $ticket->id)); ?>" class="btn btn-sm btn-info">View</a>
          <button class="btn btn-sm btn-success btn-reply" data-ticket-id="<?php echo e($ticket->id); ?>"
            data-ticket-subject="<?php echo e($ticket->subject); ?>">
            Reply
          </button>
          <button class="btn btn-sm btn-warning btn-change-status" data-ticket-id="<?php echo e($ticket->id); ?>"
            data-ticket-status="<?php echo e($ticket->status); ?>">
            Change Status
          </button>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr>
        <td colspan="7" class="text-center">No tickets found.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="statusForm" method="POST" action="">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
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
    <form id="replyForm" method="POST" action="<?php echo e(route('admin.tickets.reply')); ?>">
      <?php echo csrf_field(); ?>
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
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/tickets/table.blade.php ENDPATH**/ ?>