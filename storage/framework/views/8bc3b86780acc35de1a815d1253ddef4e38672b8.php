

<?php $__env->startSection('content'); ?>
<style>
    .form-label { font-weight: bold; }
</style>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">

            
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-end">
                    <a href="<?php echo e(route('admin.form.index')); ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Forms
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Centered column -->
                <div class="col-lg-7 col-md-8 col-sm-12 mx-auto">
                    <div class="card shadow-sm rounded">
                        <div class="card-body" style="background: #fff; padding:20px;">

                            
                            <?php echo $formData->html; ?>


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
  document.addEventListener('DOMContentLoaded', function () {
    // Query all canvases with id starting with 'signature_'
    document.querySelectorAll('canvas[id^="signature_"]').forEach(function (canvas) {
      if (!canvas) return;

      // Initialize SignaturePad instance
      const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgba(255, 255, 255, 0)', // optional transparent bg
        penColor: 'black'
      });

      const fieldId = canvas.id.split('_')[2]; // e.g. for 'signature_123', gets '123'

      // Wire up Clear button
      const clearBtn = document.getElementById('clear_signature_field_' + fieldId);
   =;
      if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            
          signaturePad.clear();
          const hiddenInput = document.getElementById('hidden_signature_field' + fieldId);
          if (hiddenInput) hiddenInput.value = '';
        });
      }

      // Wire up Undo button
      const undoBtn = document.getElementById('undo_signature_' + fieldId);
      if (undoBtn) {
        undoBtn.addEventListener('click', function () {
          const data = signaturePad.toData();
          if (data && data.length) {
            data.pop(); // remove last stroke
            signaturePad.fromData(data);

            const hiddenInput = document.getElementById('hidden_signature_' + fieldId);
            if (hiddenInput) {
              hiddenInput.value = signaturePad.toDataURL();
            }
          }
        });
      }

      // Save signature data as Base64 in hidden input on end of drawing
      const saveSignature = () => {
        if (!signaturePad.isEmpty()) {
          const hiddenInput = document.getElementById('hidden_signature_' + fieldId);
          if (hiddenInput) hiddenInput.value = signaturePad.toDataURL();
        }
      };

      canvas.addEventListener('mouseup', saveSignature);
      canvas.addEventListener('touchend', saveSignature);
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/show.blade.php ENDPATH**/ ?>