@extends('layouts.master')

@section('content')

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
                  <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Manage Blogs</a></li>
                  <li class="breadcrumb-item active">Add New Blog</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="{{ route('admin.blogs.index') }}" class="btn-icon btn btn-secondary btn-round btn-sm">Back to
              Blogs</a>
          </div>
        </div>
      </div>
      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Add New Blog</h4>
              </div>
              <div class="card-body">
                <form id="blogForm" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">

                      <div class="form-group">
                        <label for="category_id">Blog Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                          <option value="" disabled selected>Select a category</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title"
                          required>
                      </div>

                      <div class="form-group">
                        <label for="slug_url">Slug URL</label>
                        <input type="text" class="form-control" id="slug_url" name="slug_url" placeholder="Enter slug URL"
                          required>
                      </div>

                      <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                          placeholder="Enter meta title" required>
                      </div>

                      <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                          placeholder="Enter meta keywords" required>
                      </div>

                      <div class="form-group">
                        <label for="thumbnail">Thumbnail Image</label>
                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*">
                        <small class="form-text text-muted">Maximum file size: 2MB</small>
                        <img id="thumbnail-preview" src="#" alt="Thumbnail Preview"
                          style="display:none; max-height: 150px; margin-top: 10px;">
                      </div>

                      <div class="form-group">
                        <label for="banner">Banner Image</label>
                        <input type="file" class="form-control-file" id="banner" name="banner" accept="image/*">
                        <small class="form-text text-muted">Maximum file size: 4MB</small>
                        <img id="banner-preview" src="#" alt="Banner Preview"
                          style="display:none; max-height: 150px; margin-top: 10px;">
                      </div>


                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="detail">Detail</label>
                        <textarea class="form-control" id="detail" name="detail" rows="6" placeholder="Enter blog content"
                          required></textarea>
                      </div>

                      <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="4"
                          placeholder="Enter meta description" required></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-2">Save Blog</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@push('scripts')

  <script>
    let detailEditor;

    $(document).ready(function () {

      CKEDITOR.replace('detail');

      // Slug generation
      $('#title').on('input', function () {
        let slug = $(this).val()
          .toLowerCase()
          .trim()
          .replace(/\s+/g, '-')
          .replace(/[^\w\-]+/g, '')
          .replace(/\-\-+/g, '-')
          .replace(/^-+|-+$/g, '');
        $('#slug_url').val(slug);
      });

      // Thumbnail preview
      $('#thumbnail').change(function () {
        const input = this;
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {
            $('#thumbnail-preview').attr('src', e.target.result).show();
          };
          reader.readAsDataURL(input.files[0]);
        }
      });

      // Banner preview
      $('#banner').change(function () {
        const input = this;
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {
            $('#banner-preview').attr('src', e.target.result).show();
          };
          reader.readAsDataURL(input.files[0]);
        }
      });

      // Form submission via AJAX
      $('#blogForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const detailContent = CKEDITOR.instances['detail'].getData();
        formData.set('detail', detailContent.trim() ? detailContent : '');

        $.ajax({
          url: "{{ route('admin.blogs.store') }}",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Blog added successfully!',
              timer: 2000,
              showConfirmButton: false
            }).then(() => {
              window.location.href = "{{ route('admin.blogs.index') }}";
            });
          },
          error: function (xhr) {
            let errors = xhr.responseJSON?.errors || {};
            let errorMessages = '';
            $.each(errors, function (key, value) {
              errorMessages += value[0] + '\n';
            });
            Swal.fire({
              icon: 'error',
              title: 'Validation Error',
              text: errorMessages.trim(),
            });
          }
        });
      });
    });
  </script>
@endpush