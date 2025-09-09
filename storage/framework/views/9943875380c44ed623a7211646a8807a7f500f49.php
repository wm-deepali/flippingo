

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
                            <strong class="mb-1">Info</strong>
                            <hr>
                            <p><strong>Invoice Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d M, Y')); ?></p>
                            <p><strong>Order Id:</strong> #ORD-<?php echo e($order->id); ?></p>
                            <p><strong>Payment Status:</strong> <?php echo e(ucfirst($order->payment->status ?? '-')); ?></p>
                            <p><strong>Payment Method:</strong> <?php echo e(ucfirst($order->payment->gateway ?? '-')); ?></p>
                            <p><strong>Payment Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($order->payment->created_at ?? now())->format('d M, Y')); ?></p>
                        </div>


                        <div class="col-md-4 border-left border-right p-2">
                            <strong class="mb-1">Billed to</strong>
                            <hr>
                            <p style="margin-bottom:6px; font-weight:600;"><?php echo e($order->customer->first_name ?? ''); ?>

                                <?php echo e($order->customer->last_name ?? ''); ?>

                            </p>
                            <p style="margin-bottom:6px;"><?php echo e($order->customer->full_address ?? ''); ?></p>
                            <p style="margin-bottom:4px;"><?php echo e($order->customer->mobile ?? ''); ?></p>
                            <p style="margin-bottom:6px; color:blue;"><?php echo e($order->customer->email ?? ''); ?></p>
                        </div>
                        
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">From</strong>
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
                                    <th>Rate (£)</th>
                                    <th>Total (£)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($type === 'subscription'): ?>
                                    <tr>
                                        <td><?php echo e($order->package->name); ?></td>
                                        <td><?php echo e(1); ?></td>
                                        <td><?php echo e(number_format($order->package->offered_price, 2)); ?></td>
                                        <td><?php echo e(number_format($order->package->offered_price, 2)); ?></td>
                                    </tr>
                                <?php elseif($type === 'product'): ?>
                                    <?php $__currentLoopData = $order->products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($product->name); ?></td>
                                            <td><?php echo e($product->pivot->quantity ?? 1); ?></td>
                                            <td><?php echo e(number_format($product->price, 2)); ?></td>
                                            <td><?php echo e(number_format(($product->pivot->quantity ?? 1) * $product->price, 2)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">£<?php echo e(number_format($order->subtotal ?? 0, 2)); ?></td>
                                </tr>
                                <!-- <tr>
                                            <th>Delivery Charge:</th>
                                            <td class="text-right">£<?php echo e(number_format($order->delivery_charge ?? 0, 2)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Proof Reading:</th>
                                            <td class="text-right">£<?php echo e(number_format($order->proof_reading_charge ?? 0, 2)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>VAT (20%):</th>
                                            <td class="text-right">£<?php echo e(number_format($order->vat ?? 0, 2)); ?></td>
                                        </tr> -->
                                <tr class="font-weight-bold"
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th><strong>Total</strong></th>
                                    <td class="text-right"><strong>£<?php echo e(number_format($order->total ?? 0, 2)); ?></strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="<?php echo e(route('admin.invoice.download', ['type' => $type, 'id' => $order->id])); ?>"
                                class="btn btn-outline-primary btn-block" target="_blank">
                                Download Invoice
                            </a>
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