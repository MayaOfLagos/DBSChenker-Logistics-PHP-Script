<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | {{ $settings->site_name }}</title>
  <link rel="icon" href="{{ asset('storage/' . $settings->favicon) }}" type="image/png">

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  {{-- AdminLTE 4 (includes Bootstrap 5) --}}
  <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
</head>

<body class="login-page bg-body-secondary">

  <div class="login-box">

    {{-- Logo / Site name --}}
    <div class="login-logo mb-3">
      <a href="{{ url('/') }}">
        @if($settings->logo)
          <img src="{{ asset('storage/' . $settings->logo) }}"
               alt="{{ $settings->site_name }}" style="max-height:60px; object-fit:contain;">
        @else
          <b>{{ $settings->site_name }}</b>
        @endif
      </a>
    </div>

    @yield('content')

  </div>

  <footer class="text-center py-3 text-muted small">
    &copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.
  </footer>

  {{-- jQuery --}}
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  {{-- Bootstrap 5 + AdminLTE 4 --}}
  <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>

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
        ['error', @json(session('message'))],
        ['error', @json(session('error'))],
        ['success', @json(session('success'))],
        ['info', @json(session('status'))],
      ];

      @if ($errors->any())
        queue.push(['error', @json($errors->first())]);
      @endif

      queue.forEach(([type, message]) => {
        if (!message) return;
        const text = String(message).trim();
        if (!text) return;
        if (type === 'error') {
          toastr.error(text);
        } else if (type === 'success') {
          toastr.success(text);
        } else {
          toastr.info(text);
        }
      });
    })();
  </script>

  @stack('scripts')
</body>
</html>
