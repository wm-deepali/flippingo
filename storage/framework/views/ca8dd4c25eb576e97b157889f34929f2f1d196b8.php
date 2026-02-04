

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
                                <li class="breadcrumb-item active">Seller Payouts</li>
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
                            <h4>Seller Payouts</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Seller</th>
                                            <th>Amount (₹)</th>
                                            <th>Status</th>
                                            <th>Payment Method</th>
                                            <th>Requested At</th>
                                            <th>Processed At</th>
                                            <th>Processed By</th>
                                            <th>Payment Date</th>
                                            <th>Reference ID</th>
                                            <th>Remarks</th>
                                            <th>Screenshot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($req->id); ?></td>

                                            <td>
                                                <?php echo e($req->customer->customer_id ?? '-'); ?><br>
                                                <?php echo e($req->customer->first_name ?? ''); ?> <?php echo e($req->customer->last_name ?? ''); ?><br>
                                                <?php echo e($req->customer->email ?? '-'); ?>

                                            </td>

                                            <td>₹<?php echo e(number_format($req->amount, 2)); ?></td>

                                            <td>
                                                <span class="badge bg-success"><?php echo e(ucfirst($req->status)); ?></span>
                                            </td>

                                            <td>
                                                <?php if($req->paymentMethod): ?>
                                                    <strong>Type:</strong> <?php echo e($req->paymentMethod->type); ?><br>
                                                    <?php switch($req->paymentMethod->type):
                                                        case ('bank'): ?>
                                                            <strong>Account Name:</strong> <?php echo e($req->paymentMethod->account_holder_name ?? '-'); ?><br>
                                                            <strong>Account Number:</strong> <?php echo e($req->paymentMethod->account_number ?? '-'); ?><br>
                                                            <strong>Bank:</strong> <?php echo e($req->paymentMethod->bank_name ?? '-'); ?><br>
                                                            <strong>IFSC:</strong> <?php echo e($req->paymentMethod->ifsc_code ?? '-'); ?>

                                                        <?php break; ?>
                                                        <?php case ('upi'): ?>
                                                            <strong>Receiver Name:</strong> <?php echo e($req->paymentMethod->receiver_name ?? '-'); ?><br>
                                                            <strong>UPI ID:</strong> <?php echo e($req->paymentMethod->upi_id ?? '-'); ?>

                                                        <?php break; ?>
                                                        <?php case ('paypal'): ?>
                                                            <strong>PayPal Email:</strong> <?php echo e($req->paymentMethod->paypal_email ?? '-'); ?>

                                                        <?php break; ?>
                                                        <?php case ('wire'): ?>
                                                            <strong>Account Name:</strong> <?php echo e($req->paymentMethod->account_holder_name ?? '-'); ?><br>
                                                            <strong>Account Number:</strong> <?php echo e($req->paymentMethod->account_number ?? '-'); ?><br>
                                                            <strong>Bank:</strong> <?php echo e($req->paymentMethod->bank_name ?? '-'); ?><br>
                                                            <strong>Bank Address:</strong> <?php echo e($req->paymentMethod->bank_address ?? '-'); ?><br>
                                                            <strong>Bank Swift Code:</strong> <?php echo e($req->paymentMethod->swift_code ?? '-'); ?><br>
                                                            <strong>IBAN Number:</strong> <?php echo e($req->paymentMethod->iban_number ?? '-'); ?>

                                                        <?php break; ?>
                                                        <?php default: ?>
                                                            Details not available
                                                    <?php endswitch; ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>

                                            <td><?php echo e($req->created_at->format('Y-m-d H:i')); ?></td>
                                            <td><?php echo e($req->processed_at ? $req->processed_at->format('Y-m-d H:i') : '-'); ?></td>
                                            <td><?php echo e($req->processedBy ? $req->processedBy->name : '-'); ?></td>
                                            <td><?php echo e($req->payment_date ? $req->payment_date->format('Y-m-d') : '-'); ?></td>
                                            <td><?php echo e($req->reference_id ?? '-'); ?></td>
                                            <td><?php echo e($req->remarks ?? '-'); ?></td>
                                            <td>
                                                <?php if($req->screenshot): ?>
                                                    <a href="<?php echo e(asset('storage/' . $req->screenshot)); ?>" target="_blank">View</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>

                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php echo e($requests->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/wallets/seller-payouts.blade.php ENDPATH**/ ?>