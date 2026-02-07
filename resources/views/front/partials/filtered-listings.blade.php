<style>
  .gridview-card {
    display: flex;
    width: 100%;
    background: #ffffff33;
    padding: 18px;
    border-radius: 14px;
    border: 1px solid #eaeaea;
    gap: 20px;
    margin-bottom: 20px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease-in-out;
  }

  /* Left image area */
  .gridview-left {
    width: 25%;
  }

  .gridview-left .wishlist-image-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: auto;
    overflow: hidden;
    border-radius: 10px;
  }

  .gridview-left img {
    width: 100%;
    height: 100%;
    border-radius: 12px;
    object-fit: cover;
  }

  /* Right content area */
  .gridview-right {
    width: 75%;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  /* Top: Status + Heart */
  .gridview-top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .gridview-badge {
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 13px;
    color: #fff;
  }

  .gridview-badge.active {
    background: #28a745;
  }

  .gridview-badge.sold {
    background: #dc3545;
  }

  /* Title + Category */
  .gridview-title-row {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: start;
  }

  .gridview-title-row h3 {
    font-size: 22px;
  }

  .gridview-category {
    background: #ffffff;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
  }

  /* Owner + Views */
  .gridview-owner-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #5a5a5a;
  }

  .views {
    color: #007bff;
  }

  /* Summary Fields */
  .gridview-summary {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 18px;
  }

  .gridview-summary-item {
    display: flex;
    gap: 8px;
    align-items: center;
    padding: 10px;
    background: #ffffff;
    border-radius: 7px;
  }

  .gridview-summary-item .label {
    font-size: 11px;
    color: #777;
    margin: 0;
  }

  .gridview-summary-item .value {
    font-size: 14px;
    margin: 0;
    color: #000;
  }

  /* Bottom Row */
  .gridview-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .gridview-bottom h2 {
    font-size: 22px;
    color: #000;
  }
</style>

<div id="submissions-container">

  {{-- All submissions (for All tab) --}}
  <div class="submission-group wishlist-card" data-group="all">
    @if($allSubmissions->count() > 0)
      @foreach($allSubmissions as $submission)
        @php
          $catSlug = $submission['category']->slug ?? 'uncategorized';
          $catName = $submission['category']->name ?? '';

          $fields = json_decode($submission['data'], true);
          $productTitle = $fields['product_title']['value'] ?? 'No Title';

          $imageFile = $submission['allImages'][0] ?? null;
          $summaryFields = $submission['summaryFields'] ?? [];
        @endphp
        <div class="wishlist-product-card" data-category="{{ $catSlug }}">
          @if($imageFile)
            <div class="wishlist-image-wrapper">

              <div class="wishlist-main-slider">
                @foreach($submission['allImages'] as $img)
                  <img src="{{ asset('storage/' . $img['file_path']) }}" class="slide-img" />
                @endforeach
              </div>

              <!-- Navigation Arrows -->
              <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
              <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>

            </div>

          @else
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
          @endif
          <div class="wishlist-budge">
            <div class="d-flex justify-content-between align-items-center">
              @if(in_array($submission['id'], $soldSubmissionIds))
                {{-- SOLD OUT badge --}}
                <div class="budge-soldout">
                  <p><i class="fa-solid fa-ban"></i> Sold Out</p>
                </div>
              @else
                {{-- ACTIVE badge --}}
                <div class="budge-active">
                  <p><i class="fa-solid fa-circle-check"></i> Active</p>
                </div>
              @endif
              <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i></h4>

            </div>

          </div>
          <div class="product-details-hover">
            <div class="wishlist-button">
              <p>{{ $catName }}</p>
              <!--<div class="budge-active1">-->
              <!--  <p><i class="fa-solid fa-circle-check"></i> Verified</p>-->
              <!--</div>-->

            </div>
            <h3 class="mt-2 " style="color: #000;">{{ $productTitle }}</h3>
            <div class="d-flex justify-content-between align-items-center">
              <p class="m-0" style="font-size:12px;">
                By
                {{ ($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '') }}

                @if(!empty($submission['is_premium']) && $submission['is_premium'])
                  <span class="text-warning ms-1" data-toggle="tooltip" data-placement="top"
                    title="{{ setting('premium_seller_note', 'Premium Seller') }}">
                    <i class="fa-solid fa-crown"></i>
                  </span>
                @elseif(!empty($submission['is_verified']) && $submission['is_verified'])
                  <span class="text-success ms-1" title="Verified Seller">
                    <i class="fa-solid fa-circle-check"></i>
                  </span>
                @endif
              </p>

              <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> {{ $submission->total_views ?? 0 }}
              </p>
            </div>
            <div class="wishlist-item-card {{ count($summaryFields) == 2 ? 'two-items' : '' }}">
              @foreach($summaryFields as $field)
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
                {{ $submission['currency_symbol'] }}
                {{ $submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']}}
              </h2>


              <button type="button" class="btn btn-dark"
                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                View Listing
              </button>
            </div>
          </div>
          <!--                <div class="more-info" data-aos="fade-up" data-aos-duration="500">-->
          <!--                    <div class="wishlist-button">-->
          <!--                        <p>{{ $catName }}</p>-->
          <!--                        <div class="budge-active1">-->
          <!--                            <p><i class="fa-solid fa-circle-check"></i> Verified</p>-->
          <!--                        </div>-->

          <!--                    </div>-->
          <!--                    <h3 class="mt-2" style="color: #000;">{{ $productTitle ?? '' }}</h3>-->
          <!--                    <div class="d-flex justify-content-between align-items-center">-->
          <!--                        <p class="m-0">By-->
          <!--                            {{ ($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '') }}-->
          <!--                        </pre>-->
          <!--                        <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>-->
          <!--                    </div>-->
          <!--                    <div class="wishlist-item-card">-->
          <!--                           @foreach($summaryFields as $field)-->
          <!--  <div class="wishlist-left">-->
          <!--   <p class="m-0" style="color: {{ $field['color'] ?? '#000000' }};">-->
          <!--      <i class="{{ $field['icon'] ?? '' }}"></i>-->
          <!--    </p>-->
          <!--    <div class="d-flex flex-column">-->
          <!--      <p class="m-0" style="font-size: 16px;">-->
          <!--        {{ $field['label'] }}-->
          <!--      </p>-->
          <!--      <h5 class="m-0" style="color: #000; font-size: 16px;">-->
          <!--        {{ $field['value'] }}-->
          <!--      </h5>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--@endforeach-->
          <!--                    </div>-->
          <!--                    <div class="wishlist-price d-flex justify-content-between mt-3">-->
          <!--                        <h2 style="color: #000;"><i-->
          <!--                                class="fa-solid fa-indian-rupee-sign"></i>{{ $submission['currency_symbol'] }}{{ number_format($submission['display_price'], 2) }}</h2>-->
          <!--                        <button type="button" class="btn btn-dark"-->
          <!--                            onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">-->
          <!--                            View Detail-->
          <!--                        </button>-->
          <!--                    </div>-->
          <!--                </div>-->
        </div>

      @endforeach
    @endif
  </div>

  {{-- Submission per category --}}
  @foreach($categories as $category)
    <div class="submission-group wishlist-card" data-group="{{ $category->slug }}" style="display:none;">
      @if(isset($submissionsByCategory[$category->id]))
        @foreach($submissionsByCategory[$category->id] as $submission)
          @php
            $fields = json_decode($submission->data, true);
            $productTitle = $fields['product_title']['value'] ?? 'No Title';

            $imageFile = $submission['allImages'][0] ?? null;
            $summaryFields = $submission->summaryFields ?? [];

          @endphp
          <div class="wishlist-product-card" data-category="{{ $category->slug }}">
            @if($imageFile)
              <div class="wishlist-image-wrapper">

                <div class="wishlist-main-slider">
                  @foreach($submission['allImages'] as $img)
                    <img src="{{ asset('storage/' . $img['file_path']) }}" class="slide-img" />
                  @endforeach
                </div>

                <!-- Navigation Arrows -->
                <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>

              </div>

            @else
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
            @endif

            <div class="wishlist-budge">
              <div class="d-flex justify-content-between align-items-center">
                @if(in_array($submission['id'], $soldSubmissionIds))
                  {{-- SOLD OUT badge --}}
                  <div class="budge-soldout">
                    <p><i class="fa-solid fa-ban"></i> Sold Out</p>
                  </div>
                @else
                  {{-- ACTIVE badge --}}
                  <div class="budge-active">
                    <p><i class="fa-solid fa-circle-check"></i> Active</p>
                  </div>
                @endif
                <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i></h4>

              </div>

            </div>
            <div class="product-details-hover">
              <div class="wishlist-button">
                <p>{{ $catName }}</p>
                <!--<div class="budge-active1">-->
                <!--  <p><i class="fa-solid fa-circle-check"></i> Verified</p>-->
                <!--</div>-->

              </div>
              <h3 class="mt-2 " style="color: #000;">{{ $productTitle }}</h3>
              <div class="d-flex justify-content-between align-items-center">
                <p class="m-0" style="font-size:12px;">
                  By
                  {{ ($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '') }}

                  @if(!empty($submission['is_premium']) && $submission['is_premium'])
                    <span class="text-warning ms-1" data-toggle="tooltip" data-placement="top"
                      title="{{ setting('premium_seller_note', 'Premium Seller') }}">
                      <i class="fa-solid fa-crown"></i>
                    </span>
                  @elseif(!empty($submission['is_verified']) && $submission['is_verified'])
                    <span class="text-success ms-1" title="Verified Seller">
                      <i class="fa-solid fa-circle-check"></i>
                    </span>
                  @endif
                </p>

                <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> {{ $submission->total_views ?? 0 }}
                </p>
              </div>
              <div class="wishlist-item-card {{ count($summaryFields) == 2 ? 'two-items' : '' }}">
                @foreach($summaryFields as $field)
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
                  {{ $submission['currency_symbol'] }}
                  {{ $submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']}}
                </h2>


                <button type="button" class="btn btn-dark"
                  onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                  View Listing
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


  <div class="submission-group-grid" data-group="all" style="display:none;">
    @if($allSubmissions->count() > 0)
      @foreach($allSubmissions as $submission)
        @php
          $catSlug = $submission['category']->slug ?? 'uncategorized';
          $catName = $submission['category']->name ?? '';

          $fields = json_decode($submission['data'], true);
          $productTitle = $fields['product_title']['value'] ?? 'No Title';

          $imageFile = $submission['allImages'][0] ?? null;
          $summaryFields = $submission['summaryFields'] ?? [];
        @endphp

        <div class="gridview-card">

          {{-- LEFT IMAGE (30%) --}}
          <div class="gridview-left">
            @if($imageFile)
              <div class="wishlist-image-wrapper">
                <div class="wishlist-main-slider">
                  @foreach($submission['allImages'] as $img)
                    <img src="{{ asset('storage/' . $img['file_path']) }}" class="slide-img" />
                  @endforeach
                </div>

                <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>
              </div>
            @else
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s" />
            @endif
          </div>

          {{-- RIGHT CONTENT (70%) --}}
          <div class="gridview-right">

            {{-- ACTIVE / SOLD + HEART --}}
            <div class="gridview-top-row">
              <span class="gridview-category">{{ $catName }}</span>
              @if(in_array($submission['id'], $soldSubmissionIds))
                <span class="gridview-badge sold">Sold Out</span>
              @else
                <span class="gridview-badge active">Active</span>
              @endif

              <!--<i class="fa-regular fa-heart"></i>-->
            </div>

            {{-- TITLE + CATEGORY --}}
            <div class="gridview-title-row">
              <h3>{{ $productTitle }}</h3>

            </div>

            {{-- OWNER + VIEWS --}}
            <div class="gridview-owner-row">
              <p>
                By {{ ($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '') }}

                @if(!empty($submission['is_premium']) && $submission['is_premium'])
                  <i class="fa-solid fa-crown text-warning"></i>
                @elseif(!empty($submission['is_verified']) && $submission['is_verified'])
                  <i class="fa-solid fa-circle-check text-success"></i>
                @endif
              </p>

              <p class="views"><i class="fa-solid fa-eye"></i> {{ $submission->total_views ?? 0 }}</p>
            </div>

            {{-- SUMMARY FIELDS --}}
            <div class="gridview-summary">
              @foreach($summaryFields as $field)
                <div class="gridview-summary-item">
                  <i class="{{ $field['icon'] ?? '' }}" style="color: {{ $field['color'] ?? 'green' }}"></i>
                  <div>
                    <p class="label">{{ $field['label'] }}</p>
                    <p class="value">{{ $field['value'] }}</p>
                  </div>
                </div>
              @endforeach
            </div>

            {{-- PRICE + CTA --}}
            <div class="gridview-bottom">
              <h2>
                {{ $submission['currency_symbol'] }}
                {{ $submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']}}
              </h2>

              <button type="button" class="btn btn-dark"
                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                View Listing
              </button>
            </div>

          </div>

        </div>

      @endforeach
    @endif
  </div>

  @foreach($categories as $category)
    <div class="submission-group-grid" data-group="{{ $category->slug }}" style="display:none;">
      @if(isset($submissionsByCategory[$category->id]))
        @foreach($submissionsByCategory[$category->id] as $submission)
          @php
            $fields = json_decode($submission->data, true);
            $productTitle = $fields['product_title']['value'] ?? 'No Title';

            $imageFile = $submission['allImages'][0] ?? null;
            $summaryFields = $submission->summaryFields ?? [];

          @endphp

          <div class="gridview-card">

            {{-- LEFT IMAGE (30%) --}}
            <div class="gridview-left">
              @if($imageFile)
                <div class="wishlist-image-wrapper">
                  <div class="wishlist-main-slider">
                    @foreach($submission['allImages'] as $img)
                      <img src="{{ asset('storage/' . $img['file_path']) }}" class="slide-img" />
                    @endforeach
                  </div>

                  <div class="wishlist-nav wishlist-prev"><i class="fa-solid fa-chevron-left"></i></div>
                  <div class="wishlist-nav wishlist-next"><i class="fa-solid fa-chevron-right"></i></div>
                </div>
              @else
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s" />
              @endif
            </div>

            {{-- RIGHT CONTENT (70%) --}}
            <div class="gridview-right">

              {{-- ACTIVE / SOLD + HEART --}}
              <div class="gridview-top-row">
                <span class="gridview-category">{{ $catName }}</span>
                @if(in_array($submission['id'], $soldSubmissionIds))
                  <span class="gridview-badge sold">Sold Out</span>
                @else
                  <span class="gridview-badge active">Active</span>
                @endif

                <!--<i class="fa-regular fa-heart"></i>-->
              </div>

              {{-- TITLE + CATEGORY --}}
              <div class="gridview-title-row">
                <h3>{{ $productTitle }}</h3>

              </div>

              {{-- OWNER + VIEWS --}}
              <div class="gridview-owner-row">
                <p>
                  By {{ ($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '') }}

                  @if(!empty($submission['is_premium']) && $submission['is_premium'])
                    <i class="fa-solid fa-crown text-warning"></i>
                  @elseif(!empty($submission['is_verified']) && $submission['is_verified'])
                    <i class="fa-solid fa-circle-check text-success"></i>
                  @endif
                </p>

                <p class="views"><i class="fa-solid fa-eye"></i> {{ $submission->total_views ?? 0 }}</p>
              </div>

              {{-- SUMMARY FIELDS --}}
              <div class="gridview-summary">
                @foreach($summaryFields as $field)
                  <div class="gridview-summary-item">
                    <i class="{{ $field['icon'] ?? '' }}" style="color: {{ $field['color'] ?? 'green' }}"></i>
                    <div>
                      <p class="label">{{ $field['label'] }}</p>
                      <p class="value">{{ $field['value'] }}</p>
                    </div>
                  </div>
                @endforeach
              </div>

              {{-- PRICE + CTA --}}
              <div class="gridview-bottom">
                <h2>
                  {{ $submission['currency_symbol'] }}
                  {{ $submission['currency_symbol'] == '$' ? number_format($submission['display_price'], 2) : $submission['display_price']}}
                </h2>

                <button type="button" class="btn btn-dark"
                  onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                  View Listing
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