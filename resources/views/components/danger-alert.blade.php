@if (Session::has('error'))
    <div class="d-none" data-admin-toast="error" data-admin-message="{{ Session::get('error') }}"></div>
@endif
  
