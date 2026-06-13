<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
      <li class="nav-item d-none d-md-block">
        <a href="<?php echo e(url('/')); ?>" class="nav-link" target="_blank" title="View frontend site">
          <i class="bi bi-box-arrow-up-right me-1"></i>
          View Site
        </a>
      </li>
    </ul>
    <!--end::Start Navbar Links-->

    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">
      <!--begin::Fullscreen Toggle-->
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
        </a>
      </li>
      <!--end::Fullscreen Toggle-->

      <!--begin::Color Mode Toggle-->
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme"
          data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
          <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
          <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme" style="--bs-dropdown-min-width:8rem">
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
              <i class="bi bi-sun-fill me-2"></i> Light
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
              <i class="bi bi-moon-fill me-2"></i> Dark
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
              <i class="bi bi-circle-half me-2"></i> Auto
              <i class="bi bi-check-lg ms-auto d-none"></i>
            </button>
          </li>
        </ul>
      </li>
      <!--end::Color Mode Toggle-->

      <!--begin::User Menu-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle me-1"></i>
          <span class="d-none d-md-inline">
            <?php echo e(Auth('admin')->User()->firstName); ?> <?php echo e(Auth('admin')->User()->lastName); ?>

          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <li class="user-header text-bg-primary">
            <i class="bi bi-person-circle" style="font-size:3rem;"></i>
            <p>
              <?php echo e(Auth('admin')->User()->firstName); ?> <?php echo e(Auth('admin')->User()->lastName); ?>

              <small><?php echo e(Auth('admin')->User()->type); ?></small>
            </p>
          </li>
          <li class="user-footer">
            <a href="<?php echo e(url('admin/dashboard/adminprofile')); ?>" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-gear me-1"></i> Profile
            </a>
            <a href="<?php echo e(route('adminlogout')); ?>" class="btn btn-outline-danger btn-sm float-end"
              onclick="event.preventDefault(); document.getElementById('navbar-logout-form').submit();">
              <i class="bi bi-box-arrow-right me-1"></i> Sign out
            </a>
            <form id="navbar-logout-form" action="<?php echo e(route('adminlogout')); ?>" method="POST" class="d-none">
              <?php echo csrf_field(); ?>
            </form>
          </li>
        </ul>
      </li>
      <!--end::User Menu-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>
<!--end::Header-->
<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/admin/topmenu.blade.php ENDPATH**/ ?>