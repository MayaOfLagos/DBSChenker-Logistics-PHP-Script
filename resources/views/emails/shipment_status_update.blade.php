@component('mail::message')
# Shipment Status Update

Dear {{ $shipment->name }},

Your shipment status has been updated to **{{ $status }}**.

@component('mail::panel')
**Tracking Number:** {{ $shipment->trackingnumber }}
**New Status:** {{ $status }}
**Update Details:** {{ $comment }}
@endcomponent

@component('mail::button', ['url' => rtrim($settings->site_address, '/') . '/track?tracking=' . $shipment->trackingnumber])
Track Your Shipment
@endcomponent

Thank you for choosing **{{ $settings->site_name }}** for your shipping needs.

Thanks,
{{ $settings->site_name }}
@endcomponent
