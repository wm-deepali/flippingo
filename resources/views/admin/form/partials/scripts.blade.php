<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-markup.min.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function () {

        Promise.all([
            fetch('{{ asset('data/css-rules.json') }}').then(r => r.json()),
            fetch('{{ asset('data/css-properties.json') }}').then(r => r.json())
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

    function applyLayoutToForm(layout) {
        const $form = $('#my-form');

        $form.find('.form-group').each(function () {
            const $group = $(this);
            const $label = $group.find('label').first();

            // Remove all bootstrap grid classes from label
            $label.removeClass(function (index, className) {
                return (className.match(/(^|\s)col-\S+/g) || []).join(' ');
            });

            // If there's a col-wrapper from Horizontal mode, unwrap it
            const $colWrapper = $group.find('.col-wrapper');
            if ($colWrapper.length) {
                $colWrapper.children().unwrap();
            }

            // Remove row class from group
            $group.removeClass('row');
            $label.removeClass('visually-hidden');

            if (layout === 'Horizontal') {
                $group.addClass('row');
                if ($label.length) {
                    $label.addClass('col-3 col-form-label');
                    const $controls = $group.children().not('label');
                    const $wrapper = $('<div class="col col-wrapper"></div>');
                    $controls.wrapAll($wrapper);
                }
            }
            else if (layout === 'Vertical') {
                if ($label.length) {
                    $label.removeClass('visually-hidden').addClass('form-label');
                }
            }
            else if (layout === 'Inline') {
                // ✅ Just hide all labels visually
                if ($label.length) {
                    $label.addClass('visually-hidden'); // Bootstrap 5 accessible hiding
                }
            }
        });
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


    // Fetch phrases from backend to translate label keys
    $.getJSON("{{ route('admin.ajax.builder.phrases') }}", function (data) {
        console.log('BUILDER_PHRASES', data.phrases);

        BUILDER_PHRASES = data.phrases || {};
        window.BUILDER_PHRASES = BUILDER_PHRASES;
    });

    // fetch component configs
    $.getJSON("{{ route('admin.ajax.builder.components') }}", function (components) {
        const $fieldsWrapper = $('#tab-fields .fields-wrapper');
        $fieldsWrapper.empty();

        components.forEach(function (field) {
            const iconClass = getIconForField(field.name);
            const title = humanizeLabelKey(field.title || field.name);
            $fieldsWrapper.append(`
  <div class="builder-item col-6 p-2 border rounded" draggable="true" data-type="${field.name}">
    <i class="${iconClass} me-2"></i>
    <span>${field.name}</span>
  </div>
  `);
        });


        FIELD_CONFIGS = components.reduce((acc, comp) => {
            acc[comp.name] = comp.fields || {};
            return acc;
        }, {});
        window.FIELD_CONFIGS = FIELD_CONFIGS;

        updateCodePreview();
    });




    // Helper to convert keys like "component.predefinedValue" to "Predefined Value"
    function humanizeLabelKey(key) {
        if (!key) return '';
        if (window.BUILDER_PHRASES && window.BUILDER_PHRASES[key]) return window.BUILDER_PHRASES[key];
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
            radio: 'fas fa-dot-circle',
            selectlist: 'fas fa-list-alt',       // Select List
            hidden: 'fas fa-eye-slash',         // Hidden Field
            file: 'fas fa-upload',               // File Upload
            snippet: 'fas fa-code',              // Snippet
            recaptcha: 'fas fa-shield-alt',      // reCaptcha
            pagebreak: 'fas fa-file',            // Page Break
            spacer: 'fas fa-arrows-alt-v',       // Spacer
            // Net Promoter Score
            matrix: 'fas fa-th',                 // Matrix Field
            signature: 'fas fa-pen-nib',         // Signature
            submit: 'fas fa-check',              // Submit
            checkboxes: 'fas fa-check-double',   // Checkboxes (if needed!)
        };
        return icons[type.toLowerCase()] || '';
    }


    function generateHTMLCode() {
        const form = document.getElementById('my-form');
        if (!form) return '';

        // Clone the form to avoid modifying the original
        const formClone = form.cloneNode(true);

        // Remove internal builder data attributes, classes etc.
        formClone.querySelectorAll('[data-field-id], [data-field-type]').forEach(el => {
            el.removeAttribute('data-field-id');
            el.removeAttribute('data-field-type');
            // Remove any builder-specific classes you don't want in final output
            el.classList.remove('highlight-copied', 'row', 'some-other-builder-class');
        });

        // For each input/select/textarea, ensure properties like checked, disabled, readonly, selected are reflected as attributes
        formClone.querySelectorAll('input, select, textarea').forEach(el => {
            if (el.tagName.toLowerCase() === 'input') {
                // For checkboxes and radios, sync checked state attribute
                if (el.type === 'checkbox' || el.type === 'radio') {
                    if (el.checked) el.setAttribute('checked', '');
                    else el.removeAttribute('checked');
                } else {
                    el.setAttribute('value', el.value);
                }
                // Sync disabled, readonly state
                if (el.disabled) el.setAttribute('disabled', '');
                else el.removeAttribute('disabled');
                if (el.readOnly) el.setAttribute('readonly', '');
                else el.removeAttribute('readonly');
            } else if (el.tagName.toLowerCase() === 'select') {
                // Set selected attribute on options
                Array.from(el.options).forEach(option => {
                    if (option.selected) option.setAttribute('selected', '');
                    else option.removeAttribute('selected');
                });
                if (el.disabled) el.setAttribute('disabled', '');
                else el.removeAttribute('disabled');
            } else if (el.tagName.toLowerCase() === 'textarea') {
                // Set textarea content
                el.textContent = el.value;
                if (el.disabled) el.setAttribute('disabled', '');
                else el.removeAttribute('disabled');
                if (el.readOnly) el.setAttribute('readonly', '');
                else el.removeAttribute('readonly');
            }
        });

        // Return formatted HTML string of the cleaned clone outer HTML
        return formClone.outerHTML;
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
                // Render the page break container with configurable data attributes for button text
                return `
        <div class="page-break" 
             data-button-previous="Previous" 
             data-button-next="Next" 
             style="border: 2px dashed #ccc; margin: 20px 0;">
        </div>
    `;
            case 'spacer':
                return `<div class="spacer" style="height: 20px;"></div>`;
            case 'nps':
                const inputCount = 10;  // or dynamic
                let npsHtml = `<div class="answer-container"><table class="table table-nps"><tbody>`;

                npsHtml += `<tr>
  <td colspan="${inputCount}">
    <table class="table">
      <tr>
        <td class="text-start">Not at all likely</td>
        <td></td>
        <td class="text-end">Extremely likely</td>
      </tr>
    </table>
  </td>
</tr><tr>`;

                for (let i = 1; i <= inputCount; i++) {
                    let inputId = `nps_${fieldId}_${i}`;
                    npsHtml += `<td class="answer-input">
     <input type="radio" name="nps_${fieldId}" id="${inputId}" value="${i}" class="form-check-input d-none"/>
     <label for="${inputId}" class="btn btn-primary btn-nps"><span>${i}</span></label>
  </td>`;
                }

                npsHtml += `</tr></tbody></table></div>`;

                return npsHtml;
            case 'matrix':
                let questions = ["First Question", "Second Question", "Third Question"];
                let answers = ["Answer A", "Answer B", "Answer C"];
                let labelText = "Answer the following questions";
                let tableClass = "table table-striped table-hover";
                let containerClass = "col-12";

                let html = `
    <div class="${containerClass}">
      <div class="form-group">
      <label for="matrix_${fieldId}" class="form-label">${labelText}</label>
        <table id="matrix_${fieldId}" class="table-matrix ${tableClass}" data-matrix-type="radio">
          <caption>
          </caption>
          <thead>
            <tr>
              <th>&nbsp;</th>`;

                answers.forEach(answer => {
                    html += `<th class="text-center">${answer}</th>`;
                });

                html += `</tr>
          </thead>
          <tbody>`;

                questions.forEach((question, qIndex) => {
                    html += `<tr>
      <th><label for="matrix_${fieldId}_${qIndex}">${question}</label></th>`;

                    answers.forEach((answer, aIndex) => {
                        const inputId = `matrix_${fieldId}_${qIndex}_${aIndex}`;
                        const inputName = `matrix_${fieldId}_${qIndex}`;

                        html += `<td class="text-center matrix_${fieldId}_q_${qIndex} matrix_${fieldId}_a_${aIndex}" title="${answer}">
        <div class="radio">
          <input class="form-check-input" type="radio" name="${inputName}" id="${inputId}" value="${answer}">
          <label for="${inputId}"></label>
        </div>
      </td>`;
                    });

                    html += `</tr>`;
                });

                html += `</tbody></table></div></div>`;

                return html;


            case 'signature':
                return `
            <label class="form-label" for="signature_${fieldId}">Signature</label>
            <div class="signature-pad">
                <canvas id="signature_${fieldId}" width="400" height="200" data-color="black"></canvas>
            </div>
            <div class="signature-pad-actions">
                <button type="button" id="clear_signature_${fieldId}" name="clear_signature_${fieldId}" class="btn btn-sm btn-default btn-clear" data-exclude="true">Clear</button>
                <button type="button" id="undo_signature_${fieldId}" name="undo_signature_${fieldId}" class="btn btn-sm btn-default btn-undo" data-exclude="true">Undo</button>
            </div>
            <input type="text" style="display:none" name="hidden_signature_${fieldId}" id="hidden_signature_${fieldId}" value="" data-alias="" data-label="Signature">
            `;

            case 'button':
                return `<button type="submit" class="btn btn-primary">Submit</button>`;
            default:
                return `<span class="field-text">${fieldType} field</span>`;
        }
    }


    function initSignaturePad(fieldId) {
        // Example using SignaturePad library
        const canvas = document.getElementById('signature_' + fieldId);
        if (!canvas) return;

        const signaturePad = new SignaturePad(canvas);

        // Wire up clear and undo buttons
        document.getElementById('clear_signature_' + fieldId).addEventListener('click', () => {
            signaturePad.clear();
            document.getElementById('hidden_signature_' + fieldId).value = '';
        });

        document.getElementById('undo_signature_' + fieldId).addEventListener('click', () => {
            const data = signaturePad.toData();
            if (data) {
                data.pop(); // remove last stroke
                signaturePad.fromData(data);
                // You could update hidden input accordingly here as well
            }
        });

        // Save signature data to hidden input on end
        canvas.addEventListener('mouseup', () => {
            if (!signaturePad.isEmpty()) {
                document.getElementById('hidden_signature_' + fieldId).value = signaturePad.toDataURL();
            }
        });

        // Save on touch end for mobile
        canvas.addEventListener('touchend', () => {
            if (!signaturePad.isEmpty()) {
                document.getElementById('hidden_signature_' + fieldId).value = signaturePad.toDataURL();
            }
        });
    }


    document.addEventListener('DOMContentLoaded', function () {
        let dragged = null;
        let $reorderPlaceholder = $('<div class="reorder-placeholder"></div>');
        let $newFieldPlaceholder = $('<div class="drop-placeholder"></div>');

        // ===== 1. REORDER EXISTING FIELDS =====
        $('#my-form').on('mouseenter', '.form-group', function () {
            $(this).attr('draggable', true);
        });

        $('#my-form').on('dragstart', '.form-group', function (e) {
            dragged = $(this);
            e.originalEvent.dataTransfer.effectAllowed = 'move';
            e.originalEvent.dataTransfer.setData('drag-type', 'reorder');
            dragged.addClass('dragging');
        });

        $('#my-form').on('dragover', '.form-group', function (e) {
            e.preventDefault();
            if (!dragged) return;

            const $this = $(this);
            const mouseY = e.originalEvent.pageY;
            const mid = $this.offset().top + $this.outerHeight() / 2;

            $reorderPlaceholder.detach();
            $newFieldPlaceholder.detach();
            if (mouseY < mid) {
                $reorderPlaceholder.insertBefore($this);
            } else {
                $reorderPlaceholder.insertAfter($this);
            }
        });

        $('#my-form').on('drop', function (e) {
            e.preventDefault();
            const dragType = e.originalEvent.dataTransfer.getData('drag-type');
            if (dragType === 'reorder' && dragged) {
                $reorderPlaceholder.replaceWith(dragged);
                $newFieldPlaceholder.detach();
                dragged.removeClass('dragging');
                dragged = null;
                updateCodePreview();
            }
        });

        $('#my-form').on('dragend', '.form-group', function () {
            if (dragged) dragged.removeClass('dragging');
            dragged = null;
            $reorderPlaceholder.detach();
            $newFieldPlaceholder.detach();
        });

        // ===== 2. ADD NEW FIELDS =====
        $(document).on('dragstart', '.builder-item', function (e) {
            e.originalEvent.dataTransfer.setData('drag-type', 'new-field');
            e.originalEvent.dataTransfer.setData('field-type', $(this).data('type'));
            $(this).addClass('dragging');
        });

        $(document).on('dragend', '.builder-item', function () {
            $(this).removeClass('dragging');
            $newFieldPlaceholder.detach();
        });

        $('#canvas').on('dragover', function (e) {
            e.preventDefault();
            const mouseY = e.originalEvent.pageY - $(this).offset().top;
            let $closest = null;
            let insertBefore = false;

            $('#my-form .form-group').each(function () {
                const $el = $(this);
                const mid = $el.position().top + $el.outerHeight() / 2;
                if (Math.abs(mouseY - mid) < Math.abs(mouseY - ($closest ? $closest.position().top + $closest.outerHeight() / 2 : Infinity))) {
                    $closest = $el;
                    insertBefore = mouseY < mid;
                }
            });

            $newFieldPlaceholder.detach();
            if ($closest) {
                if (insertBefore) $newFieldPlaceholder.insertBefore($closest);
                else $newFieldPlaceholder.insertAfter($closest);
            } else {
                $('#my-form').append($newFieldPlaceholder);
            }
        });

        $('#canvas').on('drop', function (e) {
            e.preventDefault();
            const dragType = e.originalEvent.dataTransfer.getData('drag-type');
            if (dragType !== 'new-field') return;

            const fieldType = e.originalEvent.dataTransfer.getData('field-type');
            const fieldId = generateSimpleFieldId(fieldType);
            const fieldHtml = getFieldHtml(fieldType, fieldId);

            const $fieldElement = $(`<div class="form-group" data-field-id="${fieldId}" data-field-type="${fieldType}">${fieldHtml}</div>`);
            const defaultsConfig = (window.FIELD_CONFIGS || {})[fieldType] || {};
            const defaults = {};
            Object.entries(defaultsConfig).forEach(([k, v]) => {
                if (k === 'id') return;
                defaults[k] = v.type === 'select' ? getSelectedOptionValue(v.value) : v.value;
            });

            setFieldData($fieldElement, defaults);
            applyConfigToField($fieldElement, fieldType, defaults, fieldId);
            if (fieldType === 'signature') initSignaturePad(fieldId);

            if ($newFieldPlaceholder.parent().length) $newFieldPlaceholder.replaceWith($fieldElement);
            else $('#my-form').append($fieldElement);

            updateCodePreview();
        });
    });

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

    const hiddenKeys = ['cssClass', 'labelClass', 'inputGroupClass', 'append', 'prepend', 'customAttributes', 'alias'];


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
        const isNonDeletable = $field.attr('data-non-deletable') === 'true';

        Object.entries(config).forEach(([key, conf]) => {
            if (key === 'id') return; // never show raw id in modal
            if (hiddenKeys.includes(key)) return; // skip showing in modal
            if (isNonDeletable && key === 'inputType') return;
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
            } else if (conf.type === 'choice' && !isNonDeletable) {
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



        // Show or hide Delete button based on 'data-non-deletable' attribute
        if ($field.attr('data-non-deletable') === 'true') {
            $('#deleteFieldBtn').hide();
            $('#copyFieldBtn').hide();
        } else {
            $('#deleteFieldBtn').show();
            $('#copyFieldBtn').show();
        }

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

    const criticalFields = ['product_title', 'mrp', 'urgent_sale', 'offered_price'];


    function applyConfigToField($field, fieldType, data, fieldId, config = {}) {

        if (data.containerClass && data.containerClass.trim() !== '') {
            $field.attr('class', `form-group ${escapeHtml(data.containerClass)}`.trim());
        }

        if (fieldType === 'heading') {
            const level = (data.type || 'h1').toLowerCase();
            const cls = data.cssClass || '';
            const text = data.text || data.label || 'Heading';
            const current = $field.find('h1,h2,h3,h4,h5,h6').first();
            const newTag = `<${level} class="${cls}">${text}</${level}>`;
            if (current.length) current.replaceWith(newTag);
            else $field.prepend(newTag);
            return;
        }
        if (fieldType === 'paragraph') {
            const cls = data.cssClass || '';
            const text = data.text || '';
            const p = $field.find('p').first();
            p.text(text);
            p.attr('class', cls.trim());
            return;
        }

        const $label = $field.find('label').first();
        const $input = $field.find('input, textarea, select').first();

        // Handle checkbox options
        if (fieldType === 'checkbox') {
            const $container = $field.find('.checkbox-options').first();
            if ($container.length && Array.isArray(data.checkboxes) && data.checkboxes.length > 0) {
                $container.empty();
                data.checkboxes.forEach((opt, idx) => {
                    const selected = typeof opt === 'string' && opt.includes('|selected');
                    const val = typeof opt === 'string' ? opt.replace('|selected', '') : opt;
                    const id = `${fieldId}_${idx}`;
                    $container.append(`
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="${escapeHtml(id)}" name="${fieldId}[]" value="${escapeHtml(val)}" ${selected ? 'checked' : ''}>
                        <label class="form-check-label" for="${escapeHtml(id)}">${escapeHtml(val)}</label>
                    </div>`);
                });
            }
        }

        // Handle radio options
        if (fieldType === 'radio') {
            const $container = $field.find('.radio-options').first();
            if ($container.length && Array.isArray(data.radios) && data.radios.length > 0) {
                $container.empty();
                data.radios.forEach((opt, idx) => {
                    const selected = typeof opt === 'string' && opt.includes('|selected');
                    const val = typeof opt === 'string' ? opt.replace('|selected', '') : opt;
                    const id = `${fieldId}_${idx}`;
                    $container.append(`
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="${escapeHtml(id)}" name="${fieldId}" value="${escapeHtml(val)}" ${selected ? 'checked' : ''}>
                        <label class="form-check-label" for="${escapeHtml(id)}">${escapeHtml(val)}</label>
                    </div>`);
                });
            }
        }



        // Early return if no $input and NOT checkbox/radio (because those have no direct input at root)
        if (!$input.length && fieldType !== 'checkbox' && fieldType !== 'radio') return;

        // Instead of using fieldType for critical check, use config.id (or alias)
        const configId = (config.id && config.id.value) || (config.alias && config.alias.value) || config.id || '';
        let inputId, inputName;

        if (criticalFields.includes(configId.toLowerCase()) || config.isCritical) {
            // Use fixed ID and name (backend expects these)
            inputId = configId.toLowerCase();
            inputName = configId.toLowerCase();
        } else {
            // Use dynamic ID for other fields
            inputId = fieldId;
            inputName = fieldId;
        }

        $input.attr('id', inputId);
        $input.attr('name', inputName);


        // Set label text and 'for' attribute accordingly, unchanged
        if ($label.length && typeof data.label === 'string' && data.label.trim() !== '') {
            $label.text(data.label);
            $label.attr('for', inputId);
            if (data.required) {
                $label.append(' ').append($('<span>').addClass('text-danger').text('*'));
            }
        } else if ($label.length) {
            $label.text('');
            $label.removeAttr('for');
        }

        if ($label.length && typeof data.labelClass === 'string' && data.labelClass.trim() !== '') {
            $label.attr('class', data.labelClass);
        }

        // Placeholder (only if non-empty)
        if (typeof data.placeholder === 'string' && data.placeholder.trim() !== '') {
            $input.attr('placeholder', data.placeholder);
        } else {
            $input.removeAttr('placeholder');
        }


        // Remove any existing help text element to avoid duplicates
        $field.find('.help-text, .form-text').remove();

        // Add help text if provided
        if (data.helpText && data.helpText.trim() !== '') {
            const helpTextEl = $('<small>').addClass('form-text text-muted help-text').text(data.helpText);

            // Determine placement: default below or 'above'
            if (data.helpTextPlacement && data.helpTextPlacement.toLowerCase() === 'above') {
                // Insert help text above input/label
                if ($field.find('label').length) {
                    $field.find('label').first().after(helpTextEl);
                } else {
                    $field.prepend(helpTextEl);
                }
            } else {
                // Default: insert help text below the input/control
                const $input = $field.find('input, select, textarea').last();
                if ($input.length) {
                    $input.after(helpTextEl);
                } else {
                    // Fallback: append to field
                    $field.append(helpTextEl);
                }
            }
        }

        // Predefined value (skip if null/undefined/empty string)
        if (data.predefinedValue != null && data.predefinedValue !== '') {
            if ($input.is('textarea')) {
                $input.text(data.predefinedValue);
            } else {
                $input.val(data.predefinedValue);
            }
        } else {
            if ($input.is('textarea')) {
                $input.text('');
            } else {
                $input.val('');
            }
        }

        // Apply CSS classes if present, else default class
        if (typeof data.cssClass === 'string' && data.cssClass.trim() !== '') {
            $input.attr('class', data.cssClass);
        } else {
            if (!$input.hasClass('form-control')) {
                $input.addClass('form-control');
            }
        }

        // Boolean attributes
        if (data.required) {
            $input.attr('required', 'required');
        } else {
            $input.removeAttr('required');
        }

        if (data.readOnly) {
            $input.attr('readonly', 'readonly');
        } else {
            $input.removeAttr('readonly');
        }

        if (data.disabled) {
            $input.attr('disabled', 'disabled');
        } else {
            $input.removeAttr('disabled');
        }

        let inputType = '';
        if ($input && $input.length) {
            inputType = $input.attr('type') || $input.prop('tagName').toLowerCase();
        } else {
            // Default fallback or leave blank; no single input element for checkboxes/radios
            inputType = '';
        }

        if ($input && $input.length && data.inputType) {
            $input.attr('type', data.inputType);
        }

        // Handle min, max, step for suitable input types
        const minMaxStepTypes = ['number', 'range', 'date', 'datetime-local', 'time', 'month', 'week'];
        if (minMaxStepTypes.includes(inputType)) {
            if (data.min != null && data.min !== '') {
                $input.attr('min', data.min);
            } else {
                $input.removeAttr('min');
            }
            if (data.max != null && data.max !== '') {
                $input.attr('max', data.max);
            } else {
                $input.removeAttr('max');
            }
            if (data.step != null && data.step !== '') {
                $input.attr('step', data.step);
            } else {
                $input.removeAttr('step');
            }
        } else {
            $input.removeAttr('min').removeAttr('max').removeAttr('step');
        }

        // Handle minlength, maxlength, pattern for text & related types
        const lengthPatternTypes = ['text', 'email', 'password', 'textarea', 'tel', 'url', 'search'];
        if (lengthPatternTypes.includes(inputType)) {
            if (data.minlength != null && data.minlength !== '') {
                $input.attr('minlength', data.minlength);
            } else {
                $input.removeAttr('minlength');
            }
            if (data.maxlength != null && data.maxlength !== '') {
                $input.attr('maxlength', data.maxlength);
            } else {
                $input.removeAttr('maxlength');
            }
            if (data.pattern != null && data.pattern !== '') {
                $input.attr('pattern', data.pattern);
            } else {
                $input.removeAttr('pattern');
            }
        } else {
            $input.removeAttr('minlength').removeAttr('maxlength').removeAttr('pattern');
        }

        // Handle selectlist options
        if (fieldType === 'selectlist' && Array.isArray(data.options) && data.options.length > 0) {
            const $select = $field.find('select').first();
            if ($select.length) {
                $select.empty().append('<option value="">Select an option</option>');
                data.options.forEach(opt => {
                    const selected = typeof opt === 'string' && opt.includes('|selected') ? 'selected' : '';
                    const val = typeof opt === 'string' ? opt.replace('|selected', '') : opt;
                    $select.append(`<option value="${escapeHtml(val)}" ${selected}>${escapeHtml(val)}</option>`);
                });
            }
        }

        // Setup for file input attributes
        if (fieldType === 'file') {
            const $fileInput = $field.find('input[type="file"]').first();
            if ($fileInput.length) {
                // Set accept attribute
                if (data.accept && data.accept.trim() !== '') {
                    $fileInput.attr('accept', data.accept);
                } else {
                    $fileInput.removeAttr('accept');
                }

                // Multiple files
                if (data.multiple === true || data.multiple === 'true') {
                    $fileInput.prop('multiple', true);

                    // Update name attribute to be an array: example: 'file_1[]'
                    let fileInputName = $fileInput.attr('name') || '';
                    if (!fileInputName.endsWith('[]')) {
                        fileInputName += '[]';
                    }
                    $fileInput.attr('name', fileInputName);
                } else {
                    $fileInput.prop('multiple', false);
                    // Remove [] if present
                    let fileInputName = $fileInput.attr('name') || '';
                    if (fileInputName.endsWith('[]')) {
                        fileInputName = fileInputName.slice(0, -2);
                    }
                    $fileInput.attr('name', fileInputName);
                }

                // Also set data attributes for validation (optional)
                if (data.minFiles) {
                    $fileInput.attr('data-min-files', data.minFiles);
                } else {
                    $fileInput.removeAttr('data-min-files');
                }
                if (data.maxFiles) {
                    $fileInput.attr('data-max-files', data.maxFiles);
                } else {
                    $fileInput.removeAttr('data-max-files');
                }
                if (data.minSize) {
                    $fileInput.attr('data-min-size', data.minSize);
                } else {
                    $fileInput.removeAttr('data-min-size');
                }
                if (data.maxSize) {
                    $fileInput.attr('data-max-size', data.maxSize);
                } else {
                    $fileInput.removeAttr('data-max-size');
                }
            }
        }


        // Setup NPS field properties
        if (fieldType === 'nps') {
            if (typeof data.question === 'string' && data.question.trim() !== '') {
                $field.find('label').first().text(data.question);
            }
            if (typeof data.buttonClass === 'string' && data.buttonClass.trim() !== '') {
                $field.find('label').first().attr('class', data.buttonClass);
            }
            const $range = $field.find('input[type="range"]').first();
            if ($range.length) {
                if (data.min != null && data.min !== '') {
                    $range.attr('min', data.min);
                } else {
                    $range.removeAttr('min');
                }
                if (data.max != null && data.max !== '') {
                    $range.attr('max', data.max);
                } else {
                    $range.removeAttr('max');
                }
            }
            if (data.value != null && data.value !== '') {
                $field.find(`input[value="${data.value}"]`).prop('checked', true);
            }
        }

        // Setup matrix field
        if (fieldType === 'matrix') {
            const $table = $field.find('table').first();
            if (!$table.length) return;

            $table.attr('id', `matrix_${fieldId}`);
            $table.attr('class', data.tableClass || "table table-striped table-hover");
            $table.attr('data-matrix-type', data.inputType || 'radio');

            const $captionLabel = $table.find('caption label').first();
            if ($captionLabel.length) {
                $captionLabel.text(data.label || 'Answer the following');
                if (data.labelClass && data.labelClass.trim() !== '') {
                    $captionLabel.attr('class', data.labelClass);
                }
            }

            let theadHtml = '<tr><th>&nbsp;</th>';
            (data.answers || []).forEach(answer => {
                theadHtml += `<th>${escapeHtml(answer)}</th>`;
            });
            theadHtml += '</tr>';
            $table.find('thead').html(theadHtml);

            const $tbody = $table.find('tbody').empty();
            (data.questions || []).forEach((question, qIdx) => {
                let rowHtml = `<tr><th><label for="matrix_${fieldId}_${qIdx}">${escapeHtml(question)}</label></th>`;
                (data.answers || []).forEach((answer, aIdx) => {
                    const inputName = `matrix_${fieldId}_${qIdx}`;
                    const inputId = `matrix_${fieldId}_${qIdx}_${aIdx}`;
                    rowHtml += `
                    <td><div class="${data.inputType || 'radio'}">
                        <input class="form-check-input" type="${data.inputType || 'radio'}" id="${escapeHtml(inputId)}" name="${escapeHtml(inputName)}" value="${escapeHtml(answer)}">
                        <label for="${escapeHtml(inputId)}"></label>
                    </div></td>`;
                });
                rowHtml += '</tr>';
                $tbody.append(rowHtml);
            });

            if (data.savedValues) {
                Object.entries(data.savedValues).forEach(([key, val]) => {
                    $table.find(`input[name="${escapeHtml(key)}"][value="${escapeHtml(val)}"]`).prop('checked', true);
                });
            }
        }

        // Button field setup
        if (fieldType === 'button') {
            const $btn = $field.find('button').first();
            if (!$btn.length) return;
            if (typeof data.buttonText === 'string' && data.buttonText.trim() !== '') {
                $btn.text(data.buttonText);
            } else if (typeof data.text === 'string' && data.text.trim() !== '') {
                $btn.text(data.text);
            } else {
                $btn.text('Button');
            }
            if (typeof data.inputType === 'string' && data.inputType.trim() !== '') {
                $btn.attr('type', data.inputType);
            } else if (typeof data.type === 'string' && data.type.trim() !== '') {
                $btn.attr('type', data.type);
            } else {
                $btn.attr('type', 'button');
            }
            if (typeof data.cssClass === 'string' && data.cssClass.trim() !== '') {
                $btn.attr('class', 'btn ' + data.cssClass);
            }
        }

        // Signature field setup
        if (fieldType === 'signature') {
            if ($label.length && typeof data.label === 'string' && data.label.trim() !== '') {
                $label.text(data.label);
            }
        }

        // Page break setup
        if (fieldType === 'pagebreak') {
            const $pageBreak = $field.find('.page-break').first();
            if (!$pageBreak.length) return;
            if (typeof data.prev === 'string' && data.prev.trim() !== '') {
                $pageBreak.attr('data-button-previous', data.prev);
            }
            if (typeof data.next === 'string' && data.next.trim() !== '') {
                $pageBreak.attr('data-button-next', data.next);
            }
        }

        // Spacer setup
        if (fieldType === 'spacer') {
            const $spacer = $field.find('.spacer').first();

            if ($spacer.length && !isNaN(parseFloat(data.height))) {
                $spacer.css('height', `${parseFloat(data.height)}px`);
            }
            if (data.containerClass && data.containerClass.trim() !== '') {
                $field.removeClass().addClass(`form-group ${data.containerClass}`);
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


        // SET THE VALUE FOR headings/paragraphs ONLY *AFTER* input parsing
        if (fieldType === 'heading' || fieldType === 'paragraph') {
            formData.text = $('#fieldEditForm').find('[name="text"]').val();
        }

        setFieldData($field, formData);
        const fieldId = $field.attr('data-field-id');
        applyConfigToField($field, fieldType, formData, fieldId);

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



    const fieldCounters = {};

    function updateFieldCountersFromExisting() {
        $('#my-form .form-group').each(function () {
            const id = $(this).attr('data-field-id');
            if (!id) return;

            const parts = id.split('_');
            if (parts.length < 2) return;

            const type = parts.slice(0, -1).join('_');
            const index = parseInt(parts[parts.length - 1], 10);

            if (!fieldCounters[type] || index > fieldCounters[type]) {
                fieldCounters[type] = index;
            }
        });
    }

    function generateSimpleFieldId(fieldType) {
        if (!fieldCounters[fieldType]) {
            fieldCounters[fieldType] = 1;
        } else {
            fieldCounters[fieldType]++;
        }
        return `${fieldType}_${fieldCounters[fieldType]}`;
    }



    // Function to copy current field
    function copyCurrentField() {
        const $modal = $('#fieldEditModal');
        const $field = $modal.data('editingField');
        if (!$field) return;

        const fieldType = $field.attr('data-field-type');
        const fieldData = getFieldData($field);

        try {
            // Create a copy of the field
            const fieldId = generateSimpleFieldId(fieldType); // New unique id for the copy

            const $fieldCopy = $field.clone();
            $fieldCopy.attr('data-field-id', fieldId);

            // Update all element IDs inside the copy to follow this new fieldId pattern
            $fieldCopy.find('[id]').each(function (index) {
                const $el = $(this);
                // Create a new ID based on the new fieldId plus index to keep uniqueness and consistency
                const newId = `${fieldId}`;
                const oldId = $el.attr('id');

                $el.attr('id', newId);

                // Update matching label's for attribute inside $fieldCopy accordingly
                const label = $fieldCopy.find(`label[for="${oldId}"]`);
                if (label.length) {
                    label.attr('for', newId);
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
            console.log(props, 'props');

            return props;
        }

        function showToast(status, message) {
            $('#toast-status').text(status + ': ');
            $('#toast-message').text(message);
            const toastEl = new bootstrap.Toast($('#toast'));
            toastEl.show();
        }
    });
</script>