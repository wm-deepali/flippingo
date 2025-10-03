

<?php $__env->startSection('title'); ?>
  Checkout | Flippingo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="breadcrumb-area bread-bg" style="margin-top: 40px;">
    <div class="overlay"></div>
    <div class="container">
      <div class="breadcrumb-content text-center">
        <h2 class="sec__title text-white mb-3">Checkout</h2>
        <ul class="bread-list">
          <li><a href=<?php echo e(Route('home')); ?>>home</a></li>
          <li>Checkout</li>
        </ul>
      </div>
    </div>
    <div class="bread-svg">
      <svg viewBox="0 0 500 150" preserveAspectRatio="none">
        <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
      </svg>
    </div>
  </section>


  <?php
    $requiredAmount = max(0, $total - $walletBalance);
  ?>

  <section class="card-area padding-top-60px padding-bottom-90px">
    <div class="container">
      <div class="row justify-content-center">
        <!-- LEFT SIDE: PRODUCT DETAILS + PAYMENT -->
        <div class="col-lg-7 mb-4">
          <div class="card shadow-sm mb-4">
            <div class="card-body d-flex align-items-center">
              <?php if($productPhoto): ?>
                <img src="<?php echo e(asset('storage/' . $productPhoto)); ?>" alt="<?php echo e($productTitle); ?>" class="img-fluid rounded me-3"
                  style="max-width: 120px;">
              <?php endif; ?>
              <div>
                <h5 class="mb-1"><?php echo e($productTitle); ?></h5>
                <p class="text-muted small mb-0">Category: <?php echo e($category ?? 'N/A'); ?></p>
              </div>
            </div>
          </div>

          <div class="card shadow-sm">
            <div class="card-body">
              <form id="checkoutForm" method="POST"
                action="<?php echo e(route('checkout.place-order', ['id' => $submission->id])); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="submission_id" value="<?php echo e($submission->id); ?>">
                <input type="hidden" name="subtotal" value="<?php echo e(number_format($mrp, 2, '.', '')); ?>">
                <input type="hidden" name="discount" value="<?php echo e(number_format($discount ?? 0, 2, '.', '')); ?>">
                <input type="hidden" name="igst" value="<?php echo e(number_format($igst ?? 0, 2, '.', '')); ?>">
                <input type="hidden" name="cgst" value="<?php echo e(number_format($cgst ?? 0, 2, '.', '')); ?>">
                <input type="hidden" name="sgst" value="<?php echo e(number_format($sgst ?? 0, 2, '.', '')); ?>">
                <input type="hidden" name="total" value="<?php echo e(number_format($total, 2, '.', '')); ?>">


                <h2 class="h5 mb-4">Payment Options</h2>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" value="pay_online" id="payOnline"
                      checked>
                    <label class="form-check-label" for="payOnline">Pay Online</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" value="wallet" id="walletPay">
                    <label class="form-check-label" for="walletPay">
                      Use Wallet Balance (Balance: ₹<?php echo e(number_format($walletBalance, 2) ?? '0.00'); ?>)
                      &nbsp;
                      <a class="text-primary" id="addMoneyButton" data-amount="<?php echo e($requiredAmount * 100); ?>"
                        style="text-decoration: underline; cursor: pointer;">
                        Add Funds
                      </a>
                    </label>
                  </div>

                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Plac Order</button>
              </form>
            </div>
          </div>
        </div>

        <!-- RIGHT SIDE: ORDER SUMMARY -->
        <div class="col-lg-5">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="mb-4">Order Summary</h4>

              <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>₹<?php echo e(number_format($mrp, 2)); ?></span>
              </div>

              <?php if(!empty($discount) && $discount > 0): ?>
                <div class="d-flex justify-content-between">
                  <span>Discount</span>
                  <span>- ₹<?php echo e(number_format($discount, 2)); ?></span>
                </div>
              <?php endif; ?>

              <!-- GST details -->
              <?php if($gstType === 'igst'): ?>
                <div class="d-flex justify-content-between">
                  <span>IGST</span>
                  <span>₹<?php echo e(number_format($igst, 2)); ?></span>
                </div>
              <?php elseif($gstType === 'cgst_sgst'): ?>
                <div class="d-flex justify-content-between">
                  <span>CGST</span>
                  <span>₹<?php echo e(number_format($cgst, 2)); ?></span>
                </div>
                <div class="d-flex justify-content-between">
                  <span>SGST</span>
                  <span>₹<?php echo e(number_format($sgst, 2)); ?></span>
                </div>
              <?php endif; ?>

              <hr>
              <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>₹<?php echo e(number_format($total, 2)); ?></span>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>

    document.addEventListener('DOMContentLoaded', function () {
      var addMoneyButton = document.getElementById('addMoneyButton');
      var checkoutForm = document.getElementById('checkoutForm');

      // For Razorpay wallet topup button (existing code)
      if (addMoneyButton) {
        addMoneyButton.addEventListener('click', function () {
          var amount = this.getAttribute('data-amount');
          var options = {
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
              }).then(res => res.json())
                .then(data => {
                  if (data.success) {
                    Swal.fire('Success', 'Wallet funded', 'success')
                      .then(() => location.reload());
                  } else {
                    Swal.fire('Error', data.message || 'Failed', 'error');
                  }
                }).catch(() => {
                  Swal.fire('Error', 'Verification failed', 'error');
                });
            },
            prefill: {
              name: "<?php echo e(auth()->user()->name); ?>",
              email: "<?php echo e(auth()->user()->email); ?>",
              contact: "<?php echo e(auth()->user()->phone ?? ''); ?>"
            },
            theme: { color: "#2979ff" }
          };
          var rzp = new Razorpay(options);
          rzp.open();
        });
      }

      // Handle checkout form AJAX submit
      checkoutForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(form);
        var paymentMethod = form.querySelector('input[name="payment_method"]:checked').value;

        if (paymentMethod === 'pay_online') {
          // Start Razorpay payment
          var amountInPaise = parseInt(<?php echo e(intval($total * 100)); ?>);

          var options = {
            key: "<?php echo e(config('services.razorpay.key')); ?>",
            amount: amountInPaise,
            currency: "INR",
            name: "Flippingo",
            description: "<?php echo e($productTitle); ?>",
            image: "<?php echo e(asset('logo.png')); ?>",
            handler: function (response) {
              // Append payment id to form data
              formData.append('razorpay_payment_id', response.razorpay_payment_id);

              // Send AJAX to place order
              placeOrder(form.action, formData);
            },
            prefill: {
              name: "<?php echo e(auth()->user()->name); ?>",
              email: "<?php echo e(auth()->user()->email); ?>",
              contact: "<?php echo e(auth()->user()->phone ?? ''); ?>"
            },
            theme: { color: "#2979ff" }
          };
          var rzp = new Razorpay(options);
          rzp.open();

        } else if (paymentMethod === 'wallet') {
          // Check wallet balance client side
          var walletBalance = parseFloat(<?php echo e($walletBalance); ?>);
          var totalAmount = parseFloat(<?php echo e($total); ?>);

          if (walletBalance < totalAmount) {
            Swal.fire('Insufficient wallet balance.');
            return;
          }

          // No razorpay_payment_id for wallet payment
          placeOrder(form.action, formData);
        }
      });

      // AJAX function to place order
      function placeOrder(url, formData) {
        fetch(url, {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire('Order Successful', 'Your order has been placed.', 'success')
                .then(() => window.location.href = data.redirect_url );
            } else {
              Swal.fire('Error', data.message || 'Order placement failed.', 'error');
            }
          })
          .catch(() => {
            Swal.fire('Error', 'Server error occurred.', 'error');
          });
      }
    });


  </script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/checkout.blade.php ENDPATH**/ ?>