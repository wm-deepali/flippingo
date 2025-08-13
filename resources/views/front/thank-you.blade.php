@extends('layouts.new-master')

@section('title', 'Thank You')

@push('after-styles')
<style>
    .thank-you-container {
        max-width: 700px;
        margin: 80px auto;
        text-align: center;
        background: #f9f9f9;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .thank-you-icon {
        font-size: 60px;
        color: #28a745;
        margin-bottom: 20px;
    }

    .thank-you-heading {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .thank-you-message {
        font-size: 18px;
        color: #555;
        margin-bottom: 30px;
    }

    .quote-id {
        font-size: 20px;
        color: #007bff;
        font-weight: 600;
        margin-top: 10px;
    }

    .btn-return-home {
        padding: 12px 25px;
        font-size: 16px;
    }
</style>
@endpush

@section('content')
<div class="thank-you-container">
    <div class="thank-you-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <div class="thank-you-heading">Congratulations!</div>
    <div class="thank-you-message">
        Your order request has been saved successfully.<br>
        Our team will review your order and update you soon.
    </div>
  <div class="quote-id">
    Your Quote ID: #{{ request('quote_id') ?? 'XXXXXX' }}
</div>

    <a href="{{ url('/') }}" class="btn btn-primary btn-return-home mt-4">Return to Home</a>
</div>
@endsection
