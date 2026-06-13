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

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">App Settings</h5>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="appSettingsTabs">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info">Website Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pref-tab" data-bs-toggle="tab" href="#pref">Preference</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="email-tab" data-bs-toggle="tab" href="#email">Email / Google</a>
            </li>
        </ul>

        <div class="tab-content">
            
            <div class="tab-pane fade show active" id="info">
                <form method="POST" action="<?php echo e(route('updatewebinfo')); ?>" enctype="multipart/form-data">
                    <?php echo method_field('PUT'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Website Name</label>
                            <input type="text" class="form-control" name="site_name" value="<?php echo e($settings->site_name); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website Title</label>
                            <input type="text" class="form-control" name="site_title" value="<?php echo e($settings->site_title); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website URL</label>
                            <input type="text" class="form-control" name="site_address" placeholder="https://yoursite.com" value="<?php echo e($settings->site_address); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Office Address</label>
                            <input type="text" class="form-control" name="locations" value="<?php echo e($settings->locations); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">WhatsApp Number <small class="text-danger">(leave empty to disable)</small></label>
                            <input type="text" class="form-control" name="whatsapp" value="<?php echo e($settings->whatsapp); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tido Livechat ID <small class="text-danger">(leave empty to disable)</small></label>
                            <input type="text" class="form-control" name="tido" value="<?php echo e($settings->tido); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Year Started</label>
                            <input type="text" class="form-control" name="twak" value="<?php echo e($settings->twak); ?>" placeholder="Year site started">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" name="contact_email" value="<?php echo e($settings->contact_email); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Favicon</label>
                            <input type="file" class="form-control" name="favicon" accept="image/*,.ico">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->favicon): ?>
                                <img src="<?php echo e(asset('storage/' . $settings->favicon)); ?>" class="mt-2" style="height:40px;" alt="favicon">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Site Logo</label>
                            <input type="file" class="form-control" name="logo" accept="image/*">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->logo ?? null): ?>
                                <img src="<?php echo e(asset('storage/' . $settings->logo)); ?>" class="mt-2" style="height:40px;" alt="logo">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Website Info
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            
            <div class="tab-pane fade" id="pref">
                <form method="POST" action="<?php echo e(route('updatepreference')); ?>" id="updatepreference">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Default Currency Symbol</label>
                            <input type="text" class="form-control" name="s_currency" value="<?php echo e($settings->s_currency); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Currency</label>
                            <input type="text" class="form-control" name="currency" value="<?php echo e($settings->currency); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Google Translate</label>
                            <select class="form-control" name="google_translate">
                                <option value="on" <?php echo e($settings->google_translate == 'on' ? 'selected' : ''); ?>>On</option>
                                <option value="off" <?php echo e($settings->google_translate == 'off' ? 'selected' : ''); ?>>Off</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Preferences
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            
            <div class="tab-pane fade" id="email">
                <form method="POST" action="<?php echo e(route('updateemailpreference')); ?>" id="emailform">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Mail Server</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="server" id="sendmailserver" value="sendmail" checked>
                                    <label class="form-check-label" for="sendmailserver">Sendmail</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="server" id="smtpserver" value="smtp">
                                    <label class="form-check-label" for="smtpserver">SMTP</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email From</label>
                            <input type="email" class="form-control" name="emailfrom" value="<?php echo e($settings->emailfrom); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email From Name</label>
                            <input type="text" class="form-control" name="emailfromname" value="<?php echo e($settings->emailfromname); ?>" required>
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Host</label>
                            <input type="text" class="form-control smtp-input" name="smtp_host" value="<?php echo e($settings->smtp_host); ?>">
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Port</label>
                            <input type="text" class="form-control smtp-input" name="smtp_port" value="<?php echo e($settings->smtp_port); ?>">
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Encryption</label>
                            <input type="text" class="form-control smtp-input" name="smtp_encrypt" value="<?php echo e($settings->smtp_encrypt); ?>">
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Username</label>
                            <input type="text" class="form-control smtp-input" name="smtp_user" value="<?php echo e($settings->smtp_user); ?>">
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Password</label>
                            <input type="password" class="form-control smtp-input" name="smtp_password" value="<?php echo e($settings->smtp_password); ?>">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Email Settings
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
    var sendmailRadio = document.getElementById('sendmailserver');
    var smtpRadio = document.getElementById('smtpserver');
    var smtpFields = document.querySelectorAll('.smtp');

    function toggleSmtp() {
        if (smtpRadio && smtpRadio.checked) {
            smtpFields.forEach(function(el) { el.classList.remove('d-none'); });
        } else {
            smtpFields.forEach(function(el) { el.classList.add('d-none'); });
        }
    }

    if (sendmailRadio) sendmailRadio.addEventListener('change', toggleSmtp);
    if (smtpRadio) smtpRadio.addEventListener('change', toggleSmtp);
    toggleSmtp();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/Settings/AppSettings/show.blade.php ENDPATH**/ ?>