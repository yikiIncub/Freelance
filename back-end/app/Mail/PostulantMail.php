<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostulantMail extends Mailable
{
  
    use Queueable, SerializesModels;


     protected $V_postulant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('Freelance')
                    ->view('emails.auth.free');
                    
            
    }
}
