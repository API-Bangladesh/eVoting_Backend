@component('mail::message')

{!! $body !!}

@component('mail::button', ['url' => $url])
Voting Link
@endcomponent
<br>
Thanks,<br>
{{ config('app.name') }}

@endcomponent
