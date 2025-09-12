<div class="table-responsive">
    <table class="table table-bordered" id="orders-table-active">
        <thead>
            <tr>
                <th>Submitted At</th>
                <th>Category</th>
                <th>Seller Info</th>
                <th>Submission ID</th>
                <th>Title</th>
                <th>Product Cost</th>
                <th>Total Sales</th>
                <th>Expiry Date</th>
                
                <th>Status</th>
                
<?php if($submissions->first()?->status === 'rejected'): ?>
    <th>Remarks</th>
<?php endif; ?>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(\Carbon\Carbon::parse($submission->created_at)->format('Y-m-d H:i')); ?></td>
                       <td><?php echo e($submission['category_name']); ?></td>
                    <!-- Seller Info -->
                    <td>
                        ID: <?php echo e($submission->customer->customer_id ?? '-'); ?><br>
                        <?php echo e($submission->customer->first_name ?? '-'); ?> <?php echo e($submission->customer->last_name ?? '-'); ?><br>
                        <?php echo e($submission->customer->email ?? '-'); ?>

                    </td>

  <td><?php echo e($submission->id); ?></td>
                <td><?php echo e($submission->product_title); ?></td>
                <td><?php echo e(number_format($submission->offered_price, 2)); ?></td>
               <td><?php echo e($submission->total_sales); ?></td>

                   <td><?php echo e(\Carbon\Carbon::parse($submission->expires_at)->format('Y-m-d H:i')); ?></td>

                    <!-- Order Status -->
                    <td>
                        <?php switch($submission->status):
                            case ('pending'): ?>
                                <span class="badge badge-secondary">Recent</span>
                                <?php break; ?>
                            <?php case ('published'): ?>
                                <span class="badge badge-success">Published</span>
                                <?php break; ?>
                            <?php case ('expired'): ?>
                                <span class="badge badge-warning">Expired</span>
                                <?php break; ?>
                            <?php case ('rejected'): ?>
                                <span class="badge badge-danger">Rejected</span>
                                <?php break; ?>
                            <?php default: ?>
                                <span class="badge badge-light"><?php echo e(ucfirst($submission->status)); ?></span>
                        <?php endswitch; ?>
                    </td>

                
<?php if($submission->status === 'rejected'): ?>
    <td><?php echo e($submission->currentStatus->remarks ?? '-'); ?></td>
<?php endif; ?>

                    <!-- Action Buttons -->
                    <td>
                        <a href="<?php echo e(route('admin.form-submissions.show', $submission->id)); ?>" class="btn btn-sm btn-secondary">
                            View Listing Detail
                        </a>
                         <button class="btn btn-sm btn-warning changeStatusBtn"
                          data-id="<?php echo e($submission->id); ?>"
                            data-status="<?php echo e($submission->status ?? ''); ?>"
                             >
                            Change Status
                        </button>
                        <a href="<?php echo e(route('admin.customers.show',  $submission->customer->id ?? '')); ?>" target="_blank" class="btn btn-sm btn-info">
                            View Seller Info
                        </a>
                        <a href="<?php echo e(route('admin.form-submissions.edit', $submission->id)); ?>" target="_blank" class="btn btn-sm btn-primary">
                            Edit Listing
                        </a>
                          <a href="<?php echo e(route('admin.form-submissions.sales',$submission->id )); ?>" target="_blank" class="btn btn-sm btn-primary">
                           View All Sales
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form_submissions/table.blade.php ENDPATH**/ ?>