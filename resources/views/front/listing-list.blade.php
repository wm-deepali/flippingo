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
@section('content')
                                                                                                                           
    <section class="card-area " style="padding-top:60px; padding-bottom:90px; margin-top:130px;">
        <div class="container">
            <div class="card">
                <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                    <p class="card-text py-2">Showing 1 to 6 of 30 entries</p>
                    <div class="d-flex align-items-center">
                     <form id="sortForm" method="GET" action="{{ url()->current() }}" class="d-inline">
    @foreach(request()->except('sort') as $key => $value)
        @if(is_array($value))
            @foreach($value as $subValue)
                <input type="hidden" name="{{ $key }}[]" value="{{ $subValue }}">
            @endforeach
        @else
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach

    <select class="form-select" id="sort" name="sort" onchange="this.form.submit()">
        <option value="">Default</option>
        <option value="price-low-to-high" {{ request('sort') == 'price-low-to-high' ? 'selected' : '' }}>Price: Low to High</option>
        <option value="price-high-to-low" {{ request('sort') == 'price-high-to-low' ? 'selected' : '' }}>Price: High to Low</option>
        <option value="new-first" {{ request('sort') == 'new-first' ? 'selected' : '' }}>Newest Listings</option>
        <option value="most-popular" {{ request('sort') == 'most-popular' ? 'selected' : '' }}>Most Popular</option>
        <option value="most-rated" {{ request('sort') == 'most-rated' ? 'selected' : '' }}>Most Rated</option>
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
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="theme-btn border-0 w-100" id="clear-filters">Clear</button>
        </div>

        <form id="filter-form" method="GET" action="{{ route('listing-list') }}">
            @csrf

            {{-- Search --}}
            <div class="form-group mb-3">
                <span class="fal fa-search form-icon"></span>
                <input name="search" class="form-control form--control" type="text"
                       placeholder="What are you looking for?"
                       value="{{ request('search') }}">
            </div>

            {{-- Country --}}
            <div class="form-group mb-3">
                <label for="country">Country</label>
                <select name="country" class="form-select">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}" {{ request('country') == $country->name ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- For Sale --}}
            <div class="form-group mb-3">
                <label for="for_sale">For Sale</label>
                <select name="for_sale" class="form-select">
                    <option value="">Select</option>
                    <option value="Yes" {{ request('for_sale') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ request('for_sale') == 'No' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            {{-- Price --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Price</h4>
                    <div class="d-flex align-items-center">
                        <div class="form-group me-2">
                            <input name="price_min" class="form-control form--control ps-3" type="text" placeholder="₹3"
                                   value="{{ request('price_min') }}">
                        </div>
                        <div class="form-group me-2">
                            <input name="price_max" class="form-control form--control ps-3" type="text" placeholder="₹269"
                                   value="{{ request('price_max') }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ratings --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Ratings</h4>
                    @for($i=5; $i>=1; $i--)
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="{{ $i }}StarRadio" name="rating" value="{{ $i }}"
                                   {{ request('rating') == $i ? 'checked' : '' }} />
                            <label class="custom-control-label" for="{{ $i }}StarRadio">
                                <span class="star-rating d-inline-block line-height-24 font-size-15" data-rating="{{ $i }}"></span>
                            </label>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Dynamic Category Filters -->
            @foreach($categories as $category)
                <div class="category-filters" data-category="{{ $category['slug'] ?? '' }}" style="display:none;">
                    @if(isset($category['filters']) && count($category['filters']))
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Category Filters</h4>
                                @foreach($category['filters'] as $filter)
                                    <div class="mb-3">
                                        @php
                                            $fieldKey = $filter['field_key'] ?? $filter['field_id'];
                                            $oldValue = request()->input("filters.$fieldKey");
                                        @endphp
                                        @switch($filter['type'] ?? '')
                                            @case('text')
                                            <h6 class="mb-2">{{ $filter['label'] ?? '' }}</h6>
                                            <input type="text" name="filters[{{ $fieldKey }}]" class="form-control"
                                                   placeholder="Enter {{ $filter['label'] ?? '' }}"
                                                   value="{{ $oldValue }}">
                                            @break

                                            @case('number')
                                            <h6 class="mb-2">{{ $filter['label'] ?? '' }}</h6>
                                            <input type="number" name="filters[{{ $fieldKey }}]" class="form-control"
                                                   placeholder="Enter {{ $filter['label'] ?? '' }}"
                                                   value="{{ $oldValue }}">
                                            @break

                                            @case('date')
                                            <h6 class="mb-2">{{ $filter['label'] ?? '' }}</h6>
                                            <input type="date" name="filters[{{ $fieldKey }}]" class="form-control"
                                                   value="{{ $oldValue }}">
                                            @break

                                            @case('email')
                                            <h6 class="mb-2">{{ $filter['label'] ?? '' }}</h6>
                                            <input type="email" name="filters[{{ $fieldKey }}]" class="form-control"
                                                   placeholder="Enter {{ $filter['label'] ?? '' }}"
                                                   value="{{ $oldValue }}">
                                            @break

                                            @case('textarea')
                                            <h6 class="mb-2">{{ $filter['label'] ?? '' }}</h6>
                                            <textarea name="filters[{{ $fieldKey }}]" class="form-control" rows="2"
                                                      placeholder="Enter {{ $filter['label'] ?? '' }}">{{ $oldValue }}</textarea>
                                            @break

                                            @case('checkbox')
                                            <h6 class="mb-2">{{ $filter['label'] ?? '' }}</h6>
                                            @foreach($filter['options'] as $index => $option)
                                                @php
                                                    $optionId = 'filter_'.$filter['field_id'].'_'.$index;
                                                    $optionLabel = explode('|', $option)[0];
                                                    $checked = is_array($oldValue) && in_array($optionLabel, $oldValue) ? 'checked' : '';
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="{{ $optionId }}"
                                                           name="filters[{{ $filter['field_id'] }}][]"
                                                           value="{{ $optionLabel }}" {{ $checked }}>
                                                    <label class="custom-control-label" for="{{ $optionId }}">{{ $optionLabel }}</label>
                                                </div>
                                            @endforeach
                                            @break

                                            @case('radio')
                                            <h6 class="mb-2">{{ $filter['label'] ?? '' }}</h6>
                                            @foreach($filter['options'] as $index => $option)
                                                @php
                                                    $optionId = 'filter_'.$filter['field_id'].'_'.$index;
                                                    $optionLabel = explode('|', $option)[0];
                                                    $checked = $oldValue == $optionLabel ? 'checked' : '';
                                                @endphp
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="{{ $optionId }}"
                                                           name="filters[{{ $filter['field_id'] }}]"
                                                           value="{{ $optionLabel }}" {{ $checked }}>
                                                    <label class="custom-control-label" for="{{ $optionId }}">{{ $optionLabel }}</label>
                                                </div>
                                            @endforeach
                                            @break

                                            @case('selectlist')
                                            <h6 class="mb-2">{{ $filter['label'] ?? '' }}</h6>
                                            <select name="filters[{{ $fieldKey }}]" class="form-select">
                                                <option value="">Select {{ $filter['label'] ?? '' }}</option>
                                                @foreach($filter['options'] ?? [] as $option)
                                                    <option value="{{ $option }}" {{ $oldValue == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                @endforeach
                                            </select>
                                            @break
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </form>
    </div>
</div>

                <!-- end col-lg-4 -->
                <div class="col-lg-9">
                    <div class="tabs-wrapper" style="margin-bottom: 30px;">
    <button class="scroll-btn prev" onclick="scrollTabs(-200)">&#10094;</button>

    <div class="tabs-container" id="tabsContainer">
        <button class="tab-btn active" data-category="all">All</button>
        @foreach($categories as $category)
            <button class="tab-btn" data-category="{{ $category->slug }}">{{ $category->name }}</button>
        @endforeach
    </div>

    <button class="scroll-btn next" onclick="scrollTabs(200)">&#10095;</button>
</div>

                    @include('front.partials.filtered-listings', ['allSubmissions' => $allSubmissions, 'categories' => $categories, 'submissionsByCategory' => $submissionsByCategory, 'soldSubmissionIds'=> $soldSubmissionIds])
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
  let selectedCategory = localStorage.getItem('selectedCategory') || 'all';

  // Add hidden input if not exists
  if (form && !form.querySelector('input[name="category"]')) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'category';
    input.value = selectedCategory;
    form.appendChild(input);
  }

  // Open correct tab on load
  const tabToOpen = document.querySelector(`.tab-btn[data-category="${selectedCategory}"]`);
  (tabToOpen || document.querySelector('.tab-btn[data-category="all"]'))?.click();

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
    const groups = document.querySelectorAll('.submission-group');
    const filters = document.querySelectorAll('.category-filters');

    groups.forEach(group => {
      if (category === 'all') {
        group.style.display = group.getAttribute('data-group') === 'all' ? '' : 'none';
      } else {
        group.style.display = group.getAttribute('data-group') === category ? '' : 'none';
      }
    });

    filters.forEach(div => {
      if (category === 'all' || div.getAttribute('data-category') === category) {
        div.style.display = '';
      } else {
        div.style.display = 'none';
      }
    });
  }
});

</script>

@endsection