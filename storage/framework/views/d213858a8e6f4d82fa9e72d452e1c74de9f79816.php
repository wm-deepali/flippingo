

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Orders'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="order-invoice">
            <!-- Order Tabs -->

            <div class="order-tabs">
                <div class="order-card recent">
                    <h4>Total Enquiries</h4>
                    <p><?php echo e($totalEnquiries ?? '0'); ?></p>
                </div>
                <div class="order-card active">
                    <h4>Total Customers</h4>
                    <p><?php echo e($totalCustomers ?? '0'); ?></p>
                </div>
            </div>

            <div class="filters mb-3 d-flex justify-content-between align-items-center">
                <!-- Filters -->
                <form method="GET" action="<?php echo e(route('dashboard.enquiries')); ?>" class="d-flex gap-3 flex-wrap">

                    <!-- Business Category -->
                    <select name="business_category" class="form-control">
                        <option value="">All Business Categories</option>
                        <?php $__currentLoopData = $businessCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(request('business_category') == $cat->id ? 'selected' : ''); ?>>
                                <?php echo e($cat->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <!-- Listings -->
                    <select name="submission_id" class="form-control">
                        <option value="">All Listings</option>
                        <?php $__currentLoopData = $submissionsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($listing->id); ?>" <?php echo e(request('submission_id') == $listing->id ? 'selected' : ''); ?>>
                                <?php echo e($listing->product_title ?? 'Listing #' . $listing->id); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <!-- Date Range -->
                    <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="form-control">
                    <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="form-control">

                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?php echo e(route('dashboard.enquiries')); ?>" class="btn btn-secondary">Reset</a>
                </form>

                <!-- Sorting -->
                <form method="GET" action="<?php echo e(route('dashboard.enquiries')); ?>">
                    <select name="sort" class="form-control" onchange="this.form.submit()">
                        <option value="recent" <?php echo e(request('sort') == 'recent' ? 'selected' : ''); ?>>Recent First</option>
                        <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>>Oldest First</option>
                    </select>
                </form>
            </div>


            <div class="table-wrapper">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Enquiry ID</th>
                            <th>Buyer Info</th>
                            <th>Product Info</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $enquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($enquiry->created_at->format('d M Y, h:i A')); ?></td>
                                <td>#<?php echo e($enquiry->id); ?></td>
                                <td>
                                    ID: <?php echo e($enquiry->customer->customer_id ?? '-'); ?><br>
                                    <?php echo e($enquiry->customer->first_name ?? '-'); ?> <?php echo e($enquiry->customer->last_name ?? '-'); ?><br>
                                    <?php echo e($enquiry->customer->email ?? '-'); ?>

                                </td>
                                <td>
                                    <span class="product-name"><?php echo e($enquiry->submission->product_title ?? ''); ?></span><br>
                                    <small><?php echo e($enquiry->submission->category_name); ?></small><br>
                                    <?php if($enquiry->submission->product_photo): ?>
                                        <img src="<?php echo e(asset('storage/' . $enquiry->submission->product_photo)); ?>" alt="Product Photo"
                                            width="50">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(Str::limit($enquiry->message, 100)); ?></td>
                                <td>
                                    <?php if($enquiry->status == 'pending'): ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php elseif($enquiry->status == 'completed'): ?>
                                        <span class="badge badge-success">Completed</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary"><?php echo e(ucfirst($enquiry->status)); ?></span>
                                    <?php endif; ?>
                                </td>

                                <td class="actions">
                                    <a href="<?php echo e(route('listing.show', $enquiry->submission->id)); ?>">
                                        <i class="fas fa-eye" title="View Product"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7">No orders found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/enquiries.blade.php ENDPATH**/ ?>