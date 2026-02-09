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
                <input type="file" name="header_logo" class="form-control">

                @if(setting('header_logo'))
                  <div class="mt-2">
                    <img src="{{ asset('storage/'.setting('header_logo')) }}" height="50">
                  </div>
                @endif
              </div>
            </div>
          </div>

          {{-- FAVICON --}}
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Favicon</h4>
              </div>
              <div class="card-body">
                <input type="file" name="favicon" class="form-control">

                @if(setting('favicon'))
                  <div class="mt-2">
                    <img src="{{ asset('storage/'.setting('favicon')) }}" height="32">
                  </div>
                @endif
              </div>
            </div>
          </div>

          {{-- DEFAULT ALT TAG --}}
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Default Image ALT</h4>
              </div>
              <div class="card-body">
                <input type="text"
                       name="default_alt"
                       class="form-control"
                       value="{{ setting('default_alt') }}"
                       placeholder="Default image alt text">
              </div>
            </div>
          </div>

          {{-- HEADER MENU --}}
          <div class="col-md-12">
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
                          <input type="hidden" name="menu[{{ $page['key'] }}][key]" value="{{ $page['key'] }}">
                          <input type="hidden" name="menu[{{ $page['key'] }}][label]" value="{{ $page['label'] }}">
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
            </div>
          </div>

          {{-- SEO META --}}
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">SEO Meta</h4>
              </div>
              <div class="card-body">
                <div class="row">

                  <div class="col-md-6 mb-2">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                           value="{{ setting('meta_title') }}">
                  </div>

                  <div class="col-md-6 mb-2">
                    <label>Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control"
                           value="{{ setting('meta_keywords') }}">
                  </div>

                  <div class="col-md-12">
                    <label>Meta Description</label>
                    <textarea name="meta_description" rows="3"
                              class="form-control">{{ setting('meta_description') }}</textarea>
                  </div>

                </div>
              </div>
            </div>
          </div>

          {{-- OPEN GRAPH --}}
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Open Graph (OG)</h4>
              </div>
              <div class="card-body">
                <div class="row">

                  <div class="col-md-6 mb-2">
                    <label>OG Title</label>
                    <input type="text" name="og_title" class="form-control"
                           value="{{ setting('og_title') }}">
                  </div>

                  <div class="col-md-6 mb-2">
                    <label>OG Description</label>
                    <input type="text" name="og_description" class="form-control"
                           value="{{ setting('og_description') }}">
                  </div>

                  <div class="col-md-6">
                    <label>OG Image</label>
                    <input type="file" name="og_image" class="form-control">

                    @if(setting('og_image'))
                      <img src="{{ asset('storage/'.setting('og_image')) }}"
                           class="mt-2" height="50">
                    @endif
                  </div>

                </div>
              </div>
            </div>
          </div>

          {{-- SCRIPTS --}}
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Custom Scripts</h4>
              </div>
              <div class="card-body">

                <div class="mb-2">
                  <label>Header Scripts (inside &lt;head&gt;)</label>
                  <textarea name="header_scripts" rows="4"
                            class="form-control">{{ setting('header_scripts') }}</textarea>
                </div>

              </div>
            </div>
          </div>

          {{-- SAVE --}}
          <div class="col-md-12 text-right">
            <button class="btn btn-success mb-2">
              Save Header Settings
            </button>
          </div>

        </div>
      </form>
    </div>

  </div>
</div>
@endsection
