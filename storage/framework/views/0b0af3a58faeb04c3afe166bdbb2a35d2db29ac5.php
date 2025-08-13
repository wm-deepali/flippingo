<style>
	/*.show-category-with-images{*/
	/*    width:100%;*/
	/*    display:grid;*/
	/*    grid-template-column:1fr 1fr 1fr 1fr;*/
	/*}*/
	/*    .primary-menu .navbar .nav-item:hover .show-category-with-images {*/
	/*   padding:20px !important;*/
	/* background: antiquewhite; */
	/*    display: grid !important;*/
	/*    grid-template-columns: 1fr 1fr 1fr 1fr !important;*/
	/*    gap: 20px !important;*/
	/*}*/
	.primary-menu .navbar .nav-item:hover .show-category-with-images {
		padding: 20px !important;
		/* background: antiquewhite; */
		display: grid !important;
		grid-template-columns: 1fr 1fr !important;
		gap: 20px !important;
	}

	.primary-menu .navbar .nav-item:hover .show-category-with-images img {
		width: 140px;
	}

	.custom-mega-menu {
		/*width: 100%;*/
		padding: 20px;

	}

	.list-unstyled1 {
		display: grid !important;
		grid-template-columns: 1fr 1fr !important;
		gap: 20px !important;
	}

	.custom-cat-list .list-group {
		padding: 10px;
	}

	.custom-cat-list .list-group-item {
		cursor: pointer;
		border: none;
		padding: 10px 15px !important;
		margin-bottom: 10px;
	}

	.custom-cat-item.active {
		background-color: #d0d0d0;
		font-weight: bold;
	}

	.custom-subcat-list {
		border-left: 1px solid #ddd;
		padding-left: 20px;
	}

	.main-cat {
		display: flex;
		flex-direction: column;
	}

	.main-cat img {
		width: 140px;
	}

	@media  only screen and (max-width: 600px) {
		.logo a img {
			width: 100px;
		}

		.header-wrapper .top-menu .social-link .nav-link {
			font-size: 15px;
			width: 30px;
			height: 30px;
			display: flex;
			align-items: center;
			justify-content: center;
			background: rgb(255 255 255 / 0%);
			border: 1px solid rgb(255 255 255 / 0%);
			text-align: center;
			border-radius: 50%;
			color: #6a6767;
			margin: 0 3px;
		}
	}
</style>

<!--wrapper-->

<div class="wrapper">
	<div class="discount-alert bg-dark-11 d-none d-lg-block">
		<div class="alert alert-dismissible fade show shadow-none rounded-0 mb-0 border-bottom">
			<div class="d-lg-flex align-items-center gap-2 justify-content-center">
				<p class="mb-0 text-white">Get Up to <strong>20% OFF</strong> on New Order from Books</p>

				<p class="mb-0 font-13 text-light-3">*Limited time only</p>
			</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
	<!--start top header wrapper-->
	<div class="header-wrapper bg-dark-12">
		<div class="top-menu " style="    border-bottom: 1px solid #bbb5b58c !important;">
			<div class="container">
				<nav class="navbar navbar-expand">
					<div class="shiping-title text-uppercase font-13 text-gray d-none d-sm-flex">Welcome to our
						Flippingo!</div>
					<ul class="navbar-nav ms-auto d-none d-lg-flex">
						<li class="nav-item"> <a class="nav-link text-gray" href="<?php echo e(route('order-tracking')); ?>">Track
								Order</a>
						</li>
						<li class="nav-item"> <a class="nav-link text-gray" href="<?php echo e(route('shop-categories')); ?>">Instant
								Quote</a>
						</li>
						<li class="nav-item"> <a class="nav-link text-gray" href="<?php echo e(route('about-us')); ?>">About Us</a>
						</li>
						<li class="nav-item"> <a class="nav-link text-gray" href="<?php echo e(route('contact-us')); ?>">Contact</a>
						</li>

						<li class="nav-item"> <a class="nav-link text-gray" href="<?php echo e(route('blogs')); ?>">Blog</a>
						</li>
						<li class="nav-item"> <a class="nav-link text-gray" href="<?php echo e(route('faq')); ?>">FAQ</a>
						</li>
						<li class="nav-item"> <a class="nav-link text-gray" href="<?php echo e(route('contact-us')); ?>">Help &
								Support</a>
						</li>
					</ul>
					<ul class="navbar-nav">

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
								data-bs-toggle="dropdown">
								<div class="lang d-flex gap-1">
									<div><i class="flag-icon flag-icon-um"></i>
									</div>
									<div><span>UK</span>
									</div>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg-end">
								<a class="dropdown-item d-flex allign-items-center" href="javascript:;"> <i
										class="flag-icon flag-icon-de me-2"></i><span>German</span>
								</a> <a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
										class="flag-icon flag-icon-fr me-2"></i><span>French</span></a>
								<a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
										class="flag-icon flag-icon-um me-2"></i><span>English</span></a>
								<a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
										class="flag-icon flag-icon-in me-2"></i><span>Hindi</span></a>
								<a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
										class="flag-icon flag-icon-cn me-2"></i><span>Chinese</span></a>
								<a class="dropdown-item d-flex allign-items-center" href="javascript:;"><i
										class="flag-icon flag-icon-ae me-2"></i><span>Arabic</span></a>
							</div>
						</li>
					</ul>
					<ul class="navbar-nav social-link ms-lg-2 ms-auto">
						<li class="nav-item"> <a class="nav-link" href="javascript:;"><i
									class='bx bxl-facebook'></i></a>
						</li>
						<li class="nav-item"> <a class="nav-link" href="javascript:;"><i class='bx bxl-twitter'></i></a>
						</li>
						<li class="nav-item"> <a class="nav-link" href="javascript:;"><i
									class='bx bxl-linkedin'></i></a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="header-content pb-3 pb-md-0">
			<div class="container">
				<div class="row align-items-center">
					<div class="col col-md-auto">
						<div class="d-flex align-items-center">
							<div class="mobile-toggle-menu d-lg-none px-lg-2" data-trigger="#navbar_main"><i
									class='bx bx-menu'></i>
							</div>
							<div class="logo  d-lg-flex">
								<a href="<?php echo e(route('home')); ?>">
									<img src="<?php echo e(URL::asset('assets/images/NuvemPrint.png')); ?>" class="logo-icon"
										alt="" />

								</a>
							</div>
						</div>
					</div>
					<div class="col-12 col-md order-4 order-md-2">
						<div class="input-group flex-nowrap px-xl-4">
							<input type="text" class="form-control w-100" placeholder="Search for Products">

							<span class="input-group-text cursor-pointer"><i class='bx bx-search'></i></span>
						</div>
					</div>
					<?php
						use App\Models\ContactInfo;
						$headerContact = ContactInfo::where('show_on_header', 1)->first();
					?>

					<?php if($headerContact): ?>
						<div class="col col-md-auto order-3 d-none d-xl-flex align-items-center">
							<div class="fs-1 text-gray">
								<i class='bx bx-headphone'></i>
							</div>
							<div class="ms-2">
								<p class="mb-0 font-13 text-gray">CALL US NOW</p>
								<h5 class="mb-0 text-gray" style="color: gray !important;">
									<?php echo e($headerContact->contact_number  ?? '+01132 874724'); ?>

								</h5>
							</div>
						</div>
					<?php endif; ?>

					<div class="col col-md-auto order-2 order-md-4">
						<div class="top-cart-icons">
							<nav class="navbar navbar-expand">
								<ul class="navbar-nav ms-auto">
									<?php if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->id != ""): ?>

										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle dropdown-toggle-nocaret cart-link" href="#"
												data-bs-toggle="dropdown">
												<i class='bx bx-user'></i> <i class='bx bx-chevron-down'></i>
											</a>
											<ul class="dropdown-menu" style="background:#000;">
												<li><a class="dropdown-item" href="<?php echo e(route('account-dashboard')); ?>"
														style="color:gray;">Dashboard</a></li>
												<li><a class="dropdown-item" href="<?php echo e(route('account-logout')); ?>"
														style="color:gray;">Logout</a>
												</li>
											</ul>
										</li>
									<?php else: ?>
										<li class="nav-item"><a href="<?php echo e(route('authentication-signin')); ?>"
												class="nav-link cart-link"><i class='bx bx-user'></i></a>
										</li>
									<?php endif; ?>
									<!-- <li class="nav-item"><a href="" class="nav-link cart-link"><i
												class='bx bx-heart'></i></a>
									</li> -->

									<li class="nav-item">
										<a href="<?php echo e(route('cart.show')); ?>" class="nav-link cart-link">
											<i class='bx bx-cart'></i>
										</a>
									</li>


								</ul>
							</nav>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
		<div class="primary-menu border-top" style="    background: #80808029;">
			<div class="container">
				<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
					<div class="offcanvas-header">
						<button class="btn-close float-end"></button>
						<h5 class="py-2 text-white">Navigation</h5>
					</div>
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a>
						</li>

						<!-- Printing Dropdown -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
								data-bs-toggle="dropdown">
								All Products <i class='bx bx-chevron-down'></i>
							</a>

							<div class="dropdown-menu dropdown-large-menu custom-mega-menu">
								<div class="row">
									<div class="col-md-4 custom-cat-list">
										<?php $menucats = menuCategories(); ?>
										<?php if(isset($menucats) && count($menucats) > 0): ?>
											<ul class="list-group">
												<?php $__currentLoopData = $menucats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $menucat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<li class="list-group-item custom-cat-item <?php echo e($index == 0 ? 'active' : ''); ?>"
														data-cat-id="cat-<?php echo e($menucat->id); ?>">
														<?php echo e($menucat->name); ?>

													</li>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
										<?php endif; ?>
									</div>

									<div class="col-md-5 custom-subcat-list">
										<?php $__currentLoopData = $menucats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $menucat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="custom-subcat-content <?php echo e($index == 0 ? 'd-block' : 'd-none'); ?>"
												id="cat-<?php echo e($menucat->id); ?>">
												<h6 class="fw-bold text-black"><?php echo e($menucat->name); ?></h6>
												<?php if(isset($menucat->subcategories) && count($menucat->subcategories) > 0): ?>
													<ul class="list-unstyled1 ">
														<?php $__currentLoopData = $menucat->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<div class="main-cat">
																<img src="<?php echo e(asset('storage/' . $subcat->thumbnail)); ?>">
																<li>
																	<a class=" text-black"
																		href="<?php echo e(route('subcategory-details', ['slug' => $subcat->slug])); ?>">
																		<?php echo e($subcat->name); ?>

																	</a>
																</li>
															</div>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</ul>
												<?php else: ?>
													<p class=" text-black" style="color:#000;">No subcategories available.</p>
												<?php endif; ?>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>

									<div class="col-md-3">
										<div class="pramotion-banner1">
											<img src="<?php echo e(URL::asset('assets/images/gallery/menu-img.jpg')); ?>"
												class="img-fluid" alt="Printing Menu Banner" />
										</div>
									</div>
								</div>
							</div>
						</li>


						<?php $menucates = menuCategories(); ?>
						<?php if(isset($menucates) && count($menucates) > 0): ?>
							<?php $__currentLoopData = $menucates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menucate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
										data-bs-toggle="dropdown">
										<?php echo e($menucate->name); ?> <i class='bx bx-chevron-down'></i>
									</a>
									<?php if(isset($menucate->subcategories) && count($menucate->subcategories) > 0): ?>

										<ul class="dropdown-menu show-category-with-images">
											<?php $__currentLoopData = $menucate->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $menusubcates): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="">
													<img src="<?php echo e(asset('storage/' . $menusubcates->thumbnail)); ?>">
													<li><a class="dropdown-item "
															href="<?php echo e(route('subcategory-details', ['slug' => $menusubcates->slug])); ?>"><?php echo e($menusubcates->name ?? ""); ?></a>
													</li>
												</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>






						<!-- My Account -->
						<!--li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
									data-bs-toggle="dropdown">
									My Account <i class='bx bx-chevron-down'></i>
								</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="">Dashboard</a></li>
									<li><a class="dropdown-item" href="account-downloads.html">Downloads</a></li>
									<li><a class="dropdown-item" href="account-orders.html">Orders</a></li>
									<li><a class="dropdown-item" href="account-payment-methods.html">Payment Methods</a>
									</li>
									<li><a class="dropdown-item" href="account-user-details.html">User Details</a></li>
								</ul>
							</li-->
					</ul>
				</nav>
			</div>
		</div>

	</div>
	<!--end top header wrapper-->

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const catItems = document.querySelectorAll(".custom-cat-item");
			const subcatContents = document.querySelectorAll(".custom-subcat-content");

			catItems.forEach(item => {
				item.addEventListener("mouseenter", () => {
					const id = item.getAttribute("data-cat-id");

					// Remove active from all
					catItems.forEach(i => i.classList.remove("active"));
					subcatContents.forEach(sc => sc.classList.add("d-none"));

					// Add active to current
					item.classList.add("active");
					document.getElementById(id)?.classList.remove("d-none");
				});
			});
		});
	</script><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/layouts/includes/header.blade.php ENDPATH**/ ?>