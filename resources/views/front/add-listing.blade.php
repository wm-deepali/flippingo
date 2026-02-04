@extends('layouts.new-master')

@section('title')
    {{ $page->meta_title ?? 'Flippingo' }}
@endsection

<style>
    #dynamicFormContainer {
        min-height: 120px;
        /* Or as needed */
    }
</style>

@section('content')
    <!-- ================================
                                                                                                START BREADCRUMB AREA
                                                                                            ================================= -->
    <section class="breadcrumb-area bread-bg">
        <div class="overlay"></div>
        <!-- end overlay -->
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="sec__title text-white mb-3">Add Listing</h2>
                <ul class="bread-list">
                    <li><a href="{{ Route('home') }}">home</a></li>
                    <li>listing</li>
                    <li>Add Listing</li>
                </ul>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
        <div class="bread-svg">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
            </svg>
        </div>
        <!-- end bread-svg -->
    </section>
    <!-- end breadcrumb-area -->
    <!-- ================================
                                                                                                END BREADCRUMB AREA
                                                                                            ================================= -->

    <!-- ================================
                                                                                                START ADD-LISTING AREA
                                                                                            ================================= -->
    <section class="add-listing-area padding-top-60px padding-bottom-90px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">

                    <!-- Add more top margin to the select -->


                    <select class="select-picker form-control" id="categorySelect" style="width: 100%;">
                        <option value="">Select Category</option>
                        @foreach($categories as $index => $category)
                            <option value="{{ $category->id }}" data-form-id="{{ $category->form ? $category->form->id : '' }}"
                                @if ($index === 0) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="card shadow mt-4">
                        <input type="hidden" name="price_currency" id="price_currency" value="INR">
                        <div id="dynamicFormContainer" class="card-body">
                            <!-- Optionally, add a message here -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>


        $(document).ready(function () {
            const select = $('#categorySelect');

            // Load form on selection change
            select.on('change', function () {
                const selected = $(this).find('option:selected');
                const formId = selected.data('form-id');
                loadForm(formId);
            });

            // Load initially selected form on page load
            const initialFormId = select.find('option:selected').data('form-id');
            if (initialFormId) {
                loadForm(initialFormId);
            }

            // Handle form submission via AJAX
            $(document).on('submit', '#my-form', function (e) {
                e.preventDefault();
                const form = $(this);
                const formData = new FormData(this);

                // ✅ SAFE COUNTRY CHECK
                const $countrySelect = $('#dynamicFormContainer').find('select[name="country"]');

                if ($countrySelect.length > 0) {
                    let countryValue = $countrySelect.val();

                    // fallback if empty
                    if (!countryValue) {
                        countryValue = 'India';
                    }

                    formData.append('country', countryValue);
                }
                // else → country field does NOT exist → do nothing

                // Get selected form id from the category select
                var selected = $('#categorySelect').find('option:selected');
                var formId = selected.data('form-id');

                // Append formId to FormData
                formData.append('form_id', formId);

                // const actionUrl = form.attr('action') || '/listing/store';
                const method = form.attr('method') || 'POST';
                const Url = "{{ route('listing.store') }}";


                fetch(Url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Form submitted successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        form[0].reset();
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error submitting the form.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        console.error(error);
                    });
            });
        });
        function loadForm(formId) {
            const container = $('#dynamicFormContainer');
            if (!formId) {
                container.html('<p>No form available.</p>');
                return;
            }

            container.html('Loading...');

            // Blade will render something like "/forms/"
            const baseUrl = "{{ route('forms', ['id' => 'FORM_ID']) }}".replace('FORM_ID', formId);

            fetch(baseUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Network error fetching form.');
                    return response.json(); // make sure your controller returns JSON
                })
                .then(data => {
                    if (data.success && data.html.trim()) {
                        container.html(data.html);

                        // =============================
                        // After loading the form, handle offered_price visibility
                        // =============================
                        const urgentSale = $('#urgent_sale').val(); // get current value
                        if (urgentSale === 'Yes') {
                            $('#offered_price').closest('.form-group').show();
                        } else {
                            $('#offered_price').closest('.form-group').hide();
                        }

                        // Also bind change event for future updates
                        $(document).on('change', '#urgent_sale', function () {
                            if ($(this).val() === 'Yes') {
                                $('#offered_price').closest('.form-group').show();
                            } else {
                                $('#offered_price').closest('.form-group').hide();
                            }
                        });

                        // Initialize cascading dropdowns
                        initializeCascadingDropdowns(data.fields);

                    } else {
                        container.html('<p>No form available.</p>');
                    }
                })
                .catch(err => {
                    container.html(`<p class="text-danger">${err.message}</p>`);
                    console.error(err);
                });

        }


        $(document).ready(function () {
            // Function to update visibility
            function toggleOfferedPrice() {
                const val = $('#urgent_sale').val();
                if (val === 'Yes') {
                    $('#offered_price').closest('.form-group').show();
                } else {
                    $('#offered_price').closest('.form-group').hide();
                }
            }

            // Run on change
            $(document).on('change', '#urgent_sale', function () {
                toggleOfferedPrice();
            });

            // Run immediately after form is loaded dynamically
            $(document).on('DOMNodeInserted', '#dynamicFormContainer', function () {
                toggleOfferedPrice();
            });
        });

        // Initialize cascading dropdown functionality
        function initializeCascadingDropdowns(formData) {
            const cascadingFields = [];

            let fields = [];
            if (Array.isArray(formData)) {
                fields = formData;
            } else if (formData && Array.isArray(formData.fields)) {
                fields = formData.fields;
            }

            if (Array.isArray(fields)) {
                fields.forEach(field => {
                    if (field.type === 'cascadingDropdown' && field.properties) {
                        cascadingFields.push({
                            fieldId: field.id,
                            properties: field.properties
                        });
                    }
                });
            }

            cascadingFields.forEach(field => {
                const parentDropdown = $(`.parent-dropdown[name="${field.fieldId}"]`);
                const childDropdown = $(`.child-dropdown[name="${field.fieldId}_child"]`);
                const parentOptions = [...(field.properties.parentOptions || [])];

                // Add "Other" option if enabled
                if (field.properties.enableParentOther) {
                    parentOptions.push("Other");
                }

                parentDropdown.empty();
                childDropdown.empty();

                // Default parent option placeholder
                parentDropdown.append($('<option>', { value: '', text: field.properties.placeholder || 'Select an option' }));

                // Populate parent options with "Other"
                parentOptions.forEach(option => {
                    parentDropdown.append($('<option>', { value: option, text: option }));
                });

                // Default child dropdown option
                childDropdown.append($('<option>', { value: '', text: 'Select a child' }));

                // Hide child dropdown initially
                childDropdown.closest('.form-group, .form-control, div').hide();

                parentDropdown.off('change.cascading').on('change.cascading', function () {
                    const selectedParent = $(this).val();

                    // Remove any existing custom input
                    $(`#parent-other-group-${field.fieldId}`).remove();

                    if (field.properties.enableParentOther && selectedParent === "Other") {
                        // Hide child dropdown
                        childDropdown.closest('.form-group, .form-control, div').hide();

                        // Add input field for child value
                        if (!$(`#parent-other-input-${field.fieldId}`).length) {
                            const inputHtml = `<input type="text" class="form-control" id="parent-other-input-${field.fieldId}" name="${field.fieldId}_child_custom" placeholder="Enter your option">`;
                            childDropdown.closest('.form-group, .form-control, div').after(`<div class="form-group mt-2" id="parent-other-group-${field.fieldId}">${inputHtml}</div>`);
                        }
                    } else if (selectedParent && field.properties.parentChildMapping[selectedParent]) {
                        // Show and populate child dropdown based on mapping
                        childDropdown.empty();
                        childDropdown.append($('<option>', { value: '', text: 'Select a child' }));

                        const childOptions = field.properties.parentChildMapping[selectedParent];
                        childOptions.forEach(option => {
                            childDropdown.append($('<option>', { value: option, text: option }));
                        });

                        childDropdown.closest('.form-group, .form-control, div').show();
                    } else {
                        // Hide child dropdown, remove custom input
                        childDropdown.closest('.form-group, .form-control, div').hide();
                    }
                });
            });
        }

    </script>


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

                const fieldId = canvas.id.split('_')[1]; // e.g. for 'signature_123', gets '123'

                // Wire up Clear button
                const clearBtn = document.getElementById('clear_signature_field_' + fieldId);

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

    <script>
        $(document).ready(function () {
            // Event delegation for dynamically loaded form
            $(document).on('change', 'select[name="urgent_sale"]', function () {
                const value = $(this).val(); // get selected value
                const $offeredPriceField = $('#offered_price_field'); // the field wrapper div

                if (value === 'yes') {
                    $offeredPriceField.show();
                } else {
                    $offeredPriceField.hide();
                }
            });

            // Optional: hide initially if urgent_sale is not yes
            $(document).on('DOMSubtreeModified', '#dynamicFormContainer', function () {
                const $select = $(this).find('select[name="urgent_sale"]');
                const $offeredPriceField = $(this).find('#offered_price_field');

                if ($select.length && $offeredPriceField.length) {
                    if ($select.val() === 'yes') {
                        $offeredPriceField.show();
                    } else {
                        $offeredPriceField.hide();
                    }
                }
            });
        });
    </script>
    <script>
        function updatePriceCurrency() {
            const $countrySelect = $('#dynamicFormContainer').find('select[name="country"]');
            const country = $countrySelect.length ? $countrySelect.val() : '229';

            const isIndia = country === '229' || country === '';

            const currency = isIndia ? 'INR' : 'USD';
            const symbol = isIndia ? '₹' : '$';

            // Update hidden currency field
            $('#price_currency').val(currency);

            // =========================
            // PRICE (MRP)
            // =========================
            const $mrpInput = $('#dynamicFormContainer').find('input[name="mrp"]');
            if ($mrpInput.length) {
                const $mrpWrapper = $mrpInput.closest('.form-group, .mb-3');
                const $mrpLabel = $mrpWrapper.find('label');

                $mrpLabel.html(`Price (${currency}) <span class="text-danger">*</span>`);
                $mrpInput.attr('placeholder', `Enter Price in ${currency}`);
            }

            // =========================
            // OFFERED PRICE
            // =========================
            const $offerInput = $('#dynamicFormContainer').find('input[name="offered_price"]');
            if ($offerInput.length) {
                const $offerWrapper = $offerInput.closest('.form-group, .mb-3');
                const $offerLabel = $offerWrapper.find('label');

                $offerLabel.text(`Demand Price (${currency})`);
                $offerInput.attr('placeholder', `Enter Demand Price in ${currency}`);
            }
        }

        // 🔁 Country change
        $(document).on('change', 'select[name="country"]', function () {
            updatePriceCurrency();
        });

        // 🔁 After dynamic form load
        $(document).on('DOMNodeInserted', '#dynamicFormContainer', function () {
            updatePriceCurrency();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection