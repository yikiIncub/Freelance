@component('mail::message')
# Yikifree votre nouvelle plateforme de freelance

    Bonjour {{$V_postulant->postulant_nom}}! Vous avez postuler au projet {{ $V_postulant->titre_projet}} sur https://www.yikifree.com.

    Veillez envoyer votre Offre technique et financière au mail suivant: {{$V_postulant->email_client}}.

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
