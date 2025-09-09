

<?php $__env->startSection('content'); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row mb-2">
        <div class="col-md-6">
          <h4 class="mb-0">Order Details</h4>
        </div>
      </div>

      <div class="content-body">
        <div class="card">
          <div class="card-body">

            
            <div class="text-center mb-3">
              <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="Logo" style="height: 60px;padding:10px;background:#000;border-radius:4px;" >
            </div>

            
            <div class="row mb-4">
              <div class="col-md-6">
                <h5><strong>Order ID:</strong> #ORD-2025</h5>
                <h5>
                  <strong>Payment Status:</strong>
                  <span class="badge badge-success">Paid</span>
                </h5>
                <h5>
                  <strong>Order Status:</strong>
                  <span class="badge badge-success">Approved</span>
                </h5>
              </div>

              <div class="col-md-6">
                <label><strong>Update Status:</strong></label>
                <select class="form-control">
                  <option value="">Select Status</option>
                  <option value="approved">Approve Order</option>
                  <option value="process">Process to Department</option>
                  <option value="cancelled">Cancel Order</option>
                </select>

                <div class="mt-2">
                  <label><strong>Select Department:</strong></label>
                  <select class="form-control">
                    <option value="">Select Department</option>
                    <option>Design</option>
                    <option>Printing</option>
                    <option>Dispatch</option>
                  </select>
                </div>
              </div>
            </div>

            
            <div class="row border p-3 mb-4">
              <div class="col-md-6">
                <h5><strong>Customer Info</strong></h5>
                <p><strong>Name:</strong> John Doe</p>
                <p><strong>Contact:</strong> +44 123 456 789</p>
                <p><strong>Email:</strong> johndoe@email.com</p>
                <p><strong>Expected Delivery:</strong> 10 Sep 2025</p>
                <p><strong>Date & Time:</strong> 05 Sep 2025, 10:30 AM</p>
                <p><strong>Delivery Address:</strong> 123 Street Name, London, UK</p>
              </div>
              <div class="col-md-6 text-right">
                <h5><strong>Company Info</strong></h5>
                <p><strong>Name:</strong> My Company Name</p>
                <p><strong>Contact:</strong> 0-00-000-000</p>
                <p><strong>Email:</strong> yourcompany@gmail.com</p>
                <p><strong>Address:</strong> Company Street, NY 1001-234</p>
                <p><strong>Website:</strong> www.company.com</p>
              </div>
            </div>

            
            <h5 class="mb-2">Quote Items</h5>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 60%;">Detail</th>
                    <th style="width: 20%;">Quantity</th>
                    <th style="width: 20%;">Price (£)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div style="font-weight: 600;">Business Cards (Printing)</div>
                      <div style="font-size: 14px; margin-left: 10px;"><strong>Size:</strong> 85 x 55 mm</div>
                      <div style="font-size: 14px; margin-left: 10px;"><strong>Pages:</strong> 2</div>
                    </td>
                    <td>100</td>
                    <td>50.00</td>
                  </tr>
                  <tr>
                    <td>
                      <div style="font-weight: 600;">Flyers (Marketing)</div>
                      <div style="font-size: 14px; margin-left: 10px;"><strong>Size:</strong> A4</div>
                      <div style="font-size: 14px; margin-left: 10px;"><strong>Pages:</strong> 1</div>
                    </td>
                    <td>500</td>
                    <td>50.00</td>
                  </tr>
                  <tr>
                    <td><strong>Proof Type:</strong> Digital Proof</td>
                    <td>—</td>
                    <td>5.00</td>
                  </tr>
                </tbody>
              </table>
            </div>

            
            <div class="row justify-content-end mt-4">
              <div class="col-md-5">
                <table class="table table-borderless">
                  <tr>
                    <th>Subtotal:</th>
                    <td class="text-right">£105.00</td>
                  </tr>
                  <tr>
                    <th>Delivery Charge:</th>
                    <td class="text-right">£10.00</td>
                  </tr>
                  <tr>
                    <th>VAT (20%):</th>
                    <td class="text-right">£23.00</td>
                  </tr>
                  <tr class="border-top">
                    <th><strong>Grand Total:</strong></th>
                    <td class="text-right"><strong>£138.00</strong></td>
                  </tr>
                </table>
              </div>
            </div>

            <hr>

            
            <h5>Customer Documents</h5>
            <div class="table-responsive">
              <table class="table table-bordered mt-2">
                <thead>
                  <tr>
                    <th>Remarks / Title</th>
                    <th>Thumbnail</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Design File</td>
                    <td><img src="<?php echo e(asset('admin_assets/images/pdf.png')); ?>" width="40" alt="PDF" /></td>
                    <td><a href="#" class="btn btn-sm btn-info" target="_blank">View</a></td>
                  </tr>
                  <tr>
                    <td>Sample Image</td>
                    <td><img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" width="80" /></td>
                    <td><a href="#" class="btn btn-sm btn-info" target="_blank">View</a></td>
                  </tr>
                </tbody>
              </table>
            </div>

            
            <div class="row justify-content-center mt-4">
              <div class="col-md-2">
                <a href="#" class="btn btn-primary btn-block">Download PDF</a>
              </div>
              <div class="col-md-2">
                <button class="btn btn-success btn-block">Send Email</button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/packages/orderlist.blade.php ENDPATH**/ ?>