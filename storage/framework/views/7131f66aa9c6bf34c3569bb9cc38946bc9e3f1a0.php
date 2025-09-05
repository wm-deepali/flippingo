<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add Account Deletion Reason</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form id="add-reason-form">
                    <?php echo csrf_field(); ?>
                    <!-- Reason -->
                    <div class="form-group">
                        <label>Reason</label>
                        <input type="text" name="reason" id="reason" class="form-control" placeholder="Enter reason">
                        <div class="text-danger validation-err" id="reason-err"></div>
                    </div>

                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="add-reason-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/deletion_reasons/create.blade.php ENDPATH**/ ?>