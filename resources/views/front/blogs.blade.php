@extends('layouts.new-master')

@section('title')
  {{ $page->meta_title ?? 'Flippingo' }}
@endsection

@section('content')
  <!-- ================================
    START BREADCRUMB AREA
  ================================= -->
  <section class="breadcrumb-area bread-bg">
    <div class="overlay"></div>
    <!-- end overlay -->
    <div class="container">
    <div class="breadcrumb-content text-center">
      <h2 class="sec__title text-white mb-3">Blog Grid</h2>
      <ul class="bread-list">
      <li><a href="{{ Route('home') }}">home</a></li>
      <li>Blog</li>
      <li>Blog Grid</li>
      </ul>
    </div>
    <!-- end breadcrumb-content -->
    </div>
    <!-- end container -->
    <div class="bread-svg">
    <svg viewBox="0 0 500 150" preserveAspectRatio="none">
      <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
    </svg>
    </div>
    <!-- end bread-svg -->
  </section>
  <!-- end breadcrumb-area -->
  <!-- ================================
    END BREADCRUMB AREA
  ================================= -->

  <!-- ================================
       START BLOG AREA
  ================================= -->
  <section class="blog-area padding-top-60px padding-bottom-70px">
    <div class="container">
    <div class="row">
      <div class="col-lg-4">
      <div class="card hover-y">
        <a href="{{ Route('blog-single') }}" class="card-image">
        <img src="images/img-loading.jpg" data-src="images/img1.jpg" alt="blog image" class="card-img-top lazy" />
        </a>
        <div class="card-body">
        <h4 class="card-title">
          <a href="{{ Route('blog-single') }}">50 Greatest Event Places in United Kingdom</a>
        </h4>
        <ul class="card-meta d-flex flex-wrap align-items-center">
          <li>25 Dec, 2018</li>
          <li><span class="mx-1">-</span></li>
          <li><a href="#">Tips & Tricks</a></li>
        </ul>
        <p class="card-text mt-3">
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
          eaque ipsa quae ab illo inventore
        </p>
        <div class="post-author d-flex align-items-center justify-content-between mt-3">
          <div>
          <img src="images/testi-img7.jpg" alt="" />
          <span>By</span>
          <a href="#">David Wise</a>
          </div>
          <a href="{{ Route('blog-single') }}">Read more</a>
        </div>
        </div>
        <!-- end card-body -->
      </div>
      <!-- end card -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4">
      <div class="card hover-y">
        <a href="{{ Route('blog-single') }}" class="card-image">
        <img src="images/img-loading.jpg" data-src="images/img2.jpg" alt="blog image" class="card-img-top lazy" />
        </a>
        <div class="card-body">
        <h4 class="card-title">
          <a href="{{ Route('blog-single') }}">Top 10 Best Clothing Shops In Sydney</a>
        </h4>
        <ul class="card-meta d-flex flex-wrap align-items-center">
          <li>25 Dec, 2018</li>
          <li><span class="mx-1">-</span></li>
          <li><a href="#">Tips & Tricks</a></li>
        </ul>
        <p class="card-text mt-3">
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
          eaque ipsa quae ab illo inventore
        </p>
        <div class="post-author d-flex align-items-center justify-content-between mt-3">
          <div>
          <img src="images/testi-img7.jpg" alt="" />
          <span>By</span>
          <a href="#">David Wise</a>
          </div>
          <a href="{{ Route('blog-single') }}">Read more</a>
        </div>
        </div>
        <!-- end card-body -->
      </div>
      <!-- end card -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4">
      <div class="card hover-y">
        <a href="{{ Route('blog-single') }}" class="card-image">
        <img src="images/img-loading.jpg" data-src="images/img3.jpg" alt="blog image" class="card-img-top lazy" />
        </a>
        <div class="card-body">
        <h4 class="card-title">
          <a href="{{ Route('blog-single') }}">Top 15 Greatest Hotels In United States</a>
        </h4>
        <ul class="card-meta d-flex flex-wrap align-items-center">
          <li>25 Dec, 2018</li>
          <li><span class="mx-1">-</span></li>
          <li><a href="#">Tips & Tricks</a></li>
        </ul>
        <p class="card-text mt-3">
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
          eaque ipsa quae ab illo inventore
        </p>
        <div class="post-author d-flex align-items-center justify-content-between mt-3">
          <div>
          <img src="images/testi-img7.jpg" alt="" />
          <span>By</span>
          <a href="#">David Wise</a>
          </div>
          <a href="{{ Route('blog-single') }}">Read more</a>
        </div>
        </div>
        <!-- end card-body -->
      </div>
      <!-- end card -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4">
      <div class="card hover-y">
        <a href="{{ Route('blog-single') }}" class="card-image">
        <img src="images/img-loading.jpg" data-src="images/img1.jpg" alt="blog image" class="card-img-top lazy" />
        </a>
        <div class="card-body">
        <h4 class="card-title">
          <a href="{{ Route('blog-single') }}">50 Greatest Event Places in United Kingdom</a>
        </h4>
        <ul class="card-meta d-flex flex-wrap align-items-center">
          <li>25 Dec, 2018</li>
          <li><span class="mx-1">-</span></li>
          <li><a href="#">Tips & Tricks</a></li>
        </ul>
        <p class="card-text mt-3">
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
          eaque ipsa quae ab illo inventore
        </p>
        <div class="post-author d-flex align-items-center justify-content-between mt-3">
          <div>
          <img src="images/testi-img7.jpg" alt="" />
          <span>By</span>
          <a href="#">David Wise</a>
          </div>
          <a href="{{ Route('blog-single') }}">Read more</a>
        </div>
        </div>
        <!-- end card-body -->
      </div>
      <!-- end card -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4">
      <div class="card hover-y">
        <a href="{{ Route('blog-single') }}" class="card-image">
        <img src="images/img-loading.jpg" data-src="images/img2.jpg" alt="blog image" class="card-img-top lazy" />
        </a>
        <div class="card-body">
        <h4 class="card-title">
          <a href="{{ Route('blog-single') }}">Top 10 Best Clothing Shops In Sydney</a>
        </h4>
        <ul class="card-meta d-flex flex-wrap align-items-center">
          <li>25 Dec, 2018</li>
          <li><span class="mx-1">-</span></li>
          <li><a href="#">Tips & Tricks</a></li>
        </ul>
        <p class="card-text mt-3">
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
          eaque ipsa quae ab illo inventore
        </p>
        <div class="post-author d-flex align-items-center justify-content-between mt-3">
          <div>
          <img src="images/testi-img7.jpg" alt="" />
          <span>By</span>
          <a href="#">David Wise</a>
          </div>
          <a href="{{ Route('blog-single') }}">Read more</a>
        </div>
        </div>
        <!-- end card-body -->
      </div>
      <!-- end card -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4">
      <div class="card hover-y">
        <a href="{{ Route('blog-single') }}" class="card-image">
        <img src="images/img-loading.jpg" data-src="images/img3.jpg" alt="blog image" class="card-img-top lazy" />
        </a>
        <div class="card-body">
        <h4 class="card-title">
          <a href="{{ Route('blog-single') }}">Top 15 Greatest Hotels In United States</a>
        </h4>
        <ul class="card-meta d-flex flex-wrap align-items-center">
          <li>25 Dec, 2018</li>
          <li><span class="mx-1">-</span></li>
          <li><a href="#">Tips & Tricks</a></li>
        </ul>
        <p class="card-text mt-3">
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
          eaque ipsa quae ab illo inventore
        </p>
        <div class="post-author d-flex align-items-center justify-content-between mt-3">
          <div>
          <img src="images/testi-img7.jpg" alt="" />
          <span>By</span>
          <a href="#">David Wise</a>
          </div>
          <a href="{{ Route('blog-single') }}">Read more</a>
        </div>
        </div>
        <!-- end card-body -->
      </div>
      <!-- end card -->
      </div>
      <!-- end col-lg-4 -->
    </div>
    <!-- end row -->
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center pagination-list">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true" class="fal fa-angle-left"></span>
        <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item active">
        <a class="page-link" href="#">1</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true" class="fal fa-angle-right"></span>
        <span class="sr-only">Next</span>
        </a>
      </li>
      </ul>
    </nav>
    </div>
    <!-- end container -->
  </section>
  <!-- end blog-area -->
  <!-- ================================
       START BLOG AREA
  ================================= -->

@endsection