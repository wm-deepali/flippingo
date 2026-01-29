@extends('layouts.master')

@section('content')
<div class="app-content content">
  <div class="content-wrapper">

    <div class="content-header row">
      <div class="col-12">
        <h4>Add Home Slide</h4>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
        <div class="card-body">

          <form method="POST"
                action="{{ route('admin.home-slides.store') }}"
                enctype="multipart/form-data">
            @csrf

            {{-- TITLE --}}
            <div class="form-group">
              <label>Title *</label>
              <input type="text" name="title" class="form-control" required>
            </div>

            {{-- HIGHLIGHT --}}
            <div class="form-group">
              <label>Highlight</label>
              <input type="text" name="highlight" class="form-control">
            </div>

            {{-- FEATURES --}}
            <div class="form-group">
              <label>Features</label>
              <div id="feature-wrapper">
                <input type="text" name="features[]" class="form-control mb-2"
                       placeholder="Feature">
              </div>
              <button type="button" class="btn btn-sm btn-outline-primary" id="add-feature">
                + Add Feature
              </button>
            </div>

            {{-- MEDIA --}}
            <div class="row">
              <div class="col-md-6">
                <label>Media Type</label>
                <select name="media_type" class="form-control">
                  <option value="image">Image</option>
                  <option value="video">Video</option>
                </select>
              </div>

              <div class="col-md-6">
                <label>Media File</label>
                <input type="file" name="media_file" class="form-control">
              </div>
            </div>

            {{-- BUTTON 1 --}}
            <h6 class="mt-3">Button 1</h6>
            <div class="row">
              <div class="col-md-4">
                <input name="btn1_text" class="form-control" placeholder="Text">
              </div>
              <div class="col-md-4">
                <input name="btn1_icon" class="form-control" placeholder="Icon class">
              </div>
              <div class="col-md-4">
                <input name="btn1_link" class="form-control" placeholder="Link">
              </div>
            </div>

            {{-- BUTTON 2 --}}
            <h6 class="mt-3">Button 2</h6>
            <div class="row">
              <div class="col-md-4">
                <input name="btn2_text" class="form-control" placeholder="Text">
              </div>
              <div class="col-md-4">
                <input name="btn2_icon" class="form-control" placeholder="Icon class">
              </div>
              <div class="col-md-4">
                <input name="btn2_link" class="form-control" placeholder="Link">
              </div>
            </div>

            {{-- SORT & STATUS --}}
            <div class="row mt-3">
              <div class="col-md-6">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
              </div>
              <div class="col-md-6">
                <label>Status</label>
                <select name="is_active" class="form-control">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
            </div>

            {{-- ACTION --}}
            <div class="mt-4">
              <button class="btn btn-primary">Save</button>
              <a href="{{ route('admin.home-slides.index') }}"
                 class="btn btn-secondary">Cancel</a>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('add-feature').onclick = function () {
  document.getElementById('feature-wrapper').insertAdjacentHTML(
    'beforeend',
    '<input type="text" name="features[]" class="form-control mb-2" placeholder="Feature">'
  );
};
</script>
@endpush