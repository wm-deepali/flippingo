<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
 <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ URL::asset('assets/images/favicon-32x32.png') }}" type="image/png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="description" content="Flippingo">
  <meta name="keywords" content="Flippingo">
   @stack('before-styles')
  <title>@yield('title')</title>
  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/OwlCarousel/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/simplebar/css/simplebar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/metismenu/css/metisMenu.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/pace.min.css') }}">
  <script src="{{ URL::asset('assets/js/pace.min.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/app.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/icons.css') }}">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 @stack('after-styles')
</head>

<body class="bg-theme bg-theme1">

	<b class="screen-overlay"></b>
    

   @include('layouts.includes.header')


    @yield('content')

@include('layouts.includes.footer')
    @yield('footer')

   <!-- Bootstrap JS -->
	<script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ URL::asset('assets/plugins/OwlCarousel/js/owl.carousel.min.js') }}"></script>
	<script src="{{ URL::asset('assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js') }}"></script>
	<script src="{{ URL::asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ URL::asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<!--app JS-->
	<script src="{{ URL::asset('assets/js/app.js') }}"></script>
	<script src="{{ URL::asset('assets/js/index.js') }}"></script>
	 @stack('after-scripts')
	  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Tab functionality
      const tabButtons = document.querySelectorAll('.tab-buttons button');
      const tabContents = document.querySelectorAll('.tab-content');

      tabButtons.forEach(button => {
        button.addEventListener('click', () => {
          tabButtons.forEach(btn => btn.classList.remove('active'));
          tabContents.forEach(content => content.classList.remove('active'));

          button.classList.add('active');
          const tabId = button.getAttribute('data-tab');
          document.getElementById(tabId).classList.add('active');
        });
      });

      // Slider value display
      const pageSlider = document.getElementById('page-slider');
      const currentPages = document.getElementById('current-pages');

      pageSlider.addEventListener('input', function () {
        currentPages.textContent = `Current: ${this.value}`;
        updatePrice();
      });

      // Paper type preview update
      const paperTypeSelect = document.getElementById('paper-type');
      const paperPreview = document.getElementById('paper-preview');

      paperTypeSelect.addEventListener('change', function () {
        const selectedPaper = this.value;
        paperPreview.textContent = `${selectedPaper.charAt(0).toUpperCase() + selectedPaper.slice(1)} Preview`;
        updatePrice();
      });

      // Quantity input
      const quantityInput = document.getElementById('quantity');
      quantityInput.addEventListener('input', updatePrice);

      // Colour printing buttons
      const colourButtons = document.querySelectorAll('#colour-printing button');
      colourButtons.forEach(button => {
        button.addEventListener('click', function () {
          colourButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
          updatePrice();
        });
      });

      // Paper weight buttons
      const weightButtons = document.querySelectorAll('#paper-weight button');
      weightButtons.forEach(button => {
        button.addEventListener('click', function () {
          weightButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
          updatePrice();
        });
      });

      // Add cover checkbox
      const addCoverCheckbox = document.getElementById('addCover');
      addCoverCheckbox.addEventListener('change', updatePrice);

      // Price update function
      function updatePrice() {
        // Base price for 4 pages
        let basePrice = 20;

        // Quantity
        const quantity = parseInt(quantityInput.value) || 1;

        // Colour printing
        const colourOption = document.querySelector('#colour-printing button.active').getAttribute('data-value');
        const colourMultiplier = colourOption === 'colour' ? 1.2 : 1; // +20% for colour

        // Paper type
        const paperType = paperTypeSelect.value;
        const paperTypeCost = {
          gloss: 0,
          matt: 1,
          silk: 2
        }[paperType];

        // Paper weight
        const paperWeight = document.querySelector('#paper-weight button.active').getAttribute('data-value');
        const paperWeightCost = {
          '90gsm': 0,
          '130gsm': 1,
          '150gsm': 2,
          '200gsm': 3
        }[paperWeight];

        // Pages
        const pages = parseInt(pageSlider.value);
        const extraPages = Math.max(0, pages - 4); // Cost for pages beyond the minimum 4
        const pageCost = extraPages * 0.10; // £0.10 per extra page

        // Add cover
        const addCover = addCoverCheckbox.checked;
        const coverCost = addCover ? 5 : 0;

        // Calculate total price per booklet
        let pricePerBooklet = basePrice + paperTypeCost + paperWeightCost + pageCost + coverCost;
        pricePerBooklet *= colourMultiplier; // Apply colour multiplier

        // Total price for all booklets
        let totalPrice = pricePerBooklet * quantity;

        // Delivery options
        const bestValuePrice = totalPrice;
        const fasterPrice = totalPrice * 1.05; // +5% for faster delivery

        // Update UI
        document.getElementById('price-best-value').textContent = `£${bestValuePrice.toFixed(2)}`;
        document.getElementById('price-faster').textContent = `£${fasterPrice.toFixed(2)}`;
      }

      // Initial price calculation
      updatePrice();
    });
  </script>
</body>


<!-- Mirrored from codervent.com/etrans/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Jun 2025 08:29:54 GMT -->

</html>