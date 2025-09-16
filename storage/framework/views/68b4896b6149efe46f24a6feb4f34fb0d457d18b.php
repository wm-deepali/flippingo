

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
                <li class="breadcrumb-item active">Event Notifications</li>
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
              <h4 class="card-title">Event-Based Notifications</h4>
            </div>

            <div class="card-body">

              <!-- Tabs -->
              <ul class="nav nav-tabs" id="notificationTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="templates-tab" data-toggle="tab" href="#templates" role="tab">Templates</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab">Sent Notifications</a>
                </li>
              </ul>

              <div class="tab-content mt-3">
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
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
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

<?php $__env->startPush('scripts'); ?>
<script>
  $(document).ready(function () {
    $('#templates-table').DataTable();
    $('#notifications-table').DataTable();

    // Bootstrap tabs fix for DataTables responsive redraw
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
    });
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/notifications/events.blade.php ENDPATH**/ ?>