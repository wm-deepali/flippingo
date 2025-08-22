@extends('layouts.new-master')

@section('title')
  {{ $page->meta_title ?? 'Flippingo' }}
@endsection

@section('content')


  <!-- end testimonial-area -->
  <!-- ================================
       START TESTIMONIAL AREA
  ================================= -->

  <hr class="border-top-gray my-0" />


  <section class="breadcrumb-area bread-bg" style="margin-top: 100px;">
    <div class="overlay"></div>
    <!-- end overlay -->
    <div class="container">
    <div class="breadcrumb-content text-center">
      <h2 class="sec__title text-white mb-3">Contact Us</h2>
      <ul class="bread-list">
      <li><a href="{{ Route('home') }}">home</a></li>
      <li>contact us</li>
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
    START CONTACT AREA
  ================================= -->
  <section class="contact-area padding-top-60px padding-bottom-90px">
    <div class="container">
    <div class="alert alert-success alert-message mb-3" role="alert">
      Thank You! Your message has been sent.
    </div>
    <div class="row">
      <div class="col-lg-8">
      <form action="https:// Flippingo.com/demos/themes/html/dirto-demo/dirto/php/contact.php"
        class="contact-form card">
        <div class="card-body">
        <h4 class="card-title">Get in touch</h4>
        <hr class="border-top-gray" />
        <div class="form-group">
          <label class="label-text">Your Name</label>
          <input id="name" class="form-control form--control ps-3" type="text" name="name"
          placeholder="Your name" />
        </div>
        <div class="form-group">
          <label class="label-text">Your Email</label>
          <input id="email" class="form-control form--control ps-3" type="email" name="email"
          placeholder="you@email.com" />
        </div>
        <div class="form-group">
          <label class="label-text">Message</label>
          <textarea id="message" class="form-control form--control ps-3" rows="4" name="message"
          placeholder="Write message"></textarea>
        </div>
        <button id="send-message-btn" class="theme-btn border-0" type="submit">
          Send Message
        </button>
        </div>
      </form>
      </div>
      <!-- end col-lg-8 -->
      <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
        <h4 class="card-title">Contact Information</h4>
        <hr class="border-top-gray" />
        <ul class="list-items mb-5">
          <li>
          <span
            class="fal fa-map-marker-alt icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span>
          Old Palasia, Indore, MP, PIN Code – 452001, India - 2
          </li>
          <li>
          <span
            class="fal fa-envelope icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span><a
            href="mailto:example@gmail.com">support@flippingo.com</a>
          </li>
          <li>
          <span
            class="fal fa-phone icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span>
          +91 8809772278


          </li>
        </ul>
        <h4 class="card-title">Working Hours</h4>
        <hr class="border-top-gray" />
        <ul class="list-items mt-3">
          <li class="d-flex align-items-center justify-content-between">
          Monday To Friday
          <span class="font-weight-regular">9am - 7pm</span>
          </li>
          <li class="d-flex align-items-center justify-content-between">
          Saturday To Sunday
          <span class="font-weight-regular text-danger">Close</span>
          </li>
        </ul>
        </div>
        <!-- end card-body -->
      </div>
      <!-- end card -->
      </div>
      <!-- end col-lg-4 -->
    </div>
    <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end contact-area -->
  <!-- ================================
    END CONTACT AREA
  ================================= -->

  <!-- Start map --->
  <!-- <div class="map-container">
      <div
      id="map-single"
      data-latitude="40.728157"
      data-longitude="-74.077644"
      class="w-100 height-500"
      ></div>
    </div> -->


  <section class="subscriber-area mb-n5 position-relative z-index-2" style="margin-top: 330px;">
    <div class="container">
    <div class="subscriber-box d-flex flex-wrap align-items-center justify-content-between bg-dark overflow-hidden">
      <div class="section-heading my-2">
      <h2 class="sec__title text-white mb-2">Subscribe to Newsletter!</h2>
      <p class="sec__desc text-white-50">
        Subscribe to get latest updates and information.
      </p>
      </div>
      <!-- end section-heading -->
      <form method="post">
      <div class="input-group">
        <span class="fal fa-envelope form-icon"></span>
        <input class="form-control form--control" type="email" placeholder="Enter your email" />
        <div class="input-group-append">
        <button class="theme-btn" type="submit">Subscribe</button>
        </div>
      </div>
      </form>
    </div>
    <!-- end subscriber-box -->
    </div>
    <!-- end container -->
  </section>
  <!-- end subscriber-area -->
  <!-- ================================
    END SUBSCRIBER AREA
  ================================= -->


@endsection