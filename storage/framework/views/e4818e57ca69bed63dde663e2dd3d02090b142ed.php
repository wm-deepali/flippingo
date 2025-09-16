

<?php $__env->startSection('title', 'Listing Analytics'); ?>

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
                                <li class="breadcrumb-item active">Submission Analytics</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">

            <h4>Analytics for: <?php echo e($submission->product_title); ?></h4>
            <p>Category: <?php echo e($submission->category_name ?? '-'); ?></p>

            
            <div class="row mt-3 mb-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Total Views</h5>
                            <p class="display-4"><?php echo e(array_sum($chartViews)); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Total Clicks</h5>
                            <p class="display-4"><?php echo e(array_sum($chartClicks)); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Total Unique Views</h5>
                            <p class="display-4"><?php echo e(array_sum($chartUniques ?? [])); ?></p>
                        </div>
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
    </div>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/reports/analytics-detail.blade.php ENDPATH**/ ?>