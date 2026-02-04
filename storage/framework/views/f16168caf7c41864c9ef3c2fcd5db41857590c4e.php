

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Wishlist'); ?>

<?php $__env->stopSection(); ?>


<style>
    .wishlist-container {

        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);


    }

    .wishlist-cont {
        height: 300px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .wishlist-create {
        background-color: #000;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .wishlist-container p {
        color: #666;
        margin-top: 10px;
    }

    .wishlist-item {
        display: inline-block;
        background: white;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 10px;
        width: 200px;
        text-align: left;
    }

    .wishlist-item .item-tags {
        display: flex;
        gap: 5px;
    }

    .wishlist-item .item-tags span {
        background: #e0e0e0;
        padding: 2px 10px;
        border-radius: 10px;
        font-size: 12px;
    }

    .wishlist-item img {
        width: 100%;
        border-radius: 5px;
    }

    .wishlist-item .item-details {
        margin: 10px 0;
    }

    .wishlist-item .view-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .wishlist-button p {
        width: 70% !important;
        background: #a19f9f33;
    }
</style>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="wishlist-page">

            <div class="wishlist-container">
                <!-- <h2 style="color: #000;font-weight: 600; line-height: 20px;">Draft Listings</h2>
                                                                        <p>Continue where you left off</p> -->
                <div class="wishlist-cont">
                    <button type="button" onclick="window.location.href='<?php echo e(route('listing-list')); ?>'"
                        class="wishlist-create">+ Create Your Wishlist</button>
                    <p>you can create your wishlist to keep getting the updates.</p>
                </div>
            </div>


            <div class="wishlist-card">
                <?php if($wishlist->count()): ?>
                    <?php $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $submission = $item->submission ?? [];
                            $customer = $submission->customer ?? [];
                            $summaryFields = $submission->summaryFields ?? [];
                        ?>

                        <div class="wishlist-product-card">
                            <?php if($submission->product_photo): ?>
                                <img src="<?php echo e(asset('storage/' . $submission->product_photo)); ?>" />
                            <?php else: ?>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                            <?php endif; ?>
                            <div class="wishlist-budge">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="budge-active">
                                        <p><i class="fa-solid fa-circle-check"></i> Active</p>
                                    </div>
                                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i>
                                    </h4>

                                </div>

                            </div>
                            <div class="product-details-hover">
                                <div class="wishlist-button">
                                    <p><?php echo e($submission->category_name ?? ''); ?></p>
                                </div>
                                <h3 class="mt-2 " style="color: #000;"><?php echo e($submission->product_title ?? ''); ?></h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By <?php echo e(($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '')); ?></p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                    <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="wishlist-left mb-2">
                                            <p class="m-0" style="color: <?php echo e($field['color'] ?? '#000000'); ?>;">
                                                <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                                            </p>
                                            <div class="d-flex flex-column">
                                                <p class="m-0" style="font-size: 16px;">
                                                    <?php echo e($field['label']); ?>

                                                </p>
                                                <h5 class="m-0" style="color: #000; font-size: 16px;">
                                                    <?php echo e($field['value']); ?>

                                                </h5>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color:#000;">
                                        <?php echo e($submission->currency_symbol); ?>

                                       <?php echo e($submission->currency_symbol  == '$'? number_format($submission->display_price, 2) : $submission->display_price); ?>

                                    </h2>

                                    <button type="button" class="btn btn-dark"
                                        onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                                        View Detail
                                    </button>

                                </div>

                            </div>
                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                                <div class="wishlist-button">
                                    <p><?php echo e($submission->category_name ?? ''); ?></p>

                                </div>
                                <h3 class="mt-2" style="color: #000;"><?php echo e($submission->product_title ?? ''); ?></h3>

                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By <?php echo e(($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '')); ?></p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                    <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="wishlist-left mb-2">
                                            <p class="m-0" style="color: <?php echo e($field['color'] ?? '#000000'); ?>;">
                                                <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                                            </p>
                                            <div class="d-flex flex-column">
                                                <p class="m-0" style="font-size: 16px;">
                                                    <?php echo e($field['label']); ?>

                                                </p>
                                                <h5 class="m-0" style="color: #000; font-size: 16px;">
                                                    <?php echo e($field['value']); ?>

                                                </h5>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color:#000000;">
                                        <?php echo e($submission->currency_symbol); ?>

                                       <?php echo e($submission->currency_symbol  == '$'? number_format($submission->display_price, 2) : $submission->display_price); ?>

                                    </h2>

                                    <button type="button" class="btn btn-dark"
                                        onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission->id])); ?>'">
                                        View Detail
                                    </button>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    
                    <div class="mt-3">
                        <?php echo e($wishlist->links()); ?>

                    </div>
                <?php else: ?>
                    <p class="text-center">No items in wishlist yet.</p>
                <?php endif; ?>
            </div>



        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/wishlist.blade.php ENDPATH**/ ?>