

<?php $__env->startSection('title', $seller->name . ' | Seller Profile'); ?>

<?php $__env->startSection('content'); ?>

    <section class="card-area padding-top-60px padding-bottom-90px" style="margin-top: 100px;">
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">

                    <div class="card shadow-sm text-center">
                        <div class="card-body">

                            
                            <div class="mb-3">
                                <img src="<?php echo e($seller->profile_pic
        ? asset('storage/' . $seller->profile_pic)
        : asset('user_assets/images/users/profile-pic.jpg')); ?>" class="rounded-circle"
                                    style="width:140px;height:140px;object-fit:cover;" alt="Seller Image">
                            </div>

                            
                            <h4 class="mb-1">
                                <?php echo e($seller->name); ?>

                            </h4>

                            
                            <?php if($seller->is_verified): ?>
                                <span class="badge badge-success mb-2">Verified Seller</span>
                            <?php endif; ?>

                            
                            <div class="mt-3 text-muted small">
                                <p class="mb-1">
                                    <strong>Country:</strong>
                                    <?php echo e($seller->countryname->name ?? '-'); ?>

                                </p>

                                <p class="mb-1">
                                    <strong>Member Since:</strong>
                                    <?php echo e($seller->created_at->format('M Y')); ?>

                                </p>

                                <p class="mb-0">
                                    <strong>Total Listings:</strong>
                                    <?php echo e($seller->listing_count); ?>

                                </p>
                            </div>

                            
                            <div class="mt-4">
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary btn-sm">
                                    ← Back
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/seller-profile.blade.php ENDPATH**/ ?>