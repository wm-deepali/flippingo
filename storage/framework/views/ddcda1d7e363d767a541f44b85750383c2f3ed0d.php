

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
                <li class="breadcrumb-item">
                  <a href="<?php echo e(route('home')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                  Home Slides
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="content-header-right col-md-3 col-12 text-md-right d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <a href="<?php echo e(route('admin.home-slides.create')); ?>"
             class="btn-icon btn btn-primary btn-round btn-sm">
            Add Slide
          </a>
        </div>
      </div>
    </div>

    
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <div class="card-header">
              <h4 class="card-title">Home Slides List</h4>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="home-slides-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Highlight</th>
                      <th>Media</th>
                      <th>Features</th>
                      <th>Sort Order</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th width="120">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                        <td><?php echo e($loop->iteration); ?></td>

                        <td><?php echo e($slide->title); ?></td>

                        <td>
                          <?php echo e($slide->highlight ?? '—'); ?>

                        </td>

                      <td>
  <?php if($slide->media_type === 'image' && $slide->media_path): ?>
      <img src="<?php echo e(asset('storage/'.$slide->media_path)); ?>"
           width="60"
           height="40"
           class="rounded"
           style="object-fit:cover;">

  <?php elseif($slide->media_type === 'video'): ?>

      <?php if($slide->video_type === 'upload'): ?>
          <span class="badge badge-primary">Video (Upload)</span>

      <?php elseif(in_array($slide->video_type, ['youtube','vimeo'])): ?>
          <span class="badge badge-info">
              Video (<?php echo e(ucfirst($slide->video_type)); ?>)
          </span>

      <?php else: ?>
          <span class="badge badge-secondary">Video (External)</span>
      <?php endif; ?>

  <?php else: ?>
      <span class="text-muted">—</span>
  <?php endif; ?>
</td>


                        <td>
                          <?php echo e(is_array($slide->features) ? count($slide->features) : 0); ?>

                        </td>

                        <td><?php echo e($slide->sort_order); ?></td>

                        <td>
                          <?php if($slide->is_active): ?>
                            <span class="badge badge-success">Active</span>
                          <?php else: ?>
                            <span class="badge badge-secondary">Inactive</span>
                          <?php endif; ?>
                        </td>

                        <td>
                          <?php echo e($slide->created_at->format('d M Y')); ?>

                        </td>

                        <td>
                          <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                              <a href="<?php echo e(route('admin.home-slides.edit', $slide->id)); ?>"
                                 class="btn btn-primary btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                              </a>
                            </li>

                            <li class="list-inline-item">
                              <form method="POST"
                                    action="<?php echo e(route('admin.home-slides.destroy', $slide->id)); ?>"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Are you sure?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-link p-0">
                                  <i class="fa fa-trash text-danger"></i>
                                </button>
                              </form>
                            </li>
                          </ul>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <tr>
                        <td colspan="9" class="text-center">
                          No slides found.
                        </td>
                      </tr>
                    <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function () {
  $('#home-slides-table').DataTable();
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/home-slides/index.blade.php ENDPATH**/ ?>