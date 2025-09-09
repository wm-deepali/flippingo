

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Pricing'); ?>

<?php $__env->stopSection(); ?>

<style>
    .subscription-page {
        padding: 0px 40px;
        /* font-family: Arial, sans-serif;
  text-align: center; */
    }

    .subscription-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
    }

    .subscription-cards {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .subscription-card {
        flex: 1;
        min-width: 49%;
        /* max-width: 350px; */
        height: 280px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s;
        background: #fff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 25px;
    }

    .subscription-card:hover {
        transform: translateY(-5px);
    }

    /* Active Subscription */
    .active-subscription {
        background: #e6f4ea;
        /* light green pastel */
        text-align: left;
    }

    .active-subscription h3 {
        margin-bottom: 15px;
        color: #059669;
    }

    .subscription-card-content p {
        margin-bottom: 5px;
        padding-left: 30px;
    }

    /* Outline Subscription */
    .outline-subscription {
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 280px;
    }

    .subscription-outline-content {
        text-align: center;
    }

    /* Button */
    .subscription-btn {
        margin-top: 10px;
        padding: 10px 20px;
        background: #059669;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
    }

    .subscription-btn:hover {
        background: #047857;
    }

    /* Empty Subscription Case */
    .subscription-empty {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    /* Modal */
    .subscription-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .subscription-modal-box {
        background: #fff;
        width: 400px;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .subscription-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .subscription-modal-close {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .subscription-modal-body {
        font-size: 15px;
        color: #444;
    }

    .subscription-modal-body {
        padding: 20px;
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
    }

    .package-card {
        background: #f9f9ff;
        /* pastel base */
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 20px;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }

    .package-card h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #333;
    }

    /* Price styling */
    .package-card .price {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #444;
    }

    /* Features list */
    .package-card ul {
        min-height: 252px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .package-card ul li {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        font-size: 14px;
        color: #555;
    }

    .package-card ul li:last-child {
        border-bottom: none;
    }

    /* Button */
    .subscription-btn {
        margin-top: 15px;
        background: #4a6cf7;
        color: #fff;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.2s ease;
    }

    .subscription-btn:hover {
        background: #3653d6;
    }

    /* Badge on top */
    .package-card::before {
        content: attr(data-badge);
        position: absolute;
        top: -12px;
        left: 20px;
        background: #ff6b6b;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        display: none;
    }

    /* Show badge if data-badge is set */
    .package-card[data-badge]:before {
        display: inline-block;
    }

    /* Different background for "popular" */
    .package-card.popular {
        background: #fff9f0;
        border: 2px solid #f7a541;
    }

    .price {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #444;
    }

    .old-price {
        text-decoration: line-through;
        color: #999;
        font-size: 18px;
        margin-right: 8px;
    }

    .new-price {
        color: #e63946;
        /* red highlight */
        font-size: 22px;
        font-weight: 700;
    }
</style>
<?php $__env->startSection('content'); ?>

    <section class="team-area section--padding" style="margin-top:130px;">
        <div class="container">
            <div class="text-center">
                <h2 class="sec__title mb-3">Plans</h2>
                <p class="sec__desc">
                    Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
                    libero, <br />
                    a feugiat eros. Nunc ut lacinia tortors.
                </p>
            </div>

            
            <?php if(request('error')): ?>
                <div class="alert alert-danger" style="margin:20px 0; padding:12px; border-radius:6px;">
                    <?php echo e(request('error')); ?>

                </div>
            <?php endif; ?>


            <div class="subscription-page">

                <div class="subscription-modal-body">
                    <div class="packages-grid">

                        <!-- Free Plan -->
                        <!-- <div class="package-card" data-badge="Free">

                                                        <h3>Temporary Free Option</h3>
                                                        <p class="price">₹0</p>
                                                        <hr>
                                                        <ul>
                                                            <li>✅ 1 Listing Free On Signup</li>
                                                            <li>✅ Listings Duration - For 30 days</li>
                                                        </ul>
                                                        <button class="subscription-btn">Get Started</button>
                                                    </div> -->

                        
                        <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="package-card <?php echo e($package->is_popular ? 'popular' : ''); ?>"
                                            data-badge="<?php echo e($package->is_popular ? 'Popular' : 'Regular'); ?>">

                                            <h3><?php echo e($package->name); ?></h3>

                                            
                                            <p class="price">
                                                <?php if($package->discount > 0): ?>
                                                    <span class="old-price">₹<?php echo e($package->mrp); ?></span>
                                                    <span class="new-price">
                                                        ₹<?php echo e($package->offered_price); ?>

                                                        <span style="font-size:14px; color:green;font-weight:500;">
                                                            (You save <?php echo e($package->discount); ?>%)
                                                        </span>
                                                    </span>
                                                <?php else: ?>
                                                    ₹<?php echo e($package->mrp); ?>

                                                <?php endif; ?>
                                            </p>

                                            <hr>

                                            
                                            <ul>
                                                <li>✅ <?php echo e($package->listings ? $package->listings_display : 0); ?></li>
                                                <li>✅ Listings Duration - <?php echo e($package->listing_duration ?
                            $package->listing_duration_display : 0); ?></li>
                                                <li>
                                                    <?php if($package->whatsapp === 'yes' && $package->whatsapp_frequency > 0): ?>
                                                        ✅ promotion - <?php echo e($package->whatsapp_display ?? ''); ?>

                                                    <?php else: ?>
                                                        ❌ No Promotion
                                                    <?php endif; ?>
                                                </li>
                                                <li>
                                                    <?php if($package->sponsored === 'yes' && $package->sponsored_frequency > 0): ?>
                                                        ✅ Sponsor - <?php echo e($package->sponsored_display ?? ''); ?>

                                                    <?php else: ?>
                                                        ❌ No Sponsor
                                                    <?php endif; ?>
                                                </li>
                                                <li>
                                                    <?php if($package->alerts === 'yes'): ?>
                                                        ✅ <?php echo e($package->alerts_display ?? ''); ?>

                                                    <?php else: ?>
                                                        ❌ No Email Alerts
                                                    <?php endif; ?>
                                                </li>
                                            </ul>

                                            <button class="subscription-btn choose-plan" data-id="<?php echo e($package->id); ?>"
                                                data-name="<?php echo e($package->name); ?>" data-amount="<?php echo e($package->offered_price * 100); ?>"
                                                data-description="<?php echo e($package->listings_display); ?> listings for <?php echo e($package->listing_duration_display); ?>">
                                                Choose Plan
                                            </button>
                                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="subscription-empty">
                                <p>No active packages available right now.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>



        </div>
        <!-- end container -->
    </section>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let redirectAfterPayment = "<?php echo e(request('redirect') ?? route('dashboard.index')); ?>";

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".choose-plan").forEach(button => {
                button.addEventListener("click", function () {
                    let packageId = this.getAttribute("data-id");
                    let packageName = this.getAttribute("data-name");
                    let packageAmount = this.getAttribute("data-amount");
                    let packageDesc = this.getAttribute("data-description");

                      // 🔹 Mock Payment Simulation
                Swal.fire({
                    icon: 'info',
                    title: `Simulating payment for ${packageName}`,
                    text: 'This is a mock payment. Click "OK" to proceed.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Send mock payment info to backend
                    fetch("<?php echo e(route('subscription.store')); ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: 'MOCK_PAYMENT_ID',
                            package_id: packageId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Subscription Activated!',
                                text: 'Your subscription has been activated successfully.',
                                confirmButtonText: 'Continue'
                            }).then(() => {
                                window.location.href = redirectAfterPayment;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: 'There was an error saving your subscription.'
                            });
                        }
                    });
                });
                    // let options = {
                    //     key: "<?php echo e(config('services.razorpay.key')); ?>", // from config/services.php
                    //     amount: packageAmount,
                    //     currency: "INR",
                    //     name: "Flippingo",
                    //     description: packageDesc,
                    //     image: "<?php echo e(asset('logo.png')); ?>", // optional
                    //     handler: function (response) {
                    //         fetch("<?php echo e(route('subscription.store')); ?>", {
                    //             method: "POST",
                    //             headers: {
                    //                 "Content-Type": "application/json",
                    //                 "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                    //             },
                    //             body: JSON.stringify({
                    //                 razorpay_payment_id: response.razorpay_payment_id,
                    //                 package_id: packageId
                    //             })
                    //         })
                    //             .then(res => res.json())
                    //             .then(data => {
                    //                 if (data.success) {
                    //                     Swal.fire({
                    //                         icon: 'success',
                    //                         title: 'Subscription Activated!',
                    //                         text: 'Your subscription has been activated successfully.',
                    //                         confirmButtonText: 'Continue'
                    //                     }).then(() => {
                    //                         window.location.href = redirectAfterPayment;
                    //                     });
                    //                 } else {
                    //                     Swal.fire({
                    //                         icon: 'error',
                    //                         title: 'Oops!',
                    //                         text: 'Payment was successful but there was an error saving your subscription.'
                    //                     });
                    //                 }
                    //             });
                    //     }

                    //         prefill: {
                    //         name: "<?php echo e(auth()->user()->name); ?>",
                    //         email: "<?php echo e(auth()->user()->email); ?>",
                    //         contact: "<?php echo e(auth()->user()->phone ?? ''); ?>"
                    //     },
                    //     theme: {
                    //         color: "#4a6cf7"
                    //     }
                    // };

                    // let rzp = new Razorpay(options);
                    // rzp.open();
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/pricing.blade.php ENDPATH**/ ?>