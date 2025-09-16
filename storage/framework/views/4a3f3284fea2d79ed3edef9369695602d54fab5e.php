

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Contact Us'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">

        <div class="contact-us-page">
            <h2 class="contact-title">Contact Us</h2>
            <div class="contact-cards">
                <!-- Email & Mobile -->
                <div class="contact-card email-card">
                    <h3><i class="fas fa-envelope"></i> Email & Mobile</h3>
                    <p><strong>Email:</strong> <?php echo e(setting('footer_email', 'support@example.com')); ?></p>
                    <p><strong>Mobile:</strong> <?php echo e(setting('footer_helpline', '+91 9876543210')); ?></p>

                </div>

                <!-- Full Address -->
                <div class="contact-card address-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Full Address</h3>
                    <p>Flippingo Pvt Ltd</p>
                    <p><?php echo e(setting('footer_address', '2nd Floor, Business Tower, MG Road')); ?></p>
                </div>

                <!-- Live Chat -->
                <div class="contact-card chat-card">
                    <h3><i class="fas fa-comments"></i> Live Chat</h3>
                    <p>Chat with our support team for instant help.</p>
                    <button class="chat-btn"><i class="fas fa-comment-dots"></i> Start Chat</button>
                </div>
            </div>
        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>



<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/contact-us.blade.php ENDPATH**/ ?>