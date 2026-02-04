

<?php $__env->startSection('title'); ?>
    Thank You | Flippingo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="breadcrumb-area bread-bg" style="margin-top: 40px;">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="sec__title text-white mb-3">Thank You</h2>
                <ul class="bread-list">
                    <li><a href=<?php echo e(Route('home')); ?>>home</a></li>
                    <li>Thank You</li>
                </ul>
            </div>
        </div>
        <div class="bread-svg">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
            </svg>
        </div>
    </section>



    <section class="card-area padding-top-60px padding-bottom-90px">
        <div class="container text-center">
            <h1 class="text-success">🎉 Thank You!</h1>
            <p>Your order has been placed successfully.</p>

            <?php if($order): ?>
                <p><strong>Order Number:</strong> <?php echo e($order->order_number); ?></p>
                <p><strong>Invoice Number:</strong> <?php echo e($order->invoice->invoice_number ?? 'Pending'); ?></p>
            <?php endif; ?>

            <a href="<?php echo e(route('home')); ?>" class="btn btn-primary mt-3">Home</a>
        </div>
    </section>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/thank-you.blade.php ENDPATH**/ ?>