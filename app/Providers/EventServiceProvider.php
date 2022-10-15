<?php

namespace App\Providers;

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
        /*
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        */

        'App\Events\AutoMemberFd' => [
            'App\Listeners\SetAgentChildMemberFd'
        ],

        'App\Events\AutoInviteFd' => [
            'App\Listeners\SetAgentInviteFd'
        ],

        'App\Events\CheckTask' => [
            'App\Listeners\CheckMemberTask'
        ],

        'App\Events\CheckAwards' => [
            'App\Listeners\SendTaskAwards'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
