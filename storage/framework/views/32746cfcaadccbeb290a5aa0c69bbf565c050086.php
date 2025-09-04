

<style>
    #fields-source li.selected {
      background-color: #007bff;
      color: white;
    }

    .field-row {
      border: 1px dashed #007bff;
      margin-bottom: 10px;
      padding: 5px;
      display: flex;
      gap: 10px;
      position: relative;
    }

    .field-row li {
      cursor: grab;
      margin-bottom: 0;
      border: 1px solid #dee2e6;
      padding: 5px 10px;
      background: white;
      list-style: none;
      position: relative;
    }
  </style>
  
<?php $__env->startSection('content'); ?>

  <form id="layoutForm" method="POST" action="<?php echo e(route('admin.form-layout.update', ['id' => $form->id])); ?>">
    <?php echo csrf_field(); ?>

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
                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.form.index')); ?>">Forms</a></li>
                    <li class="breadcrumb-item active">Form layout</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-3 col-12 d-md-block text-right">
            <a href="<?php echo e(route('admin.form.index')); ?>" class="btn btn-primary btn-sm">Back to List</a>
          </div>
        </div>

        <div class="content-body">
          <div class="card">
            <div class="card-header">
              <h4>Form layout for: <?php echo e($form->name); ?></h4>
            </div>
            <div class="card-body">

              
              <div class="row">
                <div class="col-md-3">
                  <h5>Fields</h5>
                  <button id="add-selected-btn" class="btn btn-secondary btn-sm mb-2" type="button" disabled>
                    Add Selected Fields
                  </button>
                  <small class="text-muted d-block mb-2">
                    Select multiple fields with Ctrl/Cmd + Click, then click "Add Selected Fields".
                  </small>
                  <ul id="fields-source" class="list-group mb-2"
                    style="height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 5px;">
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $props = $field['properties'] ?? [];
                        $type = $field['type'] ?? '';
                        $displayText = '';
                        if ($type === 'heading' || $type === 'paragraph') {
                          $displayText = $props['text'] ?? ($props['label'] ?? $field['id']);
                        } elseif ($type === 'button') {
                          $displayText = $props['buttonText'] ?? ($props['label'] ?? $field['id']);
                        } else {
                          $displayText = $props['label'] ?? $field['id'];
                        }
                      ?>
                      <li class="list-group-item mb-1" data-id="<?php echo e($field['id']); ?>" style="cursor: pointer;">
                        <?php echo e($displayText); ?>

                      </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>

                <div class="col-md-9">
                  <h5>Layout</h5>
                  <div id="layout-zone"
                    style="max-height: 600px; overflow-y: auto; border:1px solid #007bff; padding:10px; background:#f8f9fa;">
                    <?php if(is_array($layout)): ?>
                      <?php $__currentLoopData = $layout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="field-row"
                          style="display:flex; gap:10px; border: 1px dashed #007bff; margin-bottom:10px; padding:5px; position: relative;">
                          <span class="drag-handle" style="cursor: grab; left: 5px; top: 5px; font-size: 20px;">☰</span>
                          <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                            $field = collect($fields)->firstWhere('id', $fieldId);
                              $props = $field['properties'] ?? [];
                              $type = $field['type'] ?? '';
                              $displayText = '';

                              if ($type === 'heading' || $type === 'paragraph') {
                                $displayText = $props['text'] ?? ($props['label'] ?? $fieldId);
                              } elseif ($type === 'button') {
                                $displayText = $props['buttonText'] ?? ($props['label'] ?? $fieldId);
                              } else {
                                $displayText = $props['label'] ?? $fieldId;
                              }
                            ?>

                            <li class="list-group-item mb-0" data-id="<?php echo e($fieldId); ?>"
                              style="cursor: grab; list-style:none; position: relative;">
                              <?php echo e($displayText); ?>

                              <button type="button" class="remove-field-btn" title="Remove field"
                                style="position: absolute; top: 2px; right: 5px; border: none; background: transparent; color: red; font-weight: bold; cursor: pointer; font-size: 16px; line-height: 1; padding: 0;">×</button>
                            </li>


                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </div>
                </div>


                <input type="hidden" id="field_layout" name="field_layout" value="" />
              
              </div>
               <div class="row mt-1">
                  <div class="col-md-12 text-right">
                    <button type="button" id="saveLayoutBtn" class="btn btn-primary">Save Layout</button>
                    <div id="save-status" class="text-muted mt-2"></div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div></form>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let selectedIds = new Set();
      const fieldsSource = document.getElementById('fields-source');
      const addSelectedBtn = document.getElementById('add-selected-btn');
      const layoutZone = document.getElementById('layout-zone');
      const saveLayoutBtn = document.getElementById('saveLayoutBtn');
      const saveStatus = document.getElementById('save-status');

      // Sidebar multi-select handling
      fieldsSource.addEventListener('click', function (e) {
        if (e.target.tagName !== 'LI') return;

        const li = e.target;
        const id = li.getAttribute('data-id');

        if (e.ctrlKey || e.metaKey) {
          if (selectedIds.has(id)) {
            selectedIds.delete(id);
            li.classList.remove('selected');
          } else {
            selectedIds.add(id);
            li.classList.add('selected');
          }
        } else if (e.shiftKey) {
          // Optional: implement range select if needed
        } else {
          fieldsSource.querySelectorAll('li.selected').forEach(el => el.classList.remove('selected'));
          selectedIds.clear();
          selectedIds.add(id);
          li.classList.add('selected');
        }

        addSelectedBtn.disabled = selectedIds.size === 0;
      });

      addSelectedBtn.addEventListener('click', function () {
        if (selectedIds.size === 0) return;

        const rowDiv = document.createElement('div');
        rowDiv.className = 'field-row';
        rowDiv.style.position = 'relative'; // For drag handle absolute positioning

        // Append drag handle span
        const dragHandle = document.createElement('span');
        dragHandle.className = 'drag-handle';
        dragHandle.style.cssText = 'cursor: grab; left: 5px; top: 5px; font-size: 20px;';
        dragHandle.textContent = '☰';
        rowDiv.appendChild(dragHandle);

        selectedIds.forEach(id => {
          const li = document.createElement('li');
          li.className = 'list-group-item mb-0';
          li.style.cursor = 'grab';
          li.style.listStyle = 'none';
          li.setAttribute('data-id', id);
          const sourceLi = fieldsSource.querySelector(`li[data-id="${id}"]`);
          li.textContent = sourceLi ? sourceLi.textContent : id;

          // Add remove button to each field
          const removeBtn = document.createElement('button');
          removeBtn.type = 'button';
          removeBtn.textContent = '×';
          removeBtn.title = 'Remove field';
          removeBtn.classList.add('remove-field-btn'); // Add this class
          removeBtn.style.cssText = `
              position: absolute;
              top: 2px;
              right: 1px;
              border: none;
              background: transparent;
              color: red;
              font-weight: bold;
              cursor: pointer;
              font-size: 16px;
              line-height: 1;
              padding: 0;
            `;
          li.style.position = 'relative';
          li.appendChild(removeBtn);


          rowDiv.appendChild(li);
        });

        layoutZone.appendChild(rowDiv);

        // Clear selections
        fieldsSource.querySelectorAll('li.selected').forEach(el => el.classList.remove('selected'));
        selectedIds.clear();
        addSelectedBtn.disabled = true;

        makeRowSortable(rowDiv);
      });

      new Sortable(layoutZone, {
        group: 'rows',
        animation: 150,
        fallbackOnBody: true,
        swapThreshold: 0.65,
        handle: '.drag-handle', // Only drag rows by the handle
        draggable: '.field-row',
      });


      function makeRowSortable(row) {
        new Sortable(row, {
          group: 'fields',
          animation: 150,
          fallbackOnBody: true,
          swapThreshold: 0.65,
          draggable: 'li',
          onEnd: function () {
            // Remove empty rows after field moves
            if (row.querySelectorAll('li').length === 0) {
              row.remove();
            }
          }
        });
      }



      // Initialize sortable on existing rows
      layoutZone.querySelectorAll('.field-row').forEach(makeRowSortable);

      // Remove field handler
      layoutZone.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-field-btn')) {
          const li = e.target.closest('li');
          if (li) {
            const row = li.closest('.field-row');
            li.remove();
            // If row is empty, remove it
            if (row && row.querySelectorAll('li').length === 0) {
              row.remove();
            }
          }
        }
      });

      // AJAX save layout button click
      saveLayoutBtn.addEventListener('click', function () {
        let layout = [];
        layoutZone.querySelectorAll('.field-row').forEach(row => {
          let rowFields = [];
          row.querySelectorAll('li').forEach(li => {
            rowFields.push(li.getAttribute('data-id'));
          });
          layout.push(rowFields);
        });

        // Disable button and show saving status
        saveLayoutBtn.disabled = true;
        saveStatus.textContent = 'Saving layout...';

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(document.getElementById('layoutForm').action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ field_layout: layout })
        })
          .then(response => {
            saveLayoutBtn.disabled = false;
            if (!response.ok) throw new Error('Network response was not OK');
            return response.json();
          })
          .then(data => {
            saveStatus.textContent = 'Layout saved successfully!';
            // Optionally handle data further
          })
          .catch(error => {
            saveStatus.textContent = 'Error saving layout: ' + error.message;
          });
      });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form-layout/edit.blade.php ENDPATH**/ ?>