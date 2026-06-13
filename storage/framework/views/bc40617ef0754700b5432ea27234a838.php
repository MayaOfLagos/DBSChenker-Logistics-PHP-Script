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

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Managers List</h5>
        <a href="<?php echo e(route('addmanager')); ?>" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Add Manager
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($admin->id); ?></td>
                            <td><?php echo e($admin->firstName); ?></td>
                            <td><?php echo e($admin->lastName); ?></td>
                            <td><?php echo e($admin->email); ?></td>
                            <td><?php echo e($admin->phone); ?></td>
                            <td><?php echo e($admin->type); ?></td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($admin->acnt_type_active == 'blocked'): ?>
                                    <span class="badge bg-danger">Blocked</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Active</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($admin->acnt_type_active == null || $admin->acnt_type_active == 'blocked'): ?>
                                            <li><a class="dropdown-item text-success" href="<?php echo e(url('admin/dashboard/unblock')); ?>/<?php echo e($admin->id); ?>">Unblock</a></li>
                                        <?php else: ?>
                                            <li><a class="dropdown-item text-danger" href="<?php echo e(url('admin/dashboard/ublock')); ?>/<?php echo e($admin->id); ?>">Block</a></li>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resetModal<?php echo e($admin->id); ?>">Reset Password</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($admin->id); ?>">Edit</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mailModal<?php echo e($admin->id); ?>">Send Email</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($admin->id); ?>">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        
                        <div id="resetModal<?php echo e($admin->id); ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reset Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Reset password for <strong><?php echo e($admin->firstName); ?></strong> to <span class="text-primary fw-bold">admin01236</span>?</p>
                                    <a class="btn btn-danger" href="<?php echo e(url('admin/dashboard/resetadpwd')); ?>/<?php echo e($admin->id); ?>">Reset Now</a>
                                </div>
                            </div></div>
                        </div>

                        
                        <div id="deleteModal<?php echo e($admin->id); ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Manager</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Delete <strong><?php echo e($admin->firstName); ?></strong>?</p>
                                    <a class="btn btn-danger" href="<?php echo e(url('admin/dashboard/deleletadmin')); ?>/<?php echo e($admin->id); ?>">Yes, Delete</a>
                                </div>
                            </div></div>
                        </div>

                        
                        <div id="editModal<?php echo e($admin->id); ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Manager</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="<?php echo e(route('editadmin')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="user_id" value="<?php echo e($admin->id); ?>">
                                        <div class="mb-2"><label class="form-label">First Name</label>
                                            <input class="form-control" type="text" name="fname" value="<?php echo e($admin->firstName); ?>" required></div>
                                        <div class="mb-2"><label class="form-label">Last Name</label>
                                            <input class="form-control" type="text" name="l_name" value="<?php echo e($admin->lastName); ?>" required></div>
                                        <div class="mb-2"><label class="form-label">Email</label>
                                            <input class="form-control" type="email" name="email" value="<?php echo e($admin->email); ?>" required></div>
                                        <div class="mb-2"><label class="form-label">Phone</label>
                                            <input class="form-control" type="text" name="phone" value="<?php echo e($admin->phone); ?>" required></div>
                                        <div class="mb-3"><label class="form-label">Type</label>
                                            <select class="form-control" name="type">
                                                <option><?php echo e($admin->type); ?></option>
                                                <option>Super Admin</option>
                                                <option>Admin</option>
                                                <option>Conversion Agent</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-info">Update Account</button>
                                    </form>
                                </div>
                            </div></div>
                        </div>

                        
                        <div id="mailModal<?php echo e($admin->id); ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Send Email to <?php echo e($admin->firstName); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="<?php echo e(route('sendmailtoadmin')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="user_id" value="<?php echo e($admin->id); ?>">
                                        <div class="mb-3"><label class="form-label">Subject</label>
                                            <input type="text" name="subject" class="form-control" required></div>
                                        <div class="mb-3"><label class="form-label">Message</label>
                                            <textarea class="form-control" name="message" rows="4" required></textarea></div>
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </form>
                                </div>
                            </div></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>$(document).ready(function(){ $('#ShipTable').DataTable({ responsive: true }); });</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/madmin.blade.php ENDPATH**/ ?>