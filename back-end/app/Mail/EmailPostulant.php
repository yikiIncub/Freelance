<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPostulant extends Mailable
{
    use Queueable, SerializesModels;


     public $V_postulant;
 

    public function __construct($V_postulant)
    {
      $this->V_postulant=$V_postulant;
    }


    public function build()
    {
        return $this->subject('Freelance')->markdown('emails.Email_Postulant');
    }
}
