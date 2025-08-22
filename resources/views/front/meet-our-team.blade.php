
@extends('layouts.new-master')

@section('title')
  {{ $page->meta_title ?? 'Flippingo' }}
@endsection

<style>
     .top-header-list .main-menu ul li a{
color: gray !important;
  }
  .top-header-list div p{
color: rgb(255, 255, 255) !important;

  }
</style>


@section('content')


  <!-- end testimonial-area -->
  <!-- ================================
       START TESTIMONIAL AREA
================================= -->

  <hr class="border-top-gray my-0" />



 
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