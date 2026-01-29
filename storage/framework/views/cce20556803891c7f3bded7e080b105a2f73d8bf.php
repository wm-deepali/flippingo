

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

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-4" id="faqTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="buyers-tab" data-bs-toggle="tab" data-bs-target="#buyers"
                                type="button" role="tab" aria-controls="buyers" aria-selected="true">
                                Buyers
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sellers-tab" data-bs-toggle="tab" data-bs-target="#sellers"
                                type="button" role="tab" aria-controls="sellers" aria-selected="false">
                                Sellers
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="faqTabsContent">

                        <!-- Buyers FAQs -->
                        <div class="tab-pane fade show active" id="buyers" role="tabpanel" aria-labelledby="buyers-tab">
                            <div class="accordion my-accordion" id="accordionBuyers">
                                <?php $__currentLoopData = $faqs->where('type', 'Buyers FAQ'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card">
                                        <div class="card-header" id="headingBuyer<?php echo e($index); ?>">
                                            <button class="btn btn-link <?php echo e($index !== 0 ? 'collapsed' : ''); ?>" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseBuyer<?php echo e($index); ?>"
                                                aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>"
                                                aria-controls="collapseBuyer<?php echo e($index); ?>">
                                                <span><?php echo e($faq->question); ?></span>
                                                <i class="fal fa-plus accordion-icon"></i>
                                            </button>
                                        </div>
                                        <div id="collapseBuyer<?php echo e($index); ?>" class="collapse <?php echo e($index === 0 ? 'show' : ''); ?>"
                                            aria-labelledby="headingBuyer<?php echo e($index); ?>" data-bs-parent="#accordionBuyers">
                                            <div class="card-body">
                                                <p><?php echo e($faq->answer); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Sellers FAQs -->
                        <div class="tab-pane fade" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
                            <div class="accordion my-accordion" id="accordionSellers">
                                <?php $__currentLoopData = $faqs->where('type', 'Seller FAQ'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card">
                                        <div class="card-header" id="headingSeller<?php echo e($index); ?>">
                                            <button class="btn btn-link <?php echo e($index !== 0 ? 'collapsed' : ''); ?>" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSeller<?php echo e($index); ?>"
                                                aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>"
                                                aria-controls="collapseSeller<?php echo e($index); ?>">
                                                <span><?php echo e($faq->question); ?></span>
                                                <i class="fal fa-plus accordion-icon"></i>
                                            </button>
                                        </div>
                                        <div id="collapseSeller<?php echo e($index); ?>" class="collapse <?php echo e($index === 0 ? 'show' : ''); ?>"
                                            aria-labelledby="headingSeller<?php echo e($index); ?>" data-bs-parent="#accordionSellers">
                                            <div class="card-body">
                                                <p><?php echo e($faq->answer); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Categories</h4>
                            <ul class="tag-list">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('faq.category', $category->slug)); ?>">
                                            <?php echo e($category->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <!-- <form action="#" method="POST" class="contact-form card">
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
                        </form> -->
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/flippingo/public_html/new.flippingo.store/resources/views/front/faq.blade.php ENDPATH**/ ?>