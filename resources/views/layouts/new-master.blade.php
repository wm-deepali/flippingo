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
  <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.min.css" />
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
  <link href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">

  <style>
    .profile-link {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .profile-link:hover {
      color: #007bff;
    }

    .dropdown-menu {
      min-width: 150px;
    }

    .offcanvas-body {
      padding: 20px;
      background: #fff;
    }

    .menu-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .menu-btn {
      width: 100%;
      background: #f8f9fa;
      border: none;
      padding: 12px 15px;
      text-align: left;
      font-size: 16px;
      font-weight: 600;
      color: #333;
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    .menu-btn:hover {
      background: #007bff;
      color: #fff;
    }

    .dropdown-menu-item {
      display: none;
      list-style: none;
      padding-left: 15px;
      margin-top: 8px;
    }

    .menu-btn.dropdown-toggle:focus+.dropdown-menu-item {
      display: block;
    }

    .dropdown-menu-item li a {
      display: block;
      padding: 8px 0;
      color: #555;
      font-size: 15px;
      text-decoration: none;
      transition: color 0.2s;
    }

    .dropdown-menu-item li a:hover {
      color: #007bff;
    }

    .flippingonew-search-wrapper {
      position: relative;
    }

    .flippingonew-dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      width: 105%;
      background: #fff;
      border-radius: 10px;
      margin-top: 6px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      display: none;
      z-index: 9999;
      overflow: hidden;
    }

    .flippingonew-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      cursor: pointer;
      border-bottom: 1px solid #f0f0f0;
      transition: background 0.2s;
    }

    .flippingonew-item:last-child {
      border-bottom: none;
    }

    .flippingonew-item:hover {
      background: #f7f9fc;
    }

    .flippingonew-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: #fff;
    }

    .flippingonew-title {
      font-size: 14px;
      font-weight: 600;
      color: #222;
    }
  </style>

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

  <header class="header-area border-bottom border-bottom-gray desktop-view">

    <div class="main-header py-3">
      <div class="container" style="max-width: 1260px;">
        <div class="main-header-action-wrap d-flex justify-content-between">
          <div class="logo">
            <a href="{{ Route('home') }}"><img src="{{ asset('assets') }}/images/logo.png" alt="logo" /></a>
          </div>

          <div class="d-flex" style="width: 40%; align-items: center;margin-top: 15px;">
            <div class="col-lg-12 pe-lg-0 flippingonew-search-wrapper">
              <div class="form-group position-relative">
                <span class="fal fa-search form-icon"></span>

                <input type="text" class="form-control form--control flippingonew-search-input"
                  placeholder="Search social platforms..." style="width:105%;height:45px;"
                  onkeyup="flippingonewSearch(this.value)" />

                <div class="flippingonew-dropdown" id="flippingonewDropdown"></div>
              </div>
            </div>



          </div>


          <div class="nav-right-content d-flex align-items-center">

            @php
              $customer = Auth::guard('customer')->user();
            @endphp

            @if($customer)
              <div class="dropdown">
                <a href="#" class="d-flex align-items-center profile-link" id="profileDropdown" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img
                    src="{{ $customer->profile_pic ? asset('storage/' . $customer->profile_pic) : asset('user_assets/images/users/profile-pic.jpg')  }}"
                    alt="Profile Photo" class="rounded-circle me-2" style="width:43px; height:43px; object-fit:cover;">
                  <span class="profile-name" style="color:#fff;">{{ $customer->first_name ?? 'User' }}
                    {{ $customer->last_name ?? '' }}</span>
                  <i class="fas fa-caret-down ms-2" style="color:#fff;"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                  <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li><a class="dropdown-item" href="{{ route('account-logout') }}">Logout</a></li>
                </ul>
              </div>
            @else
              <div class="author-access-list me-3">
                <a href="{{ Route('authentication-signin')}}">Login</a>
                <span class="or-text">or</span>
                <a href="{{ Route('authentication-signup') }}">Sign Up</a>
              </div>
            @endif

            <!-- Sell Now Button -->
            <a href="{{ Route('add-listing') }}" class="theme-btn ms-3" style="padding: 8px 35px;">
              + Sell Now
            </a>

            <!-- Side Menu -->
            <div class="side-menu-open ms-2">
              <i class="fal fa-bars"></i>
            </div>
          </div>



          <!--<div class="nav-right-content d-flex align-items-center">-->
          <!--  <div class="author-access-list me-3">-->
          <!--    <a href="{{ Route('authentication-signin')}}">Login</a>-->
          <!--    <span class="or-text">or</span>-->
          <!--    <a href="{{ Route('authentication-signup') }}">Sign Up</a>-->
          <!--  </div>-->
          <!--  <a href="{{ Route('add-listing') }}" class="theme-btn" style="padding: 10px 20px;">-->
          <!-- <span class="fal fa-plus me-1"></span> -->
          <!--    Sell Now-->
          <!--  </a>-->
          <!--  <div class="side-menu-open ms-2">-->
          <!--    <i class="fal fa-bars"></i>-->
          <!--  </div>-->
          <!-- end side-menu-open -->
          <!--</div>-->




          <!-- end nav-right-content -->
        </div>
        <!-- end main-header-action-wrap -->
      </div>
      <!-- end container-fluid -->
    </div>
    @php
      use App\Models\Category;
      $categories = Category::where('status', 'active')->get();
    @endphp
    <div class="top-header">
      <div class="top-header-list">
        <nav class="main-menu " style="width: 100%;">
          <ul class="d-flex justify-content-between">
            <li>
              <a href="#">Browse <span class="fal fa-angle-down"></span></a>
              <ul class="dropdown-menu-item">
                @foreach($categories as $category)
                  <li><a href="{{ route('listing-list', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                  </li>
                @endforeach

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
  <div class="mobile-menu">
    <div class="main-header py-3">
      <div class="container">
        <div class="main-header-action-wrap d-flex justify-content-between">
          <div class="side-menu-open ms-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
            aria-controls="offcanvasExample">
            <i class="fal fa-bars"></i>
          </div>
          <div class="logo">
            <a href="{{ Route('home') }}"><img src="{{ asset('assets') }}/images/logo.png" alt="logo" /></a>
          </div>




          <div class="nav-right-content d-flex align-items-center">
            <a href="{{ Route('add-listing') }}" class="theme-btn ms-3" style="padding: 8px 35px;">
              + Sell Now
            </a>

            @php
              $customer = Auth::guard('customer')->user();
            @endphp

            @if($customer)
              <div class="dropdown">
                <a href="#" class="d-flex align-items-center profile-link" id="profileDropdown" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img
                    src="{{ $customer->profile_pic ? asset('storage/' . $customer->profile_pic) : asset('user_assets/images/users/profile-pic.jpg')  }}"
                    alt="Profile Photo" class="rounded-circle me-2" style="width:43px; height:43px; object-fit:cover;">
                  <span class="profile-name" style="color:#fff;">{{ $customer->first_name ?? 'User' }}
                    {{ $customer->last_name ?? '' }}</span>
                  <i class="fas fa-caret-down ms-2" style="color:#fff;"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                  <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li><a class="dropdown-item" href="{{ route('account-logout') }}">Logout</a></li>
                </ul>
              </div>
            @else
              <div class="author-access-list me-3">
                <a href="{{ Route('authentication-signin')}}">Login</a>
                <span class="or-text">or</span>
                <a href="{{ Route('authentication-signup') }}">Sign Up</a>
              </div>
            @endif

            <!-- Sell Now Button -->


            <!-- Side Menu -->

          </div>



          <!--<div class="nav-right-content d-flex align-items-center">-->
          <!--  <div class="author-access-list me-3">-->
          <!--    <a href="{{ Route('authentication-signin')}}">Login</a>-->
          <!--    <span class="or-text">or</span>-->
          <!--    <a href="{{ Route('authentication-signup') }}">Sign Up</a>-->
          <!--  </div>-->
          <!--  <a href="{{ Route('add-listing') }}" class="theme-btn" style="padding: 10px 20px;">-->
          <!-- <span class="fal fa-plus me-1"></span> -->
          <!--    Sell Now-->
          <!--  </a>-->
          <!--  <div class="side-menu-open ms-2">-->
          <!--    <i class="fal fa-bars"></i>-->
          <!--  </div>-->
          <!-- end side-menu-open -->
          <!--</div>-->




          <!-- end nav-right-content -->
        </div>
        <!-- end main-header-action-wrap -->
      </div>
      <!-- end container-fluid -->
    </div>

    <div class="top-header">
      <div class="top-header-list">
        <div class="d-flex" style="width: 100%; align-items: center;margin-top: 15px;">
          <div class="col-12">
            <div class="form-group">
              <span class="fal fa-search form-icon"></span>
              <input class="form-control form--control" type="text" placeholder="What are you looking for?"
                style="width: 100%;height:45px;" />
            </div>
          </div>


        </div>


      </div>

    </div>

  </div>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Category</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <nav class="main-menu" style="width: 100%;">
        <div class="menu-buttons">
          <button class="menu-btn dropdown-toggle" type="button">
            Browse
          </button>
          <ul class="dropdown-menu-item">
            @foreach($categories as $category)
              <li>
                <a href="{{ route('listing-list', ['category' => $category->slug]) }}">
                  {{ $category->name }}
                </a>
              </li>
            @endforeach
          </ul>

          <button class="menu-btn" onclick="location.href='{{ Route('meet-our-team') }}'">
            Meet Our Team
          </button>

          <button class="menu-btn">
            Insight
          </button>

          <button class="menu-btn">
            Buyers Mandate
          </button>

          <button class="menu-btn">
            Why Flippingo
          </button>

          <button class="menu-btn" onclick="location.href='{{ Route('blogs') }}'">
            Blogs
          </button>

          <button class="menu-btn">
            Sell Digitally
          </button>

          <button class="menu-btn">
            Services
          </button>

          <button class="menu-btn">
            Resources
          </button>

          <button class="menu-btn" onclick="location.href='{{ Route('contact-us') }}'">
            Contact Us
          </button>
        </div>
      </nav>
    </div>

  </div>

  <!-- ================================
         END HEADER AREA
================================= -->


  @yield('content')

  <!-- ================================
       START FOOTER AREA
================================= -->
  <section class="footer-area bg-gray padding-top-80px pattern-bg">
    @php
      $address = $footerSettings['footer_address'] ?? 'Old Palasia, Indore, MP, 452001, India';
      $helpline = $footerSettings['footer_helpline'] ?? '+91 880977278';
      $email = $footerSettings['footer_email'] ?? 'support@flippingo.com';
      $whatsapp = $footerSettings['footer_whatsapp'] ?? '+91 880977278';
      $logo = $footerSettings['footer_logo'] ?? 'assets/images/logo.png';
    @endphp


    <div class="container">
      <div class="row">

        <!-- Column 1: Quick Links -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-item">
            <h4 class="footer__title mb-3">Quick Links</h4>
            <div class="stroke-shape mb-4"></div>
            <ul class="list-items list-items-underline">
              <li><a href="{{ Route('listing-list') }}">Browse Listing</a></li>
              <li><a href="{{ Route('pricing') }}">Pricing</a></li>
              <li><a href="{{ Route('add-listing') }}">Sell Assets</a></li>
              <li><a href="#">How it Works</a></li>
              <li><a href="#">Our Services</a></li>
              <li><a href="#">Resources</a></li>
            </ul>
          </div>
        </div>

        <!-- Column 2: Know More -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-item">
            <h4 class="footer__title mb-3">Know More</h4>
            <div class="stroke-shape mb-4"></div>
            <ul class="list-items list-items-underline">
              <li><a href="{{ Route('about-us') }}">About Us</a></li>
              <li><a href="{{ Route('meet-our-team') }}">Meet Our Team</a></li>
              <li><a href="#">Career with Us</a></li>
              <li><a href="#">Insight</a></li>
              <li><a href="#">Why Us</a></li>
              <li><a href="{{ Route('contact-us') }}">Contact Us</a></li>
              <li><a href="#">Feedback & Testimonials</a></li>
            </ul>
          </div>
        </div>

        <!-- Column 3: Help & Support -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-item">
            <h4 class="footer__title mb-3">Help & Support</h4>
            <div class="stroke-shape mb-4"></div>
            <ul class="list-items list-items-underline">

              <li><a href="{{ Route('faq') }}">FAQ</a></li>
              <li><a href="">Raise a Ticket</a></li>
              <li><a href="{{ Route('blogs') }}">Blogs</a></li>
              @php
                use App\Models\Page;
                $footerPages = Page::where('status', 'published')->get();
              @endphp
              @foreach($footerPages as $page)
                <li><a href="{{ route('page.show', $page->slug) }}">{{ $page->slug }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>

        <!-- Column 4: Logo + Contact -->
        <div class="col-lg-3 col-md-6">
          <div class="footer-item">
            <a href="{{ Route('home') }}" class="footer-logo mb-4 d-inline-block">
              <img src="{{ asset('storage/' . setting('footer_logo', 'assets/images/logo.png')) }}" alt="logo"
                style="background-color: #000; border-radius: 7px; padding: 7px 10px;" />
            </a>
            <ul class="info-list">
              <li><span class="fas fa-map-marker-alt me-2"></span>
                {{ setting('footer_address', 'Old Palasia, Indore, MP, 452001, India') }}</li>
              <li><span class="fas fa-phone-alt me-2"></span> Helpline: <a
                  href="tel:{{ preg_replace('/\D/', '', setting('footer_helpline', '+91880977278')) }}">{{ setting('footer_helpline', '+91 88097778') }}</a>
              </li>
              <li><span class="fas fa-envelope me-2"></span> <a
                  href="mailto:{{ setting('footer_email', 'support@flippingo.com') }}">{{ setting('footer_email',
                  'support@flippingo.com') }}</a></li>
              <li><span class="fab fa-whatsapp me-2"></span> <a
                  href="https://wa.me/{{ preg_replace('/\D/', '', setting('footer_whatsapp', '+91880977278')) }}"
                  target="_blank">{{ setting('footer_whatsapp', '+91 88097778') }}</a></li>
            </ul>
            @php
              use App\Models\UserSocialLink;
              $socialLinks = UserSocialLink::first();
            @endphp

            <div class="social-icons mt-3">
              <a href="{{ $socialLinks->facebook ?? "#"}}" target="_blank"><i class="fab fa-facebook-f"
                  style="margin-top: 10px;"></i></a>

              <a href="{{ $socialLinks->instagram ?? "#"}}" target="_blank"><i class="fab fa-instagram"
                  style="margin-top: 10px;"></i></a>

              <a href="{{ $socialLinks->linkedin ?? "#"}}" target="_blank"><i class="fab fa-linkedin-in"
                  style="margin-top: 10px;"></i></a>

              <a href="{{ $socialLinks->twitter ?? "#"}}" target="_blank"><i class="fab fa-twitter"
                  style="margin-top: 10px;"></i></a>

              <a href="{{ $socialLinks->youtube ?? "#"}}" target="_blank"><i class="fab fa-youtube"
                  style="margin-top: 10px;"></i></a>

              <a href="{{ $socialLinks->google_plus ?? "#"}}" target="_blank"><i class="fab fa-google-plus-g"
                  style="margin-top: 10px;"></i></a>

            </div>

          </div>
        </div>

      </div>
      <!-- end row -->

      <hr class="border-top-gray" />
      <div class="copy-right d-flex flex-wrap align-items-center justify-content-between pb-4">
        <p class="copy__desc py-2">
          &copy; <span id="copyright-year"></span> Flippingo. Made with
          <span class="fas fa-heart bounce-anim"></span> by <a href="https://flippingo.com/">Flippingo</a>
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
    </div>
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let searchTimeout = null;

    // ✅ storage path normalizer (IMPORTANT)
    function resolveStorageImage(path) {
      if (!path) return null;
      return `/storage/${path.replace(/^\/?storage\//, '')}`;
    }

    function flippingonewSearch(value) {
      const dropdown = document.getElementById("flippingonewDropdown");
      dropdown.innerHTML = "";

      if (!value.trim() || value.length < 2) {
        dropdown.style.display = "none";
        return;
      }

      clearTimeout(searchTimeout);

      searchTimeout = setTimeout(() => {
        fetch(`/listings/search?q=${encodeURIComponent(value)}`, {
          headers: {
            "X-CSRF-TOKEN": document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content")
          }
        })
          .then(res => res.json())
          .then(res => {
            dropdown.innerHTML = "";

            if (!res.data || !res.data.length) {
              dropdown.style.display = "none";
              return;
            }

            res.data.forEach(item => {
              const div = document.createElement("div");
              div.className = "flippingonew-item";

              const imageUrl = resolveStorageImage(item.image);

              const imageHtml = imageUrl
                ? `<img src="${imageUrl}"
                     style="width:36px;height:36px;border-radius:8px;object-fit:cover;">`
                : `<div class="flippingonew-icon"
                     style="background:${item.type === "category" ? "#6f42c1" : "#0d6efd"}">
                    ${item.type === "category" ? "📂" : "📄"}
                 </div>`;

              div.innerHTML = `
              ${imageHtml}
              <div class="flippingonew-title">
                ${item.title || 'Listing'}
                <small style="display:block;color:#777;font-size:12px;">
                  ${item.type === "category" ? "Category" : "Listing"}
                </small>
              </div>
            `;

              div.onclick = () => {
                window.location.href = item.url;
              };

              dropdown.appendChild(div);
            });

            dropdown.style.display = "block";
          })
          .catch(() => {
            dropdown.style.display = "none";
          });
      }, 300); // debounce
    }

    document.addEventListener("click", function (e) {
      if (!e.target.closest(".flippingonew-search-wrapper")) {
        document.getElementById("flippingonewDropdown").style.display = "none";
      }
    });
  </script>




</body>

<!-- Mirrored from  Flippingo.com/demos/themes/html/Flippingo-demo/Flippingo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 26 May 2025 04:17:44 GMT -->

</html>