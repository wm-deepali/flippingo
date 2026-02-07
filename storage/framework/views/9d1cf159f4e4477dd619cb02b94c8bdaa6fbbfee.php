

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Flippingo'); ?>

<?php $__env->stopSection(); ?>

<style>
    .wishlist-page {
        width: 93%;
        margin: auto;
        margin-top: 30px;
    }

    .wishlist-card {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
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

    /*.wishlist-product-card:hover .product-details-hover {*/
    /*    display: none;*/
       
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
  scrollbar-width: none; /* Firefox */
}
.tabs-container::-webkit-scrollbar {
  display: none; /* Chrome, Safari */
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
.icon-element-sm {
    width: 35px;
    height: 35px;
    line-height: 35px;
    font-size: 16px;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
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
    grid-template-columns: 1fr 1fr 1fr;
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
    height: 150px;
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
      width:90% !important;
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
  padding-bottom: 56.25%;     /* 16:9 = 9/16 = 0.5625 */
  height: 0;
  overflow: hidden;
  background: #000;           /* fallback dark bg if video fails to load */
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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
  object-fit: cover;          /* for images/videos – fills nicely */
}

/* Optional: nicer hover effect */
.flippingo-video-wrapper:hover {
  box-shadow: 0 10px 30px rgba(0,0,0,0.15);
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
.review-sectio-host .review-card{
    height: 120px !important;
        padding: 11px !important;
}
.review-source {
    font-weight: bold;
    margin-bottom: 7px !important;
    font-size: 18px;
}

.review-sectio-host .review-card{
    background: #fefefed8 !important;
}
</style>
<?php $__env->startSection('content'); ?>
                                                                                                                           
    <section class="card-area " style="padding-top:60px; padding-bottom:90px; margin-top:130px; background:#f0f5fb">
        <div class="container">
            <div class="card">
                <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                    <p class="card-text py-2">Showing 1 to 6 of 30 entries</p>
                    <div class="d-flex align-items-center">
                     <form id="sortForm" method="GET" action="<?php echo e(url()->current()); ?>" class="d-inline">
    <?php $__currentLoopData = request()->except('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(is_array($value)): ?>
            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="<?php echo e($key); ?>[]" value="<?php echo e($subValue); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <select class="form-select" id="sort" name="sort" onchange="this.form.submit()">
        <option value="">Default</option>
        <option value="price-low-to-high" <?php echo e(request('sort') == 'price-low-to-high' ? 'selected' : ''); ?>>Price: Low to High</option>
        <option value="price-high-to-low" <?php echo e(request('sort') == 'price-high-to-low' ? 'selected' : ''); ?>>Price: High to Low</option>
        <option value="new-first" <?php echo e(request('sort') == 'new-first' ? 'selected' : ''); ?>>Newest Listings</option>
        <option value="most-popular" <?php echo e(request('sort') == 'most-popular' ? 'selected' : ''); ?>>Most Popular</option>
        <option value="most-rated" <?php echo e(request('sort') == 'most-rated' ? 'selected' : ''); ?>>Most Rated</option>
    </select>
</form>


                        <ul class="filter-nav ms-2">
                            <li>
                                <a href="" class="active icon-element icon-element-sm"><i class="fal fa-list"></i></a>
                            </li>
                            <li>
                                <a href="" class="icon-element icon-element-sm" data-bs-toggle="tooltip"
                                    data-placement="top" title="Grid View"><i class="fal fa-th-large"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-lg-3">
    <div class="sidebar">
        <!-- Search & Clear buttons at topmost -->
        

        <form id="filter-form" method="GET" action="<?php echo e(route('listing-list')); ?>">
            <?php echo csrf_field(); ?>

            
            <div class="form-group mb-3">
                <span class="fal fa-search form-icon"></span>
                <input name="search" class="form-control form--control" type="text"
                       placeholder="What are you looking for?"
                       value="<?php echo e(request('search')); ?>">
            </div>

            
            <div class="form-group mb-3">
                <label for="country">Country</label>
                <select name="country" class="form-select">
                    <option value="">Select Country</option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->name); ?>" <?php echo e(request('country') == $country->name ? 'selected' : ''); ?>>
                            <?php echo e($country->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            
            <div class="form-group mb-3">
                <label for="for_sale">For Sale</label>
                <select name="for_sale" class="form-select">
                    <option value="">Select</option>
                    <option value="Yes" <?php echo e(request('for_sale') == 'Yes' ? 'selected' : ''); ?>>Yes</option>
                    <option value="No" <?php echo e(request('for_sale') == 'No' ? 'selected' : ''); ?>>No</option>
                </select>
            </div>

            
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Price</h4>
                    <div class="d-flex align-items-center">
                        <div class="form-group me-2">
                            <input name="price_min" class="form-control form--control ps-3" type="text" placeholder="3"
                                   value="<?php echo e(request('price_min')); ?>">
                        </div>
                        <div class="form-group me-2">
                            <input name="price_max" class="form-control form--control ps-3" type="text" placeholder="269"
                                   value="<?php echo e(request('price_max')); ?>">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Ratings</h4>
                    <?php for($i=5; $i>=1; $i--): ?>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="<?php echo e($i); ?>StarRadio" name="rating" value="<?php echo e($i); ?>"
                                   <?php echo e(request('rating') == $i ? 'checked' : ''); ?> />
                            <label class="custom-control-label" for="<?php echo e($i); ?>StarRadio">
                                <span class="star-rating d-inline-block line-height-24 font-size-15" data-rating="<?php echo e($i); ?>"></span>
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Dynamic Category Filters -->
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="category-filters" data-category="<?php echo e($category['slug'] ?? ''); ?>" style="display:none;">
                    <?php if(isset($category['filters']) && count($category['filters'])): ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Category Filters</h4>
                                <?php $__currentLoopData = $category['filters']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mb-3">
                                        <?php
                                            $fieldKey = $filter['field_key'] ?? $filter['field_id'];
                                            $oldValue = request()->input("filters.$fieldKey");
                                        ?>
                                        <?php switch($filter['type'] ?? ''):
                                            case ('text'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <input type="text" name="filters[<?php echo e($fieldKey); ?>]" class="form-control"
                                                   placeholder="Enter <?php echo e($filter['label'] ?? ''); ?>"
                                                   value="<?php echo e($oldValue); ?>">
                                            <?php break; ?>

                                            <?php case ('number'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <input type="number" name="filters[<?php echo e($fieldKey); ?>]" class="form-control"
                                                   placeholder="Enter <?php echo e($filter['label'] ?? ''); ?>"
                                                   value="<?php echo e($oldValue); ?>">
                                            <?php break; ?>

                                            <?php case ('date'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <input type="date" name="filters[<?php echo e($fieldKey); ?>]" class="form-control"
                                                   value="<?php echo e($oldValue); ?>">
                                            <?php break; ?>

                                            <?php case ('email'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <input type="email" name="filters[<?php echo e($fieldKey); ?>]" class="form-control"
                                                   placeholder="Enter <?php echo e($filter['label'] ?? ''); ?>"
                                                   value="<?php echo e($oldValue); ?>">
                                            <?php break; ?>

                                            <?php case ('textarea'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <textarea name="filters[<?php echo e($fieldKey); ?>]" class="form-control" rows="2"
                                                      placeholder="Enter <?php echo e($filter['label'] ?? ''); ?>"><?php echo e($oldValue); ?></textarea>
                                            <?php break; ?>

                                            <?php case ('checkbox'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <?php $__currentLoopData = $filter['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $optionId = 'filter_'.$filter['field_id'].'_'.$index;
                                                    $optionLabel = explode('|', $option)[0];
                                                    $checked = is_array($oldValue) && in_array($optionLabel, $oldValue) ? 'checked' : '';
                                                ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="<?php echo e($optionId); ?>"
                                                           name="filters[<?php echo e($filter['field_id']); ?>][]"
                                                           value="<?php echo e($optionLabel); ?>" <?php echo e($checked); ?>>
                                                    <label class="custom-control-label" for="<?php echo e($optionId); ?>"><?php echo e($optionLabel); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php break; ?>

                                            <?php case ('radio'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <?php $__currentLoopData = $filter['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $optionId = 'filter_'.$filter['field_id'].'_'.$index;
                                                    $optionLabel = explode('|', $option)[0];
                                                    $checked = $oldValue == $optionLabel ? 'checked' : '';
                                                ?>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="<?php echo e($optionId); ?>"
                                                           name="filters[<?php echo e($filter['field_id']); ?>]"
                                                           value="<?php echo e($optionLabel); ?>" <?php echo e($checked); ?>>
                                                    <label class="custom-control-label" for="<?php echo e($optionId); ?>"><?php echo e($optionLabel); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php break; ?>

                                            <?php case ('selectlist'): ?>
                                            <h6 class="mb-2"><?php echo e($filter['label'] ?? ''); ?></h6>
                                            <select name="filters[<?php echo e($fieldKey); ?>]" class="form-select">
                                                <option value="">Select <?php echo e($filter['label'] ?? ''); ?></option>
                                                <?php $__currentLoopData = $filter['options'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($option); ?>" <?php echo e($oldValue == $option ? 'selected' : ''); ?>><?php echo e($option); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php break; ?>
                                        <?php endswitch; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </form>
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="theme-btn border-0 w-100" id="clear-filters">Clear</button>
        </div>
    </div>
</div>

                <!-- end col-lg-4 -->
                <div class="col-lg-9">
                    <div class="tabs-wrapper" style="margin-bottom: 30px;">
    <button class="scroll-btn prev" onclick="scrollTabs(-200)">&#10094;</button>

    <div class="tabs-container" id="tabsContainer">
        <button class="tab-btn active" data-category="all">All</button>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button class="tab-btn" data-category="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <button class="scroll-btn next" onclick="scrollTabs(200)">&#10095;</button>
</div>

                    <?php echo $__env->make('front.partials.filtered-listings', ['allSubmissions' => $allSubmissions, 'categories' => $categories, 'submissionsByCategory' => $submissionsByCategory, 'soldSubmissionIds'=> $soldSubmissionIds], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
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
                                                                                                                                      
    <script>
 document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('#filter-form');
  const resultsContainer = document.getElementById('submissions-container');
 const urlParams = new URLSearchParams(window.location.search);
 let currentView = 'list'; // 'list' or 'grid'

let selectedCategory =
    urlParams.get('category') ||
    localStorage.getItem('selectedCategory') ||
    'all';

  // Add hidden input if not exists
  if (form && !form.querySelector('input[name="category"]')) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'category';
    input.value = selectedCategory;
    form.appendChild(input);
  }

  // Open correct tab on load
 const tabToOpen =
    document.querySelector(`.tab-btn[data-category="${selectedCategory}"]`) ||
    document.querySelector('.tab-btn[data-category="all"]');

if (tabToOpen) {
    tabToOpen.classList.add('active');
    showCategoryGroups(selectedCategory);

    const categoryInput = form.querySelector('input[name="category"]');
    if (categoryInput) {
        categoryInput.value = selectedCategory;
    }

    tabToOpen.scrollIntoView({
        behavior: 'smooth',
        inline: 'center',
        block: 'nearest'
    });
}

  // Tab button click handler
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const category = btn.getAttribute('data-category');
      localStorage.setItem('selectedCategory', category);

      // Update URL (no reload)
      const url = new URL(window.location);
      url.searchParams.set('category', category);
      window.history.replaceState({}, '', url);

      // Update hidden input field
      const categoryInput = form.querySelector('input[name="category"]');
      if (categoryInput) {
        categoryInput.value = category;
      }

      // Show/hide groups and filters for selected category
      showCategoryGroups(category);
    });
  });

  // Scroll tabs function
  window.scrollTabs = function(amount) {
    const container = document.getElementById("tabsContainer");
    container.scrollBy({ left: amount, behavior: "smooth" });
  };

  // Clear filters button
  document.getElementById('clear-filters').addEventListener('click', function() {
    form.querySelectorAll('input[type="text"], input[type="number"], input[type="date"], input[type="email"], textarea, select')
      .forEach(el => el.value = '');
    form.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(el => el.checked = false);

    const url = window.location.href.split('?')[0];
    window.location.href = url;
  });

  // Function to fetch and update results via AJAX
  function fetchFilteredResults() {
    const formData = new FormData(form);
    const params = new URLSearchParams(formData).toString();

    fetch(form.action + '?' + params, {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
      },
    })
      .then(response => response.json())
      .then(data => {
        resultsContainer.innerHTML = data.html;

        const categoryInput = form.querySelector('input[name="category"]');
        const selectedCategory = categoryInput ? categoryInput.value : 'all';
        showCategoryGroups(selectedCategory);
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  // Submit form on any change in input/select/textarea immediately
  form.querySelectorAll('input, select, textarea').forEach(input => {
    input.addEventListener('change', fetchFilteredResults);
  });

  // Prevent default form submit to avoid page reload, submit via AJAX instead
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    fetchFilteredResults();
  });

  // Show or hide submission groups and filters per category
 function showCategoryGroups(category) {
  const listGroups = document.querySelectorAll('.submission-group');
  const gridGroups = document.querySelectorAll('.submission-group-grid');
  const filters = document.querySelectorAll('.category-filters');

  // LIST VIEW
  listGroups.forEach(group => {
    const match =
      category === 'all'
        ? group.dataset.group === 'all'
        : group.dataset.group === category;

    group.style.display = currentView === 'list' && match ? '' : 'none';
  });

  // GRID VIEW
  gridGroups.forEach(group => {
    const match =
      category === 'all'
        ? group.dataset.group === 'all'
        : group.dataset.group === category;

    group.style.display = currentView === 'grid' && match ? '' : 'none';
  });

  // CATEGORY FILTERS (left sidebar)
  filters.forEach(div => {
    if (category === 'all' || div.dataset.category === category) {
      div.style.display = '';
    } else {
      div.style.display = 'none';
    }
  });
}


const listBtn = document.querySelector('.fa-list')?.closest('a');
const gridBtn = document.querySelector('.fa-th-large')?.closest('a');

listBtn?.addEventListener('click', function (e) {
  e.preventDefault();
  currentView = 'list';

  listBtn.classList.add('active');
  gridBtn.classList.remove('active');

  const activeCategory =
    document.querySelector('.tab-btn.active')?.dataset.category || 'all';

  showCategoryGroups(activeCategory);
});

gridBtn?.addEventListener('click', function (e) {
  e.preventDefault();
  currentView = 'grid';

  gridBtn.classList.add('active');
  listBtn.classList.remove('active');

  const activeCategory =
    document.querySelector('.tab-btn.active')?.dataset.category || 'all';

  showCategoryGroups(activeCategory);
});


});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/listing-list.blade.php ENDPATH**/ ?>