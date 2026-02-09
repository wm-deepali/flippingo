
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<?php $__env->startSection('title'); ?>
  <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>
<style>
  :root {
    --flippingo-blue: #2563eb;
    --flippingo-blue-light: #dbeafe;
    --flippingo-gray: #6b7280;
  }


  .flippingo-hiw-section {
    padding: 50px 0px;
    background: linear-gradient(to bottom, #f0f9ff, #ffffff);
  }

  .flippingo-hiw-container {
    max-width: 1250px;
    margin: 0 auto;
    padding: 0 1.5rem;
  }

  .flippingo-hiw-full-slider {
    position: relative;
    overflow: hidden;
    border-radius: 1.5rem;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  }

  .flippingo-hiw-full-slides {
    display: flex;
    width: 100%;
    3 slides transition: transform 0.8s ease;
  }

  .flippingo-hiw-full-slide {
    min-width: 100%;
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    padding: 3rem;
    align-items: center;
  }

  @media (min-width: 1024px) {
    .flippingo-hiw-full-slide {
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
    }
  }

  Left Content .flippingo-hiw-content h2 {
    font-size: 2rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1rem;
    color: #1f2937;
  }

  @media (min-width: 768px) {
    .flippingo-hiw-content h2 {
      font-size: rem;
    }
  }

  .flippingo-hiw-content p {
    font-size: 1.125rem;
    color: var(--flippingo-gray);
    margin-bottom: 1.5rem;
    color: gray;
    display: flex;
    gap: 13px;
  }

  .flippingo-hiw-content p span {
    display: block;
    color: var(--flippingo-blue);
    font-weight: 600;
    /*margin-top: 0.5rem;*/
    color: gray;
  }

  .flippingo-hiw-steps {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin: 1.5rem 0;
  }

  .flippingo-hiw-step {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    border-radius: 1rem;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
  }

  .flippingo-hiw-step:hover {
    transform: translateY(-4px);
  }

  .flippingo-hiw-step-icon {
    width: 3rem;
    height: 3rem;
    background: linear-gradient(135deg, var(--flippingo-blue), #3b82f6);
    color: white;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.25rem;
  }

  .flippingo-hiw-step h4 {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #1f2937;
  }

  .flippingo-hiw-step p {
    font-size: 0.875rem;
    color: var(--flippingo-gray);
    margin: 0;
  }

  Buttons .flippingo-hiw-btn-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  @media (min-width: 640px) {
    .flippingo-hiw-btn-group {
      flex-direction: row;
    }
  }

  .flippingo-hiw-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 1rem;
  }

  .flippingo-hiw-btn-primary {
    background: var(--flippingo-blue);
    color: white;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
  }

  .flippingo-hiw-btn-primary:hover {
    background: #fff;
    color: var(--flippingo-blue);
    border: 2px solid var(--flippingo-blue);
  }

  .flippingo-hiw-btn-secondary {
    border: 2px solid #000;
    color: #fff;
    background: #000;
  }

  .flippingo-hiw-btn-secondary:hover {
    background: #fff;
    color: #000;
  }

  Right Image .flippingo-hiw-image {
    border-radius: 1.5rem;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    height: 400px;
  }

  @media (max-width: 1024px) {
    .flippingo-hiw-image {
      height: 350px;
    }
  }

  @media (max-width: 768px) {
    .flippingo-hiw-image {
      height: 280px;
      margin-top: 1rem;
    }
  }

  .flippingo-hiw-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
  }

  .flippingo-hiw-image:hover img {
    transform: scale(1.05);
  }

  Arrows .flippingo-hiw-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 3rem;
    height: 3rem;
    background: white;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
  }

  .flippingo-hiw-arrow:hover {
    background: var(--flippingo-blue);
    color: white;
    transform: translateY(-50%) scale(1.1);
  }

  .flippingo-hiw-arrow-left {
    left: 0rem;
  }

  .flippingo-hiw-arrow-right {
    right: 0rem;
  }

  Dots .flippingo-hiw-dots {
    position: absolute;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
    z-index: 10;
  }

  .flippingo-hiw-dot {
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 9999px;
    background: #000000;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .flippingo-hiw-dot.active {
    background: blue;
    width: 2rem;
  }

  /* Tabs Navigation */
  .flippingo-hiw-tabs-nav {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
  }

  .flippingo-hiw-tab {
    padding: 5px 20px;
    font-size: 14px;
    font-weight: 600;
    color: #4b5563;
    background: #ffffff;
    border: none;
    border-radius: 17px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .flippingo-hiw-tab:hover {
    background: #e5e7eb;
  }

  .flippingo-hiw-tab.active {
    background: var(--flippingo-blue);
    color: white;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
  }

  /* Tab Content Wrapper */
  .flippingo-hiw-tab-content {
    position: relative;
  }

  .flippingo-hiw-full-slide {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    padding: 2rem 0;
    align-items: center;
  }

  @media (min-width: 1024px) {
    .flippingo-hiw-full-slide {
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
    }
  }

  /* Keep your existing .flippingo-hiw-content, .flippingo-hiw-image, buttons, etc. styles unchanged */
</style>
<style>
  .get-a-quote:before,
  .swal-modal:before {
    background-color: #00c389;
  }

  .get-a-quote:before {
    position: absolute;
    width: 90%;
    top: -21px;
    height: 45px;
    content: "";
    left: 5%;
    border-radius: 26px;
    z-index: -1;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .top-header-list .main-menu ul li a {
    color: gray !important;
  }

  .top-header-list div p {
    color: rgb(255, 255, 255) !important;

  }

  img {
    object-fit: cover;
  }

  .gap {
    padding: 120px 0;
  }

  .no-top {
    padding-top: 0;
  }

  .no-bottom {
    padding-bottom: 0;
  }

  ul {
    padding: 0;
    margin: 0;
  }

  li {
    display: block;
  }

  figure {
    overflow: hidden;
  }

  /* 2. header */
  /* 3. hero-section */
  .hero-section:before {
    background-color: #0062ef;
    /* background-image: url('/<?php echo e(asset('assets')); ?>/images/rm222batch2-mind-03.jpg'); */

    height: 1556px;
    content: "";
    position: absolute;
    width: 2300px;
    border-radius: 666px;
    transform: rotate(331deg);
    top: -93%;
    left: -10%;
    z-index: -11;
    box-shadow: 94px 0px 0px 88px rgb(237 237 237);
    -webkit-box-shadow: 94px 0px 0px 88px rgb(237 237 237);
    -moz-box-shadow: 94px 0px 0px 88px rgb(237 237 237);
  }

  .hero-section {
    margin-top: 40px !important;
    overflow: hidden;
    position: relative;
    padding-top: 160px;
  }

  .hero-section:after {
    height: 1556px;
    content: "";
    position: absolute;
    width: 2300px;
    border-radius: 666px;
    transform: rotate(331deg);
    top: -93%;
    left: -10%;
    z-index: -11;
    opacity: .1;
    background-repeat: no-repeat;
    background-image: url(../img/hero.jpg);
    background-size: cover;
    background-position: center;
  }

  .hero-section-text {
    position: relative;
  }

  .hero-section-text h1 {
    color: white;
    font-weight: 700;
    font-size: 49px;
  }

  .hero-section-text p {
    color: #fff;
    padding-bottom: 15px;
    width: 100%;
  }

  .right-form-card h3 {
    text-align: center;
    margin-bottom: 17px !important;
    color: #333;
    font-weight: 700;
    font-size: 25px;
  }

  .right-form-card {
    padding: 10px 25px !important;
  }

  .play-button svg {
    width: 25px;
    height: 25px;
  }

  .play-button i {
    background-color: white;
    width: 75px;
    height: 75px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 20px;
  }

  .play-button i:before {
    position: absolute;
    content: "";
    width: 90px;
    height: 90px;
    border: 3px solid #fff;
    border-radius: 50%;

  }

  .play-button a {
    color: #020202 !important;
    display: flex;
    align-items: center;
    background: #f1f1f1;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  }

  .play-button a span {
    border-bottom: 1px solid #fff;
    line-height: 16px;
  }

  /*Start Seo section */
  .image-banner-rights img {
    width: 100%;
  }

  .pab-seo {
    position: absolute;
    font-size: 22px;
    font-weight: 600;
    text-align: center;
    line-height: 22px;
    top: 50px;
    color: #000;
    width: 100%;
  }

  .batton.x {
    padding: 10px 40px !important;
  }

  .batton:before {
    content: "";
    width: 20%;
    height: 100%;
    background-color: rgb(0 0 0 / 25%);
    opacity: 0.5;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    visibility: hidden;
    z-index: -1;
  }

  .btn-deals {
    margin-top: 10px;
  }

  .btn-deals a {
    background: linear-gradient(to right, #e8e7ec, #e8e7ec, #e8e7ec);
    color: #000;
  }

  .image-banner-rights {
    position: relative;
  }

  .col-sm-12.col-md-6.p00 {
    margin: 0px !important;
    padding: 0px !important;
  }

  .right-section-service {
    font-size: 24px;
    font-weight: 600;
    padding: 65px 40px;
    text-align: center;
    color: #fff;
  }

  .btn-deals a {
    padding: 5px 40px !important;
  }

  .btn-deals {
    margin-top: 10px;
  }

  .bg01 {
    background-color: #54C5CD;
  }

  .bg02 {
    background-color: #EF718D;
  }

  .bg03 {
    background-color: #A74FF7;
  }

  .bg04 {
    background-color: #F5A540;
  }

  /*End Seo section */


  /*Start technonogies ----------------- */
  .technology {
    padding: 40px 0;
  }

  .heading span {
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
  }

  .heading {
    padding-bottom: 40px;
  }

  .heading h2 {
    font-weight: bold;
    width: 90%;
    margin-bottom: 0;
    text-transform: capitalize;
  }

  .d-inl {
    display: flex;
  }

  .tech-box {
    border-radius: 4px;
    padding: 10px;
    box-shadow: 2px 2px 26px 4px #00000021;
    margin-top: 25px !important;
    margin: auto;
  }

  .tech-box {
    margin-right: 10px;
    margin-bottom: 20px;
  }

  .tech-box {
    width: 230px;
  }


  .tec-ico,
  .tec-name {
    text-align: center;
  }

  .tec-name {
    font-size: 26px;
    font-weight: 600;
  }

  .tec-ico img {
    height: 33px;
    width: 33px;
  }

  /*End technonogies  */

  section#about {
    background-color: #f3f6fa;
  }

  .review h2 {
    font-size: 60px;
    line-height: 36px;
    font-weight: 800;
    text-align: center;
  }

  .review span {
    font-size: 20px;
    display: block;
    text-transform: uppercase;
  }

  .video {
    display: flex;
    justify-content: space-between;
  }

  .review {
    background-color: #fed73e;
    border-radius: 30px;
    padding: 40px 24px;
    padding-bottom: 24px;
    text-align: center;
    z-index: 1;
    padding-top: 34px;
  }

  ul.star {
    display: flex;
    background-color: white;
    padding: 4px 14px;
    border-radius: 34px;
    color: #ffab19;
    margin-bottom: 12px;
  }

  ul.star li {
    padding-right: 2px;
  }

  img.dots {
    position: absolute;
    z-index: 0;
    bottom: 0%;
    right: 22%;
  }

  img.landing-slider {
    position: absolute;
    z-index: 0;
    bottom: 13%;
    left: -23%;
  }

  .state h6 {
    margin: 0;
    font-weight: bold;
    padding-left: 15px;
  }

  .state img {
    background-color: #edf4ff;
    padding: 12px;
    border-radius: 50%;
  }

  .check {
    border-bottom: 10px solid #f6f2f8;
    padding-bottom: 60px;
    padding-top: 80px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-bottom: 80px;
  }

  .state {
    display: flex;
    align-items: center;
  }

  /* 4. get-a-quote */
  form.get-a-quote i svg {
    fill: #00c389;
  }

  form.get-a-quote i {
    width: 90px;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #e5f9f3;
    border-radius: 50%;
    padding: 22px;
    border-bottom-left-radius: 0;
    margin-right: 30px;
  }

  .get-a-quote h2 {
    font-weight: 40px;
    font-weight: 800;
  }

  .get-a-quote span {
    font-size: 16px;
    font-weight: bold;
    color: #858585;
  }

  .get-a-quote {
    background-color: white;
    padding: 60px;
    border-radius: 30px;
    margin-left: 30px;
    box-shadow: -1px 0px 44px 15px rgb(0 0 0 / 4%);
    -webkit-box-shadow: -1px 0px 44px 15px rgb(0 0 0 / 4%);
    -moz-box-shadow: -1px 0px 44px 15px rgba(0, 0, 0, 0.4);
    position: relative;
    margin-bottom: 50px;
  }

  .get-a-quote:after {
    right: -6%;
    position: absolute;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 14px solid #fed73e;
    content: "";
    z-index: -1;
    bottom: -6%;
  }

  .get-a-quote:before {
    position: absolute;
    width: 90%;
    top: -21px;
    height: 45px;
    content: "";
    left: 5%;
    border-radius: 26px;
    z-index: -1;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .get-a-quote input[type="text"],
  .get-a-quote input[type="number"] {
    width: 100%;
    height: 60px;
    border: 0;
    border-radius: 12px;
    outline: 0;
    margin-bottom: 20px;
    padding-left: 30px;
    color: #444;
    font-size: 16px;
    padding-right: 86px;
    box-shadow: 0px 0px 20px 7px rgba(0, 0, 0, 0.08);
    -webkit-box-shadow: 0px 0px 20px 7px rgba(0, 0, 0, 0.08);
    -moz-box-shadow: 0px 0px 20px 7px rgba(0, 0, 0, 0.08);
    border: 1px solid #d3d3d3;
  }

  .group-img:before {
    content: "";
    background-color: #d9d9d9;
    width: 1px;
    height: 35px;
    position: absolute;
    right: 70px;
    top: 15px;
  }

  .get-a-quote p {
    font-weight: bold;
    padding-bottom: 10px;
    padding-top: 10px;
  }

  .radio-button {
    padding: 15px;
    background-color: #edf4ff;
    margin-right: 15px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 700;
    align-items: center;
    display: flex;
    margin-bottom: 35px;
  }

  .radio-button label {
    padding-left: 10px;
  }

  .radio-button input {
    width: 22px;
    height: 22px;
  }

  .group-img {
    position: relative;
  }

  .group-img svg {
    position: absolute;
    right: 30px;
    width: 24px;
    height: auto;
    top: 21px;
  }

  /* 5. heading span */
  .heading span {
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
  }

  .heading {
    padding-bottom: 40px;
  }

  .heading h2 {
    font-weight: bold;
    width: 90%;
    margin-bottom: 0;
    text-transform: capitalize;
  }

  .headingline {
    display: block;
    margin-top: 10px;
    background-color: #9a9a9a;
    width: 40px;
    height: 1px;
    margin-bottom: 20px;
  }

  .we-are p {
    width: 84%;
    padding-bottom: 45px;
  }

  .we-are span {
    font-weight: bold;
    border-bottom: 1px solid;
  }

  .we-are span.bolo {
    border-radius: 50%;
    display: inline-block;
    border: 7px solid #00c389;
    height: 20px;
    width: 20px;
    margin-right: 10px;
  }

  .we-are ul li {
    font-weight: 600;
    padding-bottom: 20px;
    align-items: center;
    display: flex;
  }

  /* 6. business-performance */
  .business-performance {
    padding-top: 100px;
    padding-bottom: 100px;
  }

  .business-performance h4 {
    font-weight: 800;
    text-transform: capitalize;
  }

  .performance-count {
    font-size: 65px;
    font-weight: bold;
    display: flex;
    align-items: center;
  }

  .performance-count h2 {
    font-size: 65px;
    margin: 0;
    font-weight: 800;
  }

  .customers-performance {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-left: 50px;
  }

  .performance {
    border-left: 1px solid #9b9b9b;
    padding-left: 40px;
    padding-bottom: 13px;
  }

  /* 7. how-it-works */
  .how-it-works .heading h2 {
    width: 70%;
  }

  .how-it-works {
    position: relative;
  }

  .how-it-works:before {
    width: 100%;
    height: 88%;
    content: "";
    position: absolute;
    top: 0;
    background-color: #f3f6fa;
    z-index: -1;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  /* 8. service */
  .service img {
    border-radius: 50%;
    border: 10px solid #00c389;
    margin-top: 40px;
  }

  .service h6 {
    border-bottom: 4px solid #4ec389;
    display: inline;
    font-weight: bold;
  }

  .service h5 {
    font-weight: bold;
    padding-top: 30px;
    width: 86%;
    margin: 0;
    padding-bottom: 22px;
  }

  .service p {
    font-size: 16px;
    width: 85%;
    line-height: 26px;
  }

  /* 9. discount offer */
  .discount-offer {
    background-repeat: no-repeat;
    background-color: #0062ef;
    border-radius: 30px;
    display: flex;
    align-items: center;
    padding: 50px;
    background-position: center;
    position: relative;
    box-shadow: -1px 0px 44px 15px rgba(0, 0, 0, 0.11);
    -webkit-box-shadow: -1px 0px 44px 15px rgba(0, 0, 0, 0.11);
    -moz-box-shadow: -1px 0px 44px 15px rgba(0, 0, 0, 0.11);
  }

  .discount-offer:before {
    position: absolute;
    width: 90%;
    top: -21px;
    height: 45px;
    content: "";
    left: 5%;
    border-radius: 26px;
    z-index: -1;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .discount-offer h2 {
    font-size: 45px;
    font-weight: bold;
    width: 91%;
    margin-bottom: 24px;
    color: white;
  }

  .discount-offer p {
    color: white;
    margin-bottom: 30px;
  }

  .discount-offer span {
    color: #fed73e;
  }

  /* 10. batton style */
  .batton {
    color: white;
    padding: 16px 40px;
    border-radius: 50px;
    font-weight: 500;
    display: inline-flex;
    position: relative;
    overflow: hidden;
    z-index: 0;
    border: 0;
  }

  .batton:before {
    content: "";
    width: 20%;
    height: 100%;
    background-color: rgb(0 0 0 / 25%);
    opacity: 0.5;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    visibility: hidden;
    z-index: -1;
    transition: all 0.3s ease-out 0.1s;
    -webkit-transition: all 0.3s ease-out 0.1s;
    -moz-transition: all 0.3s ease-out 0.1s;
    -o-transition: all 0.3s ease-out 0.1s;
  }

  .batton:hover {
    color: white;
  }

  .batton:hover:before {
    width: 100%;
    opacity: 0.5;
    visibility: visible;
  }

  /*  11. some-features */
  .some-features .heading h2 {
    width: 67%;
  }

  .creative-design h5 {
    font-weight: bold;
    padding-top: 50px;
    padding-bottom: 20px;
    margin-bottom: 0;
  }

  .creative-design p {
    font-size: 15px;
    line-height: 25px;
  }

  .creative-design {
    position: relative;
    margin-bottom: 60px;
  }

  .creative-design:before {
    position: absolute;
    content: "";
    width: 65px;
    height: 65px;
    top: 6%;
    background-color: #fde5e4;
    border-radius: 50%;
    z-index: -1;
  }

  .creative-design.shaps-2:before {
    background-color: #fef9d6;
  }

  .creative-design.shaps-3:before {
    background-color: #e4e9fd;
  }

  .creative-design.shaps-4:before {
    background-color: #e9f4f2;
  }

  .creative-design img {
    margin-left: 14px;
  }

  .partner {
    width: 260px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin: auto;
  }

  .partner.item img {
    width: auto;
  }

  /* 12. team */
  .team-review {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .team-review-star p {
    font-weight: bold;
    line-height: 10px;
  }

  .team-review-star {
    background-color: #fed73e;
    text-align: center;
  }

  .team-review-star ul.star {
    padding: 0;
    background-color: transparent;
    color: black;
  }

  .expert-team .heading h2 {
    padding-bottom: 0;
    width: 68%;
  }

  .team-review-star {
    background-color: #fed73e;
    text-align: center;
    padding: 32px 40px;
    border-radius: 68px;
  }

  .team-expert {
    position: relative;
    display: flex;
    align-items: flex-start;
    background-color: #fff;
    padding: 40px;
    padding-right: 40px;
    border-radius: 40px;
    width: 90%;
    margin-left: auto;
    box-shadow: -1px 0px 44px 15px rgb(0 0 0 / 6%);
    -webkit-box-shadow: -1px 0px 44px 15px rgb(0 0 0 / 6%);
    -moz-box-shadow: -1px 0px 44px 15px rgba(0, 0, 0, 0.6);
    padding-left: 162px;
  }

  .team-expert img {
    position: absolute;
    border-radius: 50%;
    left: -11%;
    border: 5px solid #00c389;
  }

  .team-expert h4 {
    font-weight: 800;
    font-size: 30px;
    text-transform: capitalize;
    padding-top: 10px;
    padding-bottom: 15px;
    margin-bottom: 0;
  }

  .team-expert p {
    font-size: 16px;
  }

  .team-expert span {
    font-weight: bold;
  }

  .team-expert i {
    font-size: 20px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: white;
    background-color: #4e41ff;
    margin-right: 10px;
  }

  .team-expert a {
    font-weight: bold;
    text-transform: capitalize;
    margin-top: 34px;
  }

  /* 13. make-the */
  .make-the {
    text-align: center;
  }

  .make-the p {
    color: black;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: bold;
  }

  .make-the h2 {
    text-transform: uppercase;
    font-weight: 800;
    width: 55%;
    font-size: 60px;
    margin: auto;
    margin-bottom: 26px;
    margin-top: 26px;
  }

  /* 14. pricing-plans */
  .pricing-plans .heading h2 {
    width: 61%;
  }

  .pricing-plans-data i {
    background-color: #fff;
    width: 90px;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    padding: 23px;
    border-bottom-left-radius: 0;
  }

  .pricing-plans-data svg {
    fill: #8f5fb1;
  }

  .pricing-plans-data {
    background-color: #f3f6fa;
    padding: 40px;
    border-radius: 30px;
    position: relative;
    margin-top: 25px;
    margin-right: 30px;
  }

  .pricing-plans-data:before {
    position: absolute;
    width: 85%;
    top: -15px;
    height: 45px;
    content: "";
    left: 8%;
    border-radius: 26px;
    z-index: -1;
  }

  .pricing-plans-data h6 {
    font-size: 16px;
    color: black;
    font-weight: 600;
    padding-top: 30px;
  }

  .pricing-plans-data h3 {
    font-size: 40px;
    font-weight: 800;
  }

  .pricing-plans-data h3 span {
    font-size: 16px;
    padding-left: 15px;
    font-weight: 600;
  }

  .pricing-plans-data ul li .dots {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #a3aebc;
    margin-right: 15px;
  }

  .pricing-plans-data ul li {
    position: relative;
    color: #444;
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .pricing-plans-data ul {
    margin-top: 20px;
    margin-bottom: 24px;
  }

  .pricing-plans-data.two {
    margin-top: 95px;
    background-color: #0062ef;
  }

  .pricing-plans-data.two svg {
    fill: white;
  }

  .pricing-plans-data.two h3,
  .pricing-plans-data.two li,
  .pricing-plans-data.two h6 {
    color: white;
  }

  /* 15. questions */
  .questions-img img {
    border-radius: 400px;
  }

  .questions-img {
    position: relative;
  }

  .questions-img img.dots {
    border-radius: 0;
    left: -8%;
  }

  .asked-questions .headingline {
    margin: 0;
    margin-right: 40px;
    margin-left: 29px;
  }

  .heading h6 {
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  /* 16. accordion */
  .accordion {
    width: 100%;
    max-width: 75rem;
  }

  .accordion-item {
    position: relative;
    background-color: transparent;
    border: 0;
  }

  .accordion-item.active .icon:after {
    width: 0;
  }

  .accordion-item .heading {
    display: block;
    text-transform: capitalize;
    text-decoration: none;
    color: #04004d;
    font-weight: 700;
    font-size: 20px;
    position: relative;
    padding: 0.5rem 1.5rem 1.5rem 0rem;
    transition: 0.3s ease-in-out;
    padding-bottom: 10px;
  }

  .accordion-item .heading:hover .icon:before,
  .accordion-item .heading:hover .icon:after {
    background: #000000;
  }

  .accordion-item .icon {
    display: block;
    position: absolute;
    top: 47%;
    right: 0;
    width: 2rem;
    height: 2rem;
    transform: translateY(-50%);
    border-radius: 50%;
  }

  .accordion-item .icon:before,
  .accordion-item .icon:after {
    content: "";
    width: 20px;
    height: 3px;
    background: black;
    position: absolute;
    border-radius: 3px;
    left: 50%;
    top: 50%;
    transition: 0.3s ease-in-out;
    transform: translate(-50%, -50%);
  }

  .accordion-item.active .heading:hover .icon:before {
    background: #000;
  }

  .accordion-item .icon:after {
    transform: translate(-50%, -50%) rotate(90deg);
    z-index: -1;
  }

  .accordion-item .content {
    display: none;
  }

  .accordion-item .content p {
    margin-top: 0;
    color: #444;
    margin-bottom: 25px;
  }

  @media (min-width: 40rem) {
    .accordion-item .content {
      line-height: 1.75;
    }
  }

  .accordion-item.active {
    border-top: 5px solid #00c389 !important;
  }

  .accordion-item {
    border-top: 5px solid #d3d3d3 !important;
    padding-top: 14px;
    padding-bottom: 9px;
  }

  /* 17. clients-reviews */
  .clients-review .heading h2 {
    width: 100%;
  }

  .client-reviews img.clients {
    border-radius: 30px;
    margin-right: 40px;
  }

  .client-reviews i {
    left: 26%;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 6px;
  }

  .client-reviews {
    position: relative;
    margin-left: 60px;
    display: flex;
    align-items: center;
    margin-bottom: 50px;
  }

  .client-reviews h4 {
    font-size: 28px;
    font-weight: 800;
  }

  .client-reviews span {
    font-weight: 400;
    text-transform: uppercase;
  }

  .client-reviews h6 {
    font-weight: 400;
    line-height: 34px;
    margin-bottom: 40px;
    width: 89%;
  }

  .client-reviews img.dots {
    right: auto;
    left: -9%;
    bottom: 19%;
  }

  .client-reviews.two i {
    left: 23%;
    top: 7px;
  }

  /* 18. addres */
  .address svg {
    width: 40px;
    height: auto;
    display: block;
  }

  .address p {
    font-size: 16px;
  }

  .address i {
    position: relative;
    margin-left: 20px;
    display: block;
    z-index: 11;
  }

  .address i::before {
    top: -29%;
    position: absolute;
    content: "";
    width: 65px;
    height: 65px;
    background-color: #ccf3e7;
    border-radius: 50%;
    z-index: -1;
    left: -12px;
  }

  .address h6 {
    font-size: 18px;
    font-weight: bold;
    padding-top: 40px;
    padding-bottom: 20px;
    margin-bottom: 0;
  }

  .boder-line {
    display: block;
    width: 1px;
    height: 196px;
    background-color: #a3a3a3;
    margin: 0 70px;
  }

  .location {
    display: flex;
    background-color: white;
    justify-content: space-between;
    box-shadow: -1px 0px 44px 15px rgb(0 0 0 / 4%);
    -webkit-box-shadow: -1px 0px 44px 15px rgb(0 0 0 / 4%);
    -moz-box-shadow: -1px 0px 44px 15px rgba(0, 0, 0, 0.4);
    border-radius: 40px;
    padding: 90px;
    position: relative;
    margin-top: 25px;
    z-index: 11;
  }

  .location:before {
    position: absolute;
    width: 90%;
    top: -25px;
    height: 25px;
    content: "";
    left: 5%;
    border-radius: 26px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .address a {
    color: #444;
    padding-left: 10px;
  }

  /* 19. footer */
  footer {
    position: relative;
    text-align: center;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
  }

  footer:before {
    top: 0;
    position: absolute;
    content: "";
    width: 100%;
    height: 100%;
    background-color: #0062ef;
    opacity: .9;
    left: 0;
  }

  .book-free {
    position: relative;
    padding-bottom: 70px;
    border-bottom: 7px solid #844db6;
  }

  .book-free h2 {
    color: white;
    font-weight: 800;
  }

  .book-free p {
    color: white;
    padding-bottom: 40px;
  }

  footer {
    position: relative;
    text-align: center;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    padding-top: 279px;
    margin-top: -210px;
  }

  p.footer {
    color: white;
    position: relative;
    font-weight: bold;
    padding: 40px 0;
  }

  .book-free img {
    padding-bottom: 25px;
  }

  .owl-theme .owl-nav.disabled+.owl-dots {
    display: none;
  }

  input[type=checkbox]:after {
    content: "";
    border-bottom: 10px solid red;
    border-top: 10px solid red;
    display: block;
    opacity: 1;
  }

  input[type=checkbox]:checked:after {
    border-bottom: 10px solid blue;
    border-top: 10px solid blue;
  }

  footer ul {
    display: flex;
    justify-content: center;
    margin-top: 40px;
  }

  footer ul li a {
    color: #fff;
    font-weight: 600;
    text-transform: capitalize;
  }

  footer ul li a i {
    padding-right: 10px;
    font-size: 18px;
  }

  footer ul li {
    padding-right: 70px;
  }


  /* 20. hero-section.three */
  .hero-section.three .hero-section-text {
    margin-bottom: 256px;
    padding-top: 30px;
  }

  .hero-section.three .video {
    display: flex;
    justify-content: center;
  }

  .hero-section.three form {
    display: flex;
    justify-content: center;
  }

  .hero-section.three img.landing-slider {
    bottom: -64%;
    left: 69%;
    transform: rotate(49deg);
  }

  .hero-section.three:before,
  .hero-section.three:after {
    width: 2258px;
    height: 1153px;
    top: -80%;
    left: -7%;
  }

  .hero-section.three img.dots {
    bottom: 48%;
    right: 31%;
  }

  .hero-section.three form input {
    width: 71%;
    height: 60px;
    border-radius: 40px;
    border: 0;
    outline: 0;
    margin-right: 10px;
    padding-left: 30px;
  }

  .hero-section-text.three>h3,
  .hero-section-text.three>h6 {
    color: white;
  }

  .hero-section-text.three>h3 {
    padding-bottom: 30px;
    font-size: 26px;
  }

  /* 21. hero-section-text two */
  .hero-section.two .hero-section-text h4 {
    color: white;
  }

  .hero-section.two .video {
    display: flex;
    justify-content: end;
  }

  .hero-section.two .review {
    margin-bottom: 124px;
  }

  .hero-section.two .hero-section-text p {
    width: 100%;
    padding-bottom: 0;
  }

  .hero-section.two .hero-section-text {
    position: relative;
    margin-top: 40px;
  }

  .hero-section.two .hero-section-text p {
    width: 100%;
    padding-bottom: 21px;
  }

  .hero-section.two:before,
  .hero-section.two:after {
    top: -81%;
    height: 1088px;
    width: 2248px;
  }

  .hero-section.two img.landing-slider {
    bottom: 11%;
    left: 118%;
    transform: rotate(76deg);
  }

  .hero-section.three .hero-section-text p {
    color: #e3e2e2;
    padding-bottom: 25px;
    width: 84%;
    padding-top: 10px;
  }

  /* 22. video hero-section-4 */
  .o-video {
    width: 100%;
    height: 0;
    position: relative;
    padding-top: 56.25%;
  }

  .o-video>iframe {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border: 0;
  }

  .hero-section-text.for h1 {
    width: 80%;
    margin: auto;
  }

  /* 23. swal-modal */
  .swal-modal {
    BACKGROUND: #0062ef;
    border-radius: 20px;
    padding-top: 80px;
    padding-bottom: 80px;
  }

  .swal-icon--success__hide-corners,
  .swal-icon--success:after,
  .swal-icon--success:before {
    background-color: transparent !important;
  }

  .swal-text {
    text-align: center;
    color: #fff;
  }

  .swal-footer {
    display: none;
  }

  .swal-title {
    color: #fff;
    font-family: 'Poppins';
    font-size: 45px;
    margin: 0px !IMPORTANT;
  }

  .swal-text {
    text-align: center;
    color: #fff;
    FONT-SIZE: 16PX;
    PADDING: 0PX 42PX;
  }

  .swal-title {
    MARGIN: 0PX;
    PADDING: 0PX;
  }

  .swal-modal:before {
    position: absolute;
    width: 85%;
    top: -15px;
    height: 15px;
    content: "";
    left: 8%;
    border-radius: 78px;
    z-index: -21;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  p.footer a {
    color: white;
  }

  /* 24. hero-section.for */
  .hero-section.two img.dots {
    position: absolute;
    z-index: 0;
    bottom: 52%;
    right: 19%;
  }

  .hero-section.three .hero-section-text h1 {
    width: 86%;
  }

  .hero-section.two .hero-section-text h1 {
    font-size: 52px;
  }

  .hero-section.three.for .hero-section-text h1 {
    width: 100%;
  }

  .hero-section.three.for img.dots {
    bottom: 46%;
    right: 34%;
  }

  .hero-section.three.for img.landing-slider {
    bottom: -50%;
    left: 25%;
    transform: rotate(283deg);
  }

  /* 25. back to top button */
  #button {
    display: inline-block;
    width: 40px;
    height: 40px;
    text-align: center;
    border-radius: 4px;
    position: fixed;
    bottom: 30px;
    right: 30px;
    transition: background-color 0.3s, opacity 0.5s, visibility 0.5s;
    opacity: 0;
    visibility: hidden;
    z-index: 1000;
    background-color: #00c389;
  }

  #contact-form {
    padding: 22px 30px;
  }

  #button::after {
    content: "\f077";
    font-family: FontAwesome;
    font-weight: normal;
    font-style: normal;
    font-size: 20px;
    line-height: 44px;
    color: #fff;
  }

  #button:hover {
    cursor: pointer;
    background-color: #333;
  }

  #button:active {
    background-color: #555;
  }

  #button.show {
    opacity: 1;
    visibility: visible;
  }

  .call-ico img {
    width: 25px;
  }

  .group-img select {
    width: 100%;
    height: 60px;
    border: 0;
    border-radius: 12px;
    outline: 0;
    margin-bottom: 20px;
    padding-left: 30px;
    color: #444;
    font-size: 16px;
    padding-right: 86px;
    box-shadow: 0px 0px 20px 7px rgba(0, 0, 0, 0.08);
    -webkit-box-shadow: 0px 0px 20px 7px rgba(0, 0, 0, 0.08);
    border: 1px solid #d3d3d3;
    background-color: #fff;
  }


  select {


    padding: 0.5em 3.5em 0.5em 1em;

    /* reset */

    margin: 0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-appearance: none;
    -moz-appearance: none;
  }

  .group-img img {
    position: absolute;
    right: 30px;
    width: 24px;
    height: auto;
    top: 21px;
  }

  .modal-body form {
    margin: 0;
    padding: 20px;
  }

  .modal-content {
    background: transparent;
    border: none;
    box-shadow: none !important;
  }

  .btn-close {
    float: right;
    margin-left: 40px;
    font-size: 22px;
    color: #04004d !important;
    opacity: 1;
  }

  .btn.batton.b {
    float: right;
  }

  .state img {
    width: 60px;
    height: 60px;
  }

  @media  only screen and (max-width: 768px) {
    #home {
      padding-top: 60px !important;
    }
  }

  .batton.x {
    padding: 8px 20px;
  }

  .float.x {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 75px;
    right: 40px;
    background-color: #25d366;
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.1);
    z-index: 100;
  }

  .my-float {
    margin-top: 16px;
  }

  .float.x img {
    margin-top: 6px;
    margin-left: 3px;
  }

  .partner-logo img {
    width: 100%;
    /*height: 65px;*/
  }

  .d-flax.partners {
    padding: 90px 0;
  }

  .ch-t {
    margin-left: 15px;
    color: #fff;
    font-weight: 600;
  }

  /*<a href="https:// Flippingo.com"><li class="batton x">Back to Main Website</li></a>*/

  .accordion {
    margin-top: 1.875rem;
  }

  .accordion .accordion-item {
    background-color: white;
    color: #1b1d21;
    border-radius: 0.5rem;
    border: 1px solid #f7f7f7;
    margin-bottom: 1.875rem;
  }

  .accordion .accordion-item.active {
    box-shadow: 0 0.0625rem 0.9375rem 0 rgba(27, 29, 33, 0.15);
  }

  .accordion .accordion-item.active .accordion-body {
    max-height: max-content;
  }

  .accordion .accordion-item.active .accordion-header::after {
    transform: rotate(90deg);
  }

  .accordion .accordion-item:last-child {
    margin-bottom: 0;
  }

  .accordion .accordion-item .accordion-header {
    padding: 1.5625rem;
    font-size: 1.125rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    position: relative;
    cursor: pointer;
    padding-right: 40px;
  }

  .accordion .accordion-item .accordion-header::after {
    content: "ï„…";
    font-size: 2rem;
    font-family: "FontAwesome";
    position: absolute;
    right: 1.5rem;
    transition: all 0.2s ease-in-out;
    transform: rotate(0deg);
  }

  .accordion .accordion-item .accordion-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
  }

  .accordion .accordion-item .accordion-body .accordion-body-content {
    padding: 0 1.5rem 1.5rem;
    font-size: 0.875rem;
    line-height: 2rem;
  }

  .accordion-body {
    padding: 0 !important;
  }

  .container.faqss {
    padding-bottom: 120px;
  }

  .btn-wh {
    margin: 10px 30px;
  }

  /*.bttn {*/
  /*	background-color: #67299d;*/
  /*	padding: 10px;*/
  /*	border-radius: 100px;*/
  /*	width: 195px;*/
  /*}*/
  /*.bttn a {*/
  /*background-color: #fff;*/
  /*	padding: 15px 10px;*/
  /*	margin-left: -6px;*/
  /*	border-radius: 100px;*/
  /*}*/
  /*.bttn a i img {*/
  /*	width: 27px !important;*/
  /*}*/
  .hero-section {
    padding-bottom: 30px;
  }

  @media (max-width: 990px) {
    .btn-wh {
      margin: auto;
    }
  }

  .btn-wh img {
    width: 100%;
  }

  @media (max-width: 504px) {
    .desk-v {
      display: none;
    }
  }

  .mobile-v {
    display: none;
  }

  @media (max-width: 504px) {
    .mobile-v {
      display: flex;
    }
  }

  .bg-t {
    display: flex;
    background-color: #51049c !important;
    border-radius: 100px;
    margin: 0;
  }

  /*.bttn.w {*/
  /*	padding: 0;*/
  /*}*/
  /*.bttn.w a {*/
  /*	padding: 0;*/
  /*	background-color:transparent !important;*/
  /*}*/
  .bttn.w img {
    width: 100% !important;
  }

  /*.bttn.w {*/
  /*	background-color: #00be85;*/
  /*}*/
  /*.bttn {*/
  /*	background-color: #00be85;*/
  /*}*/
  /*thankyou page*/

  .m-a .col-xl-6 {
    margin: auto;
  }

  .row.mobile-v.b {
    display: flex !important;
  }

  .sucess {
    padding-top: 180px;
    /*margin-bottom: 100px;*/
  }

  .bth {
    text-align: center;
    margin-top: 10px;
  }

  .text-desc {
    font-weight: 400 !important;
    text-align: center;
  }

  .thy-h {
    background-color: #6415a6f7;
    padding-bottom: 22px;
  }

  .row.mobile-v.b img {
    width: 280px;
  }

  @media (max-width: 990px) {
    .row.mobile-v.b img {
      width: 100%;
    }
  }



  .testimonial-container {
    width: 100%;
    max-width: 56rem;
    padding: 2rem;
    /* margin-top: 40px; */
    margin: auto;
  }

  .testimonial-grid {
    display: grid;
    gap: 5rem;
  }

  .image-container {
    position: relative;
    width: 100%;
    height: 24rem;
    perspective: 1000px;
  }

  .testimonial-image {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 1.5rem;
    transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  }

  .testimonial-content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .name {
    font-size: 1.5rem;
    font-weight: bold;
    color: #000;
    margin-bottom: 0.25rem;
  }

  .designation {
    font-size: 0.875rem;
    color: #6b7280;
    margin-bottom: 2rem;
  }

  .quote {
    font-size: 1.125rem;
    color: #4b5563;
    line-height: 1.75;
  }

  .arrow-buttons {
    display: flex;
    gap: 1rem;
    padding-top: 3rem;
  }

  .arrow-button {
    width: 1.75rem;
    height: 1.75rem;
    border-radius: 50%;
    background-color: #141414;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .arrow-button:hover {
    background-color: #00a6fb;
  }

  .arrow-button svg {
    width: 1.25rem;
    height: 1.25rem;
    fill: #f1f1f7;
    transition: transform 0.3s;
  }

  .arrow-button:hover svg {
    fill: #ffffff;
  }

  .prev-button:hover svg {
    transform: rotate(-12deg);
  }

  .next-button:hover svg {
    transform: rotate(12deg);
  }

  @media (min-width: 768px) {
    .testimonial-grid {
      grid-template-columns: 1fr 1fr;
    }

    .arrow-buttons {
      padding-top: 0;
    }
  }
</style>

<style>
  .wishlist-page {
    width: 93%;
    margin: auto;
    margin-top: 30px;
    background: #000;
  }

  .wishlist-card {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 15px;
    margin-top: 40px;
    padding-bottom: 50px;
  }

  .product-details-hover h3 {
    font-size: 18px !important;
    font-weight: 600;
    height: 70px;
    overflow: hidden;
  }

  .wishlist-product-card {
    width: 100%;
    height: auto;
    padding: 8px;
    border-radius: 16px;

    /* ðŸ”¥ Glassmorphism */
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);

    transition: all 0.3s ease-in-out;
  }


  .wishlist-product-card:hover {
    background: rgba(255, 255, 255, 0.28);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    transform: translateY(-3px);
  }


  .wishlist-product-card img {
    width: 100%;
    height: 270px;
  }

  .wishlist-budge {
    position: relative;
    top: -145px;
    left: 6px;
  }

  .budge-active {
    width: fit-content;
    padding: 2px 10px;
    background-color: #0080002b;
    color: green;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 4px;
  }

  .budge-active p {
    margin: 0;
  }

  .budge-soldout p {
    background-color: #dc3545;
    color: #fff;
    border-radius: 20px;
    padding: 3px 10px;
    font-size: 14px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }


  .wishlist-button {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;

  }

  .wishlist-price h2 {
    font-size: 22px;
  }

  .wishlist-price h2 i {
    font-size: 20px !important;
    padding-right: 5px;
  }

  .wishlist-price button {
    font-size: 18px;
  }

  .wishlist-button p {
    font-size: 13px;
    text-align: start;
    width: 100%;
    border-radius: 5px;
    margin: 0;
    padding: 0px 10px;
    /* border: 1px solid lightgray; */
    background: #ffffff;
  }

  .wishlist-button .budge-active1 p {
    width: fit-content;
    padding: 2px 10px;
    background-color: #0080002b;
    color: green;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 4px;
  }

  .wishlist-item-card {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 5px;
    margin-top: 10px;
  }

  /* Odd items last → full width */
  .wishlist-item-card>div:nth-last-child(1):nth-child(odd) {
    grid-column: span 2;
  }

  /* When only 2 items → both full width */
  .wishlist-item-card.two-items>div {
    grid-column: span 2 !important;
  }

  .card-preview-box {
    background: rgba(255, 255, 255, 0.95);
    /* Almost white */
    padding: 10px;
    border-radius: 10px;
    margin-top: -20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
  }

  .card-preview-box p,
  .card-preview-box span {
    color: #000 !important;
    font-size: 12px;
    line-height: 16px;
  }



  .wishlist-left {
    width: 100%;
    height: 60px;
    background-color: #ffffff99;
    border-radius: 3px;
    padding: 10px;
    display: flex;
    align-items: center;
    gap: 5px;

  }

  .wishlist-price button {
    background-color: #000;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 0px 20px;
  }

  .product-details-hover {
    padding: 10px;
    display: block;
    margin-top: -26px;
    /* Default visible */
    /*transition: opacity 0.3s ease;*/
    /*margin-top: -20px;*/
  }

  /*.wishlist-product-card:hover .product-details-hover {*/
  /*  display: none;*/

  /*}*/

  .more-info {
    display: none;
    padding: 10px;
    margin-top: -20px;
    /* position: absolute;
            bottom: 0;
            left: 0;
            width: 100%; */
    /* background: white;
            padding: 10px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1); */
    text-align: left;
    z-index: 1;
    /* Ensure it stays above other content */
    transition: transform 0.3s ease;
    transform: translateY(100%);
  }

  .wishlist-product-card:hover .more-info {
    display: block;
    transform: translateY(0);
  }

  @keyframes  slideUp {
    from {
      transform: translateY(100%);
    }

    to {
      transform: translateY(0);
    }
  }

  #categories-list {
    /*display: flex;*/
    /*flex-wrap: wrap;*/
    /* allow multiple rows */
    gap: 20px;
    /* spacing between items */
    justify-content: center;
    /* center the row */
  }

  .social-media-icon-section {
    /*flex: 1 1 calc(100% / 7 - 20px);*/
    /* 7 items per row minus gap */
    /*max-width: calc(100% / 7 - 20px);*/
    text-align: center;
  }

  .s-image-card img {
    width: 100%;
    height: auto;
    display: block;
    margin: 0 auto 10px;
  }

  .s-image-card {
    width: 100%;
    height: 150px;
    display: flex;
    border-radius: 4px;
    background-color: #fff;
    padding: 28px !important;
    justify-content: center;
    align-items: center;
    box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
  }

  .tabs-wrapper {
    display: flex;
    align-items: center;
    position: relative;
    max-width: 100%;
    overflow: hidden;
  }

  .tabs-container {
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    gap: 10px;
    scrollbar-width: none;
    /* Firefox */
  }

  .tabs-container::-webkit-scrollbar {
    display: none;
    /* Chrome, Safari */
  }

  .tab-btn {
    white-space: nowrap;
    padding: 10px 15px;
    border: none;
    background: #f3f3f3;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
  }

  .scroll-btn {
    background: black;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    font-size: 18px;
  }

  .scroll-btn.prev {
    margin-right: 5px;
  }

  .scroll-btn.next {
    margin-left: 5px;
  }

  .text-slider {
    /*text-align: center;*/
    /*border-bottom: 2px solid #000;*/
    display: inline-block;
  }

  .text-slider h1 {
    color: white;
    font-weight: 700;
    font-size: 35px;
    margin: 0;
    display: flex;
    flex-direction: column;
    /*justify-content: center;*/
    gap: 8px;
  }

  #slider-content {
    display: inline-block;
    overflow: hidden;
    height: 63px;
    /* adjust as per font size */
    vertical-align: bottom;
  }

  #slider-content span {
    /*margin-left:63px;*/
    /*margin-bottom:10px;*/
    width: fit-content;
    display: block;
    line-height: 55px;
    border-bottom: 2px solid #fff;
    animation: slideText 10s infinite;
  }


  #slider-content span a {
    color: #fff !important;
  }

  @keyframes  slideText {
    0% {
      transform: translateY(0%);
    }

    15% {
      transform: translateY(0%);
    }

    20% {
      transform: translateY(-100%);
    }

    35% {
      transform: translateY(-100%);
    }

    40% {
      transform: translateY(-200%);
    }

    55% {
      transform: translateY(-200%);
    }

    60% {
      transform: translateY(-300%);
    }

    75% {
      transform: translateY(-300%);
    }

    80% {
      transform: translateY(-400%);
    }

    100% {
      transform: translateY(-400%);
    }
  }

  .right-form-card {
    width: 90% !important;
    height: fit-content;
  }

  .review-section {
    height: fit-content;
  }

  .section--padding {
    padding-top: 50px !important;
    padding-bottom: 70px;
  }

  .section-padding {
    padding-top: 50px !important;
    padding-bottom: 50px !important;
  }

  .flippingonew-inner-search {
    position: relative;
    z-index: 9;
  }

  .flippingonew-inner-dropdown {
    position: absolute;
    top: 110%;
    left: 0;
    width: 100%;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    overflow: hidden;
  }

  .flippingonew-inner-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    cursor: pointer;
    transition: 0.25s;
    border-bottom: 1px solid #f1f1f1;
  }

  .flippingonew-inner-item:last-child {
    border-bottom: none;
  }

  .flippingonew-inner-item:hover {
    background: #f5f8ff;
  }

  .flippingonew-inner-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
  }

  .flippingonew-inner-title {
    font-size: 15px;
    font-weight: 600;
    color: #333;
  }

  .social-media-icon-section p {
    position: relative;
    top: -208px;
    left: 5px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid #80808038;
    width: fit-content;
    padding: 0px 10px;
    border-radius: 4px;
  }

  .sec__desc {
    font-size: 16px;
    color: #555;
    max-width: 100% !important;
    margin-left: 0px;

  }

  /* ===== SLIDER WRAPPER ===== */
  .flippingonew-slider-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
  }

  /* ===== SLIDER TRACK ===== */
  .flippingonew-slider-track {
    display: flex;
    gap: 14px;
    overflow: hidden;
    scroll-behavior: smooth;
    width: 100%;
    padding: 20px 0px;
  }

  /* ===== CARD ===== */
  .flippingonew-slider-card {
    min-width: 135px;
    background: #ffffff;
    border-radius: 14px;
    padding: 14px 10px 16px;
    text-align: center;
    position: relative;
    /*box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);*/
    border: 1px solid #8080804a;
    transition: all 0.25s ease;
    text-decoration: none;
    color: inherit;
  }

  .flippingonew-slider-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.14);
  }

  /* ===== LISTING BADGE ===== */
  .flippingonew-listing-badge {
    position: absolute;
    top: 8px;
    left: 8px;
    font-size: 11px;
    background: #eef2ff;
    color: #1d4ed8;
    padding: 3px 7px;
    border-radius: 6px;
    font-weight: 600;
    line-height: 1;
  }

  /* ===== IMAGE ===== */
  .flippingonew-slider-image {
    width: 60px;
    height: 60px;
    margin: 26px auto 10px;
    background: #f5f7ff;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .flippingonew-slider-image img {
    max-width: 40px;
    max-height: 40px;
    object-fit: contain;
  }

  /* ===== TITLE ===== */
  .flippingonew-slider-title {
    font-size: 14px;
    font-weight: 600;
    margin: 6px 0 0;
    line-height: 1.3;
    color: #111827;
  }

  /* ===== SLIDER BUTTONS ===== */
  .flippingonew-slider-btn {
    background: #ffffff;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    font-size: 16px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .flippingonew-slider-btn:hover {
    background: #2563eb;
    color: #ffffff;
  }

  /* ===== MOBILE ===== */
  @media (max-width: 768px) {
    .flippingonew-slider-card {
      min-width: 120px;
    }

    .flippingonew-slider-btn {
      display: none;
    }
  }

  .filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 25px;
  }

  /* Left section */
  .filter-left {
    display: flex;
    align-items: center;
    gap: 15px;
  }

  /* Right section */
  .filter-right {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  /*.filter-select {*/
  /*    padding: 10px 14px;*/
  /*    border-radius: 8px;*/
  /*    border: 1px solid #ccc;*/
  /*    min-width: 190px;*/
  /*    font-size: 15px;*/
  /*}*/
  .filter-select {
    padding: 9px 48px 9px 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
    min-width: 200px;
    font-size: 16px;
    background: #fff url("data:image/svg+xml;utf8,<svg fill='black' height='18' viewBox='0 0 24 24' width='18' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>") no-repeat right 14px center;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
    background-size: 18px;
  }

  .filter-select:hover {
    border-color: #999;
  }

  .filter-select:focus {
    outline: none;
    border-color: #000;
  }


  .quick-categories {
    display: flex;
    gap: 10px;
  }

  .tab-btn,
  .filter-btn {
    padding: 8px 16px;
    border-radius: 8px;
    border: 1px solid #d9d9d9;
    background: #f7f7f7;
    cursor: pointer;
    font-size: 15px;
  }

  .tab-btn.active,
  .filter-btn.active {
    background: #000;
    /* or your primary color */
    color: #fff;
    /*border-color: #000;*/
  }


  .tab-btn.active {
    background: #000;
    color: #fff;
  }

  /* Wrapper */
  .wishlist-image-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    border-radius: 10px;
  }


  /* Slider container */
  .wishlist-main-slider {
    display: flex;
    height: 100%;
    width: 100%;
    transition: transform 0.4s ease;
  }

  /* Each image */
  .wishlist-main-slider .slide-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /*flex-shrink: 0;*/
  }

  /* Arrows (hidden initially) */
  .wishlist-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
    color: #fff;
    background: rgba(0, 0, 0, 0.4);
    padding: 8px 10px;
    border-radius: 50%;
    opacity: 0;
    pointer-events: none;
    transition: 0.3s;
    cursor: pointer;
  }

  .wishlist-prev {
    left: 10px;
  }

  .wishlist-next {
    right: 10px;
  }

  /* Hover â†’ show carousel controls */
  .wishlist-image-wrapper:hover .wishlist-nav {
    opacity: 1;
    pointer-events: auto;
  }

  .dropdown-menu {
    height: 260px;
    overflow-y: auto;
  }

  .flippingo-video-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;
    /* 16:9 = 9/16 = 0.5625 */
    height: 0;
    overflow: hidden;
    background: #000;
    /* fallback dark bg if video fails to load */
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .flippingo-video-wrapper img,
  .flippingo-video-wrapper video,
  .flippingo-video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    object-fit: cover;
    /* for images/videos – fills nicely */
  }

  /* Optional: nicer hover effect */
  .flippingo-video-wrapper:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }

  /* Parent wrapper (like switch track) */
  /* Wrapper for switch + label */
  .switch-container {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-right: 15px;
  }

  /* The switch body */
  .custom-switch {
    width: 46px;
    height: 24px;
    background: #dcdcdc;
    border-radius: 20px;
    position: relative;
    cursor: pointer;
    transition: 0.3s ease-in-out;
  }

  /* The round circle */
  .custom-switch::after {
    content: "";
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    position: absolute;
    left: 2px;
    top: 2px;
    transition: 0.3s ease-in-out;
  }

  /* ACTIVE STATE (your JS adds .active on .filter-btn) */
  .custom-switch.active {
    background: #22c36b;
  }

  .custom-switch.active::after {
    transform: translateX(22px);
  }

  .switch-label {
    font-size: 15px;
    color: #444;
    font-weight: 500;
  }

  .review-sectio-host .review-card {
    height: 120px !important;
    padding: 11px !important;
  }

  .review-source {
    font-weight: bold;
    margin-bottom: 7px !important;
    font-size: 18px;
  }

  .review-sectio-host .review-card {
    background: #fefefed8 !important;
  }
  .hero-section-form{
      display:flex;
      justify-content:end;
  }
   @media (max-width: 540px) {
    .top-header {
      display:none;
    }
    .hero-section{
        margin-top:0px !important;
    }
    .hero-section-form{
      display:flex;
      justify-content:center;
  }
  }
  .flippingonew-slider-track {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    overflow: hidden;
    scroll-behavior: smooth;
    width: 100%;
    padding: 20px 0px;
}
.text-slider h1 {
    color: white;
    font-weight: 700;
    font-size: 20px;
    margin: 0;
    display: flex;
    flex-direction: column;
    /* justify-content: center; */
    gap: 8px;
}
.right-form-card {
    width: 100% !important;
    height: fit-content;
}
/* Mobile filter open button */
.gv-filter-open-btn {
    display: none;
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border-radius: 10px;
    border: 1px solid #ddd;
    background: #fff;
    margin-bottom: 15px;
}

@media (max-width: 768px) {
    .gv-filter-open-btn {
        display: block;
    }
    .quick-categories {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.filter-left {
    width:100%;
    display: flex;
    flex-direction: column;
    align-items: start;
    gap: 15px;
}
.filter-select {
    width: 100% !important;
}
.quick-categories {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
}

/* Backdrop */
.gv-filter-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    opacity: 0;
    pointer-events: none;
    transition: 0.3s;
    z-index: 9998;
}

/* Bottom sheet container */
.gv-bottomsheet {
    position: fixed;
    left: 0;
    right: 0;
    bottom: -100%;
    background: #fff;
    border-radius: 20px 20px 0 0;
    padding: 15px 18px;
    height: 80vh;
    overflow-y: auto;
    transition: 0.35s ease-out;
    z-index: 9999;
}

/* Active states */
.gv-bottomsheet.show {
    bottom: 0;
}

.gv-filter-backdrop.show {
    opacity: 1;
    pointer-events: auto;
}

/* Header */
.gv-bottomsheet-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
        border-bottom: 1px solid gray;
    padding-bottom: 10px;
}

.gv-bottomsheet-header h3 {
    margin: 0;
    font-size: 26px;
    font-weight: 600;
}

.gv-bottomsheet-close {
    border: none;
    background: transparent;
    font-size: 30px;
    line-height: 20px;
}

</style>


<?php $__env->startSection('content'); ?>

  <!-- ================================
                                                                                                                                                START HERO-WRAPPER AREA
                                                                                                                                                ================================= -->
  <!-- <section class="hero-wrapper hero-bg">
                                                                                                                                                <div class="overlay"></div>

                                                                                                                                                <div class="container">
                                                                                                                                                  <div class="hero-heading text-center">
                                                                                                                                                  <h2 class="sec__title text-white cd-headline zoom">
                                                                                                                                                  What are you interested in
                                                                                                                                                  <span class="cd-words-wrapper">
                                                                                                                                                  <b class="is-visible">Monetized Website</b>
                                                                                                                                                  <b>Mobile Applications</b>
                                                                                                                                                  <b>Adwords Accounts</b>
                                                                                                                                                  <b>Facebook </b>
                                                                                                                                                  <b>Instagram</b>
                                                                                                                                                  <b>Telegram Groups</b>

                                                                                                                                                  </span>
                                                                                                                                                  </h2>

                                                                                                                                                  </div>
                                                                                                                                                  <div class="highlighted-categories text-center mt-5">
                                                                                                                                                  <p class="highlighted__title text-white">
                                                                                                                                                  Or browse featured categories:
                                                                                                                                                  </p>
                                                                                                                                                  <div class="highlight-lists d-flex flex-wrap justify-content-center mt-4">
                                                                                                                                                  <a href="#" class="highlight-category">
                                                                                                                                                  <span class="fal fa-building icon-element d-block mx-auto"></span>
                                                                                                                                                  Monetized Website
                                                                                                                                                  </a>
                                                                                                                                                  <a href="#" class="highlight-category">
                                                                                                                                                  <span class="fal fa-utensils icon-element d-block mx-auto"></span>
                                                                                                                                                  Mobile Applications
                                                                                                                                                  </a>
                                                                                                                                                  <a href="#" class="highlight-category">
                                                                                                                                                  <span class="fal fa-plane icon-element d-block mx-auto"></span>
                                                                                                                                                  Adwords Accounts
                                                                                                                                                  </a>
                                                                                                                                                  <a href="#" class="highlight-category">
                                                                                                                                                  <span class="fal fa-music icon-element d-block mx-auto"></span>
                                                                                                                                                  Facebook 
                                                                                                                                                  </a>
                                                                                                                                                  <a href="#" class="highlight-category">
                                                                                                                                                  <span class="fal fa-dumbbell icon-element d-block mx-auto"></span>
                                                                                                                                                  Instagram
                                                                                                                                                  </a>
                                                                                                                                                  <a href="#" class="highlight-category">
                                                                                                                                                  <span class="fal fa-hotel icon-element d-block mx-auto"></span>
                                                                                                                                                  Telegram Groups
                                                                                                                                                  </a>
                                                                                                                                                  </div>
                                                                                                                                                  </div>

                                                                                                                                                </div>

                                                                                                                                                </section> -->
  <?php
    $hero = $homePageContent['hero'] ?? null;
  ?>
  <section class="hero-section" id="home">
    <div class="container">
      <div class="row ">
        <div class="col-xl-7">
          <div class="hero-section-text">
            <!--<h1>#1 Platform to Buy & Sell Digital Assets</h1>-->
            <div class="text-slider">
              <h1><?php echo e($hero->title ?? 'Explore Top Digital Assets'); ?>


                <span id="slider-content">
                  <?php $__currentLoopData = $heroCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span>
                      <a href="<?php echo e(route('listing-list', ['category' => $category->slug])); ?>" class="category-link">
                        <?php echo e($category->name); ?>

                      </a>
                    </span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
              </h1>
            </div>


            <p>
              <?php echo e($hero->description ?? 'Discover the most in-demand categories, from social accounts to apps, blogs, and more.'); ?>

            </p>
            <div class="video">

              <!-- Modal -->
              <div class="modal fade" id="formmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-body">
                      <form role="form" class="get-a-quote" id="contact-form" method="post">
                        <div class="mb-lg-2 mb-2 d-flex align-items-center">

                          <div>
                            <h2>Search Listing</h2>
                          </div>

                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="group-img">
                          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M15.364 11.636C14.3837 10.6558 13.217 9.93013 11.9439 9.49085C13.3074 8.55179 14.2031 6.9802 14.2031 5.20312C14.2031 2.33413 11.869 0 9 0C6.131 0 3.79688 2.33413 3.79688 5.20312C3.79688 6.9802 4.69262 8.55179 6.05609 9.49085C4.78308 9.93013 3.61631 10.6558 2.63605 11.636C0.936176 13.3359 0 15.596 0 18H1.40625C1.40625 13.8128 4.81279 10.4062 9 10.4062C13.1872 10.4062 16.5938 13.8128 16.5938 18H18C18 15.596 17.0638 13.3359 15.364 11.636ZM9 9C6.90641 9 5.20312 7.29675 5.20312 5.20312C5.20312 3.1095 6.90641 1.40625 9 1.40625C11.0936 1.40625 12.7969 3.1095 12.7969 5.20312C12.7969 7.29675 11.0936 9 9 9Z"
                              fill="#555555"></path>
                          </svg>
                          <input type="text" name="name" placeholder="Full Name" required="">
                        </div>
                        <div class="group-img">
                          <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M15.8649 18H6.13513C2.58377 18 0.540527 15.9568 0.540527 12.4054V5.5946C0.540527 2.04324 2.58377 0 6.13513 0H15.8649C19.4162 0 21.4595 2.04324 21.4595 5.5946V12.4054C21.4595 15.9568 19.4162 18 15.8649 18ZM6.13513 1.45946C3.35242 1.45946 1.99999 2.81189 1.99999 5.5946V12.4054C1.99999 15.1881 3.35242 16.5406 6.13513 16.5406H15.8649C18.6476 16.5406 20 15.1881 20 12.4054V5.5946C20 2.81189 18.6476 1.45946 15.8649 1.45946H6.13513Z"
                              fill="#444444"></path>
                            <path
                              d="M10.9988 9.8465C10.1815 9.8465 9.35452 9.59352 8.72208 9.07785L5.67668 6.64539C5.36532 6.39241 5.30696 5.93511 5.55992 5.62376C5.8129 5.31241 6.2702 5.25403 6.58155 5.50701L9.62695 7.93947C10.3664 8.53298 11.6215 8.53298 12.361 7.93947L15.4064 5.50701C15.7178 5.25403 16.1848 5.30268 16.428 5.62376C16.681 5.93511 16.6324 6.40214 16.3113 6.64539L13.2659 9.07785C12.6432 9.59352 11.8161 9.8465 10.9988 9.8465Z"
                              fill="#444444"></path>
                          </svg>
                          <input type="text" name="email" placeholder="Email Address" required="">
                        </div>
                        <div class="group-img">
                          <svg fill="none" height="112" viewBox="0 0 24 24" width="112"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-rule="evenodd" fill="rgb(0,0,0)" fill-rule="evenodd">
                              <path
                                d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z">
                              </path>
                              <path
                                d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z">
                              </path>
                              <path
                                d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z">
                              </path>
                            </g>
                          </svg>
                          <input type="text" name="mobile" placeholder="Mobile Number"
                            oninput="this.value = this.value.replace(/[^0-9-+]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                            maxlength="10" minlength="8" required="">
                          <input type="hidden" name="form_type" value="button">
                        </div>
                        <div class="group-img">
                          <img src="<?php echo e(asset('site_assets')); ?>/img/dropdown.svg">
                          <select id="#" class="minimal" name="course">
                            <option value="Websites">Websites</option>

                            <option value="Theme And Scripts">Theme And Scripts</option>
                            <option value="Twitter Account">Twitter Account</option>
                            <option value="Instagram Pages">Instagram Pages</option>
                            <option value="Facebook Account">Facebook Account</option>

                            <option value="Facebook Account">Telegram Account</option>
                            <option value="Facebook Account">Youtube Channel</option>

                          </select>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <button type="submit" name="submit" class="btn batton">Submit</button>
                          </div>
                          <div class="col-6">
                            <button type="button" class="btn batton b" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </form>

                    </div>

                  </div>
                </div>
              </div>

            </div>
            <div class="review-section">
              <div class="swiper reviewSwiper">
                <div class="swiper-wrapper">
                  <div class="review-sectio-host">
                    <div class="col-md-6 col-12">
                      <div class="review-card">
                        <div class="review-source"><img src="<?php echo e(asset('site_assets')); ?>/img/Trustpilotlogo.png"
                            style="width:135px;"></div>
                        <div class="review-stars review-card-star">
                          <!--<div class="review-stars ">-->
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fas fa-star-half-alt"></i>

                        </div>
                        <div class="review-text">
                          TrustScore <b>4.7</b> <a href="#">50,111 reviews</a>
                        </div>
                      </div>
                    </div>

                    <!-- Google -->
                    <div class="col-md-6 col-12">
                      <div class="review-card">
                        <div class="review-source review-res-img"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/800px-Google_2015_logo.svg.png"
                            style="width:105px;">
                        </div>
                        <div class="review-stars">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                        <div class="review-text">
                          Rating: <b>4.8/5</b> (1,237 reviews)
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Review 1 -->
                  <!-- <div class="swiper-slide review-card">

                                                                                                                                                  <div class="platform-name"><img
                                                                                                                                                  src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/800px-Google_2015_logo.svg.png "
                                                                                                                                                  alt="">
                                                                                                                                                  </div>
                                                                                                                                                  <div class="stars">â˜…â˜…â˜…â˜†â˜†</div>
                                                                                                                                                  <p style="color: #000000; padding-bottom: 0px; padding-top: 10px;">Scan the QR code below to leave
                                                                                                                                                  us a review</p>
                                                                                                                                                  <div class="qr-code">
                                                                                                                                                  <img src="<?php echo e(asset('assets')); ?>/images/qr.png">

                                                                                                                                                  </div>
                                                                                                                                                  <p class="review-summary text-center mt-1"> 265 Review</p>



                                                                                                                                                  </div> -->

                  <!-- Review 2 -->
                  <!-- <div class="swiper-slide review-card">


                                                                                                                                                  <div class="platform-name"><img
                                                                                                                                                  src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Trustpilot_logo.png " alt="">
                                                                                                                                                  </div>
                                                                                                                                                  <div class="stars">â˜…â˜…â˜†â˜†â˜†</div>
                                                                                                                                                  <p style="color: #000000; padding-bottom: 0px; padding-top: 10px;">Scan the QR code below to leave
                                                                                                                                                  us a review</p>
                                                                                                                                                  <div class="qr-code">
                                                                                                                                                  <img src="<?php echo e(asset('assets')); ?>/images/qr.png">

                                                                                                                                                  </div>
                                                                                                                                                  <p class="review-summary text-center mt-1 "> 265 Review</p>
                                                                                                                                                  </div> -->

                  <!-- Add more reviews -->
                </div>

                <!-- Arrows -->

              </div>
            </div>



            <div class="play-button" style="margin-top: 30px;  width: 180px; border-radius: 25px;">
              <a class="batton" href="<?php echo e(Route('listing-list')); ?>">View Listing</a>
            </div>
            <!--<img alt="img" class="dots" src="<?php echo e(asset('site_assets')); ?>/img/dots.png">-->
            <img alt="img" class="landing-slider" src="<?php echo e(asset('site_assets')); ?>/img/landing-slider.png">
          </div>
        </div>
        <div class="col-12 col-xl-5 hero-section-form" >
          <!-- <form role="form" class="get-a-quote" id="contact-form" method="post">
                                                                                                                                                  <div class="mb-lg-3 mb-3 d-flex align-items-center">
                                                                                                                                                  <i>
                                                                                                                                                  <svg enable-background="new 0 0 124 124" height="52" viewbox="0 0 124 124" width="52" xmlns="http://www.w3.org/2000/svg"><path d="m82.899 50.646c-6.059 0-10.988-4.918-10.988-10.963s4.929-10.963 10.988-10.963 10.988 4.918 10.988 10.963-4.929 10.963-10.988 10.963zm0-17.979c-3.877 0-7.031 3.147-7.031 7.015s3.154 7.015 7.031 7.015 7.031-3.147 7.031-7.015-3.154-7.015-7.031-7.015z"></path><path d="m122.558 2.183c-.069-.986-.853-1.773-1.841-1.848-14.728-1.125-41.975-.347-58.941 17.482-.002.002-.005.004-.007.007-2.3 2.441-4.418 5.209-6.382 8.136-24.65 8.882-35.589 25.07-38.168 33.298-.376 1.202.496 2.487 1.756 2.582l17.94 1.359c-1.478 3.901-2.824 7.823-4.017 11.748-.215.706-.02 1.472.504 1.992l11.995 11.891c.513.508 1.288.703 1.98.495 4-1.194 7.996-2.545 11.97-4.027l1.381 17.923c.097 1.253 1.377 2.122 2.581 1.752 7.562-2.328 24.216-13.247 33.545-37.919 2.953-1.954 5.73-4.064 8.153-6.359 17.668-16.682 18.58-43.82 17.551-58.512-.07-.987 1.029 14.692 0 0zm-3.878 2.008c.413 7.551.219 17.908-2.38 28.202l-26.124-25.897c10.42-2.625 20.888-2.767 28.504-2.305zm-96.722 53.877c3.21-7.053 12.265-18.732 29.892-26.418-2.945 5.084-5.502 10.331-7.777 15.002-2.04 4.172-3.917 8.403-5.638 12.665zm42.549 42.183-1.267-16.452c4.264-1.695 8.496-3.541 12.668-5.545 4.732-2.244 10.045-4.763 15.169-7.669-7.959 17.563-19.588 26.513-26.57 29.666zm37.752-42.448c-7.489 7.094-18.422 12.277-28.076 16.854-8.762 4.212-17.778 7.744-26.816 10.507l-10.293-10.205c2.785-8.95 6.346-17.879 10.592-26.562 4.394-9.022 9.862-20.251 17.01-27.839 5.992-6.295 13.426-10.299 21.11-12.794l29.252 28.998c-2.497 7.687-6.497 15.108-12.779 21.041z"></path><path d="m4.185 122.808c-1.728 0-2.631-2.145-1.437-3.378l27.357-28.26c1.788-1.841 4.666.918 2.874 2.77l-27.357 28.259c-.392.405-.914.609-1.437.609z"></path><path d="m23.435 124c-1.688 0-2.609-2.063-1.493-3.318l17.73-19.91c1.71-1.913 4.7.723 2.987 2.648l-17.73 19.91c-.394.444-.943.67-1.494.67z"></path><path d="m2.982 104.917c-1.688 0-2.609-2.063-1.493-3.318l17.731-19.91c1.709-1.914 4.7.724 2.987 2.648l-17.731 19.91c-.395.444-.943.67-1.494.67z"></path></svg>
                                                                                                                                                  </i>
                                                                                                                                                  <div>
                                                                                                                                                  <p class="p-0">Marketing Business campaign</p>
                                                                                                                                                  <h2>Search Listing</h2>
                                                                                                                                                  </div>
                                                                                                                                                  </div>
                                                                                                                                                  <div class="group-img">
                                                                                                                                                  <svg width="18" height="18" viewbox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                  <path d="M15.364 11.636C14.3837 10.6558 13.217 9.93013 11.9439 9.49085C13.3074 8.55179 14.2031 6.9802 14.2031 5.20312C14.2031 2.33413 11.869 0 9 0C6.131 0 3.79688 2.33413 3.79688 5.20312C3.79688 6.9802 4.69262 8.55179 6.05609 9.49085C4.78308 9.93013 3.61631 10.6558 2.63605 11.636C0.936176 13.3359 0 15.596 0 18H1.40625C1.40625 13.8128 4.81279 10.4062 9 10.4062C13.1872 10.4062 16.5938 13.8128 16.5938 18H18C18 15.596 17.0638 13.3359 15.364 11.636ZM9 9C6.90641 9 5.20312 7.29675 5.20312 5.20312C5.20312 3.1095 6.90641 1.40625 9 1.40625C11.0936 1.40625 12.7969 3.1095 12.7969 5.20312C12.7969 7.29675 11.0936 9 9 9Z" fill="#555555"></path>
                                                                                                                                                  </svg>
                                                                                                                                                  <input type="text" name="name" placeholder="I am looking for..." required="">
                                                                                                                                                  </div>
                                                                                                                                                  <div class="group-img">
                                                                                                                                                  <svg width="22" height="18" viewbox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                  <path d="M15.8649 18H6.13513C2.58377 18 0.540527 15.9568 0.540527 12.4054V5.5946C0.540527 2.04324 2.58377 0 6.13513 0H15.8649C19.4162 0 21.4595 2.04324 21.4595 5.5946V12.4054C21.4595 15.9568 19.4162 18 15.8649 18ZM6.13513 1.45946C3.35242 1.45946 1.99999 2.81189 1.99999 5.5946V12.4054C1.99999 15.1881 3.35242 16.5406 6.13513 16.5406H15.8649C18.6476 16.5406 20 15.1881 20 12.4054V5.5946C20 2.81189 18.6476 1.45946 15.8649 1.45946H6.13513Z" fill="#444444"></path>
                                                                                                                                                  <path d="M10.9988 9.8465C10.1815 9.8465 9.35452 9.59352 8.72208 9.07785L5.67668 6.64539C5.36532 6.39241 5.30696 5.93511 5.55992 5.62376C5.8129 5.31241 6.2702 5.25403 6.58155 5.50701L9.62695 7.93947C10.3664 8.53298 11.6215 8.53298 12.361 7.93947L15.4064 5.50701C15.7178 5.25403 16.1848 5.30268 16.428 5.62376C16.681 5.93511 16.6324 6.40214 16.3113 6.64539L13.2659 9.07785C12.6432 9.59352 11.8161 9.8465 10.9988 9.8465Z" fill="#444444"></path>
                                                                                                                                                  </svg>
                                                                                                                                                  <input type="text" name="email" placeholder="Email Address" required="">
                                                                                                                                                  </div>
                                                                                                                                                  <div class="group-img">
                                                                                                                                                  <svg fill="none" height="112" viewbox="0 0 24 24" width="112" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="rgb(0,0,0)" fill-rule="evenodd"><path d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z"></path><path d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z"></path><path d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z"></path></g></svg>
                                                                                                                                                  <input type="text" name="mobile" placeholder="Mobile Number" required="">
                                                                                                                                                  <input type="hidden" name="form_type" value="banner">               
                                                                                                                                                   </div>
                                                                                                                                                  <div class="group-img">
                                                                                                                                                  <img src="<?php echo e(asset('site_assets')); ?>/img/dropdown.svg"/>
                                                                                                                                                  <select id="#" class="minimal" name="course">
                                                                                                                                                  <option value="Websites">Websites</option>

                                                                                                                                                  <option value="Theme And Scripts">Theme And Scripts</option>
                                                                                                                                                  <option value="Twitter Account">Twitter Account</option>
                                                                                                                                                  <option value="Instagram Pages">Instagram Pages</option>
                                                                                                                                                  <option value="Facebook Account">Facebook Account</option>

                                                                                                                                                    <option value="Facebook Account">Telegram Account</option>
                                                                                                                                                     <option value="Facebook Account">Youtube Channel</option>
                                                                                                                                                    </select>
                                                                                                                                                    </div>

                                                                                                                                                    <button type="submit" name="submit" class="btn batton" style="background-color: #0062ef; width: 100%; text-align: center;display: flex;justify-content: center;">Submit</button>
                                                                                                                                                    </form>
                                                                                                                                                    <div class="row mobile-v">
                                                                                                                                                    <div class="col-6">
                                                                                                                                                    <div class="btn-wh">
                                                                                                                                                    <div class="bttn w">
                                                                                                                                                    <a href="https://wa.me/+918809772278" target="_blank">
                                                                                                                                                    <img src="<?php echo e(asset('site_assets')); ?>/img/wb.png"></a>
                                                                                                                                                    </div>
                                                                                                                                                    </div>
                                                                                                                                                    </div>
                                                                                                                                                    <div class="col-6">
                                                                                                                                                    <div class="btn-wh ">
                                                                                                                                                    <div class="bttn ">
                                                                                                                                                    <a href="tel:+918809772278">

                                                                                                                                                    <img src="./<?php echo e(asset('site_assets')); ?>/img/cb.png">
                                                                                                                                                   </a>

                                                                                                                                                    </div>
                                                                                                                                                    </div>
                                                                                                                                                    </div>
                                                                                                                                                    </div> -->
          <div class="right-form-card">
            <h3>Search Listings</h3>

            <form action="<?php echo e(route('listing-list')); ?>" method="GET" id="searchForm">

              <!-- Search Input -->
              <div class="form-group icon-input flippingonew-inner-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="I'm looking for..." id="flippingonewInnerSearchInput" autocomplete="off"
                  name="search" />
              </div>




              <!-- Country Dropdown -->
              <div class="form-group country-dropdown">
                <div class="dropdown-toggle" id="countryDropdownToggle" onclick="toggleCountryDropdown(event)">
                  <div>
                    <i class="fa-solid fa-globe"
                      style="color: #ffffff; font-size: 14px; background: black; padding: 4px; border-radius: 3px; margin-right: 5px;"></i>
                    <span id="selectedCountry" style="font-weight: 300; color: #000;">Country</span>
                  </div>
                </div>

                <div class="dropdown-menu" id="countryDropdownMenu" style="display: none;">
                  <input type="text" placeholder="Search country..." class="dropdown-search"
                    oninput="filterCountries(this.value)" />
                  <ul id="countryList" style="padding-left: 20px;">
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li onclick="selectCountry(this)"><?php echo e($country->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>

                <!-- Hidden input for form submission -->
                <input type="hidden" name="country" id="countryInput" />
              </div>

              <!-- Category Dropdown -->
              <div class="form-group category-dropdown">
                <div class="dropdown-toggle" onclick="toggleCategoryDropdown()">
                  <div>
                    <i class="fas fa-tags"
                      style="color: #ffffff; font-size: 14px; background: black; padding: 4px; border-radius: 3px; margin-right: 5px;"></i>
                    <span id="selectedCategory" style="font-weight: 300; color: #000;">Category</span>
                  </div>
                </div>

                <div class="dropdown-menu" id="categoryDropdownMenu" style="display: none;">
                  <input type="text" placeholder="Search..." class="dropdown-search"
                    oninput="filterCategories(this.value)" />
                  <ul id="categoryList">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li onclick="selectCategory(this)" data-value="<?php echo e($category->slug); ?>">
                        <?php echo e($category->name); ?> <span class="badge"><?php echo e($categorySubmissionCounts[$category->id] ?? 0); ?></span>
                      </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>

                </div>

                <!-- Hidden input for form submission -->
                <input type="hidden" name="category" id="categoryInput" />
              </div>

              <!-- Price Range -->
              <div class="form-group price-range">
                <div class="icon-input">
                  <input type="number" placeholder="Min Price" name="price_min" id="minPrice" />
                </div>
                <span>-</span>
                <div class="icon-input">
                  <input type="number" placeholder="Max Price" name="price_max" id="maxPrice" />
                </div>
              </div>

              <button type="submit" class="search-btn">Search</button>
            </form>
          </div>


        </div>
      </div>
    </div>
  </section>
  <!-- end hero-wrapper -->



  <section class="cat-area section--padding">
    <?php
      $featured = $homePageContent['featured'] ?? null;
    ?>
    <div class="container">
      <div class="text-start mb-4">
        <h2 class="sec__title mb-3"> <?php echo e($featured->title ?? 'Explore Top Digital Assets'); ?></h2>
        <p class="sec__desc">
          <?php echo e($featured->description ?? 'Discover the most in-demand categories, from social accounts to apps, blogs, and more.'); ?>

        </p>
      </div>



      <div class="flippingonew-slider-wrapper">
        <button class="flippingonew-slider-btn prev">&#10094;</button>

        <div class="flippingonew-slider-track">
          <?php $__currentLoopData = $categories->where('is_popular', 1)->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('listing-list', ['category' => $category->slug])); ?>" class="flippingonew-slider-card">
              <span class="flippingonew-listing-badge">
                <?php echo e($categorySubmissionCounts[$category->id] ?? 0); ?> Listings
              </span>

              <div class="flippingonew-slider-image">
                <?php if($category->image): ?>
                  <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>">
                <?php else: ?>
                  <img src="<?php echo e(asset('images/default-category.png')); ?>" alt="Default">
                <?php endif; ?>
              </div>

              <h3 class="flippingonew-slider-title">
                <?php echo e($category->name); ?>

              </h3>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button class="flippingonew-slider-btn next">&#10095;</button>
      </div>



      <!-- Buttons -->
      <div class="text-center mt-4">
        <?php if($categories->count() > $categories->where('is_popular', 1)->count()): ?>
          <button class="btn btn-primary" onclick="window.location.href='<?php echo e(route('categories.index')); ?>'">
            View All Categories
          </button>

        <?php endif; ?>
        <button class="btn btn-secondary d-none" id="view-popular-btn">View Popular</button>
      </div>
    </div>
  </section>

  <script>
    const allCategories = <?php echo json_encode($categories, 15, 512) ?>;
    const popularCategories = allCategories.filter(c => c.is_popular);
    const initialCategories = popularCategories.slice(0, 7); // show first 7 initially

    // Pass PHP array to JS
    const categorySubmissionCounts = <?php echo json_encode($categorySubmissionCounts, 15, 512) ?>;

    const container = document.getElementById('categories-list');
    const btnAll = document.getElementById('view-all-btn');
    const btnPopular = document.getElementById('view-popular-btn');

    const listingRouteTemplate = "<?php echo e(route('listing-list')); ?>?category=:slug";

    function renderCategories(categories) {
      container.innerHTML = '';
      categories.forEach(category => {
        const div = document.createElement('div');
        div.classList.add('social-media-icon-section');
        const imgSrc = category.image ? `/storage/${category.image}` : '/images/default-category.png';

        // Replace :slug with actual slug encoded for safety
        const url = listingRouteTemplate.replace(':slug', encodeURIComponent(category.slug));

        div.innerHTML = `
                                          <a href="${url}" style="text-decoration:none; color:inherit;">
                                            <div class="s-image-card">
                                              <img src="${imgSrc}" alt="${category.name} Icon" />
                                            </div>
                                            <h3>${category.name}</h3>
                                            <p>${categorySubmissionCounts[category.id] ?? 0} Listings</p>
                                          </a>
                                        `;
        container.appendChild(div);
      });
    }



    // Initial render: only 7
    renderCategories(initialCategories);

    btnAll?.addEventListener('click', () => {
      renderCategories(allCategories);
      btnAll.style.display = 'none';
      btnPopular.classList.remove('d-none');
    });

    btnPopular?.addEventListener('click', () => {
      renderCategories(popularCategories.slice(0, 7)); // back to first 7 popular
      btnPopular.classList.add('d-none');
      btnAll.style.display = 'inline-block';
    });
  </script>


  <!-- end cat-area -->
  <!-- ================================
                                                                                                                                                  END CAT AREA
                                                                                                                                                  ================================= -->

  <!-- ================================
                                                                                                                                                  START HIW AREA
                                                                                                                                                  ================================= -->
  <!--<section class="hiw-area bg-gray section--padding">-->
  <!--  <div class="container">-->
  <!--    <div class="">-->
  <!--      <h2 class="sec__title mb-3 text-center">Buy Your Next Digital Asset on Flippingo</h2>-->
  <!--      <p class="sec__desc text-center">-->
  <!--        Explore verified listings of businesses, accounts, websites, and apps.-->
  <!--        Compare options, connect with sellers, and purchase securelyâ€”all in one place.-->
  <!--      </p>-->
  <!--    </div>-->
  <!-- end section-heading -->
  <!--    <div class="row mt-5">-->
  <!-- Card 1 -->
  <!--      <div class="col-lg-3 col-md-6">-->
  <!--        <div class="flip-card">-->
  <!--          <div class="flip-card-inner">-->
  <!-- Front -->
  <!--            <div class="flip-card-front">-->
  <!--              <img src="<?php echo e(asset('assets')); ?>/images/deal.png" width="74px" />-->
  <!--              <h4 class="mt-3">Apply For Sponsorship</h4>-->
  <!--            </div>-->
  <!-- Back -->
  <!--            <div class="flip-card-back">-->
  <!--              <p>-->
  <!--                If you want to get sponsorship from us kindly read our requirements first,-->
  <!--                then apply by clicking on get sponsorship button.-->
  <!--              </p>-->
  <!--              <button>View More</button>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!-- Card 2 -->
  <!--      <div class="col-lg-3 col-md-6">-->
  <!--        <div class="flip-card">-->
  <!--          <div class="flip-card-inner">-->
  <!-- Front -->
  <!--            <div class="flip-card-front">-->
  <!--              <img src="<?php echo e(asset('assets')); ?>/images/approved.png" width="74px" />-->
  <!--              <h4 class="mt-3">Wait For Approval</h4>-->
  <!--            </div>-->
  <!-- Back -->
  <!--            <div class="flip-card-back">-->
  <!--              <p>-->
  <!--                After applying for sponsorship for your page or channel, please wait for our approval.-->
  <!--                Once you are approved, then proceed further.-->
  <!--              </p>-->
  <!--              <button>View More</button>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!-- Card 3 -->
  <!--      <div class="col-lg-3 col-md-6">-->
  <!--        <div class="flip-card">-->
  <!--          <div class="flip-card-inner">-->
  <!-- Front -->
  <!--            <div class="flip-card-front">-->
  <!--              <img src="<?php echo e(asset('assets')); ?>/images/brand.png" width="74px" />-->
  <!--              <h4 class="mt-3">Start Promoting Brand</h4>-->
  <!--            </div>-->
  <!-- Back -->
  <!--            <div class="flip-card-back">-->
  <!--              <p>-->
  <!--                Start promoting brand logo, links, tools, & services. Earn money by promoting the brandâ€™s-->
  <!--                content and products.-->
  <!--              </p>-->
  <!--              <button>View More</button>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->

  <!-- Card 4 -->
  <!--      <div class="col-lg-3 col-md-6">-->
  <!--        <div class="flip-card">-->
  <!--          <div class="flip-card-inner">-->
  <!-- Front -->
  <!--            <div class="flip-card-front">-->
  <!--              <img src="<?php echo e(asset('assets')); ?>/images/banking.png" width="74px" />-->
  <!--              <h4 class="mt-3">Get Paid For Promotion</h4>-->
  <!--            </div>-->
  <!-- Back -->
  <!--            <div class="flip-card-back">-->
  <!--              <p>-->
  <!--                Get paid for promotion. We provide instant, daily, and weekly payments-->
  <!--                to our influencers.-->
  <!--              </p>-->
  <!--              <button>View More</button>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!-- end row -->
  <!--  </div>-->
  <!-- end container -->
  <!--</section>-->
  <section class="flippingo-hiw-section">
    <div class="flippingo-hiw-container">
      <div x-data="flippingoHiwTabs()" class="flippingo-hiw-tabs-wrapper">

        <!-- Tabs Navigation (horizontal) -->
        <div class="flippingo-hiw-tabs-nav">
          <template x-for="(slide, index) in slides" :key="index">
            <button class="flippingo-hiw-tab" :class="{ 'active': current === index }" @click="current = index">
              <span x-text="slide.slider_for === 'buyer' ? 'For Buyers' : 'For Sellers'"></span>
            </button>
          </template>
        </div>

        <template x-for="(slide, index) in slides" :key="index">
          <div class="" x-show="current === index">
            <h2 class="sec__title  text-center" x-text="slide.title"> </h2>
            <p class="sec__desc text-center mb-3">
              View current listings of businesses and digital products from verified sellers.
            </p>
          </div>
        </template>

        <!-- Tab Content (only active one shown) -->
        <div class="flippingo-hiw-tab-content">
          <template x-for="(slide, index) in slides" :key="index">
            <div class="flippingo-hiw-full-slide" x-show="current === index" x-transition>
              <!-- Left: Content -->
              <div class="flippingo-hiw-content">
                <!--<h2 x-text="slide.title"></h2>-->
                <p>
                  <span x-text="slide.highlight"></span>
                </p>
                <!-- FEATURES -->
                <template x-for="feature in slide.features || []">
                  <p>
                    <i class="fa-solid fa-circle-check" style="color:blue;"></i>
                    <span x-text="feature"></span>
                  </p>
                </template>
                <div class="flippingo-hiw-btn-group">
                  <a :href="slide.btn1_link || '#'" class="flippingo-hiw-btn flippingo-hiw-btn-primary">
                    <span x-text="slide.btn1_text"></span>
                    <i class="fa-solid fa-arrow-right"></i>
                  </a>
                  <a :href="slide.btn2_link || '#'" class="flippingo-hiw-btn flippingo-hiw-btn-secondary">
                    <i :class="slide.btn2_icon"></i>
                    <span x-text="slide.btn2_text"></span>
                    <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>

              <!-- Right: Image/Video -->
              <!-- In your template / Blade / Alpine section -->
              <div class="flippingo-hiw-image">

                <!-- IMAGE -->
                <template x-if="slide.media_type === 'image'">
                  <img :src="'/storage/' + slide.media_path" loading="lazy" style="width:100%; border-radius:12px;">
                </template>

                <!-- UPLOADED VIDEO -->
                <template x-if="slide.media_type === 'video' && slide.video_type === 'upload'">
                  <video autoplay muted loop playsinline style="width:100%; border-radius:12px;">
                    <source :src="'/storage/' + slide.media_path" type="video/mp4">
                  </video>
                </template>

                <!-- YOUTUBE (UNCHANGED) -->
                <template x-if="slide.media_type === 'video' && slide.video_type === 'youtube'">
                  <iframe
                    :src="`https://www.youtube.com/embed/${getYoutubeId(slide.media_path)}?autoplay=0&mute=0&controls=0&rel=0&modestbranding=1`"
                    allow="encrypted-media" frameborder="0"
                    style="width:100%; height:360px; border-radius:12px;"></iframe>
                </template>

                <!-- VIMEO -->
                <template x-if="slide.media_type === 'video' && slide.video_type === 'vimeo'">
                  <iframe :src="getVimeoEmbed(slide.media_path)" frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                    style="width:100%; height:360px; border-radius:12px;"></iframe>
                </template>

                <!-- EXTERNAL URL -->
                <template x-if="slide.media_type === 'video' && slide.video_type === 'external'">
                  <iframe :src="slide.media_path" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen style="width:100%; height:360px; border-radius:12px;"></iframe>
                </template>

              </div>


              <!--<div class="flippingo-hiw-image">-->
              <!--  <div class="flippingo-video-wrapper">-->
              <!--     Image case -->
              <!--    <template x-if="slide.media_type === 'image' && slide.media_path">-->
              <!--      <img-->
              <!--        :src="'/storage/' + slide.media_path"-->
              <!--        :alt="slide.title || 'Slide ' + (index + 1)"-->
              <!--        loading="lazy"-->
              <!--        style="width:100%; height:100%; object-fit: cover; border-radius:12px;"-->
              <!--      >-->
              <!--    </template>-->

              <!--     Uploaded MP4 -->
              <!--    <template x-if="slide.media_type === 'video' && slide.video_type === 'upload'">-->
              <!--      <video -->
              <!--        controls -->
              <!--        playsinline -->
              <!--        preload="metadata"-->
              <!--        style="width:100%; height:100%; border-radius:12px;"-->
              <!--      >-->
              <!--        <source :src="'/storage/' + slide.media_path" type="video/mp4">-->
              <!--        Your browser does not support the video tag.-->
              <!--      </video>-->
              <!--    </template>-->

              <!--     YouTube -->
              <!--    <template x-if="slide.media_type === 'video' && slide.video_type === 'youtube'">-->
              <!--      <iframe-->
              <!--      width="100%"-->
              <!--      height="100%"-->
              <!--      src="https://www.youtube.com/embed/dQw4w9WgXcQ?controls=1&modestbranding=1&rel=0"-->
              <!--      title="Hardcoded Test Video"-->
              <!--      frameborder="0"-->
              <!--      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"-->
              <!--      allowfullscreen-->
              <!--    ></iframe>-->
              <!--    </template>-->

              <!--     Vimeo / External -->
              <!--    <template x-if="slide.media_type === 'video' && ['vimeo', 'external'].includes(slide.video_type)">-->
              <!--      <iframe-->
              <!--        :src="getCleanVimeoUrl(slide.media_path)"-->
              <!--        title="Video player"-->
              <!--        frameborder="0"-->
              <!--        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"-->
              <!--        allowfullscreen-->
              <!--      ></iframe>-->
              <!--    </template>-->
              <!--  </div>-->
              <!--</div>-->
            </div>
          </template>
        </div>
      </div>
    </div>
  </section>

  <!-- SLIDER JS -->


  <!-- end hiw-area -->
  <!-- ================================
                                                                                                                                                  END HIW AREA
                                                                                                                                                  ================================= -->

  <!-- ================================
                                                                                                                                                  START CARD AREA
                                                                                                                                                  ================================= -->

  <section class="card-area section-padding" style="background:#f0f5fb;">
    <?php
      $mostSearched = $homePageContent['most_searched'] ?? null;
    ?>
    <div class="container">
      <div class="">
        <h2 class="sec__title  text-start"> <?php echo e($mostSearched->title ?? 'Most Searched Businesses'); ?></h2>
        <p class="sec__desc text-start mb-3">
          <?php echo e($mostSearched->description ?? 'View current listings of businesses and digital products from verified sellers.'); ?>

        </p>
      </div>

      <div class="filter-bar">

        <!-- Category Section -->
        <div class="filter-left">

          <?php
            $popularCategories = $categories->where('is_popular', 1)->values();
          ?>
          <!-- Category Dropdown -->
          <select id="countrySelect" class="filter-select" style="width:200px">
            <option value="all">All Countries</option>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <select id="categorySelect" class="filter-select">
            <option value="all">All Categories</option>
            <?php $__currentLoopData = $popularCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>

          <!-- 3 Category Buttons (auto hide when dropdown used) -->
          <div class="quick-categories" id="quickCategories">
            <?php $__currentLoopData = $popularCategories->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <button class="tab-btn" data-category="<?php echo e($category->slug); ?>">
                <?php echo e($category->name); ?>

              </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

        </div>

        <!-- RIGHT FILTERS -->
        <div class="filter-right">

          <!-- Country Dropdown -->


          <!-- Verified / Premium -->
          <!--<button class="filter-btn">Verified</button>-->
          <!--<button class="filter-btn">Premium</button>-->
          <!--          <div class="switch-wrapper">-->
          <!--  <button class="filter-btn">Verified</button>-->
          <!--</div>-->

          <!--<div class="switch-wrapper">-->
          <!--  <button class="filter-btn">Premium</button>-->
          <!--</div>-->

         <div class="switch-container">
            <div class="custom-switch filter-btn" data-filter="verified"></div>
            <span class="switch-label">Verified</span>
          </div>

          <div class="switch-container">
            <div class="custom-switch filter-btn" data-filter="premium"></div>
            <span class="switch-label">Premium</span>
          </div>


        </div>

      </div>

<button id="gvFilterOpenBtn" class="gv-filter-open-btn">
    <i class="fa-solid fa-filter"></i> Filters
</button>
<div id="gvFilterBackdrop" class="gv-filter-backdrop"></div>

<div id="gvFilterSheet" class="gv-bottomsheet">

    <div class="gv-bottomsheet-header">
        <h3>Filters</h3>
        <button class="gv-bottomsheet-close" id="gvFilterCloseBtn">&times;</button>
    </div>

    <div class="gv-bottomsheet-body">

        <!-- YOUR FILTER BAR CODE (UNCHANGED) -->
        <div class="filter-bar">

            <div class="filter-left">

                <select id="countrySelect" class="filter-select" style="width:200px">
                    <option value="all">All Countries</option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select id="categorySelect" class="filter-select">
                    <option value="all">All Categories</option>
                    <?php $__currentLoopData = $popularCategories->slice(2, 8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <div class="quick-categories" id="quickCategories">
                    <?php $__currentLoopData = $popularCategories->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <button class="tab-btn" data-category="<?php echo e($category->slug); ?>">
                        <?php echo e($category->name); ?>

                      </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>

            <div class="filter-right">

                <div class="switch-container">
                    <div class="custom-switch filter-btn"></div>
                    <span class="switch-label">Verified</span>
                </div>

                <div class="switch-container">
                    <div class="custom-switch filter-btn"></div>
                    <span class="switch-label">Premium</span>
                </div>

            </div>

        </div>
        <!-- END YOUR CODE -->

    </div>

</div>



      <!-- Tabs -->
      <!--<div class="my-4">-->
      <!--  <button class="tab-btn active" data-category="all">All</button>-->
      <!--  <?php $__currentLoopData = $categories->where('is_popular', 1)->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
      <!--    <button class="tab-btn" data-category="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></button>-->
      <!--  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->

      <!--</div>-->

      <div id="submissions-container">

        
        <div class="submission-group wishlist-card" data-group="all">
          <?php if($allSubmissions->count() > 0): ?>
            <?php $__currentLoopData = $allSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $catName = $submission['category_name'] ?? '';

                $fields = json_decode($submission['data'], true);

                $productTitle = $fields['product_title']['value'] ?? 'No Title';

                $imageFile = $submission['allImages'][0] ?? null;
                $summaryFields = $submission['summaryFields'] ?? null;
              ?>
              <div class="wishlist-product-card" data-category="<?php echo e($catName); ?>"
                data-country="<?php echo e($submission['country_id'] ?? 'all'); ?>"
                data-verified="<?php echo e($submission['is_verified'] ? '1' : '0'); ?>"
                data-premium="<?php echo e($submission['is_premium'] ? '1' : '0'); ?>">
                <?php if($imageFile): ?>
                  <div class="wishlist-image-wrapper">

                    <div class="wishlist-main-slider">
                      <?php $__currentLoopData = $submission['allImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset('storage/' . $img['file_path'])); ?>" class="slide-img" />
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Navigation Arrows -->
                    <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                    <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>

                  </div>

                <?php else: ?>
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                <?php endif; ?>
                <div class="wishlist-budge">
                  <div class="d-flex justify-content-between align-items-center">
                    <?php if(in_array($submission['id'], $soldSubmissionIds)): ?>
                      
                      <div class="budge-soldout">
                        <p><i class="fa-solid fa-ban"></i> Sold Out</p>
                      </div>
                    <?php else: ?>
                      
                      <div class="budge-active">
                        <p><i class="fa-solid fa-circle-check"></i> Active</p>
                      </div>
                    <?php endif; ?>
                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i></h4>

                  </div>

                </div>
                <div class="product-details-hover">
                  <div class="wishlist-button">
                    <p><?php echo e($catName); ?></p>
                    <!--<div class="budge-active1">-->
                    <!--  <p><i class="fa-solid fa-circle-check"></i> Verified</p>-->
                    <!--</div>-->

                  </div>
                  <h3 class="mt-2 " style="color: #000;"><?php echo e($productTitle); ?></h3>
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="m-0" style="font-size:12px;">
                      By
                      <span style="cursor: pointer;" onclick="window.location.href='<?php echo e(route('seller.profile', $submission['customer']['id'])); ?>'"> <?php echo e(($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '')); ?></span>
                
                      <?php if(!empty($submission['is_premium']) && $submission['is_premium']): ?>
                        <span class="text-warning ms-1" data-toggle="tooltip" data-placement="top"
                          title="<?php echo e(setting('premium_seller_note', 'Top Seller')); ?>">
                          <i class="fa-solid fa-crown"></i>
                        </span>
                      <?php elseif(!empty($submission['is_verified']) && $submission['is_verified']): ?>
                        <span class="text-success ms-1" data-toggle="tooltip"  data-placement="top"
                         title="<?php echo e($submission['verified_note'] ?? 'Verified Seller'); ?>">
                          <i class="fa-solid fa-circle-check"></i>
                        </span>
                      <?php endif; ?>
                    </p>

                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> <?php echo e($submission['total_views'] ?? 0); ?>

                    </p>
                  </div>
                  <div class="wishlist-item-card <?php echo e(count($summaryFields) == 2 ? 'two-items' : ''); ?>">
                    <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="wishlist-left">
                        <p class="m-0" style="color: <?php echo e($field['color'] ?? 'green'); ?>;">
                          <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                        </p>

                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 10px;line-height: 12px;">
                            <?php echo e($field['label']); ?>

                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 14px;">
                            <?php echo e($field['value']); ?>

                          </h5>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>

                  <div class="wishlist-price d-flex justify-content-between mt-3">
                    <h2 style="color:#000;">
                      <?php echo e($submission['currency_symbol']); ?>

                      <?php echo e($submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']); ?>

                    </h2>


                    <button type="button" class="btn btn-dark"
                      onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission['id']])); ?>'">
                      View Listing
                    </button>
                  </div>
                </div>

              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </div>

        
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="submission-group wishlist-card" data-group="<?php echo e($category->slug); ?>" style="display:none;">
            <?php
              $submissions = $submissionsByCategory[$category->id] ?? collect();
            ?>
            <?php if($submissions->count()): ?>
              <?php $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $fields = json_decode($submission->data, true);

                  $productTitle = $fields['product_title']['value'] ?? 'No Title';
                  $imageFile = $submission->allImages[0] ?? null;
                  $summaryFields = $submission->summaryFields;

                ?>

                <div class="wishlist-product-card" data-category="<?php echo e($category->slug); ?>"
                  data-country="<?php echo e($submission->country_id ?? 'all'); ?>"
                  data-verified="<?php echo e($submission->is_verified ? '1' : '0'); ?>"
                  data-premium="<?php echo e($submission->is_premium ? '1' : '0'); ?>">
                  <?php if($imageFile): ?>
                    <div class="wishlist-image-wrapper">

                      <div class="wishlist-main-slider">
                        <?php $__currentLoopData = $submission['allImages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <img src="<?php echo e(asset('storage/' . $img['file_path'])); ?>" class="slide-img" />
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>

                      <!-- Navigation Arrows -->
                      <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                      <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>

                    </div>
                  <?php else: ?>
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                  <?php endif; ?>
                  <div class="wishlist-budge">
                    <div class="d-flex justify-content-between align-items-center">
                      <?php if(in_array($submission['id'], $soldSubmissionIds)): ?>
                        
                        <div class="budge-soldout">
                          <p><i class="fa-solid fa-ban"></i> Sold Out</p>
                        </div>
                      <?php else: ?>
                        
                        <div class="budge-active">
                          <p><i class="fa-solid fa-circle-check"></i> Active</p>
                        </div>
                      <?php endif; ?>
                      <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i></h4>

                    </div>

                  </div>
                  <div class="product-details-hover">
                    <div class="wishlist-button">
                      <p><?php echo e($category->name); ?></p>
                      <!-- <div class="budge-active1">
                                                                                <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                                                              </div> -->
                    </div>
                    <h3 class="mt-2 " style="color: #000;"><?php echo e($productTitle); ?></h3>
                    <div class="d-flex justify-content-between align-items-center">
                      <p class="m-0">
                        By <span style="cursor: pointer;" onclick="window.location.href='<?php echo e(route('seller.profile', $submission->customer->id)); ?>'"><?php echo e(($submission->customer->first_name ?? '') . ' ' . ($submission->customer->last_name ?? '')); ?></span>

                        <?php if(!empty($submission->is_premium) && $submission->is_premium): ?>
                          <span class="text-warning ms-1" data-toggle="tooltip" data-placement="top"
                            title="<?php echo e(setting('premium_seller_note', 'Top Seller')); ?>">
                            <i class="fa-solid fa-crown"></i>
                          </span>
                        <?php elseif(!empty($submission->is_verified) && $submission->is_verified): ?>
                        <span class="text-success ms-1" data-toggle="tooltip"  data-placement="top"
                         title="<?php echo e($submission->verified_note ?? 'Verified Seller'); ?>">
                          <i class="fa-solid fa-circle-check"></i>
                        </span>
                        <?php endif; ?>
                      </p>
                      <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> <?php echo e($submission->total_views ?? 0); ?>

                      </p>
                    </div>
                    <div class="wishlist-item-card">
                      <?php $__currentLoopData = $summaryFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="wishlist-left">
                          <p class="m-0" style="color: <?php echo e($field['color'] ?? 'green'); ?>;">
                            <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                          </p>
                          <div class="d-flex flex-column">
                            <p class="m-0" style="font-size: 10px;">
                              <?php echo e($field['label']); ?>

                            </p>
                            <h5 class="m-0" style="color: #000; font-size: 14px;">
                              <?php echo e($field['value']); ?>

                            </h5>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="wishlist-price d-flex justify-content-between mt-3">
                      <h2 style="color:#000;">
                        <?php echo e($submission->currency_symbol); ?>

                        <?php echo e($submission->currency_symbol == '$' ? number_format($submission->display_price, 2) : $submission->display_price); ?>

                      </h2>
                      <button type="button" class="btn btn-dark"
                        onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission->id])); ?>'">
                        View Listing
                      </button>

                    </div>

                  </div>

                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <p>No submission available.</p>
            <?php endif; ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <div class="view-more-button">
          <button onclick="window.location.href='<?php echo e(route('listing-list')); ?>'" class="flippa-btn filled">View All
            Listings</button>
        </div>
      </div>

    </div>
  </section>

  <!-- end card-area -->
  <!-- ================================
                                                                                                                                                  END CARD AREA
                                                                                                                                                  ================================= -->
  <section class="hiw-area text-center" style="padding: 80px 0; background: #f9fafc;">
    <div class="container">
      <h2 class="sec__title mb-3">How It Works</h2>
      <p class="sec__desc mb-5">
        Selling or buying digital assets on our platform is fast, safe, and easy. Follow these simple steps to get
        started.
      </p>

      <div class="process-steps">
        <!-- Step 1 -->
        <div class="step">
          <div class="step-icon">
            <i class="fal fa-user-plus"></i>
          </div>
          <h4>1. Sign Up</h4>
          <p>Create a free account to start exploring or listing digital assets.</p>
        </div>

        <!-- Step 2 -->
        <div class="step">
          <div class="step-icon">
            <i class="fal fa-search"></i>
          </div>
          <h4>2. Explore Listings</h4>
          <p>Browse a wide variety of domains, websites, templates, and more.</p>
        </div>

        <!-- Step 3 -->
        <div class="step">
          <div class="step-icon">
            <i class="fal fa-exchange"></i>
          </div>
          <h4>3. Make a Deal</h4>
          <p>Connect with buyers or sellers, negotiate terms, and finalize your transaction.</p>
        </div>

        <!-- Step 4 -->
        <div class="step">
          <div class="step-icon">
            <i class="fal fa-shield-check"></i>
          </div>
          <h4>4. Secure Transfer</h4>
          <p>Assets are securely transferred once the payment is confirmed.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================
                                                                                                                                                  START FUN-FACT AREA
                                                                                                                                                  ================================= -->
  <section class="prt-row home03-fid-section bg-base-grey clearfix">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <!-- prt-fid -->
          <div class="prt-fid inside prt-fid-with-icon prt-fid-view-lefticon style4">
            <div class="prt-fid-icon-wrapper">
              <i class="fa-solid fa-city"></i>
            </div>
            <div class="prt-fid-contents">
              <h4 class="prt-fid-inner">
                <span data-appear-animation="animateDigits" data-from="0" data-to="100" data-interval="5" data-before=""
                  data-before-style="sup" data-after="+" data-after-style="sub" class="numinate">100
                </span>
                <span class="fid-prefix">+</span>
              </h4>
            </div>
            <h3 class="prt-fid-title">Business Setups </h3>
            <div class="prt-fid-desc">
              <p>Helping entrepreneurs bring their vision to life with successful business setups
                in Dubai and across the UAE.</p>
            </div>
          </div><!-- prt-fid end -->
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <!-- prt-fid -->
          <div class="prt-fid inside prt-fid-with-icon prt-fid-view-lefticon style4">
            <div class="prt-fid-icon-wrapper">
              <i class="fa-solid fa-users"></i>
            </div>
            <div class="prt-fid-contents">
              <h4 class="prt-fid-inner">
                <span data-appear-animation="animateDigits" data-from="0" data-to="200" data-interval="5" data-before=""
                  data-before-style="sup" data-after="+" data-after-style="sub" class="numinate">200
                </span>
                <span class="fid-prefix">+</span>
              </h4>
            </div>
            <h3 class="prt-fid-title">Satisfied Clients
            </h3>
            <div class="prt-fid-desc">
              <p>A proven track record of delivering exceptional results and exceeding client
                expectations.</p>
            </div>
          </div><!-- prt-fid end -->
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <!-- prt-fid -->
          <div class="prt-fid inside prt-fid-with-icon prt-fid-view-lefticon style4">
            <div class="prt-fid-icon-wrapper">
              <i class="fa-brands fa-servicestack"></i>
            </div>
            <div class="prt-fid-contents">
              <h4 class="prt-fid-inner">
                <span data-appear-animation="animateDigits" data-from="0" data-to="30" data-interval="1" data-before=""
                  data-before-style="sup" data-after="+" data-after-style="sub" class="numinate">30
                </span>
                <span class="fid-prefix">+</span>
                <!-- <span class="fid-prefix">K</span> -->
              </h4>
            </div>
            <h3 class="prt-fid-title">Services</h3>
            <div class="prt-fid-desc">
              <p>Offering a wide range of services, from business setup to digital marketing,
                ensuring all your needs are covered.</p>
            </div>
          </div><!-- prt-fid end -->
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <!-- prt-fid -->
          <div class="prt-fid inside prt-fid-with-icon prt-fid-view-lefticon style4">
            <div class="prt-fid-icon-wrapper">
              <i class="fa-solid fa-users"></i>
            </div>
            <div class="prt-fid-contents">
              <h4 class="prt-fid-inner">
                <span data-appear-animation="animateDigits" data-from="0" data-to="20" data-interval="5" data-before=""
                  data-before-style="sup" data-after="+" data-after-style="sub" class="numinate">20
                </span>
                <span class="fid-prefix">+</span>
              </h4>
            </div>
            <h3 class="prt-fid-title"> Team Members</h3>
            <div class="prt-fid-desc">
              <p>A dedicated team of experts working together to provide you with personalized and
                efficient solutions.


                .</p>
            </div>
          </div><!-- prt-fid end -->
        </div>
      </div>
    </div>
  </section>
  <!-- end funfact-area -->
  <!-- ================================
                                                                                                                                                  END FUN-FACT AREA
                                                                                                                                                  ================================= -->

  <!-- ================================
                                                                                                                                                  START HIW AREA
                                                                                                                                                  ================================= -->
  <section class="hiw-area section--padding text-center">
    <div class="container">
      <!-- Heading -->
      <h2 class="sec__title mb-3">What We Offer</h2>
      <p class="sec__desc mb-5">
        Explore a range of digital assets ready to buy or sell â€” from premium domains
        to full-fledged websites, digital templates, and more.
      </p>

      <!-- Cards Grid -->
      <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-lg-3 col-md-6">
          <div class="offer-box">
            <div class="offer-icon bg-gradient-1">
              <i class="fal fa-globe"></i>
            </div>
            <h4>Domain Names</h4>
            <p>Buy or sell high-value domains to power your next project or brand.</p>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 col-md-6">
          <div class="offer-box">
            <div class="offer-icon bg-gradient-2">
              <i class="fal fa-browser"></i>
            </div>
            <h4>Websites & Blogs</h4>
            <p>Discover profitable websites and ready-to-grow blogs for sale.</p>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 col-md-6">
          <div class="offer-box">
            <div class="offer-icon bg-gradient-3">
              <i class="fal fa-code"></i>
            </div>
            <h4>Themes & Templates</h4>
            <p>Shop and sell high-quality HTML, WordPress, and eCommerce templates.</p>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 col-md-6">
          <div class="offer-box">
            <div class="offer-icon bg-gradient-4">
              <i class="fal fa-layer-group"></i>
            </div>
            <h4>Digital Products</h4>
            <p>From ebooks to software, monetize or purchase downloadable assets.</p>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- end hiw-area -->
  <!-- ================================
                                                                                                                                                  END HIW AREA
                                                                                                                                                  ================================= -->

  <!-- ================================
                                                                                                                                                  START CTA AREA
                                                                                                                                                  ================================= -->
  <section class="cta-area bg-gray padding-top-80px padding-bottom-80px position-relative">
    <img src="<?php echo e(asset('assets')); ?>/images/symble1.png" alt="" class="symble-img" />
    <img src="<?php echo e(asset('assets')); ?>/images/symble2.png" alt="" class="symble-img" />
    <img src="<?php echo e(asset('assets')); ?>/images/symble3.png" alt="" class="symble-img" />
    <img src="<?php echo e(asset('assets')); ?>/images/symble4.png" alt="" class="symble-img" />
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="me-2 my-3">
          <h2 class="mb-3 font-size-30 font-weight-bold">
            Flippingo is the best way to find & discover <br />
            great local businesses
          </h2>
          <p class="font-size-17">
            Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
            libero
          </p>
        </div>
        <a href="<?php echo e(Route('authentication-signup')); ?>" class="theme-btn">Create Account</a>
      </div>
    </div>
    <!-- end container -->
  </section>
  <!-- end cta-area -->
  <!-- ================================
                                                                                                                                                  END CTA AREA
                                                                                                                                                  ================================= -->

  <!-- ================================
                                                                                                                                                     START TESTIMONIAL AREA
                                                                                                                                                  ================================= -->
  <section class="hiw-area section--padding text-center" style="background-color: #fff; padding-bottom: 0px;">
    <div class="container">
      <h2 class="sec__title mb-3">Testimonial</h2>
      <p class="sec__desc">
        Real stories from buyers and sellers who have successfully grown with us, we at Flippingo helped creators,
        founders, and investors find the right digital opportunities.
      </p>

    </div>
  </section>


  <div class="testimonial-container" style="margin-bottom: 70px;">

    <div class="testimonial-grid">
      <div class="image-container" id="image-container"></div>
      <div class="testimonial-content">
        <div>
          <h3 class="name" id="name"></h3>
          <p class="designation" id="designation"></p>
          <p class="quote" id="quote"></p>
        </div>
        <div class="arrow-buttons">
          <button class="arrow-button prev-button" id="prev-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
            </svg>
          </button>
          <button class="arrow-button next-button" id="next-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>


  <!-- end testimonial-area -->



  <section class="testimonial-reels-section py-5 bg-light">
    <div class="container">
      <h2 class="sec__title mb-3 text-center">Reels</h2>
      <p class="sec__desc text-center">
        Our buyers and sellers share their experiences of growing, scaling, and succeeding with Flippingo. From first-time
        entrepreneurs to seasoned business owners, trust is what keeps them coming back.
      </p>
      <div class="row g-4 justify-content-center" id="reels-container">
        <p class="text-center text-muted">Loading reels...</p>
      </div>
    </div>
  </section>


  <!-- ================================
                                                                                                                                                     START TESTIMONIAL AREA
                                                                                                                                                  ================================= -->

  <section class="mobile-area section-padding bg-gray position-relative mt-5">
    <img src="<?php echo e(asset('assets')); ?>/images/symble1.png" alt="" class="symble-img" />
    <img src="<?php echo e(asset('assets')); ?>/images/symble2.png" alt="" class="symble-img" />
    <img src="<?php echo e(asset('assets')); ?>/images/symble3.png" alt="" class="symble-img" />
    <img src="<?php echo e(asset('assets')); ?>/images/symble4.png" alt="" class="symble-img" />
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5 me-auto">
          <div class="mobile-img my-4">
            <img src="<?php echo e(asset('assets')); ?>/images/img-loading.jpg"
              data-src="<?php echo e(asset('assets')); ?>/images/undraw-Internet-on-the-go.svg" alt="mobile-img" class="lazy" />
          </div>
        </div>
        <!-- end col-lg-5 -->
        <div class="col-lg-6">
          <div class="mobile-app-content">
            <div class="section-heading">
              <h2 class="sec__title mb-3">
                Selling Out? <br />
                Flippingo Buys Digital Assets Directly
              </h2>
              <p class="sec__desc mb-4">
                The free Flippingo mobile app is the fastest and easiest way to
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
              <a href="#" class="theme-btn me-2 bg-dark"><i class="fab fa-apple me-2"></i> Sell My Asset</a>
              <a href="#" class="theme-btn bg-success"><i class="fab fa-android me-2"></i> Know More</a>
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

  <!-- ================================
                                                                                                                                                     START BLOG AREA
                                                                                                                                                  ================================= -->
  <section class="blog-area section--padding">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="me-2 my-3">
          <h2 class="sec__title mb-3">Latest Business Insights & Guides</h2>
          <p class="sec__desc">
            Stay ahead with expert advice, growth hacks, and step-by-step guides<br />
            tailored for entrepreneurs and digital business buyers.
          </p>
        </div>
        <a href="<?php echo e(route('blogs')); ?>" class="theme-btn">View all posts</a>
      </div>

      <div class="row mt-5">
        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-lg-4 col-md-6">
            <div class="card hover-y">
              <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>" class="card-image">
                <img src="<?php echo e(asset('storage/' . $blog->thumbnail)); ?>" alt="<?php echo e($blog->title); ?>" class="card-img-top" />
              </a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                </h4>
                <ul class="card-meta d-flex flex-wrap align-items-center">
                  <li><?php echo e($blog->created_at->format('d M, Y')); ?></li>
                  <li><span class="mx-1">-</span></li>
                  <li><a href="#"><?php echo e($blog->category->name ?? 'Uncategorized'); ?></a></li>
                </ul>
                <p class="card-text mt-3">
                  <?php echo e(Str::limit(strip_tags($blog->detail), 120, '...')); ?>

                </p>
                <div class="post-author d-flex align-items-center justify-content-between mt-3">
                  <div>
                    <!-- <img src="<?php echo e(asset('assets/images/testi-img7.jpg')); ?>" alt="author" /> -->
                    <span>By</span>
                    <a href="#">Admin</a>
                  </div>
                  <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>">Read more</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>


  <!-- end blog-area -->
  <!-- ================================
                                                                                                                                                     START BLOG AREA
                                                                                                                                                  ================================= -->

  <!-- ================================
                                                                                                                                                  START MOBILE AREA
                                                                                                                                                  ================================= -->

  <!-- end mobile-area -->
  <!-- ================================
                                                                                                                                                  END MOBILE AREA
                                                                                                                                                  ================================= -->

  <!-- ================================
                                                                                                                                                     START CLIENTLOGO AREA
                                                                                                                                                  ================================= -->

  <!-- end clientlogo-area -->
  <!-- ================================
                                                                                                                                                     START CLIENTLOGO AREA
                                                                                                                                                  ================================= -->

  <!-- ================================
                                                                                                                                                  START SUBSCRIBER AREA
                                                                                                                                                  ================================= -->
  <section class="subscriber-area mb-n5 position-relative z-index-2">
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
 <script>
  function flippingoHiwTabs() {
    return {
      current: 0,
      slides: <?php echo json_encode($homeSlides, 15, 512) ?>,

      // YOUTUBE (UNCHANGED)
      getYoutubeId(url) {
        if (!url) return '';
        if (url.includes('youtu.be/')) {
          return url.split('youtu.be/')[1]?.split('?')[0];
        }
        if (url.includes('embed/')) {
          return url.split('embed/')[1]?.split('?')[0];
        }
        if (url.includes('watch')) {
          return new URL(url).searchParams.get('v');
        }
        return '';
      },

      // VIMEO HELPER
      getVimeoEmbed(url) {
        if (!url) return '';
        const id = url.split('/').pop();
        return `https://player.vimeo.com/video/${id}?autoplay=0&muted=1&title=0&byline=0&portrait=0`;
      }
    }
  }
</script>



  <script>

    function toggleCountryDropdown(event) {
      event.stopPropagation(); // Prevent click from closing immediately
      const menu = document.getElementById('countryDropdownMenu');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    function selectCountry(element) {
      const value = element.innerText.trim();
      document.getElementById('selectedCountry').textContent = value;
      document.getElementById('countryInput').value = value; // <-- set hidden input
      document.getElementById('countryDropdownMenu').style.display = 'none';
    }

    function selectCategory(element) {
      const value = element.dataset.value; // use slug/value for form
      const text = element.firstChild.textContent.trim(); // show only name
      document.getElementById('selectedCategory').textContent = text;
      document.getElementById('categoryInput').value = value; // <-- pass slug/value
      document.getElementById('categoryDropdownMenu').style.display = 'none';
    }


    function filterCountries(searchText) {
      const items = document.querySelectorAll('#countryList li');
      items.forEach(item => {
        const text = item.innerText.toLowerCase();
        item.style.display = text.includes(searchText.toLowerCase()) ? 'flex' : 'none';
      });
    }



    function toggleCategoryDropdown() {
      const menu = document.getElementById('categoryDropdownMenu');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }


    function filterCategories(searchText) {
      const items = document.querySelectorAll('#categoryList li');
      items.forEach(item => {
        const text = item.innerText.toLowerCase();
        item.style.display = text.includes(searchText.toLowerCase()) ? 'flex' : 'none';
      });
    }

    // Close dropdowns if clicked outside
    document.addEventListener('click', function (event) {
      const countryDropdown = document.getElementById('countryDropdownToggle');
      const countryMenu = document.getElementById('countryDropdownMenu');
      if (!countryDropdown.contains(event.target) && !countryMenu.contains(event.target)) {
        countryMenu.style.display = 'none';
      }

      const categoryDropdown = document.querySelector('.category-dropdown .dropdown-toggle');
      const categoryMenu = document.getElementById('categoryDropdownMenu');
      if (!categoryDropdown.contains(event.target) && !categoryMenu.contains(event.target)) {
        categoryMenu.style.display = 'none';
      }
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const input = document.getElementById("flippingonewInnerSearchInput");
      if (!input) return;

      let dropdown = null;
      let timeout = null;

      function resolveStorageImage(path) {
        if (!path) return null;
        path = path.replace(/^\/?storage\//, '');
        return `/storage/${path}`;
      }

      input.addEventListener("input", function () {
        const value = this.value.toLowerCase().trim();

        if (dropdown) dropdown.remove();
        if (!value || value.length < 2) return;

        clearTimeout(timeout);

        timeout = setTimeout(() => {
          fetch(`/listings/search?q=${encodeURIComponent(value)}`, {
            headers: {
              "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
            }
          })
            .then(res => res.json())
            .then(res => {
              if (!res.data || !res.data.length) return;

              dropdown = document.createElement("div");
              dropdown.className = "flippingonew-inner-dropdown";

              res.data.slice(0, 5).forEach(item => {
                const div = document.createElement("div");
                div.className = "flippingonew-inner-item";

                const imageUrl = resolveStorageImage(item.image);

                const imageHtml = imageUrl
                  ? `<img src="${imageUrl}"
                                                         style="width:32px;height:32px;border-radius:6px;object-fit:cover;">`
                  : `<div class="flippingonew-inner-icon"
                                                         style="background:${item.type === "category" ? "#6f42c1" : "#0d6efd"}">
                                                        ${item.type === "category" ? "ðŸ“‚" : "ðŸ“„"}
                                                     </div>`;

                div.innerHTML = `
                                                  ${imageHtml}
                                                  <div class="flippingonew-inner-title">
                                                    ${item.title || 'Listing'}
                                                  </div>
                                                `;

                div.onclick = (e) => {
                  e.stopPropagation();   // âœ… IMPORTANT

                  input.value = item.title || '';

                  if (dropdown) {
                    dropdown.remove();
                    dropdown = null;
                  }

                  // OPTIONAL auto-submit
                  // document.getElementById("searchForm").submit();
                };
                dropdown.appendChild(div);
              });

              input.parentElement.appendChild(dropdown);
            });
        }, 300);
      });

      document.addEventListener("click", function (e) {
        if (!input.contains(e.target) && dropdown) {
          dropdown.remove();
          dropdown = null;
        }
      });
    });
  </script>

  <script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        // Remove active class from all buttons
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const category = btn.getAttribute('data-category');
        const groups = document.querySelectorAll('.submission-group');

        groups.forEach(group => {
          if (category === 'all') {
            group.style.display = group.getAttribute('data-group') === 'all' ? '' : 'none';
          } else {
            group.style.display = group.getAttribute('data-group') === category ? '' : 'none';
          }
        });
      });
    });
  </script>

  <script>
    const track = document.querySelector('.popular-slider-track');
    const cards1 = document.querySelectorAll('.p-card-item');
    let currentSlide = 0;
    const slidesPerView = 5;
    const cardGap = 20; // same as CSS gap
    const cardWidth = 220;

    function goToSlide(index) {
      const offset = -index * (cardWidth + cardGap);
      track.style.transform = `translateX(${offset}px)`;
    }

    setInterval(() => {
      const maxSlide = cards1.length - slidesPerView;
      currentSlide = (currentSlide + 1) % (maxSlide + 1);
      goToSlide(currentSlide);
    }, 3000);
  </script>

  <script>
    document.querySelectorAll('.p-card-item').forEach(card => {
      const platform = card.getAttribute('data-platform');
      let color = "#ff0000";

      switch (platform) {
        case "instagram":
          color = "#E1306C"; // Instagram pink
          break;
        case "youtube":
          color = "#FF0000"; // YouTube red
          break;
        case "telegram":
          color = "#0088cc"; // Telegram blue
          break;
        case "x":
          color = "#000000"; // Black for X
          break;
      }

      card.style.setProperty('--border-color', color);
    });
  </script>

  <script>
    const swiper = new Swiper(".reviewSwiper", {
      slidesPerView: 4,
      spaceBetween: 30,
      slidesPerGroup: 1,
      loop: true,

      autoplay: {
        delay: 3000,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        1024: { slidesPerView: 4 },
        768: { slidesPerView: 2 },
        480: { slidesPerView: 1 }
      }
    });
  </script>
  <script>
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
      const target = +counter.getAttribute('data-target');
      let count = 0;
      const duration = 2000; // total time in milliseconds
      const increment = target / (duration / 10);

      const update = () => {
        count += increment;
        if (count >= target) {
          counter.textContent = target;
        } else {
          counter.textContent = Math.floor(count);
          requestAnimationFrame(update); // smoother than setInterval
        }
      };

      update();
    });
  </script>


  <script>
    let testimonials = [];
    let activeIndex = 0;

    const imageContainer = document.getElementById('image-container');
    const nameElement = document.getElementById('name');
    const designationElement = document.getElementById('designation');
    const quoteElement = document.getElementById('quote');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    let autoplayInterval;

    function updateTestimonial(direction) {
      activeIndex = (activeIndex + direction + testimonials.length) % testimonials.length;

      testimonials.forEach((testimonial, index) => {
        let img = imageContainer.querySelector(`[data-index="${index}"]`);
        if (!img) {
          img = document.createElement('img');
          img.src = testimonial.author_image
            ? `/storage/${testimonial.author_image}`
            : "<?php echo e(asset('assets/images/default-avatar.png')); ?>";
          img.alt = testimonial.author_name;
          img.classList.add('testimonial-image');
          img.dataset.index = index;
          imageContainer.appendChild(img);
        }

        const offset = index - activeIndex;
        const absOffset = Math.abs(offset);
        const zIndex = testimonials.length - absOffset;
        const opacity = index === activeIndex ? 1 : 0.7;
        const scale = 1 - (absOffset * 0.15);
        const translateY = offset === -1 ? '-20%' : offset === 1 ? '20%' : '0%';
        const rotateY = offset === -1 ? '15deg' : offset === 1 ? '-15deg' : '0deg';

        img.style.zIndex = zIndex;
        img.style.opacity = opacity;
        img.style.transform = `translateY(${translateY}) scale(${scale}) rotateY(${rotateY})`;
      });

      nameElement.textContent = testimonials[activeIndex].author_name;
      designationElement.textContent = testimonials[activeIndex].designation ?? '';
      quoteElement.innerHTML = testimonials[activeIndex].feedback
        .split(' ')
        .map(word => `<span class="word">${word}</span>`)
        .join(' ');

      animateWords();
    }

    function animateWords() {
      const words = quoteElement.querySelectorAll('.word');
      words.forEach((word, index) => {
        word.style.opacity = '0';
        word.style.transform = 'translateY(10px)';
        word.style.filter = 'blur(10px)';
        setTimeout(() => {
          word.style.transition = 'opacity 0.2s ease-in-out, transform 0.2s ease-in-out, filter 0.2s ease-in-out';
          word.style.opacity = '1';
          word.style.transform = 'translateY(0)';
          word.style.filter = 'blur(0)';
        }, index * 20);
      });
    }

    function handleNext() {
      updateTestimonial(1);
    }

    function handlePrev() {
      updateTestimonial(-1);
    }

    prevButton.addEventListener('click', handlePrev);
    nextButton.addEventListener('click', handleNext);

    // Fetch testimonials dynamically
    fetch("<?php echo e(route('testimonials')); ?>")
      .then(res => res.json())
      .then(data => {
        testimonials = data;
        if (testimonials.length > 0) {
          updateTestimonial(0);
          autoplayInterval = setInterval(handleNext, 5000);
        }
      });

    // Stop autoplay on manual navigation
    [prevButton, nextButton].forEach(button => {
      button.addEventListener('click', () => {
        clearInterval(autoplayInterval);
      });
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      fetch("<?php echo e(route('reels')); ?>")
        .then(response => response.json())
        .then(reels => {
          const container = document.getElementById("reels-container");
          container.innerHTML = ""; // clear "Loading..."

          if (reels.length === 0) {
            container.innerHTML = '<p class="text-center text-muted">No reels found.</p>';
            return;
          }

          reels.forEach(reel => {
            let reelHtml = '';
            if (reel.reel_type === "upload" && reel.video_file) {
              reelHtml = `
                                                                                                                  <video controls loop muted autoplay playsinline>
                                                                                                                    <source src="/storage/${reel.video_file}" type="video/mp4">
                                                                                                                    Your browser does not support video.
                                                                                                                  </video>`;
            } else if (reel.reel_type === "youtube" && reel.youtube_url) {
              // Ensure YouTube embed URL with autoplay, mute & loop
              let ytUrl = reel.youtube_url;
              if (ytUrl.includes("watch?v=")) {
                const videoId = ytUrl.split("watch?v=")[1].split("&")[0];
                ytUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1&loop=1&playlist=${videoId}`;
              }
              reelHtml = `
                                                                                                                  <div class="video ratio ratio-16x9">
                                                                                                                    <iframe src="${ytUrl}" frameborder="0"
                                                                                                                      allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                                                                                  </div>`;
            } else if (reel.reel_type === "facebook" && reel.facebook_url) {
              // Facebook embed with autoplay & loop
              let fbUrl = `https://www.facebook.com/plugins/video.php?href=${encodeURIComponent(reel.facebook_url)}&autoplay=1&mute=1&loop=1&show_text=false`;
              reelHtml = `
                                                                                                                  <div class="video ratio ratio-16x9">
                                                                                                                    <iframe src="${fbUrl}" frameborder="0"
                                                                                                                      allow="autoplay; clipboard-write; encrypted-media; picture-in-picture"
                                                                                                                      allowfullscreen></iframe>
                                                                                                                  </div>`;
            } else {
              reelHtml = `<p class="text-muted text-center">Invalid reel</p>`;
            }

            container.insertAdjacentHTML("beforeend", `
                                                                                                                                    <div class="col-md-3 col-sm-6">
                                                                                                                                      <div class="reel-card video">${reelHtml}</div>
                                                                                                                                    </div>
                                                                                                                                  `);
          });
        })
        .catch(error => {
          console.error("Error fetching reels:", error);
          document.getElementById("reels-container").innerHTML =
            '<p class="text-center text-danger">Failed to load reels.</p>';
        });
    });
  </script>

  <script>
    function scrollTabs(amount) {
      const container = document.getElementById("tabsContainer");
      container.scrollBy({ left: amount, behavior: "smooth" });
    }
  </script>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const track = document.querySelector(".flippingonew-slider-track");
      const next = document.querySelector(".flippingonew-slider-btn.next");
      const prev = document.querySelector(".flippingonew-slider-btn.prev");

      if (!track) return;

      const scrollAmount = 220;

      next.addEventListener("click", () => {
        track.scrollBy({ left: scrollAmount, behavior: "smooth" });
      });

      prev.addEventListener("click", () => {
        track.scrollBy({ left: -scrollAmount, behavior: "smooth" });
      });
    });
  </script>

  <script>
    const categorySelect = document.getElementById("categorySelect");
    const countrySelect = document.getElementById("countrySelect");
    const quickCategories = document.getElementById("quickCategories");
    const groups = document.querySelectorAll(".submission-group");
    const tabButtons = document.querySelectorAll(".tab-btn");
    const filterButtons = document.querySelectorAll(".filter-btn");

    let activeFilters = {
      category: "all",
      country: "all",
      verified: false,
      premium: false
    };

    // =====================================
    // APPLY FILTERS
    // =====================================
    function applyFilters() {
      groups.forEach(group => {
        const groupCategory = group.dataset.group;

        // 🔑 GROUP VISIBILITY
        if (activeFilters.category === "all") {
          group.style.display = groupCategory === "all" ? "" : "none";
        } else {
          group.style.display = groupCategory === activeFilters.category ? "" : "none";
        }

        // 🔑 FILTER CARDS INSIDE VISIBLE GROUP
        if (group.style.display !== "none") {
          let hasVisible = false;

          group.querySelectorAll(".wishlist-product-card").forEach(card => {
            const matchCountry =
              activeFilters.country === "all" ||
              card.dataset.country === activeFilters.country;

            const matchVerified =
              !activeFilters.verified || card.dataset.verified === "1";

            const matchPremium =
              !activeFilters.premium || card.dataset.premium === "1";

            const visible = matchCountry && matchVerified && matchPremium;

            card.style.display = visible ? "" : "none";
            if (visible) hasVisible = true;
          });

          // Hide empty group
          if (!hasVisible) {
            group.style.display = "none";
          }
        }
      });
    }

    // =====================================
    // CATEGORY DROPDOWN
    // =====================================
    categorySelect.addEventListener("change", function () {
      activeFilters.category = this.value;

      // Show quick categories ONLY when "All"
      // if (this.value === "all") {
      //   quickCategories.style.display = "flex";
      // } else {
      //   quickCategories.style.display = "none";
      // }

      // Reset quick button active state
      tabButtons.forEach(btn => btn.classList.remove("active"));

      applyFilters();
    });

    // =====================================
    // QUICK CATEGORY BUTTONS
    // =====================================
    tabButtons.forEach(btn => {
      btn.addEventListener("click", function () {
        activeFilters.category = this.dataset.category;
        categorySelect.value = this.dataset.category;

        tabButtons.forEach(b => b.classList.remove("active"));
        this.classList.add("active");

        // Hide quick categories after selection
        // quickCategories.style.display = "none";

        applyFilters();
      });
    });

    // =====================================
    // COUNTRY FILTER
    // =====================================
    countrySelect.addEventListener("change", function () {
      activeFilters.country = this.value;
      applyFilters();
    });

    // =====================================
    // VERIFIED / PREMIUM FILTERS
    // =====================================
    filterButtons.forEach(btn => {
      btn.addEventListener("click", function () {
        this.classList.toggle("active");

        const type = this.dataset.filter;

        if (type === "verified") {
          activeFilters.verified = this.classList.contains("active");
        }

        if (type === "premium") {
          activeFilters.premium = this.classList.contains("active");
        }

        applyFilters();
      });
    });


    // =====================================
    // INITIAL LOAD
    // =====================================
    document.addEventListener("DOMContentLoaded", () => {
      quickCategories.style.display = "flex";
      applyFilters();
    });
  </script>
  <script>
    document.querySelectorAll('.wishlist-image-wrapper').forEach(function (wrapper) {

      let slider = wrapper.querySelector('.wishlist-main-slider');
      let images = slider.querySelectorAll('.slide-img');
      let total = images.length;
      let index = 0;

      // Next
      wrapper.querySelector('.wishlist-next').addEventListener('click', function () {
        index = (index + 1) % total;
        slider.style.transform = `translateX(-${index * 100}%)`;
      });

      // Prev
      wrapper.querySelector('.wishlist-prev').addEventListener('click', function () {
        index = (index - 1 + total) % total;
        slider.style.transform = `translateX(-${index * 100}%)`;
      });
    });

  </script>
  <script>
const gvOpen = document.getElementById("gvFilterOpenBtn");
const gvClose = document.getElementById("gvFilterCloseBtn");
const gvSheet = document.getElementById("gvFilterSheet");
const gvBackdrop = document.getElementById("gvFilterBackdrop");

gvOpen.onclick = () => {
    gvSheet.classList.add("show");
    gvBackdrop.classList.add("show");
};

function gvCloseSheet() {
    gvSheet.classList.remove("show");
    gvBackdrop.classList.remove("show");
}

gvClose.onclick = gvCloseSheet;
gvBackdrop.onclick = gvCloseSheet;
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/index.blade.php ENDPATH**/ ?>