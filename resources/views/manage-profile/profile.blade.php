@extends('layouts.master')
@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">My Profile</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('profile.setting') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Edit Profile</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">My Profile</h4>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="profile-pic">
                <img src="{{ asset('images/profiles/'.$user->profile_img) }}" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <ul class="profile-content">
                <li><b>Name:</b> <span>{{ $user->name }}</span></li>
                <li><b>Mobile Number:</b> <span>{{ $user->phone }}</span></li>
                {{-- <li><b>Phone Number:</b> <span>0522 999 9999</span></li> --}}
                <li><b>Email Id:</b> <span>{{ $user->email }}</span></li>
                <li><b>DOB:</b> <span>{{ $user->birth_date }}</span></li>
                <li><b>Address:</b> <span>{{ $user->user_metas->address }}</span></li>
                <li><b>About Me:</b> <span>{{ $user->user_metas->bio }}</span></li>
                <li><b>Website:</b> <span><a href="{{ $user->user_metas->website }}" target="_blank">{{ $user->user_metas->website }}</a></span></li>
                <li><b>Facebook:</b> <span><a href="{{ $user->user_social_links->facebook }}" target="_blank">{{ $user->user_social_links->facebook }}</a></span></li>
                <li><b>Twitter:</b> <span><a href="{{ $user->user_social_links->twitter }}" target="_blank">{{ $user->user_social_links->twitter }}</a></span></li>
                <li><b>Youtube:</b> <span><a href="{{ $user->user_social_links->youtube }}" target="_blank">{{ $user->user_social_links->youtube }}</a></span></li>
                <li><b>Linkedin:</b> <span><a href="{{ $user->user_social_links->linkedin }}" target="_blank">{{ $user->user_social_links->linkedin }}</a></span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

