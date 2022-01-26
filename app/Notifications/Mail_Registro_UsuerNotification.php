<?php

namespace App\Notifications;

use App\Models\Automovil;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Mail_Registro_UsuerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Automovil $auto, $desencritc)
    {
        $this->user = $user;
        $this->auto = $auto;
        $this->desencritc = $desencritc;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('These are your data registered on our platform:')
                    ->line($this->user->name . ' ' . $this->user->last_name)
                    ->line('Email: '.$this->user->email)
                    ->line('Password: '.$this->desencritc)
                    ->line('Plate: ' . $this->auto->plate)
                    ->line('Make: ' . $this->auto->make)
                    ->line('Model: ' . $this->auto->model)
                
                     ->action('Enter Here', url('/'))
                    ->line('Thank you for using our platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
