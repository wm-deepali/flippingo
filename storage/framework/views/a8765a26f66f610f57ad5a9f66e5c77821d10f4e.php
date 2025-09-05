<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Account Deletion Reason</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <form id="edit-reason-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" id="reason-id" name="reason_id">

                    <div class="form-group">
                        <label>Reason</label>
                        <input type="text" name="reason" id="edit-reason" class="form-control"
                            placeholder="Enter reason" value="<?php echo e(old('reason', $reason->reason)); ?>">

                        <div class="text-danger validation-err" id="edit-reason-err"></div>
                    </div>

                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="update-reason-btn"
                            data-reason-id="<?php echo e($reason->id); ?>">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/deletion_reasons/edit.blade.php ENDPATH**/ ?>