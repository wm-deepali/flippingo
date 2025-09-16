

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
                                    <li class="breadcrumb-item active">Manage Tickets</li>
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
                                <h4 class="card-title">Support Tickets</h4>
                            </div>
                            <div class="card-body">

                                <!-- Tabs navigation -->
                                <ul class="nav nav-tabs" id="ticketTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="all-tab" data-toggle="tab" data-target="#all"
                                            type="button" role="tab" aria-controls="all" aria-selected="true">All
                                            Tickets</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new-tab" data-toggle="tab" data-target="#new"
                                            type="button" role="tab" aria-controls="new" aria-selected="false">New
                                            Tickets</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="progress-tab" data-toggle="tab" data-target="#progress"
                                            type="button" role="tab" aria-controls="progress" aria-selected="false">In
                                            Progress</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="resolved-tab" data-toggle="tab" data-target="#resolved"
                                            type="button" role="tab" aria-controls="resolved"
                                            aria-selected="false">Resolved</button>
                                    </li>
                                </ul>

                                <!-- Tabs content -->
                                <div class="tab-content pt-2" id="ticketTabsContent">
                                    <div class="tab-pane fade show active" id="all" role="tabpanel"
                                        aria-labelledby="all-tab">
                                        <?php echo $__env->make('admin.tickets.table', ['tickets' => $tickets], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
                                        <?php echo $__env->make('admin.tickets.table', ['tickets' => $tickets->where('status', 'New')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                                        <?php echo $__env->make('admin.tickets.table', ['tickets' => $tickets->where('status', 'In Progress')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="tab-pane fade" id="resolved" role="tabpanel" aria-labelledby="resolved-tab">
                                        <?php echo $__env->make('admin.tickets.table', ['tickets' => $tickets->where('status', 'Resolved')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.querySelectorAll('.btn-reply').forEach(btn => {
            btn.addEventListener('click', event => {
                const ticketId = btn.getAttribute('data-ticket-id');
                const ticketSubject = btn.getAttribute('data-ticket-subject');

                document.getElementById('reply_ticket_id').value = ticketId;
                document.getElementById('ticket_subject').textContent = ticketSubject;
                document.getElementById('reply_text').value = '';

                $('#replyModal').modal('show');
            });
        });


        document.querySelectorAll('.btn-change-status').forEach(button => {
            button.addEventListener('click', function () {
                const ticketId = this.getAttribute('data-ticket-id');
                const ticketStatus = this.getAttribute('data-ticket-status');

                // Set hidden input (optional if needed)
                document.getElementById('modal_ticket_id').value = ticketId;

                // Set current status as selected
                const statusSelect = document.getElementById('statusSelectModal');
                statusSelect.value = ticketStatus;

                // Set form action URL dynamically
                const form = document.getElementById('statusForm');
                form.action = `/admin/tickets/${ticketId}/status`;

                // Show modal (requires Bootstrap JS)
                $('#statusModal').modal('show');
            });
        });

    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>