<?php

namespace App\Mail;

use App\Models\candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidatureStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $candidature;

    public function __construct(Candidature $candidature)
    {
        $this->candidature = $candidature;
    }

    public function build()
    {
        return $this->subject('Mise à jour de votre candidature')
                    ->view('emails.status_update')
                    ->with('candidature', $this->candidature);
    }
}
