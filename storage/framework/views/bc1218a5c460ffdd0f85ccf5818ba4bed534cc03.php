

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
            <a href="<?php echo e(route('admin.packages.index')); ?>" class="btn-icon btn btn-secondary btn-round btn-sm">Back to Packages</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Add New Package</h4>
              </div>
              <div class="card-body">
                <form id="packageForm" method="POST">
                  <?php echo csrf_field(); ?>
                  <div class="row">

                    <!-- Left Column -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Package Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter package name" required>
                      </div>

                      <div class="form-group">
                        <label for="mrp">MRP</label>
                        <input type="number" class="form-control" id="mrp" name="mrp" placeholder="Enter MRP" required>
                      </div>

                      <div class="form-group">
                        <label for="discount">Discount (%)</label>
                        <input type="number" class="form-control" id="discount" name="discount" placeholder="Enter discount %">
                      </div>

                      <div class="form-group">
                        <label for="offered_price">Offered Price</label>
                        <input type="number" class="form-control" id="offered_price" placeholder="Auto calculated" readonly>
                      </div>

                      <div class="form-group">
                        <label for="listings">Number of Listings</label>
                        <input type="number" class="form-control" id="listings" name="listings" placeholder="Enter number of listings">
                      </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="listing_duration">Listing Duration (days)</label>
                        <input type="number" class="form-control" id="listing_duration" name="listing_duration" placeholder="Enter listing duration">
                      </div>

                      <div class="form-group">
                        <label for="validity">Package Validity (days)</label>
                        <input type="number" class="form-control" id="validity" name="validity" placeholder="Enter validity in days">
                      </div>

                      <div class="form-group">
                        <label for="promotions">Promotions (per month)</label>
                        <input type="number" class="form-control" id="promotions" name="promotions" placeholder="Enter number of promotions">
                      </div>

                      <div class="form-group">
                        <label for="sponsors_days">Sponsors on Front Page (days)</label>
                        <input type="number" class="form-control" id="sponsors_days" name="sponsors_days" placeholder="Enter sponsor days">
                      </div>

                      <div class="form-group">
                        <label for="alerts">Listing Alerts</label>
                        <select class="form-control" id="alerts" name="alerts" required>
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                        </select>
                      </div>

                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_popular" name="is_popular" value="1">
                        <label class="form-check-label" for="is_popular">Set as Popular</label>
                      </div>
                    </div>
                  </div>

                  <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-2">Save Package</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function () {
      // Auto calculate offered price
      $('#discount, #mrp').on('input', function () {
        let mrp = parseFloat($('#mrp').val()) || 0;
        let discount = parseFloat($('#discount').val()) || 0;
        let offered = mrp - (mrp * discount / 100);
        $('#offered_price').val(offered.toFixed(2));
      });

      // Form submit via AJAX
      $('#packageForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
          url: "<?php echo e(route('admin.packages.store')); ?>",
          type: "POST",
          data: $(this).serialize(),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Package added successfully!',
              timer: 2000,
              showConfirmButton: false
            }).then(() => {
              window.location.href = "<?php echo e(route('admin.packages.index')); ?>";
            });
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/packages/create.blade.php ENDPATH**/ ?>