<?php

namespace App\Models;

use App\Events\MessageEvent;
use App\Notifications\MessageNotificaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message';

    public function createNotification($message,$us)
    {
        // event(new MessageEvent($message,$us));
        event(new MessageEvent($message, $us));
        // User::role(['Super Admin'])
        // // ->except($user->id) //esta no incluirla
        // ->each(function (User $user) use ($message, $us) {
        //     $user->notify(new MessageNotificaction($message, $us));
        // });
    }
}
