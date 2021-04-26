<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class userCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    
    //aqui se crea el mensaje para la insatncia
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.welcome')->subject('Por favor confirma tu correo electronico');
    }
}
