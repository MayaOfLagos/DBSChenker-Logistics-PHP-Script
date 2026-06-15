@component('mail::message')
# Thank You for Contacting DB Schenker

Dear {{ $formData['firstname'] }},

Thank you for getting in touch. We have received your message and a member of our team will respond within **one business day**.

@component('mail::panel')
**Enquiry Type:** {{ $formData['subject'] }}
**Your Email:** {{ $formData['email'] }}
@if(!empty($formData['company']))
**Company:** {{ $formData['company'] }}
@endif
@endcomponent

If your matter is urgent, please contact our Emergency Support line directly using the email or phone number on our website.

@component('mail::button', ['url' => config('app.url') . '/track', 'color' => 'red'])
Track Your Shipment
@endcomponent

Kind regards,
**DB Schenker Customer Service**
@endcomponent
