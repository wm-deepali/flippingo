@extends('layouts.new-master')

@section('title')
    Flippingo ->My Profile
@endsection



@section('content')
		<div class="page-wrapper">
			<div class="page-content">
				<!--start breadcrumb-->
				<section class="py-3 border-bottom d-none d-md-flex">
					<div class="container">
						<div class="page-breadcrumb d-flex align-items-center">
							<h3 class="breadcrumb-title pe-3">My Profile</h3>
							<div class="ms-auto">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb mb-0 p-0">
										<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:;">Account</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">My Profile</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</section>
				<!--end breadcrumb-->
				<!--start shop cart-->
				<section class="py-4">
					<div class="container">
						<h3 class="d-none">Account</h3>
						<div class="card">
							<div class="card-body">
								<div class="row">
									@include('layouts.includes.user-sidebar', ['activeMenu' => 'account-detailss'])
                                    <!-- Bootstrap & Icons (Required) -->
                                    <div class="col-lg-8 ">
                                       
                                        
                                       
                            			<div class="card shadow-lg border-0">
                            				<div class="d-flex align-items-start mb-4 p-4">
                                				<div class="position-relative">
                                				    @if($user->profile_pic !='')
                                					@if (strpos($user->profile_pic,'https') !== false) 
                                					<img src="{{$user->profile_pic}}" class="rounded-circle" width="100" height="100" alt="Profile Image">
                                                    @else
                                                    <img src="{{asset('storage').'/'.$user->profile_pic}}" class="rounded-circle" width="100" height="100" alt="Profile Image">
                                                    @endif
                                                    @else
                                                    <img src="https://ashtonwell.com/public/assets/images/process-box/03.png" class="rounded-circle" width="100" height="100" alt="Profile Image">
                                                    @endif
                                					<!-- Edit icon on image -->
                                					<span class="position-absolute bottom-0 end-0 p-1 bg-white rounded-circle shadow-sm" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#updateProfilePicModal">
                                						<i class="bi bi-pencil-fill text-primary"></i>
                                					</span>
                                				</div>
                                				<div class="ms-3">
                                					<h5 class="mb-1">{{$user->first_name ?? ""}} {{$user->last_name ?? ""}}</h5>
                                					<p class="mb-1"><strong>Email:</strong> {{$user->email ?? ""}}</p>
                                					<p class="mb-1"><strong>Phone:</strong> {{$user->mobile ?? ""}}</p>
                                
                                					<!-- Change Password Button -->
                                					<button class="btn btn-sm btn-outline-primary mt-2 text-white" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                						<i class="bi bi-key-fill me-1"></i> Change Password
                                					</button>
                                				</div>
                            			    </div>
                            
                            				<div class="card-body">
                            				     <div id="alert-container"></div>
                                               
                            					<form class="row g-3" id="profileForm">
                            					    @csrf
                                                    
                            						<div class="col-md-6">
                            							<label class="form-label">First Name</label>
                            							<input type="text" name="first_name" id="first_name" class="form-control" value="{{$user->first_name ?? ""}}" required>
                            							<div class="invalid-feedback" id="error-first_name"></div>
                            						</div>
                            						<div class="col-md-6">
                            							<label class="form-label">Last Name</label>
                            							<input type="text" name="last_name" id="last_name" class="form-control" value="{{$user->last_name ?? ""}}" required>
                            							<div class="invalid-feedback" id="error-last_name"></div>
                            						</div>
                            						<div class="col-md-6">
                            							<label class="form-label">Mobile Number</label>
                            							<input type="text" name="mobile" id="mobile" class="form-control" value="{{$user->mobile ?? ""}}" required>
                            							<div class="invalid-feedback" id="error-mobile"></div>
                            						</div>
                            						<div class="col-md-6">
                            							<label class="form-label">Whatsapp</label>
                            							<input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="{{$user->whatsapp_number ?? ""}}" required>
                            							<div class="invalid-feedback" id="error-whatsapp_number"></div>
                            						</div>
                            						<div class="col-12">
                            							<label class="form-label">Display Name</label>
                            							<input type="text" name="display_name" id="display_name" class="form-control" value="{{ $user->first_name . ' ' . $user->last_name }}" required>
                            							<div class="invalid-feedback" id="error-display_name"></div>
                            						</div>
                            						<div class="col-12">
                            							<label class="form-label">Email Address</label>
                            							<input type="email" name="email" id="email" class="form-control" value="{{$user->email ?? ""}}" required>
                            							<div class="invalid-feedback" id="error-email"></div>
                            						</div>
                            						<div class="col-12 text-end">
                            							<button type="submit" class="btn btn-primary px-4">
                            								<i class="bi bi-save me-1"></i> Save Changes
                            							</button>
                            						</div>
                            					</form>
                            				</div>
                            			</div>
                            		</div>


                                    <!-- Update Profile Picture Modal -->
                                    <div class="modal fade" id="updateProfilePicModal" tabindex="-1" aria-labelledby="updateProfilePicModalLabel" aria-hidden="true">
                                    	<div class="modal-dialog modal-dialog-centered">
                                    		<div class="modal-content">
                                    			<div class="modal-header" style="background:#fff;border-bottom:1px solid gray;">
                                    				<h5 class="modal-title" id="updateProfilePicModalLabel">Update Profile Picture</h5>
                                    				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    			</div>
                                    			<div class="modal-body text-center" style="background:#fff;">
                                    			    <form class="row g-3" id="profilePicForm" enctype="multipart/form-data">
                            					    @csrf
                                                    
                                    				<input type="file" name="profile_pic" id="profile_pic" class="form-control mb-3" accept="image/*">
                                    				<div class="invalid-feedback" id="error-profile_pic" style="text-align:left;"></div>
                                    				<button type="submit" class="btn btn-primary">Upload</button>
                                    				</form>
                                    			</div>
                                    		</div>
                                    	</div>
                                    </div>

                                    <!-- Change Password Modal -->
                                    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                                    	<div class="modal-dialog modal-dialog-centered">
                                    		<div class="modal-content border-0 shadow">
                                    			<div class="modal-header  text-white" style="background:#fff;border-bottom:1px solid gray;">
                                    				<h5 class="modal-title" id="changePasswordModalLabel"><i class="bi bi-key-fill me-2"></i>Change Password</h5>
                                    				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    			</div>
                                    			<div class="modal-body" style="background:#fff;">
                                    				<form id="change-password-form">
                                    					<div class="mb-3">
                                    						<label class="form-label">Current Password</label>
                                    						<input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter current password">
                                    					</div>
                                    					<div class="mb-3">
                                    						<label class="form-label">New Password</label>
                                    						<input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter new password">
                                    					</div>
                                    					<div class="mb-3">
                                    						<label class="form-label">Confirm New Password</label>
                                    						<input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Re-enter new password">
                                    					</div>
                                    					<div id="response"></div>
                                    					<button type="submit" class="btn btn-dark w-100">Update Password</button>
                                    				</form>
                                    			</div>
                                    		</div>
                                    	</div>
                                    </div>

								</div>
								<!--end row-->
							</div>
						</div>
					</div>
				</section>
				<!--end shop cart-->
			</div>
		</div>
		<!--end page wrapper -->
@endsection
@push('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('profileForm');

    form.addEventListener('submit', async function (e) {
       
        e.preventDefault();

        // Reset all feedback and classes
        document.querySelectorAll('.invalid-feedback').forEach(el => el.innerText = '');
        document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));


        const fname = document.getElementById('first_name');
        const lname = document.getElementById('last_name');
        const dname = document.getElementById('display_name');
        const email = document.getElementById('email');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const mobile = document.getElementById('mobile');
        const whatsapp = document.getElementById('whatsapp_number');
        const phonePattern = /^[0-9]{10,15}$/; // Accepts 10 to 15 digits
         let hasError = false;
         
        if (!fname.value.trim()) {
            document.getElementById('error-first_name').innerText = 'First Name is required.';
            fname.classList.add('is-invalid');
            hasError = true;
        }
        
        if (!lname.value.trim()) {
            document.getElementById('error-last_name').innerText = 'Last Name is required.';
            lname.classList.add('is-invalid');
            hasError = true;
        }
        
        if (!dname.value.trim()) {
            document.getElementById('error-display_name').innerText = 'Display Name is required.';
            dname.classList.add('is-invalid');
            hasError = true;
        }
        
        
        if (!email.value.trim()) {
            document.getElementById('error-email').innerText = 'Email is required.';
            email.classList.add('is-invalid');
            hasError = true;
        } else if (!emailPattern.test(email.value)) {
            document.getElementById('error-email').innerText = 'Email is not valid.';
            email.classList.add('is-invalid');
            hasError = true;
        }
        
        if (!mobile.value.trim()) {
            document.getElementById('error-mobile').innerText = 'Mobile Number is required.';
            mobile.classList.add('is-invalid');
            hasError = true;
        } else if (!phonePattern.test(mobile.value)) {
            document.getElementById('error-mobile').innerText = 'Mobile Number is not valid.';
            mobile.classList.add('is-invalid');
            hasError = true;
        }
       
        if (!whatsapp.value.trim()) {
            document.getElementById('error-whatsapp_number').innerText = 'Whatsapp Number is required.';
            whatsapp.classList.add('is-invalid');
            hasError = true;
        } else if (!phonePattern.test(whatsapp.value)) {
            document.getElementById('error-whatsapp_number').innerText = 'Whatsapp Number is not valid.';
            whatsapp.classList.add('is-invalid');
            hasError = true;
        }
       
        if (hasError) return;

        // --- AJAX submission ---
        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('profile.update') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok && response.status === 422) {
                const errors = data.errors;
                for (let field in errors) {
                    const errorField = document.getElementById(`error-${field}`);
                    const input = document.getElementById(field);
                    if (errorField && input) {
                        errorField.innerText = errors[field][0];
                        input.classList.add('is-invalid');
                    }
                }
                return;
            }

            if (data.success) {
                document.getElementById('alert-container').innerHTML = `
                    <div class="alert alert-success">${data.message}</div>
                `;
                setTimeout(() => {
                    document.getElementById('alert-container').innerHTML = '';
                }, 3000);
            }
        } catch (error) {
            console.error('AJAX request failed:', error);
        }
    });
});

const MAX_FILE_SIZE_MB = 2;
const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif'];
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('profilePicForm');

    form.addEventListener('submit', async function (e) {
       
        e.preventDefault();

        // Reset all feedback and classes
        document.querySelectorAll('.invalid-feedback').forEach(el => el.innerText = '');
        document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));


        const fileInput = document.getElementById('profile_pic');
        const file = fileInput.files[0];
    
        let hasError = false;
        if (!file) {
            document.getElementById('error-profile_pic').innerText = 'Please select an image file.';
            fileInput.classList.add('is-invalid');
             hasError = true;
        } 
        if (!ALLOWED_TYPES.includes(file.type)) {
            document.getElementById('error-profile_pic').innerText = 'Invalid file type. Allowed: JPG, PNG, WEBP, GIF.';
            fileInput.classList.add('is-invalid');
             hasError = true;
        }
        if (file.size > MAX_FILE_SIZE_MB * 1024 * 1024) {
           document.getElementById('error-profile_pic').innerText = 'Image must be less than 2MB.';
           fileInput.classList.add('is-invalid');
             hasError = true;
        }

  
    
       
        if (hasError) return;

        // --- AJAX submission ---
        
        const formData = new FormData();
        formData.append('profile_pic', file);

        try {
            const response = await fetch("{{ route('profile-pic.update') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok && response.status === 422) {
                const errors = data.errors;
                for (let field in errors) {
                    const errorField = document.getElementById(`error-${field}`);
                    const input = document.getElementById(field);
                    if (errorField && input) {
                        errorField.innerText = errors[field][0];
                        input.classList.add('is-invalid');
                    }
                }
                return;
            }

            if (data.success) {
                $('.modal-backdrop').remove();
                $('#updateProfilePicModal').modal('hide');

                // Reset form
                $('#profilePicForm')[0].reset();
                document.getElementById('alert-container').innerHTML = `
                    <div class="alert alert-success">${data.message}</div>
                `;
                setTimeout(() => {
                    document.getElementById('alert-container').innerHTML = '';
                }, 3000);
                location.reload();

            }
        } catch (error) {
            console.error('AJAX request failed:', error);
        }
    });
});


</script>
<script>
        $('#change-password-form').on('submit', function(e) {
            e.preventDefault();

            let old_password = $('#old_password').val();
            let new_password = $('#new_password').val();
            let confirm = $('#new_password_confirmation').val();

            // Client-side validation
            if (!old_password || !new_password || !confirm) {
                $('#response').css('color', 'red').text("All fields are required.");
                return;
            }
            if (new_password.length < 8) {
                $('#response').css('color', 'red').text("New password must be at least 8 characters.");
                return;
            }
            if (new_password !== confirm) {
                $('#response').css('color', 'red').text("Passwords do not match.");
                return;
            }

            $.ajax({
                url: "{{ route('profile-password.update') }}",
                method: "POST",
                data: {
                    old_password: old_password,
                    new_password: new_password,
                    new_password_confirmation: confirm,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('.modal-backdrop').remove();
                        $('#changePasswordModal').modal('hide');

                        // Reset form
                        $('#change-password-form')[0].reset();
                        document.getElementById('alert-container').innerHTML = `
                            <div class="alert alert-success">${response.message}</div>
                        `;
                        setTimeout(() => {
                            document.getElementById('alert-container').innerHTML = '';
                        }, 3000);
                    }
                },
                error: function(xhr) {
                    let res = xhr.responseJSON;
                    let errors = res.errors ? Object.values(res.errors).flat().join(', ') : "Error occurred";
                    $('#response').css('color', 'red').text(errors);
                }
            });
        });
    </script>


@endpush