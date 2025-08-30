<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="author" content=" Flippingo" />
  <meta name="description" content="Flippingo Admin">
  <meta name="keywords" content="Flippingo Admin">
  @stack('before-styles')
  <title>@yield('title')</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets') }}/images/favicon.png" />


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800&amp;display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700&amp;display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Template CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/select2.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/owl.carousel.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/owl.theme.default.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/animated-headline.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery.fancybox.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <!-- Optional: Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

</head>


<body>
  <!-- start per-loader -->
  <div class="loader-container">
    <div class="loader-ripple">
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- end per-loader -->

  <!-- ================================
            START HEADER AREA
================================= -->

  <header class="header-area border-bottom border-bottom-gray">
    <!-- <div class="top-header" style="background-color: rgb(3, 157, 247);">
      <div class="top-header-list">
        <div class="d-flex align-items-center gap-4">
        <div class="">
          <p ><i class="fa-solid fa-envelope"></i>  demo@gmail.com</p>
        </div>
        <div class="line"></div>
        <div class="">
          <p><i class="fa-solid fa-phone"></i>  +91 0000000000</p>
        </div>
        <div class="line"></div>
        <div class="">
          <p><i class="fa-brands fa-facebook" style="color: #3b5998;"></i> &nbsp; <i class="fa-brands fa-whatsapp" style="color: #075e54;"></i> &nbsp; <i class="fa-brands fa-instagram" style="color: #c13584;"></i> &nbsp; <i class="fa-brands fa-x-twitter" style="color: #14171A ;"></i></p>
        </div>
        </div>
        <div class="d-flex align-items-center gap-4">
          <div class="">
          <p> FAQ</p>
        </div>
       
        <div class="line"></div>
        <div class="">
          <p style="border: 1px solid #fff; border-radius: 5px; padding: 5px 10px; cursor: pointer;"> Get a Call Back</p>
        </div>
       
         <div class="line"></div>
        
        <div class="">
          <p> Pricing</p>
        </div></div>
        


      </div>

    </div> -->
    <div class="main-header py-3">
      <div class="container" style="max-width: 1260px;">
        <div class="main-header-action-wrap d-flex justify-content-between">
          <div class="logo">
            <a href="{{ Route('home') }}"><img src="{{ asset('assets') }}/images/logo.png" alt="logo" width="180px" /></a>
          </div>

          <div class="d-flex" style="width: 40%; align-items: center;margin-top: 15px;">
            <div class="col-lg-12 pe-lg-0">
              <div class="form-group">
                <span class="fal fa-search form-icon"></span>
                <input class="form-control form--control" type="text" placeholder="What are you looking for?"
                  style="width: 105%;" />
              </div>
            </div>
            <!-- end col-lg-3 -->


            <!-- end col-lg-3 -->

          </div>
          <!-- end col-lg-3 -->

          <!-- end card-body -->

          <!-- end logo -->
          <!-- <nav class="main-menu me-4 ms-auto">
            <ul>
              <li>
                <a href="#">Home </a>
               
              </li>
              <li>
                <a href="#">Services </a>
                
              </li>
              <li>
                <a href="list-left-sidebar.html">Listings </a>
              
              </li>
             
              <li>
                <a href="pricing.html">Pricing </a>
              </li>


              <li>
                <a href="list-left-sidebar.html">Resources </a>
              </li>
              <li>
                <a href="contact.html">Contact Us </a>
              </li>
              <li>
                <a href="#">Pages <span class="fal fa-angle-down"></span></a>
                <ul class="dropdown-menu-item">
                  <li><a href="user-profile.html">user profile</a></li>
                  <li><a href="top-author.html">top authors </a></li>
                  <li><a href="dashboard.html">dashboard</a></li>
                  <li><a href="booking.html">booking </a></li>
                  <li>
                    <a href="booking-confirmation.html">booking confirmation
                    </a>
                  </li>
                  <li><a href="invoice.html">invoice</a></li>
                  <li><a href="pricing.html">pricing</a></li>
                  <li><a href="about.html">about</a></li>
                  <li><a href="faq.html">faq</a></li>
                  <li><a href="contact.html">contact</a></li>
                  <li><a href="page-404.html">404 page</a></li>
                  <li><a href="recover.html">recover pass</a></li>
                </ul>
              </li>
              <li>
                <a href="#">Blog <span class="fal fa-angle-down"></span></a>
                <ul class="dropdown-menu-item">
                  <li><a href="blog-full-width.html">full width</a></li>
                  <li><a href="blog-grid.html">blog grid</a></li>
                  <li><a href="blog-left-sidebar.html">left sidebar </a></li>
                  <li>
                    <a href="blog-right-sidebar.html">right sidebar </a>
                  </li>
                  <li><a href="blog-single.html">blog detail</a></li>
                </ul>
              </li>
            </ul>
          </nav>  -->
          <div class="nav-right-content d-flex align-items-center">
            <div class="author-access-list me-3">
              <a href="{{ Route('authentication-signin')}}">Login</a>
              <span class="or-text">or</span>
              <a href="{{ Route('authentication-signup') }}">Sign Up</a>
            </div>
            <a href="{{ Route('add-listing') }}" class="theme-btn" style="padding: 10px 20px;">
              <!-- <span class="fal fa-plus me-1"></span> -->
              Sell Now
            </a>
            <div class="side-menu-open ms-2">
              <i class="fal fa-bars"></i>
            </div>
            <!-- end side-menu-open -->
          </div>
          <!-- end nav-right-content -->
        </div>
        <!-- end main-header-action-wrap -->
      </div>
      <!-- end container-fluid -->
    </div>
    <div class="top-header">
      <div class="top-header-list">
        <nav class="main-menu " style="width: 100%;">
          <ul class="d-flex justify-content-between">
            <li>
              <a href="{{ Route('listing-list') }}">Browse <span class="fal fa-angle-down"></span></a>
              <ul class="dropdown-menu-item">
                <li><a href="{{ Route('listing-list') }}">Website</a></li>
                <li><a href="{{ Route('listing-list') }}">YouTube Channel</a></li>
                <li><a href="{{ Route('listing-list') }}">Instagram Pages </a></li>
                <li>
                  <a href="{{ Route('listing-list') }}">Telegram Account</a>
                </li>
                <li><a href="{{ Route('listing-list') }}">Facebook Account</a></li>
              </ul>
            </li>
            <li>
              <a href="{{ Route('meet-our-team') }}">Meet Our Team </a>

            </li>
            <li>
              <a href="#">Insight </a>

            </li>
            <li>
              <a href="">Buyers Mandate </a>

            </li>

            <li>
              <a href="">Why Flippingo </a>
            </li>
            <li>
              <a href="{{ Route('blogs') }}">Blogs </a>
            </li>
            <li>
              <a href="">Sell Digitally </a>
            </li>

            <li>
              <a href="">Services </a>
            </li>
            <li>
              <a href="">Resources </a>
            </li>
            <li>
              <a href="{{ Route('contact-us') }}">Contact Us </a>
            </li>



          </ul>
        </nav>


      </div>

    </div>
    <!-- end main-header -->

    <!-- end off-canvas -->
  </header>

  <!-- ================================
         END HEADER AREA
================================= -->


  @yield('content')

  <!-- ================================
       START FOOTER AREA
================================= -->
  <section class="footer-area bg-gray padding-top-80px pattern-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="footer-item">
            <a href={{ Route('home') }} class="footer-logo mb-4 d-inline-block"><img src="{{ asset('assets') }}/images/logo.png" alt="logo"
                style="background-color: #000; border-radius: 7px; padding: 7px 10px;" /></a>
            <p class="mb-4">
              Flippingo is a platform for Posting Free Ads - it only takes a few simple steps! Select the right category
              and publish your classified ad for free.
            </p>
            <div class="social-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
          </div>
          <!-- end footer-item -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-item">
            <h4 class="footer__title mb-3">Quick Links</h4>
            <div class="stroke-shape mb-4"></div>
            <ul class="list-items list-items-underline">
              <li><a href={{ Route('about-us') }}>About us</a></li>
              <li><a href={{ Route('authentication-signup') }}>Sign up</a></li>
              <li><a href="{{ Route('authentication-signin') }}">Log in</a></li>
              <li><a href="#">Terms & Conditions</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <!-- <li><a href="#">Help Center</a></li> -->
            </ul>
          </div>
          <!-- end footer-item -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-item">
            <h4 class="footer__title mb-3">Categories</h4>
            <div class="stroke-shape mb-4"></div>
            <ul class="list-items list-items-underline">
              <li><a href="#">Website</a></li>
              <li><a href="#">YouTube Channel</a></li>
              <li><a href="#">Instagram Pages</a></li>
              <li><a href="#">Telegram Account</a></li>
              <li><a href="#">Facebook Account</a></li>

            </ul>
          </div>
          <!-- end footer-item -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-item">
            <h4 class="footer__title mb-3">Contact with Us</h4>
            <div class="stroke-shape mb-4"></div>
            <ul class="info-list">
              <li>
                <span class="fal fa-home icon me-2"></span> Old Palasia, Indore, MP, PIN Code – 452001, India - 2
              </li>
              <li>
                <span class="fal fa-headphones icon me-2"></span>
                <a href="#">+918809772278</a>
              </li>
              <li>
                <span class="fal fa-envelope icon me-2"></span>
                <a href="#">support@flippingo.com</a>
              </li>
            </ul>
          </div>
          <!-- end footer-item -->
        </div>
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
      <hr class="border-top-gray" />
      <div class="copy-right d-flex flex-wrap align-items-center justify-content-between pb-4">
        <p class="copy__desc py-2">
          &copy; Copyright Dirto <span id="copyright-year"></span>. Made with
          <span class="fas fa-heart bounce-anim"></span> by
          <a href="https:// Flippingo.com/"> Flippingo</a>
        </p>
        <select class="select-picker select-picker-sm" data-width="130" data-size="5">
          <option value="1" selected>English</option>
          <option value="2">French</option>
          <option value="3">Czech</option>
          <option value="4">German</option>
          <option value="5">Italian</option>
          <option value="6">Turkish</option>
        </select>
      </div>
      <!-- end copy-right -->
    </div>
    <!-- end container -->
  </section>
  <!-- end footer-area -->
  <!-- ================================
       START FOOTER AREA
================================= -->

  <!-- start back-to-top -->
  <div id="back-to-top">
    <i class="far fa-angle-up" title="Go top"></i>
  </div>
  <!-- end back-to-top -->

  <!-- Template JS Files -->
  <script src="{{ asset('assets') }}/js/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets') }}/js/select2.min.js"></script>
  <script src="{{ asset('assets') }}/js/jquery.fancybox.min.js"></script>
  <script src="{{ asset('assets') }}/js/animated-headline.js"></script>
  <script src="{{ asset('assets') }}/js/owl.carousel.min.js"></script>
  <script src="{{ asset('assets') }}/js/waypoints.min.js"></script>
  <script src="{{ asset('assets') }}/js/jquery.counterup.min.js"></script>
  <script src="{{ asset('assets') }}/js/rating-script.js"></script>
  <script src="{{ asset('assets') }}/js/jquery.lazy.min.js"></script>
  <script src="{{ asset('assets') }}/js/main.js"></script>

</body>

<!-- Mirrored from  Flippingo.com/demos/themes/html/Flippingo-demo/Flippingo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 May 2025 04:17:44 GMT -->

</html>