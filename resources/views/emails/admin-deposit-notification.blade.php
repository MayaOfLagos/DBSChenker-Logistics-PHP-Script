@component('mail::message')
# New Deposit Request

Dear Admin,

A new payment proof has been submitted and is awaiting your review.

@component('mail::panel')
**Customer:** {{ $user->name }} ({{ $user->email }})
**Amount:** {{ $user->currency }}{{ number_format($deposit->amount, 2) }}
**Payment Method:** {{ $deposit->payment_mode }}
**Tracking Number:** {{ $deposit->track_id ?? 'N/A' }}
**Date:** {{ $deposit->created_at->format('M d, Y H:i') }}
**Status:** Pending
@endcomponent

Please log in to the admin dashboard to review and process this deposit.

@component('mail::button', ['url' => url('admin/dashboard/mdeposits')])
View Deposits
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
