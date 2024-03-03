<?php

namespace App\Listeners;
use App\Events\DueTask;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\EmailDueNotification;
use Illuminate\Support\Facades\Log;

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
        if($event->task->status=='due'){
            foreach($event->task->users as $user){
                Log::info('You have a due Task'.$user->email);
            }
        }
        else if ($event->task->status=='completed'){
            foreach($event->task->users as $user){
                Log::info('You have done a Task : '. $event->task->title . $user->email);
            }
        }
        else{
            foreach($event->task->users as $user){
                Log::info('You have an issue with your task: ' . $event->task->title . ' ' . $user->email);
            }
        }

    }
}
