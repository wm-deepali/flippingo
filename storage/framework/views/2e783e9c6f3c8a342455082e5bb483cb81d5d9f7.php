

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Reports'); ?>

<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">

        <div class="report-analystics container my-4">

            <!-- Title -->
            <h4 class="fw-bold">Analytics for: <?php echo e($submission->product_title); ?></h4>
            <p>Category: <?php echo e($submission->category_name ?? '-'); ?></p>

            <!-- Summary Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="report-card pastel-blue">
                        <p>Total Clicks</p>
                        <h3><?php echo e(array_sum($chartClicks)); ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="report-card pastel-green">
                        <p>Total Views</p>
                        <h3><?php echo e(array_sum($chartViews)); ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="report-card pastel-purple">
                        <p>Unique Views</p>
                        <h3><?php echo e(array_sum($chartUniques ?? [])); ?></h3>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-header">
                    <h5>Views & Clicks (Last 30 Days)</h5>
                </div>
                <div class="card-body">
                    <canvas id="submissionChart" style="width:100%; height:400px;"></canvas>
                </div>
            </div>


        </div>

        <!-- CSS -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('submissionChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
        datasets: [
            {
                label: 'Views',
                data: <?php echo json_encode($chartViews, 15, 512) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Clicks',
                data: <?php echo json_encode($chartClicks, 15, 512) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Unique Views',
                data: <?php echo json_encode($chartUniques ?? [], 15, 512) ?>,
                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'top' },
            title: {
                display: true,
                text: 'Submission Activity Last 30 Days'
            }
        },
        scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Count' } },
            x: { title: { display: true, text: 'Date' } }
        }
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/analytics-detail.blade.php ENDPATH**/ ?>