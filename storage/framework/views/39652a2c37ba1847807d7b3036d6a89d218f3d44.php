

<?php $__env->startSection('title'); ?>
    <?php echo e($blog->meta_title ?? $blog->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_tags'); ?>
    <meta name="title" content="<?php echo e($blog->meta_title); ?>">
    <meta name="description" content="<?php echo e($blog->meta_description); ?>">
    <meta name="keywords" content="<?php echo e($blog->meta_keyword); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom d-none d-md-flex">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <div class="breadcrumb-title pe-3">Blog Detail</div>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i>
                                            Home</a>
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('blogs')); ?>">Blogs</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo e($blog->title); ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start page content-->
            <section class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <div class="blog-right-sidebar p-3">
                                <div class="card shadow-none bg-transparent">
                                    <img src="<?php echo e($blog->banner_url); ?>" class="card-img-top" alt="<?php echo e($blog->title); ?>">
                                    <div class="card-body p-0">
                                        <div class="list-inline mt-4"> <a href="javascript:;" class="list-inline-item"><i
                                                    class='bx bx-user me-1'></i>By Admin</a>
                                            <!-- <a href="javascript:;" class="list-inline-item"><i
                                                        class='bx bx-comment-detail me-1'></i>0 Comments</a> -->
                                            <a href="javascript:;" class="list-inline-item"><i
                                                    class='bx bx-calendar me-1'></i><?php echo e($blog->created_at->format('F d, Y')); ?></a>
                                        </div>
                                        <h4 class="mt-4"><?php echo e($blog->title); ?></h4>
                                        <p><?php echo $blog->detail; ?></p>
                                        <div class="d-flex align-items-center gap-2 py-4 border-top border-bottom">
                                            <div class="">
                                                <h6 class="mb-0 text-uppercase">Share This Post</h6>
                                            </div>
                                            <?php
                                                $shareUrl = urlencode(url()->current());
                                                $shareText = urlencode($blog->title);
                                            ?>
                                            <div class="list-inline blog-sharing">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($shareUrl); ?>"
                                                    target="_blank" class="list-inline-item">
                                                    <i class='bx bxl-facebook'></i>
                                                </a>

                                                <a href="https://twitter.com/intent/tweet?url=<?php echo e($shareUrl); ?>&text=<?php echo e($shareText); ?>"
                                                    target="_blank" class="list-inline-item">
                                                    <i class='bx bxl-twitter'></i>
                                                </a>

                                                <a href="https://www.linkedin.com/shareArticle?url=<?php echo e($shareUrl); ?>&title=<?php echo e($shareText); ?>"
                                                    target="_blank" class="list-inline-item">
                                                    <i class='bx bxl-linkedin'></i>
                                                </a>

                                                <a href="https://www.instagram.com/" class="list-inline-item"
                                                    target="_blank">
                                                    <i class='bx bxl-instagram'></i>
                                                </a>

                                                <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo e($shareUrl); ?>&title=<?php echo e($shareText); ?>"
                                                    target="_blank" class="list-inline-item">
                                                    <i class='bx bxl-tumblr'></i>
                                                </a>
                                            </div>

                                        </div>
                                        <!-- <div class="author d-flex align-items-center gap-3 py-4">
                                                <img src="assets/images/avatars/avatar-1.png" alt="" width="80">
                                                <div class="">
                                                    <h6 class="mb-0">Jhon Doe</h6>
                                                    <p class="mb-0">Donec egestas metus non vehicula accumsan. Pellentesque sit
                                                        amet tempor nibh. Mauris in risus lorem. Cras malesuada gravida massa
                                                        eget viverra. Suspendisse vitae dolor erat. Morbi id rhoncus enim. In
                                                        hac habitasse platea dictumst. Aenean lorem diam, venenatis nec
                                                        venenatis id, adipiscing ac massa.</p>
                                                </div>
                                            </div> -->
                                        <!-- <div class="reply-form p-4 border bg-dark-1">
                                                <h6 class="mb-0">Leave a Reply</h6>
                                                <p>Your email address will not be published. Required fields are marked *</p>
                                                <form>
                                                    <div class="mb-3">
                                                        <label class="form-label">Comment</label>
                                                        <textarea class="form-control" rows="4"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Website</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-light btn-ecomm">Post
                                                            Comment</button>
                                                    </div>
                                                </form>
                                            </div> -->
                                    </div>
                                </div>
                                <div class="product-grid">
                                    <h5 class="text-uppercase mb-4">Latest Post</h5>
                                    <div class="latest-news owl-carousel owl-theme">
                                        <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="item">
                                                <div class="card rounded-0 product-card border">
                                                    <div class="news-date">
                                                        <div class="date-number"><?php echo e($recent->created_at->format('d')); ?></div>
                                                        <div class="date-month">
                                                            <?php echo e(strtoupper($recent->created_at->format('M'))); ?>

                                                        </div>
                                                    </div>
                                                    <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>">
                                                        <img src="<?php echo e($recent->thumbnail_url); ?>"
                                                            class="card-img-top border-bottom bg-dark-1"
                                                            alt="<?php echo e($recent->title); ?>">
                                                    </a>
                                                    <div class="card-body">
                                                        <div class="news-title">
                                                            <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>">
                                                                <h5 class="mb-3 text-capitalize">
                                                                    <?php echo e(\Illuminate\Support\Str::limit($recent->title, 50)); ?>

                                                                </h5>
                                                            </a>
                                                        </div>
                                                        <p class="news-content mb-0">
                                                            <?php echo e(\Illuminate\Support\Str::limit(strip_tags($recent->detail), 100)); ?>

                                                        </p>
                                                    </div>
                                                    <!-- <div class="card-footer border-top">
                                                                <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>">
                                                                    <p class="mb-0"><small class="text-white">0 Comments</small></p>
                                                                </a>
                                                            </div> -->
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="blog-left-sidebar p-3">
                                <form>
                                    <div class="position-relative blog-search mb-3">
                                        <input type="text" class="form-control form-control-lg rounded-0 pe-5"
                                            placeholder="Serach posts here...">
                                        <div class="position-absolute top-50 end-0 translate-middle"><i
                                                class='bx bx-search fs-4 text-white'></i>
                                        </div>
                                    </div>
                                    <div class="blog-categories mb-3">
                                        <h5 class="mb-4">Recent Posts</h5>
                                        <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="<?php echo e($recent->thumbnail_url); ?>" width="75" alt="<?php echo e($recent->title); ?>">
                                                <div class="ms-3">
                                                    <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>"
                                                        class="fs-6"><?php echo e(\Illuminate\Support\Str::limit($recent->title, 40)); ?></a>
                                                    <p class="mb-0"><?php echo e($recent->created_at->format('M d, Y')); ?></p>
                                                </div>
                                            </div>
                                            <div class="my-3 border-bottom"></div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end start page content-->
        </div>
    </div>
    <!--end page wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/blog-detail.blade.php ENDPATH**/ ?>