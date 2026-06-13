@component('mail::message')
# {{ $salutation ?? "Hello" }} {{ $recipient }},

@if ($attachment)
    <img src="{{ $message->embed(asset('storage/' . $attachment)) }}">
@endif

{!! $body !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
