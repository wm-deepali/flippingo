@extends('layouts.new-master')

@section('title')
  {{ $page->meta_title ?? 'How It Works' }}
@endsection

<style>
    .icon-element{
        padding-top:15px;
    }
</style>
@section('content')
     <section class="breadcrumb-area bread-bg">
      <div class="overlay"></div>
      <!-- end overlay -->
      <div class="container">
        <div class="breadcrumb-content text-center">
          <h2 class="sec__title text-white mb-3">How It Works</h2>
          <ul class="bread-list">
            <li><a href="index.html">home</a></li>
            
            <li>How It Works</li>
          </ul>
        </div>
        <!-- end breadcrumb-content -->
      </div>
      <!-- end container -->
      <div class="bread-svg">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
          <path
            d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"
          ></path>
        </svg>
      </div>
      <!-- end bread-svg -->
    </section>
    <!-- end breadcrumb-area -->
    <!-- ================================
    END BREADCRUMB AREA
================================= -->

     

       <section class="hiw-area bg-gray section--padding">
      <div class="container">
        <div class="text-center">
          <h2 class="sec__title mb-3">Get Started With Dirto!</h2>
          <p class="sec__desc">
            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
            libero, <br />
            a feugiat eros. Nunc ut lacinia tortors.
          </p>
        </div>
        <!-- end section-heading -->
        <div class="row mt-5">
          <div class="col-lg-3 col-md-6">
            <div class="card hover-y text-center card-hover-effect">
              <div class="card-body">
                <div class="icon-element icon-element-lg">
                  <span class="fal fa-pencil"></span>
                  <span class="info-number">1</span>
                </div>
                <!-- end icon-element-->
                <h4 class="card-title mt-4 mb-3">Pick a Keyword</h4>
                <p class="card-text">
                  Proin dapibus nisl ornare diam varius ecos tempus. Aenean a
                  quam
                </p>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="card hover-y text-center card-hover-effect">
              <div class="card-body">
                <div class="icon-element icon-element-lg">
                  <span class="fal fa-map-marker-alt"></span>
                  <span class="info-number">2</span>
                </div>
                <!-- end icon-element-->
                <h4 class="card-title mt-4 mb-3">Select Location</h4>
                <p class="card-text">
                  Proin dapibus nisl ornare diam varius ecos tempus. Aenean a
                  quam
                </p>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="card hover-y text-center card-hover-effect">
              <div class="card-body">
                <div class="icon-element icon-element-lg">
                  <span class="fal fa-sort"></span>
                  <span class="info-number">3</span>
                </div>
                <!-- end icon-element-->
                <h4 class="card-title mt-4 mb-3">Select Category</h4>
                <p class="card-text">
                  Proin dapibus nisl ornare diam varius ecos tempus. Aenean a
                  quam
                </p>
              </div>
            </div>
            
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="card hover-y text-center card-hover-effect">
              <div class="card-body">
                <div class="icon-element icon-element-lg">
                  <span class="fal fa-check"></span>
                  <span class="info-number">4</span>
                </div>
                <!-- end icon-element-->
                <h4 class="card-title mt-4 mb-3">View Results</h4>
                <p class="card-text">
                  Proin dapibus nisl ornare diam varius ecos tempus. Aenean a
                  quam
                </p>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-3 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>

    <hr class="border-top-gray my-0" />

    <!-- ================================
    START CAT AREA
================================= -->
    <section class="cat-area section--padding">
      <div class="container">
        <div class="text-center">
          <h2 class="sec__title mb-3">Explore Your Dream Places</h2>
          <p class="sec__desc">Explore most popular destination and places</p>
        </div>
        <!-- end section-heading -->
        <div class="row mt-5">
          <div class="col-lg-4 col-md-6">
            <a
              href="#"
              class="category-item d-block text-start overflow-hidden"
            >
              <div class="overlay"></div>
              <img
                src="{{ asset('site_assets') }}/img/img-loading.jpg"
                data-src="{{ asset('site_assets') }}/img/img1.jpg"
                alt="category-image"
                class="category-img lazy"
              />
              <div class="category-content">
                <div class="category-content-inner">
                  <h4 class="cat-title mb-2">Canada</h4>
                  <ul class="cat-list pb-3">
                    <li><span>5</span> Cities</li>
                    <li><span>250</span> Listing</li>
                  </ul>
                  <span class="badge badge-2 badge-pill">Explore</span>
                </div>
              </div>
              <!-- end category-content --> </a
            ><!-- end category-item -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-4 col-md-6">
            <a
              href="#"
              class="category-item d-block text-start overflow-hidden"
            >
              <div class="overlay"></div>
              <img
                src="{{ asset('site_assets') }}/img/img-loading.jpg"
                data-src="{{ asset('site_assets') }}/img/img2.jpg"
                alt="category-image"
                class="category-img lazy"
              />
              <div class="category-content">
                <div class="category-content-inner">
                  <h4 class="cat-title mb-2">United States</h4>
                  <ul class="cat-list pb-3">
                    <li><span>5</span> Cities</li>
                    <li><span>250</span> Listing</li>
                  </ul>
                  <span class="badge badge-2 badge-pill">Explore</span>
                </div>
              </div>
              <!-- end category-content --> </a
            ><!-- end category-item -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-4 col-md-6">
            <a
              href="#"
              class="category-item d-block text-start overflow-hidden"
            >
              <div class="overlay"></div>
              <img
                src="{{ asset('site_assets') }}/img/img-loading.jpg"
                data-src="{{ asset('site_assets') }}/img/img3.jpg"
                alt="category-image"
                class="category-img lazy"
              />
              <div class="category-content">
                <div class="category-content-inner">
                  <h4 class="cat-title mb-2">United Kingdom</h4>
                  <ul class="cat-list pb-3">
                    <li><span>5</span> Cities</li>
                    <li><span>250</span> Listing</li>
                  </ul>
                  <span class="badge badge-2 badge-pill">Explore</span>
                </div>
              </div>
              <!-- end category-content --> </a
            ><!-- end category-item -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-3 col-md-6">
            <a
              href="#"
              class="category-item d-block text-start overflow-hidden"
            >
              <div class="overlay"></div>
              <img
                src="{{ asset('site_assets') }}/img/img-loading.jpg"
                data-src="{{ asset('site_assets') }}/img/img4.jpg"
                alt="category-image"
                class="category-img lazy"
              />
              <div class="category-content">
                <div class="category-content-inner">
                  <h4 class="cat-title mb-2">Mexico</h4>
                  <ul class="cat-list pb-3">
                    <li><span>5</span> Cities</li>
                    <li><span>250</span> Listing</li>
                  </ul>
                  <span class="badge badge-2 badge-pill">Explore</span>
                </div>
              </div>
              <!-- end category-content --> </a
            ><!-- end category-item -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <a
              href="#"
              class="category-item d-block text-start overflow-hidden"
            >
              <div class="overlay"></div>
              <img
                src="{{ asset('site_assets') }}/img/img-loading.jpg"
                data-src="{{ asset('site_assets') }}/img/img5.jpg"
                alt="category-image"
                class="category-img lazy"
              />
              <div class="category-content">
                <div class="category-content-inner">
                  <h4 class="cat-title mb-2">Costa Rica</h4>
                  <ul class="cat-list pb-3">
                    <li><span>5</span> Cities</li>
                    <li><span>250</span> Listing</li>
                  </ul>
                  <span class="badge badge-2 badge-pill">Explore</span>
                </div>
              </div>
              <!-- end category-content --> </a
            ><!-- end category-item -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <a
              href="#"
              class="category-item d-block text-start overflow-hidden"
            >
              <div class="overlay"></div>
              <img
                src="{{ asset('site_assets') }}/img/img-loading.jpg"
                data-src="{{ asset('site_assets') }}/img/img6.jpg"
                alt="category-image"
                class="category-img lazy"
              />
              <div class="category-content">
                <div class="category-content-inner">
                  <h4 class="cat-title mb-2">Australia</h4>
                  <ul class="cat-list pb-3">
                    <li><span>5</span> Cities</li>
                    <li><span>250</span> Listing</li>
                  </ul>
                  <span class="badge badge-2 badge-pill">Explore</span>
                </div>
              </div>
              <!-- end category-content --> </a
            ><!-- end category-item -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <a
              href="#"
              class="category-item d-block text-start overflow-hidden"
            >
              <div class="overlay"></div>
              <img
                src="{{ asset('site_assets') }}/img/img-loading.jpg"
                data-src="{{ asset('site_assets') }}/img/img7.jpg"
                alt="category-image"
                class="category-img lazy"
              />
              <div class="category-content">
                <div class="category-content-inner">
                  <h4 class="cat-title mb-2">New Zealand</h4>
                  <ul class="cat-list pb-3">
                    <li><span>5</span> Cities</li>
                    <li><span>250</span> Listing</li>
                  </ul>
                  <span class="badge badge-2 badge-pill">Explore</span>
                </div>
              </div>
              <!-- end category-content --> </a
            ><!-- end category-item -->
          </div>
          <!-- end col-lg-3 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end cat-area -->
    <!-- ================================
    END CAT AREA
================================= -->

    <hr class="border-top-gray my-0" />

    <!-- ================================
    START HIW AREA
================================= -->
    <section class="hiw-area section--padding">
      <div class="container">
        <div class="text-center">
          <h2 class="sec__title mb-3">Why Choose Us</h2>
          <p class="sec__desc">
            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
            libero, <br />
            a feugiat eros. Nunc ut lacinia tortors.
          </p>
        </div>
        <div class="row mt-5">
          <div class="col-lg-6 col-md-6">
            <div class="card card-pattern">
              <div class="card-body media">
                <div class="icon-element flex-shrink-0 me-3">
                  <span class="fal fa-check"></span>
                </div>
                <!-- end icon-element-->
                <div class="media-body">
                  <h4 class="card-title mb-3">We Are Professional</h4>
                  <p class="card-text">
                    There are many variations of passages of Lorem Ipsum
                    available, but the majority have suffered alteration in some
                    form, by injected humour,
                  </p>
                </div>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-6 -->
          <div class="col-lg-6 col-md-6">
            <div class="card card-pattern">
              <div class="card-body media">
                <div class="icon-element flex-shrink-0 me-3">
                  <span class="fal fa-check"></span>
                </div>
                <!-- end icon-element-->
                <div class="media-body">
                  <h4 class="card-title mb-3">Best Service Guarantee</h4>
                  <p class="card-text">
                    There are many variations of passages of Lorem Ipsum
                    available, but the majority have suffered alteration in some
                    form, by injected humour,
                  </p>
                </div>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-6 -->
          <div class="col-lg-6 col-md-6">
            <div class="card card-pattern">
              <div class="card-body media">
                <div class="icon-element flex-shrink-0 me-3">
                  <span class="fal fa-check"></span>
                </div>
                <!-- end icon-element-->
                <div class="media-body">
                  <h4 class="card-title mb-3">We Are Trusted and Secured</h4>
                  <p class="card-text">
                    There are many variations of passages of Lorem Ipsum
                    available, but the majority have suffered alteration in some
                    form, by injected humour,
                  </p>
                </div>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-6 -->
          <div class="col-lg-6 col-md-6">
            <div class="card card-pattern">
              <div class="card-body media">
                <div class="icon-element flex-shrink-0 me-3">
                  <span class="fal fa-check"></span>
                </div>
                <!-- end icon-element-->
                <div class="media-body">
                  <h4 class="card-title mb-3">Online Support 24/7</h4>
                  <p class="card-text">
                    There are many variations of passages of Lorem Ipsum
                    available, but the majority have suffered alteration in some
                    form, by injected humour,
                  </p>
                </div>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-6 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end hiw-area -->
    <!-- ================================
    END HIW AREA
================================= -->

    <!-- ================================
    START HIW AREA
================================= -->

    <!-- end hiw-area -->
    <!-- ================================
    END HIW AREA
================================= -->

    <!-- ================================
    START MOBILE AREA
================================= -->
    <section class="mobile-area section-padding">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 me-auto">
            <div class="mobile-img my-4">
              <img
                src="{{ asset('site_assets') }}/img/img-loading.jpg"
                data-src="{{ asset('site_assets') }}/img/undraw-Internet-on-the-go.svg"
                alt="mobile-img"
                class="lazy"
              />
            </div>
          </div>
          <!-- end col-lg-5 -->
          <div class="col-lg-6">
            <div class="mobile-app-content">
              <div class="section-heading">
                <h2 class="sec__title mb-3">
                  Heading out? <br />
                  Bring Dirto with you.
                </h2>
                <p class="sec__desc mb-4">
                  The free Dirto mobile app is the fastest and easiest way to
                  search for businesses near you. Download it now to get
                  started.
                </p>
              </div>
              <!-- end section-heading -->
              <ul class="info-list mobile-feature-list">
                <li class="d-flex align-items-center mb-3">
                  <span class="fal fa-star icon me-2"></span> Write & read
                  reviews
                </li>
                <li class="d-flex align-items-center mb-3">
                  <span class="fal fa-directions icon me-2"></span> Get
                  directions
                </li>
                <li class="d-flex align-items-center mb-3">
                  <span class="fal fa-paper-plane icon me-2"></span> Browse
                  nearby
                </li>
                <li class="d-flex align-items-center mb-3">
                  <span class="fal fa-utensils icon me-2"></span> View menu
                </li>
                <li class="d-flex align-items-center mb-3">
                  <span class="fal fa-camera icon me-2"></span> Add & view
                  photos
                </li>
                <li class="d-flex align-items-center mb-3">
                  <span class="fal fa-badge-check icon me-2"></span> Check-in
                </li>
              </ul>
              <div class="btn-box mt-4">
                <a href="#" class="theme-btn me-2 bg-dark"
                  ><i class="fab fa-apple me-2"></i> App Store</a
                >
                <a href="#" class="theme-btn bg-success"
                  ><i class="fab fa-android me-2"></i> Google Play</a
                >
              </div>
              <!-- end btn-box -->
            </div>
          </div>
          <!-- end col-lg-6 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end mobile-area -->
    <!-- ================================
    END MOBILE AREA
================================= -->

    <hr class="border-top-gray my-0" />

    <!-- ================================
       START TESTIMONIAL AREA
================================= -->
    <section
      class="testimonial-area section-padding position-relative overflow-hidden"
    >
      <img
        src="{{ asset('site_assets') }}/img/testi-img1.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="{{ asset('site_assets') }}/img/testi-img2.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="{{ asset('site_assets') }}/img/testi-img3.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="{{ asset('site_assets') }}/img/testi-img4.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="{{ asset('site_assets') }}/img/testi-img5.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="{{ asset('site_assets') }}/img/testi-img6.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <div class="container">
        <div class="text-center">
          <h2 class="sec__title mb-3">What Our Users Said</h2>
          <p class="sec__desc">
            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
            libero,<br />
            a feugiat eros. Nunc ut lacinia tortors.
          </p>
        </div>
        <div class="col-lg-8 mx-auto mt-4">
          <div class="testimonial-carousel owl-carousel owl-theme">
            <div class="testimonial-item py-4">
              <div class="testi-comment d-flex">
                <span class="fas fa-quote-left me-4 font-size-30"></span>
                <p class="testi__desc">
                  Excepteur sint occaecat cupidatat non proident sunt in culpa
                  officia deserunt mollit anim laborum sint occaecat cupidatat
                  non proident. Occaecat cupidatat non proident des culpa
                  officia deserunt mollit.
                </p>
              </div>
              <div class="testi-content text-center">
                <img
                  src="{{ asset('site_assets') }}/img/team8.jpg"
                  class="testi__img"
                  alt="testimonial image"
                />
                <h4 class="tesi__title">Richard Doe</h4>
                <span class="testi__meta">united states</span>
              </div>
            </div>
            <!-- end testimonial-item -->
            <div class="testimonial-item py-4">
              <div class="testi-comment d-flex">
                <span class="fas fa-quote-left me-4 font-size-30"></span>
                <p class="testi__desc">
                  Excepteur sint occaecat cupidatat non proident sunt in culpa
                  officia deserunt mollit anim laborum sint occaecat cupidatat
                  non proident. Occaecat cupidatat non proident des culpa
                  officia deserunt mollit.
                </p>
              </div>
              <div class="testi-content text-center">
                <img
                  src="{{ asset('site_assets') }}/img/team9.jpg"
                  class="testi__img"
                  alt="testimonial image"
                />
                <h4 class="tesi__title">Alex Smith</h4>
                <span class="testi__meta">united states</span>
              </div>
            </div>
            <!-- end testimonial-item -->
          </div>
          <!-- end testimonial-carousel -->
        </div>
        <!-- end col-lg-8 -->
      </div>
      <!-- end container -->
    </section>
    <!-- end testimonial-area -->
    <!-- ================================
       START TESTIMONIAL AREA
================================= -->

    <hr class="border-top-gray my-0" />

    <!-- ================================
       START BLOG AREA
================================= -->
    <section class="blog-area section-padding">
      <div class="container">
        <div class="text-center">
          <h2 class="sec__title mb-3">Latest Tips & Articles</h2>
          <p class="sec__desc">
            Morbi convallis bibendum urna ut viverra. Maecenas quis
            consequat,<br />
            a feugiat eros. Nunc ut lacinia tortors.
          </p>
        </div>
        <div class="row mt-5">
          <div class="col-lg-4 col-md-6">
            <div class="card hover-y">
              <a href="blog-single.html" class="card-image">
                <img
                  src="{{ asset('site_assets') }}/img/img-loading.jpg"
                  data-src="{{ asset('site_assets') }}/img/img1.jpg"
                  alt="blog image"
                  class="card-img-top lazy"
                />
              </a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="blog-single.html"
                    >50 Greatest Event Places in United Kingdom</a
                  >
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
                <div
                  class="post-author d-flex align-items-center justify-content-between mt-3"
                >
                  <div>
                    <img src="{{ asset('site_assets') }}/img/testi-img7.jpg" alt="" />
                    <span>By</span>
                    <a href="#">David Wise</a>
                  </div>
                  <a href="blog-single.html">Read more</a>
                </div>
              </div>
              <!-- end card-body -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-4 col-md-6">
            <div class="card hover-y">
              <a href="blog-single.html" class="card-image">
                <img
                  src="{{ asset('site_assets') }}/img/img-loading.jpg"
                  data-src="{{ asset('site_assets') }}/img/img2.jpg"
                  alt="blog image"
                  class="card-img-top lazy"
                />
              </a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="blog-single.html"
                    >Top 10 Best Clothing Shops In Sydney</a
                  >
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
                <div
                  class="post-author d-flex align-items-center justify-content-between mt-3"
                >
                  <div>
                    <img src="{{ asset('site_assets') }}/img/testi-img7.jpg" alt="" />
                    <span>By</span>
                    <a href="#">David Wise</a>
                  </div>
                  <a href="blog-single.html">Read more</a>
                </div>
              </div>
              <!-- end card-body -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-4 col-md-6">
            <div class="card hover-y">
              <a href="blog-single.html" class="card-image">
                <img
                  src="{{ asset('site_assets') }}/img/img-loading.jpg"
                  data-src="{{ asset('site_assets') }}/img/img3.jpg"
                  alt="blog image"
                  class="card-img-top lazy"
                />
              </a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="blog-single.html"
                    >Top 15 Greatest Hotels In United States</a
                  >
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
                <div
                  class="post-author d-flex align-items-center justify-content-between mt-3"
                >
                  <div>
                    <img src="{{ asset('site_assets') }}/img/testi-img7.jpg" alt="" />
                    <span>By</span>
                    <a href="#">David Wise</a>
                  </div>
                  <a href="blog-single.html">Read more</a>
                </div>
              </div>
              <!-- end card-body -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-4 -->
        </div>
        <!-- end row -->
        <div class="text-center">
          <a href="blog-grid.html" class="theme-btn">View all post</a>
        </div>
      </div>
      <!-- end container -->
    </section>
    <!-- end blog-area -->
    <!-- ================================
       START BLOG AREA
================================= -->

    <hr class="border-top-gray my-0" />

    <!-- ================================
       START CLIENTLOGO AREA
================================= -->
   
    <!-- end clientlogo-area -->
    <!-- ================================
       START CLIENTLOGO AREA
================================= -->

    <!-- ================================
    START CTA AREA
================================= -->
    <section class="cta-area bg-dark padding-top-60px padding-bottom-60px">
      <div class="container">
        <div
          class="d-flex flex-wrap align-items-center justify-content-between"
        >
          <div class="section-heading py-3">
            <h2 class="mb-3 text-white font-size-28 font-weight-bold">
              Dirto is the best way to find & discover <br />
              great local businesses
            </h2>
            <p class="font-size-17 text-white">
              Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
              libero
            </p>
          </div>
          <!-- end section-heading -->
          <a href="sign-up.html" class="theme-btn">Create Account</a>
        </div>
        <!-- end d-flex -->
      </div>
      <!-- end container -->
    </section>
    <!-- end cta-area -->
    <!-- ================================
    END CTA AREA
================================= -->

@endsection

