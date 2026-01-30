@extends('layouts.master')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>

  <div class="content-wrapper">

    {{-- HEADER --}}
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                  Home Page Content
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <button form="homeContentForm" class="btn btn-primary btn-round btn-sm">
            Save Changes
          </button>
        </div>
      </div>
    </div>

    {{-- BODY --}}
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">

          <form id="homeContentForm"
                method="POST"
                action="{{ route('admin.home-page-content.update') }}">
            @csrf

            @foreach($defaultSections as $key => $label)
              @php
                $section = $sections[$key] ?? null;
              @endphp

              <div class="card mb-2">
                <div class="card-header bg-light">
                  <h5 class="card-title mb-0">
                    {{ $label }}
                  </h5>
                </div>

                <div class="card-body row mt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Title</label>
                      <input
                        type="text"
                        class="form-control"
                        name="sections[{{ $key }}][title]"
                        value="{{ old("sections.$key.title", $section->title ?? '') }}"
                        placeholder="Enter section title"
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea
                        class="form-control"
                        name="sections[{{ $key }}][description]"
                        rows="3"
                        placeholder="Enter section description"
                      >{{ old("sections.$key.description", $section->description ?? '') }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

            <div class="text-right mt-2">
              <button type="submit" class="btn btn-primary">
                💾 Save Home Page Content
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection
