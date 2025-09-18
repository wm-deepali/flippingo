

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Chats'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">

        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Chat</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item text-muted active" aria-current="page">Home</li>
                                <li class="breadcrumb-item text-muted" aria-current="page">Chat</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-5 align-self-center">
                    <div class="customize-input float-right">
                        <select
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            <option selected>Aug 19</option>
                            <option value="1">July 19</option>
                            <option value="2">Jun 19</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-lg-3 col-xl-2 border-right">
                                <div class="card-body border-bottom">
                                    <form>
                                        <input id="contactSearch" class="form-control" type="text"
                                            placeholder="Search Contact">

                                    </form>
                                </div>
                                <div class="scrollable position-relative" style="height: calc(100vh - 111px);">
                                    <ul class="mailbox list-style-none">
                                        <li>
                                            <div class="message-center">
                                                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="javascript:void(0)"
                                                        class="message-item d-flex align-items-center border-bottom px-3 py-2 contact"
                                                        data-id="<?php echo e($contact->id); ?>" data-type="<?php echo e($contact->type); ?>">
                                                        <div class="user-img">
                                                            <img src="<?php echo e($contact->avatar ? asset('storage/' . $contact->avatar) : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg'); ?>"
                                                                alt="user" class="img-fluid rounded-circle" width="40px">
                                                            <span
                                                                class="profile-status <?php echo e($contact->status ?? 'offline'); ?> float-right"></span>
                                                        </div>
                                                        <div class="w-75 d-inline-block v-middle pl-2">
                                                            <h6 class="message-title mb-0 mt-1"><?php echo e($contact->name); ?></h6>
                                                            <span
                                                                class="font-12 text-nowrap d-block text-muted text-truncate"><?php echo e($contact->last_message); ?></span>
                                                            <span
                                                                class="font-12 text-nowrap d-block text-muted"><?php echo e($contact->last_message_time); ?></span>
                                                        </div>
                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-lg-9  col-xl-10">
                                <div class="chat-header border-bottom p-3 d-flex align-items-center">
                                    <div class="chat-img">
                                        <img id="chatReceiverAvatar"
                                            src="<?php echo e($receiver->profile_pic ? asset('storage/' . $receiver->profile_pic) : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg'); ?>"
                                            class="rounded-circle" width="45">
                                    </div>
                                    <div class="chat-name pl-3">
                                        <h5 class="mb-0" id="chatReceiverName"><?php echo e($receiver->name ?? 'Admin'); ?></h5>
                                        <small class="text-muted" id="chatReceiverStatus">
                                            <?php echo e($receiver instanceof \App\Models\Customer ? ($receiver->online ? 'online' : 'offline') : 'online'); ?>

                                        </small>

                                    </div>
                                </div>

                                <div class="chat-box scrollable position-relative" style="height: calc(100vh - 111px);">
                                    <!--chat Row -->
                                    <ul class="chat-list list-style-none px-3 pt-3">
                                        <?php if($messages->isEmpty()): ?>
                                            <li class="text-center py-3">
                                                Start a conversation with <?php echo e($receiver->name ?? 'Admin'); ?>

                                            </li>
                                        <?php else: ?>
                                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li
                                                    class="chat-item <?php echo e($msg->sender_type === 'customer' && $msg->sender_id === auth('customer')->id() ? 'odd text-right' : ''); ?> list-style-none mt-3">
                                                    <?php if($msg->sender_type !== 'customer' || $msg->sender_id !== auth('customer')->id()): ?>
                                                        <div class="chat-img d-inline-block">
                                                            <img src="<?php echo e($msg->sender_avatar ? asset('storage/' . $msg->sender_avatar) : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg'); ?>"
                                                                class="rounded-circle" width="45">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div
                                                        class="chat-content d-inline-block pl-3 <?php echo e($msg->sender_type === 'customer' && $msg->sender_id === auth('customer')->id() ? 'text-right' : ''); ?>">
                                                        <h6 class="font-weight-medium"><?php echo e($msg->sender_name); ?></h6>
                                                        <div class="box msg p-2 d-inline-block mb-1"><?php echo e($msg->message); ?></div>
                                                    </div>
                                                    <div
                                                        class="chat-time d-block font-10 mt-1 mr-0 mb-3 <?php echo e($msg->sender_type === 'customer' && $msg->sender_id === auth('customer')->id() ? 'text-right' : ''); ?>">
                                                        <?php echo e($msg->created_at); ?>

                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php endif; ?>
                                    </ul>


                                </div>
                                <div class="card-body border-top">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="input-field mt-0 mb-0">
                                                <input id="textarea1" data-user-id="<?php echo e($receiver->id ?? ''); ?>"
                                                    data-user-type="<?php echo e($receiverType); ?>" placeholder="Type and enter"
                                                    class="form-control border-0" type="text">

                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <a class="btn-circle btn-lg btn-cyan float-right text-white send-btn"
                                                href="javascript:void(0)">
                                                <i class="fas fa-paper-plane"></i>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->


    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>

        $(function () {

            // Click contact to load chat
            // In Blade, create a "template" URL using placeholders
            let routeTemplate = "<?php echo e(route('dashboard.chat', ['receiver_type' => 'RECEIVER_TYPE', 'receiver_id' => 'RECEIVER_ID'])); ?>";

            // Click contact to load chat
            $(document).on('click', '.contact', function () {
                let receiver_id = $(this).data('id');
                let receiver_type = $(this).data('type');

                // Update input
                $('#textarea1').data('user-id', receiver_id);
                $('#textarea1').data('user-type', receiver_type);

                // Clear chat
                $('.chat-list').html('<li class="text-center py-3">Loading...</li>');

                // Replace placeholders with actual JS values
                let url = routeTemplate.replace('RECEIVER_TYPE', receiver_type).replace('RECEIVER_ID', receiver_id);

                // Fetch messages
                $.get(url, function (res) {
                    let html = '';
                    res.messages.forEach(function (msg) {
                        let isOwn = msg.sender_type === 'customer' && msg.sender_id === <?php echo e(auth('customer')->id()); ?>;
                        html += renderMessage(msg, isOwn);
                    });
                    $('.chat-list').html(html);
                    scrollToBottom();

                    // Update chat header
                    $('#chatReceiverName').text(res.receiver.name);
                    $('#chatReceiverAvatar').attr('src', res.receiver.profile_pic ? '/storage/' + res.receiver.profile_pic : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg');
                    $('#chatReceiverStatus').text(res.receiver_status ?? 'offline');
                });
            });




            function sendMessage() {
                let msg = $('#textarea1').val();
                let receiver_id = $('#textarea1').data('user-id');
                let receiver_type = $('#textarea1').data('user-type');
                if (!msg.trim() || !receiver_id) return;
                $.post("<?php echo e(route('chat.send')); ?>", {
                    _token: "<?php echo e(csrf_token()); ?>",
                    message: msg,
                    receiver_id: receiver_id,
                    receiver_type: receiver_type
                }, function (res) {
                    $('.chat-list').append(`
                                                                                    <li class="chat-item odd list-style-none mt-3">
                                                                                        <div class="chat-content text-right d-inline-block pl-3">
                                                                                            <div class="box msg p-2 d-inline-block mb-1">${res.message}</div>
                                                                                        </div>
                                                                                        <div class="chat-time text-right d-block font-10 mt-1 mr-0 mb-3">${res.created_at}</div>
                                                                                    </li>
                                                                                `);
                    $("#textarea1").val('');
                    scrollToBottom();

                });
            }

            $(document).on('keypress', "#textarea1", function (e) {
                console.log('here');

                if (e.keyCode == 13) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            $(document).on('click', '.send-btn', function (e) {
                e.preventDefault();
                sendMessage();
            });

        });


        window.Echo.channel('chat')
            .listen('MessageSent', (e) => {
                console.log('New message received', e);

                // Call your API to fetch fresh messages
                let receiver_id = $('#textarea1').data('user-id');
                let receiver_type = $('#textarea1').data('user-type');

                // Replace placeholders with actual JS values
                let url = routeTemplate.replace('RECEIVER_TYPE', receiver_type).replace('RECEIVER_ID', receiver_id);

                $.get(url, function (res) {
                    let html = '';
                    res.messages.forEach(function (msg) {
                        let isOwn = msg.sender_type === 'customer' && msg.sender_id === <?php echo e(auth('customer')->id()); ?>;
                        html += renderMessage(msg, isOwn);
                    });
                    $('.chat-list').html(html);
                    scrollToBottom();

                    // ✅ Update chat header
                    $('#chatReceiverName').text(res.receiver.name);
                    $('#chatReceiverAvatar').attr('src', res.receiver.profile_pic ? '/storage/' + res.receiver.profile_pic : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg');
                    $('#chatReceiverStatus').text(res.receiver_status ?? 'offline');

                });
            });

        function renderMessage(msg, isOwn = false) {
            return `
                                                    <li class="chat-item ${isOwn ? 'odd text-right' : ''} list-style-none mt-3">
                                                        ${!isOwn ? `<div class="chat-img d-inline-block">
                                                                        <img src="${msg.sender_avatar ? '/storage/' + msg.sender_avatar : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg'}" class="rounded-circle" width="45">
                                                                    </div>` : ''}
                                                        <div class="chat-content d-inline-block pl-3 ${isOwn ? 'text-right' : ''}">
                                                            <h6 class="font-weight-medium">${msg.sender_name}</h6>
                                                            <div class="box msg p-2 d-inline-block mb-1">${msg.message}</div>
                                                        </div>
                                                        <div class="chat-time d-block font-10 mt-1 mr-0 mb-3 ${isOwn ? 'text-right' : ''}">
                                                            ${msg.created_at}
                                                        </div>
                                                    </li>
                                                `;
        }


        function scrollToBottom() {
            let chatBox = $('.chat-box');
            chatBox.scrollTop(chatBox[0].scrollHeight);
        }


        let originalContacts = null;

        $(function () {
            // Save original full contact list once on page load
            originalContacts = $('.message-center').children().clone();
        });

        $(document).on('keyup', '#contactSearch', function () {
            let value = $(this).val().toLowerCase();

            if (!value) {
                // Restore original order
                $('.message-center').empty().append(originalContacts.clone());
                return;
            }

            let matches = originalContacts.filter(function () {
                return $(this).text().toLowerCase().indexOf(value) > -1;
            });

            $('.message-center').empty();

            if (matches.length) {
                $('.message-center').append(matches.clone());
            } else {
                $('.message-center').html('<div class="p-3 text-center text-muted">No contacts found</div>');
            }
        });


    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/live-chat.blade.php ENDPATH**/ ?>