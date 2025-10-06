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
                  <li class="breadcrumb-item active">Forms</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="{{ route('admin.form.create') }}" class="btn-icon btn btn-primary btn-round btn-sm">Create New
              Form</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Forms Listing</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" style="min-height:300px">
                  <table class="table" id="dynamic-pages-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Form Name</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Language</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($forms as $form)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $form->name }}</td>
                          <td>{{ $form->category->name ?? '-' }}</td>
                          <td>
                            @if($form->status)
                              <span class="badge badge-success">Active</span>
                            @else
                              <span class="badge badge-secondary">Inactive</span>
                            @endif
                          </td>
                          <td>{{ $form->language ?? 'N/A' }}</td>
                          <td>{{ $form->updated_at->format('d M Y, h:i A') }}</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                id="actionMenu{{ $form->id }}" data-toggle="dropdown" aria-expanded="false">
                                Actions
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $form->id }}">
                                <li>
                                  <a class="dropdown-item" href="{{ route('admin.form.edit', $form->id) }}">
                                    <i class="fas fa-pen"></i> Update
                                  </a>
                                </li>
                                <li>
                                  <a class="dropdown-item" href="{{ route('admin.form.show', $form->id) }}" target="_blank">
                                    <i class="fas fa-eye"></i> View
                                  </a>
                                </li>
                                <li>
                                  <a class="dropdown-item" href="{{ route('admin.form-layout.edit', $form->id) }}">
                                    <i class="fas fa-th-large"></i> Layout
                                  </a>
                                </li>
                                <li>
                                  <a class="dropdown-item" href="{{ route('admin.form.create-filter', $form->id) }}">
                                    <i class="fas fa-filter"></i> Form Filter
                                  </a>
                                </li>

                                <li>
                                  <a class="dropdown-item" href="{{ route('admin.form.settings', $form->id) }}">
                                    <i class="fas fa-cog"></i> Settings
                                  </a>
                                </li>
                                <li>
                                  <a class="dropdown-item text-danger" href="javascript:void(0)"
                                    onclick="deleteConfirmation({{ $form->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                  </a>
                                </li>




                            </div>
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
  </div>

  <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('scripts')
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function deleteConfirmation(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `{{ url('admin/form') }}/${id}`,
            type: "DELETE",
            dataType: "json",
            success: function (result) {
              if (result.success) {
                Swal.fire('Deleted!', '', 'success');
                setTimeout(() => location.reload(), 400);
              } else {
                Swal.fire(result.msgText);
              }
            }
          });
        }
      });
    }

    $(document).ready(function () {
      $('#pagetype-table').DataTable();
    });
  </script>
@endpush