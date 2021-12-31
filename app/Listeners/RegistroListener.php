<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\RegistroNotificaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class RegistroListener
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
        User::role(['Super Admin'])
        ->each(function (User $user) use ($event) {
            Notification::send($user, new RegistroNotificaction($event->user,$event->auto));
        });
    }
}
