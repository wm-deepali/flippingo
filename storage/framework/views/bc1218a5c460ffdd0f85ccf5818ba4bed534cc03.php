

<?php $__env->startSection('content'); ?>
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
                  <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo e(route('admin.packages.index')); ?>">Manage Packages</a></li>
                  <li class="breadcrumb-item active">Add New Package</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="<?php echo e(route('admin.packages.index')); ?>" class="btn btn-secondary btn-round btn-sm">Back</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <form id="packageForm" method="POST">
              <?php echo csrf_field(); ?>

              <!-- General Info Card -->
              <div class="card mb-2">
                <div class="card-header bg-light">
                  <h5 class="card-title mb-0">General Information</h5>
                </div>
                <div class="card-body row mt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Package Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter package name" required>
                    </div>
                    <div class="form-group">
                      <label>MRP</label>
                      <input type="number" class="form-control" name="mrp" id="mrp" placeholder="Enter MRP" required>
                    </div>
                    <div class="form-group">
                      <label>Discount (%)</label>
                      <input type="number" class="form-control" name="discount" id="discount"
                        placeholder="Enter discount %">
                    </div>
                    <div class="form-group">
                      <label>Offered Price</label>
                      <input type="number" class="form-control" id="offered_price" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                    </div>

                    <div class="form-group mt-2">
                      <label>Set as Popular</label>
                      <select class="form-control" name="is_popular" required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
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
                    <input type="number" class="form-control mb-2" name="listings" placeholder="Enter number">
                    <input type="text" class="form-control" name="listings_display"
                      placeholder="Display text e.g. 10X Listings">
                  </div>

                  <!-- Listing Duration -->
                  <div class="col-md-6">
                    <label>Listing Duration</label>
                    <div class="input-group mb-2">
                      <input type="number" class="form-control" name="listing_duration" placeholder="Enter duration">
                      <select class="form-control" name="listing_duration_unit">
                        <option value="days">Days</option>
                        <option value="months">Months</option>
                      </select>
                    </div>
                    <input type="text" class="form-control" name="listing_duration_display"
                      placeholder="Display text e.g. 30 Days">
                  </div>

                  <!-- Subscription Validity -->
                  <div class="col-md-6 mt-2">
                    <label>Subscription Validity</label>
                    <div class="input-group mb-2">
                      <input type="number" class="form-control" name="validity" placeholder="Enter validity">
                      <select class="form-control" name="validity_unit">
                        <option value="days">Days</option>
                        <option value="months">Months</option>
                      </select>
                    </div>
                    <input type="text" class="form-control" name="validity_display"
                      placeholder="Display text e.g. 3 Months">
                  </div>

                  <!-- Sponsored -->
                  <div class="col-md-6 mt-2">
                    <label>Sponsored on First Page</label>
                    <div class="input-group mb-2">
                      <select class="form-control" name="sponsored">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                      <input type="number" class="form-control" name="sponsored_frequency" placeholder="Frequency">
                      <select class="form-control" name="sponsored_unit">
                        <option value="days">Days</option>
                        <option value="weeks">Weeks</option>
                        <option value="months">Months</option>
                      </select>
                    </div>
                    <input type="text" class="form-control" name="sponsored_display"
                      placeholder="Display text e.g. Weekly Sponsor">
                  </div>

                  <!-- WhatsApp Sharing -->
                  <div class="col-md-6 mt-2">
                    <label>WhatsApp Group Sharing</label>
                    <div class="input-group mb-2">
                      <select class="form-control" name="whatsapp">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                      <input type="number" class="form-control" name="whatsapp_frequency" placeholder="Frequency">
                      <select class="form-control" name="whatsapp_unit">
                        <option value="days">Days</option>
                        <option value="weeks">Weeks</option>
                        <option value="months">Months</option>
                      </select>
                    </div>
                    <input type="text" class="form-control" name="whatsapp_display"
                      placeholder="Display text e.g. Shared Weekly">
                  </div>

                  <!-- Alerts -->
                  <div class="col-md-6 mt-2">
                    <label>Listing Alerts</label>
                    <select class="form-control mb-2" name="alerts">
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                    <input type="text" class="form-control" name="alerts_display"
                      placeholder="Display text e.g. Email Alerts Enabled">
                  </div>
                </div>
              </div>

              <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">💾 Save Package</button>
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
      $('#discount, #mrp').on('input', function () {
        let mrp = parseFloat($('#mrp').val()) || 0;
        let discount = parseFloat($('#discount').val()) || 0;
        let offered = mrp - (mrp * discount / 100);
        $('#offered_price').val(offered.toFixed(2));
      });

      $('#packageForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          url: "<?php echo e(route('admin.packages.store')); ?>",
          type: "POST",
          data: $(this).serialize(),
          success: function () {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Package added successfully!',
              timer: 2000,
              showConfirmButton: false
            }).then(() => window.location.href = "<?php echo e(route('admin.packages.index')); ?>");
          },
          error: function (xhr) {
            let errors = xhr.responseJSON?.errors || {};
            let errorMessages = '';
            $.each(errors, (key, value) => errorMessages += value[0] + '\n');
            Swal.fire({ icon: 'error', title: 'Validation Error', text: errorMessages.trim() });
          }
        });
      });
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/packages/create.blade.php ENDPATH**/ ?>