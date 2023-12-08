@component('mail::message')

{!! $body !!}
<br>
<br>
Thanks,<br>
{{ config('app.name') }}

@endcomponent
