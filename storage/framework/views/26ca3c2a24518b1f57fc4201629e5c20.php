<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginaled105bf70c3e22a88a2552d72e27fae5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled105bf70c3e22a88a2552d72e27fae5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.danger-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('danger-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled105bf70c3e22a88a2552d72e27fae5)): ?>
<?php $attributes = $__attributesOriginaled105bf70c3e22a88a2552d72e27fae5; ?>
<?php unset($__attributesOriginaled105bf70c3e22a88a2552d72e27fae5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled105bf70c3e22a88a2552d72e27fae5)): ?>
<?php $component = $__componentOriginaled105bf70c3e22a88a2552d72e27fae5; ?>
<?php unset($__componentOriginaled105bf70c3e22a88a2552d72e27fae5); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginale9af99bfa2d53af14a65b48d2181bd41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9af99bfa2d53af14a65b48d2181bd41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.success-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('success-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9af99bfa2d53af14a65b48d2181bd41)): ?>
<?php $attributes = $__attributesOriginale9af99bfa2d53af14a65b48d2181bd41; ?>
<?php unset($__attributesOriginale9af99bfa2d53af14a65b48d2181bd41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9af99bfa2d53af14a65b48d2181bd41)): ?>
<?php $component = $__componentOriginale9af99bfa2d53af14a65b48d2181bd41; ?>
<?php unset($__componentOriginale9af99bfa2d53af14a65b48d2181bd41); ?>
<?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></ul>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<div class="row g-3">
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Shipment Info</h5></div>
            <div class="card-body text-center">
                <img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo e($shipment->trackingnumber); ?>&code=Code128"
                    alt="<?php echo e($shipment->trackingnumber); ?>" class="img-fluid mb-2" style="max-height:70px;">
                <div class="fw-bold font-monospace mb-2"><?php echo e($shipment->trackingnumber); ?></div>
                <table class="table table-bordered table-sm text-start">
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($shipment->status == 'Delivered'): ?>
                                <span class="badge bg-success"><?php echo e($shipment->status); ?></span>
                            <?php elseif($shipment->status == 'Custom Hold'): ?>
                                <span class="badge bg-warning text-dark"><?php echo e($shipment->status); ?></span>
                            <?php else: ?>
                                <span class="badge bg-info text-dark"><?php echo e($shipment->status); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                    </tr>
                    <tr><th>Sender</th><td><?php echo e($shipment->sname); ?></td></tr>
                    <tr><th>Receiver</th><td><?php echo e($shipment->name); ?></td></tr>
                    <tr><th>Origin</th><td><?php echo e($shipment->take_off_point); ?></td></tr>
                    <tr><th>Destination</th><td><?php echo e($shipment->final_destination); ?></td></tr>
                    <tr><th>Created</th><td><?php echo e(\Carbon\Carbon::parse($shipment->created_at)->toDayDateTimeString()); ?></td></tr>
                </table>
                <a href="<?php echo e(route('admin.shipments.view', $shipment->id)); ?>" class="btn btn-info btn-sm w-100 mt-2">
                    <i class="bi bi-eye me-1"></i> View Full Details
                </a>
            </div>
        </div>
    </div>

    
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Update Status</h5></div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('admin.shipments.update-status')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="shipment_id" value="<?php echo e($shipment->id); ?>">
                    <div class="mb-3">
                        <label class="form-label">New Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="" disabled selected>Select Status</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['Order Confirmed','Picked by Courier','On The Way','Custom Hold','Delivered']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s); ?>" <?php echo e(old('status') == $s ? 'selected' : ''); ?>><?php echo e($s); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="location" value="<?php echo e(old('location')); ?>" required>
                        <small class="text-muted">Enter the current location of the shipment</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comment / Details <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="comment" rows="4" required><?php echo e(old('comment')); ?></textarea>
                        <small class="text-muted">This will be visible to the customer</small>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="notify_customer" value="1" id="notify_customer" checked>
                        <label class="form-check-label" for="notify_customer">Send email notification to customer</label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Status History</h5></div>
            <div class="card-body">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="me-3 mt-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($track->status == 'Delivered'): ?>
                                <span class="badge bg-success"><i class="bi bi-check-lg"></i></span>
                            <?php elseif($track->status == 'Custom Hold'): ?>
                                <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle"></i></span>
                            <?php else: ?>
                                <span class="badge bg-info text-dark"><i class="bi bi-truck"></i></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div>
                            <div class="fw-semibold"><?php echo e($track->status); ?></div>
                            <div class="text-muted small">
                                <i class="bi bi-geo-alt me-1"></i><?php echo e($track->address); ?>

                                &nbsp;&mdash;&nbsp;
                                <i class="bi bi-clock me-1"></i><?php echo e(\Carbon\Carbon::parse($track->created_at)->format('M d, Y - h:i A')); ?>

                            </div>
                            <div><?php echo e($track->comment); ?></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted text-center">No status updates yet.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/update-shipment-status.blade.php ENDPATH**/ ?>