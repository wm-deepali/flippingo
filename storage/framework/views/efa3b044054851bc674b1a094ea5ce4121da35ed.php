

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Customers</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Customer List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="customer-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Customer / Seller Info</th>
                                                <th>Wallet Balance</th>
                                                <th>Account Type</th>
                                                <th>Active Subscription</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <!-- Date & Time -->
                                                    <td><?php echo e($customer->created_at->format('Y-m-d H:i')); ?></td>

                                                    <!-- Customer / Seller Info -->
                                                    <td>
                                                        <small><?php echo e($customer->customer_id); ?></small><br>
                                                        <small><?php echo e($customer->display_name ?? $customer->first_name . ' ' . $customer->last_name); ?></small><br>
                                                        <small><?php echo e($customer->email); ?></small><br>
                                                        <small><?php echo e($customer->mobile ?? '-'); ?></small>
                                                    </td>

                                                    <!-- Wallet Balance -->
                                                    <td>
                                                        ₹<?php echo e(number_format($customer->wallet->balance ?? 0, 2)); ?>

                                                    </td>

                                                    <!-- Account Type -->
                                                    <td>
                                                        <?php echo e(ucfirst($customer->account_type ?? 'customer')); ?>

                                                    </td>

                                                    <!-- Active Subscription -->
                                                    <td>
                                                        <?php if($customer->activeSubscription): ?>
                                                            <span class="badge badge-success">
                                                                <?php echo e($customer->activeSubscription->package->name ?? ''); ?>

                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary">No Active</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <!-- Status -->
                                                    <td>
                                                        
                                                        <span
                                                            class="badge <?php echo e($customer->status === 'active' ? 'badge-success' : 'badge-danger'); ?>">
                                                            <?php echo e(ucfirst($customer->status ?? 'inactive')); ?>

                                                        </span>

                                                        <br>

                                                        
                                                        <?php if($customer->is_verified): ?>
                                                            <span class="badge badge-info" data-toggle="tooltip"
                                                                title="<?php echo e($customer->verification_note ?? 'Verified by admin'); ?>">
                                                                ✔ Verified
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary">Not Verified</span>
                                                        <?php endif; ?>
                                                    </td>


                                                    <!-- Actions -->
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                                                data-toggle="dropdown">
                                                                Actions
                                                            </button>

                                                            <div class="dropdown-menu dropdown-menu-right">

                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('admin.customers.show', $customer->id)); ?>">
                                                                    View
                                                                </a>

                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('admin.customers.edit', $customer->id)); ?>">
                                                                    Edit
                                                                </a>

                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('admin.seller-orders', $customer->id)); ?>">
                                                                    View Orders
                                                                </a>

                                                                <a class="dropdown-item" href="#">Wallet</a>
                                                                <a class="dropdown-item" href="#">Subscriptions</a>
                                                                <a class="dropdown-item" href="#">Enquiries</a>
                                                                <a class="dropdown-item" href="#">Chats</a>
                                                                <a class="dropdown-item" href="#">Tickets</a>

                                                                <div class="dropdown-divider"></div>

                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('admin.customers.kyc-bank', $customer->id)); ?>">
                                                                    KYC & Bank Details
                                                                </a>


                                                                <div class="dropdown-divider"></div>

                                                                
                                                                <button class="dropdown-item" data-toggle="modal"
                                                                    data-target="#changePasswordModal<?php echo e($customer->id); ?>">
                                                                    Change Password
                                                                </button>

                                                                
                                                                <button class="dropdown-item text-danger delete-customer"
                                                                    data-id="<?php echo e($customer->id); ?>">
                                                                    Delete
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">No customers found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="changePasswordModal<?php echo e($customer->id); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?php echo e(route('admin.customers.updatePassword', $customer->id)); ?>" method="POST" class="modal-content">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Change Password for <?php echo e($customer->display_name ?? $customer->first_name); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete-customer', function () {
                const customerId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This customer will be permanently deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/customers/${customerId}`,
                            type: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            success: function (response) {
                                Swal.fire('Deleted!', response.message, 'success').then(() => location.reload());
                            },
                            error: function () {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>