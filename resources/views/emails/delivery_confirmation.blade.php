@component('mail::message')
# Your Package Has Been Delivered

Dear {{ $shipment->name }},

We're pleased to inform you that your package has been successfully delivered.

@component('mail::panel')
**Tracking Number:** {{ $shipment->trackingnumber }}
**Delivery Date:** {{ $deliveryDate }}
@endcomponent

Thank you for choosing **{{ $settings->site_name }}** for your shipping needs. We hope you were satisfied with our service.

If you have any questions or need further assistance, please contact us at {{ $settings->contact_email }}.

Thanks,
{{ $settings->site_name }}
@endcomponent
