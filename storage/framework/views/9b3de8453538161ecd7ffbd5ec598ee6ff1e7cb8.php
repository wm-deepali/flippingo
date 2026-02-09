

<?php $__env->startSection('title','Footer Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="app-content content">
  <div class="content-wrapper">

    
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active">Footer Settings</li>
        </ol>
      </div>
    </div>

    <div class="content-body">
      <form method="POST"
            action="<?php echo e(route('admin.footer-settings.store')); ?>"
            enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <?php
          $quick = collect(json_decode(setting('footer_menu_quick','[]'), true))->keyBy('key');
          $know  = collect(json_decode(setting('footer_menu_know','[]'), true))->keyBy('key');
          $help  = collect(json_decode(setting('footer_menu_help','[]'), true))->keyBy('key');
        ?>

        
        <div class="row">

          
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">
                  Contact Info <small class="text-muted">(Shown in footer)</small>
                </h4>
              </div>
              <div class="card-body">

                <div class="form-group">
                  <label>Footer Logo</label>
                  <input type="file" class="form-control-file" name="footer_logo">
                  <?php if(setting('footer_logo')): ?>
                    <img src="<?php echo e(asset('storage/'.setting('footer_logo'))); ?>"
                         class="mt-2"
                         style="max-height:90px;">
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name="footer_address"
                         value="<?php echo e(setting('footer_address')); ?>">
                </div>

                <div class="form-group">
                  <label>Helpline</label>
                  <input type="text" class="form-control" name="footer_helpline"
                         value="<?php echo e(setting('footer_helpline')); ?>">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="footer_email"
                         value="<?php echo e(setting('footer_email')); ?>">
                </div>

                <div class="form-group">
                  <label>WhatsApp</label>
                  <input type="text" class="form-control" name="footer_whatsapp"
                         value="<?php echo e(setting('footer_whatsapp')); ?>">
                </div>

              </div>
            </div>
          </div>

           <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">
                  Copyright Text <small class="text-muted">(Shown at the very bottom of the footer)</small>
                </h4>
              </div>
              <div class="card-body">


                <div class="form-group">
                  <label>Copyright</label>
                   <input type="text"
                   class="form-control"
                   name="footer_copyright"
                   value="<?php echo e(setting('footer_copyright','© '.date('Y').' Flippingo. All rights reserved.')); ?>">
                </div>

              </div>
            </div>
          </div>

        </div>

        
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
                      <th width="80">Order</th>
                    </tr>
                  </thead>
                  <tbody>

                    
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php $saved = ${$section}[$page['key']] ?? []; ?>
                      <tr>
                        <td>
                          <input type="checkbox"
                                 name="<?php echo e($section); ?>[<?php echo e($page['key']); ?>][active]"
                                 <?php echo e(!empty($saved['active']) ? 'checked' : ''); ?>>
                        </td>
                        <td>
                          <?php echo e($page['label']); ?>

                          <input type="hidden" name="<?php echo e($section); ?>[<?php echo e($page['key']); ?>][key]" value="<?php echo e($page['key']); ?>">
                          <input type="hidden" name="<?php echo e($section); ?>[<?php echo e($page['key']); ?>][label]" value="<?php echo e($page['label']); ?>">
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
                          <?php echo e($page['label']); ?>

                          <span class="badge badge-light">CMS</span>

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

        

        
        <div class="text-right mb-2">
          <button class="btn btn-success">
            Save Footer Settings
          </button>
        </div>

      </form>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/footer-settings/index.blade.php ENDPATH**/ ?>