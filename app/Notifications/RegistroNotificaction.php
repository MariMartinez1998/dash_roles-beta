<?php

namespace App\Notifications;

use App\Models\Automovil;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistroNotificaction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Automovil $auto)
    {
        $this->user = $user;
        $this->auto = $auto;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'name' => $this->user->name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'city' => $this->user->city,
            'Placa' =>  $this->auto->plate,
            'Marca' => $this->auto->make,
            'Modelo' => $this->auto->model,
            'id' => auth()->user()->name.' '. auth()->user()->last_name,
            'id' => $this->user->id,
            'ruta' => 'usuarios',
            'accion' => 'Registro',
            'color' => 'primary' //primary  secondary success danger info warning 
        ];
    }
}
