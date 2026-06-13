@if (Session::has('success'))
    <div class="d-none" data-admin-toast="success" data-admin-message="{{ Session::get('success') }}"></div>
@endif
