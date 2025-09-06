

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Subscription'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', ['activeTab' => request('tab', 'buyer')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">

        <div class="subscription-page">
            <h2 class="subscription-title">My Subscription</h2>

            <!-- Case 1: User has active subscription -->
            <div class="subscription-cards" id="withSubscription">
                <!-- Active Subscription Card -->
                <div class="subscription-card active-subscription">
                    <div class="subscription-card-content">
                        <h3>⭐ Active Subscription</h3>
                        <p><strong>Plan:</strong> Premium Plan</p>
                        <p><strong>Start Date:</strong> 01-Sep-2025</p>
                        <p><strong>Expiry Date:</strong> 30-Sep-2025</p>
                        <p><strong>Status:</strong> Active</p>
                    </div>
                    <div class="subscription-card-footer">
                        <button class="subscription-btn" onclick="openRenewModal()">Renew</button>
                    </div>
                </div>

                <!-- Upgrade Card -->
                <div class="subscription-card outline-subscription">
                    <div class="subscription-outline-content">
                        <button class="subscription-btn">Upgrade Now</button>
                    </div>
                </div>
            </div>

            <!-- Case 2: No Subscription -->
            <div class="subscription-empty" id="noSubscription" style="display:none;">
                <div class="subscription-card outline-subscription">
                    <div class="subscription-outline-content">
                        <button class="subscription-btn">Get Subscription</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Renew Modal -->
        <div class="subscription-modal-overlay" id="renewModal">
            <div class="subscription-modal-box">
                <div class="subscription-modal-header">
                    <h3>🔄 Renew Subscription</h3>
                    <button class="subscription-modal-close" onclick="closeRenewModal()">×</button>
                </div>
                <div class="subscription-modal-body">
                    <p>Your current plan is <strong>Premium Plan</strong>.</p>
                    <p>Please confirm to renew for <strong>1 Month</strong> at <strong>₹499</strong>.</p>
                    <button class="subscription-btn">Confirm Renewal</button>
                </div>
            </div>
        </div>


    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        // Example: Toggle subscription condition
        let hasSubscription = true; // backend se check karna hoga

        if (hasSubscription) {
            document.getElementById("withSubscription").style.display = "flex";
            document.getElementById("noSubscription").style.display = "none";
        } else {
            document.getElementById("withSubscription").style.display = "none";
            document.getElementById("noSubscription").style.display = "block";
        }
        function openRenewModal() {
            document.getElementById("renewModal").style.display = "flex";
        }
        function closeRenewModal() {
            document.getElementById("renewModal").style.display = "none";
        }

    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/subscriptions.blade.php ENDPATH**/ ?>