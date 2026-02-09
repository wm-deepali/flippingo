@extends('layouts.master')

@section('title','Footer Management')

@section('content')
<div class="app-content content">
  <div class="content-wrapper">

    {{-- Breadcrumb --}}
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Footer Settings</li>
        </ol>
      </div>
    </div>

    <div class="content-body">
      <form method="POST"
            action="{{ route('admin.footer-settings.store') }}"
            enctype="multipart/form-data">
        @csrf

        @php
          $quick = collect(json_decode(setting('footer_menu_quick','[]'), true))->keyBy('key');
          $know  = collect(json_decode(setting('footer_menu_know','[]'), true))->keyBy('key');
          $help  = collect(json_decode(setting('footer_menu_help','[]'), true))->keyBy('key');
        @endphp

        {{-- ================= CONTACT + COPYRIGHT ================= --}}
        <div class="row">

          {{-- CONTACT INFO --}}
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">
                  Contact Info <small class="text-muted">(Shown in footer)</small>
                </h4>
              </div>
              <div class="card-body">

                <div class="form-group">
                  <label>Footer Logo</label>
                  <input type="file" class="form-control-file" name="footer_logo">
                  @if(setting('footer_logo'))
                    <img src="{{ asset('storage/'.setting('footer_logo')) }}"
                         class="mt-2"
                         style="max-height:90px;">
                  @endif
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name="footer_address"
                         value="{{ setting('footer_address') }}">
                </div>

                <div class="form-group">
                  <label>Helpline</label>
                  <input type="text" class="form-control" name="footer_helpline"
                         value="{{ setting('footer_helpline') }}">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="footer_email"
                         value="{{ setting('footer_email') }}">
                </div>

                <div class="form-group">
                  <label>WhatsApp</label>
                  <input type="text" class="form-control" name="footer_whatsapp"
                         value="{{ setting('footer_whatsapp') }}">
                </div>

              </div>
            </div>
          </div>

           <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">
                  Copyright Text <small class="text-muted">(Shown at the very bottom of the footer)</small>
                </h4>
              </div>
              <div class="card-body">


                <div class="form-group">
                  <label>Copyright</label>
                   <input type="text"
                   class="form-control"
                   name="footer_copyright"
                   value="{{ setting('footer_copyright','© '.date('Y').' Flippingo. All rights reserved.') }}">
                </div>

              </div>
            </div>
          </div>

        </div>

        {{-- ================= FOOTER MENUS ================= --}}
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
                      <th width="80">Order</th>
                    </tr>
                  </thead>
                  <tbody>

                    {{-- ROUTE PAGES --}}
                    @foreach($pages as $page)
                      @php $saved = ${$section}[$page['key']] ?? []; @endphp
                      <tr>
                        <td>
                          <input type="checkbox"
                                 name="{{ $section }}[{{ $page['key'] }}][active]"
                                 {{ !empty($saved['active']) ? 'checked' : '' }}>
                        </td>
                        <td>
                          {{ $page['label'] }}
                          <input type="hidden" name="{{ $section }}[{{ $page['key'] }}][key]" value="{{ $page['key'] }}">
                          <input type="hidden" name="{{ $section }}[{{ $page['key'] }}][label]" value="{{ $page['label'] }}">
                        </td>
                        <td>
                          <input type="number"
                                 class="form-control"
                                 name="{{ $section }}[{{ $page['key'] }}][order]"
                                 value="{{ $saved['order'] ?? 0 }}">
                        </td>
                      </tr>
                    @endforeach

                    {{-- CMS PAGES --}}
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
                          {{ $page['label'] }}
                          <span class="badge badge-light">CMS</span>

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

        

        {{-- SAVE --}}
        <div class="text-right mb-2">
          <button class="btn btn-success">
            Save Footer Settings
          </button>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection
