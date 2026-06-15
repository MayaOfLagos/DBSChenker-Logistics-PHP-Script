@component('mail::message')
# New Complaint / Compliance Report

A complaint has been submitted through the website. Details are below.

@component('mail::panel')
**Complaint Type:** {{ $formData['type'] ?? 'N/A' }}

**Submitted by:** {{ $formData['name'] }}
**Email:** {{ $formData['email'] }}
**Phone:** {{ $formData['phone'] ?: 'Not provided' }}
@if(!empty($formData['tracking']))
**Tracking Number:** {{ $formData['tracking'] }}
@endif
@endcomponent

---

**Details / Description:**

{{ $formData['message'] }}

---

Reply directly to this email to respond to **{{ $formData['name'] }}** at {{ $formData['email'] }}.

Thanks,
{{ config('app.name') }}
@endcomponent
