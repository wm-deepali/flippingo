

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

    .left, .right {
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

    input[type="text"], select {
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
    <style>
        
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
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">
			<div class="page-content">
				<!--start breadcrumb-->
				<section class="py-3 border-bottom d-none d-md-flex">
					<div class="container">
						<div class="page-breadcrumb d-flex align-items-center">
							<h3 class="breadcrumb-title pe-3"><?php echo e($subcategory->name); ?></h3>
							<div class="ms-auto">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb mb-0 p-0">
										<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
										</li>
										<!-- <li class="breadcrumb-item"><a href="javascript:;">Shop</a>
										</li> -->
										<li class="breadcrumb-item active" aria-current="page">Product Details</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</section>
				
				<!--start product detail-->
				<section class="py-4">
					<div class="container">
						<div class="product-detail-card">
							<div class="product-detail-body">
								<div class="row g-0">
									<div class="col-12 col-lg-5">
										<div class="image-zoom-section">
										    <?php $galleries = $subcategory->gallery; ?>
				                            <?php if(isset($galleries) && count($galleries)>0): ?>
											<div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
											    <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y=>$gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											    
												<div class="item">
													<img src="<?php echo e(asset('storage/'.$gallery)); ?>" class="img-fluid" alt="">
												</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
							
											</div>
											<?php endif; ?>
											<?php if(isset($galleries) && count($galleries)>0): ?>
											<div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
											    <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y=>$gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<button class="owl-thumb-item">
													<img src="<?php echo e(asset('storage/'.$gallery)); ?>" class="" alt="">
												</button>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</div>
											<?php endif; ?>
										</div>
									</div>
									<div class="col-12 col-lg-7">
										<div class="product-info-section p-3">
											<h3 class="mt-3 mt-lg-0 mb-0"><?php echo e($subcategory->name); ?></h3>
											
											<div class="mt-3">
												<h6>Discription :</h6>
												<p class="mb-0"><?php echo e($subcategory->description); ?></p>
											</div>
											
											<div class="row row-cols-auto align-items-center mt-3">
												
											</div>
											
										</div>
									</div>
								</div>
								<!--end row-->
							</div>
						</div>
					</div>
				</section>
				</div>
		</div>
		<div class="container py-5">
	<?php if($subcategory->calculator_required): ?>
			<?php echo $__env->make('front.calculator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>


    <div class="tab-container">
       <div class="tab-buttons">
        <button class="active" data-tab="tab-information">Information</button>
        <button data-tab="tab-available-size">Available Sizes</button>
        <button data-tab="tab-binding-options">Binding Options</button>
        <button data-tab="tab-paper-types">Paper Types</button>
        <button data-tab="tab-faqs">FAQs</button>
      </div>
      <div class="tab-content active" id="tab-specifications">
        <h4>Information</h4>
        <p><?php echo $subcategory->details->information; ?></p>
      </div>
      <div class="tab-content" id="tab-available-size">
        <h4>Available Sizes</h4>
        <p><?php echo $subcategory->details->available_sizes; ?></p>
      </div>
      <div class="tab-content" id="tab-binding-options">
        <h4>Binding Options</h4>
        <p><?php echo $subcategory->details->binding_options; ?></p>
      </div>
      <div class="tab-content" id="tab-paper-types">
        <h4>Paper Types</h4>
       <p><?php echo $subcategory->details->paper_types; ?></p>
      </div>
      <div class="tab-content" id="tab-faqs">
        <h4>Frequently Asked Questions</h4>
        <p>Common questions about booklet printing, delivery, and customization options.</p>
      </div>
     
    </div>
  </div>
    <section class="py-4">
					<div class="container">
						<div class="d-flex align-items-center">
							<h5 class="text-uppercase mb-0">Related Product</h5>
							<a href="" class="btn btn-light ms-auto rounded-0">View All<i
									class='bx bx-chevron-right'></i></a>
						</div>
						<hr />
						<div class="product-grid">
							<div class="browse-category owl-carousel owl-theme">
								<div class="item">
									<div class="card rounded-0 product-card border" style="background-color: rgb(0 0 0 / 20%);">
										<div class="card-body c-img">
											<img src="<?php echo e(URL::asset('assets/images/booklets.png')); ?>" class="img-fluid" alt="...">
										</div>
										<div class="card-footer text-center">
											<h6 class="mb-1 text-uppercase text-gray"><?php echo e($subcategory->name); ?></h6>
											<!-- <p class="mb-0 font-12 text-uppercase">10 Products</p> -->
										</div>
									</div>
								</div>
								<div class="item">
									<div class="card rounded-0 product-card border">
										<div class="card-body c-img">
											<img src="<?php echo e(URL::asset('assets/images/brochure.png')); ?>" class="img-fluid" alt="...">
										</div>
										<div class="card-footer text-center">
											<h6 class="mb-1 text-uppercase text-gray">Brochures</h6>
											<!-- <p class="mb-0 font-12 text-uppercase">8 Products</p> -->
										</div>
									</div>
								</div>
								<div class="item">
									<div class="card rounded-0 product-card border">
										<div class="card-body c-img">
											<img src="<?php echo e(URL::asset('assets/images/Catalog.png')); ?>" class="img-fluid" alt="...">
										</div>
										<div class="card-footer text-center">
											<h6 class="mb-1 text-uppercase text-gray">Catalogues</h6>
											<!-- <p class="mb-0 font-12 text-uppercase">14 Products</p> -->
										</div>
									</div>
								</div>
								<div class="item">
									<div class="card rounded-0 product-card border">
										<div class="card-body c-img">
											<img src="<?php echo e(URL::asset('assets/images/magzin.png')); ?>" class="img-fluid" alt="...">
										</div>
										<div class="card-footer text-center">
											<h6 class="mb-1 text-uppercase text-gray">Magazines</h6>
											<!-- <p class="mb-0 font-12 text-uppercase">6 Products</p> -->
										</div>
									</div>
								</div>
								<div class="item">
									<div class="card rounded-0 product-card border">
										<div class="card-body c-img">
											<img src="<?php echo e(URL::asset('assets/images/business.png')); ?>" class="img-fluid" alt="...">
										</div>
										<div class="card-footer text-center">
											<h6 class="mb-1 text-uppercase text-gray">Business Cards</h6>
											<!-- <p class="mb-0 font-12 text-uppercase">6 Products</p> -->
										</div>
									</div>
								</div>
								<div class="item">
									<div class="card rounded-0 product-card border">
										<div class="card-body c-img">
											<img src="<?php echo e(URL::asset('assets/images/magzin.png')); ?>" class="img-fluid" alt="...">
										</div>
										<div class="card-footer text-center">
											<h6 class="mb-1 text-uppercase text-gray">Magazines</h6>
											<!-- <p class="mb-0 font-12 text-uppercase">6 Products</p> -->
										</div>
									</div>
								</div>
								
								
								
								

							</div>
						</div>
					</div>
				</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/front/subcategory-detail.blade.php ENDPATH**/ ?>