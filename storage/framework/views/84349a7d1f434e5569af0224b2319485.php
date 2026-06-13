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
        <ul class="mb-0">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.shipments.update')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<input type="hidden" name="id" value="<?php echo e($shipment->id); ?>">

<?php
    $shipmentPhoto = $shipment->photo ?? null;
    $shipmentPhotoUrl = $shipmentPhoto
        ? (\Illuminate\Support\Str::startsWith($shipmentPhoto, 'shipment_photos/')
            ? asset($shipmentPhoto)
            : asset('storage/' . ltrim($shipmentPhoto, '/')))
        : null;
?>


<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0"><i class="bi bi-upc-scan me-2"></i>Tracking &amp; Status</h5>
        <a href="<?php echo e(route('admin.shipments')); ?>" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
    <div class="card-body text-center">
        <div class="mb-3">
            <img id="barcode-img"
                src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo e($shipment->trackingnumber); ?>&code=Code128"
                alt="<?php echo e($shipment->trackingnumber); ?>" class="img-fluid" style="max-height:80px;">
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-md-6">
                <label class="form-label">Tracking Number</label>
                <input type="text" class="form-control" id="trackingnumber" name="trackingnumber"
                    value="<?php echo e(old('trackingnumber', $shipment->trackingnumber)); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select class="form-control" name="status">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['Order Confirmed','Picked by Courier','On The Way','Custom Hold','Delivered']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php echo e($shipment->status == $s ? 'selected' : ''); ?>><?php echo e($s); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <small class="text-muted">Use Update Status page to send notifications.</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Sender Information</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Sender Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sname" value="<?php echo e(old('sname', $shipment->sname)); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sender Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="saddress" rows="3" required><?php echo e(old('saddress', $shipment->saddress)); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Origin Office <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="take_off_point" value="<?php echo e(old('take_off_point', $shipment->take_off_point)); ?>" required>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Receiver Information</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Receiver Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="<?php echo e(old('name', $shipment->name)); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Receiver Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" value="<?php echo e(old('email', $shipment->email)); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Receiver Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone', $shipment->phone)); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Receiver Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="address" rows="3" required><?php echo e(old('address', $shipment->address)); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Destination Office <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="final_destination" value="<?php echo e(old('final_destination', $shipment->final_destination)); ?>" required>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Shipment Details</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="qty" min="1" value="<?php echo e(old('qty', $shipment->qty)); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="4" required><?php echo e(old('description', $shipment->description)); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Shipment Photo</label>
                    <input type="file" class="form-control" name="photo">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($shipmentPhotoUrl): ?>
                        <div class="mt-2">
                            <img src="<?php echo e($shipmentPhotoUrl); ?>" class="img-thumbnail" style="max-height:120px;" alt="Current photo">
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Cost Information</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Shipping Cost (<?php echo e($settings->s_currency); ?>) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="cost" name="cost" value="<?php echo e(old('cost', $shipment->cost)); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Clearance Cost (<?php echo e($settings->s_currency); ?>) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="clearance_cost" name="clearance_cost" value="<?php echo e(old('clearance_cost', $shipment->clearance_cost)); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Cost (<?php echo e($settings->s_currency); ?>)</label>
                    <input type="text" class="form-control" id="total_cost" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update Shipment</button>
    <a href="<?php echo e(route('admin.shipments.view', $shipment->id)); ?>" class="btn btn-secondary"><i class="bi bi-x-circle me-1"></i> Cancel</a>
</div>

</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function calcTotal() {
        var s = parseFloat(document.getElementById('cost').value) || 0;
        var c = parseFloat(document.getElementById('clearance_cost').value) || 0;
        document.getElementById('total_cost').value = (s + c).toFixed(2);
    }
    document.getElementById('cost').addEventListener('input', calcTotal);
    document.getElementById('clearance_cost').addEventListener('input', calcTotal);
    calcTotal();

    document.getElementById('trackingnumber').addEventListener('input', function() {
        var t = this.value.trim();
        if (t) {
            document.getElementById('barcode-img').src =
                'https://barcode.tec-it.com/barcode.ashx?data=' + encodeURIComponent(t) + '&code=Code128';
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/edit-shipment.blade.php ENDPATH**/ ?>