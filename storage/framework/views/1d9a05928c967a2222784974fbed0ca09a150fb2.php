

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Sales Reports'); ?>

<?php $__env->stopSection(); ?>


<style>
    .raise-ticket {
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    /* Top Cards */
    .ticket-cards {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .ticket-card {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        color: #333;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .ticket-card .ticket-left span {
        font-size: 18px;
        color: #666;
    }

    .ticket-card .ticket-left h3 {
        margin: 0;
        font-size: 28px !important;
        font-weight: 600 !important;
    }

    .ticket-card .ticket-icon {
        font-size: 28px;
    }

    /* pastel background */
    .ticket-card.new {
        background: #e0f7fa;
    }

    .ticket-card.progress {
        background: #fff3e0;
    }

    .ticket-card.resolved {
        background: #e8f5e9;
    }

    /* Header */
    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .ticket-header h2 {
        margin: 0;
    }

    .ticket-header p {
        flex: 1;
        /* margin: 0 15px;  */
        color: #555;
    }

    .btn-create {
        background: #059669;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-create:hover {
        background: #047857;
    }

    /* Table */
    .ticket-table {
        width: 100%;
        border-collapse: collapse;
    }

    .ticket-table th,
    .ticket-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        vertical-align: top;
    }

    .ticket-table th {
        background: #f9fafb;
    }

    .status {
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
    }

    .status.in-progress {
        background: #fef3c7;
        color: #92400e;
    }

    .status.resolved {
        background: #d1fae5;
        color: #065f46;
    }

    .btn-view,
    .btn-reply {
        padding: 6px 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin: 2px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-view {
        background: #3b82f6;
        color: #fff;
    }

    .btn-reply {
        background: #10b981;
        color: #fff;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 400px;
    }

    .modal-box form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .modal-box input,
    .modal-box textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .modal-actions {
        text-align: right;
        margin-top: 10px;
    }

    .btn-close {
        background: #f87171;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
    }

    .btn-submit {
        background: #059669;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
    }
</style>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">

        <div class="report-analystics container my-4">

            <!-- Title -->
            <h4 class="mb-4 fw-bold">Sales Reports</h4>

            <!-- Summary Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="report-card pastel-blue">
                        <p>Total Sales</p>
                        <h3><?php echo e(number_format($totalSales)); ?></h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="report-card pastel-green">
                        <p>Total Earning</p>
                        <h3><?php echo e(number_format($totalEarning)); ?></h3>
                    </div>
                </div>
            </div>

            <!-- Tabs -->

           <!-- Tabs -->
<ul class="nav nav-tabs mb-3 report-tabs" id="analyticsTabs">
    <li class="nav-item"><a href="<?php echo e(route('dashboard.reports', ['filter' => 'recent'])); ?>" class="nav-link <?php if($filter == 'recent'): ?> active <?php endif; ?>">Recent</a></li>
    <li class="nav-item"><a href="<?php echo e(route('dashboard.reports', ['filter' => 'seven-day'])); ?>" class="nav-link <?php if($filter == 'seven-day'): ?> active <?php endif; ?>">7 Days</a></li>
    <li class="nav-item"><a href="<?php echo e(route('dashboard.reports', ['filter' => 'fifteen-day'])); ?>" class="nav-link <?php if($filter == 'fifteen-day'): ?> active <?php endif; ?>">15 Days</a></li>
    <li class="nav-item"><a href="<?php echo e(route('dashboard.reports', ['filter' => 'thirty-day'])); ?>" class="nav-link <?php if($filter == 'thirty-day'): ?> active <?php endif; ?>">30 Days</a></li>
    <li class="nav-item"><a href="#" class="nav-link <?php if($filter == 'custom-date'): ?> active <?php endif; ?>" data-bs-toggle="tab" onclick="document.getElementById('customDateForm').style.display='flex'">Custom Date</a></li>
</ul>

<!-- Custom Date Form -->
<form method="GET" action="<?php echo e(route('dashboard.reports')); ?>" id="customDateForm" class="mb-3" style="display: <?php if($filter == 'custom-date'): ?> flex <?php else: ?> none <?php endif; ?>; gap: 10px;">
    <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="form-control" placeholder="Start Date">
    <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="form-control" placeholder="End Date">
    <input type="hidden" name="filter" value="custom-date">
    <button type="submit" class="btn btn-primary">Apply</button>
</form>


            <!-- Table -->
            <div class="table-responsive bg-white p-3 rounded shadow-sm">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date & Time</th>
                            <th>Order ID</th>
                            <th>Buyer Info</th>
                            <th>Seller Info</th>
                            <th>Product Cost</th>
                            <th>Your Earning</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php $status = $order->currentStatus->status ?? 'N/A'; ?>

                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i')); ?></td>
                                <td><?php echo e($order->order_number); ?></td>

                                <!-- Buyer Info -->
                                <td>
                                    ID: <?php echo e($order->customer->customer_id ?? '-'); ?><br>
                                    <?php echo e($order->customer->first_name ?? '-'); ?> <?php echo e($order->customer->last_name ?? '-'); ?><br>
                                    <?php echo e($order->customer->email ?? '-'); ?>

                                </td>

                                <!-- Seller Info -->
                                <td>
                                    ID: <?php echo e($order->seller->customer_id ?? '-'); ?><br>
                                    <?php echo e($order->seller->first_name ?? '-'); ?> <?php echo e($order->seller->last_name ?? '-'); ?><br>
                                    <?php echo e($order->seller->email ?? '-'); ?>

                                </td>

                                <!-- Product Cost -->
                                <td><?php echo e($order->amount ?? '-'); ?></td>

                                <td><?php echo e($order->seller_earning ?? '-'); ?></td>
                                <!-- Order Status -->



 <td>
                        <?php switch($status):
                            case ('recent'): ?>
                                <span class="badge badge-primary">Recent</span>
                                <?php break; ?>
                            <?php case ('approved'): ?>
                                <span class="badge badge-secondary">Approved</span>
                                <?php break; ?>
                            <?php case ('processing'): ?>
                                <span class="badge badge-info">Processing</span>
                                <?php break; ?>
                            <?php case ('delivered'): ?>
                                <span class="badge badge-success">Delivered</span>
                                <?php break; ?>
                            <?php case ('cancel_requested'): ?>
                                <span class="badge badge-warning">Cancel Requested</span>
                                <?php break; ?>
                            <?php case ('cancelled'): ?>
                                <span class="badge badge-danger">Cancelled</span>
                                <?php break; ?>
                            <?php default: ?>
                                <span class="badge badge-light"><?php echo e(ucfirst($status)); ?></span>
                        <?php endswitch; ?>
                    </td>

                                <!-- Action Buttons -->
                                <td>
                                    <a href="<?php echo e(route('orders.detail', $order->id)); ?>" class="btn btn-sm btn-secondary">
                                        View Order Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center">No submissions available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>


                </table>
            </div>


            <!-- Table -->


        </div>

        <!-- CSS -->
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/reports.blade.php ENDPATH**/ ?>