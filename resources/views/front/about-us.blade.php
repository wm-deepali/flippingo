@extends('layouts.new-master')

@section('title')
  {{ $page->meta_title ?? 'About Us' }}
@endsection

@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area bread-bg-2">
      <div class="overlay"></div>
      <!-- end overlay -->
      <div class="container">
        <div
          class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between"
        >
          <h2 class="sec__title text-white my-2">
            Dirto Connects People <br />
            With Great Local <br />
            Businesses
          </h2>
          <div class="video-play-btn">
            <a
              class="icon-element icon-element-lg bg-white text-black"
              href="https://www.youtube.com/watch?v=DQMeTCtsLcU"
              data-fancybox="preview-video"
              title="Play Video"
            >
              Play
            </a>
          </div>
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

    <!-- ================================
       START BLOG AREA
================================= -->
    <section class="blog-area padding-top-60px padding-bottom-70px">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <a href="#" class="card hover-y">
              <div class="card-image">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/img1.jpg"
                  alt="blog image"
                  class="card-img-top lazy"
                />
              </div>
              <div class="card-body">
                <h4 class="card-title">Careers</h4>
                <p class="card-text mt-2 text-gray">
                  Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                  eaque ipsa quae ab illo
                </p>
              </div>
              <!-- end card-body --> </a
            ><!-- end card -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-4 col-md-6">
            <a href="#" class="card hover-y">
              <div class="card-image">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/img2.jpg"
                  alt="blog image"
                  class="card-img-top lazy"
                />
              </div>
              <div class="card-body">
                <h4 class="card-title">Newsroom</h4>
                <p class="card-text mt-2 text-gray">
                  Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                  eaque ipsa quae ab illo
                </p>
              </div>
              <!-- end card-body --> </a
            ><!-- end card -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-4 col-md-6">
            <a href="#" class="card hover-y">
              <div class="card-image">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/img3.jpg"
                  alt="blog image"
                  class="card-img-top lazy"
                />
              </div>
              <div class="card-body">
                <h4 class="card-title">Investor Relations</h4>
                <p class="card-text mt-2 text-gray">
                  Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                  eaque ipsa quae ab illo
                </p>
              </div>
              <!-- end card-body --> </a
            ><!-- end card -->
          </div>
          <!-- end col-lg-4 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end blog-area -->
    <!-- ================================
       START BLOG AREA
================================= -->

    <hr class="border-top-gray my-0" />

    <!-- ================================
    START ABOUT AREA
================================= -->
    <section class="about-area section-padding">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="section-heading mb-4 mb-lg-0">
              <h2 class="sec__title mb-3">
                Welcome to the Dirto Business Directory Service and a Public
                Company
              </h2>
              <p class="sec__desc mb-4">
                Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla.
                Nulla eget iaculis lectus. Mauris ac maximus neque. Nam in
                mauris quis libero sodales eleifend.
              </p>
              <p class="sec__desc">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.
              </p>
            </div>
            <!-- end section-heading -->
          </div>
          <!-- end col-lg-6 -->
          <div class="col-lg-6">
            <div class="image-box row">
              <div class="col-lg-6 mt-lg-4">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/img4.jpg"
                  alt="about image"
                  class="w-100 rounded-12 mb-4 lazy"
                />
                <img
                  src="images/img-loading.jpg"
                  data-src="images/img5.jpg"
                  alt="about image"
                  class="w-100 rounded-12 mb-4 lazy"
                />
              </div>
              <div class="col-lg-6">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/img6.jpg"
                  alt="about image"
                  class="w-100 rounded-12 mb-4 lazy"
                />
                <img
                  src="images/img-loading.jpg"
                  data-src="images/img7.jpg"
                  alt="about image"
                  class="w-100 rounded-12 mb-4 lazy"
                />
              </div>
            </div>
            <!-- end image-box -->
          </div>
          <!-- end col-lg-6 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end about-area -->
    <!-- ================================
    END ABOUT AREA
================================= -->

    <!-- ================================
    START FUN-FACT AREA
================================= -->
    <section
      class="funfact-area bg-dark section--padding text-center funfact-pattern"
    >
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="counter-item">
              <div class="counter-number fun-bg1">
                <span class="counter">1150</span>
                <span class="count-symbol">+</span>
              </div>
              <!-- end counter-number -->
              <div class="counter-content mt-4">
                <p class="counter__title">Projects Completed</p>
              </div>
              <!-- end counter-content -->
            </div>
            <!-- end counter-item -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="counter-item">
              <div class="counter-number fun-bg2">
                <span class="counter">3040</span>
                <span class="count-symbol">+</span>
              </div>
              <!-- end counter-number -->
              <div class="counter-content mt-4">
                <p class="counter__title">Happy Clients</p>
              </div>
              <!-- end counter-content -->
            </div>
            <!-- end counter-item -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="counter-item">
              <div class="counter-number fun-bg3">
                <span class="counter">2020</span>
                <span class="count-symbol">+</span>
              </div>
              <!-- end counter-number -->
              <div class="counter-content mt-4">
                <p class="counter__title">Cup of Coffee</p>
              </div>
              <!-- end counter-content -->
            </div>
            <!-- end counter-item -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="counter-item">
              <div class="counter-number fun-bg4">
                <span class="counter">350</span>
                <span class="count-symbol">+</span>
              </div>
              <!-- end counter-number -->
              <div class="counter-content mt-4">
                <p class="counter__title">Awards Winning</p>
              </div>
              <!-- end counter-content -->
            </div>
            <!-- end counter-item -->
          </div>
          <!-- end col-lg-3 -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end funfact-area -->
    <!-- ================================
    END FUN-FACT AREA
================================= -->

    <!-- ================================
       START TESTIMONIAL AREA
================================= -->
    <section
      class="testimonial-area section-padding position-relative overflow-hidden"
    >
      <img
        src="images/testi-img1.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="images/testi-img2.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="images/testi-img3.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="images/testi-img4.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="images/testi-img5.jpg"
        alt="testtmonial-image"
        class="random-img"
      />
      <img
        src="images/testi-img6.jpg"
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
                  src="images/team8.jpg"
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
                  src="images/team9.jpg"
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

    <!-- ================================
    START HIW AREA
================================= -->
    <section class="hiw-area bg-gray section--padding">
      <div class="container">
        <div class="text-center">
          <h2 class="sec__title mb-3">Why Choose Us</h2>
          <p class="sec__desc">
            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
            libero, <br />
            a feugiat eros. Nunc ut lacinia tortors.
          </p>
        </div>
        <!-- end section-heading -->
        <div class="row mt-5">
          <div class="col-lg-4 col-md-6">
            <div class="card hover-y text-center card-pattern">
              <div class="card-body">
                <div class="icon-element icon-element-lg">
                  <span class="fal fa-headphones"></span>
                </div>
                <!-- end icon-element-->
                <h4 class="card-title mt-4 mb-3">24/7 Hours Support</h4>
                <p class="card-text">
                  Proin dapibus nisl ornare diam varius ecos tempus. Aenean a
                  quam luctus, finibus tellus ut, convallis eros.
                </p>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-4 col-md-6">
            <div class="card hover-y text-center card-pattern">
              <div class="card-body">
                <div class="icon-element icon-element-lg">
                  <span class="fal fa-cogs"></span>
                </div>
                <!-- end icon-element-->
                <h4 class="card-title mt-4 mb-3">Admin Panel</h4>
                <p class="card-text">
                  Proin dapibus nisl ornare diam varius ecos tempus. Aenean a
                  quam luctus, finibus tellus ut, convallis eros.
                </p>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-4 -->
          <div class="col-lg-4 col-md-6">
            <div class="card hover-y text-center card-pattern">
              <div class="card-body">
                <div class="icon-element icon-element-lg">
                  <span class="fal fa-users"></span>
                </div>
                <!-- end icon-element-->
                <h4 class="card-title mt-4 mb-3">Mobile friendly</h4>
                <p class="card-text">
                  Proin dapibus nisl ornare diam varius ecos tempus. Aenean a
                  quam luctus, finibus tellus ut, convallis eros.
                </p>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-4 -->
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
    START TEAM AREA
================================= -->
    <section class="team-area section--padding">
      <div class="container">
        <div class="text-center">
          <h2 class="sec__title mb-3">Our Expert Team Members</h2>
          <p class="sec__desc">
            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
            libero, <br />
            a feugiat eros. Nunc ut lacinia tortors.
          </p>
        </div>
        <!-- end section-heading -->
        <div class="row mt-5">
          <div class="col-lg-3 col-md-6">
            <div class="card hover-y text-center">
              <div class="card-image">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/team1.jpg"
                  alt="team image"
                  class="card-img-top lazy"
                />
                <svg
                  class="card-svg-shape"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  x="0px"
                  y="0px"
                  viewBox="0 0 74 7"
                  xml:space="preserve"
                >
                  <path
                    d="M57.7,5c-6.2-1.6-13.5-5-20.8-5c-7.2,0-14.4,3.3-20.5,4.8C11.2,6.1,5.3,6.7,0,7v0h72.4 C67.4,6.7,62.2,6.1,57.7,5z"
                  ></path>
                </svg>
              </div>
              <div class="card-body">
                <h4 class="card-title mb-1">Austin Evone</h4>
                <p class="card-text mb-3">Business Consultant</p>
                <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="card hover-y text-center">
              <div class="card-image">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/team2.jpg"
                  alt="team image"
                  class="card-img-top lazy"
                />
                <svg
                  class="card-svg-shape"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  x="0px"
                  y="0px"
                  viewBox="0 0 74 7"
                  xml:space="preserve"
                >
                  <path
                    d="M57.7,5c-6.2-1.6-13.5-5-20.8-5c-7.2,0-14.4,3.3-20.5,4.8C11.2,6.1,5.3,6.7,0,7v0h72.4 C67.4,6.7,62.2,6.1,57.7,5z"
                  ></path>
                </svg>
              </div>
              <div class="card-body">
                <h4 class="card-title mb-1">Nikolas Doe</h4>
                <p class="card-text mb-3">Photographer</p>
                <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="card hover-y text-center">
              <div class="card-image">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/team3.jpg"
                  alt="team image"
                  class="card-img-top lazy"
                />
                <svg
                  class="card-svg-shape"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  x="0px"
                  y="0px"
                  viewBox="0 0 74 7"
                  xml:space="preserve"
                >
                  <path
                    d="M57.7,5c-6.2-1.6-13.5-5-20.8-5c-7.2,0-14.4,3.3-20.5,4.8C11.2,6.1,5.3,6.7,0,7v0h72.4 C67.4,6.7,62.2,6.1,57.7,5z"
                  ></path>
                </svg>
              </div>
              <div class="card-body">
                <h4 class="card-title mb-1">Marlin Builders</h4>
                <p class="card-text mb-3">Co-manager associated</p>
                <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col-lg-3 -->
          <div class="col-lg-3 col-md-6">
            <div class="card hover-y text-center">
              <div class="card-image">
                <img
                  src="images/img-loading.jpg"
                  data-src="images/team4.jpg"
                  alt="team image"
                  class="card-img-top lazy"
                />
                <svg
                  class="card-svg-shape"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  x="0px"
                  y="0px"
                  viewBox="0 0 74 7"
                  xml:space="preserve"
                >
                  <path
                    d="M57.7,5c-6.2-1.6-13.5-5-20.8-5c-7.2,0-14.4,3.3-20.5,4.8C11.2,6.1,5.3,6.7,0,7v0h72.4 C67.4,6.7,62.2,6.1,57.7,5z"
                  ></path>
                </svg>
              </div>
              <div class="card-body">
                <h4 class="card-title mb-1">Kamran Ahmed</h4>
                <p class="card-text mb-3">Director</p>
                <div class="social-icons">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
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
    <!-- end team-area -->
    <!-- ================================
    END TEAM AREA
================================= -->

    <!-- ================================
    START SUBSCRIBER AREA
================================= -->
    <section class="cta-area padding-bottom-100px text-center">
      <div class="container">
        <h2 class="sec__title mb-2">Want to Join with us?</h2>
        <p class="sec__desc mb-4">
          Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
          libero <br />
          a feugiat eros. Nunc ut lacinia tortors.
        </p>
        <a href="#" class="theme-btn">Join Now</a>
      </div>
      <!-- end container -->
    </section>
    <!-- end cta-area -->
    <!-- ================================
    END SUBSCRIBER AREA
================================= -->

@endsection

