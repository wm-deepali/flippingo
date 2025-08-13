

<?php $__env->startSection('title'); ?>
	Flippingo
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-styles'); ?>
	<style>
		/* .container {
				  max-width: 1200px;
				  margin: auto;
				} */

		.main-content {
			display: flex;
			gap: 1.5rem;
		}

		.left,
		.right {
			background-color: #fff;
			border-radius: 8px;
			padding: 1.5rem;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
		}

		.left {
			flex: 2;
		}

		.right {
			flex: 1;
		}

		h3 {
			margin-top: 0;
		}

		.form-group {
			margin-bottom: 1rem;
		}

		.form-group label {
			display: block;
			font-weight: 500;
			margin-bottom: 0.5rem;
		}

		.input-row {
			display: flex;
			gap: 1rem;
			align-items: center;
		}

		input[type="text"],
		select {
			width: 100%;
			padding: 0.5rem;
			border: 1px solid #ccc;
			border-radius: 4px;
		}

		.option-buttons button {
			padding: 0.5rem 1rem;
			border: 1px solid #ccc;
			background-color: white;
			cursor: pointer;
			border-radius: 4px;
		}

		.option-buttons button.active {
			border: 2px solid #f42b5b;
		}

		.image-preview {
			background-color: #f0f0f0;
			height: 100px;
			width: 150px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 8px;
			font-size: 0.9rem;
			color: #666;
		}

		.thumbnail-list {
			display: flex;
			gap: 1rem;
			margin-top: 0.5rem;
		}

		.thumbnail-list img {
			width: 60px;
			height: 60px;
			object-fit: cover;
			border-radius: 4px;
			border: 2px solid transparent;
		}

		.thumbnail-list img.selected {
			border-color: #f42b5b;
		}

		.slider-container {
			margin-top: 1rem;
		}

		input[type=range] {
			width: 100%;
		}

		.slider-values {
			display: flex;
			justify-content: space-between;
			font-size: 0.9rem;
			margin-top: 0.5rem;
		}

		.delivery-box {
			border: 2px solid #f42b5b;
			border-radius: 8px;
			padding: 1rem;
			margin-bottom: 1rem;
			background-color: #2e3c4d;
			color: white;
		}

		.delivery-box .best-value {
			color: gold;
			font-size: 0.8rem;
			margin-bottom: 0.5rem;
		}

		.design-options {
			display: flex;
			gap: 1rem;
			margin: 1rem 0;
		}

		.design-box {
			border: 1px solid #ccc;
			padding: 0.5rem;
			text-align: center;
			border-radius: 6px;
			flex: 1;
		}

		.btn-yellow {
			background-color: #ffcf00;
			border: none;
			padding: 0.75rem 1rem;
			width: 100%;
			font-weight: bold;
			cursor: pointer;
			border-radius: 6px;
			margin: 1rem 0;
		}

		.additional-links {
			font-size: 0.9rem;
			color: #555;
		}

		.additional-links a {
			color: #333;
			text-decoration: none;
		}

		.tab-container {
			margin-top: 1.5rem;
			background-color: #fff;
			border-radius: 8px;
			padding: 1.5rem;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
		}

		.tab-buttons {
			display: flex;
			gap: 0.5rem;
			margin-bottom: 1rem;
		}

		.tab-buttons button {
			padding: 0.5rem 1rem;
			border: 1px solid #ccc;
			background-color: #f5f7fa;
			cursor: pointer;
			border-radius: 4px;
			font-weight: 500;
		}

		.tab-buttons button.active {
			background-color: #f42b5b;
			color: white;
			border-color: #f42b5b;
		}

		.tab-content {
			display: none;
			padding: 1rem;
			background-color: #f9f9f9;
			border-radius: 4px;
		}

		.tab-content.active {
			display: block;
		}

		.custom-card-box {
			padding: 0 !important;
			margin: 0 !important;
		}

		.custom-card {
			height: 100%;
			border-radius: 0;
			display: flex;
			flex-direction: column;
			box-shadow: none;
			margin: 0;
			border: none;
		}

		.custom-image-box {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100%;
			padding: 10px;
			background-color: #a4a4a4;
		}

		.custom-image {
			max-width: 100%;
			max-height: 135px;
			object-fit: contain;
		}

		.card-body {
			padding: 10px;
		}

		.row-cols-1.row-cols-lg-2.row-cols-xl-3 {
			margin-left: 0 !important;
			margin-right: 0 !important;
		}
	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->make('layouts.includes.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
			<!--start information-->
			<section class="py-3 border-top border-bottom">
				<div class="container">
					<div class="row row-cols-1 row-cols-lg-3 row-group align-items-center">
						<div class="col p-3 border" style="">
							<div class="d-flex align-items-center">
								<div class="fs-1 text-black"> <i class='bx bx-taxi'></i>
								</div>
								<div class="info-box-content ps-3">
									<h6 class="mb-0">FREE SHIPPING &amp; RETURN</h6>
									<p class="mb-0">Free shipping on all orders over $49</p>
								</div>
							</div>
						</div>
						<div class="col p-3 border">
							<div class="d-flex align-items-center">
								<div class="fs-1 text-black"> <i class='bx bx-dollar-circle'></i>
								</div>
								<div class="info-box-content ps-3">
									<h6 class="mb-0">MONEY BACK GUARANTEE</h6>
									<p class="mb-0">100% money back guarantee</p>
								</div>
							</div>
						</div>
						<div class="col p-3 border">
							<div class="d-flex align-items-center">
								<div class="fs-1 text-black"> <i class='bx bx-support'></i>
								</div>
								<div class="info-box-content ps-3">
									<h6 class="mb-0">ONLINE SUPPORT 24/7</h6>
									<p class="mb-0">Awesome Support for 24/7 Days</p>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
				</div>
			</section>
			<!--end information-->
			<!--start pramotion-->
			<?php $indexsubcates = footerSubCategories(); ?>
			<?php if(isset($indexsubcates) && count($indexsubcates) > 0): ?>

				<section class="py-4">
					<div class="container">
						<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
							<?php $__currentLoopData = $indexsubcates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indexsubcate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col">
									<div class="card rounded-0" style="height: 160px;">
										<div class="col custom-card-box">
											<div class="card rounded-0 custom-card">
												<div class="row g-0 align-items-stretch h-100">
													<div class="col-6 custom-image-box">
														<img src="<?php echo e(asset('storage/' . $indexsubcate->thumbnail)); ?>"
															class="custom-image" alt="" />
													</div>
													<div class="col-6 d-flex align-items-center">
														<div class="card-body">
															<h5 class="card-title text-uppercase" style="font-size:16px;">
																<?php echo e($indexsubcate->name); ?>

															</h5>
															<p class="card-text text-uppercase">Starting at $9</p>
															<a href="<?php echo e(route('subcategory-details', ['slug' => $indexsubcate->slug])); ?>"
																class="btn btn-light btn-ecomm">Order Now</a>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


						</div>
						<!--end row-->
					</div>
				</section>
			<?php endif; ?>
			<!--end pramotion-->

			<!--start categories-->
			<?php if(isset($categories) && count($categories) > 0): ?>
				<section class="py-4">
					<div class="container">
						<div class="d-flex align-items-center">
							<h5 class="text-uppercase mb-0">Browse Catergory</h5>
							<a href="shop-categories.html" class="btn btn-light ms-auto rounded-0">View All<i
									class='bx bx-chevron-right'></i></a>
						</div>
						<hr />
						<div class="product-grid">
							<div class="browse-category owl-carousel owl-theme">
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="item">
										<div class="card rounded-0 product-card border" style="background-color: rgb(0 0 0 / 20%);">
											<div class="card-body c-img">
												<img src="<?php echo e(asset('storage/' . $category->image)); ?>" class="img-fluid" alt="...">
											</div>
											<div class="card-footer text-center" style="height:60px;">
												<h6 class="mb-1 text-uppercase text-gray"><?php echo e($category->name); ?></h6>
												<!-- <p class="mb-0 font-12 text-uppercase">10 Products</p> -->
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							</div>
						</div>
					</div>
				</section>
			<?php endif; ?>
			<div class="container py-5">

			</div>
			<!--end categories-->
			<!--start support info-->
			<section class="py-4 bg-dark-9">
				<div class="container">
					<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-group">
						<div class="col">
							<div class="text-center">
								<div class="font-50 text-black"> <i class='bx bx-cart'></i>
								</div>
								<h2 class="fs-5 text-uppercase mb-0">INSTANT QUOTE</h2>
								<p class="text-capitalize">Get Instant Quote in Your Email</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
									magna, et dapib.</p>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<div class="font-50 text-black"> <i class='bx bx-credit-card'></i>
								</div>
								<h2 class="fs-5 text-uppercase mb-0">HIGH QUALITY PRINTS</h2>
								<p class="text-capitalize">We do not compromise with Quality</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
									magna, et dapib.</p>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<div class="font-50 text-black"> <i class='bx bx-dollar-circle'></i>
								</div>
								<h2 class="fs-5 text-uppercase mb-0">SECURE PAYMENT</h2>
								<p class="text-capitalize">100% Secure Payment Options</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
									magna, et dapib.</p>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<div class="font-50 text-black"> <i class='bx bx-support'></i>
								</div>
								<h2 class="fs-5 text-uppercase mb-0">CUSTOMER SUPPORT</h2>
								<p class="text-capitalize">Friendly 24/7 customer support</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
									magna, et dapib.</p>
							</div>
						</div>
					</div>
					<!--end row-->
				</div>
			</section>
			<!--end support info-->
			<!--start News-->
			<section class="py-4">
				<div class="container">
					<div class="d-flex align-items-center">
						<h5 class="text-uppercase mb-0">Recent Blogs</h5>
						<a href="blogs" class="btn btn-light ms-auto rounded-0">View All Blogs<i
								class='bx bx-chevron-right'></i></a>
					</div>
					<hr />
					<div class="product-grid">
						<div class="latest-news owl-carousel owl-theme">
							<?php if(isset($blogs) && $blogs->count() > 0): ?>
								<?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="item">
										<div class="card rounded-0 product-card border">
											<div class="news-date">
												<div class="date-number"><?php echo e(\Carbon\Carbon::parse($blog->created_at)->format('d')); ?>

												</div>
												<div class="date-month"><?php echo e(\Carbon\Carbon::parse($blog->created_at)->format('M')); ?>

												</div>
											</div>
											<a href="<?php echo e(route('blogs.show', $blog->slug)); ?>">
												<img src="<?php echo e(asset('storage/' . $blog->thumbnail)); ?>"
													class="card-img-top border-bottom bg-dark-1" alt="<?php echo e($blog->title); ?>"
													height="200px">
											</a>
											<div class="card-body">
												<div class="news-title">
													<a href="<?php echo e(route('blogs.show', $blog->slug)); ?>">
														<h5 class="mb-3 text-capitalize"><?php echo e(Str::limit($blog->title, 50)); ?></h5>
													</a>
												</div>
												<p class="news-content mb-0"><?php echo e(Str::limit(strip_tags($blog->detail), 100)); ?></p>
											</div>
											
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<p class="text-muted">No blogs found.</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
			<!--end News-->
			<!--start brands-->
			<?php if(isset($categories) && count($categories) > 0): ?>
				<section class="py-4">
					<div class="container">
						<div class="d-flex align-items-center">
							<h5 class="text-uppercase mb-0">Catergory</h5>
							<a href="shop-categories.html" class="btn btn-light ms-auto rounded-0">View All<i
									class='bx bx-chevron-right'></i></a>
						</div>
						<hr />
						<div class="product-grid">
							<div class="browse-category owl-carousel owl-theme">
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="item">
										<div class="card rounded-0 product-card border">
											<div class="card-body c-img">
												<img src="<?php echo e(asset('storage/' . $category->image)); ?>" class="img-fluid" alt="...">
											</div>
											<div class="card-footer text-center" style="height:60px;">
												<h6 class="mb-1 text-uppercase text-gray"><?php echo e($category->name); ?></h6>
												<!-- <p class="mb-0 font-12 text-uppercase">10 Products</p> -->
											</div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



							</div>
						</div>
					</div>
				</section>
			<?php endif; ?>

		</div>
	</div>
	<!--end page wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/index.blade.php ENDPATH**/ ?>