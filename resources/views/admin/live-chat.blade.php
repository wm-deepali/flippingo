@extends('layouts.master')

@section('title', 'Live Chat')

@section('content')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Live Chat</li>
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
                            <div class="row no-gutters">
                                <!-- Contacts List -->
                                <div class="col-lg-3 col-xl-2 border-right">
                                    <div class="card-body border-bottom">
                                        <input id="contactSearch" class="form-control" type="text"
                                            placeholder="Search Contact">
                                    </div>
                                    <div class="scrollable position-relative" style="height: calc(100vh - 111px);">
                                        <ul class="mailbox list-style-none">
                                            <li>
                                                <div class="message-center">
                                                    @foreach($contacts as $contact)
                                                        <a href="javascript:void(0)"
                                                            class="message-item d-flex align-items-center border-bottom px-3 py-2 contact"
                                                            data-id="{{ $contact->id }}" data-type="{{ $contact->type }}">
                                                            <div class="user-img">
                                                                <img src="{{ $contact->avatar ? asset('storage/' . $contact->avatar) : asset('admin_assets/images/admin-profile.png') }}"
                                                                    class="img-fluid rounded-circle" width="40px">
                                                                <span
                                                                    class="profile-status {{ $contact->status ?? 'offline' }}"></span>
                                                            </div>
                                                            <div class="w-75 d-inline-block v-middle pl-2">
                                                                <h6 class="message-title mb-0 margin-top-25">
                                                                    {{ $contact->name }}
                                                                </h6>
                                                                <span
                                                                    class="font-12 text-muted d-block text-truncate">{{ $contact->last_message }}</span>
                                                                <span
                                                                    class="font-12 text-muted d-block">{{ $contact->last_message_time }}</span>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Chat Box -->
                                <div class="col-lg-9 col-xl-10">
                                    <div class="chat-header border-bottom p-3 d-flex align-items-center">
                                        <div class="chat-img">
                                            <img id="chatReceiverAvatar"
                                                src="{{ $receiver->profile_pic ? asset('storage/' . $receiver->profile_pic) : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg' }}"
                                                class="rounded-circle" width="45">
                                        </div>
                                        <div class="chat-name padding-1rem">
                                            <h5 class="mb-0" id="chatReceiverName">{{ $receiver->name ?? 'Admin' }}</h5>
                                            <small class="text-muted" id="chatReceiverStatus">
                                                {{ $receiver instanceof \App\Models\Customer ? ($receiver->online ? 'online' : 'offline') : 'online' }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="chat-box scrollable position-relative" style="height: calc(100vh - 111px);">
                                        <!--chat Row -->
                                        <ul class="chat-list list-style-none px-3 pt-3">
                                            @if($messages->isEmpty())
                                                <li class="text-center py-3">
                                                    Start a conversation with {{ $receiver->name ?? 'Admin' }}
                                                </li>
                                            @else
                                                @foreach($messages as $msg)
                                                    <li
                                                        class="chat-item {{ $msg->sender_type === 'user' && $msg->sender_id === auth()->user()->id ? 'odd' : '' }} list-style-none margin-1rem">
                                                        @if($msg->sender_type !== 'user' || $msg->sender_id !== auth()->user()->id)
                                                            <div class="chat-img d-inline-block">
                                                                <img src="{{ $msg->sender_avatar ? asset('storage/' . $msg->sender_avatar) : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg' }}"
                                                                    class="rounded-circle" width="45">
                                                            </div>
                                                        @endif
                                                        <div
                                                            class="chat-content d-inline-block padding-1rem {{ $msg->sender_type === 'user' && $msg->sender_id === auth()->user()->id ? 'text-right' : '' }}">
                                                            <h6 class="font-weight-medium">{{ $msg->sender_name }}</h6>
                                                            <div class="box msg padding-2 d-inline-block mb-1">{{ $msg->message }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="chat-time d-block font-10 margin-top-25 mr-0 margin-1rem-bottom {{ $msg->sender_type === 'user' && $msg->sender_id === auth()->user()->id ? 'text-right' : '' }}">
                                                            {{ $msg->created_at }}
                                                        </div>
                                                    </li>
                                                @endforeach

                                            @endif
                                        </ul>


                                    </div>


                                    <div class="card-body border-top">
                                        <div class="row">
                                            <div class="col-9">
                                                <input id="textarea1" data-user-id="{{ $receiver->id ?? '' }}"
                                                    data-user-type="{{ $receiver instanceof \App\Models\Customer ? 'customer' : 'user' }}"
                                                    placeholder="Type and enter" class="form-control border-0" type="text">
                                            </div>
                                            <div class="col-3">
                                                <button type="button"
                                                    class="btn btn-primary float-right text-white send-btn">
                                                    Send
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')

    <script>

        // In Blade, create a "template" URL using placeholders
        let routeTemplate = "{{ route('dashboard.chat', ['receiver_type' => 'RECEIVER_TYPE', 'receiver_id' => 'RECEIVER_ID']) }}";


        $(function () {

            function sendMessage() {
                let msg = $('#textarea1').val();
                let receiver_id = $('#textarea1').data('user-id');
                let receiver_type = $('#textarea1').data('user-type');
                if (!msg.trim() || !receiver_id) return;

                $.post("{{ route('admin.live-chat.send') }}", {
                    _token: "{{ csrf_token() }}",
                    message: msg,
                    receiver_id: receiver_id,
                    receiver_type: receiver_type
                }, function (res) {
                    $('.chat-list').append(`
                                                                                <li class="chat-item odd list-style-none margin-1rem">
                                                                                    <div class="chat-content text-right d-inline-block padding-1rem">
                                                                                        <div class="box msg padding-2 d-inline-block mb-1">${res.message}</div>
                                                                                    </div>
                                                                                    <div class="chat-time text-right d-block font-10 margin-top-25 mr-0 margin-1rem-bottom">${res.created_at}</div>
                                                                                </li>
                                                                            `);
                    $("#textarea1").val('');
                    scrollToBottom();

                });
            }

            $(document).on('keypress', "#textarea1", function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            $(document).on('click', '.send-btn', function (e) {
                e.preventDefault();
                sendMessage();
            });


            // Click contact to load chat
            $(document).on('click', '.contact', function () {
                let receiver_id = $(this).data('id');
                let receiver_type = $(this).data('type');

                $('#textarea1').data('user-id', receiver_id);
                $('#textarea1').data('user-type', receiver_type);

                $('.chat-list').html('<li class="text-center py-3">Loading...</li>');
                // Replace placeholders with actual JS values
                let url = routeTemplate.replace('RECEIVER_TYPE', receiver_type).replace('RECEIVER_ID', receiver_id);

                $.get(url, function (res) {
                    let html = '';
                    res.messages.forEach(function (msg) {
                        let isOwn = msg.sender_type === 'user' && msg.sender_id === {{ auth()->user()->id  }};
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

        });

 // Enable Pusher logging for debugging (optional)
        Pusher.logToConsole = true;

        // Initialize Laravel Echo
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '44b3ff02c74805cc4d12',   // your Pusher key
            cluster: 'ap2',                 // your Pusher cluster
            forceTLS: true
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
                        let isOwn = msg.sender_type === 'user' && msg.sender_id === {{ auth()->user()->id }};
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
                                                                        <li class="chat-item ${isOwn ? 'odd text-right' : ''} list-style-none margin-1rem">
                                                                            ${!isOwn ? `<div class="chat-img d-inline-block">
                                                                                            <img src="${msg.sender_avatar ? '/storage/' + msg.sender_avatar : 'https://flippingo.store/user-dashboard/assets/images/users/1.jpg'}" class="rounded-circle" width="45">
                                                                                        </div>` : ''}
                                                                            <div class="chat-content d-inline-block padding-1rem ${isOwn ? 'text-right' : ''}">
                                                                                <h6 class="font-weight-medium">${msg.sender_name}</h6>
                                                                                <div class="box msg padding-2 d-inline-block mb-1">${msg.message}</div>
                                                                            </div>
                                                                            <div class="chat-time d-block font-10 margin-top-25 mr-0 margin-1rem-bottom ${isOwn ? 'text-right' : ''}">
                                                                                ${msg.created_at}
                                                                            </div>
                                                                        </li>
                                                                    `;
        }

        function scrollToBottom() {
            let chatBox = $('.chat-box');
            chatBox.scrollTop(chatBox[0].scrollHeight);
        }


        // 🔍 Search contacts

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
@endpush