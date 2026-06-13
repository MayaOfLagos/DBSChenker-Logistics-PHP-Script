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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.shipments.store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<div class="card mb-3">
    <div class="card-header"><h5 class="card-title mb-0">Sender Information</h5></div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Sender Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="sname" value="<?php echo e(old('sname')); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sender Email</label>
                <input type="email" class="form-control" name="semail" value="<?php echo e(old('semail')); ?>">
                <small class="text-muted">Optional: for notifications to sender</small>
            </div>
            <div class="col-md-12">
                <label class="form-label">Sender Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="saddress" rows="2" required><?php echo e(old('saddress')); ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Origin Location <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="take_off_point" value="<?php echo e(old('take_off_point')); ?>" required>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header"><h5 class="card-title mb-0">Receiver Information</h5></div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Receiver Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Receiver Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Receiver Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Destination Location <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="final_destination" value="<?php echo e(old('final_destination')); ?>" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Receiver Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" rows="2" required><?php echo e(old('address')); ?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header"><h5 class="card-title mb-0">Shipment Details</h5></div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="qty" min="1" value="<?php echo e(old('qty', 1)); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Weight (kg)</label>
                <input type="number" step="0.01" class="form-control" name="weight" value="<?php echo e(old('weight')); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Dimensions (LxWxH)</label>
                <input type="text" class="form-control" name="dimensions" placeholder="e.g. 30x20x15 cm" value="<?php echo e(old('dimensions')); ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Shipment Photo</label>
                <input type="file" class="form-control" name="photo">
            </div>
            <div class="col-md-12">
                <label class="form-label">Package Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="3" required><?php echo e(old('description')); ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Shipping Method <span class="text-danger">*</span></label>
                <select class="form-control" name="freight_type" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['Road' => 'Road Transport','Air' => 'Air Freight','Sea' => 'Sea Freight','Rail' => 'Rail Transport','Multimodal' => 'Multimodal Transport']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($val); ?>" <?php echo e(old('freight_type') == $val ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Shipment Status <span class="text-danger">*</span></label>
                <select class="form-control" name="status" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['Order Confirmed','Picked by Courier','On The Way','Custom Hold','Delivered','Approved','Available','Pending']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php echo e(old('status') == $s ? 'selected' : ''); ?>><?php echo e($s); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date Shipped <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" name="date_shipped" value="<?php echo e(old('date_shipped')); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Expected Delivery Date <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" name="expected_delivery" value="<?php echo e(old('expected_delivery')); ?>" required>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header"><h5 class="card-title mb-0 text-danger">Cost &amp; Payment</h5></div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-danger">Shipping Cost <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><?php echo e($settings->s_currency); ?></span>
                    <input type="number" step="0.01" class="form-control" id="cost" name="cost" value="<?php echo e(old('cost', 0)); ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-danger">Clearance Cost <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><?php echo e($settings->s_currency); ?></span>
                    <input type="number" step="0.01" class="form-control" id="clearance_cost" name="clearance_cost" value="<?php echo e(old('clearance_cost', 0)); ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Total Cost</label>
                <div class="input-group">
                    <span class="input-group-text"><?php echo e($settings->s_currency); ?></span>
                    <input type="text" class="form-control" id="total_cost" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-danger">Payment Status <span class="text-danger">*</span></label>
                <select class="form-control" name="cstatus" required>
                    <option value="Paid" <?php echo e(old('cstatus') == 'Paid' ? 'selected' : ''); ?>>Paid</option>
                    <option value="Unpaid" <?php echo e(old('cstatus') == 'Unpaid' ? 'selected' : ''); ?>>Unpaid</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label">Delivery Percentage Completed</label>
                <input type="number" class="form-control" name="percentage_complete" value="<?php echo e(old('percentage_complete', 0)); ?>" min="0" max="100">
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Create Shipment</button>
    <a href="<?php echo e(route('admin.shipments')); ?>" class="btn btn-secondary"><i class="bi bi-x-circle me-1"></i> Cancel</a>
</div>

</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    function calcTotal() {
        var s = parseFloat($('#cost').val()) || 0;
        var c = parseFloat($('#clearance_cost').val()) || 0;
        $('#total_cost').val((s + c).toFixed(2));
    }
    $('#cost, #clearance_cost').on('input', calcTotal);
    calcTotal();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/create-shipment.blade.php ENDPATH**/ ?>