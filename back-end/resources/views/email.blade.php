@component('mail::message')
# Bonjour !
- {{$nom}} {{$prenom}}<br>
- {{$email}}
@component('mail::panel')
{{$message}}
@endcomponent

Cordialement,,<br>
{{ config('app.name') }}
@endcomponent
