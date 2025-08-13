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

    #tab-fields {
    max-height: 650px;
    overflow: scroll;
    }

    #canvas {
    background-color: #fff;
    color: #1d273b;
    min-height: 650px;
    margin-bottom: 20px;
    padding: 25px;
    border: 1px solid #dadfe5;
    border-radius: 4px;
    }

    #my-form {
    height: 100vh;
    }

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

    .spacer {
    background: repeating-linear-gradient(45deg,
      transparent,
      transparent 10px,
      rgba(0, 0, 0, .1) 10px,
      rgba(0, 0, 0, .1) 20px);
    }

    .form-label {
    font-weight: bold;
    }

    #styles-panel {
    height: 100%;
    max-height: 650px;
    overflow: hidden scroll;
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
          <a href="#tab-fields" class="nav-link active" data-bs-toggle="tab">Fields</a>
          </li>
          <li class="nav-item">
          <a href="#tab-settings" class="nav-link" data-bs-toggle="tab">Settings</a>
          </li>
          <li class="nav-item">
          <a href="#tab-code" class="nav-link" data-bs-toggle="tab">Code</a>
          </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content">
          <div id="tab-fields" class="tab-pane fade show active p-2">
          <!-- Fields list goes here -->
          </div>

          <div id="tab-settings" class="tab-pane fade p-2">
          <form id="settings-form">
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

            <div class="form-check">
            <input type="checkbox" class="form-check-input" id="disable-elements" name="disable_elements">
            <label class="form-check-label" for="disable-elements"><strong>Disable form
              elements</strong></label>
            </div>
          </form>
          </div>

          <div id="tab-code" class="tab-pane fade p-2">
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
        <div id="canvas">
        <form id="my-form">
          <?php echo csrf_field(); ?>
          <div class="form-group col-md-12" data-field-id="static-title" data-field-type="heading">
          <h1 id="canvas-title" class="mb-1">Untitled Form</h1>
          </div>

          <div class="form-group col-md-12" data-field-id="static-description" data-field-type="paragraph">
          <p class="mb-0">This is my form. Please fill it out. Thanks!</p>
          </div>
        </form>
        </div>
        <div class="mt-3">
        <button id="save-form-btn" type="button" class="btn btn-success">
          <i class="fas fa-check me-2"></i> Save Form
        </button>
        </div>
      </div>

      <!-- Right Sidebar: Styles -->
      <div id="ef-styles" class="col-md-3 d-none">
        <div class="ef-sidebar-outer p-2">
        <h5>Design</h5>
        <div id="styles-panel">
          <!-- Style customization options -->
        </div>
        <div class="mt-2">
          <a href="#" id="collapse-styles">Collapse All</a> |
          <a href="#" id="expand-styles">Expand All</a>
        </div>
        </div>
      </div>

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

  <!-- Field Edit Modal -->
  <div class="modal fade" id="fieldEditModal" tabindex="-1" aria-labelledby="fieldEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <div>
        <h5 class="modal-title" id="fieldEditModalLabel">Edit Field</h5>
        <small class="text-muted">Keyboard shortcuts: Ctrl+C to copy, Delete to remove, Esc to close</small>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="fieldEditForm">
        <input type="hidden" id="edit-field-id" name="field_id">
        <div id="fieldEditFields"></div>
      </form>
      </div>
      <div class="modal-footer">
      <div class="me-auto">
        <button type="button" class="btn btn-danger" id="deleteFieldBtn" title="Delete this field permanently">
        <i class="fas fa-trash me-1"></i> Delete
        </button>
        <button type="button" class="btn btn-info" id="copyFieldBtn" title="Copy this field to create a duplicate">
        <i class="fas fa-copy me-1"></i> Copy
        </button>
      </div>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary" id="saveFieldEditBtn">Save</button>
      </div>
    </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-markup.min.js"></script>

  <script>

    document.addEventListener('DOMContentLoaded', function () {
    Promise.all([
      fetch('<?php echo e(asset('data/css-rules.json')); ?>').then(r => r.json()),
      fetch('<?php echo e(asset('data/css-properties.json')); ?>').then(r => r.json())
    ])
      .then(([rules, properties]) => {
      renderDesignAccordion(rules, properties);
      });
    });

    function renderDesignAccordion(rules, properties) {
    const panel = document.querySelector('#styles-panel');
    panel.innerHTML = '';

    const accordion = document.createElement('div');
    accordion.classList.add('accordion');
    accordion.id = 'designAccordion';

    rules.forEach((rule, index) => {
      const item = document.createElement('div');
      item.classList.add('accordion-item');

      // Accordion Header
      const header = document.createElement('h2');
      header.classList.add('accordion-header');
      header.id = `heading-${index}`;
      header.innerHTML = `
      <button class="accordion-button collapsed" type="button"
      data-bs-toggle="collapse"
      data-bs-target="#collapse-${index}"
      aria-expanded="false"
      aria-controls="collapse-${index}">
      ${formatRuleName(rule.name)}
      </button>
      `;

      // Accordion Body
      const collapse = document.createElement('div');
      collapse.id = `collapse-${index}`;
      collapse.classList.add('accordion-collapse', 'collapse');
      collapse.setAttribute('aria-labelledby', `heading-${index}`);
      collapse.setAttribute('data-bs-parent', '#designAccordion');

      const body = document.createElement('div');
      body.classList.add('accordion-body');

      // Find matching properties by rule.name
      const propEntry = properties.find(p => p.name === rule.name);
      const props = propEntry ? propEntry.properties : [];

      props.forEach(propName => {
      const label = document.createElement('label');
      label.classList.add('form-label', 'mt-2');
      label.textContent = formatRuleName(propName);

      const input = document.createElement('input');
      input.type = guessInputType(propName);
      input.classList.add('form-control');

      input.addEventListener('input', (e) => {
        document.querySelectorAll(rule.selector).forEach(el => {
        el.style[propName] = e.target.value;
        });
      });

      body.appendChild(label);
      body.appendChild(input);
      });

      collapse.appendChild(body);
      item.appendChild(header);
      item.appendChild(collapse);
      accordion.appendChild(item);
    });

    panel.appendChild(accordion);
    }

    function formatRuleName(name) {
    return name.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
    }

    // Basic type guessing
    function guessInputType(cssProp) {
    if (cssProp.includes('color')) return 'color';
    if (cssProp.includes('size') || cssProp.includes('width') || cssProp.includes('height') || cssProp.includes('margin') || cssProp.includes('padding') || cssProp.includes('border')) {
      return 'number';
    }
    return 'text';
    }


    // Disable toggle listener
    $('#disable-elements').on('change', function () {
    const disable = $(this).is(':checked');
    disableAllFormControls(disable);
    });

    // Function to disable all existing form controls
    function disableAllFormControls(disable) {
    $('#my-form').find('input, select, textarea, button').prop('disabled', disable);
    }

    // change the layout of the form
    $('#form-layout').on('change', function () {
    currentLayout = this.value;
    applyLayoutToForm(currentLayout);
    });

    // function to change layout 
    function applyLayoutToForm(layout) {
    const $form = $('#my-form');

    // Reset form-level classes
    $form.removeClass('form-inline form-horizontal');

    $form.find('.form-group').each(function () {
      const $group = $(this);
      const $label = $group.find('label').first();

      // Remove all bootstrap grid classes from label
      $label.removeClass(function (index, className) {
      return (className.match(/(^|\s)col-\S+/g) || []).join(' ');
      });

      // If there’s a col-wrapper from Horizontal mode, unwrap it
      const $colWrapper = $group.find('.col-wrapper');
      if ($colWrapper.length) {
      $colWrapper.children().unwrap();
      }

      // Remove row class from group
      $group.removeClass('row');

      if (layout === 'Horizontal') {
      // Apply Horizontal structure
      $group.addClass('row');
      if ($label.length) {
        $label.addClass('col-3 col-form-label');
        const $controls = $group.children().not('label');
        const $wrapper = $('<div class="col col-wrapper"></div>');
        $controls.wrapAll($wrapper);
      }
      }
      else if (layout === 'Vertical') {
      // Vertical is default Bootstrap style: stacked labels and inputs
      if ($label.length) {
        $label.addClass('form-label');
      }
      }
    });

    if (layout === 'Horizontal') {
      $form.addClass('form-horizontal');
    } else if (layout === 'Inline') {
      $form.addClass('form-inline');
    }
    }


    // Remember last active tab between reloads
    document.addEventListener("DOMContentLoaded", function () {
    // Activate previously active tab from localStorage
    var activeTab = localStorage.getItem("ef-active-tab");
    if (activeTab) {
      var tabTrigger = document.querySelector(`a[href="${activeTab}"]`);
      if (tabTrigger) {
      var tab = new bootstrap.Tab(tabTrigger);
      tab.show();
      }
    }

    // On tab change, store the active tab href
    document.querySelectorAll('#ef-widgets a[data-bs-toggle="tab"]').forEach(function (tabEl) {
      tabEl.addEventListener('shown.bs.tab', function (event) {
      localStorage.setItem("ef-active-tab", event.target.getAttribute("href"));
      });
    });
    });


    // Hold dynamic field configs from controller
    let FIELD_CONFIGS = {};
    // Optional phrases map, fetched from backend for label translations
    let BUILDER_PHRASES = {};

    $.getJSON("<?php echo e(route('admin.ajax.builder.components')); ?>", function (components) {
    const $fieldsTab = $('#tab-fields');
    $fieldsTab.empty();

    components.forEach(function (field) {
      const iconClass = getIconForField(field.name);

      const block = `
      <div class="builder-field-item d-flex align-items-center mb-2 p-2 border rounded bg-white"
       draggable="true"
       data-type="${field.name}">
      <i class="${iconClass} me-2"></i>
      <span>${field.name}</span>
      </div>
      `;
      $fieldsTab.append(block);
    });

    // Map configs by component name for modal rendering
    FIELD_CONFIGS = components.reduce((acc, comp) => {
      acc[comp.name] = comp.fields || {};
      return acc;
    }, {});
    window.FIELD_CONFIGS = FIELD_CONFIGS;
    });

    // Fetch phrases from backend to translate label keys
    $.getJSON("<?php echo e(route('admin.ajax.builder.phrases')); ?>", function (phrases) {
    BUILDER_PHRASES = phrases || {};
    window.BUILDER_PHRASES = BUILDER_PHRASES;
    });

    // Helper to convert keys like "component.predefinedValue" to "Predefined Value"
    function humanizeLabelKey(key) {
    if (!key) return '';
    if (BUILDER_PHRASES && BUILDER_PHRASES[key]) return BUILDER_PHRASES[key];
    const last = key.includes('.') ? key.split('.').pop() : key;
    if (last.toLowerCase() === 'id') return 'ID / Name';
    const withSpaces = last
      .replace(/([a-z0-9])([A-Z])/g, '$1 $2')
      .replace(/_/g, ' ')
      .trim();
    return withSpaces.charAt(0).toUpperCase() + withSpaces.slice(1);
    }

    function getIconForField(type) {
    const icons = {
      heading: 'fas fa-heading',
      paragraph: 'fas fa-align-left',
      text: 'fas fa-font',
      number: 'fas fa-hashtag',
      date: 'fas fa-calendar-alt',
      email: 'fas fa-envelope',
      textarea: 'fas fa-align-justify',
      checkbox: 'fas fa-check-square',
      radio: 'fas fa-dot-circle'
    };
    return icons[type] || 'fas fa-square';
    }

    // Function to generate HTML code from the actual form content
    function generateHTMLCode() {
    const form = document.getElementById('my-form');
    if (!form) return '';

    // Clone the form to avoid modifying the original
    const formClone = form.cloneNode(true);

    // Remove any data attributes and classes that are not needed in the final HTML
    const fields = formClone.querySelectorAll('[data-field-id], [data-field-type]');
    fields.forEach(field => {
      field.removeAttribute('data-field-id');
      field.removeAttribute('data-field-type');
    });

    // Convert to HTML string
    let html = formClone.innerHTML;

    // Clean up any extra whitespace and formatting
    html = html.replace(/\s+/g, ' ').trim();

    // Wrap in form tags
    return `<form id="form-app">\n  ${html}\n</form>`;
    }


    // Pretty-print HTML by traversing the DOM (robust & avoids regex problems)
    function formatHTML(html) {
    const voidTags = new Set([
      'area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta',
      'param', 'source', 'track', 'wbr'
    ]);

    const container = document.createElement('div');
    container.innerHTML = html.trim();

    function serialize(node, indent) {
      let out = '';
      node.childNodes.forEach(child => {
      if (child.nodeType === Node.ELEMENT_NODE) {
        const tag = child.tagName.toLowerCase();
        const attrs = Array.from(child.attributes)
        .map(a => `${a.name}="${a.value}"`)
        .join(' ');
        const open = `<${tag}${attrs ? ' ' + attrs : ''}>`;

        if (voidTags.has(tag)) {
        // Void elements — print in single line
        out += indent + open + '\n';
        } else {
        out += indent + open + '\n';
        out += serialize(child, indent + '  ');
        out += indent + `</${tag}>` + '\n';
        }
      } else if (child.nodeType === Node.TEXT_NODE) {
        const text = child.nodeValue.replace(/\s+/g, ' ').trim();
        if (text) out += indent + text + '\n';
      } else if (child.nodeType === Node.COMMENT_NODE) {
        out += indent + `<!--${child.nodeValue}-->` + '\n';
      }
      });
      return out;
    }

    return serialize(container, '').trim();
    }

    // Hook into your preview update
    function updateCodePreview() {
    const codeEl = document.getElementById('code-preview');
    if (!codeEl) return;

    const rawHTML = document.querySelector('#my-form').outerHTML;
    const pretty = formatHTML(rawHTML);

    // Use textContent so the browser escapes for us
    codeEl.textContent = pretty;

    // Highlight with Prism if available
    if (window.Prism && typeof Prism.highlightElement === 'function') {
      Prism.highlightElement(codeEl);
    }
    }


    // Function to copy code to clipboard
    function copyCodeToClipboard() {
    const codeEl = document.getElementById('code-preview');
    if (!codeEl || !codeEl.textContent.trim()) return;
    navigator.clipboard.writeText(codeEl.textContent).then(() => {
      const copyLink = document.getElementById('copy-code-btn');
      const original = copyLink.textContent;
      copyLink.textContent = 'Copied!';
      setTimeout(() => { copyLink.textContent = original; }, 1500);
    }).catch(err => {
      console.error('Failed to copy code:', err);
      alert('Failed to copy code to clipboard');
    });
    }

    // Function to get HTML for each field type
    function getFieldHtml(fieldType, fieldId) {

    switch (fieldType) {
      case 'heading':
      return `<h1 contenteditable="true">Heading</h1>`;
      case 'paragraph':
      return `<p contenteditable="true">Paragraph text</p>`;
      case 'text':
      return `<label class="form-label">Text Field</label><input type="text" class="form-control" placeholder="Enter text" />`;
      case 'number':
      return `<label class="form-label">Number Field</label><input type="number" class="form-control" placeholder="Enter number" />`;
      case 'date':
      return `<label class="form-label">Date Field</label><input type="date" class="form-control" />`;
      case 'email':
      return `<label class="form-label">Email Field</label><input type="email" class="form-control" placeholder="Enter email" />`;
      case 'textarea':
      return `<label class="form-label">Textarea</label><textarea class="form-control" rows="3" placeholder="Enter text"></textarea>`;
      case 'checkbox':
      return `<label class="form-label">Check All That Apply</label><div class="checkbox-options"></div>`;
      case 'radio':
      return `<label class="form-label">Select a Choice</label><div class="radio-options"></div>`;
      case 'selectlist':
      return `<label class="form-label">Select List</label><select class="form-control"><option value="">Select an option</option></select>`;
      case 'hidden':
      return `<input type="hidden" name="hidden_field" value="" />`;
      case 'file':
      return `<label class="form-label">File Upload</label><input type="file" class="form-control" />`;
      case 'snippet':
      return `<div class="alert alert-info">Custom HTML Snippet - Click to edit</div>`;
      case 'recaptcha':
      return `<div class="g-recaptcha" data-sitekey="your-site-key"></div>`;
      case 'pagebreak':
      return `<hr class="page-break" style="border: 2px dashed #ccc; margin: 20px 0;" />`;
      case 'spacer':
      return `<div class="spacer" style="height: 20px;"></div>`;
      case 'nps':
      return `<label class="form-label">NPS Question</label><div class="nps-scale"><span>0</span><input type="range" min="0" max="10" class="form-range" /><span>10</span></div>`;
      case 'matrix':
      return `<label class="form-label">Matrix Question</label><div class="matrix-table"><table class="table table-sm"><thead><tr><th></th><th>Strongly Disagree</th><th>Disagree</th><th>Neutral</th><th>Agree</th><th>Strongly Agree</th></tr></thead><tbody><tr><td>Question 1</td><td><input type="radio" name="q1" value="1"></td><td><input type="radio" name="q1" value="2"></td><td><input type="radio" name="q1" value="3"></td><td><input type="radio" name="q1" value="4"></td><td><input type="radio" name="q1" value="5"></td></tr></tbody></table></div>`;
      case 'signature':
      return `<label class="form-label">Signature</label><div class="signature-pad" style="border: 1px solid #ccc; height: 100px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #6c757d;">Click to sign</div>`;
      case 'button':
      return `<button type="submit" class="btn btn-primary">Submit</button>`;
      default:
      return `<span class="field-text">${fieldType} field</span>`;
    }
    }

    // Enhanced drag & drop with visual feedback
    $(document).on('dragstart', '.builder-field-item', function (e) {
    e.originalEvent.dataTransfer.setData('field-type', $(this).data('type'));
    $(this).addClass('dragging');
    });

    $(document).on('dragend', '.builder-field-item', function (e) {
    $(this).removeClass('dragging');
    });

    $('#canvas').on('dragover', function (e) {
    e.preventDefault();
    $(this).addClass('drag-over');
    });

    $('#canvas').on('dragleave', function (e) {
    // Only remove class if we're actually leaving the canvas, not just entering a child element
    if (!$(this).is(e.relatedTarget) && !$(this).has(e.relatedTarget).length) {
      $(this).removeClass('drag-over');
    }
    });

    // Drop handler will be defined below with the complete implementation

    // Escape helper
    function escapeHtml(str) {
    return String(str == null ? '' : str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;');
    }

    function getSelectedOptionValue(options) {
    if (!Array.isArray(options) || options.length === 0) return '';
    const selected = options.find(o => o.selected) || options[0];
    return selected.value;
    }

    // Store field data on the element
    function setFieldData($el, data) {
    $el.data('fieldData', data);
    }
    function getFieldData($el) {
    return $el.data('fieldData') || {};
    }

    // On field click, open modal (show all fields, visually separate advanced fields)
    $(document).on('click', '[data-field-id]', function (e) {
    if ($(e.target).hasClass('remove-field-btn') || $(e.target).closest('.remove-field-btn').length) return;
    const $field = $(this);
    const fieldId = $field.attr('data-field-id');
    const fieldType = $field.attr('data-field-type');
    const config = (window.FIELD_CONFIGS || {})[fieldType];
    if (!config) return;
    const fieldData = getFieldData($field);
    $('#edit-field-id').val(fieldId);
    let html = '';
    let advancedHtml = '';
    Object.entries(config).forEach(([key, conf]) => {
      if (key === 'id') return; // never show raw id in modal
      const rawDefault = conf.type === 'select' ? getSelectedOptionValue(conf.value) : conf.value;
      const value = fieldData[key] !== undefined ? fieldData[key] : rawDefault;

      let inputHtml = '';
      const labelText = humanizeLabelKey(conf.label || key);
      if (conf.type === 'input') {
      inputHtml = `<div class=\"form-group\"><label class=\"form-label\">${labelText}</label><input type=\"text\" class=\"form-control\" name=\"${key}\" value=\"${escapeHtml(value)}\"></div>`;
      } else if (conf.type === 'textarea') {
      inputHtml = `<div class=\"form-group\"><label class=\"form-label\">${labelText}</label><textarea class=\"form-control\" name=\"${key}\">${escapeHtml(value)}</textarea></div>`;
      } else if (conf.type === 'select') {
      const options = (Array.isArray(conf.value) ? conf.value : []).map(opt => {
        const selectedAttr = String(value) === String(opt.value) || opt.selected ? 'selected' : '';
        const optLabel = humanizeLabelKey(opt.label || opt.value);
        return `<option value=\"${escapeHtml(opt.value)}\" ${selectedAttr}>${escapeHtml(optLabel)}</option>`;
      }).join('');
      inputHtml = `<div class=\"form-group\"><label class=\"form-label\">${labelText}</label><select class=\"form-control\" name=\"${key}\">${options}</select></div>`;
      } else if (conf.type === 'checkbox') {
      const checked = value === true || value === 'true' || value === 1 || value === '1';
      inputHtml = `<div class=\"form-check form-group\"><input class=\"form-check-input\" type=\"checkbox\" name=\"${key}\" id=\"edit-${key}\" ${checked ? 'checked' : ''}><label class=\"form-check-label\" for=\"edit-${key}\">${labelText}</label></div>`;
      } else if (conf.type === 'choice') {
      // Handle choice type fields (like checkboxes, radios, options)
      let choiceHtml = `<div class=\"form-group\"><label class=\"form-label\">${labelText}</label>`;

      // Add "Add Option" button at the top
      choiceHtml += `<div class=\"mb-2\">
      <button type=\"button\" class=\"btn btn-sm btn-outline-primary add-choice-option-btn\" data-field-key=\"${key}\">
      <i class=\"fas fa-plus me-1\"></i> Add Option
      </button>
      </div>`;

      // Prefer current field value (persisted) over defaults from config
      const choiceOptions = Array.isArray(value) ? value : (Array.isArray(conf.value) ? conf.value : []);

      choiceOptions.forEach((choice, index) => {
        let choiceText = choice;
        let isSelected = false;

        if (typeof choice === 'string' && choice.includes('|selected')) {
        choiceText = choice.replace('|selected', '');
        isSelected = true;
        }

        choiceHtml += `<div class=\"choice-option-row d-flex align-items-center mb-2 p-2 border rounded\" data-index=\"${index}\" style=\"background-color: #f8f9fa;\">
      <div class=\"form-check me-2\">
      <input class=\"form-check-input\" type=\"checkbox\" name=\"${key}[]\" id=\"edit-${key}-${index}\" value=\"${escapeHtml(choiceText)}\" ${isSelected ? 'checked' : ''}>
      <label class=\"form-check-label\" for=\"edit-${key}-${index}\"></label>
      </div>
      <input type=\"text\" class=\"form-control me-2\" value=\"${escapeHtml(choiceText)}\" placeholder=\"Option text\" style=\"flex: 1; min-width: 150px;\">
      <button type=\"button\" class=\"btn btn-sm btn-outline-danger remove-choice-option-btn\" data-index=\"${index}\" title=\"Remove option\">
      <i class=\"fas fa-minus\"></i>
      </button>
      </div>`;
      });

      choiceHtml += '</div>';
      inputHtml = choiceHtml;
      } else if (key === 'customAttributes') {
      // Special UI for custom attributes (name|value pairs)
      const attrs = Array.isArray(value) ? value : (Array.isArray(conf.value) ? conf.value : ['']);
      let caHtml = `<div class=\"form-group\"><label class=\"form-label\">${labelText}</label>`;
      (attrs.length ? attrs : ['']).forEach((pair, index) => {
        const parts = String(pair || '').split('|');
        const a = parts[0] || '';
        const v = parts.length > 1 ? parts[1] : '';
        caHtml += `\n          <div class=\"custom-attr-row d-flex align-items-center mb-2\" data-index=\"${index}\">\n            <input type=\"text\" class=\"form-control me-2 custom-attr-key\" placeholder=\"Attribute\" value=\"${escapeHtml(a)}\" style=\"max-width: 45%;\">\n            <input type=\"text\" class=\"form-control me-2 custom-attr-val\" placeholder=\"Value\" value=\"${escapeHtml(v)}\" style=\"max-width: 45%;\">\n            <button type=\"button\" class=\"btn btn-sm btn-outline-primary add-custom-attr-row me-1\" title=\"Add\"><i class=\"fas fa-plus\"></i></button>\n            <button type=\"button\" class=\"btn btn-sm btn-outline-danger remove-custom-attr-row\" title=\"Remove\"><i class=\"fas fa-minus\"></i></button>\n          </div>`;
      });
      caHtml += '</div>';
      inputHtml = caHtml;
      } else {
      inputHtml = `<div class=\"form-group\"><label class=\"form-label\">${labelText}</label><input type=\"text\" class=\"form-control\" name=\"${key}\" value=\"${escapeHtml(value)}\"></div>`;
      }

      html += inputHtml;

    });

    $('#fieldEditFields').html(html);
    $('#fieldEditModal').modal('show');
    $('#fieldEditModal').data('editingField', $field);

    // Add event handlers for dynamic choice option management
    $('#fieldEditModal').find('.add-choice-option-btn').on('click', function () {
      const fieldKey = $(this).data('field-key');
      const $modal = $('#fieldEditModal');
      const $field = $modal.data('editingField');
      const fieldType = $field.attr('data-field-type');
      const config = (window.FIELD_CONFIGS || {})[fieldType];
      const fieldData = getFieldData($field);

      // Get current options for this field
      let currentOptions = fieldData[fieldKey] || [];
      if (!Array.isArray(currentOptions)) {
      currentOptions = [];
      }

      const newIndex = currentOptions.length;
      const newOptionHtml = `
      <div class="choice-option-row d-flex align-items-center mb-2 p-2 border rounded" data-index="${newIndex}" style="background-color: #f8f9fa;">
      <div class="form-check me-2">
      <input class="form-check-input" type="checkbox" name="${fieldKey}[]" id="edit-${fieldKey}-${newIndex}" value="New Option">
      <label class="form-check-label" for="edit-${fieldKey}-${newIndex}"></label>
      </div>
      <input type="text" class="form-control me-2" value="New Option" placeholder="Option text" style="flex: 1; min-width: 150px;">
      <button type="button" class="btn btn-sm btn-outline-danger remove-choice-option-btn" data-index="${newIndex}" title="Remove option">
      <i class="fas fa-minus"></i>
      </button>
      </div>
      `;

      // Insert the new option before the add button
      $(this).closest('.form-group').find('.choice-option-row').last().after(newOptionHtml);

      // Add event handler for the new remove button
      $(`#edit-${fieldKey}-${newIndex}`).closest('.choice-option-row').find('.remove-choice-option-btn').on('click', function () {
      $(this).closest('.choice-option-row').remove();
      });

      // Add event handler for text input changes
      $(`#edit-${fieldKey}-${newIndex}`).closest('.choice-option-row').find('input[type="text"]').on('input', function () {
      const newValue = $(this).val();
      const checkbox = $(this).siblings('.form-check').find('input[type="checkbox"]');
      checkbox.val(newValue);
      });
    });

    // Add event handlers for existing remove buttons
    $('#fieldEditModal').find('.remove-choice-option-btn').on('click', function () {
      $(this).closest('.choice-option-row').remove();
    });

    // Add event handlers for text input changes
    $('#fieldEditModal').find('.choice-option-row input[type="text"]').on('input', function () {
      const newValue = $(this).val();
      const checkbox = $(this).siblings('.form-check').find('input[type="checkbox"]');
      checkbox.val(newValue);
    });

    // Custom Attributes: add/remove row handlers
    $('#fieldEditModal').on('click', '.add-custom-attr-row', function () {
      const row = $(this).closest('.custom-attr-row');
      const newRow = row.clone();
      newRow.find('input').val('');
      row.after(newRow);
    });

    $('#fieldEditModal').on('click', '.remove-custom-attr-row', function () {
      const container = $(this).closest('.form-group');
      const rows = container.find('.custom-attr-row');
      if (rows.length > 1) {
      $(this).closest('.custom-attr-row').remove();
      } else {
      rows.first().find('input').val('');
      }
    });
    });

    // Apply config to field DOM
    function applyConfigToField($field, fieldType, data) {
    // Container class
    if (data.containerClass !== undefined) {
      const base = 'form-group';
      $field.attr('class', `${base} ${escapeHtml(data.containerClass)}`.trim());
    }

    // Heading
    if (fieldType === 'heading') {
      const level = (data.type || 'h1').toLowerCase();
      const text = data.text || data.label || 'Heading';
      const cls = data.cssClass || '';
      const current = $field.find('h1,h2,h3,h4,h5,h6').first();
      const newTag = `<${level} class="${escapeHtml(cls)}">${escapeHtml(text)}</${level}>`;
      if (current.length) current.replaceWith(newTag); else $field.prepend(newTag);
      return;
    }

    // Paragraph
    if (fieldType === 'paragraph') {
      const text = data.text || '';
      const cls = data.cssClass || '';
      const p = $field.find('p').first();
      p.text(text);
      p.attr('class', `${cls}`.trim());
      return;
    }

    // Generic input-based components
    const label = $field.find('label').first();
    const input = $field.find('input, textarea, select').first();
    if (label.length && data.label !== undefined) label.text(data.label);
    if (label.length && data.labelClass !== undefined) label.attr('class', data.labelClass);
    if (input.length && data.placeholder !== undefined) input.attr('placeholder', data.placeholder);
    if (input.length && data.predefinedValue !== undefined) input.val(data.predefinedValue);
    if (input.length && data.cssClass !== undefined) input.attr('class', `form-control ${data.cssClass}`.trim());
    if (input.length && data.required !== undefined) input.prop('required', !!data.required);
    if (input.length && data.readOnly !== undefined) input.prop('readonly', !!data.readOnly);
    if (input.length && data.disabled !== undefined) input.prop('disabled', !!data.disabled);
    if (input.length && data.min !== undefined) input.attr('min', data.min);
    if (input.length && data.max !== undefined) input.attr('max', data.max);
    if (input.length && data.minlength !== undefined) input.attr('minlength', data.minlength);
    if (input.length && data.maxlength !== undefined) input.attr('maxlength', data.maxlength);
    if (input.length && data.pattern !== undefined) input.attr('pattern', data.pattern);


    // Handle specific field types
    if (fieldType === 'selectlist') {
      if (data.options && Array.isArray(data.options)) {
      const select = $field.find('select').first();
      if (select.length) {
        select.empty();
        select.append('<option value="">Select an option</option>');
        data.options.forEach((option, index) => {
        // Handle the "|selected" format
        let optionText = option;
        let isSelected = false;

        if (typeof option === 'string' && option.includes('|selected')) {
          optionText = option.replace('|selected', '');
          isSelected = true;
        }

        const optionEl = $(`<option value="${escapeHtml(optionText)}" ${isSelected ? 'selected' : ''}>${escapeHtml(optionText)}</option>`);
        select.append(optionEl);
        });
      }
      }
    }

    if (fieldType === 'checkbox') {
      if (data.checkboxes && Array.isArray(data.checkboxes)) {
      const checkboxOptions = $field.find('.checkbox-options');
      if (checkboxOptions.length) {
        checkboxOptions.empty();
        const fieldId = $field.attr('data-field-id');

        // Display checkbox options on canvas (read-only)
        data.checkboxes.forEach((option, index) => {
        // Handle the "|selected" format
        let optionText = option;
        let isSelected = false;

        if (typeof option === 'string' && option.includes('|selected')) {
          optionText = option.replace('|selected', '');
          isSelected = true;
        }

        const checkboxId = `${fieldId}_option_${index}`;
        const checkboxHtml = `
      <div class="form-check">
      <input class="form-check-input" type="checkbox" id="${checkboxId}" name="checkboxes[]" value="${escapeHtml(optionText)}" ${isSelected ? 'checked' : ''}>
      <label class="form-check-label" for="${checkboxId}">${escapeHtml(optionText)}</label>
      </div>
      `;
        checkboxOptions.append(checkboxHtml);
        });
      }
      }
    }

    if (fieldType === 'radio') {
      if (data.radios && Array.isArray(data.radios)) {
      const radioOptions = $field.find('.radio-options');
      if (radioOptions.length) {
        radioOptions.empty();
        const fieldId = $field.attr('data-field-id');

        // Display radio options on canvas (read-only)
        data.radios.forEach((option, index) => {
        // Handle the "|selected" format
        let optionText = option;
        let isSelected = false;

        if (typeof option === 'string' && option.includes('|selected')) {
          optionText = option.replace('|selected', '');
          isSelected = true;
        }

        const radioId = `${fieldId}_option_${index}`;
        const radioHtml = `
      <div class="form-check">
      <input class="form-check-input" type="radio" name="radio-group-${fieldId}" id="${radioId}" value="${escapeHtml(optionText)}" ${isSelected ? 'checked' : ''}>
      <label class="form-check-label" for="${radioId}">${escapeHtml(optionText)}</label>
      </div>
      `;
        radioOptions.append(radioHtml);
        });
      }
      }
    }

    if (fieldType === 'file') {
      if (data.accept !== undefined) {
      const fileInput = $field.find('input[type="file"]').first();
      if (fileInput.length) {
        fileInput.attr('accept', data.accept);
      }
      }
      if (data.multiple !== undefined) {
      const fileInput = $field.find('input[type="file"]').first();
      if (fileInput.length) {
        fileInput.prop('multiple', !!data.multiple);
      }
      }
    }

    if (fieldType === 'nps') {
      if (data.min !== undefined || data.max !== undefined) {
      const rangeInput = $field.find('input[type="range"]').first();
      if (rangeInput.length) {
        if (data.min !== undefined) rangeInput.attr('min', data.min);
        if (data.max !== undefined) rangeInput.attr('max', data.max);
      }
      }
    }

    if (fieldType === 'matrix') {
      if (data.questions && Array.isArray(data.questions)) {
      const tbody = $field.find('tbody').first();
      if (tbody.length) {
        tbody.empty();
        data.questions.forEach((question, index) => {
        const row = $(`<tr><td>${escapeHtml(question)}</td></tr>`);
        for (let i = 1; i <= 5; i++) {
          row.append(`<td><input type="radio" name="q${index + 1}" value="${i}"></td>`);
        }
        tbody.append(row);
        });
      }
      }
    }

    if (fieldType === 'button') {
      if (data.text !== undefined) {
      const button = $field.find('button').first();
      if (button.length) {
        button.text(data.text);
      }
      }
      if (data.type !== undefined) {
      const button = $field.find('button').first();
      if (button.length) {
        button.attr('type', data.type);
      }
      }
      if (data.cssClass !== undefined) {
      const button = $field.find('button').first();
      if (button.length) {
        button.attr('class', `btn ${data.cssClass}`.trim());
      }
      }
    }
    }

    // On modal save, update field
    $('#saveFieldEditBtn').on('click', function () {
    const $modal = $('#fieldEditModal');
    const $field = $modal.data('editingField');
    const fieldType = $field.attr('data-field-type');
    const config = (window.FIELD_CONFIGS || {})[fieldType];
    if (!$field || !config) return;
    const formData = {};
    // Gather all values including checkboxes
    $('#fieldEditForm').find('input, textarea, select').each(function () {
      const $el = $(this);
      const name = $el.attr('name');
      if (!name) return;

      if ($el.attr('type') === 'checkbox') {
      // Handle choice type fields (checkboxes with array names)
      if (name.endsWith('[]')) {
        const baseName = name.replace('[]', '');
        if (!formData[baseName]) {
        formData[baseName] = [];
        }
        if ($el.prop('checked')) {
        formData[baseName].push($el.val());
        }
      } else {
        formData[name] = $el.prop('checked');
      }
      } else if ($el.attr('type') === 'radio') {
      // Handle radio buttons with array names
      if (name.endsWith('[]')) {
        const baseName = name.replace('[]', '');
        if (!formData[baseName]) {
        formData[baseName] = [];
        }
        if ($el.prop('checked')) {
        formData[baseName].push($el.val());
        }
      } else {
        formData[name] = $el.val();
      }
      } else {
      formData[name] = $el.val();
      }
    });

    // Special handling for dynamic choice options from modal
    if ($field) {
      const editingFieldType = $field.attr('data-field-type');

      // Collect choice options from the modal interface
      const modal = $('#fieldEditModal');
      const choiceFields = ['checkboxes', 'radios', 'options'];

      choiceFields.forEach(fieldKey => {
      if (modal.find(`[name="${fieldKey}[]"]`).length > 0) {
        const options = [];
        modal.find(`[name="${fieldKey}[]"]`).each(function () {
        const checkbox = $(this);
        const textInput = checkbox.closest('.choice-option-row').find('input[type="text"]');
        if (textInput.length) {
          let optionValue = textInput.val();
          if (checkbox.prop('checked')) {
          optionValue += '|selected';
          }
          options.push(optionValue);
        }
        });
        if (options.length > 0) {
        formData[fieldKey] = options;
        }
      }
      });

      // Collect customAttributes key|value pairs
      const customAttrs = [];
      modal.find('.custom-attr-row').each(function () {
      const key = ($(this).find('.custom-attr-key').val() || '').trim();
      const val = ($(this).find('.custom-attr-val').val() || '').trim();
      if (key || val) {
        customAttrs.push(`${key}|${val}`);
      }
      });
      if (customAttrs.length > 0) {
      formData.customAttributes = customAttrs;
      }
    }

    setFieldData($field, formData);
    applyConfigToField($field, fieldType, formData);
    $modal.modal('hide');
    updateCodePreview();
    });

    // Delete field functionality
    $('#deleteFieldBtn').on('click', function () {
    const $modal = $('#fieldEditModal');
    const $field = $modal.data('editingField');
    if (!$field) return;

    // Create a custom confirmation dialog
    const confirmDelete = confirm('Are you sure you want to delete this field? This action cannot be undone.');
    if (confirmDelete) {
      $field.remove();
      $modal.modal('hide');
      updateCodePreview();
      showToast('Success', 'Field deleted successfully!');
    }
    });

    // Copy field functionality
    $('#copyFieldBtn').on('click', function () {
    copyCurrentField();
    });

    // Function to copy current field
    function copyCurrentField() {
    const $modal = $('#fieldEditModal');
    const $field = $modal.data('editingField');
    if (!$field) return;

    const fieldType = $field.attr('data-field-type');
    const fieldData = getFieldData($field);
    const fieldId = 'field_' + Date.now();

    try {
      // Create a copy of the field
      const $fieldCopy = $field.clone();
      $fieldCopy.attr('data-field-id', fieldId);

      // Update any IDs in the copied field to avoid conflicts
      $fieldCopy.find('[id]').each(function () {
      const oldId = $(this).attr('id');
      if (oldId) {
        const newId = oldId + '_' + Date.now();
        $(this).attr('id', newId);
        // Update corresponding label for attribute if it exists
        const label = $fieldCopy.find(`label[for="${oldId}"]`);
        if (label.length) {
        label.attr('for', newId);
        }
      }
      });

      // Set the field data for the copy
      setFieldData($fieldCopy, fieldData);

      // Add the copied field to the canvas after the original
      $field.after($fieldCopy);

      // Close the modal
      $modal.modal('hide');

      // Update code preview
      updateCodePreview();

      // Show success message
      showToast('Success', 'Field copied successfully!');

      // Highlight the copied field briefly
      $fieldCopy.addClass('highlight-copied');
      setTimeout(() => {
      $fieldCopy.removeClass('highlight-copied');
      }, 2000);

    } catch (error) {
      console.error('Error copying field:', error);
      showToast('Error', 'Failed to copy field. Please try again.');
    }
    }

    // Function to delete current field
    function deleteCurrentField() {
    const $modal = $('#fieldEditModal');
    const $field = $modal.data('editingField');
    if (!$field) return;

    // Create a custom confirmation dialog
    const confirmDelete = confirm('Are you sure you want to delete this field? This action cannot be undone.');
    if (confirmDelete) {
      $field.remove();
      $modal.modal('hide');
      updateCodePreview();
      showToast('Success', 'Field deleted successfully!');
    }
    }

    // Update delete button to use the function
    $('#deleteFieldBtn').on('click', function () {
    deleteCurrentField();
    });

    // Add keyboard shortcuts when modal is open
    $(document).on('keydown', function (e) {
    // Only work when field edit modal is open
    if ($('#fieldEditModal').hasClass('show')) {
      // Ctrl+C or Cmd+C to copy
      if ((e.ctrlKey || e.metaKey) && e.key === 'c') {
      e.preventDefault();
      copyCurrentField();
      }
      // Delete key to delete
      if (e.key === 'Delete') {
      e.preventDefault();
      deleteCurrentField();
      }
      // Escape to close modal
      if (e.key === 'Escape') {
      $('#fieldEditModal').modal('hide');
      }
    }
    });


    let currentLayout = $('#form-layout').val() || 'Vertical'; // initial

    $('#canvas').on('drop', function (e) {
    e.preventDefault();
    $(this).removeClass('drag-over');

    const fieldType = e.originalEvent.dataTransfer.getData('field-type');
    const fieldId = 'field_' + Date.now();
    const fieldHtml = getFieldHtml(fieldType, fieldId);

    const $fieldElement = $(`
    <div class="form-group" data-field-id="${fieldId}" data-field-type="${fieldType}">
      ${fieldHtml}
    </div>
    `);

    // Set default data from dynamic config
    const defaultsConfig = (window.FIELD_CONFIGS || {})[fieldType] || {};
    const defaults = {};
    Object.entries(defaultsConfig).forEach(([k, v]) => {
      if (k === 'id') return; // do not expose raw id in defaults
      if (v.type === 'select') {
      defaults[k] = getSelectedOptionValue(v.value);
      } else if (v.type === 'choice') {
      defaults[k] = v.value; // raw array for choice fields
      } else {
      defaults[k] = v.value;
      }
    });

    setFieldData($fieldElement, defaults);
    applyConfigToField($fieldElement, fieldType, defaults);

    // Apply current layout rules to the *new* field
    const $label = $fieldElement.find('label').first();

    if (currentLayout === 'Horizontal') {
      $fieldElement.addClass('row');
      if ($label.length) {
      $label.removeClass(function (index, className) {
        return (className.match(/(^|\s)col-\S+/g) || []).join(' ');
      });
      $label.addClass('col-3 col-form-label');

      const $controls = $fieldElement.children().not('label');
      const $wrapper = $('<div class="col col-wrapper"></div>');
      $controls.wrapAll($wrapper);
      }
    } else if (currentLayout === 'Vertical') {
      if ($label.length) {
      $label.removeClass(function (index, className) {
        return (className.match(/(^|\s)col-\S+/g) || []).join(' ');
      });
      $label.addClass('form-label');
      }
    }

    // Add to form
    $('#my-form').append($fieldElement);
    // ✅ Check disable state dynamically
    let disable = $('#disable-elements').prop('checked');
    disableAllFormControls(disable);



    updateCodePreview();
    });



    // Remove field from canvas
    $(document).on('click', '.remove-field-btn', function () {
    $(this).closest('[data-field-id]').remove();
    updateCodePreview();
    });


    $(function () {
    // Hide loader and show builder
    $('#ef-loading').hide();
    $('#ef-widgets, #ef-main, #ef-styles').removeClass('d-none');

    // Initialize canvas heading from Settings form name
    const nameInput = document.getElementById('form-name');
    const canvasTitle = document.getElementById('canvas-title');
    if (nameInput && canvasTitle) {
      const syncTitle = () => {
      canvasTitle.textContent = nameInput.value && nameInput.value.trim() ? nameInput.value : 'Untitled Form';
      updateCodePreview();
      };
      nameInput.addEventListener('input', syncTitle);
      syncTitle();
    } else {
      updateCodePreview();
    }

    // Add event listener for copy button
    $('#copy-code-btn').on('click', function (e) { e.preventDefault(); copyCodeToClipboard(); });

    // Re-highlight when switching to code tab
    document.querySelectorAll('a[href="#tab-code"]').forEach(function (el) {
      el.addEventListener('shown.bs.tab', function () { updateCodePreview(); });
    });

    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


    function getFieldData($field) {
    let type = $field.data('field-type');
    let props = {};

    if (type === 'heading') {
        props.text = $field.find('h1, h2, h3').text().trim();
    } 
    else if (type === 'paragraph') {
        props.text = $field.find('p').text().trim();
    } 
    else {
        // For inputs, selects, etc.
        props.label = $field.find('label').text().trim();
        props.name = $field.find('input, select, textarea').attr('name');
        props.value = $field.find('input, select, textarea').val();
    }

    return props;
}


  $('#save-form-btn').on('click', function () {
    const $btn = $(this);
    const form = $('#form-form')[0] || $('<form></form>')[0]; // just in case
    const formData = new FormData(form);

    // 1️⃣ Get the fields from the canvas
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

    // 2️⃣ Get full HTML preview from canvas
    let previewHtml = $('#canvas').html();
    formData.append('html', previewHtml);

    // 3️⃣ Get builder/settings data from the settings tab
    let builderSettings = {
        form_name: $('#form-name').val(),
        form_layout: $('#form-layout').val(),
        disable_elements: $('#disable-elements').is(':checked')
    };
    formData.append('builder', JSON.stringify(builderSettings));

    // 4️⃣ Also store height of the preview
    let height = $('#canvas').outerHeight();
    formData.append('height', height);

    // 5️⃣ Also add name for the Form table
    formData.append('name', $('#form-name').val());

    // Disable button while saving
    $btn.prop('disabled', true);
    $('input, select').removeClass('is-invalid');
    $('.invalid-feedback').remove();

    // 6️⃣ Send AJAX request
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

    function showToast(status, message) {
      $('#toast-status').text(status + ': ');
      $('#toast-message').text(message);
      const toastEl = new bootstrap.Toast($('#toast'));
      toastEl.show();
    }
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/create.blade.php ENDPATH**/ ?>