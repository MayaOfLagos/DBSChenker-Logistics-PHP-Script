<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ \App\Models\Settings::find(1)?->site_name ?? config('app.name') }}</title>
    @php $favicon = \App\Models\Settings::find(1)?->favicon; @endphp
    @if($favicon)
        <link rel="icon" href="{{ asset('storage/' . $favicon) }}">
    @endif

    {{-- Logisko template styles (v= cache-bust; bump when assets change) --}}
    @php $av = config('app.assets_version', '1'); @endphp
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/keyframe-animation.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/font-awesome-pro/css/fontawesome.min.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/logistic-icons.min.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.min.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/venobox.min.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common-style.css') }}?v={{ $av }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?v={{ $av }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <div id="app"></div>

    {{-- Logisko vendor scripts (jQuery-based globals; must load before Vue mounts) --}}
    <script src="{{ asset('assets/js/vendor/jquary-3.6.0.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/popper.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/lib/gsap/gsap.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/lib/gsap/ScrollTrigger.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/lib/gsap/split-type.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/lenis.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/odometer.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.nice-select.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/venobox.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/swiper.min.js') }}?v={{ $av }}"></script>
    <script src="{{ asset('assets/js/vendor/wow.min.js') }}?v={{ $av }}"></script>
</body>
</html>
