@extends('layouts.new-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.min.js"></script>
@section('title')
    Flippingo
@endsection
@push('after-styles')
    <style>
        .page-wrapper {
            height: auto;
        }

        /* Tab Styling */
        .custom-tabs {
            display: flex;
            gap: 10px;
            /*margin-bottom: 20px;*/
        }

        /*.custom-tab {*/
        /*    padding: 10px 20px;*/
        /*    cursor: pointer;*/
        /*    background-color: #f0f0f0;*/
        /*    border-radius: 5px;*/
        /*    transition: background-color 0.3s;*/
        /*    border-bottom:none !important;*/
        /*}*/
        .custom-tab.active {
            background-color: #00aaa5;
            color: #fff;
        }

        .custom-tab.disabled {
            pointer-events: none;
            /* Prevent click */
            opacity: 0.5;
            /* Make it look disabled */
            cursor: not-allowed;
            /* Show 'not-allowed' cursor */
        }

        .custom-tab-number {
            margin-right: 5px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .text-areafield {
            border: 2px solid #6bd3cc !important;
            col or: black !important;
            border-radius: .375rem !important;
        }

        textarea.text-areafield.form-control {
            color: black !important;
        }

        .upload-card {
            border: 2px dashed #d4d4d4;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            width: 240px;
            background-color: #fff;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .upload-card:hover {
            border-color: #5a9ef8;
        }

        .upload-card i {
            font-size: 30px;
            color: #5a9ef8;
            margin-bottom: 10px;
        }

        .upload-card .title {
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }

        .upload-card .or {
            margin: 5px 0;
            font-size: 14px;
            color: #999;
        }

        .upload-card .browse-btn {
            background-color: #3d82f7;
            border: none;
            color: white;
            padding: 6px 16px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .upload-card .file-info {
            font-size: 12px;
            color: #999;
        }

        .upload-box-card {
            width: 100%;
            margin-top: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 20px
        }

        .art-top-left-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .upload-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            align-items: flex-start;
            max-width: 100%;
        }

        /* .upload-card {
                               width: 260px;
                               min-height: 320px;
                               border: 2px dashed #ccc;
                               padding: 20px;
                               text-align: center;
                               border-radius: 10px;
                               background: #fff;
                               cursor: pointer;
                               } */
        #preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            flex: 1;
            min-height: 100px;
        }

        #preview-container>div {
            width: 150px;
            height: auto;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 6px;
            background: #f9f9f9;
            text-align: center;
        }

        .preview-box {
            width: 150px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fafafa;
            text-align: center;
            position: relative;
            box-sizing: border-box;
            margin: 6px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.05);
        }

        .remove-btn {
            position: absolute;
            top: 4px;
            right: 8px;
            cursor: pointer;
            font-Size: 18px;
            color: red;
        }

        #uploaded-extra-files {
            background-color: #fff2cc;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }

        .file-preview-row {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }
    </style>
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container py-5">
                <div class="art-top-card">
                    <div class="art-top-right">
                        <section class="slider-section" style="background-color: #ff4f42; padding: 30px;height: 450px;">
                            <div class="first-slider">
                                <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
                                        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
                                        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="row d-flex align-items-center">
                                                <div class="col d-none d-lg-flex justify-content-center">
                                                    <div class="">
                                                        <!-- <h3 class="h3 fw-light" style="color: #fff;">Upload, Pay & Confirm</h3> -->
                                                        <h1 class="h1" style="color: #fff;">Upload, Pay & Confirmg
                                                        </h1>
                                                        <p class="pb-3" style="color: #fff;">If you need to
                                                            rearrange or insert blank pages, do it only after all
                                                            files are uploaded.
                                                        </p>
                                                        <!-- <div class=""> <a class="btn btn-light btn-ecomm" href="javascript:;">Shop Now
                                                                      <i class='bx bx-chevron-right'></i></a>
                                                                      </div> -->
                                                    </div>
                                                </div>
                                                <div class="col" style="height: 400px;padding-top: 60px;">
                                                    <!-- <img src="assets/images/slider/04.png" class="img-fluid" alt="..."> -->
                                                    <!-- Image with Play Button Overlay -->
                                                    <div class="banner-slider-with position-relative text-center">
                                                        <img src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/carousel/carousel-rename.png"
                                                            class="img-fluid">
                                                        <!-- Play Button -->
                                                        <button type="button"
                                                            class="btn btn-light position-absolute top-50 start-50 translate-middle"
                                                            data-bs-toggle="modal" data-bs-target="#videoModal"
                                                            style="border-radius: 50%; width: 60px; height: 60px;">
                                                            ▶
                                                        </button>
                                                    </div>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="videoModal" tabindex="-1"
                                                        aria-labelledby="videoModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content bg-dark">
                                                                <div class="modal-header border-0">
                                                                    <button type="button" class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body p-0">
                                                                    <div class="ratio ratio-16x9">
                                                                        <iframe id="videoFrame" src="" title="Video"
                                                                            allow="autoplay; encrypted-media"
                                                                            allowfullscreen></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleDark" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleDark" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="art-top-left" style="border:1px solid #80808069;">
                        <div class="art-top-left-top">
                            <h5>Order Quote <strong>#{{ $quote_id  }}</strong></h5>
                            <p>Dated: <strong>{{ $delivery['date'] }}</strong></p>
                        </div>
                        <div class="art-top-left-details">
                            <div class="d-flex justify-content-between">
                                <h6 style="font-size:14px; font-weight:400;">Sub Total</h6>
                                <h6 style="font-size:14px; font-weight:400;">£{{ $items['sub_total'] }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 style="font-size:14px; font-weight:400;">Delivery Cost</h6>
                                <h6 style="font-size:14px; font-weight:400;">£{{ $delivery['price'] }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 style="font-size:14px; font-weight:400;">Proof Reading Cost</h6>
                                <h6 style="font-size:14px; font-weight:400;">£{{ $proof['price'] }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 style="font-size:14px; font-weight:400;">VAT</h6>
                                <h6 style="font-size:14px; font-weight:400;">£{{ $vat_amount }}</h6>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h6>Total Payable</h6>
                                <h6>£{{ $grand_total }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-tab-container">
                    <!-- Tab Headers -->
                    <div class="custom-tabs" id="customTabs">
                        <div class="custom-tab active" data-tab="artwork">
                            <span class="custom-tab-number">1</span>
                            Artwork
                        </div>
                        <div class="custom-tab" data-tab="details">
                            <span class="custom-tab-number">2</span>
                            Details
                        </div>
                        <div class="custom-tab disabled" data-tab="payment">
                            <span class="custom-tab-number">3</span>
                            Payment
                        </div>
                        <!-- <div class="custom-tab" data-tab="printlink">
                                              <span class="custom-tab-number">4</span>
                                              PrintLink
                                              </div> -->
                    </div>
                    <!-- Tab Contents -->
                    <div class="custom-tab-content">
                        <div class="tab-pane active" id="artwork">
                            @include('front.tabs.artwork')
                        </div>
                        <div class="tab-pane" id="details">
                            @include('front.tabs.details')
                        </div>
                        <div class="tab-pane" id="payment">
                            @include('front.tabs.payment')
                        </div>


                        <div class="tab-pane" id="printlink">
                            <h4>PrintLink Section</h4>
                            <div style="height: 150px; background: #d9d6fc;">[Dummy printlink content]</div>
                        </div>
                        <div class="tab-pane" id="messages">
                            <h4>Messages Section</h4>
                            <div style="height: 150px; background: #d6fcd9;">[Dummy messages content]</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Paste Link Modal -->
    <div class="modal fade" id="pasteLinkModal" tabindex="-1" aria-labelledby="pasteLinkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #ffffff; color: #000;">

                <div class="modal-header">
                    <h5 class="modal-title" id="pasteLinkModalLabel">Paste Link to Print File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="url" id="pastedLinkInput" class="form-control" placeholder="Enter file URL (PDF, DOC)">
                    <div id="pastedLinkError" style="color: red; font-size: 14px; margin-top: 6px;"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="addPastedLink()">Add Link</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('after-scripts')
    <script>

        // Video Modal
        const videoModal = document.getElementById('videoModal');
        const videoFrame = document.getElementById('videoFrame');

        videoModal.addEventListener('show.bs.modal', function () {
            videoFrame.src = "https://www.youtube.com/embed/CpTT4tK8zzM?autoplay=1";
        });

        videoModal.addEventListener('hidden.bs.modal', function () {
            videoFrame.src = "";
        });

        // Address Field Focus/Blur
        document.querySelectorAll('.custom-address-field input, .custom-address-field select').forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.style.backgroundColor = '#f0f0f0';
            });
            input.addEventListener('blur', function () {
                this.parentElement.style.backgroundColor = '';
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.custom-tab');
            const panes = document.querySelectorAll('.tab-pane');

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    const tabId = this.getAttribute('data-tab');

                    // Remove active classes
                    tabs.forEach(t => t.classList.remove('active'));
                    panes.forEach(p => p.classList.remove('active'));

                    // Activate selected tab and pane
                    this.classList.add('active');
                    const targetPane = document.getElementById(tabId);
                    if (targetPane) {
                        targetPane.classList.add('active');
                    } else {
                        console.error(`Pane with ID "${tabId}" not found.`);
                    }

                    // Update URL
                    const url = new URL(window.location);
                    url.searchParams.set('tab', tabId);
                    window.history.pushState({}, '', url);
                });
            });

            // Load default tab from URL
            const urlParams = new URLSearchParams(window.location.search);
            const defaultTab = urlParams.get('tab') || 'artwork';
            const tabToActivate = document.querySelector(`.custom-tab[data-tab="${defaultTab}"]`);
            if (tabToActivate) tabToActivate.click();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const defaultTab = urlParams.get('tab') || 'artwork'; // Default tab if none

            const tabToActivate = document.querySelector(`.custom-tab[data-tab="${defaultTab}"]`);
            if (tabToActivate) tabToActivate.click();
        });

    </script>
@endpush