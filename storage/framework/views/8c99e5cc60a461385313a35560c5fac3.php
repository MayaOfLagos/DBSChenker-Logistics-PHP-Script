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


<div class="d-flex flex-wrap gap-2 mb-3">
    <a href="<?php echo e(route('admin.shipments')); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
    <a href="<?php echo e(route('admin.shipments.update-status-form', $shipment->id)); ?>" class="btn btn-info"><i class="bi bi-truck me-1"></i> Update Status</a>
    <a href="<?php echo e(route('admin.shipments.edit', $shipment->id)); ?>" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
    <a href="<?php echo e(route('admin.shipments.print', $shipment->id)); ?>" target="_blank" class="btn btn-secondary"><i class="bi bi-printer me-1"></i> Print</a>
    <a href="<?php echo e(route('admin.delete.shipment', $shipment->id)); ?>" class="btn btn-danger"
        onclick="return confirm('Delete this shipment?')"><i class="bi bi-trash me-1"></i> Delete</a>
</div>


<div class="card mb-3">
    <div class="card-body text-center">
        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo e($shipment->trackingnumber); ?>&code=Code128"
            alt="<?php echo e($shipment->trackingnumber); ?>" class="img-fluid mb-2" style="max-height:80px;">
        <div class="fw-bold font-monospace fs-5"><?php echo e($shipment->trackingnumber); ?></div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($shipment->status == 'Delivered'): ?>
            <span class="badge bg-success fs-6"><?php echo e($shipment->status); ?></span>
        <?php elseif($shipment->status == 'Custom Hold'): ?>
            <span class="badge bg-warning text-dark fs-6"><?php echo e($shipment->status); ?></span>
        <?php else: ?>
            <span class="badge bg-info text-dark fs-6"><?php echo e($shipment->status); ?></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="text-muted mt-1 small">
            Created on <?php echo e(\Carbon\Carbon::parse($shipment->created_at)->format('F d, Y \a\t h:i A')); ?>

        </div>
    </div>
</div>

<?php
    $shipmentPhoto = $shipment->photo ?? null;
    $shipmentPhotoUrl = $shipmentPhoto
        ? (\Illuminate\Support\Str::startsWith($shipmentPhoto, 'shipment_photos/')
            ? asset($shipmentPhoto)
            : asset('storage/' . ltrim($shipmentPhoto, '/')))
        : null;
?>

<div class="row g-3 mb-3">
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Sender Information</h5></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th style="width:35%">Name:</th><td><?php echo e($shipment->sname); ?></td></tr>
                    <tr><th>Address:</th><td><?php echo e($shipment->saddress); ?></td></tr>
                    <tr><th>Origin:</th><td><?php echo e($shipment->take_off_point); ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Receiver Information</h5></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th style="width:35%">Name:</th><td><?php echo e($shipment->name); ?></td></tr>
                    <tr><th>Email:</th><td><a href="mailto:<?php echo e($shipment->email); ?>"><?php echo e($shipment->email); ?></a></td></tr>
                    <tr><th>Phone:</th><td><a href="tel:<?php echo e($shipment->phone); ?>"><?php echo e($shipment->phone); ?></a></td></tr>
                    <tr><th>Address:</th><td><?php echo e($shipment->address); ?></td></tr>
                    <tr><th>Destination:</th><td><?php echo e($shipment->final_destination); ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Package Details</h5></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th style="width:35%">Quantity:</th><td><?php echo e($shipment->qty); ?></td></tr>
                    <tr><th>Description:</th><td><?php echo e($shipment->description); ?></td></tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($shipment->photo): ?>
                    <tr><th>Photo:</th><td>
                        <a href="<?php echo e($shipmentPhotoUrl); ?>" target="_blank">
                            <img src="<?php echo e($shipmentPhotoUrl); ?>" class="img-thumbnail" style="max-height:150px;">
                        </a>
                    </td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Cost Information</h5></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th style="width:50%">Shipping Cost:</th><td><?php echo e($settings->s_currency); ?> <?php echo e(number_format($shipment->cost, 2)); ?></td></tr>
                    <tr><th>Clearance Cost:</th><td><?php echo e($settings->s_currency); ?> <?php echo e(number_format($shipment->clearance_cost, 2)); ?></td></tr>
                    <tr class="table-active fw-bold"><th>Total Cost:</th><td><?php echo e($settings->s_currency); ?> <?php echo e(number_format($shipment->cost + $shipment->clearance_cost, 2)); ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Tracking History</h5></div>
    <div class="card-body">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="d-flex mb-3 pb-3 border-bottom">
                <div class="me-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($track->status == 'Delivered'): ?>
                        <span class="badge bg-success p-2"><i class="bi bi-check-lg fs-5"></i></span>
                    <?php elseif($track->status == 'Custom Hold'): ?>
                        <span class="badge bg-warning text-dark p-2"><i class="bi bi-exclamation-triangle fs-5"></i></span>
                    <?php else: ?>
                        <span class="badge bg-info text-dark p-2"><i class="bi bi-truck fs-5"></i></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div>
                    <div class="text-muted small"><?php echo e(\Carbon\Carbon::parse($track->created_at)->format('F d, Y - h:i A')); ?></div>
                    <div class="fw-bold"><?php echo e($track->status); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($track->address): ?>
                            <span class="text-muted fw-normal ms-2"><i class="bi bi-geo-alt"></i> <?php echo e($track->address); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div><?php echo e($track->comment); ?></div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-center text-muted">No tracking history found.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/view-shipment.blade.php ENDPATH**/ ?>