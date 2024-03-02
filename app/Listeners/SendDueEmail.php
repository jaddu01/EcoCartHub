<?php

namespace App\Listeners;
use App\Events\DueTask;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\EmailDueNotification;
class SendDueEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DueTask $event): void
    {


    }
}
