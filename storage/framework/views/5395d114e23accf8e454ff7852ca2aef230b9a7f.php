

<?php $__env->startSection('title'); ?>
    <?php echo e($blog->meta_title ?? $blog->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_tags'); ?>
    <meta name="title" content="<?php echo e($blog->meta_title); ?>">
    <meta name="description" content="<?php echo e($blog->meta_description); ?>">
    <meta name="keywords" content="<?php echo e($blog->meta_keyword); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- ================================
                START BREADCRUMB AREA
            ================================= -->
    <section class="breadcrumb-area bread-bg" style="margin-top: 80px;">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="sec__title text-white mb-3">
                    <?php echo e($blog->title); ?>

                </h2>
                <ul class="bread-list">
                    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li>Blog</li>
                    <li><?php echo e($blog->title); ?></li>
                </ul>
            </div>
        </div>
        <div class="bread-svg">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
            </svg>
        </div>
    </section>
    <!-- ================================
                END BREADCRUMB AREA
            ================================= -->

    <!-- ================================
                START BLOG AREA
            ================================= -->
    <section class="blog-area padding-top-60px padding-bottom-70px">
        <div class="container">
            <div class="row">
                <!-- Blog Content -->
                <div class="col-lg-8 mb-5">
                    <div class="card">
                        <a href="#" class="card-image">
                            <img src="<?php echo e($blog->banner_url ?? $blog->thumbnail_url ?? asset('images/img-loading.jpg')); ?>"
                                alt="<?php echo e($blog->title); ?>" class="card-img-top" />
                        </a>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo e($blog->title); ?></h4>
                            <ul class="card-meta d-flex flex-wrap align-items-center">
                                <li>By Admin</li>
                                <li><span class="mx-1">-</span></li>
                                <li><?php echo e($blog->created_at->format('d M, Y')); ?></li>
                                <li><span class="mx-1">-</span></li>
                                <li><a href="#"><?php echo e($blog->category->name ?? 'Uncategorized'); ?></a></li>
                            </ul>

                            <div class="card-text font-weight-regular mt-3">
                                <?php echo $blog->detail; ?>

                            </div>

                            <div class="social-icons mt-4">
                                <span class="text-black font-weight-semi-bold me-1">Share:</span>

                                
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(route('blogs.show', $blog->slug))); ?>"
                                    target="_blank" title="Share on Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                
                                <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(route('blogs.show', $blog->slug))); ?>&text=<?php echo e(urlencode($blog->title)); ?>"
                                    target="_blank" title="Share on Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>

                                
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(route('blogs.show', $blog->slug))); ?>"
                                    target="_blank" title="Share on LinkedIn">
                                    <i class="fab fa-linkedin"></i>
                                </a>

                                
                                <a href="https://api.whatsapp.com/send?text=<?php echo e(urlencode($blog->title . ' ' . route('blogs.show', $blog->slug))); ?>"
                                    target="_blank" title="Share on WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                
                                <a href="mailto:?subject=<?php echo e(rawurlencode($blog->title)); ?>&body=<?php echo e(rawurlencode(route('blogs.show', $blog->slug))); ?>"
                                    target="_blank" title="Share via Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Related Posts -->
                    <div class="row my-5">
                        <div class="col-lg-12">
                            <h4 class="card-title mb-4">Related Posts</h4>
                        </div>
                        <?php $__empty_1 = true; $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="card hover-y">
                                    <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>" class="card-image">
                                        <img src="<?php echo e($recent->thumbnail_url ?? asset('images/img-loading.jpg')); ?>"
                                            alt="<?php echo e($recent->title); ?>" class="card-img-top" />
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>"><?php echo e($recent->title); ?></a>
                                        </h4>
                                        <ul class="card-meta d-flex flex-wrap align-items-center">
                                            <li><?php echo e($recent->created_at->format('d M, Y')); ?></li>
                                            <li><span class="mx-1">-</span></li>
                                            <li><a href="#"><?php echo e($recent->category->name ?? 'Uncategorized'); ?></a></li>
                                        </ul>
                                        <p class="card-text mt-3">
                                            <?php echo e(Str::limit(strip_tags($recent->detail), 100)); ?>

                                        </p>
                                        <div class="post-author d-flex align-items-center justify-content-between mt-3">
                                            <div>
                                                <!-- <img src="<?php echo e(asset('images/testi-img7.jpg')); ?>" alt="author" /> -->
                                                <span>By</span>
                                                <a href="#">Admin</a>
                                            </div>
                                            <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted">No related posts found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Search</h4>
                                <form method="GET" action="#">
                                    <div class="form-group">
                                        <span class="fal fa-search form-icon"></span>
                                        <input class="form-control form--control" type="text" name="q"
                                            value="<?php echo e(request('q')); ?>" placeholder="Search blog..." />
                                    </div>
                                    <button class="theme-btn border-0 w-100" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Categories</h4>
                                <ul class="tag-list">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('blogs.category', $category->slug)); ?>">
                                                <?php echo e($category->name); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Popular Posts</h4>
                                <ul class="media-list">
                                    <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="media media-card mb-3">
                                            <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>"
                                                class="flex-shrink-0 me-3 d-block">
                                                <img src="<?php echo e($recent->thumbnail_url ?? asset('images/small-img.jpg')); ?>"
                                                    alt="<?php echo e($recent->title); ?>" />
                                            </a>
                                            <div class="media-body align-self-center">
                                                <h5 class="media-title mb-1">
                                                    <a
                                                        href="<?php echo e(route('blogs.show', $recent->slug)); ?>"><?php echo e(Str::limit($recent->title, 40)); ?></a>
                                                </h5>
                                                <p class="font-size-15"><?php echo e($recent->created_at->format('d M, Y')); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Social</h4>
                                <div class="social-icons">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sidebar -->
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/blog-details.blade.php ENDPATH**/ ?>