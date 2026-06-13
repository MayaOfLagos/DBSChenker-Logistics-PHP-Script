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

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Update Payment Method</h5>
                <a href="<?php echo e(route('paymentview')); ?>" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
            <div class="card-body">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->name == 'USDT'): ?>
                    <div class="alert alert-info">
                        For USDT withdrawals via Binance with automatic mode, whitelist users' IP addresses on your Binance merchant dashboard. Collect IPs from user login activities.
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form method="POST" action="<?php echo e(route('updatemethod')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="id" value="<?php echo e($method->id); ?>">

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->defaultpay == 'yes'): ?>
                                <input type="text" class="form-control" name="name" value="<?php echo e($method->name); ?>" readonly>
                            <?php else: ?>
                                <input type="text" class="form-control" name="name" value="<?php echo e($method->name); ?>" required>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->name == 'Credit Card'): ?>
                                <small class="text-muted">Ensure you have selected a credit card provider from payment preference tab.</small>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Minimum Amount <small class="text-muted">(withdrawal only)</small></label>
                            <input type="number" class="form-control" name="minimum" value="<?php echo e($method->minimum); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Maximum Amount <small class="text-muted">(withdrawal only)</small></label>
                            <input type="number" class="form-control" name="maximum" value="<?php echo e($method->maximum); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Charges <small class="text-muted">(withdrawal only)</small></label>
                            <input type="number" class="form-control" name="charges" value="<?php echo e($method->charges_amount); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Charges Type</label>
                            <select class="form-control" name="chargetype" required>
                                <option value="<?php echo e($method->charges_type); ?>"><?php echo e($method->charges_type); ?></option>
                                <option value="percentage">Percentage (%)</option>
                                <option value="fixed">Fixed (<?php echo e($settings->currency); ?>)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Type</label>
                            <select class="form-control" name="methodtype" id="methodtype" required>
                                <option value="<?php echo e($method->methodtype); ?>"><?php echo e($method->methodtype); ?></option>
                                <option value="currency">Currency</option>
                                <option value="crypto">Crypto</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image URL</label>
                            <input type="text" class="form-control" name="url" value="<?php echo e($method->img_url); ?>">
                        </div>

                        
                        <div class="col-md-6 currency-field">
                            <label class="form-label">Bank Name</label>
                            <input type="text" class="form-control currinput" name="bank" value="<?php echo e($method->bankname); ?>">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label">Account Name</label>
                            <input type="text" class="form-control currinput" name="account_name" value="<?php echo e($method->account_name); ?>">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label">Account Number</label>
                            <input type="number" class="form-control currinput" name="account_number" value="<?php echo e($method->account_number); ?>">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label">Swift / Other Code</label>
                            <input type="text" class="form-control currinput" name="swift" value="<?php echo e($method->swift_code); ?>">
                        </div>

                        
                        <div class="col-md-6 crypto-field d-none">
                            <label class="form-label">Wallet Address</label>
                            <input type="text" class="form-control cryptoinput" name="walletaddress" value="<?php echo e($method->wallet_address); ?>">
                        </div>
                        <div class="col-md-6 crypto-field d-none">
                            <label class="form-label">Barcode Image</label>
                            <input type="file" class="form-control" name="barcode" accept="image/*">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->barcode): ?>
                                <img src="<?php echo e(asset('storage/' . ltrim($method->barcode, '/'))); ?>" class="img-thumbnail mt-2" style="max-height:90px;" alt="Current barcode">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-md-6 crypto-field d-none">
                            <label class="form-label">Network Type</label>
                            <input type="text" class="form-control cryptoinput" name="wallettype" value="<?php echo e($method->network); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($method->name, ['USDT','BUSD'])): ?>
                                <small class="text-muted">USDT: TRC20 | BUSD: ERC20 for automatic payments.</small>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="<?php echo e($method->status); ?>"><?php echo e($method->status); ?></option>
                                <option value="enabled">Enable</option>
                                <option value="disabled">Disable</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Type For</label>
                            <select class="form-control" name="typefor" required>
                                <option value="<?php echo e($method->type); ?>"><?php echo e($method->type); ?></option>
                                <option value="withdrawal">Withdrawal</option>
                                <option value="deposit">Deposit</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Optional Note</label>
                            <input type="text" class="form-control" name="note" value="<?php echo e($method->duration); ?>" placeholder="Payment may take up to 24 hours">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var methodtype = document.getElementById('methodtype');
    var currencyFields = document.querySelectorAll('.currency-field');
    var cryptoFields = document.querySelectorAll('.crypto-field');
    var currinputs = document.querySelectorAll('.currinput');
    var cryptoinputs = document.querySelectorAll('.cryptoinput');

    function toggleFields() {
        if (methodtype.value === 'currency') {
            currencyFields.forEach(function(el) { el.classList.remove('d-none'); });
            cryptoFields.forEach(function(el) { el.classList.add('d-none'); });
            currinputs[0] && currinputs[0].setAttribute('required', '');
            currinputs[1] && currinputs[1].setAttribute('required', '');
            currinputs[2] && currinputs[2].setAttribute('required', '');
            cryptoinputs.forEach(function(el) { el.removeAttribute('required'); });
        } else {
            currencyFields.forEach(function(el) { el.classList.add('d-none'); });
            cryptoFields.forEach(function(el) { el.classList.remove('d-none'); });
            currinputs.forEach(function(el) { el.removeAttribute('required'); });
            cryptoinputs[0] && cryptoinputs[0].setAttribute('required', '');
            cryptoinputs[2] && cryptoinputs[2].setAttribute('required', '');
        }
    }

    methodtype.addEventListener('change', toggleFields);
    toggleFields();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/Settings/PaymentSettings/editpaymethod.blade.php ENDPATH**/ ?>