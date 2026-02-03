

<?php $__env->startSection('content'); ?>
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
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Form Submissions</li>
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
                                <h4 class="card-title">Form Submissions Listing</h4>
                            </div>

                            <div class="card-body">
                                <!-- Tabs navigation -->
                                <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                                    <li class="nav-item"><button class="nav-link active" data-toggle="tab"
                                            data-target="#pending" type="button">Recent Listing</button></li>
                                    <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#published"
                                            type="button">Active Listing</button></li>
                                    <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#expired"
                                            type="button">Expired Listing</button></li>
                                    <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#rejected"
                                            type="button">Rejected Listing</button></li>

                                </ul>

                                <!-- Tabs content -->
                                <div class="tab-content">
                                    <?php $__currentLoopData = ['pending', 'published', 'expired', 'rejected']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="tab-pane fade <?php if($loop->first): ?> show active <?php endif; ?>" id="<?php echo e($status); ?>">
                                                    <?php echo $__env->make('admin.form_submissions.table', [
                                                        'submissions' => $submissions->filter(fn($submission) => strtolower($submission->status) === strtolower($status))
                                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                           </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateStatusForm">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Submission Status</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Status Selector -->
                    <div class="form-group">
                        <label for="newStatus">Select New Status</label>
                        <select name="status" id="newStatus" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="published">Published</option>
                            <option value="rejected">Rejected</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>

                    <!-- Remarks -->
                    <div class="form-group" id="remarksContainer" style="display:none;">

                        <label for="statusRemarks">Remarks</label>
                        <textarea name="remarks" id="statusRemarks" class="form-control" rows="4"
                            placeholder="Enter remarks..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>

        let currentSubmissionId = null;
        const allowedNextStatuses = {
            pending: ['published', 'rejected', 'expired'],
            published: ['expired', 'rejected'], // cannot go back to pending
            rejected: ['expired'],
                expired: [] // cannot change
           };

               $(document).on('click', '.changeStatusBtn', function () {
        currentSubmissionId = $(this).data('id');
            $('#updateStatusForm').data('submission-id', currentSubmissionId);

            let currentStatus = $(this).data('status');

            // Safety check
            const nextStatuses = allowedNextStatuses[currentStatus] || [];

         // Show all options first
            $('#newStatus option').show();

           // H   ide options that are NOT allowed
            $('#newStatus option').each(function () {
            let    val = $(this).val();
                if (!nextStatuses.includes(val) && val !== currentStatus) {
                    $(this).hide();
            }
            });

            // Set current status as selected by default
            $('#newStatus').val(currentStatus).trigger('change');

                $('#statusRemarks').val($(this).data('remarks') || '');
        // Bootstrap 5
var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
myModal.show();

        });

        // 🔹 Toggle remarks field dynamically
        $(document).on('change', '#newStatus', function () {
            if ($(this).val() === 'rejected') {
                $('#remarksContainer').show();
            } else {
                $('#remarksContainer').hide();
        }
        });

      // S  ubmit AJAX
    $('#updateStatusForm').on('submit', function (e) {
            e.preventDefault();

               let submissionId = $(this).data('submission-id');
            let status = $('#newStatus').val();
        let remarks = $('#statusRemarks').val();
            let token = $('input[name="_token"]').val();

            let data = { _token: token, status };

               if (status === 'rejected') {
            data.remarks = remarks;
            }

            $.ajax({
                url: '/admin/form-submissions/' + submissionId + '/update-status',
                type: 'PATCH',
            data    : data,
               success: function (response) {
                    $('#statusModal').modal('hide');
                    Swal.fire('Success', response.message, 'success');
                    setTimeout(() => location.reload(), 800);
            },
                    error: function (xhr) {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong', 'error');
                }
        });
    });

        </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form_submissions/index.blade.php ENDPATH**/ ?>