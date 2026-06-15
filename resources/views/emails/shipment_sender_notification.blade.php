@component('mail::message')
# Your Shipment Has Been Dispatched

Dear {{ $shipment->sname }},

We are pleased to confirm that your package has been collected and dispatched through **{{ $settings->site_name }}**.

@component('mail::panel')
**Tracking Number:** {{ $shipment->trackingnumber }}
**Recipient:** {{ $shipment->name }}
**Origin:** {{ $shipment->take_off_point }}
**Destination:** {{ $shipment->final_destination }}
**Description:** {{ $shipment->description }}
**Shipping Cost:** {{ $settings->s_currency }} {{ number_format($shipment->cost, 2) }}
**Status:** {{ $shipment->status }}
**Expected Delivery:** {{ $shipment->expected_delivery }}
@endcomponent

@component('mail::button', ['url' => rtrim($settings->site_address, '/') . '/track?tracking=' . $shipment->trackingnumber])
Track This Shipment
@endcomponent

If you have any questions about this shipment, please contact our support team at {{ $settings->contact_email }}.

Thanks,
{{ $settings->site_name }}
@endcomponent
