

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

    <?php echo $__env->make('user.sidebar', ['activeTab' => request('tab', 'buyer')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="order-invoice">
            <!-- Order Tabs -->

            <div class="order-tabs">
                <div class="order-card recent">
                    <h4>Recent Orders</h4>
                    <p>25</p>
                </div>
                <div class="order-card active">
                    <h4>Active Orders</h4>
                    <p>12</p>
                </div>
                <div class="order-card cancelled">
                    <h4>Cancelled Orders</h4>
                    <p>5</p>
                </div>
                <div class="order-card refund">
                    <h4>Refunds</h4>
                    <p>3</p>
                </div>
            </div>
            <div class="order-tabs">
                <button class="tab-btn active" data-tab="recent">Recent Orders</button>
                <button class="tab-btn" data-tab="active">Active Orders</button>
                <button class="tab-btn" data-tab="cancelled">Cancelled Orders</button>
                <button class="tab-btn" data-tab="refunds">Refunds</button>
            </div>
            <!-- Scrollable Table -->
            <div class="table-wrapper">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Order ID</th>
                            <th>Product Detail</th>
                            <th>Billed Amount</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>04 Sep 2025, 11:30 AM</td>
                            <td>#ORD12345</td>
                            <td><span class="product-name">Premium T-Shirt</span></td>
                            <td>$120</td>
                            <td>Paid</td>
                            <td>Delivered</td>
                            <td class="actions">
                                <i class="fas fa-eye" title="View Order Detail"></i>
                                <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                                <i class="fas fa-undo" title="Request Refund"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>03 Sep 2025, 05:10 PM</td>
                            <td>#ORD12344</td>
                            <td><span class="product-name">Business Mug</span></td>
                            <td>$45</td>
                            <td>Pending</td>
                            <td>Processing</td>
                            <td class="actions">
                                <i class="fas fa-eye" title="View Order Detail"></i>
                                <i class="fas fa-file-invoice" title="View Payment Detail"></i>
                                <i class="fas fa-undo" title="Request Refund"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Font Awesome -->

        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    document.querySelectorAll('.tab-btn').forEach(button => {
  button.addEventListener('click', () => {
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

    button.classList.add('active');
    document.getElementById(button.dataset.tab).classList.add('active');
  });
});

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/orders.blade.php ENDPATH**/ ?>