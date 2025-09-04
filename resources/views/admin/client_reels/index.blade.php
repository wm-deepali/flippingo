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
                  <li class="breadcrumb-item active">Client Reels</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-reel">Add Reel</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Client Reels</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="reel-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Author Image</th>
                        <th>Author Name</th>
                        <th>Designation</th>
                        <th>Reel Type</th>
                        <th>Reel Preview</th>
                        <th>Created At</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($reels as $reel)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>
                            @if($reel->author_image)
                              <img src="{{ asset('storage/' . $reel->author_image) }}" alt="Author Image"
                                style="height: 60px; width:60px; object-fit: cover; border-radius: 50%;">
                            @else
                              <span class="text-muted">No Image</span>
                            @endif
                          </td>
                          <td>{{ $reel->author_name }}</td>
                          <td>{{ $reel->designation ?? '-' }}</td>
                          <td>{{ ucfirst($reel->reel_type) }}</td>
                          <td>
                            @if($reel->reel_type === 'youtube' && $reel->youtube_url)
                              <a href="{{ $reel->youtube_url }}" target="_blank">YouTube Link</a>
                            @elseif($reel->reel_type === 'facebook' && $reel->facebook_url)
                              <a href="{{ $reel->facebook_url }}" target="_blank">Facebook Link</a>
                            @elseif($reel->reel_type === 'upload' && $reel->video_file)
                              <video width="120" controls>
                                <source src="{{ asset('storage/' . $reel->video_file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                              </video>
                            @else
                              <span class="text-muted">N/A</span>
                            @endif
                          </td>
                          <td>{{ $reel->created_at->format('d M Y, h:i A') }}</td>
                          <td>
                            <ul class="list-inline">
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-reel"
                                  data-id="{{ $reel->id }}">
                                  <i class="fas fa-pencil-alt"></i>
                                </a>
                              </li>
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" onclick="deleteReel({{ $reel->id }})"
                                  class="btn btn-danger btn-sm">
                                  <i class="fa fa-trash"></i>
                                </a>
                              </li>
                            </ul>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="reel-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      // Open add reel modal
      $(document).on('click', '#add-reel', function () {
        $.get("{{ route('admin.client-reels.create') }}", function (result) {
          if (result.success) {
            $('#reel-modal').html(result.html).modal('show');
          }
        });
      });

      // Open edit reel modal
      $(document).on('click', '.edit-reel', function () {
        let id = $(this).data('id');
        $.get(`{{ url('admin/client-reels') }}/${id}/edit`, function (result) {
          if (result.success) {
            $('#reel-modal').html(result.html).modal('show');
          }
        });
      });

      // CSRF setup
      $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });

      // Save reel
      $(document).on('click', '#add-clientreel-btn', function () {
        let btn = $(this);
        btn.prop('disabled', true);
        $('.validation-err').text('');

        let formData = new FormData($('#reel-form')[0]);

        $.ajax({
          url: '{{ route("admin.client-reels.store") }}',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response.success) {
              Swal.fire('Success!', response.message, 'success');
              $('#reel-modal').modal('hide');
              setTimeout(() => location.reload(), 1000);
            } else {
              Swal.fire('Error', response.message || 'Failed to save.', 'error');
            }
            btn.prop('disabled', false);
          },
          error: function (xhr) {
            btn.prop('disabled', false);
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              for (let field in errors) {
                $('#' + field + '-err').text(errors[field][0]);
              }
            } else {
              Swal.fire('Error', 'Something went wrong.', 'error');
            }
          }
        });
      });

      // Update reel
      $(document).on('click', '#update-clientreel-btn', function () {
        let btn = $(this);
        btn.prop('disabled', true);
        $('.validation-err').text('');

        let formData = new FormData($('#reel-edit-form')[0]);
        formData.append('_method', 'PUT');

        let reelId = btn.data('reel-id');

        $.ajax({
          url: `/admin/client-reels/${reelId}`,
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response.success) {
              Swal.fire('Success!', response.message, 'success');
              $('#reel-modal').modal('hide');
              setTimeout(() => location.reload(), 1000);
            } else {
              Swal.fire('Error', response.message || 'Failed to update.', 'error');
            }
            btn.prop('disabled', false);
          },
          error: function (xhr) {
            btn.prop('disabled', false);
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              for (let field in errors) {
                $('#' + field + '-err').text(errors[field][0]);
              }
            } else {
              Swal.fire('Error', 'Something went wrong.', 'error');
            }
          }
        });
      });

      // Delete reel
      window.deleteReel = function (id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You can't reverse this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: `{{ url('admin/client-reels') }}/${id}`,
              type: 'DELETE',
              success: function (res) {
                if (res.success) {
                  Swal.fire('Deleted!', '', 'success');
                  setTimeout(() => location.reload(), 500);
                } else {
                  Swal.fire('Error', res.message || 'Failed to delete', 'error');
                }
              }
            });
          }
        });
      }
    });
  </script>
@endpush
