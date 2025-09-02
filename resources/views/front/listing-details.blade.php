@extends('layouts.new-master')

@section('title')
  {{ $page->meta_title ?? 'Flippingo' }}
@endsection

@section('content')


  <!-- ================================
                START CARD AREA
              ================================= -->
  <section class="card-area padding-top-60px padding-bottom-90px" style="margin-top: 150px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4">
          <div class="listing-wrapper ">

            <!-- end listing-single-panel -->
            <div class="listing-single-panel mb-5 ">

              <div class="gallery-carousel owl-carousel owl-theme border">
                @foreach($submission->files as $file)
                  @if(in_array(pathinfo($file->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp']))
                    <div class="gallery-item">
                      <img src="{{ asset('storage/' . $file->file_path) }}"
                        alt="{{ $file->original_name ?? 'gallery image' }}" />
                    </div>
                  @endif
                @endforeach
              </div>

              <div class="d-flex justify-content-between">
                <p style="color: blue;">ID: {{ $submission->id }}</p>
                <p style="color: blue;">Published: {{ $submission->created_at->format('F d, Y') }}</p>
                <p style="color: blue;">Views: {{ $submission->views ?? 0 }}</p>
              </div>

            </div>

            @php
              $fields = json_decode($submission->data, true);
            @endphp

            <div class="details-card">
              <h4 class="font-size-26 font-weight-semi-bold mb-3">Details</h4>
              <div class="details-card-button" style="display: flex; flex-wrap: wrap; gap: 10px;">
                @if($fields && is_array($fields))
                  @foreach($fields as $field)
                    @php
                      $label = $field['label'] ?? ucfirst($field['field_id'] ?? '');
                      $value = $field['value'] ?? '';
                      // If value is array (like checkboxes), join for display
                      if (is_array($value)) {
                        $value = implode(', ', $value);
                      }
                    @endphp

                    <button>{{ $label }}: {{ $value }}</button>
                  @endforeach
                @else
                  <p>No details available.</p>
                @endif
              </div>
            </div>


            <!-- end listing-single-panel -->
            <!-- <div class="listing-single-panel mb-5">
                  <h4 class="font-size-26 font-weight-semi-bold mb-3">
                    Features
                  </h4>
                  <div class="row">
                    <div class="col-lg-4">
                      <ul class="list-items">
                        <li>
                          <i class="fal fa-check-circle me-1 text-success"></i>
                          Instant Noodles
                        </li>
                        <li>
                          <i class="fal fa-check-circle me-1 text-success"></i>
                          Wireless Internet
                        </li>
                      </ul>
                    </div>
                    <div class="col-lg-4">
                      <ul class="list-items">
                        <li>
                          <i class="fal fa-check-circle me-1 text-success"></i>
                          Smoking Allowed
                        </li>
                        <li>
                          <i class="fal fa-check-circle me-1 text-success"></i>
                          Street Parking
                        </li>
                      </ul>
                    </div>
                    <div class="col-lg-4">
                      <ul class="list-items">
                        <li>
                          <i class="fal fa-check-circle me-1 text-success"></i>
                          Bike Parking
                        </li>
                        <li>
                          <i class="fal fa-check-circle me-1 text-success"></i>
                          Accepts Credit Cards
                        </li>
                      </ul>
                    </div>
                  </div>
                </div> -->

            <!-- end listing-single-panel -->
            @php
              $videoExtensions = ['mp4', 'webm', 'ogg'];
            @endphp

            @foreach($submission->files as $file)
              @php
                $ext = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
              @endphp
              @if(in_array($ext, $videoExtensions))
                <section class="listing-single-panel mb-5">
                  <h4 class="font-size-20 font-weight-semi-bold mb-3">Video</h4>
                  <div class="video-box text-center position-relative">
                    <div class="overlay z-index-0 rounded"></div>
                    <video controls width="100%" height="400" class="rounded">
                      <source src="{{ asset('storage/' . $file->file_path) }}" type="video/{{ $ext }}">
                      Your browser does not support the video tag.
                    </video>
                  </div>
                </section>
                @break {{-- Show only the first video file found --}}
              @endif
            @endforeach

            <!-- end listing-single-panel -->

            <!-- end listing-single-panel -->
            <div class="listing-single-panel mb-5">
              <h4 class="font-size-20 font-weight-semi-bold mb-4">
                Customer feedback
              </h4>
              <div class="rating-content row mb-4">
                <div class="col-lg-4 align-self-center">
                  <div class="rating-summary text-center border-right border-right-gray">
                    <span class="rating-total">4.5</span>
                    <span class="rating-percent d-block my-2">out of 5.0</span>
                    <div class="star-rating d-inline-block" data-rating="4.5"></div>
                  </div>
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-8">
                  <div class="mb-2 d-flex align-items-center">
                    <span class="progress-bar-text text-uppercase me-2">5 starts</span>
                    <div class="progress flex-grow-1">
                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-2 d-flex align-items-center">
                    <span class="progress-bar-text text-uppercase me-2">4 starts</span>
                    <div class="progress flex-grow-1">
                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-2 d-flex align-items-center">
                    <span class="progress-bar-text text-uppercase me-2">3 starts</span>
                    <div class="progress flex-grow-1">
                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-2 d-flex align-items-center">
                    <span class="progress-bar-text text-uppercase me-2">2 starts</span>
                    <div class="progress flex-grow-1">
                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-2 d-flex align-items-center">
                    <span class="progress-bar-text text-uppercase me-2">1 starts</span>
                    <div class="progress flex-grow-1">
                      <div class="progress-bar rate-progress-bar" role="progressbar" aria-valuenow="4" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <!-- end col-lg-8 -->
              </div>
              <!-- end row -->
              <div class="reviews">
                <h4 class="font-size-20 font-weight-semi-bold mb-4">
                  Reviews <span class="badge badge-light">(5)</span>
                </h4>
                <div class="comments-wrapper">
                  <div class="comment media mb-5">
                    <a href="{{ Route('user-profile') }}" class="user-avatar flex-shrink-0 d-block me-3">
                      <img src="{{ asset('assets') }}/images/small-team1.jpg" alt="author-img" />
                    </a>
                    <div class="comment-body media-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="pe-2">
                          <h4 class="comment-title">
                            <a href="{{ Route('user-profile') }}">Adam Smith</a>
                          </h4>
                          <span class="comment-meta">San Francisco, CA</span>
                        </div>
                        <div class="star-rating" data-rating="4"></div>
                      </div>
                      <p class="comment-desc mt-2">
                        It is a long established fact that a reader will be
                        distracted by the readable content of a page when
                        looking at its layout.
                      </p>
                      <div class="review-photos d-flex flex-wrap align-items-center mt-3">
                        <a href="{{ asset('assets') }}/images/img1.jpg" class="d-inline-block"
                          data-fancybox="review-gallery">
                          <img class="lazy" src="{{ asset('assets') }}/images/img-loading.jpg"
                            data-src="{{ asset('assets') }}/images/img1.jpg" alt="review image" />
                        </a>
                        <a href="{{ asset('assets') }}/images/img2.jpg" class="d-inline-block"
                          data-fancybox="review-gallery">
                          <img class="lazy" src="{{ asset('assets') }}/images/img-loading.jpg"
                            data-src="{{ asset('assets') }}/images/img2.jpg" alt="review image" />
                        </a>
                      </div>
                      <!-- end review-photos -->
                      <div class="comment-actions d-flex align-items-center justify-content-between mt-3">
                        <a class="btn-link" href="#">
                          <i class="fas fa-reply me-1"></i> Reply
                        </a>
                        <div class="feedback-box">
                          <button type="button" class="theme-btn theme-btn-sm">
                            <i class="fal fa-thumbs-up me-1"></i> Helpful
                          </button>
                          <button type="button" class="theme-btn theme-btn-sm">
                            <i class="fal fa-smile me-1"></i> Funny
                          </button>
                        </div>
                      </div>
                      <!-- end comment-actions -->
                    </div>
                    <!-- end comment-body -->
                  </div>
                  <!-- end comment -->
                  <div class="comment media mb-5 comment-reply">
                    <div class="comment-body media-body">
                      <h4 class="comment-title">Kamran Adi</h4>
                      <span class="comment-meta">Business owner</span>
                      <p class="comment-desc mt-2">
                        It is a long established fact that a reader will be
                        distracted by the readable content of a page when
                        looking at its layout.
                      </p>
                    </div>
                    <!-- end comment-body -->
                  </div>
                  <!-- end comment -->
                  <div class="comment media mb-5">
                    <a href="{{ Route('user-profile') }}" class="user-avatar flex-shrink-0 d-block me-3">
                      <img src="{{ asset('assets') }}/images/small-team1.jpg" alt="author-img" />
                    </a>
                    <div class="comment-body media-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="pe-2">
                          <h4 class="comment-title">
                            <a href="{{ Route('user-profile') }}">Adam Smith</a>
                          </h4>
                          <span class="comment-meta">San Francisco, CA</span>
                        </div>
                        <div class="star-rating" data-rating="4"></div>
                      </div>
                      <p class="comment-desc mt-2">
                        It is a long established fact that a reader will be
                        distracted by the readable content of a page when
                        looking at its layout.
                      </p>
                      <div class="review-photos d-flex flex-wrap align-items-center mt-3">
                        <a href="{{ asset('assets') }}/images/img3.jpg" class="d-inline-block"
                          data-fancybox="review-gallery-two">
                          <img class="lazy" src="{{ asset('assets') }}/images/img-loading.jpg"
                            data-src="{{ asset('assets') }}/images/img3.jpg" alt="review image" />
                        </a>
                      </div>
                      <!-- end review-photos -->
                      <div class="comment-actions d-flex align-items-center justify-content-between mt-3">
                        <a class="btn-link" href="#">
                          <i class="fas fa-reply me-1"></i> Reply
                        </a>
                        <div class="feedback-box">
                          <button type="button" class="theme-btn theme-btn-sm">
                            <i class="fal fa-thumbs-up me-1"></i> Helpful
                          </button>
                          <button type="button" class="theme-btn theme-btn-sm">
                            <i class="fal fa-smile me-1"></i> Funny
                          </button>
                        </div>
                      </div>
                      <!-- end comment-actions -->
                    </div>
                    <!-- end comment-body -->
                  </div>
                  <!-- end comment -->
                </div>
                <!-- end comments-wrapper -->
                <hr class="border-top-gray mt-0" />
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center pagination-list">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true" class="fal fa-angle-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true" class="fal fa-angle-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- end reviews -->
            </div>
            <!-- end listing-single-panel -->
            <div class="listing-single-panel">
              <h4 class="font-size-20 font-weight-semi-bold mb-1">
                Add a Review
              </h4>
              <p class="font-size-15">
                Your email address will not be published. Required fields are
                marked *
              </p>
              <hr class="border-top-gray my-4" />
              <div class="add-review-wrap" id="review">
                <form class="leave-rating">
                  <input type="radio" name="rating" id="rating-1" value="1" />
                  <label for="rating-1" class="fas fa-star"></label>
                  <input type="radio" name="rating" id="rating-2" value="2" />
                  <label for="rating-2" class="fas fa-star"></label>
                  <input type="radio" name="rating" id="rating-3" value="3" />
                  <label for="rating-3" class="fas fa-star"></label>
                  <input type="radio" name="rating" id="rating-4" value="4" />
                  <label for="rating-4" class="fas fa-star"></label>
                  <input type="radio" name="rating" id="rating-5" value="5" />
                  <label for="rating-5" class="fas fa-star"></label>
                </form>
                <form method="post" class="row mt-4">
                  <div class="col-lg-6 col-md-6">
                    <label class="label-text">Name</label>
                    <div class="form-group">
                      <span class="fal fa-user form-icon"></span>
                      <input class="form-control form--control" type="text" name="name" placeholder="Your Name" />
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-6 col-md-6">
                    <label class="label-text">Email</label>
                    <div class="form-group">
                      <span class="fal fa-envelope form-icon"></span>
                      <input class="form-control form--control" type="email" name="email" placeholder="Email Address" />
                    </div>
                  </div>
                  <!-- end col-lg-6 -->
                  <div class="col-lg-12">
                    <label class="label-text">Review</label>
                    <div class="form-group">
                      <textarea class="form-control form--control ps-3" rows="5" name="message"
                        placeholder="Tell about your experience or leave a tip for others"></textarea>
                    </div>
                  </div>
                  <!-- end col-lg-12 -->
                  <div class="col-lg-12">
                    <div class="file-upload-wrap file-upload-wrap-layout-2">
                      <input type="file" name="files[]" class="multi file-upload-input with-preview" multiple />
                      <span class="file-upload-text"><i class="fal fa-image me-2"></i>Add Photos</span>
                    </div>
                  </div>
                  <!-- end col-lg-12 -->
                  <div class="col-lg-12">
                    <button class="theme-btn border-0" type="submit">
                      Submit Review
                    </button>
                  </div>
                  <!-- end col-lg-12 -->
                </form>
              </div>
              <!-- end add-review-wrap -->
            </div>
            <!-- end listing-single-panel -->
          </div>
          <!-- end listing-wrapper -->
        </div>
        <!-- end col-lg-8 -->
        <div class="col-lg-4">
          <div class="sidebar">

            <div class="card">
              <div class="card-body">
                <h4 class="card-title border-bottom pb-3" style="font-size: 30px; font-weight: 700; padding-left: 20px;">
                  ₹16,000</h4>

                <!-- end form-group -->

                <!-- end form-group -->

                <div class="card-body">

                  <div class="media mt-4">
                    <img src="{{ asset('assets') }}/images/small-team1.jpg" alt="avatar"
                      class="user-avatar flex-shrink-0 me-3" />
                    <div class="media-body align-self-center">
                      <h4 class="font-size-18 font-weight-semi-bold mb-1">
                        <a href="{{ Route('user-profile') }}" class="btn-link text-black">Admin</a>
                      </h4>
                      <p class="font-size-14">Member since: 8 months</p>
                      <p class="font-size-14">Account Type: Private</p>
                    </div>
                  </div>
                  <!-- <ul class="list-items mt-4">
                        <li>
                          <span
                          class="fal fa-envelope icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"
                          ></span
                          ><a href="mailto:example@gmail.com">example@gmail.com</a>
                        </li>
                        <li>
                          <span
                          class="fal fa-phone icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"
                          ></span>
                          +7(111)123456789
                        </li>
                        <li>
                          <span
                          class="fal fa-external-link icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"
                          ></span
                          ><a href="#">www. Flippingo.com</a>
                        </li>
                        </ul> -->
                </div>
                <!-- end card-body -->

                <!-- end quantity-wrap -->
                <div class="d-flex gap-3">
                  <a href="" class="theme-btn w-50" data-bs-toggle="modal" data-bs-target="#shareModal">Chat</a>
                  <a href="" class="theme-btn w-50">E-mail</a>
                </div>
              </div>
              <!-- end card-body -->
            </div>
            <!-- end card -->

            <!-- end card -->

            <!-- end card -->
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-3">Hosted by</h4>
                <div class="media mt-4">
                  <img src="{{ asset('storage/' . ($submission->customer->avatar ?? 'defaults/avatar.png')) }}"
                    alt="avatar" class="user-avatar flex-shrink-0 me-3"
                    style="width: 80px; height: 80px; border-radius: 50%;" />
                  <div class="media-body align-self-center">
                    <h4 class="font-size-18 font-weight-semi-bold mb-1">
                      <a href="{{ route('user-profile', ['id' => $submission->customer->id ?? '']) }}"
                        class="btn-link text-black">
                        {{ $submission->customer->first_name ?? '-' }} {{ $submission->customer->last_name ?? '-' }}
                      </a>
                    </h4>
                    <p class="font-size-14">
                      {{ $submission->customer->listing_count ?? 0 }}
                      listing{{ ($submission->customer->listing_count ?? 0) !== 1 ? 's' : '' }} hosted
                    </p>
                  </div>
                </div>
                <ul class="list-items mt-4">
                  <li>
                    <span
                      class="fal fa-envelope icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span>
                    <a href="mailto:{{ $submission->customer->email ?? '#' }}">
                      {{ $submission->customer->email ?? 'No Email' }}
                    </a>
                  </li>
                  <li>
                    <span
                      class="fal fa-phone icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span>
                    {{ $submission->customer->mobile ?? 'No Phone' }}
                  </li>
                  <li>
                    <span
                      class="fal fa-external-link icon-element icon-element-sm bg-white shadow-sm text-black me-2 font-size-14"></span>
                    <a href="{{ $submission->customer->website ?? '#' }}" target="_blank">
                      {{ $submission->customer->website ?? 'No Website' }}
                    </a>
                  </li>
                </ul>
              </div>
              <!-- end card-body -->
            </div>

            <!-- end card -->
          </div>
          <!-- end sidebar -->
        </div>
        <!-- end col-lg-4 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end card-area -->
  <!-- ================================
                END CARD AREA
              ================================= -->

  <!-- ================================
                START CARD AREA
              ================================= -->
  <section class="card-area bg-gray section-padding">
    <div class="container">
      <h4 class="font-size-25 font-weight-semi-bold">More from this user</h4>
      <div class="card-carousel owl-carousel owl-theme mt-4 mx-lg-n2">
        <div class="card mb-0 hover-y">
          <a href="{{ Route('listing-details') }}" class="card-image">
            <img src="{{ asset('assets') }}/images/s1.webp" class="card-img-top" alt="card image" />
            <span class="badge text-bg-success badge-pill">Verified</span>
          </a>
          <div class="card-body position-relative">
            <a href="{{ Route('user-profile') }}" class="author-img">
              <img src="{{ asset('assets') }}/images/small-team1.jpg" alt="author-img" />
            </a>
            <a href="#" class="card-cat mb-2">

              Website</a>
            <div class="d-flex align-items-center mb-1">
              <h4 class="card-title mb-0">
                <a href="{{ Route('listing-details') }}">Fresh AdSense Approved Website With 6$ Balance</a>
              </h4>
              <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                title="Claimed"></i>
            </div>
            <p class="card-text">₹16,000</p>
            <!-- <ul class="info-list mt-3">
                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                      <li>
                        <span class="fal fa-link icon"></span>
                        <a href="#">www.mysitelink.com</a>
                      </li>
                      <li>
                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                      </li>
                      </ul> -->
          </div>
          <!-- end card-body -->
          <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
            <div class="star-rating" data-rating="4.5">
              <div class="rating-counter">4.5</div>
            </div>
            <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
              data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
              <i class="fal fa-bookmark"></i>
            </a>
          </div>
          <!-- end card-footer -->
        </div>
        <div class="card mb-0 hover-y">
          <a href="{{ Route('listing-details') }}" class="card-image">
            <img src="{{ asset('assets') }}/images/s1.webp" class="card-img-top" alt="card image" />
            <span class="badge text-bg-success badge-pill">Verified</span>
          </a>
          <div class="card-body position-relative">
            <a href="{{ Route('user-profile') }}" class="author-img">
              <img src="{{ asset('assets') }}/images/small-team1.jpg" alt="author-img" />
            </a>
            <a href="#" class="card-cat mb-2">

              Website</a>
            <div class="d-flex align-items-center mb-1">
              <h4 class="card-title mb-0">
                <a href="{{ Route('listing-details') }}">Fresh AdSense Approved Website With 6$ Balance</a>
              </h4>
              <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                title="Claimed"></i>
            </div>
            <p class="card-text">₹16,000</p>
            <!-- <ul class="info-list mt-3">
                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                      <li>
                        <span class="fal fa-link icon"></span>
                        <a href="#">www.mysitelink.com</a>
                      </li>
                      <li>
                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                      </li>
                      </ul> -->
          </div>
          <!-- end card-body -->
          <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
            <div class="star-rating" data-rating="4.5">
              <div class="rating-counter">4.5</div>
            </div>
            <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
              data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
              <i class="fal fa-bookmark"></i>
            </a>
          </div>
          <!-- end card-footer -->
        </div>
        <div class="card mb-0 hover-y">
          <a href="{{ Route('listing-details') }}" class="card-image">
            <img src="{{ asset('assets') }}/images/s1.webp" class="card-img-top" alt="card image" />
            <span class="badge text-bg-success badge-pill">Verified</span>
          </a>
          <div class="card-body position-relative">
            <a href="{{ Route('user-profile') }}" class="author-img">
              <img src="{{ asset('assets') }}/images/small-team1.jpg" alt="author-img" />
            </a>
            <a href="#" class="card-cat mb-2">

              Website</a>
            <div class="d-flex align-items-center mb-1">
              <h4 class="card-title mb-0">
                <a href="{{ Route('listing-details') }}">Fresh AdSense Approved Website With 6$ Balance</a>
              </h4>
              <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                title="Claimed"></i>
            </div>
            <p class="card-text">₹16,000</p>
            <!-- <ul class="info-list mt-3">
                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                      <li>
                        <span class="fal fa-link icon"></span>
                        <a href="#">www.mysitelink.com</a>
                      </li>
                      <li>
                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                      </li>
                      </ul> -->
          </div>
          <!-- end card-body -->
          <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
            <div class="star-rating" data-rating="4.5">
              <div class="rating-counter">4.5</div>
            </div>
            <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
              data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
              <i class="fal fa-bookmark"></i>
            </a>
          </div>
          <!-- end card-footer -->
        </div>
        <div class="card mb-0 hover-y">
          <a href="{{ Route('listing-details') }}" class="card-image">
            <img src="{{ asset('assets') }}/images/s1.webp" class="card-img-top" alt="card image" />
            <span class="badge text-bg-success badge-pill">Verified</span>
          </a>
          <div class="card-body position-relative">
            <a href="{{ Route('user-profile') }}" class="author-img">
              <img src="{{ asset('assets') }}/images/small-team1.jpg" alt="author-img" />
            </a>
            <a href="#" class="card-cat mb-2">

              Website</a>
            <div class="d-flex align-items-center mb-1">
              <h4 class="card-title mb-0">
                <a href="{{ Route('listing-details') }}">Fresh AdSense Approved Website With 6$ Balance</a>
              </h4>
              <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                title="Claimed"></i>
            </div>
            <p class="card-text">₹16,000</p>
            <!-- <ul class="info-list mt-3">
                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                      <li>
                        <span class="fal fa-link icon"></span>
                        <a href="#">www.mysitelink.com</a>
                      </li>
                      <li>
                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                      </li>
                      </ul> -->
          </div>
          <!-- end card-body -->
          <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
            <div class="star-rating" data-rating="4.5">
              <div class="rating-counter">4.5</div>
            </div>
            <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
              data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
              <i class="fal fa-bookmark"></i>
            </a>
          </div>
          <!-- end card-footer -->
        </div>
        <div class="card mb-0 hover-y">
          <a href="{{ Route('listing-details') }}" class="card-image">
            <img src="{{ asset('assets') }}/images/s1.webp" class="card-img-top" alt="card image" />
            <span class="badge text-bg-success badge-pill">Verified</span>
          </a>
          <div class="card-body position-relative">
            <a href="{{ Route('user-profile') }}" class="author-img">
              <img src="{{ asset('assets') }}/images/small-team1.jpg" alt="author-img" />
            </a>
            <a href="#" class="card-cat mb-2">

              Website</a>
            <div class="d-flex align-items-center mb-1">
              <h4 class="card-title mb-0">
                <a href="{{ Route('listing-details') }}">Fresh AdSense Approved Website With 6$ Balance</a>
              </h4>
              <i class="fa fa-check-circle ms-1 text-success" data-bs-toggle="tooltip" data-placement="top"
                title="Claimed"></i>
            </div>
            <p class="card-text">₹16,000</p>
            <!-- <ul class="info-list mt-3">
                      <li><span class="fal fa-phone icon"></span> (416) 551-0589</li>
                      <li>
                        <span class="fal fa-link icon"></span>
                        <a href="#">www.mysitelink.com</a>
                      </li>
                      <li>
                        <span class="fal fa-calendar icon"></span> Posted 1 month ago
                      </li>
                      </ul> -->
          </div>
          <!-- end card-body -->
          <div class="card-footer bg-transparent border-top-gray d-flex align-items-center justify-content-between">
            <div class="star-rating" data-rating="4.5">
              <div class="rating-counter">4.5</div>
            </div>
            <a href="#" class="bookmark-btn icon-element icon-element-sm bg-white shadow-sm text-black"
              data-bs-toggle="tooltip" data-placement="top" title="Bookmark">
              <i class="fal fa-bookmark"></i>
            </a>
          </div>
          <!-- end card-footer -->
        </div>
        <!-- end card -->
      </div>
      <!-- end card-carousel -->
    </div>
    <!-- end container -->
  </section>
  <!-- end card-area -->
  <!-- ================================
                END CARD AREA
              ================================= -->

@endsection