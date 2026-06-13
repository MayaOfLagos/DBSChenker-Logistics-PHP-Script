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
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  {{-- Bootstrap 5 --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background-color: #f4f6f9;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    main { flex: 1; }
    .auth-card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 24px rgba(0,0,0,.08);
    }
    .auth-logo { max-height: 64px; object-fit: contain; }
  </style>
</head>

<body>
  <main class="d-flex align-items-center justify-content-center py-5 px-3">
    @yield('content')
  </main>

  <footer class="text-center py-3 text-muted small border-top">
    @if($settings->google_translate == 'on')
      <div id="google_translate_element" class="mb-2"></div>
    @endif
    &copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.
  </footer>

  {{-- jQuery --}}
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  {{-- Bootstrap 5 JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Prevent spaces in username/email fields --}}
  <script>
    $('#username, input[type="email"]').on('keypress', function(e) {
      return e.which !== 32;
    });
  </script>

  @if($settings->google_translate == 'on')
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
      }
    </script>
  @endif

  @livewireScripts
  @stack('scripts')
</body>
</html>
