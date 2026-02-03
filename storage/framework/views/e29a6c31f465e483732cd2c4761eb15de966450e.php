
<?php $__env->startSection('content'); ?>

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
                  <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                  <li class="breadcrumb-item active">Account Setting</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <div class="dropdown">
              <a href="<?php echo e(route('profile.show')); ?>" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">View
                Profile</a>
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
                  <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general"
                    aria-expanded="true">
                    <i data-feather="user" class="font-medium-3 mr-1"></i>
                    <span class="font-weight-bold">General</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password"
                    aria-expanded="false">
                    <i data-feather="lock" class="font-medium-3 mr-1"></i>
                    <span class="font-weight-bold">Change Password</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="account-pill-info" data-toggle="pill" href="#account-vertical-info"
                    aria-expanded="false">
                    <i data-feather="info" class="font-medium-3 mr-1"></i>
                    <span class="font-weight-bold">Information</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="account-pill-social" data-toggle="pill" href="#account-vertical-social"
                    aria-expanded="false">
                    <i data-feather="link" class="font-medium-3 mr-1"></i>
                    <span class="font-weight-bold">Social</span>
                  </a>
                </li>

              </ul>
            </div>

            <div class="col-md-9">
              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                      aria-labelledby="account-pill-general" aria-expanded="true">
                      <?php echo $__env->make('errors.flash_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      <form class="validate-form" method="post" action="<?php echo e(route('user-basicinfo.submit')); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                          <div class="col-12 col-md-2">
                            <div class="form-group">
                              <label>Change Profile Picture</label>
                              <div class="custom-img-uploader">
                                <div class="input-group">
                                  <span class="input-group-btn">
                                    <span class="btn-file">
                                      <input type="file" id="imgSec" name="profile">
                                      <img id='upload-img' class="img-upload-block"
                                        src="<?php echo e(asset('admin_assets')); ?>/images/plus-upload.jpg" />
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
                                      <img id='upload-logo' class="img-upload-block"
                                        src="<?php echo e(asset('admin_assets')); ?>/images/plus-upload.jpg" />
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
                              <input type="text" class="form-control" id="account-username" name="username"
                                placeholder="Username" value="robertdowney" />
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="account-name">Name</label>
                              <input type="text" class="form-control" id="account-name" name="name" placeholder="Name"
                                value="Robert Downey" />
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="account-e-mail">Email Id</label>
                              <input type="email" class="form-control" id="account-e-mail" name="email"
                                placeholder="Email" value="robertdowney@gmail.com" />
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="account-company">Mobile Number</label>
                              <input type="text" class="form-control" id="account-company" name="phone"
                                placeholder="Mobile Number" value="9898989898" />
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="account-company">Company</label>
                              <input type="text" class="form-control" id="account-company" name="company"
                                placeholder="Company name" value="Dropshipper" />
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
                              <input type="text" name="dob" class="form-control flatpickr" placeholder="Birth date"
                                id="account-birth-date" name="dob" />
                            </div>
                          </div>
                          <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="tab-pane fade" id="account-vertical-info" role="tabpanel"
                      aria-labelledby="account-pill-info" aria-expanded="false">

                      <div class="card mb-2">
                        <div class="card-body">
                          <h5 class="mb-2 font-weight-bold">Contact Info <small>(Shown on footer)</small></h5>
                          <form class="validate-form" id="footer-contact">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                              <label for="footer_logo">Upload Footer Logo</label>
                              <input type="file" class="form-control-file" id="footer_logo" name="footer_logo"
                                accept="image/*" />
                              <?php if(!empty($footer['logo'])): ?>
                                <div class="mt-2">
                                  <img src="<?php echo e(asset('storage/' . $footer['logo'])); ?>" alt="Footer Logo"
                                    style="max-height: 100px;">
                                </div>
                              <?php endif; ?>
                            </div>
                            <div class="form-group d-flex align-items-center">
                              <i class="fas fa-map-marker-alt mr-2" style="color:#7a7a7a;"></i>
                              <input type="text" class="form-control" name="footer_address"
                                value="<?php echo e(old('footer_address', $footer['address'] ?? '')); ?>" placeholder="Full Address">
                            </div>
                            <div class="form-group d-flex align-items-center">
                              <i class="fas fa-phone-alt mr-2" style="color:#7a7a7a;"></i>
                              <span class="mr-2">Helpline:</span>
                              <input type="text" class="form-control" name="footer_helpline"
                                value="<?php echo e(old('footer_helpline', $footer['helpline'] ?? '')); ?>"
                                placeholder="Helpline Number">
                            </div>
                            <div class="form-group d-flex align-items-center">
                              <i class="fas fa-envelope mr-2" style="color:#7a7a7a;"></i>
                              <input type="email" class="form-control" name="footer_email"
                                value="<?php echo e(old('footer_email', $footer['email'] ?? '')); ?>" placeholder="Contact Email">
                            </div>
                            <div class="form-group d-flex align-items-center">
                              <i class="fab fa-whatsapp mr-2" style="color:#7a7a7a;"></i>
                              <input type="text" class="form-control" name="footer_whatsapp"
                                value="<?php echo e(old('footer_whatsapp', $footer['whatsapp'] ?? '')); ?>"
                                placeholder="WhatsApp Number">
                            </div>
                            <button type="submit" id="footer_contact_form" class="btn btn-primary">Update Footer Contact
                              Info</button>
                          </form>
                        </div>
                      </div>


                      <form class="validate-form" id="userbio-form">
                        <div class="alert alert-success d-none" id="msg_bio_div">
                          <span id="res_bio_message"></span>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="accountTextarea">Bio</label>
                              <textarea class="form-control" name="bio" id="bio" rows="4"
                                placeholder="Your Bio data here..."></textarea>
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
                                  <?php $__empty_1 = true; $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                  <?php endif; ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <div class="form-group">
                                <label>Select State</label>
                                <select class="form-control" name="state" id="state">
                                  
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <div class="form-group">
                                <label>Select City</label>
                                <select class="form-control" name="city" id="city">
                                  
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="account-website">Website</label>
                              <input type="text" class="form-control" name="website" id="website"
                                placeholder="Website address" />
                            </div>
                          </div>
                          
                          <div class="col-12">
                            <button type="submit" id="user_bio_form" class="btn btn-primary mt-1 mr-1">Save
                              changes</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel"
                      aria-labelledby="account-pill-password" aria-expanded="false">
                      <form class="validate-form" id="change-password-form">
                        <div class="alert alert-success d-none" id="msg_div">
                          <span id="res_message"></span>
                        </div>
                        <div class="row">
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="account-old-password">Old Password</label>
                              <input type="password" id="old_password" class="form-control" name="old_password"
                                placeholder="Old Password" />
                              <span id="old_password_error"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="account-new-password">New Password</label>
                              <input type="password" id="new_password" name="new_password" class="form-control"
                                placeholder="New Password" />
                            </div>
                          </div>
                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label for="account-retype-new-password">Retype New Password</label>
                              <input type="password" id="confirm_new_password" class="form-control"
                                name="confirm_new_password" placeholder="New Password" />
                            </div>
                          </div>
                          <div class="col-12">
                            <button type="submit" id="update_pwd_btn" class="btn btn-primary mr-1 mt-1">Update
                              Password</button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="tab-pane fade" id="account-vertical-social" role="tabpanel"
                      aria-labelledby="account-pill-social" aria-expanded="false">
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
                              <input type="text" value="<?php echo e($user_social_links->facebook ?? ''); ?>" name="facebook" id="facebook" class="form-control"
                                placeholder="Add Facebook link" />
                            </div>
                          </div>

                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>Instagram</label>
                              <input type="text" value="<?php echo e($user_social_links->instagram ?? ''); ?>" name="instagram" id="instagram" class="form-control"
                                placeholder="Add Instagram link" />
                            </div>
                          </div>

                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>Youtube</label>
                              <input type="text" value="<?php echo e($user_social_links->youtube ?? ''); ?>" name="youtube" id="youtube" class="form-control"
                                placeholder="Add YouTube link" />
                            </div>
                          </div>

                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>LinkedIn</label>
                              <input type="text" value="<?php echo e($user_social_links->linkedin ?? ''); ?>" name="linkedin" id="linkedin" class="form-control"
                                placeholder="Add LinkedIn link" />
                            </div>
                          </div>

                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>Twitter</label>
                              <input type="text" value="<?php echo e($user_social_links->twitter ?? ''); ?>" name="twitter" id="twitter" class="form-control"
                                placeholder="Add Twitter link" />
                            </div>
                          </div>

                          <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>Google Plus</label>
                              <input type="text" name="google_plus" value="<?php echo e($user_social_links->google_plus ?? ''); ?>" id="google_plus" class="form-control"
                                placeholder="Add Google Plus link" />
                            </div>
                          </div>

                          <div class="col-12">
                            <button type="submit" id="send_social_form" class="btn btn-primary mr-1 mt-1">Save
                              changes</button>
                          </div>
                        </div>
                      </form>
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>

    $(document).ready(function () {
      $('#footer-contact').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          url: '<?php echo e(route("footer-contact.update")); ?>', // Ensure route name matches your route
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function () {
            $('#footer-contact button[type="submit"]').attr('disabled', true).text('Uploading...');
          },
          success: function (response) {
            $('#footer-contact button[type="submit"]').attr('disabled', false).text('Update Footer Contact Info');
            // Show success message - customize as needed
            alert(response.message || 'Footer contact info updated successfully.');
          },
          error: function (xhr, status, error) {
            $('#footer-contact button[type="submit"]').attr('disabled', false).text('Update Footer Contact Info');
            // Show error - extract from response if available
            var errMsg = 'Something went wrong, please try again.';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
              errMsg = Object.values(xhr.responseJSON.errors).flat().join('\n');
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
              errMsg = xhr.responseJSON.message;
            }
            alert(errMsg);
          }
        });
      });
    });


    $(function () {
      $('#country').on('change', function () {
        var country = $(this).val();
        if (country) {
          $.ajax({
            url: '<?php echo e(route('get-states')); ?>',
            type: "GET",
            data: { 'country_id': country },
            dataType: "json",
            success: function (data) {
              //console.log(data);
              if (data) {
                $('#state').empty();
                $('#state').focus();
                $('#state').append('<option value="">-- Select State --</option>');
                $.each(data, function (key, value) {
                  $('select[name="state"]').append('<option value="' + key + '">' + value.name + '</option>');
                });
              } else {
                $('#state').empty();
              }
            }
          });
        } else {
          $('#state').empty();
          $('#city').empty();
        }
      });

      $('#state').on('change', function () {
        var state = $(this).val();
        if (state) {
          $.ajax({
            url: '<?php echo e(route('get-cities')); ?>',
            type: "GET",
            data: { 'state_id': state },
            dataType: "json",
            success: function (data) {
              //console.log(data);
              if (data) {
                $('#city').empty();
                $('#city').focus();
                $('#city').append('<option value="">-- Select City --</option>');
                $.each(data, function (key, value) {
                  $('select[name="city"]').append('<option value="' + key + '">' + value.name + '</option>');
                });
              } else {
                $('#city').empty();
              }
            }
          });
        } else {
          $('#city').empty();
        }
      });

    });

    $(function () {
      $('.basic_setting').on('change', function () {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var setting_id = $(this).data('id');
        //alert(setting_id);
        $.ajax({
          type: "GET",
          dataType: "json",
          url: '<?php echo e(route('basic-setting.save')); ?>',
          data: { 'status': status, 'setting_id': setting_id },
          success: function (data) {
            if (data == true) {
              $("#basic_setting").html("<p style='color:green'>This setting has been enabled!</p>").fadeOut(1000);
            } else {
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
            maxlength: 150,
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

        submitHandler: function (form) {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $('#user_bio_form').html('Sending..');
          $.ajax({
            url: "<?php echo e(route('user-bio.submit')); ?>",
            type: "POST",
            data: $('#userbio-form').serialize(),
            success: function (response) {
              $('#user_bio_form').html('Save changes');
              if (response.status == true) {
                $('#res_bio_message').show();
                $('#res_bio_message').html(response.msg);
                $('#msg_bio_div').removeClass('d-none');
              }

              document.getElementById("social-form").reset();
              setTimeout(function () {
                $('#res_bio_message').hide();
                $('#msg_bio_div').hide();
              }, 10000);
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
            maxlength: 50,
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
        submitHandler: function (form) {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $('#send_social_form').html('Sending..');
          $.ajax({
            url: "<?php echo e(route('social-form.submit')); ?>",
            type: "POST",
            data: $('#social-form').serialize(),
            success: function (response) {
              $('#send_social_form').html('Save changes');
              if (response.status == true) {
                $('#res_social_links').show();
                $('#res_social_links').html(response.msg);
                $('#msg_social_div').removeClass('d-none');
              }

              document.getElementById("social-form").reset();
              setTimeout(function () {
                $('#res_social_links').hide();
                $('#msg_social_div').hide();
              }, 10000);
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
            minlength: 6,
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

        submitHandler: function (form) {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $('#update_pwd_btn').html('Updating..');
          $.ajax({
            url: "<?php echo e(route('change-password')); ?>",
            type: "POST",
            data: $('#change-password-form').serialize(),
            success: function (response) {
              $('#update_pwd_btn').html('Update Password');
              if (response.status == false) {
                $('#old_password_error').html("<p style='color:red'>" + response.msg + "</p>");

              } else {
                $('#res_message').show();
                $('#res_message').html(response.msg);
                $('#msg_div').removeClass('d-none');
              }

              document.getElementById("change-password-form").reset();
              setTimeout(function () {
                $('#res_message').hide();
                $('#old_password_error').hide();
                $('#msg_div').hide();
              }, 10000);

            },

          });
        }
      });

    }
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/manage-profile/setting.blade.php ENDPATH**/ ?>