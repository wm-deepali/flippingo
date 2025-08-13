

<?php $__env->startSection('content'); ?>
  <div class="app-content content">
    <div class="content-wrapper">
    <div class="content-header row mb-2">
      <div class="col-md-6">
      <h4>Centralized Paper Pricing</h4>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
      <div class="card-body">

        
        <ul class="nav nav-tabs" id="pricingTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="sra3-counts-tab" data-toggle="tab" href="#sra3-counts" role="tab">SRA3
          Counts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pricing-rules-tab" data-toggle="tab" href="#paper-rates" role="tab">Paper
          Rates</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="sra3-counts-tab" data-toggle="tab" href="#paper-weight-rates" role="tab">Paper
          Weight Rates</a>
        </li>
        </ul>

        
        <div class="tab-content" id="pricingTabContent">

        
        <div class="tab-pane fade show active" id="sra3-counts" role="tabpanel">
          <div class="mb-2 text-right">
          <?php if(!isset($sra3Counts)): ?>
        <a href="<?php echo e(route('admin.sra3-sheets.create', $attribute->id)); ?>" class="btn btn-primary btn-sm">
        Add SRA3 Counts
        </a>
      <?php else: ?>
        <a href="<?php echo e(route('admin.sra3-sheets.edit', $attribute->id)); ?>" class="btn btn-primary btn-sm">
        Edit SRA3 Counts
        </a>
      <?php endif; ?>
          </div>

          <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-light">
            <tr>
              <th>Value</th>
              <th>No of Sheets made from 1 SRA3 Sheet</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($val->value); ?></td>
          <td><?php echo e($sra3Counts[$val->id]->sheet_count ?? 'Not Set'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          </div>
        </div>

        
        <div class="tab-pane fade" id="paper-rates" role="tabpanel">
          <div class="mb-2 text-right">
          <?php if($paperSizePricing->isEmpty()): ?>
        <a href="<?php echo e(route('admin.paper-rates.create')); ?>" class="btn btn-primary btn-sm">
        ＋ Add Paper Rates
        </a>
      <?php else: ?>
        <a href="<?php echo e(route('admin.paper-rates.edit', $attribute->id)); ?>" class="btn btn-primary btn-sm">
        Edit Paper Rates
        </a>
      <?php endif; ?>
          </div>

          <?php if($paperSizePricing->isEmpty()): ?>
        <p>No pricing data for paper size found.</p>
      <?php else: ?>

        <?php $__currentLoopData = $paperSizePricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-3 border shadow-sm">
        <div class="card-body">
        <h6 class="text-primary">Dependencies:</h6>
        <ul>
        <?php $__currentLoopData = $rule->dependencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><strong><?php echo e($dep->attribute->name); ?>:</strong> <?php echo e($dep->value->value); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <h6 class="text-success">Quantity Ranges:</h6>
        <table class="table table-sm table-bordered">
        <thead class="thead-light">
        <tr>
        <th>From</th>
        <th>To</th>
        <th>Price (SRA3 sheets)</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $rule->quantityRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
        <td><?php echo e($range->quantity_from); ?></td>
        <td><?php echo e($range->quantity_to); ?></td>
        <td>£ <?php echo e(number_format($range->price, 2)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
        </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
        </div>

        
        <div class="tab-pane fade" id="paper-weight-rates" role="tabpanel">
          <div class="mb-2 text-right">
          <?php if($paperWeightPricing->isEmpty()): ?>
        <a href="<?php echo e(route('admin.paper-weight-rates.create')); ?>" class="btn btn-primary btn-sm">
        ＋ Add Paper Weight Rate
        </a>
      <?php else: ?>
        <a href="<?php echo e(route('admin.paper-weight-rates.edit', $paperWeight->id)); ?>" class="btn btn-primary btn-sm">
        Edit Paper Weight Rates
        </a>
      <?php endif; ?>
          </div>

          <?php if($paperWeightPricing->isEmpty()): ?>
        <p>No pricing data for paper weight.</p>
      <?php else: ?>

        <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-light">
          <tr>
          <th>Main Attribute</th>
          <th>Value</th>
          <th>Dependencies</th>
          <th>Price (Per 1000 SRA3 sheets)</th>
          </tr>
          </thead>
          <tbody>
          <?php $__currentLoopData = $paperWeightPricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($rule['attribute']['name'] ?? '-'); ?></td>
          <td><?php echo e($rule['value']['value'] ?? '-'); ?></td>
          <td>
          <?php if(!empty($rule['dependencies'])): ?>
        <ul class="pl-3 mb-0">
          <?php $__currentLoopData = $rule['dependencies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><strong><?php echo e($dep['attribute']['name'] ?? '-'); ?>:</strong>
        <?php echo e($dep['value']['value'] ?? '-'); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php else: ?>
        No dependencies
        <?php endif; ?>
          </td>
          <td>£ <?php echo e(number_format($rule['price'], 2)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        </div>

      <?php endif; ?>
        </div>


        </div> 

      </div>
      </div>
    </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
    $(document).ready(function () {
    // Show tab from URL hash on page load
    var hash = window.location.hash;
    if (hash) {
      $('#pricingTab a[href="' + hash + '"]').tab('show');
    }

    // Update hash in URL when tab is clicked
    $('#pricingTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      history.replaceState(null, null, e.target.hash);
    });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/centralized-paper-pricing/index.blade.php ENDPATH**/ ?>