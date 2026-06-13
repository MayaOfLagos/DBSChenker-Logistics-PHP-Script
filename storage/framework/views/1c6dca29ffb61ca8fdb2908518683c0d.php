<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(\App\Models\Settings::find(1)?->site_name ?? config('app.name')); ?></title>
    <?php $favicon = \App\Models\Settings::find(1)?->favicon; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($favicon): ?>
        <link rel="icon" href="<?php echo e(asset('storage/' . $favicon)); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-50 text-gray-900">
    <div id="app"></div>
</body>
</html>
<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/app.blade.php ENDPATH**/ ?>