@extends('layouts.new-master')

@section('title', $category->name . ' Blogs | Flippingo')

@section('content')
    <section class="breadcrumb-area bread-bg">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="sec__title text-white mb-3">{{ $category->name }}</h2>
                <ul class="bread-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Blog</li>
                    <li>{{ $category->name }}</li>
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
            <div class="row">
                @forelse($blogs as $blog)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card hover-y">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="card-image">
                                <img src="{{ $blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('images/img-loading.jpg') }}"
                                    alt="{{ $blog->title }}" class="card-img-top" />
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h4>
                                <ul class="card-meta d-flex flex-wrap align-items-center">
                                    <li>{{ $blog->created_at->format('d M, Y') }}</li>
                                    <li><span class="mx-1">-</span></li>
                                    <li>{{ $category->name }}</li>
                                </ul>
                                <p class="card-text mt-3">
                                    {{ Str::limit(strip_tags($blog->detail), 120) }}
                                </p>
                                <div class="post-author d-flex align-items-center justify-content-between mt-3">
                                    <div>
                                        <span>By</span>
                                        <a href="#">Admin</a>
                                    </div>
                                    <a href="{{ route('blogs.show', $blog->slug) }}">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No blogs found in this category</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
@endsection