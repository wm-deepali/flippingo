

<?php $__env->startSection('content'); ?>
<div class="app-content content">
  <div class="content-wrapper">

    <div class="content-header row">
      <div class="col-12">
        <h4>Edit Home Slide</h4>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
        <div class="card-body">

          <form method="POST"
                action="<?php echo e(route('admin.home-slides.update', $homeSlide->id)); ?>"
                enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="form-group">
              <label>Title *</label>
              <input type="text"
                     name="title"
                     value="<?php echo e($homeSlide->title); ?>"
                     class="form-control"
                     required>
            </div>

            
            <div class="form-group">
              <label>Highlight</label>
              <input type="text"
                     name="highlight"
                     value="<?php echo e($homeSlide->highlight); ?>"
                     class="form-control">
            </div>

            
            <div class="form-group">
              <label>Features</label>

              <div id="feature-wrapper">
                <?php $__currentLoopData = $homeSlide->features ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="input-group mb-2 feature-row">
                    <input type="text"
                           name="features[]"
                           class="form-control"
                           value="<?php echo e($feature); ?>"
                           placeholder="Feature">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-danger remove-feature">&times;</button>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <button type="button"
                      class="btn btn-sm btn-outline-primary"
                      id="add-feature">
                + Add Feature
              </button>
            </div>

            
            <div class="row mt-3">
              <div class="col-md-6">
                <label>Media Type</label>
                <select name="media_type" class="form-control">
                  <option value="image" <?php echo e($homeSlide->media_type === 'image' ? 'selected' : ''); ?>>Image</option>
                  <option value="video" <?php echo e($homeSlide->media_type === 'video' ? 'selected' : ''); ?>>Video</option>
                </select>
              </div>

              <div class="col-md-6">
                <label>Replace Media</label>
                <input type="file" name="media_file" class="form-control">
              </div>
            </div>

            
            <?php if($homeSlide->media_path): ?>
              <div class="mt-3">
                <label>Current Media</label><br>

                <?php if($homeSlide->media_type === 'image'): ?>
                  <img src="<?php echo e(asset('storage/'.$homeSlide->media_path)); ?>"
                       alt="Slide Image"
                       style="max-width: 300px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,.2);">
                <?php else: ?>
                  <video width="320" height="180" controls>
                    <source src="<?php echo e(asset('storage/'.$homeSlide->media_path)); ?>">
                    Your browser does not support the video tag.
                  </video>
                <?php endif; ?>
              </div>
            <?php endif; ?>

            
            <h6 class="mt-4">Button 1</h6>
            <div class="row">
              <div class="col-md-4">
                <input name="btn1_text"
                       value="<?php echo e($homeSlide->btn1_text); ?>"
                       class="form-control"
                       placeholder="Text">
              </div>
              <div class="col-md-4">
                <input name="btn1_icon"
                       value="<?php echo e($homeSlide->btn1_icon); ?>"
                       class="form-control"
                       placeholder="Icon class">
              </div>
              <div class="col-md-4">
                <input name="btn1_link"
                       value="<?php echo e($homeSlide->btn1_link); ?>"
                       class="form-control"
                       placeholder="Link">
              </div>
            </div>

            
            <h6 class="mt-3">Button 2</h6>
            <div class="row">
              <div class="col-md-4">
                <input name="btn2_text"
                       value="<?php echo e($homeSlide->btn2_text); ?>"
                       class="form-control"
                       placeholder="Text">
              </div>
              <div class="col-md-4">
                <input name="btn2_icon"
                       value="<?php echo e($homeSlide->btn2_icon); ?>"
                       class="form-control"
                       placeholder="Icon class">
              </div>
              <div class="col-md-4">
                <input name="btn2_link"
                       value="<?php echo e($homeSlide->btn2_link); ?>"
                       class="form-control"
                       placeholder="Link">
              </div>
            </div>

            
            <div class="row mt-4">
              <div class="col-md-6">
                <label>Sort Order</label>
                <input type="number"
                       name="sort_order"
                       value="<?php echo e($homeSlide->sort_order); ?>"
                       class="form-control">
              </div>
              <div class="col-md-6">
                <label>Status</label>
                <select name="is_active" class="form-control">
                  <option value="1" <?php echo e($homeSlide->is_active ? 'selected' : ''); ?>>Active</option>
                  <option value="0" <?php echo e(!$homeSlide->is_active ? 'selected' : ''); ?>>Inactive</option>
                </select>
              </div>
            </div>

            
            <div class="mt-4">
              <button class="btn btn-primary">Update</button>
              <a href="<?php echo e(route('admin.home-slides.index')); ?>"
                 class="btn btn-secondary">Cancel</a>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

  // ADD FEATURE
  document.getElementById('add-feature').addEventListener('click', function () {
    document.getElementById('feature-wrapper').insertAdjacentHTML(
      'beforeend',
      `<div class="input-group mb-2 feature-row">
        <input type="text" name="features[]" class="form-control" placeholder="Feature">
        <div class="input-group-append">
          <button type="button" class="btn btn-danger remove-feature">&times;</button>
        </div>
      </div>`
    );
  });

  // REMOVE FEATURE
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-feature')) {
      e.target.closest('.feature-row').remove();
    }
  });

});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/home-slides/edit.blade.php ENDPATH**/ ?>