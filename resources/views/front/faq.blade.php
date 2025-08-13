@extends('layouts.new-master')

@section('title')
    Flippingo Blogs
@endsection

@push('after-styles')
<style>
  .accordion-button {
      color: #212529 !important;
      background-color: transparent !important;
      border: 0 !important;
  }

  .accordion-button:not(.collapsed) {
      background-color: transparent !important;
      box-shadow: none !important;
  }

  .accordion-button:focus {
      box-shadow: none !important;
  }
</style>
@endpush

@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom d-none d-md-flex">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <div class="breadcrumb-title pe-3">Faq</div>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;">
                                            <i class="bx bx-home-alt"></i> Home</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="javascript:;">Faq</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->

            <!--start page content-->
            <section class="py-4">
                <div class="container">
                    <div class="row">

                        <div class="accordion accordion-flush" id="footerFaqAccordion" style="width:100%">

                            @foreach($faqs as $index => $faq)
                                @php
                                    $isFirst = $index === 0;
                                    $questionNumber = 'Q' . ($index + 1);
                                @endphp
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                        <button
                                            class="accordion-button px-0 py-1 bg-transparent {{ $isFirst ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}"
                                            aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $faq->id }}">
                                            <span class="me-2">{{ $questionNumber }}.</span>
                                            {{ Str::limit($faq->question, 60) }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}"
                                        class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#footerFaqAccordion">
                                        <div class="accordion-body px-0 py-1 text-muted small">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                        </div>

                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end start page content-->

        </div>
    </div>
    <!--end page wrapper -->
@endsection