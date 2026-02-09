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
                  <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Manage Packages</a></li>
                  <li class="breadcrumb-item active">Edit Package</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary btn-round btn-sm">Back</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <form id="packageForm" method="POST">
              @csrf
              @method('PUT')

              <!-- General Info Card -->
              <div class="card mb-2">
                <div class="card-header bg-light">
                  <h5 class="card-title mb-0">General Information</h5>
                </div>
                <div class="card-body row mt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Package Name</label>
                      <input type="text" class="form-control" name="name" value="{{ $package->name }}" required>
                    </div>
                    <div class="form-group">
                      <label>MRP</label>
                      <input type="number" class="form-control" name="mrp" id="mrp" value="{{ $package->mrp }}" required>
                    </div>
                    <div class="form-group">
                      <label>Discount (%)</label>
                      <input type="number" class="form-control" name="discount" id="discount"
                        value="{{ $package->discount }}">
                    </div>
                    <div class="form-group">
                      <label>Offered Price</label>
                      <input type="number" class="form-control" id="offered_price" name="offered_price"
                        value="{{ $package->offered_price }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" required>
                        <option value="active" {{ $package->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $package->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                    </div>

                    <div class="form-group mt-2">
                      <label>Set as Popular</label>
                      <select class="form-control" name="is_popular" required>
                        <option value="0" {{ $package->is_popular == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $package->is_popular == 1 ? 'selected' : '' }}>Yes</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Subscription Features -->
              <div class="card">
                <div class="card-header bg-light">
                  <h5 class="card-title mb-0">Subscription Features</h5>
                </div>
                <div class="card-body row mt-2">
                  <!-- Number of Listings -->
                  <div class="col-md-6">
                    <label>Number of Listings</label>
                    <input type="number" class="form-control mb-2" name="listings" value="{{ $package->listings }}">
                    <input type="text" class="form-control" name="listings_display"
                      value="{{ $package->listings_display }}">
                  </div>

                  <!-- Listing Duration -->
                  <div class="col-md-6">
                    <label>Listing Duration</label>
                    <div class="input-group mb-2">
                      <input type="number" class="form-control" name="listing_duration"
                        value="{{ $package->listing_duration }}">
                      <select class="form-control" name="listing_duration_unit">
                        <option value="days" {{ $package->listing_duration_unit == 'days' ? 'selected' : '' }}>Days</option>
                        <option value="months" {{ $package->listing_duration_unit == 'months' ? 'selected' : '' }}>Months
                        </option>
                      </select>
                    </div>
                    <input type="text" class="form-control" name="listing_duration_display"
                      value="{{ $package->listing_duration_display }}">
                  </div>

                  <!-- Subscription Validity -->
                  <div class="col-md-6 mt-2">
                    <label>Subscription Validity</label>
                    <div class="input-group mb-2">
                      <input type="number" class="form-control" name="validity" value="{{ $package->validity }}">
                      <select class="form-control" name="validity_unit">
                        <option value="days" {{ $package->validity_unit == 'days' ? 'selected' : '' }}>Days</option>
                        <option value="months" {{ $package->validity_unit == 'months' ? 'selected' : '' }}>Months</option>
                      </select>
                    </div>
                    <input type="text" class="form-control" name="validity_display"
                      value="{{ $package->validity_display }}">
                  </div>

                  <!-- Sponsored -->
                  <div class="col-md-6 mt-2">
                    <label>Sponsored on First Page</label>
                    <div class="input-group mb-2">
                      <select class="form-control" name="sponsored">
                        <option value="yes" {{ $package->sponsored == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ $package->sponsored == 'no' ? 'selected' : '' }}>No</option>
                      </select>
                      <input type="number" class="form-control" name="sponsored_frequency"
                        value="{{ $package->sponsored_frequency }}">
                      <select class="form-control" name="sponsored_unit">
                        <option value="days" {{ $package->sponsored_unit == 'days' ? 'selected' : '' }}>Days</option>
                        <option value="weeks" {{ $package->sponsored_unit == 'weeks' ? 'selected' : '' }}>Weeks</option>
                        <option value="months" {{ $package->sponsored_unit == 'months' ? 'selected' : '' }}>Months</option>
                      </select>
                    </div>
                    <input type="text" class="form-control" name="sponsored_display"
                      value="{{ $package->sponsored_display }}">
                  </div>

                  <!-- Featured Listing -->
                  <div class="col-md-6 mt-2">
                    <label>Featured Listing</label>
                    <div class="input-group mb-2">
                      <select class="form-control" name="featured">
                        <option value="yes" {{ $package->featured == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ $package->featured == 'no' ? 'selected' : '' }}>No</option>
                      </select>

                      <input type="number" class="form-control" name="featured_frequency"
                        value="{{ $package->featured_frequency }}" placeholder="Frequency">

                      <select class="form-control" name="featured_unit">
                        <option value="days" {{ $package->featured_unit == 'days' ? 'selected' : '' }}>Days</option>
                        <option value="weeks" {{ $package->featured_unit == 'weeks' ? 'selected' : '' }}>Weeks</option>
                        <option value="months" {{ $package->featured_unit == 'months' ? 'selected' : '' }}>Months</option>
                      </select>
                    </div>

                    <input type="text" class="form-control" name="featured_display"
                      value="{{ $package->featured_display }}" placeholder="Display text e.g. Featured Weekly">
                  </div>


                  <!-- WhatsApp Sharing -->
                  <div class="col-md-6 mt-2">
                    <label>WhatsApp Group Sharing</label>
                    <div class="input-group mb-2">
                      <select class="form-control" name="whatsapp">
                        <option value="yes" {{ $package->whatsapp == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ $package->whatsapp == 'no' ? 'selected' : '' }}>No</option>
                      </select>
                      <input type="number" class="form-control" name="whatsapp_frequency"
                        value="{{ $package->whatsapp_frequency }}">
                      <select class="form-control" name="whatsapp_unit">
                        <option value="days" {{ $package->whatsapp_unit == 'days' ? 'selected' : '' }}>Days</option>
                        <option value="weeks" {{ $package->whatsapp_unit == 'weeks' ? 'selected' : '' }}>Weeks</option>
                        <option value="months" {{ $package->whatsapp_unit == 'months' ? 'selected' : '' }}>Months</option>
                      </select>
                    </div>
                    <input type="text" class="form-control" name="whatsapp_display"
                      value="{{ $package->whatsapp_display }}">
                  </div>

                  <!-- Alerts -->
                  <div class="col-md-6 mt-2">
                    <label>Listing Alerts</label>
                    <select class="form-control mb-2" name="alerts">
                      <option value="yes" {{ $package->alerts == 'yes' ? 'selected' : '' }}>Yes</option>
                      <option value="no" {{ $package->alerts == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                    <input type="text" class="form-control" name="alerts_display" value="{{ $package->alerts_display }}">
                  </div>

                </div>
              </div>

              <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">💾 Update Package</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function () {
      // recalculate offered price when mrp or discount changes
      $('#discount, #mrp').on('input', function () {
        let mrp = parseFloat($('#mrp').val()) || 0;
        let discount = parseFloat($('#discount').val()) || 0;
        let offered = mrp - (mrp * discount / 100);
        $('#offered_price').val(offered.toFixed(2));
      });

      // submit edit form
      $('#packageForm').on('submit', function (e) {
        e.preventDefault();
        let $btn = $(this).find('button[type="submit"]');
        $btn.prop('disabled', true).text('Updating...');
        $.ajax({
          url: "{{ route('admin.packages.update', $package->id) }}",
          type: "POST",
          data: $(this).serialize(),
          success: function () {
            Swal.fire({
              icon: 'success',
              title: 'Updated!',
              text: 'Package updated successfully!',
              timer: 2000,
              showConfirmButton: false
            }).then(() => window.location.href = "{{ route('admin.packages.index') }}");
          },
          error: function (xhr) {
            let errors = xhr.responseJSON?.errors || {};
            let errorMessages = '';
            $.each(errors, (key, value) => errorMessages += value[0] + '\n');
            Swal.fire({ icon: 'error', title: 'Validation Error', text: errorMessages.trim() });
          },
          complete: function () {
            $btn.prop('disabled', false).text('💾 Update Package');
          }
        });
      });
    });
  </script>
@endsection