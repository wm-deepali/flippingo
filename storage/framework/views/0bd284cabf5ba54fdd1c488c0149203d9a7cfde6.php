
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
                <li class="breadcrumb-item active">My Profile</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <div class="dropdown">
            <a href="<?php echo e(route('profile.setting')); ?>" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle">Edit Profile</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">My Profile</h4>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="profile-pic">
                <img src="<?php echo e(asset('images/profiles/'.$user->profile_img)); ?>" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <ul class="profile-content">
                <li><b>Name:</b> <span><?php echo e($user->name); ?></span></li>
                <li><b>Mobile Number:</b> <span><?php echo e($user->phone); ?></span></li>
                
                <li><b>Email Id:</b> <span><?php echo e($user->email); ?></span></li>
                <li><b>DOB:</b> <span><?php echo e($user->birth_date); ?></span></li>
                <li><b>Address:</b> <span><?php echo e($user->user_metas->address); ?></span></li>
                <li><b>About Me:</b> <span><?php echo e($user->user_metas->bio); ?></span></li>
                <li><b>Website:</b> <span><a href="<?php echo e($user->user_metas->website); ?>" target="_blank"><?php echo e($user->user_metas->website); ?></a></span></li>
                <li><b>Facebook:</b> <span><a href="<?php echo e($user->user_social_links->facebook); ?>" target="_blank"><?php echo e($user->user_social_links->facebook); ?></a></span></li>
                <li><b>Twitter:</b> <span><a href="<?php echo e($user->user_social_links->twitter); ?>" target="_blank"><?php echo e($user->user_social_links->twitter); ?></a></span></li>
                <li><b>Youtube:</b> <span><a href="<?php echo e($user->user_social_links->youtube); ?>" target="_blank"><?php echo e($user->user_social_links->youtube); ?></a></span></li>
                <li><b>Linkedin:</b> <span><a href="<?php echo e($user->user_social_links->linkedin); ?>" target="_blank"><?php echo e($user->user_social_links->linkedin); ?></a></span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/manage-profile/profile.blade.php ENDPATH**/ ?>