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

<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <form action="<?php echo e(route('admin.shipments')); ?>" method="GET" class="d-flex flex-wrap gap-2">
            <input type="text" name="search" class="form-control" style="width:220px;"
                placeholder="Search tracking/name/email..." value="<?php echo e($search ?? ''); ?>">
            <select name="status" class="form-control" style="width:180px;">
                <option value="">All Statuses</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['Order Confirmed','Picked by Courier','On The Way','Custom Hold','Delivered']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s); ?>" <?php echo e(($status ?? '') == $s ? 'selected' : ''); ?>><?php echo e($s); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Filter</button>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($search ?? '') || ($status ?? '')): ?>
                <a href="<?php echo e(route('admin.shipments')); ?>" class="btn btn-secondary">Clear</a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </form>
        <a href="<?php echo e(route('admin.shipments.create')); ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Create Shipment
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Manage Shipments</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>Tracking #</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Origin &rarr; Destination</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $shipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('admin.shipments.view', $shipment->id)); ?>" class="fw-bold">
                                    <?php echo e($shipment->trackingnumber); ?>

                                </a>
                            </td>
                            <td><?php echo e($shipment->sname); ?></td>
                            <td>
                                <?php echo e($shipment->name); ?>

                                <div class="small text-muted">
                                    <?php echo e($shipment->email); ?><br><?php echo e($shipment->phone); ?>

                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary"><?php echo e($shipment->take_off_point); ?></span>
                                <i class="bi bi-arrow-right mx-1"></i>
                                <span class="badge bg-secondary"><?php echo e($shipment->final_destination); ?></span>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($shipment->status == 'Delivered'): ?>
                                    <span class="badge bg-success"><?php echo e($shipment->status); ?></span>
                                <?php elseif($shipment->status == 'Custom Hold'): ?>
                                    <span class="badge bg-warning text-dark"><?php echo e($shipment->status); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-info text-dark"><?php echo e($shipment->status); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td><?php echo e(\Carbon\Carbon::parse($shipment->created_at)->toDayDateTimeString()); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.shipments.view', $shipment->id)); ?>" class="btn btn-info btn-sm me-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.shipments.update-status-form', $shipment->id)); ?>" class="btn btn-primary btn-sm me-1" title="Update Status">
                                    <i class="bi bi-truck"></i>
                                </a>
                                <a href="<?php echo e(route('admin.shipments.print', $shipment->id)); ?>" target="_blank" class="btn btn-secondary btn-sm me-1" title="Print">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <a href="<?php echo e(route('admin.delete.shipment', $shipment->id)); ?>" class="btn btn-danger btn-sm" title="Delete"
                                    onclick="return confirm('Delete this shipment?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-box-seam fs-1 text-muted d-block mb-2"></i>
                                No shipments found.
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($search ?? '') || ($status ?? '')): ?>
                                    <a href="<?php echo e(route('admin.shipments')); ?>" class="btn btn-sm btn-outline-primary ms-2">Clear Filters</a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('admin.shipments.create')); ?>" class="btn btn-sm btn-primary ms-2">Create Shipment</a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <?php echo e($shipments->appends(['search' => $search ?? '', 'status' => $status ?? ''])->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/shipments.blade.php ENDPATH**/ ?>