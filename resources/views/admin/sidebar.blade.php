<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  @php
    $admin = Auth::guard('admin')->user();
  @endphp
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
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
      <img src="{{ asset('storage/' . ($settings->logo ?? 'logo.png')) }}"
        alt="{{ $settings->site_name }}"
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

        {{-- Dashboard --}}
        <li class="nav-item">
          <a href="{{ url('/admin/dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
          </a>
        </li>

        @if ($admin && in_array($admin->type, ['Super Admin', 'Admin'], true))
          <li class="nav-header">OPERATIONS</li>
          <li class="nav-item">
            <a href="{{ route('admin.shipments') }}"
              class="nav-link {{ request()->routeIs('admin.shipments') || request()->routeIs('admin.shipments.view') || request()->routeIs('admin.shipments.update-status') ? 'active' : '' }}">
              <i class="nav-icon bi bi-truck"></i>
              <p>Manage Shipments</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.shipments.create') }}"
              class="nav-link {{ request()->routeIs('admin.shipments.create') ? 'active' : '' }}">
              <i class="nav-icon bi bi-box-seam"></i>
              <p>Create Shipment</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/dashboard/mdeposits') }}"
              class="nav-link {{ request()->is('admin/dashboard/mdeposits') ? 'active' : '' }}">
              <i class="nav-icon bi bi-cash-stack"></i>
              <p>Shipment Deposits</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('emailservices') }}"
              class="nav-link {{ request()->routeIs('emailservices') ? 'active' : '' }}">
              <i class="nav-icon bi bi-envelope-at"></i>
              <p>Email Services</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/dashboard/customers') }}"
              class="nav-link {{ request()->routeIs('customer') ? 'active' : '' }}">
              <i class="nav-icon bi bi-people"></i>
              <p>Customers</p>
            </a>
          </li>
        @endif

        {{-- Administrators (Super Admin only) --}}
        @if ($admin && $admin->type === 'Super Admin')

          <li class="nav-header">ADMINISTRATION</li>
          <li class="nav-item {{ request()->routeIs('addmanager') || request()->routeIs('madmin') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('addmanager') || request()->routeIs('madmin') ? 'active' : '' }}">
              <i class="nav-icon bi bi-person-gear"></i>
              <p>
                Administrators
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/dashboard/addmanager') }}"
                  class="nav-link {{ request()->routeIs('addmanager') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-person-plus"></i>
                  <p>Add Manager</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/dashboard/madmin') }}"
                  class="nav-link {{ request()->routeIs('madmin') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-person-lines-fill"></i>
                  <p>Manage Admins</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">CONFIGURATION</li>
          @php
            $settingsActive = request()->routeIs('appsettingshow')
              || request()->routeIs('paymentview')
              || request()->routeIs('frontpage')
              || request()->routeIs('termspolicy');
          @endphp
          <li class="nav-item {{ $settingsActive ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $settingsActive ? 'active' : '' }}">
              <i class="nav-icon bi bi-gear-wide-connected"></i>
              <p>
                Settings
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('appsettingshow') }}"
                  class="nav-link {{ request()->routeIs('appsettingshow') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-sliders"></i>
                  <p>App Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('paymentview') }}"
                  class="nav-link {{ request()->routeIs('paymentview') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-credit-card"></i>
                  <p>Payment Settings</p>
                </a>
              </li>
            </ul>
          </li>

        @endif

        {{-- Divider --}}
        <li class="nav-header">ACCOUNT</li>

        {{-- Profile --}}
        <li class="nav-item">
          <a href="{{ url('admin/dashboard/adminprofile') }}"
            class="nav-link {{ request()->is('admin/dashboard/adminprofile') ? 'active' : '' }}">
            <i class="nav-icon bi bi-person-circle"></i>
            <p>My Profile</p>
          </a>
        </li>

        {{-- Change Password --}}
        <li class="nav-item">
          <a href="{{ url('admin/dashboard/adminchangepassword') }}"
            class="nav-link {{ request()->is('admin/dashboard/adminchangepassword') ? 'active' : '' }}">
            <i class="nav-icon bi bi-key"></i>
            <p>Change Password</p>
          </a>
        </li>

        {{-- Logout --}}
        <li class="nav-item">
          <a href="{{ route('adminlogout') }}" class="nav-link"
            onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
            <i class="nav-icon bi bi-box-arrow-left"></i>
            <p>Logout</p>
          </a>
          <form id="sidebar-logout-form" action="{{ route('adminlogout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>

      </ul>
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
