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
              <input type="text"
                     name="title"
                     value="{{ $homeSlide->title }}"
                     class="form-control"
                     required>
            </div>

            {{-- HIGHLIGHT --}}
            <div class="form-group">
              <label>Highlight</label>
              <input type="text"
                     name="highlight"
                     value="{{ $homeSlide->highlight }}"
                     class="form-control">
            </div>

            {{-- FEATURES --}}
            <div class="form-group">
              <label>Features</label>

              <div id="feature-wrapper">
                @foreach($homeSlide->features ?? [] as $feature)
                  <div class="input-group mb-2 feature-row">
                    <input type="text"
                           name="features[]"
                           class="form-control"
                           value="{{ $feature }}"
                           placeholder="Feature">
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
              <div class="col-md-6">
                <label>Media Type</label>
                <select name="media_type" class="form-control">
                  <option value="image" {{ $homeSlide->media_type === 'image' ? 'selected' : '' }}>Image</option>
                  <option value="video" {{ $homeSlide->media_type === 'video' ? 'selected' : '' }}>Video</option>
                </select>
              </div>

              <div class="col-md-6">
                <label>Replace Media</label>
                <input type="file" name="media_file" class="form-control">
              </div>
            </div>

            {{-- CURRENT MEDIA PREVIEW --}}
            @if($homeSlide->media_path)
              <div class="mt-3">
                <label>Current Media</label><br>

                @if($homeSlide->media_type === 'image')
                  <img src="{{ asset('storage/'.$homeSlide->media_path) }}"
                       alt="Slide Image"
                       style="max-width: 300px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,.2);">
                @else
                  <video width="320" height="180" controls>
                    <source src="{{ asset('storage/'.$homeSlide->media_path) }}">
                    Your browser does not support the video tag.
                  </video>
                @endif
              </div>
            @endif

            {{-- BUTTON 1 --}}
            <h6 class="mt-4">Button 1</h6>
            <div class="row">
              <div class="col-md-4">
                <input name="btn1_text"
                       value="{{ $homeSlide->btn1_text }}"
                       class="form-control"
                       placeholder="Text">
              </div>
              <div class="col-md-4">
                <input name="btn1_icon"
                       value="{{ $homeSlide->btn1_icon }}"
                       class="form-control"
                       placeholder="Icon class">
              </div>
              <div class="col-md-4">
                <input name="btn1_link"
                       value="{{ $homeSlide->btn1_link }}"
                       class="form-control"
                       placeholder="Link">
              </div>
            </div>

            {{-- BUTTON 2 --}}
            <h6 class="mt-3">Button 2</h6>
            <div class="row">
              <div class="col-md-4">
                <input name="btn2_text"
                       value="{{ $homeSlide->btn2_text }}"
                       class="form-control"
                       placeholder="Text">
              </div>
              <div class="col-md-4">
                <input name="btn2_icon"
                       value="{{ $homeSlide->btn2_icon }}"
                       class="form-control"
                       placeholder="Icon class">
              </div>
              <div class="col-md-4">
                <input name="btn2_link"
                       value="{{ $homeSlide->btn2_link }}"
                       class="form-control"
                       placeholder="Link">
              </div>
            </div>

            {{-- SORT & STATUS --}}
            <div class="row mt-4">
              <div class="col-md-6">
                <label>Sort Order</label>
                <input type="number"
                       name="sort_order"
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
document.addEventListener('DOMContentLoaded', function () {

  // ADD FEATURE
  document.getElementById('add-feature').addEventListener('click', function () {
    document.getElementById('feature-wrapper').insertAdjacentHTML(
      'beforeend',
      `<div class="input-group mb-2 feature-row">
        <input type="text" name="features[]" class="form-control" placeholder="Feature">
        <div class="input-group-append">
          <button type="button" class="btn btn-danger remove-feature">&times;</button>
        </div>
      </div>`
    );
  });

  // REMOVE FEATURE
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-feature')) {
      e.target.closest('.feature-row').remove();
    }
  });

});
</script>
@endpush