@extends('layouts.new-master')

@section('title')
    {{ $page->meta_title ?? 'Flippingo' }}
@endsection

@section('meta_tags')
    <meta name="title" content="{{ $page->meta_title }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <meta name="keywords" content="{{ $page->meta_keyword }}">
@endsection

@section('content')
    @if($page && $page->status === 'published')
        <section class="breadcrumb-area bread-bg">
            <div class="overlay"></div>
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2 class="sec__title text-white mb-3">{{ $page->page_name }}</h2>
                    <ul class="bread-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{$page->page_name }}</li>
                    </ul>
                </div>
            </div>
            <div class="bread-svg">
                <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                    <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
                </svg>
            </div>
        </section>
        <section class="blog-area padding-top-60px padding-bottom-70px">
            <div class="container">

                <div>{!! $page->detail !!}</div>
            </div>
        </section>

    @else
        <div class="page-wrapper">
            <div class="page-content text-center py-5">
                <h3>Page not found or unpublished.</h3>
            </div>
        </div>
    @endif
@endsection