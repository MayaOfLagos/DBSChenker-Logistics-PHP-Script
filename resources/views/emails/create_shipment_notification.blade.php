@component('mail::message')
# New Shipment Created

Dear {{ $shipment->name }},

Your shipment has been successfully created and is now being prepared for dispatch.

@component('mail::panel')
**Tracking Number:** {{ $shipment->trackingnumber }}
**Sender:** {{ $shipment->sname }}
**Origin:** {{ $shipment->take_off_point }}
**Destination:** {{ $shipment->final_destination }}
**Description:** {{ $shipment->description }}
**Shipping Cost:** {{ $settings->s_currency }} {{ number_format($shipment->cost, 2) }}
**Status:** {{ $shipment->status }}
**Estimated Delivery:** {{ $deliveryDate }}
@endcomponent

@component('mail::button', ['url' => rtrim($settings->site_address, '/') . '/track?tracking=' . $shipment->trackingnumber])
Track Your Shipment
@endcomponent

Thank you for choosing **{{ $settings->site_name }}**. We are committed to delivering your shipment safely and on time.

If you have any questions, please contact our support team at {{ $settings->contact_email }}.

Thanks,
{{ $settings->site_name }}
@endcomponent
