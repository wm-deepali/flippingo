

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Orders'); ?>

<?php $__env->stopSection(); ?>

<style>
    .order-invoice {
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }

    /* Cards */
    .order-cards {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .order-card {
        flex: 1;
        padding: 20px;
        border-radius: 10px;
        color: #fff;
        text-align: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .order-card h4 {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .order-card .count {
        font-size: 22px;
        font-weight: bold;
    }

    .order-card.recent {
        background: #bbdefb;
        color: #0d47a1;
    }

    /* Light Blue */
    .order-card.active {
        background: #c8e6c9;
        color: #1b5e20;
    }

    /* Light Green */
    .order-card.cancelled {
        background: #ffcdd2;
        color: #b71c1c;
    }

    /* Light Red */
    .order-card.refund {
        background: #ffe0b2;
        color: #e65100;
    }

    /* Light Orange */

    .order-table tbody tr:nth-child(odd) {
        background-color: #f1f8ff;
        /* हल्का blue */
    }

    .order-table tbody tr:nth-child(even) {
        background-color: #ffffff;
        /* सफेद */
    }

    /* Tabs */
    .order-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .tab-btn {
        padding: 10px 15px;
        border: none;
        background: #f1f1f1;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: 0.3s;
    }

    .tab-btn.active {
        background: #2196f3;
        color: #fff;
    }

    /* Table */
    .order-table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-table th,
    .order-table td {
        padding: 12px;
        border: 1px solid #ddd;
        font-size: 14px;
    }

    .order-table thead {
        background: #f5f5f5;
    }

    .order-table tbody tr:nth-child(odd) {
        background: #fafafa;
    }

    .status {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
    }

    .status.paid {
        background: #c8e6c9;
        color: #256029;
    }

    .status.pending {
        background: #fff9c4;
        color: #8d6e00;
    }

    .status.processing {
        background: #bbdefb;
        color: #0d47a1;
    }

    .status.shipped {
        background: #c5cae9;
        color: #1a237e;
    }

    .action-btn {
        padding: 6px 10px;
        margin: 2px;
        border: none;
        border-radius: 5px;
        background: #e0e0e0;
        cursor: pointer;
        font-size: 12px;
    }

    .action-btn:hover {
        background: #ccc;
    }

    .action-btn.refund {
        background: #f44336;
        color: #fff;
    }

    /* Tab Content */
    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .order-tabs {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .order-card {
        flex: 1;
        padding: 15px;
        border-radius: 10px;
        color: #333;
        text-align: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .order-card h4 {
        font-size: 16px;
        margin-bottom: 5px;
    }

    .order-card p {
        font-size: 20px;
        font-weight: bold;
    }

    /* Pastel backgrounds */
    .order-card.recent {
        background: #bbdefb2b;
        color: #0d47a1;
    }

    .order-card.active {
        background: #c8e6c938;
        color: #1b5e20;
    }

    .order-card.cancelled {
        background: #ffcdd22f;
        color: #b71c1c;
    }

    .order-card.refund {
        background: #ffe0b22d;
        color: #e65100;
    }

    /* Scrollable Table */
    .table-wrapper {
        overflow-x: auto;
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .order-table th,
    .order-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .order-table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .order-table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    /* Product Name Bold */
    .product-name {
        font-weight: bold;
    }

    /* Action Icons */
    .actions i {
        margin-right: 10px;
        cursor: pointer;
        color: #555;
        transition: color 0.2s;
    }

    .actions i:hover {
        color: #000;
    }
</style>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="order-invoice">
            <!-- Order Tabs -->

            <div class="order-tabs">
                <div class="order-card recent">
                    <h4>Recent Orders</h4>
                    <p><?php echo e($counts['recent']); ?></p>
                </div>
                <div class="order-card active">
                    <h4>Delivered Orders</h4>
                    <p><?php echo e($counts['delivered']); ?></p>
                </div>
                <div class="order-card cancelled">
                    <h4>Cancellation Requested Orders</h4>
                    <p><?php echo e($counts['cancel_requested']); ?></p>
                </div>
                <div class="order-card refund">
                    <h4>Cancelled & Refunds Orders</h4>
                    <p><?php echo e($counts['refunds']); ?></p>
                </div>
            </div>

            <div class="order-tabs">
                <button class="tab-btn active" data-tab="recent">Recent Orders</button>
                <button class="tab-btn" data-tab="delivered">Delivered Orders</button>
                <button class="tab-btn" data-tab="cancelled">Cancellation Requested Orders</button>
                <button class="tab-btn" data-tab="refunds">Cancelled & Refunds</button>
            </div>

            <div class="tab-content active" id="recent">
                <?php echo $__env->make('user.orders.seller-table', ['orders' => $recentOrders], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="tab-content" id="delivered">
                <?php echo $__env->make('user.orders.seller-table', ['orders' => $deliveredOrders], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="tab-content" id="cancelled">
                <?php echo $__env->make('user.orders.seller-table', ['orders' => $cancelRequestedOrders], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="tab-content" id="refunds">
                <?php echo $__env->make('user.orders.seller-table', ['orders' => $refundOrders], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

        </div>

        <!-- Font Awesome -->

        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>

    <!-- Cancel Order Modal -->
    <div id="cancelOrderModal" class="modal" style="display:none;">
        <div class="modal-content"
            style="padding:20px; border-radius:8px; width:400px; background:#fff; margin:auto; margin-top:100px;">
            <h4>Cancel Order</h4>
            <form id="cancelOrderForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="order_id" id="cancelOrderId">

                <div class="form-group">
                    <label>Reason</label>
                    <select name="reason" class="form-control" required>
                        <option value="">Select reason</option>
                        <option value="wrong_item">Ordered wrong item</option>
                        <option value="delay">Delay in delivery</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-danger">Submit</button>
                <button type="button" class="btn btn-secondary close-modal">Close</button>
            </form>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Open modal
            document.querySelectorAll('.cancel-order-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const orderId = this.dataset.orderId;
                    document.getElementById('cancelOrderId').value = orderId;
                    document.getElementById('cancelOrderModal').style.display = 'block';
                });
            });

            // Close modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('cancelOrderModal').style.display = 'none';
                });
            });

            // Optional: close on outside click
            window.addEventListener('click', function (e) {
                if (e.target.id === 'cancelOrderModal') {
                    document.getElementById('cancelOrderModal').style.display = 'none';
                }
            });
        });


        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

                button.classList.add('active');
                document.getElementById(button.dataset.tab).classList.add('active');
            });
        });

        // Submit cancel form
        document.getElementById('cancelOrderForm').addEventListener('submit', function (e) {
            e.preventDefault();

            fetch("<?php echo e(route('orders.cancel')); ?>", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    order_id: document.getElementById('cancelOrderId').value,
                    reason: this.reason.value,
                    remarks: this.remarks.value,
                })
            })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });


    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/orders/seller.blade.php ENDPATH**/ ?>