@extends('layouts.master')

@section('title', 'Header Management')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>

  <div class="content-wrapper">

    {{-- Breadcrumb --}}
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
            Header Settings
          </li>
        </ol>
      </div>
    </div>

    {{-- Content --}}
    <div class="content-body">
      <form method="POST"
            action="{{ route('admin.header-settings.store') }}"
            enctype="multipart/form-data">
        @csrf

        <div class="row">

          {{-- HEADER LOGO --}}
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Header Logo</h4>
              </div>
              <div class="card-body">
                <input type="file"
                       name="header_logo"
                       class="form-control">

                @if(setting('header_logo'))
                  <div class="mt-2">
                    <img src="{{ asset('storage/'.setting('header_logo')) }}"
                         height="50">
                  </div>
                @endif
              </div>
            </div>
          </div>

          {{-- HEADER MENU --}}
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Select Header Pages</h4>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Show</th>
                      <th>Page</th>
                      <th>Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $saved = collect(json_decode(setting('header_menu','[]'), true))
                                ->keyBy('key');
                    @endphp

                    @foreach($pages as $page)
                      @php $conf = $saved[$page['key']] ?? []; @endphp
                      <tr>
                        <td>
                          <input type="checkbox"
                                 name="menu[{{ $page['key'] }}][active]"
                                 value="1"
                                 {{ !empty($conf['active']) ? 'checked' : '' }}>
                        </td>
                      <td>
  {{ $page['label'] }}

  <input type="hidden"
         name="menu[{{ $page['key'] }}][key]"
         value="{{ $page['key'] }}">

  <input type="hidden"
         name="menu[{{ $page['key'] }}][label]"
         value="{{ $page['label'] }}">
</td>

                        <td width="120">
                          <input type="number"
                                 name="menu[{{ $page['key'] }}][order]"
                                 class="form-control"
                                 value="{{ $conf['order'] ?? 0 }}">
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="card-footer text-right">
                <button class="btn btn-success">
                  Save Header
                </button>
              </div>

            </div>
          </div>

        </div>
      </form>
    </div>

  </div>
</div>
@endsection
