

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

<!-- Payment Choice Modal -->
<div class="modal fade" id="paymentChoiceModal" tabindex="-1" aria-labelledby="paymentChoiceModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:12px;">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentChoiceModalLabel">Choose Payment Method</h5>
<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

       </div>

        <div class="modal-body text-center">
          <p>
            <strong>Wallet Balance:</strong> ₹<?php echo e(number_format($walletBalance, 2)); ?>

            <br>
            <a class="text-primary" id="addMoneyButton" data-amount="0"
              style="text-decoration: underline; cursor: pointer; display:none;">
              ➕ Add Funds
            </a>
          </p>

          <hr>
          <button class="btn btn-success w-100 mb-2" id="payFromWalletBtn">💰 Pay from Wallet</button>
          <button class="btn btn-primary w-100" id="payOnlineBtn">💳 Pay Online</button>
        </div>
      </div>
    </div>
  </div>

  <?php $__env->startPush('scripts'); ?>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

    function closeModal() {
  let modalEl = document.getElementById('paymentChoiceModal');
  let modal = bootstrap.Modal.getOrCreateInstance(modalEl);
  modal.hide();
}


      let redirectAfterPayment = "<?php echo e(request('redirect') ? route(request('redirect')) : route('dashboard.subscriptions')); ?>";

      document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".choose-plan").forEach(button => {
          button.addEventListener("click", function () {
            selectedPackage = {
              id: this.getAttribute("data-id"),
              name: this.getAttribute("data-name"),
              amount: this.getAttribute("data-amount"),
              description: this.getAttribute("data-description"),
            };

            // Show modal
            let modal = new bootstrap.Modal(document.getElementById('paymentChoiceModal'));
            modal.show();
          });
        });

        // Wallet Payment
        document.getElementById("payFromWalletBtn").addEventListener("click", function () {
          fetch("<?php echo e(route('subscription.store')); ?>", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify({
              package_id: selectedPackage.id,
              payment_method: "wallet"
            })
          })
            .then(res => res.json())
            .then(data => {
              if (data.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Subscription Activated!',
                  text: 'Paid via Wallet successfully.'
                }).then(() => {
                  window.location.href = redirectAfterPayment;
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Wallet Payment Failed',
                  text: data.message || 'Insufficient balance.'
                });
              }
            });
        });

        // Online Payment
        document.getElementById("payOnlineBtn").addEventListener("click", function () {
          let options = {
            key: "<?php echo e(config('services.razorpay.key')); ?>",
            amount: selectedPackage.amount,
            currency: "INR",
            name: "Flippingo",
            description: selectedPackage.description,
            image: "<?php echo e(asset('logo.png')); ?>",
            handler: function (response) {
              fetch("<?php echo e(route('subscription.store')); ?>", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({
                  razorpay_payment_id: response.razorpay_payment_id,
                  package_id: selectedPackage.id,
                  payment_method: "razorpay"
                })
              })
                .then(res => res.json())
                .then(data => {
                  if (data.success) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Subscription Activated!',
                      text: 'Your subscription has been activated successfully.'
                    }).then(() => {
                      window.location.href = redirectAfterPayment;
                    });
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'Payment was successful but saving subscription failed.'
                    });
                  }
                });
            }
          };

          let rzp = new Razorpay(options);
          rzp.open();
        });


        let walletBalance = parseFloat("<?php echo e($walletBalance); ?>");

        document.querySelectorAll(".choose-plan").forEach(button => {
          button.addEventListener("click", function () {
            selectedPackage = {
              id: this.getAttribute("data-id"),
              name: this.getAttribute("data-name"),
              amount: parseFloat(this.getAttribute("data-amount")), // in paise
              description: this.getAttribute("data-description"),
            };

            let packagePrice = selectedPackage.amount / 100; // convert back to INR
            let requiredAmount = Math.max(0, packagePrice - walletBalance);

            let addBtn = document.getElementById("addMoneyButton");

            if (requiredAmount > 0) {
              addBtn.style.display = "inline";
              addBtn.setAttribute("data-amount", requiredAmount * 100); // paise
              addBtn.textContent = "➕ Add ₹" + requiredAmount.toFixed(2) + " to Wallet";
            } else {
              addBtn.style.display = "none";
            }

            // Show modal
            let modal = new bootstrap.Modal(document.getElementById('paymentChoiceModal'));
            modal.show();
          });
        });


        let addMoneyButton = document.getElementById("addMoneyButton");

        if (addMoneyButton) {
          addMoneyButton.addEventListener("click", function () {
            let amount = this.getAttribute("data-amount");

            let options = {
              key: "<?php echo e(config('services.razorpay.key')); ?>",
              amount: amount,
              currency: "INR",
              name: "Flippingo Wallet",
              description: "Add funds to wallet",
              image: "<?php echo e(asset('logo.png')); ?>",
              handler: function (response) {
                fetch("<?php echo e(route('wallet.add_funds')); ?>", {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                  },
                  body: JSON.stringify({
                    razorpay_payment_id: response.razorpay_payment_id,
                    amount: amount
                  })
                })
                  .then(res => res.json())
                  .then(data => {
                    if (data.success) {
                      Swal.fire('Success', 'Wallet funded successfully.', 'success')
                        .then(() => location.reload());
                    } else {
                      Swal.fire('Error', data.message || 'Funding failed.', 'error');
                    }
                  })
                  .catch(() => {
                    Swal.fire('Error', 'Server error occurred.', 'error');
                  });
              },
              prefill: {
                name: "<?php echo e(auth()->user()->name); ?>",
                email: "<?php echo e(auth()->user()->email); ?>",
                contact: "<?php echo e(auth()->user()->phone ?? ''); ?>"
              },
              theme: { color: "#2979ff" }
            };

            let rzp = new Razorpay(options);
            rzp.open();
          });
        }

      });
    </script>

  <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/subscription-plan.blade.php ENDPATH**/ ?>