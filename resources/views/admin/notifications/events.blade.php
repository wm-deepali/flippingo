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
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Event Notifications</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Event-Based Notifications</h4>
            </div>

            <div class="card-body">

              <!-- Tabs -->
              <ul class="nav nav-tabs" id="notificationTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="templates-tab" data-toggle="tab" href="#templates" role="tab">Templates</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab">Sent Notifications</a>
                </li>
              </ul>

              <div class="tab-content mt-3">
                <!-- Templates Tab -->
                <div class="tab-pane fade show active" id="templates" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table" id="templates-table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Key</th>
                          <th>Subject</th>
                          <th>Content</th>
                          <th>Created At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($templates as $template)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $template->key }}</td>
                            <td>{{ $template->subject }}</td>
                            <td>{{ $template->content }}</td>
                            <td>{{ $template->created_at->format('d M Y, h:i A') }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- Sent Notifications Tab -->
                <div class="tab-pane fade" id="notifications" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table" id="notifications-table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Subject</th>
                          <th>Content</th>
                          <th>Template Key</th>
                          <th>Sent To</th>
                          <th>Created At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($templates as $template)
                          @foreach ($template->notifications as $notification)
                            <tr>
                              <td>{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                              <td>{{ $notification->subject }}</td>
                              <td>{{ $notification->content }}</td>
                              <td>{{ $notification->template?->key ?? '-' }}</td>
                              <td>
                                @if($notification->is_broadcast)
                                  All Customers
                                @else
                                  {{ $notification->customers->pluck('first_name')->join(', ') }}
                                @endif
                              </td>
                              <td>{{ $notification->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                          @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- End Tabs -->

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
    $('#templates-table').DataTable();
    $('#notifications-table').DataTable();

    // Bootstrap tabs fix for DataTables responsive redraw
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
    });
  });
</script>
@endpush
