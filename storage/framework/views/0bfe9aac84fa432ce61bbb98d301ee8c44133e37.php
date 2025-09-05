<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Customer Detail</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <p><strong>Name:</strong> <?php echo e($customer->name); ?></p>
            <p><strong>Email:</strong> <?php echo e($customer->email); ?></p>
            <p><strong>Phone:</strong> <?php echo e($customer->phone ?? '-'); ?></p>
            <p><strong>Registered At:</strong> <?php echo e($customer->created_at->format('Y-m-d H:i')); ?></p>
        </div>
    </div>
</div>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/account_deletion_requests/customer_modal.blade.php ENDPATH**/ ?>