

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Orders'); ?>

<?php $__env->stopSection(); ?>


<style>
    .notification-section {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .notif-cards {
        display: flex;
        gap: 15px;
        margin-bottom: 50px;
    }

    .notif-card {
        flex: 1;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .notif-card h4 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .notif-count {
        font-size: 22px;
        font-weight: bold;
    }

    .notif-recent {
        background: #e8f4ff;
    }

    .notif-unread {
        background: #fff3e6;
    }

    .notif-read {
        background: #eafbea;
    }

    .notif-bookmark {
        background: #f5e9ff;
    }

    .notif-controls {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .notif-filter label {
        font-weight: bold;
        margin-right: 5px;
    }

    .notif-search input {
        padding: 6px 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .notif-table {
        width: 100%;
        border-collapse: collapse;
    }

    .notif-table th,
    .notif-table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .notif-table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .notif-table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .notif-flag {
        background: red;
        color: #fff;
        font-size: 10px;
        padding: 2px 5px;
        border-radius: 4px;
        margin-left: 8px;
    }

    .btn-view,
    .btn-bookmark {
        padding: 5px 10px;
        margin-right: 5px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-view {
        background: #007bff;
        color: white;
    }

    .btn-bookmark {
        background: #e7e6e2;
    }
</style>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="notification-section">
            <!-- Top Cards -->
            <div class="notif-cards">
                <div class="notif-card notif-recent">
                    <h4>Recent Notifications</h4>
                    <span class="notif-count"><?php echo e($counts['recent']); ?></span>
                </div>
                <div class="notif-card notif-unread">
                    <h4>Unread</h4>
                    <span class="notif-count"><?php echo e($counts['unread']); ?></span>
                </div>
                <div class="notif-card notif-read">
                    <h4>Read</h4>
                    <span class="notif-count"><?php echo e($counts['read']); ?></span>
                </div>
                <div class="notif-card notif-bookmark">
                    <h4>Bookmarks</h4>
                    <span class="notif-count"><?php echo e($counts['bookmarks']); ?></span>
                </div>
            </div>


            <!-- Filter & Search -->
            <div class="notif-controls">
                <div class="notif-filter">
                    <!-- Filter -->
                    <form method="GET">
                        <label>Filter By:</label>
                        <select name="filter" onchange="this.form.submit()"
                            style="height: 40px;border: none; border: 1px solid rgba(128, 128, 128, 0.671); border-radius: 4px;width: 150px; padding: 0px 10px;">
                            <option value="">Recent First</option>
                            <option value="Unread" <?php echo e(($filter ?? '') == 'Unread' ? 'selected' : ''); ?>>Unread</option>
                            <option value="Read" <?php echo e(($filter ?? '') == 'Read' ? 'selected' : ''); ?>>Read</option>
                            <option value="Bookmarks" <?php echo e(($filter ?? '') == 'Bookmarks' ? 'selected' : ''); ?>>Bookmarks
                            </option>
                        </select>
                    </form>
                </div>
                <div class="notif-search">
                    <input type="text" placeholder="Search Notifications...">
                </div>
            </div>

            <!-- Notification Table -->
            <table class="notif-table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Notification Detail</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($notification->created_at->format('d-M-Y h:i A')); ?></td>
                            <td>
                                <strong style="font-weight: 600;">
                                    <?php echo e($notification->subject ?? 'Notification'); ?>

                                </strong><br>
                                <?php echo $notification->content ?? ''; ?>

                                <?php if(!$notification->pivot->read_at): ?>
                                    <span class="notif-flag">NEW</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($notification->pivot->status == 'read' ? 'Read' : 'Unread'); ?></td>
                            <td>
                                <div style="display: flex; gap: 5px; align-items: center;">
                                    <form action="<?php echo e(route('notifications.markAsRead', $notification->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn-view">👁</button>
                                    </form>
                                    <form action="<?php echo e(route('notifications.toggleBookmark', $notification->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn-bookmark">
                                            <?php if($notification->pivot->is_bookmarked): ?>
                                                <i class="fa-solid fa-bookmark" style="color: red;"></i>
                                            <?php else: ?>
                                                <i class="fa-regular fa-bookmark"></i>
                                            <?php endif; ?>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center">No notifications found.</td>
                        </tr>
                    <?php endif; ?>


                </tbody>
            </table>
        </div>



        <footer class="footer text-center text-muted">
            All Rights Reserved by Adminmart. Designed and Developed by
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/notifications.blade.php ENDPATH**/ ?>