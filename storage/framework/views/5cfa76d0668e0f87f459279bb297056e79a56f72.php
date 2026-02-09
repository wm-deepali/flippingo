

<?php $__env->startSection('title', 'KYC & Bank Verification'); ?>

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-wrapper">

            
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('admin.customers.index')); ?>">Customers</a>
                        </li>
                        <li class="breadcrumb-item active">KYC & Bank Details</li>
                    </ol>
                </div>
            </div>

            <div class="content-body">
                <div class="row">

                    
                    <div class="col-md-12">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h4 class="card-title">Customer Information</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> <?php echo e($customer->name); ?></p>
                                <p><strong>Email:</strong> <?php echo e($customer->email); ?></p>
                                <p><strong>Mobile:</strong> <?php echo e($customer->mobile ?? '-'); ?></p>
                                <p><strong>Country:</strong> <?php echo e($customer->countryname->name ?? '-'); ?></p>

                                <p>
                                    <strong>Status:</strong>
                                    <?php if($customer->is_verified): ?>
                                        <span class="badge badge-success">Verified</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">Pending Verification</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h4 class="card-title">KYC Details</h4>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">Legal / Entity Name</th>
                                        <td><?php echo e($customer->legal_name ?? '-'); ?></td>
                                    </tr>

                                    <?php
                                        $isIndian = strtolower(optional($customer->countryname)->name ?? '') === 'india';
                                        $kyc = $customer->kyc;
                                    ?>

                                    <?php if($isIndian): ?>
                                        <tr>
                                            <th>PAN Number</th>
                                            <td><?php echo e($kyc->pan_number ?? '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>PAN Document</th>
                                            <td>
                                                <?php if($kyc?->pan_document): ?>
                                                    <a href="<?php echo e(asset('storage/' . $kyc->pan_document)); ?>" target="_blank">View</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Aadhaar Number</th>
                                            <td><?php echo e($kyc->aadhaar_number ?? '-'); ?></td>
                                        </tr>

                                        <tr>
                                            <th>Aadhaar Front</th>
                                            <td>
                                                <?php if($kyc?->aadhaar_front): ?>
                                                    <a href="<?php echo e(asset('storage/' . $kyc->aadhaar_front)); ?>" target="_blank">View</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Aadhaar Back</th>
                                            <td>
                                                <?php if($kyc?->aadhaar_back): ?>
                                                    <a href="<?php echo e(asset('storage/' . $kyc->aadhaar_back)); ?>" target="_blank">View</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>GST Number</th>
                                            <td><?php echo e($kyc->gst_number ?? '-'); ?></td>
                                        </tr>

                                        <tr>
                                            <th>GST Certificate</th>
                                            <td>
                                                <?php if($kyc?->gst_document): ?>
                                                    <a href="<?php echo e(asset('storage/' . $kyc->gst_document)); ?>" target="_blank">View</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <th>Government ID Number</th>
                                            <td><?php echo e($kyc->personal_id_number ?? '-'); ?></td>
                                        </tr>

                                        <tr>
                                            <th>Government ID Document</th>
                                            <td>
                                                <?php if($kyc?->personal_id_document): ?>
                                                    <a href="<?php echo e(asset('storage/' . $kyc->personal_id_document)); ?>"
                                                        target="_blank">View</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                    <tr>
                                        <th>Entity Registration No</th>
                                        <td><?php echo e($kyc->entity_registration_number ?? '-'); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Entity Registration File</th>
                                        <td>
                                            <?php if($kyc?->entity_registration_document): ?>
                                                <a href="<?php echo e(asset('storage/' . $kyc->entity_registration_document)); ?>"
                                                    target="_blank">View</a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Tax Registration No</th>
                                        <td><?php echo e($kyc->tax_registration_number ?? '-'); ?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h4 class="card-title">Bank & Payment Methods</h4>
                            </div>
                            <div class="card-body">

                                <?php $__empty_1 = true; $__currentLoopData = $customer->paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="border p-1 mb-1">
                                        <strong><?php echo e(strtoupper($method->type)); ?></strong><br>

                                        <?php if($method->type === 'bank'): ?>
                                            Holder: <?php echo e($method->account_holder_name); ?><br>
                                            Account No: <?php echo e($method->account_number); ?><br>
                                            IFSC: <?php echo e($method->ifsc_code); ?><br>
                                            Bank: <?php echo e($method->bank_name); ?>

                                        <?php endif; ?>

                                        <?php if($method->type === 'upi'): ?>
                                            Receiver: <?php echo e($method->receiver_name); ?><br>
                                            UPI ID: <?php echo e($method->upi_id); ?>

                                        <?php endif; ?>

                                        <?php if($method->type === 'paypal'): ?>
                                            Receiver: <?php echo e($method->receiver_name); ?><br>
                                            Email: <?php echo e($method->paypal_email); ?>

                                        <?php endif; ?>

                                        <?php if($method->type === 'wire'): ?>
                                            Account Owner: <?php echo e($method->account_owner); ?><br>
                                            Bank: <?php echo e($method->bank_name); ?><br>
                                            SWIFT: <?php echo e($method->swift_code); ?>

                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p>No payment methods added.</p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <?php if($customer->is_verified): ?>

                                    
                                    <div class="alert alert-success">
                                        <strong>✔ User is Verified</strong><br>

                                        <?php if($customer->verified_at): ?>
                                            <small>
                                                Verified on:
                                                <?php echo e($customer->verified_at->format('d M Y, h:i A')); ?>

                                            </small><br>
                                        <?php endif; ?>

                                        <?php if($customer->verification_note): ?>
                                            <small>
                                                Note: <?php echo e($customer->verification_note); ?>

                                            </small>
                                        <?php endif; ?>
                                    </div>

                                    <form method="POST" action="<?php echo e(route('admin.customers.verify', $customer->id)); ?>">
                                        <?php echo csrf_field(); ?>

                                        <input type="hidden" name="action" value="reject">

                                        <div class="form-group">
                                            <label>Unverify Note (optional)</label>
                                            <textarea name="verification_note" class="form-control"
                                                placeholder="Reason for unverifying this user"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-danger">
                                            Unverify User
                                        </button>

                                        <a href="<?php echo e(route('admin.customers.index')); ?>" class="btn btn-secondary">
                                            Back
                                        </a>
                                    </form>

                                <?php else: ?>

                                    
                                    <form method="POST" action="<?php echo e(route('admin.customers.verify', $customer->id)); ?>">
                                        <?php echo csrf_field(); ?>

                                        <div class="form-group">
                                            <label>Verification Note (optional)</label>
                                            <textarea name="verification_note" class="form-control"
                                                placeholder="Reason for approval / rejection"></textarea>
                                        </div>

                                        <button name="action" value="approve" class="btn btn-success">
                                            Verify User
                                        </button>

                                        <button name="action" value="reject" class="btn btn-danger">
                                            Reject Verification
                                        </button>

                                        <a href="<?php echo e(route('admin.customers.index')); ?>" class="btn btn-secondary">
                                            Back
                                        </a>
                                    </form>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/customers/kyc-bank.blade.php ENDPATH**/ ?>