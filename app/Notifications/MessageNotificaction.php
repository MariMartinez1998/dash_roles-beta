<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\MessageUserServicio;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotificaction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line('¡New comment!')
                    ->line($this->user->name .' '.$this->user->last_name .' '. 'made this comment')
                    ->line($this->message->mensaje )
                    ->line('The'.' '. $this->message->created_at )
                    ->action('Here you can enter', url('/'));
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
            'name' => $this->user->name ,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'id_user' => $this->user->id ,
            'created_at' => $this->message->created_at ,
            'mensaje' => $this->message->mensaje,
            'ruta' => 'aaaa'. $this->user->id ,
            'accion' => 'Comentario',
            'color' => 'primary' //primary  secondary success danger info warning 
        ];
    }
}
