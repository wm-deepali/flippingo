

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
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Admin Notifications</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="<?php echo e(route('admin.notifications.create')); ?>" class="btn btn-primary btn-round btn-sm">
                            Create Notification
                        </a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Admin-Created Notifications</h4>
                            </div>

                            <div class="card-body">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="adminNotifTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="templates-tab" data-toggle="tab" href="#templates"
                                            role="tab">Templates</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications"
                                            role="tab">Sent Notifications</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3">
                                    <!-- Templates Tab -->
                                    <!-- Templates Tab -->
                                    <div class="tab-pane fade show active" id="templates" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table" id="templates-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Key</th>
                                                        <th>Subject</th>
                                                        <th>Content</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($loop->iteration); ?></td>
                                                            <td><?php echo e($template->key); ?></td>
                                                            <td><?php echo e($template->subject); ?></td>
                                                            <td><?php echo e($template->content); ?></td>
                                                            <td><?php echo e($template->created_at->format('d M Y, h:i A')); ?></td>
                                                            <td>
                                                                <button class="btn btn-success btn-sm send-template-btn"
                                                                    data-id="<?php echo e($template->id); ?>"
                                                                    data-subject="<?php echo e($template->subject); ?>"
                                                                    data-content="<?php echo e($template->content); ?>" data-toggle="modal"
                                                                    data-target="#sendTemplateModal">
                                                                    Send
                                                                </button>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Resend Modal (now for sending from template) -->
                                    <div class="modal fade" id="sendTemplateModal" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form id="send-template-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="template_id" id="template_id">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Send Notification from Template</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Subject</label>
                                                            <input type="text" class="form-control" name="subject"
                                                                id="template_subject" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Content</label>
                                                            <textarea class="form-control" name="content"
                                                                id="template_content" rows="4" readonly></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Send To</label>
                                                            <select class="form-control" name="send_to[]"
                                                                id="template_send_to" multiple>
                                                                <option value="all">All Customers</option>
                                                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($customer->id); ?>">
                                                                        <?php echo e($customer->first_name); ?> (<?php echo e($customer->email); ?>)
                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>




                                    <!-- Sent Notifications Tab -->
                                    <div class="tab-pane fade" id="notifications" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table" id="notifications-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Subject</th>
                                                        <th>Content</th>
                                                        <th>Template Key</th>
                                                        <th>Sent To</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $template->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($loop->parent->iteration); ?>.<?php echo e($loop->iteration); ?></td>
                                                                <td><?php echo e($notification->subject); ?></td>
                                                                <td><?php echo e($notification->content); ?></td>
                                                                <td><?php echo e($notification->template?->key ?? '-'); ?></td>
                                                                <td>
                                                                    <?php if($notification->is_broadcast): ?>
                                                                        All Customers
                                                                    <?php else: ?>
                                                                        <?php echo e($notification->customers->pluck('first_name')->join(', ')); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?php echo e($notification->created_at->format('d M Y, h:i A')); ?></td>

                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tabs -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {

            $('#template_send_to').select2({
                placeholder: "Search customers or choose All Customers",
                allowClear: true
            });

            // Send template button
            $('.send-template-btn').on('click', function () {
                let btn = $(this);
                $('#template_id').val(btn.data('id'));
                $('#template_subject').val(btn.data('subject'));
                $('#template_content').val(btn.data('content'));
                $('#template_send_to').val(null).trigger('change');
                $('#sendTemplateModal').modal('show'); // Optional if not using data-toggle
            });

            // AJAX submit
            $('#send-template-form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('admin.notifications.sendFromTemplate')); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#send-template-form button[type="submit"]').prop('disabled', true).text('Sending...');
                    },
                    success: function (res) {
                        Swal.fire('Success', res.message, 'success');
                        $('#sendTemplateModal').modal('hide');
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let errorMsg = errors ? Object.values(errors).join("\n") : 'Something went wrong!';
                        Swal.fire('Error', errorMsg, 'error');
                    },
                    complete: function () {
                        $('#send-template-form button[type="submit"]').prop('disabled', false).text('Send');
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/notifications/custom.blade.php ENDPATH**/ ?>