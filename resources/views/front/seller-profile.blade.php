@extends('layouts.new-master')

@section('title', $seller->name . ' | Professional Portfolio')

@section('content')
    <style>
        .portfolio-section {
            background: #f8f9fa;
        }

        .portfolio-container {
            max-width: 1200px;
        }

        .portfolio-hero .portfolio-heading {
            font-size: rem;
            font-weight: 700;
        }

        .portfolio-verified-badge {
            background: #28a745;
            color: white;
            padding: 3px 14px;
            border-radius: 30px;
            font-size: 12px;
        }

        .portfolio-avatar {
            width: 240px;
            height: 240px;
            object-fit: cover;
            border: 8px solid white;
        }

        .portfolio-stat-card {
            background: white;
            padding: 1.8rem;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .portfolio-stat-card:hover {
            transform: translateY(-5px);
        }

        .portfolio-stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0d6efd;
        }

        .portfolio-section-title {
            font-size: 2.2rem;
            font-weight: 700;
            position: relative;
        }

        .portfolio-section-title::after {
            content: '';
            width: 60px;
            height: 4px;
            background: #0d6efd;
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
        }

        .portfolio-review-card {
            background: white;
            padding: 1.8rem;
            border-radius: 12px;
            height: 100%;
        }

        .portfolio-review-text {
            font-style: italic;
            margin-bottom: 1rem;
        }

        .portfolio-review-author {
            font-weight: 600;
            color: #0d6efd;
        }

        .portfolio-input,
        .portfolio-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
        }

        .portfolio-btn {
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
        }

        .portfolio-btn-primary {
            background: #0d6efd;
            border: none;
            color: white;
        }

        .portfolio-btn-outline {
            border: 2px solid #0d6efd;
            color: #0d6efd;
        }

        @media (max-width: 991px) {
            .portfolio-avatar {
                width: 180px;
                height: 180px;
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
            cursor: pointer;

        }

        .product-details-hover h3:hover {
            color: blue !important;
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
            font-size: 14px;
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
            cursor: pointer;

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

        @keyframes slideUp {
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

        @keyframes slideText {
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

        .hero-section-form {
            display: flex;
            justify-content: end;
        }

        .play-button {
            display: flex;
            gap: 15px;
        }

        .play-button .batton {
            border-radius: 7px !important;
            height: 40px;
            font-size: 18px;
            color: #000 !important;
        }

        .play-button .batton1 {
            height: 40px;
            font-size: 18px;
            border-radius: 7px !important;
            color: #ffffff;
            background: #020202;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 500;
            display: inline-flex;
            position: relative;
            overflow: hidden;
            z-index: 0;
            border: 0;
        }

        .play-button .batton1:hover {
            border: 1px solid #000;
            color: #000000;
            background: #ffffff;
        }

        .play-button .batton:hover {
            border: 1px solid #000;
            color: #000000;

        }

        .wishlist-left:hover {
            background: #eee9e999;
        }

        @media (max-width: 540px) {
            .top-header {
                display: none;
            }

            .hero-section {
                margin-top: 0px !important;
            }

            .hero-section-form {
                display: flex;
                justify-content: center;
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

        }

        @media (min-width: 769px) {
            .mobile-view-filter {
                display: none;
            }
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

            .flippingo-hiw-btn-group {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .flippingo-hiw-btn-primary {
                width: 100%;
            }

            .flippingo-hiw-btn-secondary {
                width: 100%;
            }

            .filter-left {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: start;
                gap: 15px;
            }

            .desktop-view-filter {
                display: none !important;
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
            background: rgba(0, 0, 0, 0.45);
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

        .budge-active {
            height: 20px;
            border: 1px solid green;

            width: fit-content;
            padding: 0px 5px;
            background-color: #fff;
            color: green;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 16px;
            font-size: 10px;
        }

        .wishlist-budge {
            position: relative;
            top: -149px;
            left: 2px;
        }

        /* Meta separators */
        .portfolio-meta-separator {
            color: #adb5bd;
            font-weight: 500;
            font-size: 1.1rem;
        }

        /* Better spacing on smaller screens */
        @media (max-width: 991px) {
            .portfolio-meta {
                gap: 2rem !important;
                justify-content: flex-start;
            }

            .portfolio-meta-separator {
                display: none;
                /* hide separators on very small screens */
            }
        }

        /* Professional button styles + hover effects */
        .portfolio-btn {
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .portfolio-btn-outline {
            border: 2px solid #0d6efd;
            color: #0d6efd;
            background: transparent;
        }

        .portfolio-btn-outline:hover {
            background: #0d6efd;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(13, 110, 253, 0.2);
        }

        .portfolio-btn-primary {
            background: #0d6efd;
            color: white;
            border: none;
        }

        .portfolio-btn-primary:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.25);
        }

        /* Optional: make verified badge look more premium */

        .play-button {
            display: flex;
            gap: 15px;
        }

        .play-button .batton {
            border-radius: 7px !important;
            height: 40px;
            font-size: 18px;
            color: #000 !important;
        }

        .play-button .batton1 {
            height: 40px;
            font-size: 18px;
            border-radius: 7px !important;
            color: #ffffff;
            background: #020202;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 500;
            display: inline-flex;
            position: relative;
            overflow: hidden;
            z-index: 0;
            border: 0;
        }

        .play-button .batton1:hover {
            border: 1px solid #000;
            color: #000000;
            background: #ffffff;
        }

        .play-button .batton:hover {
            border: 1px solid #000;
            color: #000000;

        }

        .play-button a {
            color: #020202;
            display: flex;
            align-items: center;
            background: #f1f1f1;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

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

        .horizontal-saprator-line {
            width: 100%;
            height: .5px;
            background: #adb5bd;
            margin: 15px 0px;
        }

        .portfolio-verified-badges {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .portfolio-verified-badge {
            display: inline-flex;
            align-items: center;
            padding: 0px 16px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 50px;
            color: white;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.25s ease;
            background: rgba(255, 255, 255, 0.1);
            /* fallback for non-glass */
        }

        .portfolio-verified-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Featured Seller - Gold/Orange gradient */
        .portfolio-featured {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        /* Premium Seller - Purple premium feel */
        .portfolio-premium {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        /* KYC Verified - Green trust color */
        .portfolio-kyc {
            background: linear-gradient(135deg, #10b981, #059669);
        }



        /* Responsive - smaller on mobile */
        @media (max-width: 576px) {
            .portfolio-verified-badge {
                font-size: 12px;
                padding: 5px 12px;
            }
        }

        .tab-name-button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .tabbutton {
            color: white;

            height: 40px;
            font-size: 14px;
            border-radius: 7px !important;
            color: #000000;
            background: #ffffff;
            padding: 2px 40px;
            border-radius: 50px;
            font-weight: 500;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #000;


        }

        .tabbutton.active {
            color: white;

            height: 40px;
            font-size: 14px;
            border-radius: 7px !important;
            color: #ffffff;
            background: #020202;
            padding: 2px 40px;
            border-radius: 50px;
            font-weight: 500;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .tabbutton:hover {
            border: 1px solid #000;
            color: #fff;
            background: #000000;
        }

        /* Star Rating */
        .portfolio-star-rating {
            font-size: 2.2rem;
            color: #e0e0e0;
            /* default gray stars */
            cursor: pointer;
            user-select: none;
        }

        .portfolio-star-rating .star {
            transition: all 0.2s ease;
            display: inline-block;
            margin-right: 4px;
        }

        .portfolio-star-rating .star:hover,
        .portfolio-star-rating .star.active,
        .portfolio-star-rating .star.selected {
            color: #ffc107;
            /* gold/yellow */
            transform: scale(1.15);
        }

        .portfolio-star-rating .star:hover~.star,
        .portfolio-star-rating .star.active~.star {
            color: #e0e0e0;
            /* reset later stars when hovering */
        }

        /* When hovering, highlight all stars up to the hovered one */
        .portfolio-star-rating:hover .star:hover,
        .portfolio-star-rating:hover .star:hover~.star {
            color: #ffc107;
        }
    </style>
    <!-- Main Portfolio Section -->
    <section class="portfolio-section padding-top-80px padding-bottom-100px " style="margin-top:130px;">
        <div class="portfolio-container container">

            <!-- Hero / Intro + Profile Image -->
            <div class="portfolio-hero row align-items-center mb-5">
                <!-- Left: Intro Text -->
                <div class="portfolio-col col-lg-7">
                    <div class="portfolio-intro pe-lg-5">
                        <h1 class="portfolio-heading mb-3">
                            {{ $seller->legal_name ?: trim($seller->first_name . ' ' . $seller->last_name) }}
                        </h1>


                        <div class="portfolio-verified-badges d-flex flex-wrap gap-2 mb-3">
                            @if($seller->legal_name)
                                <div>
                                    <strong>Seller:</strong>
                                    {{ trim($seller->first_name . ' ' . $seller->last_name) }}
                                </div>
                            @endif
                            <div class="portfolio-meta-separator">|</div>

                            <div>
                                <strong>Regd. No.:</strong>
                                {{ optional($seller->kyc)->entity_registration_number ?? '-' }}
                            </div>

                        </div>

                        <div class="portfolio-verified-badges d-flex flex-wrap gap-2 mb-3">

                            {{-- Featured Seller (from subscription) --}}
                            @if(optional($seller->activeSubscription)->featured === 'yes')
                                <span class="portfolio-verified-badge portfolio-featured">
                                    <i class="fas fa-star me-1"></i> Featured Seller
                                </span>
                            @endif

                            {{-- Premium Seller --}}
                            @if($seller->is_premium)
                                <span class="portfolio-verified-badge portfolio-premium">
                                    <i class="fas fa-crown me-1"></i> Premium Seller
                                </span>
                            @endif

                            {{-- KYC Verified --}}
                            @if($seller->is_verified)
                                <span class="portfolio-verified-badge portfolio-kyc">
                                    <i class="fas fa-check-circle me-1"></i> KYC Verified
                                </span>
                            @endif

                        </div>

                        @php
                            $fullBio = $seller->bio ?? '';
                            $shortBio = \Illuminate\Support\Str::words($fullBio, 24);
                            $isLongBio = str_word_count($fullBio) > 24;
                        @endphp

                        @if($fullBio)
                            <p class="portfolio-lead mb-4">
                                <span id="sellerBioText">
                                    {{ $shortBio }}
                                </span>

                                @if($isLongBio)
                                    <a href="javascript:void(0)" id="bioToggle" style="font-size:14px;color:#007bff"
                                        onclick="toggleBio()" data-short="{{ e($shortBio) }}" data-full="{{ e($fullBio) }}">
                                        Read more
                                    </a>
                                @endif
                            </p>
                        @endif


                        <div class="horizontal-saprator-line"></div>

                        <div class="portfolio-meta d-flex flex-wrap align-items-center gap-4 gap-md-5 text-muted">
                            <div>
                                <strong>Country</strong><br>
                                {{ $seller->countryname->name ?? 'Global' }}
                            </div>

                            <div class="portfolio-meta-separator">|</div>

                            <div>
                                <strong>Member Since</strong><br>
                                {{ $seller->created_at->format('F Y') }}
                            </div>

                            <div class="portfolio-meta-separator">|</div>

                            <div>
                                <strong>Total Projects</strong><br>
                                {{ $seller->listing_count ?? '100+' }}
                            </div>
                        </div>

                        <!-- Buttons with hover effect -->
                        <div class="play-button" style="margin-top: 30px;">
                            <a class="batton1" href="javascript:void(0)" onclick="scrollToSection('enquiry')">
                                Get in Touch
                            </a>
                            <a class="batton" href="javascript:void(0)" onclick="scrollToSection('portfolioHighlights')">
                                View Listing
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Profile Image -->
                <div class="portfolio-col col-lg-5 text-center text-lg-end">
                    <div class="portfolio-avatar-wrapper">
                        <img src="{{ 
                                                                                    $seller->display_image
        ? asset('storage/' . $seller->display_image)
        : ($seller->profile_pic
            ? asset('storage/' . $seller->profile_pic)
            : 'https://themewagon.github.io/picto/assets/person-CqOZwXV1.png')
                                                                                }}"
                            alt="{{ $seller->legal_name ?? trim($seller->first_name . ' ' . $seller->last_name) }}"
                            class="img-fluid">
                    </div>
                </div>

            </div>

            <!-- Stats Cards -->
            <div class="portfolio-stats row g-4 mb-5">
                <div class="col-md-3">
                    <div class="portfolio-stat-card text-center shadow-sm">
                        <h3 class="portfolio-stat-number">
                            {{ $activeListings->count() }}
                        </h3>
                        <p class="portfolio-stat-label">Active Listings</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="portfolio-stat-card text-center shadow-sm">
                        <h3 class="portfolio-stat-number">
                            {{ $soldListings->count() }}
                        </h3>
                        <p class="portfolio-stat-label">Sold Out</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="portfolio-stat-card text-center shadow-sm">
                        <h3 class="portfolio-stat-number">{{ $seller->happy_clients ?? 0 }}+</h3>
                        <p class="portfolio-stat-label">Happy Clients</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="portfolio-stat-card text-center shadow-sm">
                        <h3 class="portfolio-stat-number">{{ $seller->total_experience ?? 0}}+</h3>
                        <p class="portfolio-stat-label">Total Experience</p>
                    </div>
                </div>
            </div>

            <!-- Portfolio Showcase -->
            <div class="portfolio-showcase mb-5" id="portfolioHighlights">
                <h2 class="portfolio-section-title text-center mb-5">Portfolio Highlights</h2>

            </div>
            <div id="submissions-container">
                <div class="tab-name-button">
                    <button class="tabbutton active" id="activeTab">Active Listing</button>
                    <button class="tabbutton" id="soldTab">Sold out Listings</button>
                </div>

                <div class="submission-group wishlist-card" id="activeListings">

                    @forelse($activeListings as $submission)
                        <div class="wishlist-product-card" data-category="youtube-channels" data-country="all" data-verified="1"
                            data-premium="0">
                            <div class="wishlist-image-wrapper">
                                <div class="wishlist-main-slider">
                                    @foreach($submission->allImages as $img)
                                        <img src="{{ asset('storage/' . $img['file_path']) }}" class="slide-img" />
                                    @endforeach
                                </div>
                                <!-- Navigation Arrows -->
                                <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>
                            </div>
                            <div class="wishlist-budge">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="budge-active">
                                        <p><i class="fa-solid fa-circle-check"></i> Active</p>
                                    </div>
                                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i
                                            class="fa-regular fa-heart"></i></h4>
                                </div>
                            </div>
                            <div class="product-details-hover">
                                <div class="wishlist-button">
                                    <p>{{ $submission->category_name ?? '' }}</p>
                                </div>
                                <h3 class="mt-2" style="color: #000;">{{ $submission->product_title ?? '' }}</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0" style="font-size:12px;">
                                        By <span
                                            style="cursor: pointer;">{{ ($submission->customer->first_name ?? '') . ' ' . ($submission->customer->last_name ?? '') }}</span>
                                        @if(!empty($submission->is_premium) && $submission->is_premium)
                                            <span class="text-warning ms-1" data-toggle="tooltip" data-placement="top"
                                                title="{{ setting('premium_seller_note', 'Top Seller') }}">
                                                <i class="fa-solid fa-crown"></i>
                                            </span>
                                        @elseif(!empty($submission->is_verified) && $submission->is_verified)
                                            <span class="text-success ms-1" data-toggle="tooltip" data-placement="top"
                                                title="{{ $submission['verified_note'] ?? 'Verified Seller' }}">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </span>
                                        @endif
                                    </p>
                                    <p class="m-0" style="color: #007bff; font-size:12px;"><i class="fa-solid fa-eye"></i>
                                        {{ $submission->total_views ?? 0 }}
                                    </p>
                                </div>
                                <div class="wishlist-item-card {{ count($submission->summaryFields) == 2 ? 'two-items' : '' }}">
                                    @foreach($submission->summaryFields as $field)
                                        <div class="wishlist-left">
                                            <p class="m-0" style="color: {{ $field['color'] ?? 'green' }};">
                                                <i class="{{ $field['icon'] ?? '' }}"></i>
                                            </p>

                                            <div class="d-flex flex-column">
                                                <p class="m-0" style="font-size: 10px;line-height: 12px;">
                                                    {{ $field['label'] }}
                                                </p>
                                                <h5 class="m-0" style="color: #000; font-size: 14px;">
                                                    {{ $field['value'] }}
                                                </h5>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color:#000;">
                                        {{ $submission->currency_symbol }}
                                        {{ $submission->currency_symbol == '$' ? number_format($submission->display_price, 2) : $submission->display_price}}
                                    </h2>

                                    <button type="button" class="btn btn-dark"
                                        onclick="window.location.href='{{ route('listing-details', ['id' => $submission->id]) }}'">View
                                        Listing</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No active listings found.</p>
                    @endforelse
                </div>


                <div class="submission-group wishlist-card d-none" id="soldListings">

                    @forelse($soldListings as $submission)
                        <div class="wishlist-product-card" data-category="youtube-channels" data-country="all" data-verified="0"
                            data-premium="1">
                            <div class="wishlist-image-wrapper">
                                <div class="wishlist-main-slider">
                                    @foreach($submission->allImages as $img)
                                        <img src="{{ asset('storage/' . $img['file_path']) }}" class="slide-img" />
                                    @endforeach
                                </div>
                                <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>
                            </div>
                            <div class="wishlist-budge">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="budge-soldout">
                                        <p><i class="fa-solid fa-ban"></i> Sold Out</p>
                                    </div>
                                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i
                                            class="fa-regular fa-heart"></i></h4>
                                </div>
                            </div>
                            <div class="product-details-hover">
                                <div class="wishlist-button">
                                    <p>{{ $submission->category_name ?? '' }}</p>
                                </div>
                                <h3 class="mt-2" style="color: #000;">{{ $submission->product_title ?? '' }}</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0" style="font-size:12px;">
                                        By <span
                                            style="cursor: pointer;">{{ ($submission->customer->first_name ?? '') . ' ' . ($submission->customer->last_name ?? '') }}</span>
                                        @if(!empty($submission->is_premium) && $submission->is_premium)
                                            <span class="text-warning ms-1" data-toggle="tooltip" data-placement="top"
                                                title="{{ setting('premium_seller_note', 'Top Seller') }}">
                                                <i class="fa-solid fa-crown"></i>
                                            </span>
                                        @elseif(!empty($submission->is_verified) && $submission->is_verified)
                                            <span class="text-success ms-1" data-toggle="tooltip" data-placement="top"
                                                title="{{ $submission['verified_note'] ?? 'Verified Seller' }}">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </span>
                                        @endif
                                    </p>
                                    <p class="m-0" style="color: #007bff; font-size:12px;"><i class="fa-solid fa-eye"></i>
                                        {{ $submission->total_views ?? 0 }}</p>
                                </div>
                                <div class="wishlist-item-card {{ count($submission->summaryFields) == 2 ? 'two-items' : '' }}">
                                    @foreach($submission->summaryFields as $field)
                                        <div class="wishlist-left">
                                            <p class="m-0" style="color: {{ $field['color'] ?? 'green' }};">
                                                <i class="{{ $field['icon'] ?? '' }}"></i>
                                            </p>

                                            <div class="d-flex flex-column">
                                                <p class="m-0" style="font-size: 10px;line-height: 12px;">
                                                    {{ $field['label'] }}
                                                </p>
                                                <h5 class="m-0" style="color: #000; font-size: 14px;">
                                                    {{ $field['value'] }}
                                                </h5>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color:#000;">
                                        {{ $submission->currency_symbol }}
                                        {{ $submission->currency_symbol == '$' ? number_format($submission->display_price, 2) : $submission->display_price}}
                                    </h2>
                                    <button type="button" class="btn btn-dark"
                                        onclick="window.location.href='{{ route('listing-details', ['id' => $submission->id]) }}'">View
                                        Listing</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No sold listings yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Reviews Slider (2 cards visible) -->
            @if($feedbacks->count())
                <div class="portfolio-reviews mb-5">
                    <h2 class="portfolio-section-title text-center mb-5">What Clients Say</h2>

                    <div id="portfolioReviewCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            @foreach($feedbacks->chunk(2) as $index => $chunk)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="row g-4">

                                        @foreach($chunk as $feedback)
                                            <div class="col-md-6">
                                                <div class="portfolio-review-card shadow-sm">

                                                    {{-- Review text --}}
                                                    <p class="portfolio-review-text">
                                                        "{{ $feedback->message }}"
                                                    </p>

                                                    {{-- Rating stars --}}
                                                    <div class="mb-2" style="color:#f5c518;">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            {!! $i <= $feedback->rating ? '★' : '☆' !!}
                                                        @endfor
                                                    </div>

                                                    {{-- Author --}}
                                                    <div class="portfolio-review-author">
                                                        —
                                                        {{ $feedback->customer->first_name ?? 'Anonymous' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach

                        </div>

                        {{-- Controls --}}
                        <button class="carousel-control-prev" type="button" data-bs-target="#portfolioReviewCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#portfolioReviewCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            @endif


            <!-- Contact / Enquiry Forms -->
            <div class="portfolio-contact row g-5" id="enquiry">

                {{-- ================= FEEDBACK (AUTH ONLY) ================= --}}
                <div class="col-lg-6">
                    <h3 class="portfolio-form-title">How would you rate your experience?</h3>

                    <div class="mb-3">
                        <div class="portfolio-star-rating mt-4 mb-3" id="starRating">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                    </div>

                    @auth('customer')
                        <form class="portfolio-form" id="feedbackForm" method="POST"
                            action="{{ route('seller.feedback.submit') }}">
                            @csrf

                            <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                            <input type="hidden" name="rating" id="ratingValue" value="0">

                            <div class="mb-3 mt-4">
                                <input type="text" class="portfolio-input" name="name"
                                    value="{{ auth('customer')->user()->first_name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <input type="email" class="portfolio-input" name="email"
                                    value="{{ auth('customer')->user()->email }}" readonly>
                            </div>

                            <div class="mb-2">
                                <textarea class="portfolio-textarea" rows="4" name="message"
                                    placeholder="Your Feedback / Message" required></textarea>
                            </div>

                            <button type="submit" class="portfolio-btn portfolio-btn-primary w-100 mt-4">
                                Submit Feedback
                            </button>
                        </form>
                    @else
                        <div class="alert alert-warning mt-4">
                            Please login to submit feedback.
                            <a href="{{ route('customer.login') }}" class="fw-bold text-primary ms-1">
                                Login here
                            </a>
                        </div>
                    @endauth
                </div>

                {{-- ================= ENQUIRY (OPEN FOR ALL) ================= --}}
                <div class="col-lg-6">
                    <h3 class="portfolio-form-title">Send Personalised Enquiry</h3>

                    <form class="portfolio-form" method="POST" action="{{ route('seller.enquiry.submit') }}">
                        @csrf

                        <input type="hidden" name="seller_id" value="{{ $seller->id }}">

                        <div class="mb-3">
                            <input type="text" class="portfolio-input" name="name" placeholder="Your Name" required>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="portfolio-input" name="mobile" placeholder="Your Mobile Number"
                                required>
                        </div>

                        <div class="mb-3">
                            <input type="email" class="portfolio-input" name="email" placeholder="Your Email" required>
                        </div>

                        <div class="mb-4">
                            <textarea class="portfolio-textarea" rows="4" name="message"
                                placeholder="Tell me about your project / requirements" required></textarea>
                        </div>

                        <button type="submit" class="portfolio-btn portfolio-btn-primary w-100 mt-3">
                            Send Enquiry
                        </button>
                    </form>
                </div>

            </div>


        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ===============================
             | ⭐ STAR RATING
             =============================== */
            const stars = document.querySelectorAll('#starRating .star');
            const ratingInput = document.getElementById('ratingValue');
            const feedbackForm = document.getElementById('feedbackForm');

            stars.forEach((star, index) => {

                // Click → set rating
                star.addEventListener('click', function () {
                    const value = this.getAttribute('data-value');
                    ratingInput.value = value;

                    stars.forEach((s, i) => {
                        s.classList.toggle('selected', i < value);
                    });
                });

                // Hover preview
                star.addEventListener('mouseover', function () {
                    stars.forEach((s, i) => {
                        s.classList.toggle('active', i <= index);
                    });
                });

                // Remove hover preview
                star.addEventListener('mouseout', function () {
                    stars.forEach(s => s.classList.remove('active'));
                });
            });

            // Rating required validation
            if (feedbackForm) {
                feedbackForm.addEventListener('submit', function (e) {
                    if (ratingInput.value === '0') {
                        e.preventDefault();
                        alert('Please select a rating before submitting!');
                    }
                });
            }

            /* ===============================
             | BIO READ MORE / LESS
             =============================== */
            window.toggleBio = function () {
                const bioText = document.getElementById('sellerBioText');
                const toggle = document.getElementById('bioToggle');

                if (!bioText || !toggle) return;

                const shortText = toggle.dataset.short;
                const fullText = toggle.dataset.full;

                if (toggle.innerText === 'Read more') {
                    bioText.innerText = fullText;
                    toggle.innerText = 'Read less';
                } else {
                    bioText.innerText = shortText;
                    toggle.innerText = 'Read more';
                }
            };

            /* ===============================
             | ACTIVE / SOLD TABS
             =============================== */
            const activeTab = document.getElementById('activeTab');
            const soldTab = document.getElementById('soldTab');
            const activeListings = document.getElementById('activeListings');
            const soldListings = document.getElementById('soldListings');

            if (activeTab && soldTab) {
                activeTab.addEventListener('click', function () {
                    this.classList.add('active');
                    soldTab.classList.remove('active');

                    activeListings.classList.remove('d-none');
                    soldListings.classList.add('d-none');
                });

                soldTab.addEventListener('click', function () {
                    this.classList.add('active');
                    activeTab.classList.remove('active');

                    soldListings.classList.remove('d-none');
                    activeListings.classList.add('d-none');
                });
            }

        });
    </script>


@endsection