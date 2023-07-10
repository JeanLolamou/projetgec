<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Envoimail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     private $data;

    public function __construct($data)
    {
         $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from('info@contact.apipguinee.com')
                    ->subject('Nouvelle manifestation de besoin: '.$this->data->titre)
                    ->cc('sallkadiatoum@gmail.com')
                    // ->cc('dga@apip.gov.gn')
                    // ->cc('dg@apip.gov.gn')
                    // ->cc('assistant.admin@apip.gov.gn')
                    // ->cc('assistant.dg@apip.gov.gn')
                    ->view('emails.alertcourrier',['data'=>$this->data]);
    }
}
