@extends('layouts.master')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>

  <div class="content-wrapper">

    {{-- HEADER --}}
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                  Home Slides
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="content-header-right col-md-3 col-12 text-md-right d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <a href="{{ route('admin.home-slides.create') }}"
             class="btn-icon btn btn-primary btn-round btn-sm">
            Add Slide
          </a>
        </div>
      </div>
    </div>

    {{-- BODY --}}
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <div class="card-header">
              <h4 class="card-title">Home Slides List</h4>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="home-slides-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Highlight</th>
                      <th>Media</th>
                      <th>Features</th>
                      <th>Sort Order</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th width="120">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @forelse($slides as $slide)
                      <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $slide->title }}</td>

                        <td>
                          {{ $slide->highlight ?? '—' }}
                        </td>

                        <td>
                          @if($slide->media_type === 'video')
                            <span class="badge badge-info">Video</span>
                          @elseif($slide->media_path)
                            <img src="{{ asset('storage/'.$slide->media_path) }}"
                                 width="60"
                                 height="40"
                                 class="rounded">
                          @else
                            <span class="text-muted">—</span>
                          @endif
                        </td>

                        <td>
                          {{ is_array($slide->features) ? count($slide->features) : 0 }}
                        </td>

                        <td>{{ $slide->sort_order }}</td>

                        <td>
                          @if($slide->is_active)
                            <span class="badge badge-success">Active</span>
                          @else
                            <span class="badge badge-secondary">Inactive</span>
                          @endif
                        </td>

                        <td>
                          {{ $slide->created_at->format('d M Y') }}
                        </td>

                        <td>
                          <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                              <a href="{{ route('admin.home-slides.edit', $slide->id) }}"
                                 class="btn btn-primary btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                              </a>
                            </li>

                            <li class="list-inline-item">
                              <form method="POST"
                                    action="{{ route('admin.home-slides.destroy', $slide->id) }}"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-link p-0">
                                  <i class="fa fa-trash text-danger"></i>
                                </button>
                              </form>
                            </li>
                          </ul>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="9" class="text-center">
                          No slides found.
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
  $('#home-slides-table').DataTable();
});
</script>
@endpush