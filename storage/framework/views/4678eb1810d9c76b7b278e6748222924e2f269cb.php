

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
                            <?php if(setting('billing_logo')): ?>
                                <img src="<?php echo e(asset('storage/' . setting('billing_logo'))); ?>" alt="Logo"
                                    style="height: 60px; padding:10px; background:#000; border-radius:4px;">
                            <?php else: ?>
                                <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="Logo"
                                    style="height: 60px; padding:10px; background:#000; border-radius:4px;">
                            <?php endif; ?>
                        </div>

                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5><strong>Order ID:</strong><?php echo e($subscription->order_number); ?></h5>
                                <h5>
                                    <strong>Payment Status:</strong>
                                    <span class="badge badge-success">Paid</span>
                                </h5>
                                <h5>
                                    <strong>Subscription Status:</strong>
                                     <?php switch($subscription->status):
        case ('active'): ?>
            <span class="badge badge-primary">Active</span>
            <?php break; ?>
        <?php case ('expired'): ?>
            <span class="badge badge-secondary">Expired</span>
            <?php break; ?>
        <?php case ('cancel_requested'): ?>
            <span class="badge badge-warning">Cancel Requested</span>
            <?php break; ?>
        <?php case ('cancelled'): ?>
            <span class="badge badge-danger">Cancelled</span>
            <?php break; ?>
        <?php default: ?>
            <span class="badge badge-light"><?php echo e(ucfirst($sub->status)); ?></span>
    <?php endswitch; ?>
                                </h5>
                            </div>
                        </div>

                        
                        <div class="row border p-3 mb-4">
                            <div class="col-md-6">
                                <h5><strong>Customer Info</strong></h5>
                                <p><strong>Name:</strong> <?php echo e($subscription->customer->first_name ?? ''); ?>

                                    <?php echo e($subscription->customer->last_name ?? ''); ?>

                                </p>
                                <p><strong>Contact:</strong> <?php echo e($subscription->customer->mobile ?? ''); ?></p>
                                <p><strong>Email:</strong><?php echo e($subscription->customer->email ?? ''); ?></p>
                                <p><strong>Delivery Address:</strong><?php echo e($subscription->customer->full_address ?? ''); ?></p>
                            </div>
                           
                            <div class="col-md-6 text-right">
                                <h5><strong>Company Info</strong></h5>
                                <p><strong>Name:</strong> <?php echo e(setting('billing_website', 'Flippingo Private Limited')); ?></p>
                                <p><strong>Contact:</strong> <?php echo e(setting('billing_contact', '+91 8809772278')); ?></p>
                                <p><strong>Email:</strong> <?php echo e(setting('billing_email', 'support@flippingo.com')); ?></p>
                                <p><strong>Address:</strong> <?php echo e(setting('billing_address', 'Old Palasia, Indore, MP, 452001, India')); ?></p>
                                <p><strong>Website:</strong> <?php echo e(setting('billing_website', 'www.company.com')); ?></p>
                            </div>
                        </div>

                        
                        <h5 class="mb-2">Quote Items</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 60%;">Detail</th>
                                        <th style="width: 20%;">Quantity</th>
                                        <th style="width: 20%;">Price (<i class="fa-solid fa-indian-rupee-sign"></i> )</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e($subscription->package->name); ?></td>
                                        <td><?php echo e(1); ?></td>
                                        <td><?php echo e(number_format($subscription->package->offered_price, 2)); ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        
                        <div class="row justify-content-end mt-4">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Subtotal:</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($subscription->package->offered_price ?? 0, 2)); ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Delivery Charge:</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> 10.00</td>
                                    </tr>
                                    <tr>
                                        <th>VAT (20%):</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> 23.00</td>
                                    </tr> -->
                                    <tr class="border-top">
                                        <th><strong>Grand Total:</strong></th>
                                        <td class="text-right"><strong><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($subscription->package->offered_price ?? 0, 2)); ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>

                        
                        <!-- <h5>Customer Documents</h5>
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
                                        <td><img src="<?php echo e(asset('admin_assets/images/pdf.png')); ?>" width="40" alt="PDF" />
                                        </td>
                                        <td><a href="#" class="btn btn-sm btn-info" target="_blank">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Sample Image</td>
                                        <td><img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" width="80" /></td>
                                        <td><a href="#" class="btn btn-sm btn-info" target="_blank">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->

                        
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/subscriptions/show.blade.php ENDPATH**/ ?>