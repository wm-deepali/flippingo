

<?php $__env->startSection('title', $page->meta_title ?? 'Flippingo'); ?>

<?php $__env->startSection('content'); ?>
<section class="breadcrumb-area bread-bg">
  <div class="overlay"></div>
  <div class="container">
    <div class="breadcrumb-content text-center">
      <h2 class="sec__title text-white mb-3">Blog Grid</h2>
      <ul class="bread-list">
        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li>Blog</li>
        <li>Blog Grid</li>
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
    <div class="row">
      <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card hover-y">
            <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>" class="card-image">
              <img src="<?php echo e($blog->thumbnail_url ?? asset('images/img-loading.jpg')); ?>" 
                   alt="<?php echo e($blog->title); ?>" class="card-img-top" />
            </a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
              </h4>
              <ul class="card-meta d-flex flex-wrap align-items-center">
                <li><?php echo e($blog->created_at->format('d M, Y')); ?></li>
                <li><span class="mx-1">-</span></li>
                <li><a href="#"><?php echo e($blog->category->name ?? 'Uncategorized'); ?></a></li>
              </ul>
              <p class="card-text mt-3">
                <?php echo e(Str::limit(strip_tags($blog->detail), 120)); ?>

              </p>
              <div class="post-author d-flex align-items-center justify-content-between mt-3">
                <div>
                  <!-- <img src="<?php echo e(asset('images/testi-img7.jpg')); ?>" alt="author" /> -->
                  <span>By</span>
                  <a href="#">Admin</a>
                </div>
                <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>">Read more</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-center">No blogs found</p>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
      <?php echo e($blogs->links()); ?>

    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/blogs.blade.php ENDPATH**/ ?>