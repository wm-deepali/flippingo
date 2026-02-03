<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form id="edit-category-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="category_id" value="<?php echo e($category->id); ?>">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"
                            value="<?php echo e($category->name); ?>">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug"
                            value="<?php echo e($category->slug); ?>">
                        <div class="text-danger validation-err" id="slug-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" <?php echo e($category->status == 'active' ? 'selected' : ''); ?>>Active</option>
                            <option value="inactive" <?php echo e($category->status == 'inactive' ? 'selected' : ''); ?>>Inactive
                            </option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>

                    <!-- Popular Checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_popular" id="is_popular" value="1" <?php echo e($category->is_popular ? 'checked' : ''); ?>>
                            Mark as Popular
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="show_in_hero" value="1" <?php echo e($category->show_in_hero ? 'checked' : ''); ?>>
                            Show in Hero Section
                        </label>
                    </div>

      <!-- Country Filter Option -->
<div class="form-group">
    <label>
        <input type="checkbox"
               name="enable_country_filter"
               id="enable_country_filter"
               value="1"
               <?php echo e($category->enable_country_filter ? 'checked' : ''); ?>>
        Enable Country Dropdown on Listing Page
    </label>
    <small class="form-text text-muted">
        (If not enabled, country will be India by default)
    </small>
</div>

<!-- Country Dropdown Label (conditional) -->
<div class="form-group <?php echo e($category->enable_country_filter ? '' : 'd-none'); ?>"
     id="country-label-wrapper">
    <label>Country Dropdown Label</label>
    <input type="text"
           name="country_dropdown_label"
           id="country_dropdown_label"
           class="form-control"
           placeholder="e.g. Select Country"
           value="<?php echo e($category->country_dropdown_label ?? ''); ?>"
           <?php echo e($category->enable_country_filter ? 'required' : ''); ?>>
</div>



                    <div class="form-group">
                        <label>Icon Image</label>
                        <input type="file" name="icon_image" class="form-control-file">
                        <div class="text-danger validation-err" id="icon_image-err"></div>

                        <?php if($category->image): ?>
                            <div class="mt-2">
                                <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="Current Icon Image" width="100"
                                    class="img-thumbnail">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="update-category-btn"
                            data-category-id="<?php echo e($category->id); ?>">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to convert text to URL-friendly slug
    function slugify(text) {
        return text.toString().toLowerCase()
            .trim()
            .replace(/[\s\W-]+/g, '-')   // Replace spaces and non-word chars with hyphens
            .replace(/^-+|-+$/g, '');    // Remove leading/trailing hyphens
    }

    // Listen for input changes on the 'name' field and update 'slug' field accordingly
    document.getElementById('name').addEventListener('input', function () {
        document.getElementById('slug').value = slugify(this.value);
    });
</script>
<script>
    const enableCountryCheckbox = document.getElementById('enable_country_filter');
    const countryLabelWrapper  = document.getElementById('country-label-wrapper');
    const countryLabelInput    = document.getElementById('country_dropdown_label');

    function toggleCountryLabel() {
        if (enableCountryCheckbox.checked) {
            countryLabelWrapper.classList.remove('d-none');
            countryLabelInput.required = true;
            countryLabelInput.disabled = false;

            // Optional default
            if (!countryLabelInput.value) {
                countryLabelInput.value = 'Select Country';
            }

        } else {
            countryLabelWrapper.classList.add('d-none');
            countryLabelInput.required = false;
            countryLabelInput.disabled = true; // 🔥 IMPORTANT
            countryLabelInput.value = '';
        }
    }

    // Initial state on modal load
    toggleCountryLabel();

    // Toggle on change
    enableCountryCheckbox.addEventListener('change', toggleCountryLabel);
</script>

<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/categories/ajax/edit-category.blade.php ENDPATH**/ ?>