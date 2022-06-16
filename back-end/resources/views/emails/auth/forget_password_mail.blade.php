@component('mail::message')
# Introduction

Salut {{$user_name}}

@component('mail::button', ['url' => route('getresetPassword',$reset_code)])
Cliquez ici pour mettre à jour votre mot de passe
@endcomponent
<p> <a href="{{route('getresetPassword',$reset_code)}}"></p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
