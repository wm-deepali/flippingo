

<?php $__env->startSection('title'); ?>
  <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

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
    padding-bottom: 40px;
    width: 100%;
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
      padding-top: 190px !important;
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
    content: "";
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
  }

  .wishlist-card {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
    margin-top: 40px;
    padding-bottom: 50px;
  }

  .wishlist-product-card {
    width: 100%;
    height: 560px;
    background: white;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .wishlist-product-card img {
    width: 100%;
    height: 270px;
  }

  .wishlist-budge {
    position: relative;
    top: -264px;
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

  .wishlist-button {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;

  }

  .wishlist-button p {
    width: 50%;
    margin: 0;
    padding: 0px 10px;
    border: 1px solid lightgray;
    background: #a19f9f33;
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
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 10px;
  }

  .wishlist-left {
    width: 100%;
    height: 60px;
    background-color: #d3d3d32b;
    border-radius: 3px;
    padding: 10px;
    display: flex;
    align-items: center;
    gap: 10px;

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
    /* Default visible */
    transition: opacity 0.3s ease;
    margin-top: -20px;
  }

  .wishlist-product-card:hover .product-details-hover {
    display: none;
    /* Hide on card hover */
  }

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
  <section class="hero-section" id="home" style="margin-top: 90px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-6">
          <div class="hero-section-text">
            <h1>#1 Platform to Buy & Sell Digital Assets</h1>
            <p>Flippingo is a platform for Posting Free Ads - it only takes a few simple steps! Select the right
              category and publish your classified ad for free.</p>
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
                <div class="swiper-wrapper" style="padding: 20px 20px;">
                  <div class="review-sectio-host">
                    <div class="col-md-6 col-12">
                      <div class="review-card">
                        <div class="review-source"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Trustpilot_logo.png"></div>
                        <div class="review-stars review-card-star">
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
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/800px-Google_2015_logo.svg.png">
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
                                                                      <div class="stars">★★★☆☆</div>
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
                                                                      <div class="stars">★★☆☆☆</div>
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
              <a class="batton" href="<?php echo e(Route('listing-details')); ?>">View Listing</a>
            </div>
            <!--<img alt="img" class="dots" src="<?php echo e(asset('site_assets')); ?>/img/dots.png">-->
            <img alt="img" class="landing-slider" src="<?php echo e(asset('site_assets')); ?>/img/landing-slider.png">
          </div>
        </div>
        <div class="col-xl-6" style="display: flex; justify-content: end;">
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

            <!-- Search Input -->
            <div class="form-group icon-input">
              <i class="fas fa-search"></i>
              <input type="text" placeholder="I'm looking for..." />
            </div>
            <div class="form-group country-dropdown">
              <div class="dropdown-toggle" id="countryDropdownToggle">
                <div>
                  <i class="fa-solid fa-globe"
                    style="color: #ffffff; font-size: 14px; background: black; padding: 4px; border-radius: 3px; margin-right: 5px;"></i>
                  <span id="selectedCountry" style="font-weight: 300; color: #000;">Country</span>
                </div>
              </div>

              <div class="dropdown-menu" id="countryDropdownMenu">
                <ul style="padding-left: 20px;">
                  <li onclick="selectCountry(this)" data-disabled="false">India</li>
                  <li onclick="selectCountry(this)" data-disabled="false">America</li>
                  <li onclick="selectCountry(this)" data-disabled="false">England</li>
                </ul>
              </div>
            </div>

            <!-- Category Dropdown -->
            <div class="form-group category-dropdown">
              <div class="dropdown-toggle" onclick="toggleDropdown()">
                <div>
                  <i class="fas fa-tags" style=" color: #ffffff;
                                                                    font-size: 14px;
                                                                    background: black;
                                                                    padding: 4px;
                                                                    border-radius: 3px; 
                                                                    margin-right: 5px;"></i>
                  <span id="selectedCategory" style="font-weight: 300; color: #000;">Category</span>
                </div>
                <!-- <i class="fas fa-chevron-down arrow-icon"></i> -->

              </div>

              <div class="dropdown-menu" id="dropdownMenu">
                <input type="text" placeholder="Search..." class="dropdown-search"
                  oninput="filterCategories(this.value)" />
                <ul id="categoryList">
                  <li onclick="selectCategory(this)" data-disabled="false">
                    Websites <span class="badge">1</span>
                  </li>
                  <li onclick="selectCategory(this)" data-disabled="true" class="disabled">
                    Facebook Account <span class="badge">0</span>
                  </li>
                  <li onclick="selectCategory(this)" data-disabled="false">
                    Instagram Pages <span class="badge">0</span>
                  </li>
                  <li onclick="selectCategory(this)" data-disabled="false">
                    Telegram Account <span class="badge">0</span>
                  </li>
                  <li onclick="selectCategory(this)" data-disabled="false">
                    Theme And Scripts <span class="badge">0</span>
                  </li>
                  <li onclick="selectCategory(this)" data-disabled="false">
                    Twitter Account <span class="badge">0</span>
                  </li>
                  <li onclick="selectCategory(this)" data-disabled="false">
                    YouTube Channel <span class="badge">0</span>
                  </li>
                </ul>
              </div>
            </div>


            <!-- Price Range -->
            <div class="form-group price-range">
              <div class="icon-input">
                <!-- <i class="fas fa-dollar-sign"></i> -->
                <input type="number" placeholder="Min Price" />
              </div>
              <span>-</span>
              <div class="icon-input">
                <!-- <i class="fas fa-dollar-sign"></i> -->
                <input type="number" placeholder="Max Price" />
              </div>
            </div>

            <button class="search-btn">Search</button>
          </div>


        </div>
      </div>
    </div>
  </section>
  <!-- end hero-wrapper -->
  <!-- ================================
                                                                    END HERO-WRAPPER AREA
                                                                    ================================= -->

  <!-- ================================
                                                                    START CAT AREA
                                                                    ================================= -->


  <section class="cat-area section--padding">
    <div class="container">
      <div class="">
        <h2 class="sec__title mb-3 text-center">Most Popular Categories</h2>
        <p class="sec__desc text-center">
          Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, <br />
          a feugiat eros. Nunc ut lacinia tortors.
        </p>
      </div>
      <div class="social-media-slider">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="social-media-icon-section">
            <div class="s-image-card">
              <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?> Icon" />
            </div>
            <h3><?php echo e($category->name); ?></h3>
            <p>230 Accounts</p>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>

  <!-- end cat-area -->
  <!-- ================================
                                                                    END CAT AREA
                                                                    ================================= -->

  <!-- ================================
                                                                    START HIW AREA
                                                                    ================================= -->
  <section class="hiw-area bg-gray section--padding">
    <div class="container">
      <div class="">
        <h2 class="sec__title mb-3 text-center">How to Buy a Business on Flippa</h2>
        <p class="sec__desc text-center">
          Discover the simple steps to find, evaluate, and purchase your dream online business. <br />
          Whether you're a first-time buyer or seasoned investor, we make the process smooth.
        </p>
      </div>
      <!-- end section-heading -->
      <div class="row mt-5">
        <!-- Card 1 -->
        <div class="col-lg-3 col-md-6">
          <div class="flip-card">
            <div class="flip-card-inner">
              <!-- Front -->
              <div class="flip-card-front">
                <img src="<?php echo e(asset('assets')); ?>/images/deal.png" width="74px" />
                <h4 class="mt-3">Apply For Sponsorship</h4>
              </div>
              <!-- Back -->
              <div class="flip-card-back">
                <p>
                  If you want to get sponsorship from us kindly read our requirements first,
                  then apply by clicking on get sponsorship button.
                </p>
                <button>View More</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 col-md-6">
          <div class="flip-card">
            <div class="flip-card-inner">
              <!-- Front -->
              <div class="flip-card-front">
                <img src="<?php echo e(asset('assets')); ?>/images/approved.png" width="74px" />
                <h4 class="mt-3">Wait For Approval</h4>
              </div>
              <!-- Back -->
              <div class="flip-card-back">
                <p>
                  After applying for sponsorship for your page or channel, please wait for our approval.
                  Once you are approved, then proceed further.
                </p>
                <button>View More</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 col-md-6">
          <div class="flip-card">
            <div class="flip-card-inner">
              <!-- Front -->
              <div class="flip-card-front">
                <img src="<?php echo e(asset('assets')); ?>/images/brand.png" width="74px" />
                <h4 class="mt-3">Start Promoting Brand</h4>
              </div>
              <!-- Back -->
              <div class="flip-card-back">
                <p>
                  Start promoting brand logo, links, tools, & services. Earn money by promoting the brand’s
                  content and products.
                </p>
                <button>View More</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 col-md-6">
          <div class="flip-card">
            <div class="flip-card-inner">
              <!-- Front -->
              <div class="flip-card-front">
                <img src="<?php echo e(asset('assets')); ?>/images/banking.png" width="74px" />
                <h4 class="mt-3">Get Paid For Promotion</h4>
              </div>
              <!-- Back -->
              <div class="flip-card-back">
                <p>
                  Get paid for promotion. We provide instant, daily, and weekly payments
                  to our influencers.
                </p>
                <button>View More</button>
              </div>
            </div>
          </div>
        </div>
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
                                                                    START CARD AREA
                                                                    ================================= -->

  <section class="card-area section-padding">
    <div class="container">
      <div class="">
        <h2 class="sec__title mb-3 text-center">Most Searched Businesses</h2>
        <p class="sec__desc text-center">
          Morbi convallis bibendum urna ut viverra. Maecenas quis consequat
          libero, <br />
          a feugiat eros. Nunc ut lacinia tortors.
        </p>
      </div>

      <!-- Tabs -->
      <div class="my-4">
        <button class="tab-btn active" data-category="all">All</button>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <button class="tab-btn" data-category="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div id="submissions-container">

        
        <div class="submission-group wishlist-card" data-group="all">
          <?php $__currentLoopData = $allSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $catSlug = $submission->form->category->slug ?? 'uncategorized';
              $catName = $submission->form->category->name ?? '';

              $fields = json_decode($submission->data, true);

              $productTitle = $fields['product_title']['value'] ?? 'No Title';
              $offeredPrice = $fields['offered_price']['value'] ?? '0';

              $imageFile = $submission->imageFile;
              $summaryFields = $submission->summaryFields;
            ?>
            <div class="wishlist-product-card" data-category="<?php echo e($catSlug); ?>">
              <?php if($imageFile): ?>
                <img src="<?php echo e(asset('storage/' . $imageFile['file_path'])); ?>" />
              <?php else: ?>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
              <?php endif; ?>
              <div class="wishlist-budge">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="budge-active">
                    <p><i class="fa-solid fa-circle-check"></i> Active</p>
                  </div>
                  <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i></h4>

                </div>

              </div>
              <div class="product-details-hover">
                <div class="wishlist-button">
                  <p><?php echo e($catName); ?></p>
                  <div class="budge-active1">
                    <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                  </div>

                </div>
                <h3 class="mt-2 " style="color: #000;"><?php echo e($productTitle); ?></h3>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="m-0">By
                    <?php echo e(($submission->customer->first_name ?? '') . ' ' . ($submission->customer->last_name ?? '')); ?>

                  </p>
                  <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                </div>
                <div class="wishlist-item-card">
                  <?php if(!empty($summaryFields)): ?>
                    <?php
                      // Use array_filter when summaryFields is a plain array
                      $textFields = array_filter($summaryFields, function ($field) {
                        return
                          isset($field['field_id']) &&
                          Str::startsWith($field['field_id'], 'text_');
                      });
                    ?>

                    <?php if(!empty($textFields)): ?>
                      <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="wishlist-left">
                          <p class="m-0" style="color: green;">
                            <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                          </p>
                          <div class="d-flex flex-column">
                            <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                            <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?></h5>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  <?php endif; ?>

                </div>
                <div class="wishlist-price d-flex justify-content-between mt-3">
                  <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>

                  <button type="button" class="btn btn-dark"
                    onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission->id])); ?>'">
                    View Listing
                  </button>
                </div>
              </div>

              <div class="more-info" data-aos="fade-up" data-aos-duration="500">
                <div class="wishlist-button">
                  <p><?php echo e($catName); ?></p>
                  <div class="budge-active1">
                    <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                  </div>

                </div>
                <h3 class="mt-2" style="color: #000;"><?php echo e($productTitle ?? ''); ?></h3>

                <?php if(!empty($summaryFields)): ?>
                  <?php
                    // Filter textarea fields using array_filter
                    $textareaFields = array_filter($summaryFields, function ($field) {
                      return
                        isset($field['field_id']) &&
                        Str::startsWith($field['field_id'], 'textarea');
                    });
                  ?>

                  <?php if(!empty($textareaFields)): ?>
                    <p style="font-size: 13px;">
                      <?php $__currentLoopData = $textareaFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($field['icon'])): ?>
                          <i class="<?php echo e($field['icon']); ?>" style="margin-right: 4px;"></i>
                        <?php endif; ?>
                        <?php echo e(\Illuminate\Support\Str::limit($field['value'], 100, '...')); ?>


                        
                        <?php if($index !== array_key_last($textareaFields)): ?>
                          &nbsp;|&nbsp;
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                  <?php endif; ?>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center">
                  <p class="m-0">By
                    <?php echo e(($submission->customer->first_name ?? '') . ' ' . ($submission->customer->last_name ?? '')); ?>

                  </p>
                  <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                </div>
                <div class="wishlist-item-card">
                  <?php if(!empty($summaryFields)): ?>
                    <?php
                      // Use array_filter when summaryFields is a plain array
                      $textFields = array_filter($summaryFields, function ($field) {
                        return
                          isset($field['field_id']) &&
                          Str::startsWith($field['field_id'], 'text_');
                      });
                    ?>

                    <?php if(!empty($textFields)): ?>
                      <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="wishlist-left">
                          <p class="m-0" style="color: green;">
                            <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                          </p>
                          <div class="d-flex flex-column">
                            <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                            <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?></h5>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
                <div class="wishlist-price d-flex justify-content-between mt-3">
                  <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>
                  <button type="button" class="btn btn-dark"
                    onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission->id])); ?>'">
                    View Listing
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="submission-group wishlist-card" data-group="<?php echo e($category->slug); ?>" style="display:none;">
            <?php if(isset($submissionsByCategory[$category->id])): ?>
              <?php
                $submission = $submissionsByCategory[$category->id];
                $fields = json_decode($submission->data, true);

                $productTitle = $fields['product_title']['value'] ?? 'No Title';
                $offeredPrice = $fields['offered_price']['value'] ?? '0';

                $imageFile = $submission->imageFile;
                $summaryFields = $submission->summaryFields;

              ?>

              <div class="wishlist-product-card" data-category="<?php echo e($category->slug); ?>">
                <?php if($imageFile): ?>
                  <img src="<?php echo e(asset('storage/' . $imageFile['file_path'])); ?>" />
                <?php else: ?>
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                <?php endif; ?>
                <div class="wishlist-budge">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="budge-active">
                      <p><i class="fa-solid fa-circle-check"></i> Active</p>
                    </div>
                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i></h4>

                  </div>

                </div>
                <div class="product-details-hover">
                  <div class="wishlist-button">
                    <p><?php echo e($catName); ?></p>
                    <div class="budge-active1">
                      <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                    </div>
                  </div>
                  <h3 class="mt-2 " style="color: #000;"><?php echo e($productTitle); ?></h3>
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="m-0">By
                      <?php echo e(($submission->customer->first_name ?? '') . ' ' . ($submission->customer->last_name ?? '')); ?>

                    </p>
                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                  </div>
                  <div class="wishlist-item-card">
                    <?php if(!empty($summaryFields)): ?>
                      <?php
                        // Use array_filter when summaryFields is a plain array
                        $textFields = array_filter($summaryFields, function ($field) {
                          return
                            isset($field['field_id']) &&
                            Str::startsWith($field['field_id'], 'text_');
                        });
                      ?>

                      <?php if(!empty($textFields)): ?>
                        <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="wishlist-left">
                            <p class="m-0" style="color: green;">
                              <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                            </p>
                            <div class="d-flex flex-column">
                              <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                              <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?></h5>
                            </div>
                          </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    <?php endif; ?>

                  </div>
                  <div class="wishlist-price d-flex justify-content-between mt-3">
                    <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>
                    <button type="button" class="btn btn-dark"
                      onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission->id])); ?>'">
                      View Listing
                    </button>

                  </div>

                </div>
                <div class="more-info" data-aos="fade-up" data-aos-duration="500">
                  <div class="wishlist-button">
                    <p><?php echo e($catName); ?></p>
                    <div class="budge-active1">
                      <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                    </div>
                  </div>
                  <h3 class="mt-2" style="color: #000;"><?php echo e($productTitle ?? ''); ?></h3>
                  <?php if(!empty($summaryFields)): ?>
                    <?php
                      // Filter textarea fields using array_filter
                      $textareaFields = array_filter($summaryFields, function ($field) {
                        return
                          isset($field['field_id']) &&
                          Str::startsWith($field['field_id'], 'textarea');
                      });
                    ?>

                    <?php if(!empty($textareaFields)): ?>
                      <p style="font-size: 13px;">
                        <?php $__currentLoopData = $textareaFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if(!empty($field['icon'])): ?>
                            <i class="<?php echo e($field['icon']); ?>" style="margin-right: 4px;"></i>
                          <?php endif; ?>
                          <?php echo e(\Illuminate\Support\Str::limit($field['value'], 100, '...')); ?>


                          
                          <?php if($index !== array_key_last($textareaFields)): ?>
                            &nbsp;|&nbsp;
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </p>
                    <?php endif; ?>
                  <?php endif; ?>
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="m-0">By
                      <?php echo e(($submission->customer->first_name ?? '') . ' ' . ($submission->customer->last_name ?? '')); ?>

                    </p>
                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                  </div>
                  <div class="wishlist-item-card">
                    <?php if(!empty($summaryFields)): ?>
                      <?php
                        // Use array_filter when summaryFields is a plain array
                        $textFields = array_filter($summaryFields, function ($field) {
                          return
                            isset($field['field_id']) &&
                            Str::startsWith($field['field_id'], 'text_');
                        });
                      ?>

                      <?php if(!empty($textFields)): ?>
                        <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="wishlist-left">
                            <p class="m-0" style="color: green;">
                              <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                            </p>
                            <div class="d-flex flex-column">
                              <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                              <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?></h5>
                            </div>
                          </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    <?php endif; ?>

                  </div>
                  <div class="wishlist-price d-flex justify-content-between mt-3">
                    <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i><?php echo e($offeredPrice); ?></h2>
                    <button type="button" class="btn btn-dark"
                      onclick="window.location.href='<?php echo e(route('listing-details', ['id' => $submission->id])); ?>'">
                      View Listing
                    </button>
                  </div>
                </div>
              </div>

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
        Explore a range of digital assets ready to buy or sell — from premium domains
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
        Explore a range of digital assets ready to buy or sell — from premium domains to full-fledged websites,
        <br>digital
        templates, and more.
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
        Explore a range of digital assets ready to buy or sell
      </p>
      <div class="row g-4 justify-content-center">

        <!-- Reel 1 -->
        <div class="col-md-3 col-sm-6">
          <div class="reel-card">
            <video controls loop muted autoplay playsinline>
              <source src="<?php echo e(asset('assets')); ?>/images/reels.mp4" type="video/mp4">
              Your browser does not support video.
            </video>
          </div>
        </div>

        <!-- Reel 2 -->
        <div class="col-md-3 col-sm-6">
          <div class="reel-card">
            <video controls loop muted autoplay playsinline>
              <source src="<?php echo e(asset('assets')); ?>/images/reels1.mp4" type="video/mp4">
              Your browser does not support video.
            </video>
          </div>
        </div>

        <!-- Reel 3 -->
        <div class="col-md-3 col-sm-6">
          <div class="reel-card">
            <video controls loop muted autoplay playsinline>
              <source src="<?php echo e(asset('assets')); ?>/images/reels.mp4" type="video/mp4">
              Your browser does not support video.
            </video>
          </div>
        </div>

        <!-- Reel 4 -->
        <div class="col-md-3 col-sm-6">
          <div class="reel-card">
            <video controls loop muted autoplay playsinline>
              <source src="<?php echo e(asset('assets')); ?>/images/reels.mp41" type="video/mp4">
              Your browser does not support video.
            </video>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="testimonial-reels-section py-5 bg-light">
    <div class="container">
      <h2 class="sec__title mb-3 text-center">Reels</h2>
      <p class="sec__desc text-center">
        Explore a range of digital assets ready to buy or sell
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
    function toggleDropdown() {
      document.getElementById('dropdownMenu').style.display =
        document.getElementById('dropdownMenu').style.display === 'block' ? 'none' : 'block';
    }

    function selectCategory(element) {
      if (element.dataset.disabled === "true") return;
      document.getElementById('selectedCategory').textContent = element.innerText.trim();
      document.getElementById('dropdownMenu').style.display = 'none';
    }

    function filterCategories(searchText) {
      const items = document.querySelectorAll('#categoryList li');
      items.forEach(item => {
        const text = item.innerText.toLowerCase();
        item.style.display = text.includes(searchText.toLowerCase()) ? 'flex' : 'none';
      });
    }

    // Hide dropdown when clicking outside
    document.addEventListener('click', function (e) {
      const dropdown = document.querySelector('.category-dropdown');
      if (!dropdown.contains(e.target)) {
        document.getElementById('dropdownMenu').style.display = 'none';
      }
    });
  </script>
  <script>
    // Toggle country dropdown
    document.getElementById('countryDropdownToggle').addEventListener('click', function (e) {
      e.stopPropagation(); // Prevent closing from document click
      const menu = document.getElementById('countryDropdownMenu');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

    // Select a country from dropdown
    function selectCountry(element) {
      if (element.dataset.disabled === "true") return;
      document.getElementById('selectedCountry').textContent = element.innerText.trim();
      document.getElementById('countryDropdownMenu').style.display = 'none';
    }

    // Close on outside click
    document.addEventListener('click', function (e) {
      const dropdown = document.querySelector('.country-dropdown');
      if (!dropdown.contains(e.target)) {
        document.getElementById('countryDropdownMenu').style.display = 'none';
      }
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/index.blade.php ENDPATH**/ ?>