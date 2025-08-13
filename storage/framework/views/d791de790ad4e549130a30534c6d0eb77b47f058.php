

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
                    <h4 class="mb-0">Add Paper Rates</h4>
                    <small class="text-muted d-block mt-1">
                        <i class="fas fa-info-circle"></i> Pricing is based on the number of <strong>SRA3 sheets</strong>
                        used per order.
                    </small>

                </div>
                <div class="col-md-6 text-right">
                    <a href="<?php echo e(route('admin.centralized-paper-pricing.index')); ?>" class="btn btn-secondary btn-sm">← Back
                        to List</a>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="attribute_id" value="<?php echo e($attribute->id); ?>">
                        <input type="hidden" id="pricing-basis" value="<?php echo e($attribute->pricing_basis); ?>">
                        <form id="pricing-form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="attribute_id" value="<?php echo e($attribute->id); ?>">

                            <div id="dependency-section"></div>
                            <button type="submit" class="btn btn-success mt-2">Save Pricing</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

    <?php
        $filteredValuesByParent = [];
        foreach ($attribute->parents as $parent) {
            $filteredValuesByParent[$parent->id] = [
                'name' => $parent->name,
                'values' => $parent->values->filter(function ($val) {
                    return !$val->is_composite_value;
                })->map(function ($val) {
                    return [
                        'id' => $val->id,
                        'value' => $val->value,
                        'is_composite_value' => $val->is_composite_value,
                    ];
                })->values()
            ];
        }
    ?>

    <?php $__env->startPush('scripts'); ?>
            <script>
                $(document).ready(function () {
                    const parentValues = <?php echo json_encode($filteredValuesByParent, 15, 512) ?>;
                    const pricingBasis = $('#pricing-basis').val();

                    let ruleIndex = 0;
                    let rangeCounters = {};

                    function getQtyRangeHtml(rowIndex, rangeIndex) {
                        return `
            <div class="qty-range-item row mb-2 align-items-center">
              <div class="col-md-2">
                <input type="number" name="rows[${rowIndex}][per_page_pricing][${rangeIndex}][quantity_from]" class="form-control" placeholder="Min Qty" min="0" required>
              </div>
              <div class="col-md-2">
                <input type="number" name="rows[${rowIndex}][per_page_pricing][${rangeIndex}][quantity_to]" class="form-control" placeholder="Max Qty" min="0" required>
              </div>
              <div class="col-md-3">
                <input type="number" name="rows[${rowIndex}][per_page_pricing][${rangeIndex}][price]" class="form-control" step="0.01" min="0" placeholder="Price" required>
              </div>
              <div class="col-md-2">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="rows[${rowIndex}][per_page_pricing][${rangeIndex}][is_default]" value="1">
                  <label class="form-check-label">Default</label>
                </div>
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-qty-range">Remove</button>
              </div>
            </div>`;
                    }

                    function getDependencyRowHtml(index) {
                        let html = `<div class="card mb-3 dependency-row border rounded" data-index="${index}">
              <div class="card-body">
                <div class="row">`;

                        Object.entries(parentValues).forEach(([parentId, parentData]) => {
                            const values = parentData.values;
                            html += `
                <div class="col-md-3">
                  <label>${parentData.name}</label>
                  <select name="rows[${index}][dependency_values][${parentId}]" class="form-control" required>
                    <option value="">-- Select --</option>`;
                            values.forEach(val => {
                                html += `<option value="${val.id}">${val.value}</option>`;
                            });
                            html += `</select>
                </div>`;
                        });

                        html += `</div>
              <div class="qty-ranges-container mt-3" data-row-index="${index}">
                ${getQtyRangeHtml(index, 0)}
              </div>

              <div class="mt-2">
                <button type="button" class="btn btn-primary btn-sm add-qty-range" data-row-index="${index}">+ Add Quantity Range</button>
                <button type="button" class="btn btn-danger btn-sm remove-dependency float-right">Remove Dependency</button>
              </div>
            </div>
          </div>`;

                        return html;
                    }

                    // Add a new dependency row
                    function addDependencyRow() {
                        const html = getDependencyRowHtml(ruleIndex);
                        $('#dependency-section').append(html);
                        rangeCounters[ruleIndex] = 1;
                        ruleIndex++;
                    }

                    // Activate tab from URL hash
                    const hash = window.location.hash;
                    if (hash && $(`#pricingTab a[href="${hash}"]`).length) {
                        $(`#pricingTab a[href="${hash}"]`).tab('show');
                    }

                    // First row
                    addDependencyRow();

                    $('#dependency-section').after('<button type="button" class="btn btn-primary mt-2" id="add-dependency">+ Add Dependency</button>');

                    // Add Dependency Row
                    $(document).on('click', '#add-dependency', function () {
                        addDependencyRow();
                    });

                    // Remove Dependency Row
                    $(document).on('click', '.remove-dependency', function () {
                        $(this).closest('.dependency-row').remove();
                    });

                    // Add Quantity Range
                    $(document).on('click', '.add-qty-range', function () {
                        const rowIndex = $(this).data('row-index');
                        const container = $(this).closest('.dependency-row').find('.qty-ranges-container');
                        const rangeIndex = rangeCounters[rowIndex] ?? 0;

                        container.append(getQtyRangeHtml(rowIndex, rangeIndex));
                        rangeCounters[rowIndex] = rangeIndex + 1;
                    });

                    // Remove Quantity Range
                    $(document).on('click', '.remove-qty-range', function () {
                        $(this).closest('.qty-range-item').remove();
                    });


                    // Pricing form submit
                    $('#pricing-form').submit(function (e) {
                        e.preventDefault();
                        $.ajax({
                            url: "<?php echo e(route('admin.paper-rates.store')); ?>",
                            method: "POST",
                            data: $(this).serialize(),
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Saved!',
                                    text: response.message ?? 'Data saved successfully.'
                                }).then(() => {
                                    window.location.href = "<?php echo e(route('admin.centralized-paper-pricing.index')); ?>";
                                });
                            },
                            error: function (xhr) {
                                Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                            }
                        });
                    });
                });
            </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/centralized-paper-pricing/paper-rates/create.blade.php ENDPATH**/ ?>