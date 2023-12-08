@component('mail::message')

Dear valuable voter, to secure your voting event we sent you this OTP. Happy voting… :)

<h3 style="font-weight: bold;">
{!! $OTP !!}
</h3>
<br>
Thanks,<br>
{{ config('app.name') }}

@endcomponent
