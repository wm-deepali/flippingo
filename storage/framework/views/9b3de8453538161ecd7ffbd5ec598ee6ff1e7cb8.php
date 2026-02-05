

<?php $__env->startSection('title','Footer Menu Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="app-content content">
  <div class="content-wrapper">

    
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">Footer Menus</li>
        </ol>
      </div>
    </div>

    <div class="content-body">
      <form method="POST" action="<?php echo e(route('admin.footer-settings.store')); ?>">
        <?php echo csrf_field(); ?>

        <?php
          $quick = collect(json_decode(setting('footer_menu_quick','[]'), true))->keyBy('key');
          $know  = collect(json_decode(setting('footer_menu_know','[]'), true))->keyBy('key');
          $help  = collect(json_decode(setting('footer_menu_help','[]'), true))->keyBy('key');
        ?>

        <div class="row">

          <?php $__currentLoopData = [
            'quick' => 'Quick Links',
            'know'  => 'Know More',
            'help'  => 'Help & Support'
          ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><?php echo e($title); ?></h4>
              </div>

              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Show</th>
                      <th>Page</th>
                      <th width="90">Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $saved = ${$section}[$page['key']] ?? [];
                      ?>
                      <tr>
                        <td>
                          <input type="checkbox"
                                 name="<?php echo e($section); ?>[<?php echo e($page['key']); ?>][active]"
                                 <?php echo e(!empty($saved['active']) ? 'checked' : ''); ?>>
                        </td>
                        <td>
                          <?php echo e($page['label']); ?>

                          <input type="hidden"
                                 name="<?php echo e($section); ?>[<?php echo e($page['key']); ?>][key]"
                                 value="<?php echo e($page['key']); ?>">
                          <input type="hidden"
                                 name="<?php echo e($section); ?>[<?php echo e($page['key']); ?>][label]"
                                 value="<?php echo e($page['label']); ?>">
                        </td>
                        <td>
                          <input type="number"
                                 class="form-control"
                                 name="<?php echo e($section); ?>[<?php echo e($page['key']); ?>][order]"
                                 value="<?php echo e($saved['order'] ?? 0); ?>">
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
<?php $__currentLoopData = $cmsPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php
    $uniqueKey = $page['key'].'_'.$page['param'];
    $saved = ${$section}[$uniqueKey] ?? [];
  ?>
  <tr>
    <td>
      <input type="checkbox"
             name="<?php echo e($section); ?>[<?php echo e($uniqueKey); ?>][active]"
             <?php echo e(!empty($saved['active']) ? 'checked' : ''); ?>>
    </td>

    <td>
      <?php echo e($page['label']); ?> <span class="badge badge-light">CMS</span>

      <input type="hidden" name="<?php echo e($section); ?>[<?php echo e($uniqueKey); ?>][key]" value="<?php echo e($page['key']); ?>">
      <input type="hidden" name="<?php echo e($section); ?>[<?php echo e($uniqueKey); ?>][param]" value="<?php echo e($page['param']); ?>">
      <input type="hidden" name="<?php echo e($section); ?>[<?php echo e($uniqueKey); ?>][label]" value="<?php echo e($page['label']); ?>">
    </td>

    <td>
      <input type="number"
             class="form-control"
             name="<?php echo e($section); ?>[<?php echo e($uniqueKey); ?>][order]"
             value="<?php echo e($saved['order'] ?? 0); ?>">
    </td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <div class="text-right mt-2">
          <button class="btn btn-success">
            Save Footer Menus
          </button>
        </div>

      </form>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/footer-settings/index.blade.php ENDPATH**/ ?>