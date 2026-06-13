<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Session::has('success')): ?>
    <div class="d-none" data-admin-toast="success" data-admin-message="<?php echo e(Session::get('success')); ?>"></div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/components/success-alert.blade.php ENDPATH**/ ?>