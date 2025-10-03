@extends('layouts.new-master')

@section('title')
    {{ $page->meta_title ?? 'Flippingo' }}
@endsection

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

    @keyframes slideUp {
        from {
            transform: translateY(100%);
        }

        to {
            transform: translateY(0);
        }
    }
</style>
@section('content')


    <!-- ================================
                                                                                                                                                            START BREADCRUMB AREA
                                                                                                                                                        ================================= -->

    <!-- end breadcrumb-area -->
    <!-- ================================
                                                                                                                                                            END BREADCRUMB AREA
                                                                                                                                                        ================================= -->
    <section class="card-area " style="padding-top:60px; padding-bottom:90px; margin-top:130px;">
        <div class="container">
            <div class="card">
                <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                    <p class="card-text py-2">Showing 1 to 6 of 30 entries</p>
                    <div class="d-flex align-items-center">
                        <select class="select-picker select-picker-sm me-3" data-width="160" data-size="5">
                            <option value="">Short by</option>
                            <option value="short-by-default">Short by default</option>
                            <option value="high-rated">High Rated</option>
                            <option value="most-reviewed">Most Reviewed</option>
                            <option value="popular-Listing">Popular Listing</option>
                            <option value="newest-Listing">Newest Listing</option>
                            <option value="older-Listing">Older Listing</option>
                            <option value="price-low-to-high">Price: low to high</option>
                            <option value="price-high-to-low">Price: high to low</option>
                            <option value="random-listing">Random listing</option>
                        </select>
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Search</h4>
                                <div class="form-group">
                                    <span class="fal fa-search form-icon"></span>
                                    <input class="form-control form--control" type="text"
                                        placeholder="What are you looking for?" />
                                </div>
                                <!-- end form-group -->
                                <div class="form-group">
                                    <span class="fal fa-map-marker-alt form-icon"></span>
                                    <input class="form-control form--control" type="text" placeholder="Location" />
                                </div>
                                <!-- end form-group -->
                                <div class="form-group select2-container-wrapper">
                                    <select class="select-picker" data-width="100%" data-size="5">
                                        <option value>Select a Category</option>
                                        <option value="1">Shops</option>
                                        <option value="2">Hotels</option>
                                        <option value="3">Foods & Restaurants</option>
                                        <option value="4">Fitness</option>
                                        <option value="5">Travel</option>
                                        <option value="6">Salons</option>
                                        <option value="7">Event</option>
                                        <option value="8">Business</option>
                                    </select>
                                </div>
                                <!-- end form-group -->
                                <button class="theme-btn border-0 w-100" type="submit">
                                    Search
                                </button>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Price</h4>
                                <form action="#" class="d-flex align-items-center">
                                    <div class="form-group me-2">
                                        <input class="form-control form--control ps-3" type="text" placeholder="$3" />
                                    </div>
                                    <div class="form-group me-2">
                                        <input class="form-control form--control ps-3" type="text" placeholder="$269" />
                                    </div>
                                    <button class="theme-btn theme-btn-gray border-0 mb-3" type="submit">
                                        <i class="fal fa-angle-right"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Tags</h4>
                                <ul class="tag-list">
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Hotel</a></li>
                                    <li><a href="#">Food</a></li>
                                    <li><a href="#">Bars</a></li>
                                    <li><a href="#">Salon</a></li>
                                    <li><a href="#">Cleaning</a></li>
                                    <li><a href="#">Fashion</a></li>
                                </ul>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Features</h4>
                                <div class="mb-2">
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="ElevatorInBuilding" />
                                        <label class="custom-control-label" for="ElevatorInBuilding">Elevator in
                                            building</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="FriendlyWorkspace" />
                                        <label class="custom-control-label" for="FriendlyWorkspace">Friendly
                                            workspace</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="InstantBook" />
                                        <label class="custom-control-label" for="InstantBook">Instant Book</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="WirelessInternet" />
                                        <label class="custom-control-label" for="WirelessInternet">Wireless Internet</label>
                                    </div>
                                </div>
                                <div class="collapse" id="moreFeatureCollapse">
                                    <div class="more-content-wrap">
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input"
                                                id="FreeParkingOnPremises" />
                                            <label class="custom-control-label" for="FreeParkingOnPremises">Free parking on
                                                premises</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="FreeParkingOnStreet" />
                                            <label class="custom-control-label" for="FreeParkingOnStreet">Free parking on
                                                street</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="SmokingAllowed" />
                                            <label class="custom-control-label" for="SmokingAllowed">Smoking allowed</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="Events" />
                                            <label class="custom-control-label" for="Events">Events</label>
                                        </div>
                                    </div>
                                    <!-- end more-content-wrap -->
                                </div>
                                <!-- end collapse -->
                                <a class="collapse-btn btn-link" data-bs-toggle="collapse" href="#moreFeatureCollapse"
                                    role="button" aria-expanded="false" aria-controls="moreFeatureCollapse">
                                    <span class="collapse-icon-show">Show more <i class="fal fa-angle-down"></i></span>
                                    <span class="collapse-icon-hide">Show less <i class="fal fa-angle-up"></i></span>
                                </a>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Ratings</h4>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="fiveStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="fiveStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="5"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="fourStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="fourStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="4"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="threeStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="threeStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="3"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="twoStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="twoStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="2"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="oneStarRadio"
                                        name="radio-stacked" />
                                    <label class="custom-control-label" for="oneStarRadio">
                                        <span class="star-rating d-inline-block line-height-24 font-size-15"
                                            data-rating="1"></span>
                                    </label>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end sidebar -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-9">
                    <div class=" " style="margin-bottom: 30px;">
                        <button class="tab-btn active" data-category="all">All</button>
                        @foreach($categories as $category)
                            <button class="tab-btn" data-category="{{ $category->slug }}">{{ $category->name }}</button>
                        @endforeach
                    </div>
                    <div id="submissions-container">

                        {{-- All submissions (for All tab) --}}
                        <div class="submission-group wishlist-card" data-group="all">
                            @foreach($allSubmissions as $submission)
                                @php
                                    $catSlug = $submission['category']->slug ?? 'uncategorized';
                                    $catName = $submission['category']->name ?? '';

                                    $fields = json_decode($submission['data'], true);
                                    $productTitle = $fields['product_title']['value'] ?? 'No Title';
                                   $offeredPrice = ($fields['urgent_sale']['value'] ?? '') === 'Yes'
    ? ($fields['offered_price']['value'] ?? '0')
    : ($fields['mrp']['value'] ?? '0');


                                   $imageFile = $submission['imageFile'] ?? null; 
                                    $summaryFields = $submission['summaryFields'] ?? null;
                                  @endphp
                                <div class="wishlist-product-card" data-category="{{ $catSlug }}">
                                    @if($imageFile)
                                        <img src="{{ asset('storage/' . $imageFile['file_path']) }}" />
                                    @else
                                        <img
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                                    @endif
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
                                            <p>{{ $catName }}</p>
                                            <div class="budge-active1">
                                                <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                            </div>

                                        </div>
                                        <h3 class="mt-2 " style="color: #000;">{{ $productTitle }}</h3>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">By
                                                {{ ($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '') }}
                                            </p>

                                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                        </div>
                                        <div class="wishlist-item-card">
                                  @if(!empty($summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    @endphp

    @if(!empty($textFields))
        @foreach($textFields as $field)
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="{{ $field['icon'] ?? '' }}"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;">{{ $field['label'] ?? '' }}</p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;">{{ $field['value'] ?? '' }}</h5>
                </div>
            </div>
        @endforeach
    @endif
@endif


                                        </div>
                                        <div class="wishlist-price d-flex justify-content-between mt-3">
                                            <h2 style="color: #000;"><i
                                                    class="fa-solid fa-indian-rupee-sign"></i>{{ $offeredPrice }}</h2>
                                            <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                View Detail
                                            </button>
                                        </div>

                                    </div>
                                    <div class="more-info" data-aos="fade-up" data-aos-duration="500">
                                        <div class="wishlist-button">
                                            <p>{{ $catName }}</p>
                                            <div class="budge-active1">
                                                <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                            </div>

                                        </div>
                                        <h3 class="mt-2" style="color: #000;">{{ $productTitle ?? '' }}</h3>
                                       @if(!empty($summaryFields))
    @php
        // Filter textarea fields using array_filter
        $textareaFields = array_filter($summaryFields, function($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'textarea');
        });
    @endphp

    @if(!empty($textareaFields))
        <p style="font-size: 13px;">
            @foreach($textareaFields as $index => $field)
                @if(!empty($field['icon']))
                    <i class="{{ $field['icon'] }}" style="margin-right: 4px;"></i>
                @endif
                {{ \Illuminate\Support\Str::limit($field['value'], 100, '...') }}

                {{-- Separator except for last item --}}
                @if($index !== array_key_last($textareaFields))
                    &nbsp;|&nbsp;
                @endif
            @endforeach
        </p>
    @endif
@endif

                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">By
                                                {{ ($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '') }}
                                            </pre>
                                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                        </div>
                                        <div class="wishlist-item-card">
                                              @if(!empty($summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    @endphp

    @if(!empty($textFields))
        @foreach($textFields as $field)
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="{{ $field['icon'] ?? '' }}"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;">{{ $field['label'] ?? '' }}</p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;">{{ $field['value'] ?? '' }}</h5>
                </div>
            </div>
        @endforeach
    @endif
@endif
                                        </div>
                                        <div class="wishlist-price d-flex justify-content-between mt-3">
                                            <h2 style="color: #000;"><i
                                                    class="fa-solid fa-indian-rupee-sign"></i>{{ $offeredPrice }}</h2>
                                            <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                View Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                        {{-- Submission per category --}}
                        @foreach($categories as $category)
                            <div class="submission-group wishlist-card" data-group="{{ $category->slug }}"
                                style="display:none;">
                                @if(isset($submissionsByCategory[$category->id]))
                                    @foreach($submissionsByCategory[$category->id] as $submission)
                                        @php
                                            $fields = json_decode($submission->data, true);
                                            $productTitle = $fields['product_title']['value'] ?? 'No Title';
                                             $offeredPrice = ($fields['urgent_sale']['value'] ?? '') === 'Yes'
    ? ($fields['offered_price']['value'] ?? '0')
    : ($fields['mrp']['value'] ?? '0');

                                    $imageFile = $submission->imageFile ?? null; 
                                    $summaryFields = $submission->summaryFields ?? null;

                                        @endphp
                                        <div class="wishlist-product-card" data-category="{{ $category->slug }}">
                                            @if($imageFile)
                                                <img src="{{ asset('storage/' . $imageFile['file_path']) }}" />
                                            @else
                                                <img
                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                                            @endif
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
                                                    <p>{{ $category->name }}</p>
                                                    <div class="budge-active1">
                                                        <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                                    </div>
                                                </div>
                                                <h3 class="mt-2 " style="color: #000;">{{ $productTitle }}</h3>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0">By
                                                        {{ ($submission['customer']->first_name ?? '') . ' ' . ($submission['customer']->last_name ?? '') }}
                                                    </p>
                                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                                </div>
                                                <div class="wishlist-item-card">
                                                    @if(!empty($summaryFields))
                                                    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    @endphp

    @if(!empty($textFields))
        @foreach($textFields as $field)
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="{{ $field['icon'] ?? '' }}"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;">{{ $field['label'] ?? '' }}</p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;">{{ $field['value'] ?? '' }}</h5>
                </div>
            </div>
        @endforeach
   @endif
@endif
                                                </div>
                                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                                    <h2 style="color: #000;"><i
                                                            class="fa-solid fa-indian-rupee-sign"></i>{{ $offeredPrice }}</h2>
                                                    <button type="button" class="btn btn-dark"
                                                        onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                        View Detail
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">
                                                <div class="wishlist-button">
                                                    <p>{{ $category->name }}</p>
                                                    <div class="budge-active1">
                                                        <p><i class="fa-solid fa-circle-check"></i> Verified</p>
                                                    </div>

                                                </div>
                                                <h3 class="mt-2" style="color: #000;">{{ $productTitle ?? '' }}</h3>
                                                @if(!empty($summaryFields))
    @php
        // Filter textarea fields using array_filter
        $textareaFields = array_filter($summaryFields, function($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'textarea');
        });
    @endphp

    @if(!empty($textareaFields))
        <p style="font-size: 13px;">
            @foreach($textareaFields as $index => $field)
                @if(!empty($field['icon']))
                    <i class="{{ $field['icon'] }}" style="margin-right: 4px;"></i>
                @endif
                {{ \Illuminate\Support\Str::limit($field['value'], 100, '...') }}

                {{-- Separator except for last item --}}
                @if($index !== array_key_last($textareaFields))
                    &nbsp;|&nbsp;
                @endif
            @endforeach
        </p>
    @endif
@endif

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0">By
                                                        {{ ($submission['customer']->first_name ?? '') . ' ' . ($submission['customer']->last_name ?? '') }}
                                                    </p>
                                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                                </div>
                                                <div class="wishlist-item-card">
                                               @if(!empty($summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    @endphp

    @if(!empty($textFields))
        @foreach($textFields as $field)
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="{{ $field['icon'] ?? '' }}"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;">{{ $field['label'] ?? '' }}</p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;">{{ $field['value'] ?? '' }}</h5>
                </div>
            </div>
        @endforeach
           @endif
@endif

                                                </div>
                                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                                    <h2 style="color: #000;"><i
                                                            class="fa-solid fa-indian-rupee-sign"></i>{{ $offeredPrice }}</h2>
                                                    <button type="button" class="btn btn-dark"
                                                        onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                        View Detail
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No submission available.</p>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- ================================
                                                                                                                                                            START CARD AREA
                                                                                                                                                        ================================= -->

    <!-- end card-area -->
    <!-- ================================
                                                                                                                                                            END CARD AREA
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
@endsection