@component('mail::message')

{!! $body !!}

@component('mail::button', ['url' => $url])
Online Submission Link
@endcomponent
<br>
<br>
Thanks,<br>
{{ config('app.name') }}

@endcomponent
