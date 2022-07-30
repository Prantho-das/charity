<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BloodRequestAccepted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $relAcceptedBy;
    public $brequest;
    public function __construct($relAcceptedBy,$brequest)
    {
        $this->relAcceptedBy=$relAcceptedBy;
        $this->brequest=$brequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.BloodRequestAccepted',['acceptedBy'=>$this->relAcceptedBy,'brequest'=>$this->brequest]);
    }
}
