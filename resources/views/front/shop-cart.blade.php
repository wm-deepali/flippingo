@extends('layouts.new-master')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@section('title')
    Flippingo
@endsection
<link href="assets/css/app.css" rel="stylesheet">
@push('after-styles')
    <style>
        .dropdown-menu {
            -webkit-box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
            border: 0 solid #e9ecef !important;
            font-size: 14px !important;
            margin: 8px 0 0 !important;
            border-radius: 0px !important;
            background-color: rgb(30 30 30 / 90%) !important;
        }

        .dropdown-toggle::after {
            display: none !important;
        }

        .primary-menu .navbar .dropdown-large-menu ul li {
            background: black;
        }

        .list-group-item.active {
            background-color: #656565 !important;
            border-color: #656565 !important;
        }

        .nav-item a {
            color: gray !important;
        }

        .page-wrapper {
            height: auto;
        }

        .cart-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .quote-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .section-title {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .img-thumb {
            width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .upgrade-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
        }

        .btn-custom {
            background-color: #00aaa5;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #008f89;
        }

        .total-row {
            font-weight: bold;
            font-size: 18px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .btn-info {
            border: none;
            padding: 4px 7px;
            border-radius: 3px;
            background-color: rgba(128, 128, 128, 0.158);
        }

        .continue-class {
            width: 100%;
            border: none;
            height: 35px;
            border-radius: 3px;
            background-color: #f42b5b !important;
            color: #fff;
            margin-bottom: 20px;
        }

        .start-new {
            width: 100%;
            border: none;
            height: 35px;
            border-radius: 3px;
            background-color: #e9e7e8 !important;
            color: #525252;
        }

        .custom-stepper-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 40px 0;
            gap: 40px;
        }

        .custom-stepper-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-size: 14px;
            color: #666;
            text-decoration: none;
            position: relative;
        }

        .custom-stepper-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            color: white;
            font-weight: bold;
        }

        .custom-stepper-step.active .custom-stepper-circle {
            background: #00aaa5;
        }

        .custom-stepper-step.completed .custom-stepper-circle {
            background: #00aaa5;
        }

        .custom-stepper-step.completed .custom-stepper-circle::before {
            content: "✓";
        }

        .custom-stepper-step.completed .custom-stepper-circle span,
        .custom-stepper-step.active .custom-stepper-circle span {
            display: none;
        }

        .custom-stepper-step.active,
        .custom-stepper-step.completed {
            color: #00aaa5;
        }

        .custom-stepper-step:not(:last-child)::after {
            content: "";
            position: absolute;
            width: 40px;
            height: 2px;
            background: #ccc;
            top: 14px;
            left: calc(100% + 5px);
            z-index: -1;
        }

        .custom-stepper-step.completed::after,
        .custom-stepper-step.active::after {
            background: #00aaa5;
        }
    </style>
    <style>
        .custom-op {
            border: 2px solid #6bd3cc !important;
            color: black !important;
            border-radius: .375rem !important;
        }

        input::placeholder {
            color: #000 !important;
            opacity: 1 !important;
        }

        .form-select option {
            background-color: #fff;
            color: #000;
        }
    </style>
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container">
                <div class="custom-stepper-wrapper" id="customStepper">

                    <!-- STEP TEMPLATE -->
                    <a href="shop-cart.html" class="custom-stepper-step" data-path="shop-cart.html">
                        <div class="custom-stepper-circle"><span>1</span></div>
                        <div>Cart</div>
                    </a>

                    <a href="/checkout" class="custom-stepper-step" data-path="/checkout">
                        <div class="custom-stepper-circle"><span>2</span></div>
                        <div>Checkout</div>
                    </a>

                    <a href="/payment" class="custom-stepper-step" data-path="/payment">
                        <div class="custom-stepper-circle"><span>3</span></div>
                        <div>Payment</div>
                    </a>

                    <a href="/confirm" class="custom-stepper-step" data-path="/confirm">
                        <div class="custom-stepper-circle"><span>4</span></div>
                        <div>Confirm</div>
                    </a>

                    <a href="/printing" class="custom-stepper-step" data-path="/printing">
                        <div class="custom-stepper-circle"><span>5</span></div>
                        <div>Printing</div>
                    </a>

                    <a href="/shipped" class="custom-stepper-step" data-path="/shipped">
                        <div class="custom-stepper-circle"><span>6</span></div>
                        <div>Shipped</div>
                    </a>

                </div>
            </div>

            <!--start breadcrumb-->
            <section class="py-3 border-bottom d-none d-md-flex"
                style="background: #f1f2f7;
                                                                                                              padding: 40px 0;">
                <!--end shop cart-->
                <div class="container" style="max-width: 900px;">
                    <div class="row g-4">
                        <!-- Left Section -->
                        <div class="col-md-7">
                            <div class="cart-box">
                                <!-- <div class="section-title">Shopping Cart</div> -->
                                @php
                                    use Carbon\Carbon;

                                    $formattedDate = isset($cartData['delivery']['date']) ? Carbon::parse($cartData['delivery']['date'])->translatedFormat('l, jS F Y') : '';
                                @endphp
                                @if ($cartData)
                                    <div class="d-flex justify-content-between mb-3">
                                        <p><strong>Shipping:</strong> {{ $formattedDate }}</p>
                                        <h5><strong>Subtotal:</strong> £{{ $cartData['items']['sub_total'] ?? 0 }} </h5>
                                    </div>

                                    <div class="d-flex align-items-start mb-3">
                                        @if($cartData['subcategory_thumbnail'])
                                            <img src="{{ asset('storage/' . $cartData['subcategory_thumbnail']) }}"
                                                alt="Product Thumbnail" class="img-thumb me-3">
                                        @else
                                            <img src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/price-calculator/boundSubstrateTypeId/thumbnails/3.png"
                                                class="img-thumb me-3 " alt="Product Image">
                                        @endif
                                        <div class="col-9">
                                            <p class="mb-1"><strong>{{ $cartData['items']['quantity'] }}
                                                    {{ $cartData['subcategory_name'] }}</strong></p>
                                            @foreach ($cartData['attributes_resolved'] as $attr)
                                                <p class="mb-1">
                                                    {{ $attr['attribute_name'] }}: {{ $attr['value_name'] }}
                                                    @if (!empty($attr['value_description']))
                                                        ({{ $attr['value_description'] }})
                                                    @endif
                                                </p>
                                            @endforeach
                                            <!-- <div class="d-flex justify-content-between mb-3 mt-3 ">
                                                                                                                                                                        <span>Subtotal:</span>
                                                                                                                                                              <span>£15.00 <br><span>VAT: £3.00</span></span>


                                                                                                                                                                    </div> -->
                                        </div>

                                    </div>


                                    <hr />
                                    <div class="d-flex gap-2 mb-4" style=" flex-direction: row-reverse;">

                                        <!-- <button class="btn-info trash "><i class="fa-solid fa-trash"></i></button>
                                                                                                                        <button class="btn-info "><i class="fa-solid fa-pen-to-square"></i> Edit</button> -->
                                        <!--<button class="btn-info "><i class="fa-solid fa-copy"></i> Duplicate</button>-->
                                    </div>



                                    <!--<p>Enter your Postcode to get delivery rates</p>-->
                                    <p><strong>Delivery Weight:</strong> {{ $cartData['paper_total_weight'] }} kg</p>

                                @else
                                    <div class="text-center py-5">
                                        <h4>Your cart is empty</h4>
                                        <a href="/" class="btn btn-primary mt-3">Add Order</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Section -->
                        @if ($cartData)
                            <div class="col-md-5">
                                <div class="quote-box">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5>Quote Number:<strong> #{{ $cartData['quote_id'] ?? '' }}</strong></h5>

                                    </div>

                                    <!--<p class="mb-1"><small>Quote Reference: 1667893</small></p>-->

                                    <div class="d-flex justify-content-between">
                                        <span><strong>{{ $cartData['subcategory_name'] }} x {{ $cartData['items']['quantity'] }}
                                                Copies</strong></span>
                                        <span>£{{ $cartData['items']['sub_total'] ?? 0}}</span>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <span>Delivery Cost</span>
                                        <span class="delivery_charge">£{{ $cartData['delivery']['price'] ?? 0}}</span>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <span>Proof Reading Cost</span>
                                        <span>£{{ $cartData['proof']['price'] ?? 0 }}</span>
                                    </div>

                                    <hr>

                                    <p><strong>Total Weight:</strong> {{ $cartData['paper_total_weight'] }} kg</p>


                                    <div class="mb42">
                                        <label class="form-label" style="font-size:16px; font-weight:600;">
                                            Calculate Shipping & Delivery:
                                        </label>
                                        <select class="form-select custom-op" id="deliverySelect" name="delivery[id]">
                                            @foreach($allDeliveryCharges->groupBy('continent') as $continent => $charges)
                                                <optgroup label="{{ ucfirst($continent) }}">
                                                    @foreach ($charges as $charge)
                                                        <option value="{{ $charge->id }}" data-title="{{ $charge->title }}"
                                                            data-price="{{ $charge->price }}" {{ isset($cartData['delivery']['title']) && $cartData['delivery']['title'] === $charge->title ? 'selected' : '' }}>
                                                            {{ $charge->title }}
                                                        </option>

                                                    @endforeach
                                                </optgroup>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="input-group mb-2 " style="margin-top:30px;">
                                        <input type="text" class="form-control" placeholder="Enter Postcode" id="postcodeInput">
                                        <button class="btn btn-custom" id="applyPostcodeBtn">Apply</button>
                                    </div>
                                    <p id="postcodeStatus" class="mt-2"></p>


                                    <!--<div class="form-check form-switch mb-3">-->
                                    <!--  <input class="form-check-input" type="checkbox" id="plainPackage">-->
                                    <!--  <label class="form-check-label" for="plainPackage">Use Plain Packaging</label>-->
                                    <!--</div>-->

                                    <!--<div class="input-group mb-3">-->
                                    <!--  <input type="text" class="form-control" placeholder="Enter discount code if you have one">-->
                                    <!--  <button class="btn btn-custom">Apply</button>-->
                                    <!--</div>-->
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span>Subtotal:</span>
                                        <span id="subtotal">£{{ $cartData['items']['sub_total'] ?? 0}}</span>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <span>Total Delivery Cost:</span>
                                        <span class="delivery_charge">£{{ $cartData['delivery']['price'] ?? 0}}</span>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <span>Total Proof Reading Cost:</span>
                                        <span>£{{ $cartData['proof']['price'] ?? 0}}</span>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <span>VAT:</span>
                                        <span>£{{$cartData['vat_amount'] ?? 0 }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between  mt-2">
                                        <span><strong>Grand Total</strong></span>
                                        <span><strong id="grandTotalAmount">£{{ $cartData['grand_total'] }}</strong></span>
                                    </div>
                                    <hr>
                                    <button class="continue-class" id="continueToCheckout">Continue</button>

                                    <button type="button" class="start-new" data-toggle="modal" data-target="#startQuoteModal">
                                        Start a New Quote
                                    </button>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </section>
        </div>
    </div>

    <!-- Start Quote Modal -->
    <div class="modal fade" id="startQuoteModal" tabindex="-1" role="dialog" aria-labelledby="startQuoteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color:white;">
                <div class="modal-header">
                    <h5 class="modal-title">Start a New Quote</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to start a new quote? This will remove the current cart.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="confirmStartQuote" type="button" class="btn btn-danger">Yes, Start New</button>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    $(document).ready(function () {
        $('#deliverySelect').on('change', function () {
            let selected = $(this).find('option:selected');
            let price = parseFloat(selected.data('price')) || 0;
            let deliveryTitle = selected.data('title') || '';
            let deliveryId = selected.val();

            // Update delivery cost in UI
            $('.delivery_charge').text('£' + price.toFixed(2));

            fetch('{{ route('cart.update.delivery') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: deliveryId,
                    title: deliveryTitle,
                    price: price
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('#grandTotalAmount').text('£' + data.grand_total.toFixed(2));
                        $('span:contains("VAT:")').next().text('£' + data.vat_amount.toFixed(2));
                    } else {
                        alert(data.message || 'Failed to update session');
                    }
                })
                .catch(() => {
                    alert('Error occurred during delivery update.');
                });
        });

    });



    document.addEventListener('DOMContentLoaded', function () {

        const continueBtn = document.getElementById('continueToCheckout');

        continueBtn?.addEventListener('click', function () {
            fetch("{{ route('cart.save.before.checkout') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({}) // Add data if needed
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/checkout';
                    } else {
                        alert('Unable to continue. Please try again.');
                    }
                })
                .catch(err => {
                    alert('Error occurred while processing. Try again.');
                });
        });

        document.getElementById('confirmStartQuote').addEventListener('click', function () {
            fetch("{{ route('cart.clear') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/';
                    } else {
                        alert("Something went wrong.");
                    }
                })
                .catch(() => alert("Request failed."));
        });

        const applyBtn = document.getElementById('applyPostcodeBtn');
        const postcodeInput = document.getElementById('postcodeInput');
        const status = document.getElementById('postcodeStatus');

        if (applyBtn && postcodeInput && status) {
            applyBtn.addEventListener('click', function () {
                const postcode = postcodeInput.value.trim();

                fetch('{{ route('check.postcode') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ postcode: postcode })
                })
                    .then(res => res.json())
                    .then(data => {
                        status.innerText = data.message;
                        status.style.color = data.exists ? 'green' : 'red';
                    })
                    .catch(() => {
                        status.innerText = 'Something went wrong.';
                        status.style.color = 'red';
                    });
            });
        }

        // Highlight current step
        const currentPath = window.location.pathname;
        const steps = document.querySelectorAll('.custom-stepper-step');
        let activeIndex = -1;

        steps.forEach((step, index) => {
            if (step.dataset.path === currentPath) activeIndex = index;
        });

        steps.forEach((step, index) => {
            if (index < activeIndex) step.classList.add('completed');
            else if (index === activeIndex) step.classList.add('active');
        });
    });
</script>