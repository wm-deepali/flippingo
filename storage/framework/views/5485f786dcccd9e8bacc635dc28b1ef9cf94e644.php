

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
          <li class="breadcrumb-item active">Forms</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="<?php echo e(route('admin.form.create')); ?>" class="btn-icon btn btn-primary btn-round btn-sm">Create New
        Form</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Forms</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="pagetype-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Form Name</th>
              <th>Status</th>
              <th>Language</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($form->name); ?></td>
            <td>
            <?php if($form->status): ?>
          <span class="badge badge-success">Active</span>
        <?php else: ?>
          <span class="badge badge-secondary">Inactive</span>
        <?php endif; ?>
            </td>
            <td><?php echo e($form->language ?? 'N/A'); ?></td>
            <td><?php echo e($form->updated_at->format('d M Y, h:i A')); ?></td>
            <td>
            <div class="dropdown">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
            id="actionMenu<?php echo e($form->id); ?>" data-toggle="dropdown" aria-expanded="false">
            Actions
            </button>
            <ul class="dropdown-menu" aria-labelledby="actionMenu<?php echo e($form->id); ?>">
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.edit', $form->id)); ?>">
              <i class="fas fa-pen"></i> Update
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.show', $form->id)); ?>" target="_blank">
              <i class="fas fa-eye"></i> View
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.settings', $form->id)); ?>">
              <i class="fas fa-cog"></i> Settings
              </a>
            </li>
            <li>
  <a class="dropdown-item text-danger" href="javascript:void(0)" 
     onclick="deleteConfirmation(<?php echo e($form->id); ?>)">
    <i class="fas fa-trash"></i> Delete
  </a>
</li>

            <!-- <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.conditionalRules', $form->id)); ?>">
              <i class="fas fa-random"></i> Conditional Rules
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.show', $form->id)); ?>" target="_blank">
              <i class="fas fa-file-alt"></i> View Record
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.copy', $form->id)); ?>">
              <i class="fas fa-copy"></i> Copy
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.publishShare', $form->id)); ?>">
              <i class="fas fa-share-alt"></i> Publish & Share
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.submissions', $form->id)); ?>">
              <i class="fas fa-paper-plane"></i> Submissions
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.addons', $form->id)); ?>">
              <i class="fas fa-puzzle-piece"></i> Add-Ons
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo e(route('admin.form.submissionsReport', $form->id)); ?>">
              <i class="fas fa-clock"></i> Submissions Report
              </a>
            </li>
            </ul> -->


            </div>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>


          </table>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>

  <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    function deleteConfirmation(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `<?php echo e(url('admin/form')); ?>/${id}`,
        type: "DELETE",
        dataType: "json",
        success: function (result) {
        if (result.success) {
          Swal.fire('Deleted!', '', 'success');
          setTimeout(() => location.reload(), 400);
        } else {
          Swal.fire(result.msgText);
        }
        }
      });
      }
    });
    }

    $(document).ready(function () {
    $('#pagetype-table').DataTable();
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/index.blade.php ENDPATH**/ ?>