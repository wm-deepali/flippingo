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

                // Get selected form id from the category select
                var selected = $('#categorySelect').find('option:selected');
                var formId = selected.data('form-id');

                // Append formId to FormData
                formData.append('form_id', formId);

                const actionUrl = form.attr('action') || '/listing/store';
                const method = form.attr('method') || 'POST';

                fetch(actionUrl, {
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
            fetch('/forms/' + formId)
                .then(response => {
                    if (!response.ok) throw new Error('Network error fetching form.');
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.html.trim()) {
                        container.html(data.html);
                    } else {
                        container.html('<p>No form available.</p>');
                    }
                })
                .catch(err => {
                    container.html(`<p class="text-danger">${err.message}</p>`);
                    console.error(err);
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

@endsection