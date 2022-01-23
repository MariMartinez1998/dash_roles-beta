<?php

namespace App\Providers;

use App\Events\RegistroEvent;
use App\Listeners\RegistroListener;

use App\Events\MessageEvent;
use App\Listeners\MessageListener;

use App\Events\MailRegistroUsuerEvent;
use App\Listeners\MailRegistroUsuerListener;

use App\Events\MailBlogRegistroEvent;
use App\Listeners\MailBlogRegistroNotification;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RegistroEvent::class => [
            RegistroListener::class,
        ],
        MessageEvent::class => [
            MessageListener::class,
        ],
        MailRegistroUsuerEvent::class => [
            MailRegistroUsuerListener::class,
        ],
        MailBlogRegistroEvent::class => [
            MailBlogRegistroNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
