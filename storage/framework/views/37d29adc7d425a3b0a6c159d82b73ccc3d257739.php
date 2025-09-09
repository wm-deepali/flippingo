

<?php $__env->startSection('title'); ?>
  <?php echo e($page->meta_title ?? 'Subscription Plan'); ?>

<?php $__env->stopSection(); ?>

<style>
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

  <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="page-wrapper">

    <div class="subscription-page">
      <h2 class="subscription-title">Subscription Plan</h2>
      <div class="subscription-modal-body">
        <div class="packages-grid">

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

                  <button class="subscription-btn choose-plan" data-id="<?php echo e($package->id); ?>" data-name="<?php echo e($package->name); ?>"
                    data-amount="<?php echo e($package->offered_price * 100); ?>"
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
    <!-- Packages Modal -->
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

  <script>
    let hasSubscription = true; // backend se check karna hoga

    // Page pe check
    window.onload = function () {
      if (hasSubscription) {
        document.getElementById("withSubscription").style.display = "flex";
        document.getElementById("noSubscription").style.display = "none";
      } else {
        document.getElementById("withSubscription").style.display = "none";
        document.getElementById("noSubscription").style.display = "block";
      }
    };

    // Modal Functions
    function openRenewModal() {
      document.getElementById("renewModal").style.display = "flex";
    }
    function closeRenewModal() {
      document.getElementById("renewModal").style.display = "none";
    }

    function openPackagesModal() {
      document.getElementById("packagesModal").style.display = "flex";
    }
    function closePackagesModal() {
      document.getElementById("packagesModal").style.display = "none";
    }
  </script>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    let redirectAfterPayment = "<?php echo e(request('redirect') ? route(request('redirect')) : route('dashboard.subscriptions')); ?>";

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

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/subscription-plan.blade.php ENDPATH**/ ?>