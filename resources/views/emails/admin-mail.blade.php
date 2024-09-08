@component('mail::message')

{!! $email->body !!}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
