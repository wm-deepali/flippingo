@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Contact Us' }}
@endsection


@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">

        <div class="contact-us-page">
            <h2 class="contact-title">Contact Us</h2>
            <div class="contact-cards">
                <!-- Email & Mobile -->
                <div class="contact-card email-card">
                    <h3><i class="fas fa-envelope"></i> Email & Mobile</h3>
                    <p><strong>Email:</strong> support@example.com</p>
                    <p><strong>Mobile:</strong> +91 9876543210</p>
                </div>

                <!-- Full Address -->
                <div class="contact-card address-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Full Address</h3>
                    <p>Nuvem Prints Pvt Ltd</p>
                    <p>2nd Floor, Business Tower, MG Road</p>
                    <p>Bangalore, India - 560001</p>
                </div>

                <!-- Live Chat -->
                <div class="contact-card chat-card">
                    <h3><i class="fas fa-comments"></i> Live Chat</h3>
                    <p>Chat with our support team for instant help.</p>
                    <button class="chat-btn"><i class="fas fa-comment-dots"></i> Start Chat</button>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('scripts')



@endpush