<style>
    .form-control {
        border: 2px solid #e0e0e0 !important;
        color: black !important;
        border-radius: .375rem !important;
    }

    .custom-select {
        border: 2px solid #e0e0e0 !important;
        color: black !important;
        border-radius: .375rem !important;
    }
</style>


<?php
    $inputType = $attribute['input_type'] ?? 'radio';
    $values = $attribute['values'] ?? [];
    $supportImage = $attribute['has_image'] ?? false;
?>


<?php if($inputType === 'radio' && $supportImage): ?>
    <div class="attribute-wrapper col-md-12 mb-3" data-attribute-id="<?php echo e($attribute['id']); ?>"
        data-is-required="<?php echo e($attribute['is_required']); ?>">
        <label class="form-label">
            <?php echo e($attribute['name']); ?>

            <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="row attribute-values">
            <div class="col-md-6">
                <div class="paper-type-section">
                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button"
                            class="btn btn-light print-color text-start <?php echo e($value['is_default'] ? 'active' : ''); ?>"
                            data-attribute-id="<?php echo e($attribute['id']); ?>" data-value-id="<?php echo e($value['id']); ?>"
                            data-original-default="<?php echo e($value['original_is_default'] ?? ($value['is_default'] ?? false) ? 'true' : 'false'); ?>"
                            data-image="<?php echo e(asset('storage/' . ($value['image_path'] ?? 'default-preview.png'))); ?>" <?php echo e($value['is_default'] ? 'data-selected=true' : ''); ?>>
                            <?php echo e($value['value']); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php
                $imagePath = asset('storage/' . ($value['image_path'] ?? 'default-preview.png'));
            ?>

            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="border rounded overflow-hidden" style="width: 100%; height: 200px; padding: 3px;">
                    <img id="preview-image-<?php echo e($attribute['id']); ?>"
                        src="<?php echo e(asset('storage/' . ($attribute['values'][0]['image_path'] ?? 'default-preview.png'))); ?>"
                        class="img-fluid h-100 w-100 object-fit-cover" alt="Preview">

                    <div class="zoom-section">
                        <div class="zoomicon" data-bs-toggle="modal" data-bs-target="#imageZoomModal"
                            data-image="<?php echo e($imagePath); ?>"  style="cursor: pointer;">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    

<?php elseif($inputType === 'radio'): ?>
    <div class="<?php echo e(in_array($attribute['name'], ['Paper Weight', 'Cover Paper Weight']) ? 'col-md-12 attribute-wrapper' : 'col-md-6 attribute-wrapper'); ?> mb-3"
        data-attribute-id="<?php echo e($attribute['id']); ?>" data-is-required="<?php echo e($attribute['is_required']); ?>">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            <?php echo e($attribute['name']); ?>

            <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="attribute-values <?php echo e(count($values) <= 4 ? 'color-print' : 'color-print1'); ?>">
            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="print-color <?php echo e($value['is_default'] ? 'active' : ''); ?>" data-attribute-id="<?php echo e($attribute['id']); ?>"
                    data-original-default="<?php echo e($value['original_is_default'] ?? ($value['is_default'] ?? false) ? 'true' : 'false'); ?>"
                    data-value-id="<?php echo e($value['id']); ?>" data-value="<?php echo e($value['value']); ?>">
                    <p><?php echo e($value['value']); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
<?php elseif($inputType === 'select_image'): ?>
    <div class="attribute-wrapper col-md-12 mb-3" data-attribute-id="<?php echo e($attribute['id']); ?>"
        data-is-required="<?php echo e($attribute['is_required']); ?>">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            <?php echo e($attribute['name']); ?>

            <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="attribute-value color-print1">
            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="choose-binding <?php echo e($value['is_default'] ? 'active' : ''); ?>" data-value="<?php echo e($value['value']); ?>"
                    data-original-default="<?php echo e($value['original_is_default'] ?? ($value['is_default'] ?? false) ? 'true' : 'false'); ?>"
                    data-attribute-id="<?php echo e($attribute['id']); ?>" data-value-id="<?php echo e($value['id']); ?>">
                    <div>
                        <img src="<?php echo e(asset('storage/' . ($value['image_path'] ?? 'default.png'))); ?>" alt="<?php echo e($value['value']); ?>"
                            style="height:133px;" />
                        <div class="zoom-section1">
                            <div class="zoomicon">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </div>
                        </div>
                        <p class="text-center"><?php echo e($value['value']); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>

    
<?php elseif($inputType === 'dropdown'): ?>
    <div class="attribute-wrapper col-md-6 mb-3" data-attribute-id="<?php echo e($attribute['id']); ?>"
        data-is-required="<?php echo e($attribute['is_required']); ?>">
        <div class="d-flex justify-content-between size-btn">
            <label class="form-label d-flex align-items-center" style="gap: 5px;">
                <?php echo e($attribute['name']); ?>

                <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                    data-target="#helpModal">?</span>
            </label>
            <!--<button type="button" class="btn btn-link p-0">Custom Size</button>-->
        </div>
        <div class="attribute-values">
            <select class="custom-select" id="dropdown_<?php echo e($attribute['id']); ?>" name="attributes[<?php echo e($attribute['id']); ?>]">
                <option value="">-- Select --</option>
                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value['value']); ?>" data-attribute-id="<?php echo e($attribute['id']); ?>"
                        data-original-default="<?php echo e($value['original_is_default'] ?? ($value['is_default'] ?? false) ? 'true' : 'false'); ?>"
                        data-value-id="<?php echo e($value['id']); ?>" <?php echo e($value['is_default'] ? 'selected' : ''); ?>>
                        <?php echo e($value['value']); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        </div>
    </div>


    

<?php elseif($inputType === 'select_area'): ?>
    <?php
        $unitLabel = match ($attribute['area_unit']) {
            'sq_feet' => 'sq ft',
            'sq_meter' => 'm²',
            default => 'sq in',
        };
    ?>
    <div class="attribute-wrapper" data-attribute-id="<?php echo e($attribute['id']); ?>" data-attribute-type="select_area"
        data-is-required="<?php echo e($attribute['is_required'] ? '1' : '0'); ?>">

        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            <?php echo e($attribute['name']); ?>

            <span class="help-circle" data-label="<?php echo e($attribute['name']); ?>" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>

        <div class="row">
            <div class="col-6">
                <label for="length_<?php echo e($attribute['id']); ?>">Length (<?php echo e($unitLabel); ?>)</label>
                <input type="number" step="any" min="0" name="attributes[<?php echo e($attribute['id']); ?>][length]"
                    id="length_<?php echo e($attribute['id']); ?>" class="form-control area-input"
                    data-area-unit="<?php echo e($attribute['area_unit']); ?>" data-attribute-id="<?php echo e($attribute['id']); ?>"
                    <?php if(!empty($attribute['max_height'])): ?> max="<?php echo e($attribute['max_height']); ?>" <?php endif; ?>
                    placeholder="Enter length">
                <small class="text-danger length-warning" style="display: none;">Maximum length is
                    <?php echo e($attribute['max_height'] ?? ''); ?></small>
            </div>

            <div class="col-6">
                <label for="width_<?php echo e($attribute['id']); ?>">Width (<?php echo e($unitLabel); ?>)</label>
                <input type="number" step="any" min="0" name="attributes[<?php echo e($attribute['id']); ?>][width]"
                    id="width_<?php echo e($attribute['id']); ?>" class="form-control area-input"
                    data-area-unit="<?php echo e($attribute['area_unit']); ?>" data-attribute-id="<?php echo e($attribute['id']); ?>"
                    <?php if(!empty($attribute['max_width'])): ?> max="<?php echo e($attribute['max_width']); ?>" <?php endif; ?>
                    placeholder="Enter width">
                <small class="text-danger width-warning" style="display: none;">Maximum width is
                    <?php echo e($attribute['max_width'] ?? ''); ?></small>
            </div>
        </div>

        <div class="mt-2">
            <label>Calculated Area</label>
            <input type="text" id="area_<?php echo e($attribute['id']); ?>" class="form-control" readonly
                placeholder="Area will appear here">
            <small class="text-muted">Unit: <?php echo e($unitLabel); ?></small>
        </div>
    </div>
<?php endif; ?>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.area-input').forEach(function (input) {
            input.addEventListener('input', function () {
                const max = parseFloat(input.getAttribute('max'));
                const value = parseFloat(input.value);
                const id = input.getAttribute('id');

                const warningEl = input.closest('.col-6').querySelector('small');

                if (!isNaN(max) && value > max) {
                    warningEl.style.display = 'block';
                } else {
                    warningEl.style.display = 'none';
                }
            });
        });
    });
</script><?php /**PATH D:\web-mingo-project\new\resources\views/front/attribute-block.blade.php ENDPATH**/ ?>