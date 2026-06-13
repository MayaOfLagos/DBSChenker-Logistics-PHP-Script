@component('mail::message')
# Payment Proof Received

Dear {{ $user->name }},

Thank you — we have received your payment proof and it is now pending verification.

@component('mail::panel')
**Amount:** {{ $user->currency }}{{ number_format($deposit->amount, 2) }}
**Payment Method:** {{ $deposit->payment_mode }}
**Tracking Number:** {{ $deposit->track_id ?? 'N/A' }}
**Date:** {{ $deposit->created_at->format('M d, Y H:i') }}
**Status:** Pending Verification
@endcomponent

**What happens next:**

1. Our team will verify your payment proof, usually within 24 hours.
2. Once confirmed, your shipment clearance process will continue.
3. You'll receive a confirmation email when it's approved.

If you have any questions, please contact us at {{ config('mail.from.address') }}.

Thanks,
{{ config('app.name') }}
@endcomponent
