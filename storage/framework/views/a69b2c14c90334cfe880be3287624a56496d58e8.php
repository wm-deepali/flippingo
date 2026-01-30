

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
                <li class="breadcrumb-item">
                  <a href="<?php echo e(route('home')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                  Home Page Content
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <button form="homeContentForm" class="btn btn-primary btn-round btn-sm">
            Save Changes
          </button>
        </div>
      </div>
    </div>

    
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">

          <form id="homeContentForm"
                method="POST"
                action="<?php echo e(route('admin.home-page-content.update')); ?>">
            <?php echo csrf_field(); ?>

            <?php $__currentLoopData = $defaultSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $section = $sections[$key] ?? null;
              ?>

              <div class="card mb-2">
                <div class="card-header bg-light">
                  <h5 class="card-title mb-0">
                    <?php echo e($label); ?>

                  </h5>
                </div>

                <div class="card-body row mt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Title</label>
                      <input
                        type="text"
                        class="form-control"
                        name="sections[<?php echo e($key); ?>][title]"
                        value="<?php echo e(old("sections.$key.title", $section->title ?? '')); ?>"
                        placeholder="Enter section title"
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea
                        class="form-control"
                        name="sections[<?php echo e($key); ?>][description]"
                        rows="3"
                        placeholder="Enter section description"
                      ><?php echo e(old("sections.$key.description", $section->description ?? '')); ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="text-right mt-2">
              <button type="submit" class="btn btn-primary">
                💾 Save Home Page Content
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/cms/home-page-content.blade.php ENDPATH**/ ?>