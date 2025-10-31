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

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-4" id="faqTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="buyers-tab" data-bs-toggle="tab" data-bs-target="#buyers"
                                type="button" role="tab" aria-controls="buyers" aria-selected="true">
                                Buyers
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sellers-tab" data-bs-toggle="tab" data-bs-target="#sellers"
                                type="button" role="tab" aria-controls="sellers" aria-selected="false">
                                Sellers
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="faqTabsContent">

                        <!-- Buyers FAQs -->
                        <div class="tab-pane fade show active" id="buyers" role="tabpanel" aria-labelledby="buyers-tab">
                            <div class="accordion my-accordion" id="accordionBuyers">
                                @foreach($faqs->where('type', 'Buyers FAQ') as $index => $faq)
                                    <div class="card">
                                        <div class="card-header" id="headingBuyer{{ $index }}">
                                            <button class="btn btn-link {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseBuyer{{ $index }}"
                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-controls="collapseBuyer{{ $index }}">
                                                <span>{{ $faq->question }}</span>
                                                <i class="fal fa-plus accordion-icon"></i>
                                            </button>
                                        </div>
                                        <div id="collapseBuyer{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}"
                                            aria-labelledby="headingBuyer{{ $index }}" data-bs-parent="#accordionBuyers">
                                            <div class="card-body">
                                                <p>{{ $faq->answer }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Sellers FAQs -->
                        <div class="tab-pane fade" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
                            <div class="accordion my-accordion" id="accordionSellers">
                                @foreach($faqs->where('type', 'Seller FAQ') as $index => $faq)
                                    <div class="card">
                                        <div class="card-header" id="headingSeller{{ $index }}">
                                            <button class="btn btn-link {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSeller{{ $index }}"
                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-controls="collapseSeller{{ $index }}">
                                                <span>{{ $faq->question }}</span>
                                                <i class="fal fa-plus accordion-icon"></i>
                                            </button>
                                        </div>
                                        <div id="collapseSeller{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}"
                                            aria-labelledby="headingSeller{{ $index }}" data-bs-parent="#accordionSellers">
                                            <div class="card-body">
                                                <p>{{ $faq->answer }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Categories</h4>
                            <ul class="tag-list">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('faq.category', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </section>
@endsection