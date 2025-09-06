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
                    <button class="wishlist-create">+ Create Your Wishlist</button>
                    <p>you can create your wishlist to keep getting the updates.</p>
                </div>


            </div>

            <div class="wishlist-card">
                <div class="wishlist-product-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
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
                            <p>Website</p>

                        </div>
                        <h3 class="mt-2 " style="color: #000;">Demo Content</h3>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="m-0">By Rohan Wagha</p>
                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                        </div>
                        <div class="wishlist-item-card">
                            <div class="wishlist-left">
                                <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                <div class="d-flex flex-column ">
                                    <p class="m-0" style="font-size: 16px;">Revenue</p>
                                    <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                </div>

                            </div>
                            <div class="wishlist-left">
                                <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i></p>
                                <div class="d-flex flex-column ">
                                    <p class="m-0" style="font-size: 16px;">Traffic</p>
                                    <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                </div>

                            </div>

                        </div>
                        <div class="wishlist-price d-flex justify-content-between mt-3">
                            <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                            <button> View Detail</button>

                        </div>

                    </div>
                    <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                        <h3 class="mt-2" style="color: #000;">More Information</h3>
                        <p style="font-size: 13px;">Free consultation | Fast Approval | 100% Transparent Process | No Hidden
                            Cost</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="m-0">By Rohan Wagha</p>
                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                        </div>
                        <div class="wishlist-item-card">
                            <div class="wishlist-left">
                                <p class="m-0" style="color: green;"><i class="fa-solid fa-dollar-sign"></i></p>
                                <div class="d-flex flex-column ">
                                    <p class="m-0" style="font-size: 16px;">Revenue</p>
                                    <h5 class="m-0" style="color: #000 ;font-size: 16px;">45/mo</h5>
                                </div>

                            </div>
                            <div class="wishlist-left">
                                <p class="m-0" style="color: rgb(17, 96, 216);"><i class="fa-solid fa-eye"></i></p>
                                <div class="d-flex flex-column ">
                                    <p class="m-0" style="font-size: 16px;">Traffic</p>
                                    <h5 class="m-0" style="color: #000 ;font-size: 16px;">4597/mo</h5>
                                </div>

                            </div>

                        </div>
                        <div class="wishlist-price d-flex justify-content-between mt-3">
                            <h2 style="color: #000;"><i class="fa-solid fa-indian-rupee-sign"></i>10,000</h2>
                            <button> View Detail</button>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


@endsection