<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
  <!--begin::Theme Init (prevents flash of incorrect theme)-->
  <script>
    (() => {
      'use strict';
      const stored = localStorage.getItem('lte-theme');
      const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
      const resolved = (stored === 'dark' || stored === 'light') ? stored : (prefersDark ? 'dark' : 'light');
      document.documentElement.setAttribute('data-bs-theme', resolved);
      document.documentElement.style.colorScheme = resolved;
    })();
  </script>
  <!--end::Theme Init-->

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta name="color-scheme" content="light dark">
  <title><?php echo e($settings->site_name); ?> | <?php echo e($title); ?></title>
  <link rel="icon" href="<?php echo e(asset('storage/' . $settings->favicon)); ?>" type="image/png" />

  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
  <!--end::Fonts-->

  <!--begin::OverlayScrollbars CSS-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
  <!--end::OverlayScrollbars CSS-->

  <!--begin::Bootstrap Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
  <!--end::Bootstrap Icons-->

  <!--begin::FontAwesome (kept for page content icons)-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">
  <!--end::FontAwesome-->

  <!--begin::AdminLTE CSS-->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/css/adminlte.min.css')); ?>">
  <!--end::AdminLTE CSS-->

  <!--begin::DataTables-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
  <!--end::DataTables-->

  <!--begin::Select2-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" crossorigin="anonymous">
  <!--end::Select2-->

  <?php echo $__env->yieldPushContent('style'); ?>
  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <script><?php echo $settings->tawk_to; ?></script>

  <!--begin::App Wrapper-->
  <div class="app-wrapper">

    <!--begin::Header-->
    <?php echo $__env->make('admin.topmenu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!--end::Header-->

    <!--begin::Sidebar-->
    <?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0"><?php echo e($title ?? 'Dashboard'); ?></h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>">Home</a></li>
                <li class="breadcrumb-item active"><?php echo e($title ?? 'Dashboard'); ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!--end::App Content Header-->

      <!--begin::App Content-->
      <div class="app-content">
        <div class="container-fluid">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
      <!--end::App Content-->
    </main>
    <!--end::App Main-->

    <!--begin::Footer-->
    <footer class="app-footer">
      <div class="float-end d-none d-sm-inline">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->google_translate == 'on'): ?>
          <div id="google_translate_element"></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
      <strong>All Rights Reserved &copy; <?php echo e($settings->site_name); ?> <?php echo e(date('Y')); ?></strong>
    </footer>
    <!--end::Footer-->

  </div>
  <!--end::App Wrapper-->

  <!--begin::Scripts-->
  <!--begin::jQuery-->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" crossorigin="anonymous"></script>
  <!--end::jQuery-->

  <!--begin::OverlayScrollbars JS-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
  <!--end::OverlayScrollbars JS-->

  <!--begin::Popper + Bootstrap 5-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <!--end::Popper + Bootstrap 5-->

  <!--begin::AdminLTE JS-->
  <script src="<?php echo e(asset('adminlte/js/adminlte.min.js')); ?>"></script>
  <!--end::AdminLTE JS-->
  <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>

  <!--begin::OverlayScrollbars Configure-->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector('.sidebar-wrapper');
      if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars && window.innerWidth > 992) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true },
        });
      }
    });
  </script>
  <!--end::OverlayScrollbars Configure-->

  <!--begin::Color Mode Toggle-->
  <script>
    (() => {
      'use strict';
      const STORAGE_KEY = 'lte-theme';
      const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
      const setStoredTheme = (t) => localStorage.setItem(STORAGE_KEY, t);
      const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
      const getPreferredTheme = () => { const s = getStoredTheme(); return s || (prefersDark() ? 'dark' : 'light'); };
      const setTheme = (theme) => {
        const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
        document.documentElement.setAttribute('data-bs-theme', resolved);
        document.documentElement.style.colorScheme = resolved;
      };
      setTheme(getPreferredTheme());
      document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
        el.addEventListener('click', () => {
          const t = el.getAttribute('data-bs-theme-value');
          setStoredTheme(t);
          setTheme(t);
          document.querySelectorAll('[data-bs-theme-value]').forEach((e) => {
            e.classList.remove('active');
            e.querySelector('.bi-check-lg')?.classList.add('d-none');
          });
          el.classList.add('active');
          el.querySelector('.bi-check-lg')?.classList.remove('d-none');
        });
      });
    })();
  </script>
  <!--end::Color Mode Toggle-->

  <script>
    (() => {
      if (!window.toastr) return;

      toastr.options = {
        closeButton: true,
        progressBar: true,
        newestOnTop: true,
        positionClass: 'toast-top-right',
        preventDuplicates: true,
        timeOut: 3500,
        extendedTimeOut: 1200,
        showDuration: 200,
        hideDuration: 200,
        showEasing: 'swing',
        hideEasing: 'swing',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut',
      };

      const queue = [
        ['error', <?php echo json_encode(session('message'), 15, 512) ?>],
        ['error', <?php echo json_encode(session('error'), 15, 512) ?>],
        ['success', <?php echo json_encode(session('success'), 15, 512) ?>],
        ['info', <?php echo json_encode(session('status'), 15, 512) ?>],
      ];

      <?php if($errors->any()): ?>
        queue.push(['error', <?php echo json_encode($errors->first(), 15, 512) ?>]);
      <?php endif; ?>

      queue.forEach(([type, message]) => {
        if (!message) return;
        const text = String(message).trim();
        if (!text) return;
        if (type === 'success') {
          toastr.success(text);
        } else if (type === 'error') {
          toastr.error(text);
        } else if (type === 'warning') {
          toastr.warning(text);
        } else {
          toastr.info(text);
        }
      });
    })();
  </script>

  <!--begin::DataTables-->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <!--end::DataTables-->

  <!--begin::Select2-->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!--end::Select2-->

  <!--begin::SweetAlert2-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <!--end::SweetAlert2-->

  <!--begin::Chart.js-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <!--end::Chart.js-->

  <!--begin::Google Translate-->
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->google_translate == 'on'): ?>
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <script>
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
  </script>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  <!--end::Google Translate-->

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/mayaoflagos/dbschenkerlogistics/laravel/resources/views/layouts/app1.blade.php ENDPATH**/ ?>