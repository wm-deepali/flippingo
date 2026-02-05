

<?php $__env->startSection('title', 'Header Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>

  <div class="content-wrapper">

    
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo e(route('admin.home')); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
            Header Settings
          </li>
        </ol>
      </div>
    </div>

    
    <div class="content-body">
      <form method="POST"
            action="<?php echo e(route('admin.header-settings.store')); ?>"
            enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="row">

          
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Header Logo</h4>
              </div>
              <div class="card-body">
                <input type="file"
                       name="header_logo"
                       class="form-control">

                <?php if(setting('header_logo')): ?>
                  <div class="mt-2">
                    <img src="<?php echo e(asset('storage/'.setting('header_logo'))); ?>"
                         height="50">
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Select Header Pages</h4>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Show</th>
                      <th>Page</th>
                      <th>Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $saved = collect(json_decode(setting('header_menu','[]'), true))
                                ->keyBy('key');
                    ?>

                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php $conf = $saved[$page['key']] ?? []; ?>
                      <tr>
                        <td>
                          <input type="checkbox"
                                 name="menu[<?php echo e($page['key']); ?>][active]"
                                 value="1"
                                 <?php echo e(!empty($conf['active']) ? 'checked' : ''); ?>>
                        </td>
                      <td>
  <?php echo e($page['label']); ?>


  <input type="hidden"
         name="menu[<?php echo e($page['key']); ?>][key]"
         value="<?php echo e($page['key']); ?>">

  <input type="hidden"
         name="menu[<?php echo e($page['key']); ?>][label]"
         value="<?php echo e($page['label']); ?>">
</td>

                        <td width="120">
                          <input type="number"
                                 name="menu[<?php echo e($page['key']); ?>][order]"
                                 class="form-control"
                                 value="<?php echo e($conf['order'] ?? 0); ?>">
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>

              <div class="card-footer text-right">
                <button class="btn btn-success">
                  Save Header
                </button>
              </div>

            </div>
          </div>

        </div>
      </form>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/header-settings/index.blade.php ENDPATH**/ ?>