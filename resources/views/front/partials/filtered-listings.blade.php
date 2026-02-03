<div id="submissions-container">

                        {{-- All submissions (for All tab) --}}
                        <div class="submission-group wishlist-card" data-group="all">
                            @foreach($allSubmissions as $submission)
                                @php
                                    $catSlug = $submission['category']->slug ?? 'uncategorized';
                                    $catName = $submission['category']->name ?? '';

                                    $fields = json_decode($submission['data'], true);
                                    $productTitle = $fields['product_title']['value'] ?? 'No Title';
                                
                                   $imageFile = $submission['imageFile'] ?? null; 
                                    $summaryFields = $submission['summaryFields'] ?? [];
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
                                  @foreach($summaryFields as $field)
                      <div class="wishlist-left">
                       <p class="m-0" style="color: {{ $field['color'] ?? '#000000' }};">
                          <i class="{{ $field['icon'] ?? '' }}"></i>
                        </p>
                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 16px;">
                            {{ $field['label'] }}
                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 16px;">
                            {{ $field['value'] }}
                          </h5>
                        </div>
                      </div>
                    @endforeach
                                        </div>
                                        <div class="wishlist-price d-flex justify-content-between mt-3">
                                            <h2 style="color: #000;"><i
                                                    class="fa-solid fa-indian-rupee-sign"></i>{{ $submission['currency_symbol'] }}{{ number_format($submission['display_price'], 2) }}</h2>
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
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0">By
                                                {{ ($submission['customer']['first_name'] ?? '') . ' ' . ($submission['customer']['last_name'] ?? '') }}
                                            </pre>
                                            <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                        </div>
                                        <div class="wishlist-item-card">
                                               @foreach($summaryFields as $field)
                      <div class="wishlist-left">
                       <p class="m-0" style="color: {{ $field['color'] ?? '#000000' }};">
                          <i class="{{ $field['icon'] ?? '' }}"></i>
                        </p>
                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 16px;">
                            {{ $field['label'] }}
                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 16px;">
                            {{ $field['value'] }}
                          </h5>
                        </div>
                      </div>
                    @endforeach
                                        </div>
                                        <div class="wishlist-price d-flex justify-content-between mt-3">
                                            <h2 style="color: #000;"><i
                                                    class="fa-solid fa-indian-rupee-sign"></i>{{ $submission['currency_symbol'] }}{{ number_format($submission['display_price'], 2) }}</h2>
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
                                
                                    $imageFile = $submission->imageFile ?? null; 
                                    $summaryFields = $submission->summaryFields ?? [];

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
                                                 @foreach($summaryFields as $field)
                      <div class="wishlist-left">
                        <p class="m-0" style="color: {{ $field['color'] ?? '#000000' }};">
                          <i class="{{ $field['icon'] ?? '' }}"></i>
                        </p>
                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 16px;">
                            {{ $field['label'] }}
                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 16px;">
                            {{ $field['value'] }}
                          </h5>
                        </div>
                      </div>
                    @endforeach
                                                </div>
                                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                                   <h2 style="color:#000;">
                        {{ $submission['currency_symbol'] }}
                       {{ $submission['currency_symbol']  == '$'? number_format($submission['display_price'], 2) : $submission['display_price']}}
                      </h2>
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
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="m-0">By
                                                        {{ ($submission['customer']->first_name ?? '') . ' ' . ($submission['customer']->last_name ?? '') }}
                                                    </p>
                                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                                </div>
                                                <div class="wishlist-item-card">
                                             @foreach($summaryFields as $field)
                      <div class="wishlist-left">
                       <p class="m-0" style="color: {{ $field['color'] ?? '#000000' }};">
                          <i class="{{ $field['icon'] ?? '' }}"></i>
                        </p>
                        <div class="d-flex flex-column">
                          <p class="m-0" style="font-size: 16px;">
                            {{ $field['label'] }}
                          </p>
                          <h5 class="m-0" style="color: #000; font-size: 16px;">
                            {{ $field['value'] }}
                          </h5>
                        </div>
                      </div>
                    @endforeach

                                                </div>
                                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                                  <h2 style="color:#000;">
                        {{ $submission['currency_symbol'] }}
                       {{ $submission['currency_symbol']  == '$'? number_format($submission['display_price'], 2) : $submission['display_price']}}
                      </h2>
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