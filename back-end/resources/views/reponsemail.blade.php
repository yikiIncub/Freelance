@component('mail::message')
# Yikifree

@component('mail::panel')
{{$message}}
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
