
<?php $__env->startComponent('mail::message'); ?>
# Hello <?php echo new \Illuminate\Support\EncodedHtmlString($foramin  ? 'Admin' : $user->name); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($foramin): ?>
 This is to inform you of a successfull Deposit of <?php echo new \Illuminate\Support\EncodedHtmlString($settings->currency.$deposit->amount); ?> from <?php echo new \Illuminate\Support\EncodedHtmlString($user->name); ?>. <?php echo new \Illuminate\Support\EncodedHtmlString($deposit->status == "Processed" ? '' : ' Please login to process it.'); ?>

<?php else: ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($deposit->status == 'Processed'): ?>
This is to inform you that your deposit of <?php echo new \Illuminate\Support\EncodedHtmlString($settings->currency.$deposit->amount); ?> have been received and confirmed. Your account balance have been credited with the specified amount.
<?php else: ?>
This is to inform you that your deposit of <?php echo new \Illuminate\Support\EncodedHtmlString($settings->currency.$deposit->amount); ?> is successful, please wait while we confirm your deposit. You will receive a notification regarding the status of this transaction.
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
Thanks,
<br>
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>

<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/emails/success-deposit.blade.php ENDPATH**/ ?>