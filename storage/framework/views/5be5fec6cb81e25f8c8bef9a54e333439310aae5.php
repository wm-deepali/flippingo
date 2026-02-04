

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
                                    <li class="breadcrumb-item active">Enquiries</li>
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
                                <h4 class="card-title">Enquiries</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="enquiries-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Enquiry ID</th>
                                                <th>Buyer Info</th>
                                                <th>Seller Info</th>
                                                <th>Product Info</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $enquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($enquiry->created_at->format('d M Y H:i')); ?></td>
                                                    <td>#<?php echo e($enquiry->id); ?></td>
                                                    <td>
                                                        ID: <?php echo e($enquiry->customer->customer_id ?? '-'); ?><br>
                                                        <?php echo e($enquiry->customer->first_name ?? '-'); ?>

                                                        <?php echo e($enquiry->customer->last_name ?? '-'); ?><br>
                                                        <?php echo e($enquiry->customer->email ?? '-'); ?>

                                                    </td>
                                                    <td>
                                                        ID: <?php echo e($enquiry->submission->customer->customer_id ?? '-'); ?><br>
                                                        <?php echo e($enquiry->submission->customer->first_name ?? '-'); ?>

                                                        <?php echo e($enquiry->submission->customer->last_name ?? '-'); ?><br>
                                                        <?php echo e($enquiry->submission->customer->email ?? '-'); ?>

                                                    </td>
                                                    <td>
                                                        <span
                                                            class="product-name"><?php echo e($enquiry->submission->product_title ?? ''); ?></span><br>
                                                        <small><?php echo e($enquiry->submission->category_name); ?></small><br>
                                                        <?php if($enquiry->submission->product_photo): ?>
                                                            <img src="<?php echo e(asset('storage/' . $enquiry->submission->product_photo)); ?>"
                                                                alt="Product Photo" width="50">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(Str::limit($enquiry->message, 100)); ?></td>
                                                    <td>
                                                        <?php if($enquiry->status == 'pending'): ?>
                                                            <span class="badge badge-warning">Pending</span>
                                                        <?php elseif($enquiry->status == 'completed'): ?>
                                                            <span class="badge badge-success">Completed</span>
                                                        <?php else: ?>
                                                            <span
                                                                class="badge badge-secondary"><?php echo e(ucfirst($enquiry->status)); ?></span>
                                                        <?php endif; ?>
                                                    </td>
<td class="actions">
                                  
 <a href="<?php echo e(route('admin.form-submissions.show', $enquiry->submission->id)); ?>" class="btn btn-sm btn-secondary">
                            View Product Detail
                        </a>
                       
                        <a href="<?php echo e(route('admin.customers.show',  $enquiry->submission->customer_id ?? '')); ?>" target="_blank" class="btn btn-sm btn-info">
                            View Seller Info
                        </a>
                          <a href="<?php echo e(route('admin.form-submissions.sales',$enquiry->customer_id )); ?>" target="_blank" class="btn btn-sm btn-primary">
                           View Buyer Info
                        </a>
                                </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No enquiries found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <?php echo e($enquiries->links()); ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/enquiry/index.blade.php ENDPATH**/ ?>