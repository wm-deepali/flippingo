@extends('layouts.new-master')

@section('title')
    {{ $page->meta_title ?? 'Flippingo' }}
@endsection

@section('content')
    <section class="breadcrumb-area bread-bg">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 class="sec__title text-white mb-3">Frequently Asked Questions</h2>
                <ul class="bread-list">
                    <li><a href="{{ Route('home') }}">home</a></li>
                    <li>pages</li>
                    <li>faq</li>
                </ul>
            </div>
        </div>
        <div class="bread-svg">
            <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
            </svg>
        </div>
    </section>

    <section class="faq-area padding-top-60px padding-bottom-90px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="accordion my-accordion" id="accordionExample">
                        @foreach($faqs as $index => $faq)
                            <div class="card">
                                <div class="card-header" id="heading{{ $index }}">
                                    <button class="btn btn-link {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $index }}">
                                        <span>{{ $faq->question }}</span>
                                        <i class="fal fa-plus accordion-icon"></i>
                                    </button>
                                </div>
                                <div id="collapse{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    <form action="#" method="POST" class="contact-form card">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Still have a question?</h4>
                            <hr class="border-top-gray" />
                            <div class="form-group">
                                <label class="label-text">Your Name</label>
                                <input id="name" class="form-control form--control ps-3" type="text" name="name"
                                    placeholder="Your name" required />
                            </div>
                            <div class="form-group">
                                <label class="label-text">Your Email</label>
                                <input id="email" class="form-control form--control ps-3" type="email" name="email"
                                    placeholder="you@email.com" required />
                            </div>
                            <div class="form-group">
                                <label class="label-text">Message</label>
                                <textarea id="message" class="form-control form--control ps-3" rows="5" name="message"
                                    placeholder="Write message" required></textarea>
                            </div>
                            <button id="send-message-btn" class="theme-btn border-0" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection