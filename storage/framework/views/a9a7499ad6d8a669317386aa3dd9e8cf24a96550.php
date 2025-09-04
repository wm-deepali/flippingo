

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- ================================
        START BREADCRUMB AREA
    ================================= -->
    <section class="breadcrumb-area bread-bg" style="margin-top: 80px;">
        <div class="overlay"></div>
        <!-- end overlay -->
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="sec__title text-white mb-3">
                    How To Improve Your Customer Service Experience
                </h2>
                <ul class="bread-list">
                    <li><a href="<?php echo e(Route('home')); ?>">home</a></li>
                    <li>Blog</li>
                    <li>How To Improve Your Customer Service Experience</li>
                </ul>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
        <div class="bread-svg">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
            </svg>
        </div>
        <!-- end bread-svg -->
    </section>
    <!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
           START BLOG AREA
    ================================= -->
    <section class="blog-area padding-top-60px padding-bottom-70px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="card">
                        <a href="<?php echo e(Route('blog-single')); ?>" class="card-image">
                            <img src="images/img-loading.jpg" data-src="images/img1.jpg" alt="blog image"
                                class="card-img-top lazy" />
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                How To Improve Your Customer Service Experience
                            </h4>
                            <ul class="card-meta d-flex flex-wrap align-items-center">
                                <li>By David Wise</li>
                                <li><span class="mx-1">-</span></li>
                                <li>25 Dec, 2018</li>
                                <li><span class="mx-1">-</span></li>
                                <li><a href="#">Tips & Tricks</a></li>
                            </ul>
                            <p class="card-text font-weight-regular mt-3">
                                Nam nisl lacus, dignissim ac tristique ut, scelerisque eu
                                massa. Vestibulum ligula nunc, rutrum in malesuada vitae,
                                tempus sed augue. Curabitur quis lectus quis augue dapibus
                                facilisis. Vivamus tincidunt orci est, in vehicula nisi
                                eleifend ut. Vestibulum sagittis varius orci vitae.
                            </p>
                            <p class="card-text font-weight-regular mt-3">
                                Some people do not understand why you should have to spend
                                money on boot camp when you can get the MCSE study materials
                                yourself at a fraction of the camp price. However, who has the
                                willpower to actually sit through a self-imposed MCSE
                                training.
                            </p>
                            <blockquote class="blockquote my-4">
                                <p class="font-italic mb-2 font-size-16">
                                    Mauris aliquet ultricies ante, non faucibus ante gravida
                                    sed. Sed ultrices pellentesque purus, vulputate volutpat
                                    ipsum hendrerit sed neque sed sapien rutrum.
                                </p>
                                <footer class="blockquote-footer">
                                    Kamran Adi <cite title="Source Title"> Flippingo</cite>
                                </footer>
                            </blockquote>
                            <p class="card-text font-weight-regular mb-3">
                                when you can get the MCSE study materials yourself at a
                                fraction of the camp price. However, who has the willpower to
                                actually sit through a self-imposed MCSE training. who has the
                                willpower to actually sit through a self-imposed
                            </p>
                            <h4 class="card-title">Storytelling</h4>
                            <p class="card-text font-weight-regular mb-3">
                                Some people do not understand why you should have to spend
                                money on boot camp when you can get the MCSE study materials
                                yourself at a fraction of the camp price.
                            </p>
                            <h4 class="card-title">Branding</h4>
                            <p class="card-text font-weight-regular mb-5">
                                Some people do not understand why you should have to spend
                                money on boot camp when you can get the MCSE study materials
                                yourself at a fraction of the camp price.
                            </p>
                            <div class="social-icons">
                                <span class="text-black font-weight-semi-bold me-1">Share:</span>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <ul class="posts-nav row mb-4">
                        <li class="prev-post col-lg-6 text-start">
                            <a href="#"><span>Previous Post</span>
                                Hotels for All Budgets
                            </a>
                        </li>
                        <li class="next-post col-lg-6 text-end">
                            <a href="#"><span>Next Post</span>
                                The Best Coffee Shops In Sydney Neighborhoods
                            </a>
                        </li>
                    </ul>
                    <div class="bg-gray p-4 rounded">
                        <div class="media media-card">
                            <img class="flex-shrink-0 me-3 rounded-circle" src="images/small-team1.jpg" alt="Blog image" />
                            <div class="media-body align-self-center">
                                <h5 class="media-title mb-1">Alex Smith</h5>
                                <a href="mailto:alex.smith@example.com" class="btn-link">alex.smith@example.com</a>
                                <p class="font-size-15 mt-2">
                                    Nullam ultricies, velit ut varius molestie, ante metus
                                    condimentum nisi, dignissim facilisis turpis ex in libero.
                                    Sed porta ante tortor
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-lg-12">
                            <h4 class="card-title mb-4">Related Posts</h4>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card hover-y">
                                <a href="<?php echo e(Route('blog-single')); ?>" class="card-image">
                                    <img src="images/img-loading.jpg" data-src="images/img1.jpg" alt="blog image"
                                        class="card-img-top lazy" />
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="<?php echo e(Route('blog-single')); ?>">50 Greatest Event Places in United Kingdom</a>
                                    </h4>
                                    <ul class="card-meta d-flex flex-wrap align-items-center">
                                        <li>25 Dec, 2018</li>
                                        <li><span class="mx-1">-</span></li>
                                        <li><a href="#">Tips & Tricks</a></li>
                                    </ul>
                                    <p class="card-text mt-3">
                                        Sed ut perspiciatis unde omnis iste natus error sit
                                        voluptatem eaque ipsa quae ab illo inventore
                                    </p>
                                    <div class="post-author d-flex align-items-center justify-content-between mt-3">
                                        <div>
                                            <img src="images/testi-img7.jpg" alt="" />
                                            <span>By</span>
                                            <a href="#">David Wise</a>
                                        </div>
                                        <a href="<?php echo e(Route('blog-single')); ?>">Read more</a>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col-lg-6 -->
                        <div class="col-lg-6 col-md-6">
                            <div class="card hover-y">
                                <a href="<?php echo e(Route('blog-single')); ?>" class="card-image">
                                    <img src="images/img-loading.jpg" data-src="images/img2.jpg" alt="blog image"
                                        class="card-img-top lazy" />
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="<?php echo e(Route('blog-single')); ?>">Top 10 Best Clothing Shops In Sydney</a>
                                    </h4>
                                    <ul class="card-meta d-flex flex-wrap align-items-center">
                                        <li>25 Dec, 2018</li>
                                        <li><span class="mx-1">-</span></li>
                                        <li><a href="#">Tips & Tricks</a></li>
                                    </ul>
                                    <p class="card-text mt-3">
                                        Sed ut perspiciatis unde omnis iste natus error sit
                                        voluptatem eaque ipsa quae ab illo inventore
                                    </p>
                                    <div class="post-author d-flex align-items-center justify-content-between mt-3">
                                        <div>
                                            <img src="images/testi-img7.jpg" alt="" />
                                            <span>By</span>
                                            <a href="#">David Wise</a>
                                        </div>
                                        <a href="<?php echo e(Route('blog-single')); ?>">Read more</a>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col-lg-6 -->
                    </div>
                    <!-- end row -->
                    <div class="reviews">
                        <h4 class="font-size-20 font-weight-semi-bold mb-4">
                            Comments <span class="badge badge-light">(5)</span>
                        </h4>
                        <div class="comments-wrapper">
                            <div class="comment media mb-5">
                                <a href="<?php echo e(Route('user-profile')); ?>" class="user-avatar flex-shrink-0 d-block me-3">
                                    <img src="images/small-team1.jpg" alt="author-img" />
                                </a>
                                <div class="comment-body media-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="pe-2">
                                            <h4 class="comment-title">
                                                <a href="<?php echo e(Route('user-profile')); ?>">Adam Smith</a>
                                            </h4>
                                            <span class="comment-meta">San Francisco, CA</span>
                                        </div>
                                        <div class="star-rating" data-rating="4"></div>
                                    </div>
                                    <p class="comment-desc mt-2">
                                        It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking
                                        at its layout.
                                    </p>
                                    <div class="comment-actions mt-3">
                                        <a class="btn-link" href="#">
                                            <i class="fas fa-reply me-1"></i> Reply
                                        </a>
                                    </div>
                                    <!-- end comment-actions -->
                                </div>
                                <!-- end comment-body -->
                            </div>
                            <!-- end comment -->
                            <div class="comment media mb-5 comment-reply">
                                <div class="comment-body media-body">
                                    <h4 class="comment-title">Kamran Adi</h4>
                                    <span class="comment-meta">Business owner</span>
                                    <p class="comment-desc mt-2">
                                        It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking
                                        at its layout.
                                    </p>
                                </div>
                                <!-- end comment-body -->
                            </div>
                            <!-- end comment -->
                            <div class="comment media mb-5">
                                <a href="<?php echo e(Route('user-profile')); ?>" class="user-avatar flex-shrink-0 d-block me-3">
                                    <img src="images/small-team1.jpg" alt="author-img" />
                                </a>
                                <div class="comment-body media-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="pe-2">
                                            <h4 class="comment-title">
                                                <a href="<?php echo e(Route('user-profile')); ?>">Adam Smith</a>
                                            </h4>
                                            <span class="comment-meta">San Francisco, CA</span>
                                        </div>
                                        <div class="star-rating" data-rating="4"></div>
                                    </div>
                                    <p class="comment-desc mt-2">
                                        It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking
                                        at its layout.
                                    </p>
                                    <div class="comment-actions mt-3">
                                        <a class="btn-link" href="#">
                                            <i class="fas fa-reply me-1"></i> Reply
                                        </a>
                                    </div>
                                    <!-- end comment-actions -->
                                </div>
                                <!-- end comment-body -->
                            </div>
                            <!-- end comment -->
                        </div>
                        <!-- end comments-wrapper -->
                        <hr class="border-top-gray mt-0" />
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center pagination-list">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true" class="fal fa-angle-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true" class="fal fa-angle-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- end reviews -->
                    <div class="add-comment-wrapper mt-5">
                        <h4 class="font-size-20 font-weight-semi-bold mb-1">
                            Add a Comment
                        </h4>
                        <p class="font-size-15">
                            Your email address will not be published. Required fields are
                            marked *
                        </p>
                        <hr class="border-top-gray my-4" />
                        <form method="post" class="row">
                            <div class="col-lg-6 col-md-6">
                                <label class="label-text">Name</label>
                                <div class="form-group">
                                    <span class="fal fa-user form-icon"></span>
                                    <input class="form-control form--control" type="text" name="name"
                                        placeholder="Your Name" />
                                </div>
                            </div>
                            <!-- end col-lg-6 -->
                            <div class="col-lg-6 col-md-6">
                                <label class="label-text">Email</label>
                                <div class="form-group">
                                    <span class="fal fa-envelope form-icon"></span>
                                    <input class="form-control form--control" type="email" name="email"
                                        placeholder="Email Address" />
                                </div>
                            </div>
                            <!-- end col-lg-6 -->
                            <div class="col-lg-12">
                                <label class="label-text">Comment</label>
                                <div class="form-group">
                                    <textarea class="form-control form--control ps-3" rows="5" name="message"
                                        placeholder="Write your comment here..."></textarea>
                                </div>
                            </div>
                            <!-- end col-lg-12 -->
                            <div class="col-lg-12">
                                <button class="theme-btn border-0" type="submit">
                                    Submit Comment
                                </button>
                            </div>
                            <!-- end col-lg-12 -->
                        </form>
                    </div>
                    <!-- end add-comment-wrapper -->
                </div>
                <!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Search</h4>
                                <div class="form-group">
                                    <span class="fal fa-search form-icon"></span>
                                    <input class="form-control form--control" type="text"
                                        placeholder="What are you looking for?" />
                                </div>
                                <!-- end form-group -->
                                <button class="theme-btn border-0 w-100" type="submit">
                                    Search
                                </button>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Tags</h4>
                                <ul class="tag-list">
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Hotel</a></li>
                                    <li><a href="#">Food</a></li>
                                    <li><a href="#">Bars</a></li>
                                    <li><a href="#">Salon</a></li>
                                    <li><a href="#">Cleaning</a></li>
                                    <li><a href="#">Fashion</a></li>
                                </ul>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Popular Posts</h4>
                                <ul class="media-list">
                                    <li class="media media-card">
                                        <a href="<?php echo e(Route('blog-single')); ?>" class="flex-shrink-0 me-3 d-block">
                                            <img src="images/small-img.jpg" alt="Blog image" />
                                        </a>
                                        <div class="media-body align-self-center">
                                            <h5 class="media-title mb-1">
                                                <a href="<?php echo e(Route('blog-single')); ?>">The best sale marketer of the next year</a>
                                            </h5>
                                            <p class="font-size-15">20 Jan, 2021</p>
                                        </div>
                                    </li>
                                    <li class="media media-card my-4">
                                        <a href="<?php echo e(Route('blog-single')); ?>" class="flex-shrink-0 me-3 d-block">
                                            <img src="images/small-img.jpg" alt="Blog image" />
                                        </a>
                                        <div class="media-body align-self-center">
                                            <h5 class="media-title mb-1">
                                                <a href="<?php echo e(Route('blog-single')); ?>">The best sale marketer of the next year</a>
                                            </h5>
                                            <p class="font-size-15">20 Jan, 2021</p>
                                        </div>
                                    </li>
                                    <li class="media media-card">
                                        <a href="<?php echo e(Route('blog-single')); ?>" class="flex-shrink-0 me-3 d-block">
                                            <img src="images/small-img.jpg" alt="Blog image" />
                                        </a>
                                        <div class="media-body align-self-center">
                                            <h5 class="media-title mb-1">
                                                <a href="<?php echo e(Route('blog-single')); ?>">The best sale marketer of the next year</a>
                                            </h5>
                                            <p class="font-size-15">20 Jan, 2021</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
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
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end sidebar -->
                </div>
                <!-- end col-lg-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end blog-area -->
    <!-- ================================
           START BLOG AREA
    ================================= -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/blog-single.blade.php ENDPATH**/ ?>