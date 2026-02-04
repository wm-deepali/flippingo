

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Order Details'); ?>

<?php $__env->stopSection(); ?>

<style>
    .order-invoice {
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }

</style>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="order-invoice">
          
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
                            <h5><strong>Order ID:</strong> <?php echo e($order->order_number); ?></h5>
                            <h5>
                                <strong>Payment Status:</strong>
                                <span class="badge badge-success">Paid</span>
                            </h5>
                            <h5>
                                <strong>Order Status:</strong>
                                <?php $status = $order->currentStatus->status ?? 'N/A'; ?>
                                <?php switch($status):
                                    case ('recent'): ?>
                                        <span class="badge badge-primary">Recent</span>
                                        <?php break; ?>
                                    <?php case ('approved'): ?>
                                        <span class="badge badge-secondary">Approved</span>
                                        <?php break; ?>
                                    <?php case ('processing'): ?>
                                        <span class="badge badge-info">Processing</span>
                                        <?php break; ?>
                                    <?php case ('delivered'): ?>
                                        <span class="badge badge-success">Delivered</span>
                                        <?php break; ?>
                                    <?php case ('cancel_requested'): ?>
                                        <span class="badge badge-warning">Cancel Requested</span>
                                        <?php break; ?>
                                    <?php case ('cancelled'): ?>
                                        <span class="badge badge-danger">Cancelled</span>
                                        <?php break; ?>
                                    <?php default: ?>
                                        <span class="badge badge-light"><?php echo e(ucfirst($status)); ?></span>
                                <?php endswitch; ?>
                            </h5>
                        </div>
                    </div>

                    
                    <div class="row border p-3 mb-4">
                        <div class="col-md-6">
                            <h5><strong>Customer Info</strong></h5>
                            <p><strong>Name:</strong> <?php echo e($order->customer->first_name ?? ''); ?> <?php echo e($order->customer->last_name ?? ''); ?></p>
                            <p><strong>Contact:</strong> <?php echo e($order->customer->mobile ?? ''); ?></p>
                            <p><strong>Email:</strong> <?php echo e($order->customer->email ?? ''); ?></p>
                            <p><strong>Delivery Address:</strong> <?php echo e($order->customer->full_address ?? ''); ?></p>
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

                    
                    <h5 class="mb-2">Items</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 60%;">Detail</th>
                                    <th style="width: 20%;">Quantity</th>
                                    <th style="width: 20%;">Price (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                  <?php
                                        $subtotal = $order->product['offeredPrice'] ?? 0;
                                    ?>
                                <tr>
                                    <td>
                                         <?php echo e($order->product['productTitle']); ?>

                                            <?php if($order->product['category']): ?>
                                                <br><small>Category: <?php echo e($order->product['category']); ?></small>
                                            <?php endif; ?>
                                            <?php if($order->product['productPhoto']): ?>
                                                <br><img src="<?php echo e(asset('storage/' . $order->product['productPhoto'])); ?>" alt="Product Image"
                                                    width="80">
                                            <?php endif; ?>
                                        
                                    </td>
                                    <td>1</td>
                                    <td><?php echo e(number_format($subtotal, 2)); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    
<div class="row justify-content- mb-3">
    <div class="col-md-5">
        <table class="table table-borderless">
            <tr>
                <th>Commission (<?php echo e($order->commission_rate); ?>%):</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($order->commission_amount, 2)); ?></td>
            </tr>
            <tr>
                <th>Seller Earning:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($order->seller_earning, 2)); ?></td>
            </tr>
        </table>
    </div>
</div>

                   
<div class="row justify-content-end mt-4">
    <div class="col-md-5">
        <table class="table table-borderless">
            <tr>
                <th>Subtotal:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($order->amount, 2)); ?></td>
            </tr>
            <tr>
                <th>IGST:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($order->igst, 2)); ?></td>
            </tr>
            <tr>
                <th>CGST:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($order->cgst, 2)); ?></td>
            </tr>
            <tr>
                <th>SGST:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($order->sgst, 2)); ?></td>
            </tr>
            <tr class="border-top">
                <th><strong>Grand Total:</strong></th>
                <td class="text-right"><strong><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo e(number_format($order->total, 2)); ?></strong></td>
            </tr>
            
        </table>
    </div>
</div>

   <hr>

                    
                    <div class="row justify-content-center">
                        <div class="col-md-2">
                        <a href="#" class="btn btn-primary btn-block">Download PDF</a>
                        </div>
                       
                    </div>

                </div>
            </div>
        
</div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/orders/details.blade.php ENDPATH**/ ?>