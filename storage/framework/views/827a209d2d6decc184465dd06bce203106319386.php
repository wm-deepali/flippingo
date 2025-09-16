<table class="table table-hover">
    <thead>
        <tr>
            <th>Submission Date</th>
            <th>Product Title</th>
            <th>Category</th>
            <th>Total Clicks</th>
            <th>Total Views</th>
            <th>Unique Views</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($submission->created_at->format('Y-m-d')); ?></td>
                <td><?php echo e($submission->product_title); ?></td>
                <td><?php echo e($submission->category_name ?? '-'); ?></td>

                <td><?php echo e(number_format($submission->period_clicks)); ?></td>
                <td><?php echo e(number_format($submission->period_views)); ?></td>
                <td><?php echo e(number_format($submission->period_unique)); ?></td>

                <td>
                    <span class="badge badge-<?php echo e($submission->status === 'published' ? 'success' : 'secondary'); ?>">
                        <?php echo e(ucfirst($submission->status)); ?>

                    </span>
                </td>
                <td>
                    <a href="<?php echo e(route('admin.form-submissions.analytics', $submission->id)); ?>"
                        class="btn btn-sm btn-primary">View</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php echo e($submissions->links()); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/reports/listing-table.blade.php ENDPATH**/ ?>