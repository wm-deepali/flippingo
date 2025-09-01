

<?php $__env->startSection('title'); ?>
	Flippingo -Reset Password
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<section class="breadcrumb-area bread-bg">
		<div class="overlay"></div>
		<div class="container">
			<div class="breadcrumb-content text-center">
				<h2 class="sec__title text-white mb-3">Reset Password</h2>
				<ul class="bread-list">
					<li><a href="<?php echo e(Route('home')); ?>">home</a></li>
					<li>Reset Password</li>
				</ul>
			</div>
		</div>
		<div class="bread-svg">
			<svg viewBox="0 0 500 150" preserveAspectRatio="none">
				<path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
			</svg>
		</div>
	</section>

	<!--end breadcrumb-->
	<!--start shop cart-->
	<?php if(session('success')): ?>
		<h5 class="alert alert-success text-center"><?php echo e(Session::get('success')); ?></h5><br>
		<?php Session::forget('success');?>
	<?php endif; ?>
	<?php if(session('error')): ?>
		<h5 class="alert alert-danger text-center"><?php echo e(Session::get('error')); ?></h5><br>
		<?php Session::forget('error');?>
	<?php endif; ?>

	<section class="recovery-area padding-top-60px padding-bottom-90px">
		<div class="container">
			<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
				<div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
					<div class="col mx-auto">
						<div class="card mb-0">
							<div class="card-body" style="background:#ffffff;">
								<div class="border p-4 rounded">
									<div class="login-separater text-center mb-4"> <span>Reset Password</span>
										<hr />
									</div>


									<div class="form-body">
										<form class="row g-3" id="registerForm" method="post"
											action="<?php echo e(route('reset.password.post')); ?>" enctype="multipart/form-data">
											<?php echo csrf_field(); ?>

											<!-- Hidden token from URL -->
											<input type="hidden" name="token" value="<?php echo e(request()->route('token')); ?>">

											<div class="col-12">
												<label for="password" class="form-label">New Password</label>
												<input type="password" autocomplete="off" name="password" id="password"
													class="form-control" placeholder="New Password" required />
											</div>
											<div class="col-12">
												<label for="password-confirm" class="form-label">Confirm New
													Password</label>
												<input type="password" autocomplete="off" name="password_confirmation"
													id="password-confirm" class="form-control "
													placeholder="Confirm New Password" required />
											</div>


											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-light"><i
															class='bx bx-user'></i>Submit</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</section>
	<!--end shop cart-->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('after-scripts'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="
					https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
					"></script>
	<link href="
					https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css
					" rel="stylesheet">


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/front/forget-password-link.blade.php ENDPATH**/ ?>