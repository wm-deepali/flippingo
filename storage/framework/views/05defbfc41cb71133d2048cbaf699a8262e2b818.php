

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
        <div class="page-wrapper">
            <div class="page-content">
                <div><?php echo $page->detail; ?></div>
            </div>
        </div>
    <?php else: ?>
        <div class="page-wrapper">
            <div class="page-content text-center py-5">
                <h3>Page not found or unpublished.</h3>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/dynamic_page.blade.php ENDPATH**/ ?>