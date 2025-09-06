

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'FAQ'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', ['activeTab' => request('tab', 'buyer')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">

        <div class="faq-page container my-5">
            <div class="row">
                <!-- Left Sidebar (Categories) -->
                <div class="col-md-3 faq-sidebar">
                    <h5 class="faq-title">Categories</h5>
                    <ul class="faq-category-list">
                        <li class="active" data-category="general">General</li>
                        <li data-category="payments">Payments</li>
                        <li data-category="wallet">Wallet</li>
                        <li data-category="security">Security</li>
                        <li data-category="account">Account</li>
                    </ul>
                </div>

                <!-- Right Content (FAQs) -->
                <div class="col-md-9 faq-content">
                    <!-- General -->
                    <div class="faq-category-content active" id="general">
                        <h4 class="faq-heading">General FAQs</h4>
                        <div class="faq-accordion">
                            <div class="faq-item">
                                <div class="faq-question">What is this platform about?</div>
                                <div class="faq-answer">This platform allows users to manage wallets, payments, and
                                    transactions easily.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">How do I register?</div>
                                <div class="faq-answer">You can register by clicking on the Sign-Up button and filling the
                                    required details.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Payments -->
                    <div class="faq-category-content" id="payments">
                        <h4 class="faq-heading">Payments FAQs</h4>
                        <div class="faq-accordion">
                            <div class="faq-item">
                                <div class="faq-question">How do I add funds?</div>
                                <div class="faq-answer">You can add funds via UPI, Bank Transfer, or Debit/Credit Card.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Are there any transaction charges?</div>
                                <div class="faq-answer">No hidden charges, only applicable bank/UPI fees are applied.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Wallet -->
                    <div class="faq-category-content" id="wallet">
                        <h4 class="faq-heading">Wallet FAQs</h4>
                        <div class="faq-accordion">
                            <div class="faq-item">
                                <div class="faq-question">Can I withdraw money?</div>
                                <div class="faq-answer">Yes, withdrawals can be made to your verified bank account.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Is there a wallet balance limit?</div>
                                <div class="faq-answer">Currently, there is no upper limit on wallet balance.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Security -->
                    <div class="faq-category-content" id="security">
                        <h4 class="faq-heading">Security FAQs</h4>
                        <div class="faq-accordion">
                            <div class="faq-item">
                                <div class="faq-question">Is my data safe?</div>
                                <div class="faq-answer">Yes, we use industry-standard encryption for all transactions.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Can someone hack my wallet?</div>
                                <div class="faq-answer">With 2FA and encryption, your wallet is secured from unauthorized
                                    access.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Account -->
                    <div class="faq-category-content" id="account">
                        <h4 class="faq-heading">Account FAQs</h4>
                        <div class="faq-accordion">
                            <div class="faq-item">
                                <div class="faq-question">How can I update my profile?</div>
                                <div class="faq-answer">Go to Settings → Profile section to update your details.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Can I delete my account?</div>
                                <div class="faq-answer">Yes, you can request account deletion from the Support section.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

   <script>// Accordion toggle
// Accordion toggle - only one open at a time
document.querySelectorAll(".faq-question").forEach(item => {
  item.addEventListener("click", function () {
    let parent = this.parentElement;
    let container = parent.parentElement;

   
    container.querySelectorAll(".faq-item").forEach(faq => faq.classList.remove("active"));

   
    parent.classList.add("active");
  });
});

// Category switching
document.querySelectorAll(".faq-category-list li").forEach(cat => {
  cat.addEventListener("click", function () {
    // remove old active
    document.querySelectorAll(".faq-category-list li").forEach(c => c.classList.remove("active"));
    document.querySelectorAll(".faq-category-content").forEach(content => content.classList.remove("active"));

    // add new active
    this.classList.add("active");
    document.getElementById(this.dataset.category).classList.add("active");
  });
});

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/faq.blade.php ENDPATH**/ ?>