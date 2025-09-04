@extends('layouts.new-master')

@section('title')
    {{ $blog->meta_title ?? $blog->title }}
@endsection

@section('meta_tags')
    <meta name="title" content="{{ $blog->meta_title }}">
    <meta name="description" content="{{ $blog->meta_description }}">
    <meta name="keywords" content="{{ $blog->meta_keyword }}">
@endsection

@section('content')

    <!-- ================================
                START BREADCRUMB AREA
            ================================= -->
    <section class="breadcrumb-area bread-bg" style="margin-top: 80px;">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="sec__title text-white mb-3">
                    {{ $blog->title }}
                </h2>
                <ul class="bread-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Blog</li>
                    <li>{{ $blog->title }}</li>
                </ul>
            </div>
        </div>
        <div class="bread-svg">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
            </svg>
        </div>
    </section>
    <!-- ================================
                END BREADCRUMB AREA
            ================================= -->

    <!-- ================================
                START BLOG AREA
            ================================= -->
    <section class="blog-area padding-top-60px padding-bottom-70px">
        <div class="container">
            <div class="row">
                <!-- Blog Content -->
                <div class="col-lg-8 mb-5">
                    <div class="card">
                        <a href="#" class="card-image">
                            <img src="{{ $blog->banner ? asset('storage/' . $blog->banner) : $blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('images/img-loading.jpg') }}"
                                alt="{{ $blog->title }}" class="card-img-top" />
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">{{ $blog->title }}</h4>
                            <ul class="card-meta d-flex flex-wrap align-items-center">
                                <li>By Admin</li>
                                <li><span class="mx-1">-</span></li>
                                <li>{{ $blog->created_at->format('d M, Y') }}</li>
                                <li><span class="mx-1">-</span></li>
                                <li><a href="#">{{ $blog->category->name ?? 'Uncategorized' }}</a></li>
                            </ul>

                            <div class="card-text font-weight-regular mt-3">
                                {!! $blog->detail !!}
                            </div>

                            <div class="social-icons mt-4">
                                <span class="text-black font-weight-semi-bold me-1">Share:</span>

                                {{-- Facebook --}}
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blogs.show', $blog->slug)) }}"
                                    target="_blank" title="Share on Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                {{-- Twitter --}}
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blogs.show', $blog->slug)) }}&text={{ urlencode($blog->title) }}"
                                    target="_blank" title="Share on Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>

                                {{-- LinkedIn --}}
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blogs.show', $blog->slug)) }}"
                                    target="_blank" title="Share on LinkedIn">
                                    <i class="fab fa-linkedin"></i>
                                </a>

                                {{-- WhatsApp --}}
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . route('blogs.show', $blog->slug)) }}"
                                    target="_blank" title="Share on WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                {{-- Email --}}
                                <a href="mailto:?subject={{ rawurlencode($blog->title) }}&body={{ rawurlencode(route('blogs.show', $blog->slug)) }}"
                                    target="_blank" title="Share via Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Related Posts -->
                    <div class="row my-5">
                        <div class="col-lg-12">
                            <h4 class="card-title mb-4">Related Posts</h4>
                        </div>
                        @forelse($recentBlogs as $recent)
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="card hover-y">
                                    <a href="{{ route('blogs.show', $recent->slug) }}" class="card-image">
                                        <img src="{{ $recent->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('images/img-loading.jpg') }}"
                                            alt="{{ $recent->title }}" class="card-img-top" />
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="{{ route('blogs.show', $recent->slug) }}">{{ $recent->title }}</a>
                                        </h4>
                                        <ul class="card-meta d-flex flex-wrap align-items-center">
                                            <li>{{ $recent->created_at->format('d M, Y') }}</li>
                                            <li><span class="mx-1">-</span></li>
                                            <li><a href="#">{{ $recent->category->name ?? 'Uncategorized' }}</a></li>
                                        </ul>
                                        <p class="card-text mt-3">
                                            {{ Str::limit(strip_tags($recent->detail), 100) }}
                                        </p>
                                        <div class="post-author d-flex align-items-center justify-content-between mt-3">
                                            <div>
                                                <!-- <img src="{{ asset('images/testi-img7.jpg') }}" alt="author" /> -->
                                                <span>By</span>
                                                <a href="#">Admin</a>
                                            </div>
                                            <a href="{{ route('blogs.show', $recent->slug) }}">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No related posts found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Search</h4>
                                <form method="GET" action="#">
                                    <div class="form-group">
                                        <span class="fal fa-search form-icon"></span>
                                        <input class="form-control form--control" type="text" name="q"
                                            value="{{ request('q') }}" placeholder="Search blog..." />
                                    </div>
                                    <button class="theme-btn border-0 w-100" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Categories</h4>
                                <ul class="tag-list">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('blogs.category', $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Popular Posts</h4>
                                <ul class="media-list">
                                    @foreach($recentBlogs as $recent)
                                        <li class="media media-card mb-3">
                                            <a href="{{ route('blogs.show', $recent->slug) }}"
                                                class="flex-shrink-0 me-3 d-block">
                                                <img src="{{ $recent->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('images/small-img.jpg') }}"
                                                    alt="{{ $recent->title }}" />
                                            </a>
                                            <div class="media-body align-self-center">
                                                <h5 class="media-title mb-1">
                                                    <a
                                                        href="{{ route('blogs.show', $recent->slug) }}">{{ Str::limit($recent->title, 40) }}</a>
                                                </h5>
                                                <p class="font-size-15">{{ $recent->created_at->format('d M, Y') }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Social</h4>
                                <div class="social-icons">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sidebar -->
            </div>
        </div>
    </section>
@endsection