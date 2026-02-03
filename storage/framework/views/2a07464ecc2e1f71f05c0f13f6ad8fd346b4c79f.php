

<?php $__env->startSection('title'); ?>
    All Categories | Flippingo
<?php $__env->stopSection(); ?>


<style>
  

  .sec__desc {
    font-size: 16px;
    color: #555;
    max-width: 100% !important;
    margin-left: 0px;

  }

  /* ===== SLIDER WRAPPER ===== */
  .flippingonew-slider-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
  }

  /* ===== SLIDER TRACK ===== */
  .flippingonew-slider-track {
    display: flex;
    gap: 14px;
    overflow: hidden;
    scroll-behavior: smooth;
    width: 100%;
  }

  /* ===== CARD ===== */
  .flippingonew-slider-card {
    min-width: 135px;
    background: #ffffff;
    border-radius: 14px;
    padding: 14px 10px 16px;
    text-align: center;
    position: relative;
    /*box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);*/
    border: 1px solid #8080804a;
    transition: all 0.25s ease;
    text-decoration: none;
    color: inherit;
  }

  .flippingonew-slider-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.14);
  }

  /* ===== LISTING BADGE ===== */
  .flippingonew-listing-badge {
    position: absolute;
    top: 8px;
    left: 8px;
    font-size: 11px;
    background: #eef2ff;
    color: #1d4ed8;
    padding: 3px 7px;
    border-radius: 6px;
    font-weight: 600;
    line-height: 1;
  }

  /* ===== IMAGE ===== */
  .flippingonew-slider-image {
    width: 60px;
    height: 60px;
    margin: 26px auto 10px;
    background: #f5f7ff;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .flippingonew-slider-image img {
    max-width: 40px;
    max-height: 40px;
    object-fit: contain;
  }

  /* ===== TITLE ===== */
  .flippingonew-slider-title {
    font-size: 14px;
    font-weight: 600;
    margin: 6px 0 0;
    line-height: 1.3;
    color: #111827;
  }

  /* ===== SLIDER BUTTONS ===== */
  .flippingonew-slider-btn {
    background: #ffffff;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    font-size: 16px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .flippingonew-slider-btn:hover {
    background: #2563eb;
    color: #ffffff;
  }

  /* ===== MOBILE ===== */
  @media (max-width: 768px) {
    .flippingonew-slider-card {
      min-width: 120px;
    }

    .flippingonew-slider-btn {
      display: none;
    }
  }
</style>

<?php $__env->startSection('content'); ?>

<section class="cat-area section--padding" style="margin-top: 150px;">
    <?php
        $featured = $homePageContent['featured'] ?? null;
    ?>

    <div class="container">

        
        <div class="text-start mb-4">
            <h2 class="sec__title mb-3">
                <?php echo e($featured->title ?? 'Explore Top Digital Assets'); ?>

            </h2>
            <p class="sec__desc">
                <?php echo e($featured->description ?? 'Discover the most in-demand categories, from social accounts to apps, blogs, and more.'); ?>

            </p>
        </div>

        
        <div class="flippingonew-slider-wrapper">
            <button class="flippingonew-slider-btn prev">&#10094;</button>

            <div class="flippingonew-slider-track">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('listing-list', ['category' => $category->slug])); ?>"
                       class="flippingonew-slider-card">

                        <span class="flippingonew-listing-badge">
                            <?php echo e($categorySubmissionCounts[$category->id] ?? 0); ?> Listings
                        </span>

                        <div class="flippingonew-slider-image">
                            <?php if($category->image): ?>
                                <img src="<?php echo e(asset('storage/' . $category->image)); ?>"
                                     alt="<?php echo e($category->name); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/default-category.png')); ?>"
                                     alt="Default Category">
                            <?php endif; ?>
                        </div>

                        <h3 class="flippingonew-slider-title">
                            <?php echo e($category->name); ?>

                        </h3>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <button class="flippingonew-slider-btn next">&#10095;</button>
        </div>

    </div>
</section>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const track = document.querySelector(".flippingonew-slider-track");
      const next = document.querySelector(".flippingonew-slider-btn.next");
      const prev = document.querySelector(".flippingonew-slider-btn.prev");

      if (!track) return;

      const scrollAmount = 220;

      next.addEventListener("click", () => {
        track.scrollBy({ left: scrollAmount, behavior: "smooth" });
      });

      prev.addEventListener("click", () => {
        track.scrollBy({ left: -scrollAmount, behavior: "smooth" });
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/categories.blade.php ENDPATH**/ ?>