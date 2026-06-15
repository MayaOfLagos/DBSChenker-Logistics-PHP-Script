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
    @vite(['resources/css/app.css', 'resources/js/portal.js'])
</head>
<body>
    <div id="portal-app"></div>
    <noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>
</body>
</html>
