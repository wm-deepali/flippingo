

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Orders'); ?>

<?php $__env->stopSection(); ?>


<style>
    .bank-account {
        font-family: Arial, sans-serif;
    }

    .payment-tabs {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .payment-card {
        flex: 1;
        background: #f8f9fa;
        padding: 15px;
        text-align: center;
        border-radius: 8px;
        cursor: pointer;
        border: 1px solid #ddd;
        transition: 0.3s;
    }

    .payment-card.active {
        border: 2px solid #007bff;
        background: #e9f3ff;
    }

    .payment-card h4 {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
    }

    .payment-card p {
        font-size: 12px;
        color: #666;
        margin: 5px 0 0;
    }

    .payment-forms {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        background: #fff;
    }

    .form-box {
        display: none;
    }

    .form-box.show {
        display: block;
    }

    .form-box h3 {
        margin-bottom: 15px;
    }

    .form-box label {
        display: block;
        margin-top: 10px;
        font-weight: 500;
        margin-bottom: 0px;
        font-size: 14px;
    }

    .form-box input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .btn-submit {
        margin-top: 15px;
        background: linear-gradient(90.85deg, #00B7F8 0.73%, #00BCFF 51.67%, #26C6FFBD 102.46%);
        border: none;
        color: white;
        padding: 6px 50px;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background: #0056b3;
    }
</style>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', ['activeTab' => request('tab', 'buyer')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="bank-account">
            <!-- Payment Method Tabs -->
            <div class="payment-tabs">
                <div class="payment-card active" data-tab="bank">
                    <h4>Bank Transfer</h4>
                    <p>Minimum Amount: 100$</p>
                </div>
                <div class="payment-card" data-tab="upi">
                    <h4>UPI</h4>
                    <p>Minimum Amount: 100$</p>
                </div>
                <div class="payment-card" data-tab="wire">
                    <h4>Wire Transfer</h4>
                    <p>Minimum Amount: 100$</p>
                </div>
                <div class="payment-card" data-tab="paypal">
                    <h4>Paypal</h4>
                    <p>Minimum Amount: 100$</p>
                </div>
            </div>

            <!-- Payment Forms -->
            <div class="payment-forms" style="width: 60%;">
                <!-- Bank Transfer -->
                <div class="form-box show" id="bank">
                    <h3>Bank Transfer</h3>
                    <hr>
                    <label>Account Holder Name</label>
                    <input type="text" placeholder="Enter Account Holder Name">

                    <label>Account Number</label>
                    <input type="text" placeholder="Enter Account Number">

                    <label>IFSC Code</label>
                    <input type="text" placeholder="Enter IFSC Code">

                    <label>Bank Name</label>
                    <input type="text" placeholder="Enter Bank Name">

                    <label>Branch Name</label>
                    <input type="text" placeholder="Enter Branch Name">

                    <button class="btn-submit">Add</button>
                </div>

                <!-- UPI -->
                <div class="form-box" id="upi">


                    <p class="small-note">Please make sure that you have entered the correct UPI payment details.</p>

                    <label>Amount Receiver Name</label>
                    <input type="text" placeholder="Enter Receiver Name">

                    <label>UPI Id</label>
                    <input type="text" placeholder="Enter your UPI ID">

                    <button class="btn-submit">Add</button>
                </div>

                <!-- Wire Transfer -->
                <div class="form-box" id="wire">
                    <p>Please make sure that you have entered the correct <strong>WIRE</strong> payment details.</p>

                    <form class="wire-form">
                        <div class="form-group">
                            <label for="wireAccountNumber">Account Number</label>
                            <input type="text" id="wireAccountNumber" placeholder="Enter Account Number">
                        </div>

                        <div class="form-group">
                            <label for="wireAccountOwner">Account Owner</label>
                            <input type="text" id="wireAccountOwner" placeholder="Enter Account Owner Name">
                        </div>

                        <div class="form-group">
                            <label for="wireBankName">Bank Name</label>
                            <input type="text" id="wireBankName" placeholder="Enter Bank Name">
                        </div>

                        <div class="form-group">
                            <label for="wireBankAddress">Bank Address</label>
                            <input type="text" id="wireBankAddress" placeholder="Enter Bank Branch Address">
                        </div>

                        <div class="form-group">
                            <label for="wireSwiftCode">Bank Swift Code</label>
                            <input type="text" id="wireSwiftCode" placeholder="Enter SWIFT/BIC Code">
                        </div>

                        <div class="form-group">
                            <label for="wireIban">IBAN Number</label>
                            <input type="text" id="wireIban" placeholder="Enter IBAN Number">
                        </div>

                        <button type="submit" class="btn-submit">Add</button>
                    </form>
                </div>

                <!-- Paypal -->
                <div class="form-box" id="paypal">
                    <p class="small-note">Please make sure that you have entered the correct UPI payment details.</p>

                    <label>Amount Receiver Name</label>
                    <input type="text" placeholder="Enter Receiver Name">

                    <label>UPI Id</label>
                    <input type="email" placeholder="Enter Paypal Email">

                    <button class="btn-submit">Add</button>
                </div>
            </div>
        </div>

        <footer class="footer text-center text-muted">
            All Rights Reserved by Adminmart. Designed and Developed by
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
const cards = document.querySelectorAll(".payment-card");
const forms = document.querySelectorAll(".form-box");

cards.forEach(card => {
  card.addEventListener("click", () => {
    // remove active class
    cards.forEach(c => c.classList.remove("active"));
    forms.forEach(f => f.classList.remove("show"));

    // add active class to clicked
    card.classList.add("active");
    document.getElementById(card.dataset.tab).classList.add("show");
  });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/bank-account.blade.php ENDPATH**/ ?>