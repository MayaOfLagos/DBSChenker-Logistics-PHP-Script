@component('mail::message')
# We've received your report, {{ $formData['name'] }}

Thank you for reaching out. Your complaint has been logged and our compliance team will review it within **2 business days**.

@component('mail::panel')
**Reference:** {{ $formData['type'] ?? 'Complaint' }}
@if(!empty($formData['tracking']))
**Tracking Number:** {{ $formData['tracking'] }}
@endif
**Submitted:** {{ now()->format('F j, Y \a\t g:i A') }}
@endcomponent

If you need to provide additional information or follow up, simply reply to this email and quote the details above.

@component('mail::button', ['url' => config('app.url') . '/track', 'color' => 'red'])
Track Your Shipment
@endcomponent

Thanks,
DB Schenker Compliance Team
@endcomponent
