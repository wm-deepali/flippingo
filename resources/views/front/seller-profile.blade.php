@extends('layouts.new-master')

@section('title', $seller->name . ' | Seller Profile')

@section('content')

    <section class="card-area padding-top-60px padding-bottom-90px" style="margin-top: 100px;">
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">

                    <div class="card shadow-sm text-center">
                        <div class="card-body">

                            {{-- PROFILE IMAGE --}}
                            <div class="mb-3">
                                <img src="{{ $seller->profile_pic
        ? asset('storage/' . $seller->profile_pic)
        : asset('user_assets/images/users/profile-pic.jpg') }}" class="rounded-circle"
                                    style="width:140px;height:140px;object-fit:cover;" alt="Seller Image">
                            </div>

                            {{-- NAME --}}
                            <h4 class="mb-1">
                                {{ $seller->name }}
                            </h4>

                            {{-- VERIFIED BADGE --}}
                            @if($seller->is_verified)
                                <span class="badge badge-success mb-2">Verified Seller</span>
                            @endif

                            {{-- BASIC DETAILS --}}
                            <div class="mt-3 text-muted small">
                                <p class="mb-1">
                                    <strong>Country:</strong>
                                    {{ $seller->countryname->name ?? '-' }}
                                </p>

                                <p class="mb-1">
                                    <strong>Member Since:</strong>
                                    {{ $seller->created_at->format('M Y') }}
                                </p>

                                <p class="mb-0">
                                    <strong>Total Listings:</strong>
                                    {{ $seller->listing_count }}
                                </p>
                            </div>

                            {{-- BACK --}}
                            <div class="mt-4">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                                    ← Back
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection