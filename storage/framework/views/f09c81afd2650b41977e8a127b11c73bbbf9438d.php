

<?php $__env->startSection('content'); ?>
  <style>
    .sra3-input {
    margin-bottom: 10px;
    }
  </style>

  <div class="app-content content">
    <div class="content-wrapper">
    <div class="content-header row mb-2">
      <div class="col-md-6">
      <h4 class="mb-0">Set SRA3 Sheet Counts (<?php echo e($attribute->name); ?>)</h4>
      </div>
      <div class="col-md-6 text-right">
      <a href="<?php echo e(route('admin.centralized-paper-pricing.index')); ?>" class="btn btn-secondary btn-sm">← Back to
        List</a>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
      <div class="card-body">
        <input type="hidden" name="attribute_id" value="<?php echo e($attribute->id); ?>">

        <form id="sra3-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="attribute_id" value="<?php echo e($attribute->id); ?>">

        <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="form-group row sra3-input">
        <label class="col-md-4 col-form-label"><?php echo e($value->value ?? 'Unnamed Value'); ?></label>
        <div class="col-md-4">
        <input type="number" name="sra3_counts[<?php echo e($value->id); ?>]" class="form-control"
        placeholder="Sheets from SRA3" min="1">
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <button type="submit" class="btn btn-success mt-3">Save SRA3 Counts</button>
        </form>
      </div>
      </div>
    </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
  <script>
    $(document).ready(function () {

    // SRA3 form submit
    $('#sra3-form').submit(function (e) {
      e.preventDefault();
      $.ajax({
      url: "<?php echo e(route('admin.centralized-paper-pricing.store-sra3')); ?>",
      method: "POST",
      data: $(this).serialize(),
      success: function (response) {
        Swal.fire('Saved!', response.message ?? 'SRA3 counts saved.', 'success');
        window.location.href = "<?php echo e(route('admin.centralized-paper-pricing.index')); ?>";

      },
      error: function (xhr) {
        Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
      }
      });
    });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/centralized-paper-pricing/sra3/create.blade.php ENDPATH**/ ?>