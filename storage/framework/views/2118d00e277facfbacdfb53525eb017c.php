<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <?php
    $admin = Auth::guard('admin')->user();
  ?>
  <style>
    .app-sidebar .brand-image {
      width: 42px;
      height: 42px;
      object-fit: contain;
    }

    .app-sidebar .nav-link {
      padding-top: .72rem;
      padding-bottom: .72rem;
    }

    .app-sidebar .nav-icon {
      font-size: 1.15rem;
      width: 1.6rem;
      text-align: center;
    }

    .app-sidebar .nav-arrow {
      font-size: .92rem;
      margin-left: auto;
    }

    .app-sidebar .nav-header {
      padding-top: 1rem;
      padding-bottom: .35rem;
      font-size: .72rem;
      letter-spacing: .08em;
    }

    .app-sidebar .nav-treeview .nav-link {
      padding-left: 2.75rem;
    }
  </style>
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <a href="<?php echo e(url('/admin/dashboard')); ?>" class="brand-link">
      <img src="<?php echo e(asset('storage/' . ($settings->logo ?? 'logo.png'))); ?>"
        alt="<?php echo e($settings->site_name); ?>"
        class="brand-image opacity-75 shadow"
        onerror="this.style.display='none'">
    </a>
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2" aria-label="Admin navigation">
      <ul class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        data-accordion="false"
        id="admin-navigation">

        
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/dashboard')); ?>"
            class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($admin && in_array($admin->type, ['Super Admin', 'Admin'], true)): ?>
          <li class="nav-header">OPERATIONS</li>
          <li class="nav-item">
            <a href="<?php echo e(route('admin.shipments')); ?>"
              class="nav-link <?php echo e(request()->routeIs('admin.shipments') || request()->routeIs('admin.shipments.view') || request()->routeIs('admin.shipments.update-status') ? 'active' : ''); ?>">
              <i class="nav-icon bi bi-truck"></i>
              <p>Manage Shipments</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('admin.shipments.create')); ?>"
              class="nav-link <?php echo e(request()->routeIs('admin.shipments.create') ? 'active' : ''); ?>">
              <i class="nav-icon bi bi-box-seam"></i>
              <p>Create Shipment</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/dashboard/mdeposits')); ?>"
              class="nav-link <?php echo e(request()->is('admin/dashboard/mdeposits') ? 'active' : ''); ?>">
              <i class="nav-icon bi bi-cash-stack"></i>
              <p>Shipment Deposits</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(route('emailservices')); ?>"
              class="nav-link <?php echo e(request()->routeIs('emailservices') ? 'active' : ''); ?>">
              <i class="nav-icon bi bi-envelope-at"></i>
              <p>Email Services</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/dashboard/customers')); ?>"
              class="nav-link <?php echo e(request()->routeIs('customer') ? 'active' : ''); ?>">
              <i class="nav-icon bi bi-people"></i>
              <p>Customers</p>
            </a>
          </li>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($admin && $admin->type === 'Super Admin'): ?>

          <li class="nav-header">ADMINISTRATION</li>
          <li class="nav-item <?php echo e(request()->routeIs('addmanager') || request()->routeIs('madmin') ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e(request()->routeIs('addmanager') || request()->routeIs('madmin') ? 'active' : ''); ?>">
              <i class="nav-icon bi bi-person-gear"></i>
              <p>
                Administrators
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('/admin/dashboard/addmanager')); ?>"
                  class="nav-link <?php echo e(request()->routeIs('addmanager') ? 'active' : ''); ?>">
                  <i class="nav-icon bi bi-person-plus"></i>
                  <p>Add Manager</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('/admin/dashboard/madmin')); ?>"
                  class="nav-link <?php echo e(request()->routeIs('madmin') ? 'active' : ''); ?>">
                  <i class="nav-icon bi bi-person-lines-fill"></i>
                  <p>Manage Admins</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">CONFIGURATION</li>
          <?php
            $settingsActive = request()->routeIs('appsettingshow')
              || request()->routeIs('paymentview')
              || request()->routeIs('frontpage')
              || request()->routeIs('termspolicy');
          ?>
          <li class="nav-item <?php echo e($settingsActive ? 'menu-open' : ''); ?>">
            <a href="#" class="nav-link <?php echo e($settingsActive ? 'active' : ''); ?>">
              <i class="nav-icon bi bi-gear-wide-connected"></i>
              <p>
                Settings
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('appsettingshow')); ?>"
                  class="nav-link <?php echo e(request()->routeIs('appsettingshow') ? 'active' : ''); ?>">
                  <i class="nav-icon bi bi-sliders"></i>
                  <p>App Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('paymentview')); ?>"
                  class="nav-link <?php echo e(request()->routeIs('paymentview') ? 'active' : ''); ?>">
                  <i class="nav-icon bi bi-credit-card"></i>
                  <p>Payment Settings</p>
                </a>
              </li>
            </ul>
          </li>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <li class="nav-header">ACCOUNT</li>

        
        <li class="nav-item">
          <a href="<?php echo e(url('admin/dashboard/adminprofile')); ?>"
            class="nav-link <?php echo e(request()->is('admin/dashboard/adminprofile') ? 'active' : ''); ?>">
            <i class="nav-icon bi bi-person-circle"></i>
            <p>My Profile</p>
          </a>
        </li>

        
        <li class="nav-item">
          <a href="<?php echo e(url('admin/dashboard/adminchangepassword')); ?>"
            class="nav-link <?php echo e(request()->is('admin/dashboard/adminchangepassword') ? 'active' : ''); ?>">
            <i class="nav-icon bi bi-key"></i>
            <p>Change Password</p>
          </a>
        </li>

        
        <li class="nav-item">
          <a href="<?php echo e(route('adminlogout')); ?>" class="nav-link"
            onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
            <i class="nav-icon bi bi-box-arrow-left"></i>
            <p>Logout</p>
          </a>
          <form id="sidebar-logout-form" action="<?php echo e(route('adminlogout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
          </form>
        </li>

      </ul>
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/sidebar.blade.php ENDPATH**/ ?>