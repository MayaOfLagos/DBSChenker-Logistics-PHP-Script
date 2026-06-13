<?php $__env->startSection('content'); ?>

  
  <div class="d-flex align-items-center flex-column flex-md-row mb-4">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin'): ?>
      <div class="ms-md-auto mt-3 mt-md-0">
        <a href="<?php echo e(route('admin.shipments.create')); ?>" class="btn btn-success me-2">
          <i class="bi bi-plus-circle me-1"></i> Create Shipment
        </a>
        <a href="<?php echo e(route('admin.shipments')); ?>" class="btn btn-danger">
          <i class="bi bi-truck me-1"></i> Manage Shipments
        </a>
      </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>

  
  <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
      <div class="small-box text-bg-primary">
        <div class="inner">
          <h3><?php echo e(number_format($numberOfUsers)); ?></h3>
          <p>Total Shipments</p>
        </div>
        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M8 16a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H8Zm0 2h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v10a4 4 0 0 0 4 4Z"/>
        </svg>
        <a href="<?php echo e(route('admin.shipments')); ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
          View All <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="small-box text-bg-success">
        <div class="inner">
          <h3><?php echo e(number_format($active_users)); ?></h3>
          <p>Active Shipments</p>
        </div>
        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
        </svg>
        <a href="<?php echo e(route('admin.shipments')); ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
          View All <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="small-box text-bg-warning">
        <div class="inner">
          <h3><?php echo e(number_format($blockedusers)); ?></h3>
          <p>On Hold</p>
        </div>
        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
        </svg>
        <a href="<?php echo e(route('admin.shipments')); ?>" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
          View All <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="small-box text-bg-danger">
        <div class="inner">
          <h3><?php echo e(number_format($subscribers)); ?></h3>
          <p>Active Plans</p>
        </div>
        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
        </svg>
        <a href="<?php echo e(route('admin.shipments')); ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
          View All <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
      </div>
    </div>
  </div>

  
  <div class="row g-3">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Shipment Statistics</h5>
          <span class="badge text-bg-primary"><?php echo e(now()->format('Y')); ?></span>
        </div>
        <div class="card-body">
          <canvas id="lineChart" style="min-height:250px;"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Latest Shipments</h5>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $latestUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <a href="<?php echo e(route('viewuser', ['id' => $user->id])); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                  <div class="fw-semibold"><?php echo e($user->trackingnumber); ?></div>
                  <small class="text-muted"><?php echo e($user->email); ?></small>
                </div>
                <i class="bi bi-arrow-right text-muted"></i>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <li class="list-group-item text-muted text-center py-4">No shipments yet.</li>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  // Shipment statistics line chart (Chart.js 4)
  const userStats = <?php echo e(Illuminate\Support\Js::from($usersData)); ?>;
  new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets: [{
        label: 'Shipments Made',
        data: userStats,
        borderColor: '#007bff',
        backgroundColor: 'rgba(0,123,255,0.1)',
        pointBackgroundColor: '#007bff',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointRadius: 4,
        fill: true,
        tension: 0.3,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'bottom', labels: { color: '#666' } },
        tooltip: { mode: 'nearest', intersect: false }
      },
      layout: { padding: 15 }
    }
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>