@extends('layouts.master')

@section('title','Footer Menu Management')

@section('content')
<div class="app-content content">
  <div class="content-wrapper">

    {{-- Breadcrumb --}}
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Footer Menus</li>
        </ol>
      </div>
    </div>

    <div class="content-body">
      <form method="POST" action="{{ route('admin.footer-settings.store') }}">
        @csrf

        @php
          $quick = collect(json_decode(setting('footer_menu_quick','[]'), true))->keyBy('key');
          $know  = collect(json_decode(setting('footer_menu_know','[]'), true))->keyBy('key');
          $help  = collect(json_decode(setting('footer_menu_help','[]'), true))->keyBy('key');
        @endphp

        <div class="row">

          @foreach([
            'quick' => 'Quick Links',
            'know'  => 'Know More',
            'help'  => 'Help & Support'
          ] as $section => $title)

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Show</th>
                      <th>Page</th>
                      <th width="90">Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pages as $page)
                      @php
                        $saved = ${$section}[$page['key']] ?? [];
                      @endphp
                      <tr>
                        <td>
                          <input type="checkbox"
                                 name="{{ $section }}[{{ $page['key'] }}][active]"
                                 {{ !empty($saved['active']) ? 'checked' : '' }}>
                        </td>
                        <td>
                          {{ $page['label'] }}
                          <input type="hidden"
                                 name="{{ $section }}[{{ $page['key'] }}][key]"
                                 value="{{ $page['key'] }}">
                          <input type="hidden"
                                 name="{{ $section }}[{{ $page['key'] }}][label]"
                                 value="{{ $page['label'] }}">
                        </td>
                        <td>
                          <input type="number"
                                 class="form-control"
                                 name="{{ $section }}[{{ $page['key'] }}][order]"
                                 value="{{ $saved['order'] ?? 0 }}">
                        </td>
                      </tr>
                    @endforeach
                    {{-- CMS Pages --}}
@foreach($cmsPages as $page)
  @php
    $uniqueKey = $page['key'].'_'.$page['param'];
    $saved = ${$section}[$uniqueKey] ?? [];
  @endphp
  <tr>
    <td>
      <input type="checkbox"
             name="{{ $section }}[{{ $uniqueKey }}][active]"
             {{ !empty($saved['active']) ? 'checked' : '' }}>
    </td>

    <td>
      {{ $page['label'] }} <span class="badge badge-light">CMS</span>

      <input type="hidden" name="{{ $section }}[{{ $uniqueKey }}][key]" value="{{ $page['key'] }}">
      <input type="hidden" name="{{ $section }}[{{ $uniqueKey }}][param]" value="{{ $page['param'] }}">
      <input type="hidden" name="{{ $section }}[{{ $uniqueKey }}][label]" value="{{ $page['label'] }}">
    </td>

    <td>
      <input type="number"
             class="form-control"
             name="{{ $section }}[{{ $uniqueKey }}][order]"
             value="{{ $saved['order'] ?? 0 }}">
    </td>
  </tr>
@endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>

          @endforeach

        </div>

        <div class="text-right mt-2">
          <button class="btn btn-success">
            Save Footer Menus
          </button>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection
