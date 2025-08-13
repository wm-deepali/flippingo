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
                <li class="breadcrumb-item active">Account Setting</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="{{ route('profile.show') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">View Profile</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section id="page-account-settings">
        <div class="row">
          <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column nav-left">
              <li class="nav-item">
                <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                  <i data-feather="user" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">General</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                  <i data-feather="info" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Information</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                  <i data-feather="lock" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Change Password</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                  <i data-feather="link" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Social</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                  <i data-feather="bell" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Notifications</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-pill-activity" data-toggle="pill" href="#account-vertical-activity" aria-expanded="false">
                  <i data-feather="check-circle" class="font-medium-3 mr-1"></i>
                  <span class="font-weight-bold">Activity</span>
                </a>
              </li>
            </ul>
          </div>
          
          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                    @include('errors.flash_message')
                    <form class="validate-form" method="post" action="{{ route('user-basicinfo.submit') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-12 col-md-2">
                          <div class="form-group">
                            <label>Change Profile Picture</label>
                            <div class="custom-img-uploader">
                              <div class="input-group">
                                <span class="input-group-btn">
                                  <span class="btn-file">
                                    <input type="file" id="imgSec" name="profile">
                                    <img id='upload-img' class="img-upload-block" src="{{ asset('admin_assets') }}/images/plus-upload.jpg"/>
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-md-2">
                          <div class="form-group">
                            <label>Change Admin Logo</label>
                            <div class="custom-img-uploader">
                              <div class="input-group">
                                <span class="input-group-btn">
                                  <span class="btn-file">
                                    <input type="file" id="imgLogo" name="logo">
                                    <img id='upload-logo' class="img-upload-block" src="{{ asset('admin_assets') }}/images/plus-upload.jpg"/>
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label for="account-username">Username</label>
                            <input type="text" class="form-control" id="account-username" name="username" placeholder="Username" value="robertdowney" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-name">Name</label>
                            <input type="text" class="form-control" id="account-name" name="name" placeholder="Name" value="Robert Downey" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-e-mail">Email Id</label>
                            <input type="email" class="form-control" id="account-e-mail" name="email" placeholder="Email" value="robertdowney@gmail.com" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-company">Mobile Number</label>
                            <input type="text" class="form-control" id="account-company" name="phone" placeholder="Mobile Number" value="9898989898" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-company">Company</label>
                            <input type="text" class="form-control" id="account-company" name="company" placeholder="Company name" value="Dropshipper" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <div class="form-group">
                              <label>Select Gender</label>
                              <select class="form-control" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-birth-date">Birth date</label>
                            <input type="text" name="dob" class="form-control flatpickr" placeholder="Birth date" id="account-birth-date" name="dob" />
                          </div>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  
                  <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                    <form class="validate-form" id="userbio-form">
                      <div class="alert alert-success d-none" id="msg_bio_div">
                          <span id="res_bio_message"></span>
                     </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="accountTextarea">Bio</label>
                            <textarea class="form-control" name="bio" id="bio" rows="4" placeholder="Your Bio data here..."></textarea>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-website">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <div class="form-group">
                              <label>Select Country</label>
                              <select class="form-control" name="country" id="country">
                                <option value="">Select Country</option>
                                @forelse($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <div class="form-group">
                              <label>Select State</label>
                              <select class="form-control" name="state" id="state">
                                {{-- <option value="">Select State</option> --}}
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <div class="form-group">
                              <label>Select City</label>
                              <select class="form-control" name="city" id="city">
                                {{-- <option value="">Select City</option> --}}
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-website">Website</label>
                            <input type="text" class="form-control" name="website" id="website" placeholder="Website address" />
                          </div>
                        </div>
                        {{-- <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-phone">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Phone number" value="0522 999 9999" name="phone" />
                          </div>
                        </div> --}}
                        <div class="col-12">
                          <button type="submit" id="user_bio_form" class="btn btn-primary mt-1 mr-1">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  
                  <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                    <form class="validate-form" id="change-password-form">
                      <div class="alert alert-success d-none" id="msg_div">
                          <span id="res_message"></span>
                     </div>
                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-old-password">Old Password</label>
                            <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Old Password" />
                            <span id="old_password_error"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-new-password">New Password</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="account-retype-new-password">Retype New Password</label>
                            <input type="password" id="confirm_new_password" class="form-control" name="confirm_new_password" placeholder="New Password" />
                          </div>
                        </div>
                        <div class="col-12">
                          <button type="submit" id="update_pwd_btn" class="btn btn-primary mr-1 mt-1">Update Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                 
                  <div class="tab-pane fade" id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                    <form class="validate-form" id="social-form" action="javascript:;">
                      <div class="alert alert-success d-none" id="msg_social_div">
                          <span id="res_social_links"></span>
                     </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="d-flex align-items-center mb-2">
                            <i data-feather="link" class="font-medium-3"></i>
                            <h4 class="mb-0 ml-75">Social Links</h4>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Add link" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Add link" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>LinkedIn</label>
                            <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="Add link" />
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" name="youtube" id="youtube" class="form-control" placeholder="Add link" />
                          </div>
                        </div>
                        <div class="col-12">
                          <button type="submit" id="send_social_form" class="btn btn-primary mr-1 mt-1">Save changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  
                  <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                    <span id="basic_setting"></span>
                    <div class="row">
                      <h6 class="section-label mx-1 mb-2">Activity</h6>
                      @forelse($basic_settings as $setting)
                      <div class="col-12 mb-2">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" data-id="{{ $setting->id }}" {{ ($setting->status == '1') ? 'checked' : '' }}  class=" basic_setting" id="accountSwitch1" />
                          <label class="custom-control-label" for="accountSwitch1">
                            {{ $setting->setting_name }}, [{{ $setting->setting_code }}]
                          </label>
                        </div>
                      </div>
                      @empty
                      @endforelse
                      {{-- <h6 class="section-label mx-1 mt-2">Application</h6> --}}
                    </div>
                  </div>
                  
                  <div class="tab-pane fade" id="account-vertical-activity" role="tabpanel" aria-labelledby="account-pill-activity" aria-expanded="false">
                    <div class="row">
                      <h6 class="section-label mx-1 mb-2">Recent Login Activity</h6>
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date & Time</th>
                              <th>IP Address</th>
                              <th>Location</th>
                              <th>Browser</th>
                              <th width="100" class="text-center">Login Attempt</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($activities as $activity)
                            <tr>
                              <td>{{ $activity->created_at }}</td>
                              <td>{{ $activity->ip_address }}</td>
                              <td>{{ $activity->location ?: 'not found' }}</td>
                              <td>{{ $activity->user_agent }}</td>
                              <td>
                                @if($activity->status == '1')
                                <span class="text-success">Success</span>
                                @elseif($activity->status == '0')
                                <span class="text-danger">Failed</span>
                                @endif
                              </td>
                            </tr>
                            @empty
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  $(function() {
    $('#country').on('change', function() {
        var country = $(this).val();
        if(country) {
            $.ajax({
                url: '{{ route('get-states') }}',
                type: "GET",
                data : {'country_id': country},
                dataType: "json",
                success:function(data) {
                    //console.log(data);
                  if(data){
                    $('#state').empty();
                    $('#state').focus();
                    $('#state').append('<option value="">-- Select State --</option>'); 
                    $.each(data, function(key, value){
                    $('select[name="state"]').append('<option value="'+ key +'">' + value.name+ '</option>');
                });
              }else{
                $('#state').empty();
              }
              }
            });
        }else{
          $('#state').empty();
          $('#city').empty();
        }
    });

    $('#state').on('change', function() {
        var state = $(this).val();
        if(state) {
            $.ajax({
                url: '{{ route('get-cities') }}',
                type: "GET",
                data : {'state_id': state},
                dataType: "json",
                success:function(data) {
                    //console.log(data);
                  if(data){
                    $('#city').empty();
                    $('#city').focus();
                    $('#city').append('<option value="">-- Select City --</option>'); 
                    $.each(data, function(key, value){
                    $('select[name="city"]').append('<option value="'+ key +'">' + value.name+ '</option>');
                });
              }else{
                $('#city').empty();
              }
              }
            });
        }else{
          $('#city').empty();
        }
    });

  });

  $(function() {
    $('.basic_setting').on('change', function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var setting_id = $(this).data('id'); 
         //alert(setting_id);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('basic-setting.save') }}',
            data: {'status': status, 'setting_id': setting_id},
            success: function(data){
              if (data == true) {
                $("#basic_setting").html("<p style='color:green'>This setting has been enabled!</p>").fadeOut(1000);
              }else{
                $("#basic_setting").html("<p style='color:red'>Something went wrong!</p>").fadeOut(1000)
              }
            }
        });
    });
  });

 if ($("#userbio-form").length > 0) {
  $("#userbio-form").validate({

    rules: {

      bio: {
        required: true,
        maxlength: 250
      },

      address: {
        required: true,
        maxlength:150,
      },

      website: {
        required: true,
        maxlength: 50,
      },

      country: {
        required: true,
        maxlength: 50,
      },

      state: {
        required: true,
        maxlength: 50,
      },

      city: {
        required: true,
        maxlength: 50,
      },

      // phone: {
      //   required: true,
      //   digits: true,
      //   maxlength: 12,
      // },    
    },
    
    submitHandler: function(form) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     $('#user_bio_form').html('Sending..');
     $.ajax({
      url: "{{ route('user-bio.submit')}}" ,
      type: "POST",
      data: $('#userbio-form').serialize(),
      success: function( response ) {
        $('#user_bio_form').html('Save changes');
        if (response.status == true) {
          $('#res_bio_message').show();
          $('#res_bio_message').html(response.msg);
          $('#msg_bio_div').removeClass('d-none');
        }

        document.getElementById("social-form").reset(); 
        setTimeout(function(){
          $('#res_bio_message').hide();
          $('#msg_bio_div').hide();
        },10000);
      },
    });
   }
 })
}


if ($("#social-form").length > 0) {
  $("#social-form").validate({

    rules: {
      facebook: {
        required: true,
        maxlength: 50
      },

      twitter: {
        required: true,
        maxlength:50,
      },

      linkedin: {
        required: true,
        maxlength: 50,
      },

      youtube: {
        required: true,
        maxlength: 50,
      },    
    },
    messages: {

      facebook: {
        required: "Please enter facebook link",
        maxlength: "facebook link should not be 50 characters long."
      },
      twitter: {
        required: "Please enter twitter link",
        maxlength: "Twitter link should not be 50 characters long."
      },
      linkedin: {
        required: "Please enter linkedin link",
        maxlength: "LinkedIn link should not be 50 characters long."
      },
      youtube: {
        required: "Please enter youtube link",
        maxlength: "Youtube link should not be 50 characters long."
      },

    },
    submitHandler: function(form) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     $('#send_social_form').html('Sending..');
     $.ajax({
      url: "{{ route('social-form.submit')}}" ,
      type: "POST",
      data: $('#social-form').serialize(),
      success: function( response ) {
        $('#send_social_form').html('Save changes');
        if (response.status == true) {
          $('#res_social_links').show();
          $('#res_social_links').html(response.msg);
          $('#msg_social_div').removeClass('d-none');
        }

        document.getElementById("social-form").reset(); 
        setTimeout(function(){
          $('#res_social_links').hide();
          $('#msg_social_div').hide();
        },10000);
      },
    });
   }
 })
}


if ($("#change-password-form").length > 0) {
  $("#change-password-form").validate({

    rules: {
      old_password: {
        required: true,
      },

      new_password: {
        required: true,
        minlength:6,
        maxlength: 20
      },

      confirm_new_password: {
        required: true,
        equalTo: "#new_password"
      },    
    },
    messages: {

      old_password: {
        required: "Please enter old passwod",
      },
      new_password: {
        required: "Please enter new passwod",
        maxlength: "New Password should not be 50 characters long."
      },
      confirm_new_password: {
        required: "Please enter confirm password",
      },

    },

    submitHandler: function(form) {
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     $('#update_pwd_btn').html('Updating..');
     $.ajax({
      url: "{{ route('change-password')}}" ,
      type: "POST",
      data: $('#change-password-form').serialize(),
      success: function( response ) {
        $('#update_pwd_btn').html('Update Password');
        if(response.status == false){
          $('#old_password_error').html("<p style='color:red'>"+response.msg+"</p>");

        }else{
          $('#res_message').show();
          $('#res_message').html(response.msg);
          $('#msg_div').removeClass('d-none');
        }

        document.getElementById("change-password-form").reset(); 
        setTimeout(function(){
          $('#res_message').hide();
          $('#old_password_error').hide();
          $('#msg_div').hide();
        },10000);

      },
      
    });
   }
  });

}
</script>
@endpush

