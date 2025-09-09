

<?php $__env->startSection('title', 'My Subscription'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="subscription-page">
            <h2 class="subscription-title">My Subscription</h2>

            <?php if($subscription): ?>
                <div class="subscription-cards" id="withSubscription">
                    <!-- Active Subscription Card -->
                    <div class="subscription-card active-subscription">
                        <div class="subscription-card-content">
                            <h3>⭐ Active Subscription</h3>
                            <p><strong>Plan:</strong> <?php echo e($subscription->package->name); ?></p>
                            <p><strong>Start Date:</strong> <?php echo e(\Carbon\Carbon::parse($subscription->start_date)->format('d-M-Y')); ?></p>
                            <p><strong>Expiry Date:</strong> <?php echo e(\Carbon\Carbon::parse($subscription->end_date)->format('d-M-Y')); ?></p>
                            <p><strong>Status:</strong> <?php echo e(ucfirst($subscription->status)); ?></p>
                        </div>
                        <div class="subscription-card-footer">
                            <button class="subscription-btn" onclick="openRenewModal()">Renew</button>
                        </div>
                    </div>

                    <!-- Upgrade Card -->
                    <div class="subscription-card outline-subscription">
                        <div class="subscription-outline-content">
                            <select id="upgradePlan" class="subscription-btn">
                                <option value="">Upgrade Now</option>
                                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($package->id !== $subscription->package_id): ?>
                                        <option value="<?php echo e($package->id); ?>"><?php echo e($package->name); ?> - ₹<?php echo e($package->offered_price); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="subscription-empty" id="noSubscription">
                    <div class="subscription-card outline-subscription">
                        <div class="subscription-outline-content">
                            <select id="newPlan" class="subscription-btn">
                                <option value="">Get Subscription</option>
                                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($package->id); ?>"><?php echo e($package->name); ?> - ₹<?php echo e($package->offered_price); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Renew Modal -->
        <div class="subscription-modal-overlay" id="renewModal">
            <div class="subscription-modal-box">
                <div class="subscription-modal-header">
                    <h3>🔄 Renew Subscription</h3>
                    <button class="subscription-modal-close" onclick="closeRenewModal()">×</button>
                </div>
                <div class="subscription-modal-body">
                    <?php if($subscription): ?>
                        <p>Your current plan is <strong><?php echo e($subscription->package->name); ?></strong>.</p>
                        <p>Renew for <strong><?php echo e($subscription->package->validity); ?> <?php echo e($subscription->package->validity_unit); ?></strong> at <strong>₹<?php echo e($subscription->package->offered_price); ?></strong>.</p>
                        <form action="<?php echo e(route('subscription.renew')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="subscription_id" value="<?php echo e($subscription->id); ?>">
                            <button type="submit" class="subscription-btn">Confirm Renewal</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function openRenewModal() {
    document.getElementById("renewModal").style.display = "flex";
}
function closeRenewModal() {
    document.getElementById("renewModal").style.display = "none";
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/subscriptions.blade.php ENDPATH**/ ?>