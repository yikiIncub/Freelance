@component('mail::message')
# Yikifree votre nouvelle plateforme de freelance

    Bonjour! Vous avez postuler au projet {{ $V_postulant->titre_projet}} sur yikifree.com.

    Veillez envoyer votre Offre technique et financière au mail suivant: {{$V_postulant->email_client}}.

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
