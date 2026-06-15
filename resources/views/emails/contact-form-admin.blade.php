@component('mail::message')
# New Contact Form Enquiry

A new message has been submitted through the website contact form.

@component('mail::panel')
**Name:** {{ $formData['firstname'] }} {{ $formData['lastname'] }}
**Email:** {{ $formData['email'] }}
**Phone:** {{ $formData['phone'] }}
**Enquiry Type:** {{ $formData['subject'] }}
@if(!empty($formData['company']))
**Company:** {{ $formData['company'] }}
@endif
@endcomponent

**Message:**

{{ $formData['message'] }}

---

Reply directly to **{{ $formData['email'] }}** to respond to this enquiry.

Thanks,
{{ config('app.name') }}
@endcomponent
