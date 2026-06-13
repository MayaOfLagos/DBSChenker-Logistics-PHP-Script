<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Session::has('error')): ?>
    <div class="d-none" data-admin-toast="error" data-admin-message="<?php echo e(Session::get('error')); ?>"></div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  
<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/components/danger-alert.blade.php ENDPATH**/ ?>