

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_tags'); ?>
    <meta name="title" content="<?php echo e($page->meta_title); ?>">
    <meta name="description" content="<?php echo e($page->meta_description); ?>">
    <meta name="keywords" content="<?php echo e($page->meta_keyword); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($page && $page->status === 'published'): ?>
        <section class="breadcrumb-area bread-bg">
            <div class="overlay"></div>
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2 class="sec__title text-white mb-3"><?php echo e($page->page_name); ?></h2>
                    <ul class="bread-list">
                        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li><?php echo e($page->page_name); ?></li>
                    </ul>
                </div>
            </div>
            <div class="bread-svg">
                <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                    <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
                </svg>
            </div>
        </section>
        <section class="blog-area padding-top-60px padding-bottom-70px">
            <div class="container">

                <div><?php echo $page->detail; ?></div>
            </div>
        </section>

    <?php else: ?>
        <div class="page-wrapper">
            <div class="page-content text-center py-5">
                <h3>Page not found or unpublished.</h3>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/dynamic_page.blade.php ENDPATH**/ ?>