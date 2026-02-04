

<?php $__env->startSection('content'); ?>
    <div class="app-content content mb-3">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card p-4 shadow-sm" style="max-width: 900px; margin: auto; background: #fff;">

                    
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="mb-0" style="font-weight:700;">INVOICE</h2>
                            <small class="text-muted" style="font-weight:600;">
                                <?php echo e($order->invoice->invoice_number ?? '#INV-1001'); ?>

                            </small>
                        </div>
                        <div>
                            <?php if(setting('billing_logo')): ?>
                                <img src="<?php echo e(asset('storage/' . setting('billing_logo'))); ?>" alt="Logo"
                                    style="height: 60px; padding:10px; background:#000; border-radius:4px;">
                            <?php else: ?>
                                <img src="<?php echo e(asset('admin_assets/images/logo.png')); ?>" alt="Logo"
                                    style="height: 60px; padding:10px; background:#000; border-radius:4px;">
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="row border-top border-bottom mb-4" style="font-size: 14px;">
                        <div class="col-md-4 p-2">
                            <strong>Info</strong>
                            <hr>
                            <p><strong>Invoice Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d M, Y')); ?></p>
                            <p><strong>Order Id:</strong> <?php echo e($order->order_number); ?></p>
                            <p><strong>Payment Status:</strong> <?php echo e(ucfirst($order->payment->status ?? '-')); ?></p>
                            <p><strong>Payment Method:</strong> <?php echo e(ucfirst($order->payment->gateway ?? '-')); ?></p>
                            <p><strong>Payment Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($order->payment->created_at ?? now())->format('d M, Y')); ?></p>
                        </div>

                        <div class="col-md-4 border-left border-right p-2">
                            <strong>Billed to</strong>
                            <hr>
                            <p style="margin-bottom:6px; font-weight:600;"><?php echo e($order->customer->first_name ?? ''); ?>

                                <?php echo e($order->customer->last_name ?? ''); ?>

                            </p>
                            <p style="margin-bottom:6px;"><?php echo e($order->customer->full_address ?? ''); ?></p>
                            <p style="margin-bottom:4px;"><?php echo e($order->customer->mobile ?? ''); ?></p>
                            <p style="margin-bottom:6px; color:blue;"><?php echo e($order->customer->email ?? ''); ?></p>
                        </div>

                        <div class="col-md-4 p-2">
                            <strong>From</strong>
                            <hr>
                            <p style="margin-bottom:6px; font-weight:600;">
                                <?php echo e(setting('billing_website', 'Flippingo Private Limited')); ?>

                            </p>
                            <p style="margin-bottom:6px;">
                                <?php echo e(setting('billing_address', 'Old Palasia, Indore, MP, 452001, India')); ?>

                            </p>
                            <p style="margin-bottom:4px;"><?php echo e(setting('billing_contact', '+91 8809772278')); ?></p>
                            <p style="color:blue;"><?php echo e(setting('billing_email', 'support@flippingo.com')); ?></p>
                        </div>
                    </div>

                    
                    <h5 class="mb-2">Item Summary</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 14px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Rate (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                                    <th>Total (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subtotal = 0;
                                ?>

                                <?php if($type === 'subscription' && $order->package): ?>
                                    <?php
                                        $subtotal = $order->package->offered_price ?? 0;
                                          $total = $subtotal;
                                    ?>
                                    <tr>
                                        <td><?php echo e($order->package->name); ?></td>
                                        <td>1</td>
                                        <td><?php echo e(number_format($order->package->offered_price, 2)); ?></td>
                                        <td><?php echo e(number_format($subtotal, 2)); ?></td>
                                    </tr>
                                <?php elseif($type === 'product'): ?>
                                    <?php
                                        $subtotal = $order->product['offeredPrice'] ?? 0;
                                        $total = $order->total;
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
                                        <td><?php echo e(number_format($subtotal, 2)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    
                   
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i>
                                        <?php echo e(number_format($subtotal, 2)); ?></td>
                                </tr>
                                <?php if($type === 'product'): ?>
                                    <tr>
                                        <th>IGST:</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i>
                                            <?php echo e(number_format($order->igst ?? 0, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <th>CGST:</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i>
                                            <?php echo e(number_format($order->cgst ?? 0, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <th>SGST:</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i>
                                            <?php echo e(number_format($order->sgst ?? 0, 2)); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <tr class="font-weight-bold"
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th>Total</th>
                                    <td class="text-right"><strong><i class="fa-solid fa-indian-rupee-sign"></i>
                                            <?php echo e(number_format($total, 2)); ?></strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="<?php echo e(route('admin.orders.invoice.download', ['type' => $type, 'id' => $order->id])); ?>"
                                class="btn btn-outline-primary btn-block" target="_blank">Download Invoice</a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success btn-block">Send via Email</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/payments/invoice.blade.php ENDPATH**/ ?>