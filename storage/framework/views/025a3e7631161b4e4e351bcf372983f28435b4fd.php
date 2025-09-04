

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="breadcrumb-area bread-bg">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="sec__title text-white mb-3">Frequently Asked Questions</h2>
                <ul class="bread-list">
                    <li><a href="<?php echo e(Route('home')); ?>">home</a></li>
                    <li>pages</li>
                    <li>faq</li>
                </ul>
            </div>
        </div>
        <div class="bread-svg">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
            </svg>
        </div>
    </section>

    <section class="faq-area padding-top-60px padding-bottom-90px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="accordion my-accordion" id="accordionExample">
                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo e($index); ?>">
                                    <button class="btn btn-link <?php echo e($index !== 0 ? 'collapsed' : ''); ?>" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($index); ?>"
                                        aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>"
                                        aria-controls="collapse<?php echo e($index); ?>">
                                        <span><?php echo e($faq->question); ?></span>
                                        <i class="fal fa-plus accordion-icon"></i>
                                    </button>
                                </div>
                                <div id="collapse<?php echo e($index); ?>" class="collapse <?php echo e($index === 0 ? 'show' : ''); ?>"
                                    aria-labelledby="heading<?php echo e($index); ?>" data-bs-parent="#accordionExample">
                                    <div class="card-body">
                                        <p><?php echo e($faq->answer); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <form action="#" method="POST" class="contact-form card">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <h4 class="card-title">Still have a question?</h4>
                            <hr class="border-top-gray" />
                            <div class="form-group">
                                <label class="label-text">Your Name</label>
                                <input id="name" class="form-control form--control ps-3" type="text" name="name"
                                    placeholder="Your name" required />
                            </div>
                            <div class="form-group">
                                <label class="label-text">Your Email</label>
                                <input id="email" class="form-control form--control ps-3" type="email" name="email"
                                    placeholder="you@email.com" required />
                            </div>
                            <div class="form-group">
                                <label class="label-text">Message</label>
                                <textarea id="message" class="form-control form--control ps-3" rows="5" name="message"
                                    placeholder="Write message" required></textarea>
                            </div>
                            <button id="send-message-btn" class="theme-btn border-0" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/faq.blade.php ENDPATH**/ ?>