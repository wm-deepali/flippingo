

<?php $__env->startSection('title', 'My Subscription'); ?>

<style>
    .subscription-modal-overlay {
        display: none;
        /* hide by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    /* visible state */
.subscription-modal-overlay.active {
    display: flex !important;
}

    .subscription-modal-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        max-width: 500px;
        width: 90%;
        position: relative;
    }

    .subscription-modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }
</style>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="subscription-page">
            <h2 class="subscription-title">My Subscription</h2>

            <?php if($subscription): ?>
                <div class="subscription-cards" id="withSubscription">
                    <div class="subscription-card active-subscription">
                        <div class="subscription-card-content">
                            <h3>⭐ Subscription</h3>
                            <p><strong>Plan:</strong> <?php echo e($subscription->package->name); ?></p>
                            <p><strong>Start Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($subscription->start_date)->format('d-M-Y')); ?></p>
                            <p><strong>Expiry Date:</strong>
                                <?php echo e(\Carbon\Carbon::parse($subscription->end_date)->format('d-M-Y')); ?></p>
                            <p><strong>Status:</strong> <?php echo e(ucfirst($subscription->status)); ?></p>
                        </div>
                        <div class="subscription-card-footer">
                            <?php if($subscription->status === 'active'): ?>
                                <button class="subscription-btn" onclick="openRenewModal()">Renew</button>
                                <?php if($canCancel): ?>
                                    <button class="subscription-btn cancel-btn" onclick="openCancelModal()">Cancel</button>
                                <?php endif; ?>
                            <?php elseif($subscription->status === 'cancel_requested'): ?>
                                <p class="text-warning">Cancellation requested on
                                    <?php echo e(\Carbon\Carbon::parse($subscription->cancel_requested_at)->format('d-M-Y')); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Upgrade Card -->
                    <div class="subscription-card outline-subscription">
                        <div class="subscription-outline-content">
                            <select id="upgradePlan" class="subscription-btn">
                                <option value="">Upgrade Now</option>
                                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($package->id !== $subscription->package_id): ?>
                                        <option value="<?php echo e($package->id); ?>"><?php echo e($package->name); ?> - ₹<?php echo e($package->offered_price); ?>

                                        </option>
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
                                    <option value="<?php echo e($package->id); ?>"><?php echo e($package->name); ?> - ₹<?php echo e($package->offered_price); ?>

                                    </option>
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
                        <p>Renew for <strong><?php echo e($subscription->package->validity); ?>

                                <?php echo e($subscription->package->validity_unit); ?></strong> at
                            <strong>₹<?php echo e($subscription->package->offered_price); ?></strong>.
                        </p>
                        <form action="<?php echo e(route('subscription.renew')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="subscription_id" value="<?php echo e($subscription->id); ?>">
                            <button type="submit" class="subscription-btn">Confirm Renewal</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Cancel Modal -->
        <div class="subscription-modal-overlay" id="cancelModal">
            <div class="subscription-modal-box">
                <div class="subscription-modal-header">
                    <h3>❌ Cancel Subscription</h3>
                    <button class="subscription-modal-close" onclick="closeCancelModal()">×</button>
                </div>
                <div class="subscription-modal-body">
                    <p>You are requesting to cancel your subscription. Please provide a reason:</p>
                    <form action="<?php echo e(route('subscription.cancelRequest')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if($subscription): ?>
                            <input type="hidden" name="subscription_id" value="<?php echo e($subscription->id); ?>">
                        <?php endif; ?>

                        <textarea name="reason" required class="subscription-textarea"></textarea>
                        <button type="submit" class="subscription-btn">Submit Cancel Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("cancelModal").style.display = "none";
            document.getElementById("renewModal").style.display = "none";
        });

     function openCancelModal() {
    document.getElementById("cancelModal").classList.add("active");
}
function closeCancelModal() {
    document.getElementById("cancelModal").classList.remove("active");
}

function openRenewModal() {
    document.getElementById("renewModal").classList.add("active");
}
function closeRenewModal() {
    document.getElementById("renewModal").classList.remove("active");
}

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/subscriptions.blade.php ENDPATH**/ ?>