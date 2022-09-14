@component('mail::message')
# Bonjour !
- {{$nom}} {{$numero}}<br>
- {{$email}}
@component('mail::panel')
{{$message}}
@endcomponent

Cordialement,,<br>
{{ config('app.name') }}
@endcomponent
