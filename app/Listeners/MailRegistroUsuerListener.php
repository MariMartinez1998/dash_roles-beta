<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\Mail_Registro_UsuerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class MailRegistroUsuerListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = User::find($event->user->id);
        Notification::send($user, new Mail_Registro_UsuerNotification($event->user, $event->auto));
    }
}
