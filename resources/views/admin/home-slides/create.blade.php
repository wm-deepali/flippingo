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
    <input type="text" name="features[]" class="form-control mb-2" placeholder="Feature">
  </div>
  <button type="button" class="btn btn-sm btn-outline-primary" id="add-feature">
    + Add Feature
  </button>
</div>

{{-- MEDIA --}}
<div class="row mt-3">

  <div class="col-md-3">
    <label>Media Type</label>
    <select name="media_type" id="media_type" class="form-control">
      <option value="image">Image</option>
      <option value="video">Video</option>
    </select>
  </div>

  <div class="col-md-3 d-none" id="video-type-wrapper">
    <label>Video Type</label>
    <select name="video_type" id="video_type" class="form-control">
      <option value="upload">Upload</option>
      <option value="youtube">YouTube</option>
      <option value="vimeo">Vimeo</option>
      <option value="external">External URL</option>
    </select>
  </div>

  <div class="col-md-3" id="file-wrapper">
    <label>Upload File</label>
    <input type="file"
           name="media_file"
           class="form-control"
           accept="image/*,video/*">
  </div>

  <div class="col-md-3 d-none" id="url-wrapper">
    <label>Video URL</label>
    <input type="url"
           name="media_url"
           class="form-control"
           placeholder="YouTube / Vimeo / MP4 URL">
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
// Add feature
document.getElementById('add-feature').onclick = function () {
  document.getElementById('feature-wrapper')
    .insertAdjacentHTML(
      'beforeend',
      '<input type="text" name="features[]" class="form-control mb-2" placeholder="Feature">'
    );
};

// Media toggle
const mediaType = document.getElementById('media_type');
const videoType = document.getElementById('video_type');
const videoWrap = document.getElementById('video-type-wrapper');
const fileWrap  = document.getElementById('file-wrapper');
const urlWrap   = document.getElementById('url-wrapper');

mediaType.addEventListener('change', () => {
  if (mediaType.value === 'video') {
    videoWrap.classList.remove('d-none');
  } else {
    videoWrap.classList.add('d-none');
    urlWrap.classList.add('d-none');
    fileWrap.classList.remove('d-none');
  }
});

videoType.addEventListener('change', () => {
  if (videoType.value === 'upload') {
    fileWrap.classList.remove('d-none');
    urlWrap.classList.add('d-none');
  } else {
    fileWrap.classList.add('d-none');
    urlWrap.classList.remove('d-none');
  }
});
</script>
@endpush
