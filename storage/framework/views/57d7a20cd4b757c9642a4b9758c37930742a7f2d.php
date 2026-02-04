

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
                                    <li class="breadcrumb-item active">Manage Listing Analytics</li>
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
                                <h4 class="card-title">Listing Analytics</h4>
                            </div>
                            <div class="card-body">


                                <ul class="nav nav-tabs" id="reportTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="active-tab" data-toggle="tab" href="#recent"
                                            role="tab" aria-controls="active" aria-selected="true">
                                            Today 
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" id="7day-tab" data-toggle="tab" href="#seven-day" role="tab"
                                            aria-controls="seven-day" aria-selected="false">
                                            7 Days
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="15day-tab" data-toggle="tab" href="#fifteen-day" role="tab"
                                            aria-controls="fifteen-day" aria-selected="false">
                                            15 Days
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="30day-tab" data-toggle="tab" href="#thirty-day" role="tab"
                                            aria-controls="thirty-day" aria-selected="false">
                                            30 Days
                                        </a>
                                    </li>
                                  <li class="nav-item">
    <a class="nav-link" id="all-tab" data-toggle="tab" href="#all-time" role="tab"
        aria-controls="all-time" aria-selected="false">
        All Time
    </a>
</li>

                                </ul>

                                <div class="tab-content" id="reportTabsContent">

                                <?php $__currentLoopData = ['today', 'seven-day', 'fifteen-day', 'thirty-day','all-time']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="tab-pane fade <?php if($loop->first): ?> show active <?php endif; ?>" id="<?php echo e($key); ?>" role="tabpanel" aria-labelledby="<?php echo e($key); ?>-tab">
        <?php if(isset($reports[$key]) && $reports[$key]->count()): ?>
            <?php echo $__env->make('admin.reports.listing-table', ['submissions' => $reports[$key]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <p class="text-center text-muted mt-4">No listing analytics records in this period.</p>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#customDateForm').on('submit', function (e) {
                e.preventDefault();

                let startDate = $('input[name="start_date"]').val();
                let endDate = $('input[name="end_date"]').val();

                $.ajax({
                    url: '<?php echo e(route("admin.reports.sales.customDate")); ?>',
                    method: 'GET',
                    data: { start_date: startDate, end_date: endDate },
                    beforeSend: function () {
                        $('#customDateResult').html('<div class="text-center py-4">Loading...</div>');
                    },
                    success: function (response) {
                        $('#customDateResult').html(response);
                    },
                    error: function () {
                        $('#customDateResult').html('<p class="text-center text-danger">Failed to load data.</p>');
                    }
                });
            });
        });
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/reports/listing.blade.php ENDPATH**/ ?>