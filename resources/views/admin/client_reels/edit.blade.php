<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit Client Reel</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="reel-edit-form" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
          {{-- Author Name --}}
          <div class="form-group col-md-6">
            <label>Author Name <span class="text-danger">*</span></label>
            <input type="text" name="author_name" id="author_name" class="form-control"
              value="{{ $clientReel->author_name }}" required>
            <div class="text-danger validation-err" id="author_name-err"></div>
          </div>

          {{-- Author Image --}}
          <div class="form-group col-md-6">
            <label>Author Image</label>
            <input type="file" name="author_image" id="author_image" class="form-control">
            @if($clientReel->author_image)
              <div class="mt-2">
                <img src="{{ asset('storage/' . $clientReel->author_image) }}" alt="Author Image"
                  class="img-thumbnail" style="height:100px; width:100px; object-fit:cover;">
              </div>
            @endif
            <small class="text-muted">Accepted: jpeg, png, jpg, webp. Max 2MB</small>
            <div class="text-danger validation-err" id="author_image-err"></div>
          </div>
        </div>

        <div class="form-row">
          {{-- Designation --}}
          <div class="form-group col-md-6">
            <label>Designation</label>
            <input type="text" name="designation" id="designation" class="form-control"
              value="{{ $clientReel->designation }}">
            <div class="text-danger validation-err" id="designation-err"></div>
          </div>

          {{-- Reel Type --}}
          <div class="form-group col-md-6">
            <label>Reel Type <span class="text-danger">*</span></label>
            <select name="reel_type" id="reel_type" class="form-control" required>
              <option value="youtube" {{ $clientReel->reel_type == 'youtube' ? 'selected' : '' }}>YouTube</option>
              <option value="facebook" {{ $clientReel->reel_type == 'facebook' ? 'selected' : '' }}>Facebook</option>
              <option value="upload" {{ $clientReel->reel_type == 'upload' ? 'selected' : '' }}>Upload File</option>
            </select>
            <div class="text-danger validation-err" id="reel_type-err"></div>
          </div>
        </div>

        {{-- Conditional Inputs --}}
        <div class="form-group reel-input youtube-input {{ $clientReel->reel_type == 'youtube' ? '' : 'd-none' }}">
          <label>YouTube URL <span class="text-danger">*</span></label>
          <input type="url" name="youtube_url" id="youtube_url" class="form-control"
            value="{{ $clientReel->youtube_url }}">
          <div class="text-danger validation-err" id="youtube_url-err"></div>
        </div>

        <div class="form-group reel-input facebook-input {{ $clientReel->reel_type == 'facebook' ? '' : 'd-none' }}">
          <label>Facebook URL <span class="text-danger">*</span></label>
          <input type="url" name="facebook_url" id="facebook_url" class="form-control"
            value="{{ $clientReel->facebook_url }}">
          <div class="text-danger validation-err" id="facebook_url-err"></div>
        </div>

        <div class="form-group reel-input upload-input {{ $clientReel->reel_type == 'upload' ? '' : 'd-none' }}">
          <label>Upload Video File</label>
          <input type="file" name="video_file" id="video_file" class="form-control">
          @if($clientReel->video_file)
            <div class="mt-2">
              <video src="{{ asset('storage/' . $clientReel->video_file) }}" controls
                style="height:150px; width:200px; border-radius:8px;"></video>
            </div>
          @endif
          <small class="text-muted">Accepted: mp4, mov, avi, mkv. Max 20MB</small>
          <div class="text-danger validation-err" id="video_file-err"></div>
        </div>

        <button type="button" class="btn btn-primary" id="update-clientReel-btn"
          data-clientReel-id="{{ $clientReel->id }}">Update</button>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  function toggleReelInputs() {
    // Hide all inputs
    $('.reel-input').addClass('d-none');

    let type = $('#reel_type').val();

    // Clear only unused fields
    if (type !== 'youtube') {
      $('#youtube_url').val('');
    }
    if (type !== 'facebook') {
      $('#facebook_url').val('');
    }
    if (type !== 'upload') {
      $('#video_file').val('');
    }

    // Show selected input
    if (type === 'youtube') {
      $('.youtube-input').removeClass('d-none');
    } else if (type === 'facebook') {
      $('.facebook-input').removeClass('d-none');
    } else if (type === 'upload') {
      $('.upload-input').removeClass('d-none');
    }
  }

  // On change reel type
  $(document).on('change', '#reel_type', function () {
    toggleReelInputs();
  });

  // Init on load (respect existing selection)
  toggleReelInputs();
});
</script>

