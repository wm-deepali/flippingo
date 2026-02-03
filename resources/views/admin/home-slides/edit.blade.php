@extends('layouts.master')

@section('content')
<div class="app-content content">
  <div class="content-wrapper">

    <div class="content-header row">
      <div class="col-12">
        <h4>Edit Home Slide</h4>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
        <div class="card-body">

<form method="POST"
      action="{{ route('admin.home-slides.update', $homeSlide->id) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- TITLE --}}
<div class="form-group">
  <label>Title *</label>
  <input type="text" name="title"
         value="{{ $homeSlide->title }}"
         class="form-control" required>
</div>

{{-- HIGHLIGHT --}}
<div class="form-group">
  <label>Highlight</label>
  <input type="text" name="highlight"
         value="{{ $homeSlide->highlight }}"
         class="form-control">
</div>

{{-- FEATURES --}}
<div class="form-group">
  <label>Features</label>

  <div id="feature-wrapper">
    @foreach($homeSlide->features ?? [] as $feature)
      <div class="input-group mb-2 feature-row">
        <input type="text" name="features[]"
               class="form-control"
               value="{{ $feature }}">
        <div class="input-group-append">
          <button type="button" class="btn btn-danger remove-feature">&times;</button>
        </div>
      </div>
    @endforeach
  </div>

  <button type="button"
          class="btn btn-sm btn-outline-primary"
          id="add-feature">
    + Add Feature
  </button>
</div>

{{-- MEDIA --}}
<div class="row mt-3">

  <div class="col-md-3">
    <label>Media Type</label>
    <select name="media_type" id="media_type" class="form-control">
      <option value="image" {{ $homeSlide->media_type === 'image' ? 'selected' : '' }}>Image</option>
      <option value="video" {{ $homeSlide->media_type === 'video' ? 'selected' : '' }}>Video</option>
    </select>
  </div>

  <div class="col-md-3 {{ $homeSlide->media_type === 'video' ? '' : 'd-none' }}" id="video-type-wrapper">
    <label>Video Type</label>
    <select name="video_type" id="video_type" class="form-control">
      <option value="upload" {{ $homeSlide->video_type === 'upload' ? 'selected' : '' }}>Upload</option>
      <option value="youtube" {{ $homeSlide->video_type === 'youtube' ? 'selected' : '' }}>YouTube</option>
      <option value="vimeo" {{ $homeSlide->video_type === 'vimeo' ? 'selected' : '' }}>Vimeo</option>
      <option value="external" {{ $homeSlide->video_type === 'external' ? 'selected' : '' }}>External URL</option>
    </select>
  </div>

  <div class="col-md-3 {{ ($homeSlide->media_type === 'video' && in_array($homeSlide->video_type, ['youtube','vimeo','external'])) ? 'd-none' : '' }}"
     id="file-wrapper">
    <label>Replace File</label>
    <input type="file" name="media_file"
           class="form-control"
           accept="image/*,video/*">
  </div>

  <div class="col-md-3 {{ in_array($homeSlide->video_type, ['youtube','vimeo','external']) ? '' : 'd-none' }}"
       id="url-wrapper">
    <label>Video URL</label>
    <input type="url"
           name="media_url"
           value="{{ filter_var($homeSlide->media_path, FILTER_VALIDATE_URL) ? $homeSlide->media_path : '' }}"
           class="form-control">
  </div>

</div>

{{-- CURRENT MEDIA PREVIEW --}}
@if($homeSlide->media_path)
<div class="mt-3">
  <label>Current Media</label><br>

  @if($homeSlide->media_type === 'image')
    <img src="{{ asset('storage/'.$homeSlide->media_path) }}"
         style="max-width:300px;border-radius:8px;">
  @elseif($homeSlide->video_type === 'upload')
    <video width="320" height="180" controls>
      <source src="{{ asset('storage/'.$homeSlide->media_path) }}">
    </video>
  @else
    <iframe width="320" height="180"
            src="{{ $homeSlide->media_path }}"
            frameborder="0"
            allowfullscreen></iframe>
  @endif
</div>
@endif

{{-- BUTTON 1 --}}
<h6 class="mt-4">Button 1</h6>
<div class="row">
  <div class="col-md-4">
    <input name="btn1_text" value="{{ $homeSlide->btn1_text }}" class="form-control">
  </div>
  <div class="col-md-4">
    <input name="btn1_icon" value="{{ $homeSlide->btn1_icon }}" class="form-control">
  </div>
  <div class="col-md-4">
    <input name="btn1_link" value="{{ $homeSlide->btn1_link }}" class="form-control">
  </div>
</div>

{{-- BUTTON 2 --}}
<h6 class="mt-3">Button 2</h6>
<div class="row">
  <div class="col-md-4">
    <input name="btn2_text" value="{{ $homeSlide->btn2_text }}" class="form-control">
  </div>
  <div class="col-md-4">
    <input name="btn2_icon" value="{{ $homeSlide->btn2_icon }}" class="form-control">
  </div>
  <div class="col-md-4">
    <input name="btn2_link" value="{{ $homeSlide->btn2_link }}" class="form-control">
  </div>
</div>

{{-- SORT & STATUS --}}
<div class="row mt-4">
  <div class="col-md-6">
    <label>Sort Order</label>
    <input type="number" name="sort_order"
           value="{{ $homeSlide->sort_order }}"
           class="form-control">
  </div>
  <div class="col-md-6">
    <label>Status</label>
    <select name="is_active" class="form-control">
      <option value="1" {{ $homeSlide->is_active ? 'selected' : '' }}>Active</option>
      <option value="0" {{ !$homeSlide->is_active ? 'selected' : '' }}>Inactive</option>
    </select>
  </div>
</div>

{{-- ACTION --}}
<div class="mt-4">
  <button class="btn btn-primary">Update</button>
  <a href="{{ route('admin.home-slides.index') }}" class="btn btn-secondary">Cancel</a>
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
document.addEventListener('DOMContentLoaded', () => {

  // Feature add/remove
  document.getElementById('add-feature').onclick = () => {
    document.getElementById('feature-wrapper').insertAdjacentHTML(
      'beforeend',
      `<div class="input-group mb-2 feature-row">
        <input type="text" name="features[]" class="form-control">
        <div class="input-group-append">
          <button type="button" class="btn btn-danger remove-feature">&times;</button>
        </div>
      </div>`
    );
  };

  document.addEventListener('click', e => {
    if (e.target.classList.contains('remove-feature')) {
      e.target.closest('.feature-row').remove();
    }
  });

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

});
</script>
@endpush
