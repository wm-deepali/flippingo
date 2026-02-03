

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
  <input type="text" name="title"
         value="<?php echo e($homeSlide->title); ?>"
         class="form-control" required>
</div>


<div class="form-group">
  <label>Highlight</label>
  <input type="text" name="highlight"
         value="<?php echo e($homeSlide->highlight); ?>"
         class="form-control">
</div>


<div class="form-group">
  <label>Features</label>

  <div id="feature-wrapper">
    <?php $__currentLoopData = $homeSlide->features ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="input-group mb-2 feature-row">
        <input type="text" name="features[]"
               class="form-control"
               value="<?php echo e($feature); ?>">
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

  <div class="col-md-3">
    <label>Media Type</label>
    <select name="media_type" id="media_type" class="form-control">
      <option value="image" <?php echo e($homeSlide->media_type === 'image' ? 'selected' : ''); ?>>Image</option>
      <option value="video" <?php echo e($homeSlide->media_type === 'video' ? 'selected' : ''); ?>>Video</option>
    </select>
  </div>

  <div class="col-md-3 <?php echo e($homeSlide->media_type === 'video' ? '' : 'd-none'); ?>" id="video-type-wrapper">
    <label>Video Type</label>
    <select name="video_type" id="video_type" class="form-control">
      <option value="upload" <?php echo e($homeSlide->video_type === 'upload' ? 'selected' : ''); ?>>Upload</option>
      <option value="youtube" <?php echo e($homeSlide->video_type === 'youtube' ? 'selected' : ''); ?>>YouTube</option>
      <option value="vimeo" <?php echo e($homeSlide->video_type === 'vimeo' ? 'selected' : ''); ?>>Vimeo</option>
      <option value="external" <?php echo e($homeSlide->video_type === 'external' ? 'selected' : ''); ?>>External URL</option>
    </select>
  </div>

  <div class="col-md-3 <?php echo e(($homeSlide->media_type === 'video' && in_array($homeSlide->video_type, ['youtube','vimeo','external'])) ? 'd-none' : ''); ?>"
     id="file-wrapper">
    <label>Replace File</label>
    <input type="file" name="media_file"
           class="form-control"
           accept="image/*,video/*">
  </div>

  <div class="col-md-3 <?php echo e(in_array($homeSlide->video_type, ['youtube','vimeo','external']) ? '' : 'd-none'); ?>"
       id="url-wrapper">
    <label>Video URL</label>
    <input type="url"
           name="media_url"
           value="<?php echo e(filter_var($homeSlide->media_path, FILTER_VALIDATE_URL) ? $homeSlide->media_path : ''); ?>"
           class="form-control">
  </div>

</div>


<?php if($homeSlide->media_path): ?>
<div class="mt-3">
  <label>Current Media</label><br>

  <?php if($homeSlide->media_type === 'image'): ?>
    <img src="<?php echo e(asset('storage/'.$homeSlide->media_path)); ?>"
         style="max-width:300px;border-radius:8px;">
  <?php elseif($homeSlide->video_type === 'upload'): ?>
    <video width="320" height="180" controls>
      <source src="<?php echo e(asset('storage/'.$homeSlide->media_path)); ?>">
    </video>
  <?php else: ?>
    <iframe width="320" height="180"
            src="<?php echo e($homeSlide->media_path); ?>"
            frameborder="0"
            allowfullscreen></iframe>
  <?php endif; ?>
</div>
<?php endif; ?>


<h6 class="mt-4">Button 1</h6>
<div class="row">
  <div class="col-md-4">
    <input name="btn1_text" value="<?php echo e($homeSlide->btn1_text); ?>" class="form-control">
  </div>
  <div class="col-md-4">
    <input name="btn1_icon" value="<?php echo e($homeSlide->btn1_icon); ?>" class="form-control">
  </div>
  <div class="col-md-4">
    <input name="btn1_link" value="<?php echo e($homeSlide->btn1_link); ?>" class="form-control">
  </div>
</div>


<h6 class="mt-3">Button 2</h6>
<div class="row">
  <div class="col-md-4">
    <input name="btn2_text" value="<?php echo e($homeSlide->btn2_text); ?>" class="form-control">
  </div>
  <div class="col-md-4">
    <input name="btn2_icon" value="<?php echo e($homeSlide->btn2_icon); ?>" class="form-control">
  </div>
  <div class="col-md-4">
    <input name="btn2_link" value="<?php echo e($homeSlide->btn2_link); ?>" class="form-control">
  </div>
</div>


<div class="row mt-4">
  <div class="col-md-6">
    <label>Sort Order</label>
    <input type="number" name="sort_order"
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
  <a href="<?php echo e(route('admin.home-slides.index')); ?>" class="btn btn-secondary">Cancel</a>
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
document.addEventListener('DOMContentLoaded', () => {

  // Feature add/remove
  document.getElementById('add-feature').onclick = () => {
    document.getElementById('feature-wrapper').insertAdjacentHTML(
      'beforeend',
      `<div class="input-group mb-2 feature-row">
        <input type="text" name="features[]" class="form-control">
        <div class="input-group-append">
          <button type="button" class="btn btn-danger remove-feature">&times;</button>
        </div>
      </div>`
    );
  };

  document.addEventListener('click', e => {
    if (e.target.classList.contains('remove-feature')) {
      e.target.closest('.feature-row').remove();
    }
  });

  // Media toggle
  const mediaType = document.getElementById('media_type');
  const videoType = document.getElementById('video_type');
  const videoWrap = document.getElementById('video-type-wrapper');
  const fileWrap  = document.getElementById('file-wrapper');
  const urlWrap   = document.getElementById('url-wrapper');

  mediaType.addEventListener('change', () => {
    if (mediaType.value === 'video') {
      videoWrap.classList.remove('d-none');
    } else {
      videoWrap.classList.add('d-none');
      urlWrap.classList.add('d-none');
      fileWrap.classList.remove('d-none');
    }
  });

  videoType.addEventListener('change', () => {
    if (videoType.value === 'upload') {
      fileWrap.classList.remove('d-none');
      urlWrap.classList.add('d-none');
    } else {
      fileWrap.classList.add('d-none');
      urlWrap.classList.remove('d-none');
    }
  });

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/home-slides/edit.blade.php ENDPATH**/ ?>