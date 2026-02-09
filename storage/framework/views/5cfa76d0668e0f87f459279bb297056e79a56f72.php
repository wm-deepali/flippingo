

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

                            <?php
                                $isIndian = strtolower(optional($customer->countryname)->name ?? '') === 'india';
                                $kyc = $customer->kyc;
                            ?>

                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Legal / Entity Name</th>
                                    <td><?php echo e($customer->legal_name ?? '-'); ?></td>
                                </tr>

                                <?php if($isIndian): ?>
                                    <tr><th>PAN Number</th><td><?php echo e($kyc->pan_number ?? '-'); ?></td></tr>
                                    <tr><th>Aadhaar Number</th><td><?php echo e($kyc->aadhaar_number ?? '-'); ?></td></tr>
                                    <tr><th>GST Number</th><td><?php echo e($kyc->gst_number ?? '-'); ?></td></tr>
                                <?php else: ?>
                                    <tr><th>Government ID</th><td><?php echo e($kyc->personal_id_number ?? '-'); ?></td></tr>
                                <?php endif; ?>

                                <tr><th>Entity Reg. No</th><td><?php echo e($kyc->entity_registration_number ?? '-'); ?></td></tr>
                                <tr><th>Tax Reg. No</th><td><?php echo e($kyc->tax_registration_number ?? '-'); ?></td></tr>
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
                                        Account: <?php echo e($method->account_number); ?><br>
                                        IFSC: <?php echo e($method->ifsc_code); ?>

                                    <?php endif; ?>

                                    <?php if($method->type === 'upi'): ?>
                                        UPI ID: <?php echo e($method->upi_id); ?>

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

            <form method="POST" action="<?php echo e(route('admin.customers.verify', $customer->id)); ?>">
                <?php echo csrf_field(); ?>

                
                <div class="form-group">
                    <label>Verification Note</label>
                    <textarea name="verification_note"
                              class="form-control"
                              placeholder="Add or update verification note"><?php echo e($customer->verification_note); ?></textarea>
                </div>

                
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox"
                               class="custom-control-input"
                               id="changeStatusSwitch"
                               name="change_status"
                               value="1"
                               <?php echo e($customer->is_verified ? 'checked' : ''); ?>>

                        <label class="custom-control-label" for="changeStatusSwitch">
                            Verify this user
                        </label>
                    </div>

                    <small class="text-muted">
                        Turn ON to verify the user. Turn OFF to mark as unverified.
                    </small>
                </div>

                
                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>

                <a href="<?php echo e(route('admin.customers.index')); ?>"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>
</div>


            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('changeStatusSwitch');
    const buttons = document.querySelectorAll('.verify-btn');

    function updateButtons() {
        buttons.forEach(btn => btn.disabled = !toggle.checked);
    }

    toggle.addEventListener('change', updateButtons);
    updateButtons();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/customers/kyc-bank.blade.php ENDPATH**/ ?>