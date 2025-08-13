

<?php $__env->startSection('title'); ?>
    Flippingo Blogs
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-styles'); ?>
<style>
  .accordion-button {
      color: #212529 !important;
      background-color: transparent !important;
      border: 0 !important;
  }

  .accordion-button:not(.collapsed) {
      background-color: transparent !important;
      box-shadow: none !important;
  }

  .accordion-button:focus {
      box-shadow: none !important;
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom d-none d-md-flex">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <div class="breadcrumb-title pe-3">Faq</div>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;">
                                            <i class="bx bx-home-alt"></i> Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Faq</a>
                                    </li>
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

                        <div class="accordion accordion-flush" id="footerFaqAccordion" style="width:100%">

                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isFirst = $index === 0;
                                    $questionNumber = 'Q' . ($index + 1);
                                ?>
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header" id="heading<?php echo e($faq->id); ?>">
                                        <button
                                            class="accordion-button px-0 py-1 bg-transparent <?php echo e($isFirst ? '' : 'collapsed'); ?>"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($faq->id); ?>"
                                            aria-expanded="<?php echo e($isFirst ? 'true' : 'false'); ?>"
                                            aria-controls="collapse<?php echo e($faq->id); ?>">
                                            <span class="me-2"><?php echo e($questionNumber); ?>.</span>
                                            <?php echo e(Str::limit($faq->question, 60)); ?>

                                        </button>
                                    </h2>
                                    <div id="collapse<?php echo e($faq->id); ?>"
                                        class="accordion-collapse collapse <?php echo e($isFirst ? 'show' : ''); ?>"
                                        aria-labelledby="heading<?php echo e($faq->id); ?>" data-bs-parent="#footerFaqAccordion">
                                        <div class="accordion-body px-0 py-1 text-muted small">
                                            <?php echo $faq->answer; ?>

                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/faq.blade.php ENDPATH**/ ?>