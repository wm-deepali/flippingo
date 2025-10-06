

<?php $__env->startSection('content'); ?>
  <style>
    #ef-widgets {
      height: 100%;
      max-height: 100%;
      overflow-y: auto;
    }

    /* Side panels and canvas layout */
    .ef-loading {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 200px;
    }

    .ef-sidebar-outer {
      border: 1px solid #ddd;
      background: #fff;
      height: 100%;
    }

    .ef-switcher {
      cursor: pointer;
    }

    #tab-fields .fields-wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    #tab-fields .builder-item {
      flex: 0 0 calc(50% - 10px);
      box-sizing: border-box;
      margin-bottom: 10px;
      text-align: center;
    }

    #canvas {
      background-color: #fff;
      color: #1d273b;
      height: 100%;
      max-height: 650px;
      overflow-y: auto;
      margin-bottom: 20px;
      padding: 25px;
      border: 1px solid #dadfe5;
      border-radius: 4px;
    }

    /* #my-form {
                                                                              height: 100vh;
                                                                          } */

    /* Modal button styling */
    .modal-footer .btn {
      margin-left: 5px;
    }

    .modal-footer .btn:first-child {
      margin-left: 0;
    }

    /* Highlight effect for copied fields */
    .highlight-copied {
      animation: highlightPulse 2s ease-in-out;
      border: 2px solid #28a745 !important;
      box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
    }

    @keyframes  highlightPulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.02);
      }

      100% {
        transform: scale(1);
      }
    }

    /* New field type styles */
    .nps-scale {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 10px;
    }

    .nps-scale input[type="range"] {
      flex: 1;
    }

    .matrix-table {
      margin-top: 10px;
      overflow-x: auto;
    }

    .matrix-table table {
      font-size: 0.9em;
    }

    .signature-pad {
      cursor: crosshair;
    }

    .page-break {
      page-break-after: always;
    }

    .form-label {
      font-weight: bold;
    }

    #styles-panel {
      height: 100%;
      max-height: 650px;
      overflow: hidden scroll;
    }

    .card-padding {
      padding: 1.25rem 1.25rem
    }

    .drag-over-top {
      border-top: 3px solid #007bff;
    }

    .drag-over-bottom {
      border-bottom: 3px solid #007bff;
    }

    .steps {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }

    .step {
      padding: 5px 10px;
      background: #f1f1f1;
      border-radius: 4px;
      user-select: none;
    }

    .step.current {
      background: #0d6efd;
      color: white;
      font-weight: bold;
    }

    .btn-nps {
      margin: 2px;
      border-radius: 50%;
      padding: 10px 15px;
      width: 38px;
      height: 38px;
      text-align: center;
    }

    .answer-input {
      padding: 2px;
    }

    .answer-container table.table {
      table-layout: fixed;
      width: 100%;
    }


    /* Show spacer label before the spacer field in builder mode */
    #canvas .form-group[data-field-type="spacer"] .spacer::before {
      content: "Spacer";
      display: inline-block;
      background-color: #e6e9ed;
      color: #555;
      font-size: 10px;
      padding: 2px 6px;
      border-radius: 3px;
      margin-right: 8px;
      vertical-align: middle;
    }

    .drop-placeholder {
      height: 50px;
      border: 2px dashed #007bff;
      border-radius: 6px;
      margin: 8px 0;
      background: rgba(0, 123, 255, 0.05);
      transition: all 0.2s ease-in-out;
    }

    .reorder-placeholder {
      height: 50px;
      border: 2px dashed #007bff;
      border-radius: 6px;
      margin: 8px 0;
      background: rgba(0, 123, 255, 0.05);
      transition: all 0.2s ease-in-out;
    }
  </style>
  <?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-okaidia.min.css">
  <?php $__env->stopPush(); ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-body">
        <div class="row" id="form-builder-wrapper">

          <!-- Loader -->
          <div id="ef-loading" class="ef-loading w-100">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>

          <!-- Left Sidebar: Fields -->
          <div id="ef-widgets" class="col-md-4 d-none">
            <div class="ef-sidebar-outer p-2">

              <!-- Tabs Navigation -->
              <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                  <a href="#tab-settings" class="nav-link active" data-bs-toggle="tab">Settings</a>
                </li>
                <li class="nav-item">
                  <a href="#tab-fields" class="nav-link" data-bs-toggle="tab">Fields</a>
                </li>
                <li class="nav-item">
                  <a href="#tab-code" class="nav-link" data-bs-toggle="tab">Code</a>
                </li>
              </ul>

              <!-- Tabs Content -->
              <div class="tab-content">
                <div id="tab-fields" class="tab-pane fade card-padding">
                  <div class="fields-wrapper">
                    <!-- dynamic fields go here -->
                  </div>
                </div>

                <div id="tab-settings" class="tab-pane show active fade card-padding">
                  <form id="settings-form">

                    <?php if(!$isTemplate): ?>
                      
                      <div class="form-group">
                        <label for="category_id" class="form-label"><strong>Category</strong></label>
                        <select class="form-control" id="category_id" name="category_id">
                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div id="categoryHelp" class="form-text">
                          Select a category for the form.
                        </div>
                      </div>
                    <?php endif; ?>


                    <div class="form-group">
                      <label for="form-name" class="form-label"><strong>Form Name</strong></label>
                      <input type="text" class="form-control" id="form-name" name="form_name" value="Untitled Form"
                        aria-describedby="formNameHelp">
                      <div id="formNameHelp" class="form-text">
                        Used for identifying the form on administration pages.
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="form-layout" class="form-label"><strong>Form Layout</strong></label>
                      <select class="form-control" id="form-layout" name="form_layout">
                        <option value="Vertical" selected>Vertical</option>
                        <option value="Horizontal">Horizontal</option>
                        <option value="Inline">Inline</option>
                      </select>
                    </div>

                    <div class="form-check mb-3">
                      <input type="checkbox" class="form-check-input" id="disable-elements" name="disable_elements">
                      <label class="form-check-label" for="disable-elements"><strong>Disable form
                          elements</strong></label>
                    </div>
                  </form>
                </div>

                <div id="tab-code" class="tab-pane fade card-padding">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Source Code preview</h6>
                    <a href="#" id="copy-code-btn" class="text-decoration-none">Copy</a>
                  </div>
                  <div class="p-0 rounded overflow-hidden border" style="border-color:#2d2d2d!important;">
                    <pre class="mb-0"
                      style="font-size:12px; max-height:420px; overflow-y:auto;"><code id="code-preview" class="language-markup"></code></pre>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Middle: Canvas -->
          <div id="ef-main" class="col-md-5 d-none">

            <!-- Canvas -->
            <div id="canvas">
              <form id="my-form" class="row">
                <?php echo csrf_field(); ?>
              </form>
            </div>

            <!-- Buttons after canvas -->


          </div>
          <div class="d-flex justify-content-center gap-2 mt-3 mb-3">
            <?php if(!empty($isTemplate) && $isTemplate): ?>
              <button id="save-template-btn" type="button" class="btn btn-secondary">
                <i class="fas fa-copy me-1"></i> Save Template
              </button>
            <?php else: ?>
              <button id="save-form-btn" type="button" class="btn btn-success">
                <i class="fas fa-check me-1"></i> Save Form
              </button>
              <button id="save-template-btn" type="button" class="btn btn-secondary">
                <i class="fas fa-copy me-1"></i> Save as Template
              </button>
            <?php endif; ?>
          </div>

          <!-- Right Sidebar: Styles -->
          <!-- <div id="ef-styles" class="col-md-3 d-none">
                                      <div class="ef-sidebar-outer p-2">
                                        <h5>Design</h5>
                                        <div id="styles-panel">
                                        </div>
                                        <div class="mt-2">
                                          <a href="#" id="collapse-styles">Collapse All</a> |
                                          <a href="#" id="expand-styles">Expand All</a>
                                        </div>
                                      </div>
                                    </div> -->

        </div>

        <!-- Modal after save -->
        <div class="modal fade" id="savedModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Great! Your form is saved.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <p>What do you want to do now?</p>
                <div class="list-group">
                  <a href="<?php echo e(route('admin.form.index')); ?>" class="list-group-item">Back to Form Manager</a>
                  <a href="#" id="editFormLink" class="list-group-item">Continue Editing</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Toast for errors -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="toast" class="toast text-bg-danger border-0">
            <div class="d-flex">
              <div class="toast-body">
                <strong id="toast-status"></strong>
                <span id="toast-message"></span>
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  
  <?php echo $__env->make('admin.form.partials.field-edit-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
  <?php echo $__env->make('admin.form.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script>

    // 🔹 Inject backend's default fields into form

    <?php if(isset($defaultForm['initForm'])): ?>
      const defaults = <?php echo json_encode($defaultForm['initForm'], 15, 512) ?>;
      defaults.forEach(f => {
        addFieldFromConfig(f.name, f.fields);
      });
    <?php endif; ?>


    function addFieldFromConfig(type, config = {}) {
      // Generate ID
      const fieldId = generateSimpleFieldId(type);

      // Generate HTML for the field
      const fieldHtml = getFieldHtml(type, fieldId);

      // Create outer field container with required attributes
      const $field = $(`<div class="form-group" data-field-id="${fieldId}" data-field-type="${type}" draggable="true">${fieldHtml}</div>`);

      // Merge defaults from FIELD_CONFIGS and passed config
      // const defaults = window.FIELD_CONFIGS?.[type] || {};
      const data = {};

      // // Get default values (skip 'id' key)
      // for (const [key, fieldConfig] of Object.entries(config)) {
      //   if (key === 'id') continue;
      //   if (fieldConfig.type === 'select') {
      //     data[key] = getSelectedOptionValue(fieldConfig.value);
      //   } else if (fieldConfig.type === 'choice') {
      //     data[key] = fieldConfig.value; // Array for choices
      //   }
      //   else {
      //     data[key] = fieldConfig.value;
      //   }
      // }

      // Override with provided config values
      for (const [key, val] of Object.entries(config)) {
        if (val && val.value !== undefined) {
          if (val.type === 'select') {
            data[key] = getSelectedOptionValue(val.value);
          } else if (val.type === 'choice') {
            data[key] = val.value;
          }
          else {
            data[key] = val.value;
          }
        } else {
          data[key] = val;
        }
      }


      // Special: For essential fields, mark as non-deletable and disable deletion and dragging
      const nonDeletableFields = ['product_title', 'mrp', 'urgent_sale', 'offered_price'];
      // console.log(config, 'config');

      const configId = (config.id && config.id.value) || (config.alias && config.alias.value) || '';
      if (nonDeletableFields.includes(String(configId).toLowerCase())) {
        $field.attr('data-non-deletable', 'true');
        $field.addClass('non-deletable-field');
        // Remove or disable delete button (adjust selector accordingly)
        $field.find('.remove-field-btn').remove();
        // Disable drag
        $field.removeAttr('draggable');
      }

      // Save the config data for later use
      setFieldData($field, data);

      // Apply config to UI elements (labels, inputs, etc)
      applyConfigToField($field, type, data, fieldId, config);

      // Append field to form canvas
      $('#my-form').append($field);
    }


    // Helper: add a new field to canvas using FIELD_CONFIGS + configData
    // function addFieldFromConfig(type, configData) {
    //   const fieldId = generateSimpleFieldId(type);

    //   const fieldHtml = getFieldHtml(type, fieldId);
    //   const $el = $(`<div class="form-group" data-field-id="${fieldId}" data-field-type="${type}">${fieldHtml}</div>`);

    //   // Merge defaults from FIELD_CONFIGS with backend-provided values
    //   const defaultsConfig = (window.FIELD_CONFIGS || {})[type] || {};
    //   let data = {};

    //   Object.entries(defaultsConfig).forEach(([k, v]) => {
    //     if (k === 'id') return; // don't override ID with default
    //     if (v.type === 'select') data[k] = getSelectedOptionValue(v.value);
    //     else data[k] = v.value;
    //   });

    //   // Override with backend initForm values
    //   // Override with backend initForm values
    //   if (configData) {
    //     Object.keys(configData).forEach(k => {
    //       let val;

    //       if (
    //         configData[k] &&
    //         Array.isArray(configData[k].value) // select field values come as array of options
    //       ) {
    //         val = getSelectedOptionValue(configData[k].value); // helper to extract selected
    //       } else if (configData[k] && configData[k].value !== undefined) {
    //         val = configData[k].value;
    //       } else {
    //         val = configData[k];
    //       }

    //       data[k] = val;
    //     });
    //   }

    //   setFieldData($el, data);
    //   applyConfigToField($el, type, data);
    //   $('#my-form').append($el);
    // }



    $('#save-form-btn').on('click', function () {
      const $btn = $(this);
      const form = $('#form-form')[0] || $('<form></form>')[0]; // just in case
      const formData = new FormData(form);

      // 1 Get the fields from the canvas
      let fields = [];
      $('#canvas .form-group').each(function () {
        let $field = $(this);
        let fieldData = {
          id: $field.data('field-id') || `field-${Date.now()}`,
          type: $field.data('field-type') || 'unknown',
          properties: getFieldData($field)
        };
        fields.push(fieldData);
      });
      // console.log(fields, 'fields');
      // return
      formData.append('fields', JSON.stringify(fields));

      // 2️ Get full HTML preview from canvas
      let previewHtml = $('#canvas').html();
      formData.append('html', previewHtml);

      // 3️ Get builder/settings data from the settings tab
      let builderSettings = {
        form_name: $('#form-name').val(),
        form_layout: $('#form-layout').val(),
        disable_elements: $('#disable-elements').is(':checked')
      };
      formData.append('builder', JSON.stringify(builderSettings));

      // 4️ Also store height of the preview
      let height = $('#canvas').outerHeight();
      formData.append('height', height);

      let categoryId = $('#category_id').val();
      formData.append('category_id', categoryId);

      // 5️ Also add name for the Form table
      formData.append('name', $('#form-name').val());

      // Disable button while saving
      $btn.prop('disabled', true);
      $('input, select').removeClass('is-invalid');
      $('.invalid-feedback').remove();

      // Save Form code
      $.ajax({
        url: "<?php echo e(route('admin.form.store')); ?>",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
          if (res.success) {
            $('#savedModal').modal('show');
            $('#editFormLink').attr('href', res.edit_url);
          } else {
            $btn.prop('disabled', false);
            showToast('Error', res.message || 'Something went wrong');
          }
        },
        error: function (xhr) {
          $btn.prop('disabled', false);
          const errors = xhr.responseJSON.errors || {};
          for (const key in errors) {
            const msg = errors[key][0];
            const input = $(`[name="${key}"]`).first();
            input.addClass('is-invalid');
            if (!input.next('.invalid-feedback').length) {
              input.after(`<div class="invalid-feedback">${msg}</div>`);
            }
          }
        }
      });
    });


    // save template code
    $('#save-template-btn').on('click', function () {
      const $btn = $(this);
      const form = $('#form-form')[0] || $('<form></form>')[0];
      const formData = new FormData(form);

      // 1 Get fields
      let fields = [];
      $('#canvas .form-group').each(function () {
        let $field = $(this);
        let fieldData = {
          id: $field.data('field-id') || `field-${Date.now()}`,
          type: $field.data('field-type') || 'unknown',
          properties: getFieldData($field)
        };
        fields.push(fieldData);
      });
      formData.append('fields', JSON.stringify(fields));

      // 2 HTML layout
      formData.append('html', $('#canvas').html());

      // 3 Builder/settings
      let builderSettings = {
        form_name: $('#form-name').val(),
        form_layout: $('#form-layout').val(),
        disable_elements: $('#disable-elements').is(':checked')
      };
      formData.append('builder', JSON.stringify(builderSettings));

      // 4 Add height
      formData.append('height', $('#canvas').outerHeight());

      // 5 Name for templates
      formData.append('name', $('#form-name').val());

      // 6 Flag to indicate it's a template save
      formData.append('is_template', true);

      // Disable while saving
      $btn.prop('disabled', true);
      $('input, select').removeClass('is-invalid');
      $('.invalid-feedback').remove();

      // AJAX call for saving template
      $.ajax({
        url: "<?php echo e(route('admin.form-templates.store')); ?>",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
          if (res.success) {
            Swal.fire({
              icon: 'success',
              title: 'Template saved!',
              text: 'Your form template has been saved successfully.',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = "<?php echo e(route('admin.form-templates.index')); ?>";
              }
            });
          } else {
            $btn.prop('disabled', false);
            showToast('Error', res.message || 'Something went wrong');
          }
        },

      });
    });


  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/create.blade.php ENDPATH**/ ?>