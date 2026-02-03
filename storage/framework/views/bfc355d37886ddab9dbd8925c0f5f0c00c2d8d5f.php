<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form id="add-category-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Name -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>
                    <!-- Slug (readonly) -->

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                        <div class="text-danger validation-err" id="slug-err"></div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>

                    <!-- Popular Checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_popular" id="is_popular" value="1">
                            Mark as Popular
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="show_in_hero" value="1">
                            Show in Hero Section
                        </label>
                    </div>

                   <!-- Country Filter Option -->
<div class="form-group">
    <label>
        <input type="checkbox"
               name="enable_country_filter"
               id="enable_country_filter"
               value="1">
        Enable Country Dropdown on Listing Page
    </label>
    <small class="form-text text-muted">
        (If not enabled, country will be India by default)
    </small>
</div>

<!-- Country Dropdown Label (Hidden by default) -->
<div class="form-group d-none" id="country-label-wrapper">
    <label>Country Dropdown Label</label>
    <input type="text"
           name="country_dropdown_label"
           id="country_dropdown_label"
           class="form-control"
           placeholder="e.g. Select Country">
</div>

                    <!-- Icon Image -->
                    <div class="form-group">
                        <label>Icon Image</label>
                        <input type="file" name="icon_image" id="icon_image" class="form-control-file">
                        <div class="text-danger validation-err" id="icon_image-err"></div>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="add-category-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/[\s\W-]+/g, '-')   // Replace spaces and non-word chars with hyphens
            .replace(/^-+|-+$/g, '');    // Remove leading/trailing hyphens
    }

    document.getElementById('name').addEventListener('input', function () {
        document.getElementById('slug').value = slugify(this.value);
    });
</script>
<script>
    document.getElementById('enable_country_filter')
        .addEventListener('change', function () {

            const wrapper = document.getElementById('country-label-wrapper');
            const input   = document.getElementById('country_dropdown_label');

            if (this.checked) {
                wrapper.classList.remove('d-none');
                input.required = true;
            } else {
                wrapper.classList.add('d-none');
                input.required = false;
                input.value = '';
            }
        });
</script>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/categories/ajax/add-category.blade.php ENDPATH**/ ?>