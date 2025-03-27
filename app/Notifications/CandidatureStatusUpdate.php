<?php
namespace App\Notifications;

use App\Models\Candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CandidatureStatusUpdate extends Notification
{
    use Queueable;

    public $candidature;

    public function __construct(Candidature $candidature)
    {
        $this->candidature = $candidature;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Mise à jour de votre candidature')
            ->line('Le statut de votre candidature a changé.')
            ->line('Nouveau statut : ' . $this->candidature->status)
            ->action('Voir la candidature', url('/candidatures/' . $this->candidature->id));
    }
}
