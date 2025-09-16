

<?php $__env->startSection('title'); ?>
    <?php echo e($ticket->subject ?? 'Ticket Details'); ?>

<?php $__env->stopSection(); ?>

<style>
    .ticket-details {
        max-width: 850px;
        margin: 32px auto;
        padding: 24px 32px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(20,44,63,0.08);
        font-family: Arial, sans-serif;
        color: #1a2535;
    }
    .ticket-details h2 {
        font-size: 1.7rem;
        font-weight: 700;
        margin-bottom: 25px;
        letter-spacing: -1px;
    }
    .ticket-meta-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px 40px;
        margin-bottom: 18px;
    }
    .ticket-meta-row label {
        color: #687187;
        font-weight: 600;
        margin-right: 2px;
    }
    .status-badge {
        display: inline-block;
        padding: 3px 18px;
        border-radius: 14px;
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        margin-right: 8px;
    }
    .badge-new      { background: #23c6d7; }
    .badge-progress { background: #f6a821; }
    .badge-resolved { background: #43d36a; }
    .badge-default  { background: #999; }
    .ticket-body { margin-bottom: 28px;}
    .ticket-body strong { color: #4d5666; }
    .tickets-replies h3 { font-size: 1.2rem; margin-bottom: 14px; font-weight: 600;}
    .reply-card {
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #ececec;
        margin-bottom: 18px;
        padding: 16px 20px;
        box-shadow: 0 1px 3px rgba(10,30,60,0.04);
    }
    .reply-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
    .reply-header .who {
        font-weight: 700;
        color: #15803d;
    }
    .reply-header .when {
        color: #478769;
        font-size: 0.97rem;
        font-weight: 500;
    }
    .reply-content { color: #252d38; font-size:1rem;}
    .reply-form {margin-top: 32px;}
    .reply-form h3 { font-size: 1.1rem; margin-bottom: 8px;}
    .reply-form textarea { width: 100%; padding: 10px; min-height: 60px; border-radius: 6px; border:1px solid #ddd; margin-bottom:8px;}
    .reply-form input[type="file"]{ margin-bottom: 16px;}
    .btn-submit {
        background: #059669;
        color: #fff;
        font-weight: 600;
        padding: 8px 20px;
        border: none;
        border-radius: 6px;
        margin-top: 3px;
        transition: background 0.15s;
    }
    .btn-submit:hover {
        background: #047857;
    }
</style>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page-wrapper">

    <div class="ticket-details">

        <h2>
            Ticket #TCKT<?php echo e($ticket->id); ?>

            <span style="font-weight:400;">- <?php echo e($ticket->subject); ?></span>
        </h2>

        <div class="ticket-meta-row">
            <label>Status:</label>
            <span class="status-badge
                <?php echo e($ticket->status == 'Resolved' ? 'badge-resolved' :
                   ($ticket->status == 'In Progress' ? 'badge-progress' :
                   ($ticket->status == 'New' ? 'badge-new' : 'badge-default'))); ?>">
                <?php echo e($ticket->status); ?>

            </span>

            <label>Created At:</label>
            <span><?php echo e($ticket->created_at->format('d-M-Y h:i A')); ?></span>

            <label>Order ID:</label>
            <span><?php echo e($ticket->order_id ?? '-'); ?></span>
        </div>

        <div class="ticket-body">
            <strong>Details:</strong>
            <span><?php echo e($ticket->detail); ?></span>
            <?php if($ticket->file_path): ?>
                <div style="margin-top:7px;">
                  <label>Attachment:</label>
                  <a href="<?php echo e(asset('storage/' . $ticket->file_path)); ?>" target="_blank" style="color:#2563eb;">View Attachment</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="tickets-replies">
            <h3>Replies (<?php echo e($ticket->replies->count()); ?>)</h3>
            <?php $__empty_1 = true; $__currentLoopData = $ticket->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="reply-card">
                    <div class="reply-header">
                        <span class="who"><?php echo e($reply->replier ? $reply->replier->first_name : 'Admin'); ?></span>
                        <span class="when"><?php echo e($reply->created_at->format('d-M-Y h:i A')); ?></span>
                    </div>
                    <div class="reply-content"><?php echo e($reply->reply); ?></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="color:#637385;">No replies yet.</p>
            <?php endif; ?>
        </div>

        <div class="reply-form">
            <h3>Add Reply</h3>
            <form method="POST" action="<?php echo e(route('tickets.reply')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
                <textarea name="reply" required placeholder="Type your reply here..."></textarea>
                <input type="file" name="file" />
                <button type="submit" class="btn-submit">Submit Reply</button>
            </form>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/tickets/show.blade.php ENDPATH**/ ?>