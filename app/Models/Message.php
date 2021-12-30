<?php

namespace App\Models;

use App\Notifications\MessageNotificaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message';

    public function createNotification($msg,$us)
    {
        User::role(['Super Admin'])
        // ->except($user->id)
        ->each(function (User $user) use ($msg, $us) {
            $user->notify(new MessageNotificaction($msg, $us));
        });
    }
}
