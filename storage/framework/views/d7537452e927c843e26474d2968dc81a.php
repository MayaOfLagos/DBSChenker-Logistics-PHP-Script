<?php $__env->startComponent('mail::message'); ?>
# <?php echo new \Illuminate\Support\EncodedHtmlString($salutation ?? "Hello"); ?> <?php echo new \Illuminate\Support\EncodedHtmlString($recipient); ?>,

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($attachment): ?>
    <img src="<?php echo new \Illuminate\Support\EncodedHtmlString($message->embed(asset('storage/' . $attachment))); ?>">
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php echo $body; ?>


Thanks,<br>
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/emails/NewNotification.blade.php ENDPATH**/ ?>