@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Wishlist' }}
@endsection


<style>
    .wishlist-container {

        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);


    }

    .wishlist-cont {
        height: 300px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .wishlist-create {
        background-color: #000;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .wishlist-container p {
        color: #666;
        margin-top: 10px;
    }

    .wishlist-item {
        display: inline-block;
        background: white;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 10px;
        width: 200px;
        text-align: left;
    }

    .wishlist-item .item-tags {
        display: flex;
        gap: 5px;
    }

    .wishlist-item .item-tags span {
        background: #e0e0e0;
        padding: 2px 10px;
        border-radius: 10px;
        font-size: 12px;
    }

    .wishlist-item img {
        width: 100%;
        border-radius: 5px;
    }

    .wishlist-item .item-details {
        margin: 10px 0;
    }

    .wishlist-item .view-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="wishlist-page">

            <div class="wishlist-container">
                <!-- <h2 style="color: #000;font-weight: 600; line-height: 20px;">Draft Listings</h2>
                                            <p>Continue where you left off</p> -->
                <div class="wishlist-cont">
                    <button type="button"  onclick="window.location.href='{{ route('listing-list') }}'" class="wishlist-create">+ Create Your Wishlist</button>
                    <p>you can create your wishlist to keep getting the updates.</p>
                </div>
            </div>


            <div class="wishlist-card">
                @if($wishlist->count())
                    @foreach($wishlist as $item)
                        @php
                            $submission = $item->submission ?? [];
                            $customer = $submission->customer ?? [];
                        @endphp

                        <div class="wishlist-product-card">
                            @if($submission->product_photo)
                                <img src="{{ asset('storage/' . $submission->product_photo) }}" />
                            @else
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                            @endif
                            <div class="wishlist-budge">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="budge-active">
                                        <p><i class="fa-solid fa-circle-check"></i> Active</p>
                                    </div>
                                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i>
                                    </h4>

                                </div>

                            </div>
                            <div class="product-details-hover">
                                <div class="wishlist-button">
                                    <p>{{ $submission->category_name ?? '' }}</p>

                                </div>
                                <h3 class="mt-2 " style="color: #000;">{{ $submission->product_title ?? '' }}</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By {{ ($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '') }}</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                     @if(!empty($submission->summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($submission->summaryFields, function ($field) {
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
                                            class="fa-solid fa-indian-rupee-sign"></i>{{ $submission->offered_price ?? '' }}</h2>
                                    <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                View Detail
                                            </button>

                                </div>

                            </div>
                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                                <div class="wishlist-button">
                                    <p>{{ $submission->category_name ?? '' }}</p>
                                
                                </div>
                                <h3 class="mt-2" style="color: #000;">{{$submission->product_title ?? ''}}</h3>
                             @if(!empty($submission->summaryFields))
    @php
        // Filter textarea fields using array_filter
        $textareaFields = array_filter($submission->summaryFields, function($field) {
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
                                    <p class="m-0">By {{ ($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '') }}</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                  @if(!empty($submission->summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($submission->summaryFields, function ($field) {
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
                                            class="fa-solid fa-indian-rupee-sign"></i>{{ $submission->offered_price ?? '' }}</h2>
                                       <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                View Detail
                                            </button>

                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $wishlist->links() }}
                    </div>
                @else
                    <p class="text-center">No items in wishlist yet.</p>
                @endif
            </div>

       

        </div>
    </div>


@endsection