@if (Session::has('message'))
    <div class="d-none" data-admin-toast="error" data-admin-message="{{ Session::get('message') }}"></div>
@endif
@if (Session::has('success'))
    <div class="d-none" data-admin-toast="success" data-admin-message="{{ Session::get('success') }}"></div>
@endif
