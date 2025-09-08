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
            <a href="{{ route('admin.packages.index') }}" class="btn-icon btn btn-secondary btn-round btn-sm">Back to
              Packages</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Edit Package</h4>
              </div>
              <div class="card-body">
                <form id="packageForm" method="POST">
                  @csrf

                  <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Package Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $package->name }}" required>
                      </div>

                      <div class="form-group">
                        <label for="mrp">MRP</label>
                        <input type="number" step="0.01" class="form-control" id="mrp" name="mrp"
                          value="{{ $package->mrp }}" required>
                      </div>

                      <div class="form-group">
                        <label for="discount">Discount (%)</label>
                        <input type="number" step="0.01" class="form-control" id="discount" name="discount"
                          value="{{ $package->discount }}" required>
                      </div>

                      <div class="form-group">
                        <label for="offered_price">Offered Price</label>
                        <input type="number" step="0.01" class="form-control" id="offered_price" name="offered_price"
                          value="{{ $package->offered_price }}" required>
                      </div>

                      <div class="form-group">
                        <label for="number_of_listings">Number of Listings</label>
                        <input type="number" class="form-control" id="number_of_listings" name="number_of_listings"
                          value="{{ $package->number_of_listings }}" required>
                      </div>

                      <div class="form-group">
                        <label for="listing_duration">Listing Duration (Days)</label>
                        <input type="number" class="form-control" id="listing_duration" name="listing_duration"
                          value="{{ $package->listing_duration }}" required>
                      </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="package_validity">Package Validity (Days)</label>
                        <input type="number" class="form-control" id="package_validity" name="package_validity"
                          value="{{ $package->package_validity }}" required>
                      </div>

                      <div class="form-group">
                        <label for="promotions">Promotions (Per Month)</label>
                        <input type="number" class="form-control" id="promotions" name="promotions"
                          value="{{ $package->promotions }}">
                      </div>

                      <div class="form-group">
                        <label for="sponsors_on_front_page">Sponsors on Front Page (Days)</label>
                        <input type="number" class="form-control" id="sponsors_on_front_page"
                          name="sponsors_on_front_page" value="{{ $package->sponsors_on_front_page }}">
                      </div>

                      <div class="form-group">
                        <label for="listing_alerts">Listing Alerts</label>
                        <select class="form-control" id="listing_alerts" name="listing_alerts" required>
                          <option value="1" {{ $package->listing_alerts ? 'selected' : '' }}>Yes</option>
                          <option value="0" {{ !$package->listing_alerts ? 'selected' : '' }}>No</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="is_popular">Set as Popular</label><br>
                        <input type="checkbox" id="is_popular" name="is_popular" {{ $package->is_popular ? 'checked' : '' }}>
                      </div>
                    </div>
                  </div>

                  <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-2">Update Package</button>
                  </div>
                </form>
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
      // Auto calculate Offered Price = MRP - (Discount%)
      $('#mrp, #discount').on('input', function () {
        let mrp = parseFloat($('#mrp').val()) || 0;
        let discount = parseFloat($('#discount').val()) || 0;
        let offeredPrice = mrp - (mrp * discount / 100);
        $('#offered_price').val(offeredPrice.toFixed(2));
      });

      // Form Submit
      $('#packageForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
          url: "{{ route('admin.packages.update', $package->id) }}",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            Swal.fire('Success', response.message, 'success');
            window.location.href = "{{ route('admin.packages.index') }}";
          },
          error: function (xhr) {
            let errors = xhr.responseJSON?.errors || {};
            let errorMessages = '';
            $.each(errors, function (key, value) {
              errorMessages += value[0] + '\n';
            });

            Swal.fire({
              icon: 'error',
              title: 'Validation Error',
              text: errorMessages.trim(),
            });
          }
        });
      });
    });
  </script>
@endpush
