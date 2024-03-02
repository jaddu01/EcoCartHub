<?php

namespace App\Jobs;

use App\Mail\SendDueNotification;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class EmailDueNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tasks = Task::with('users')->get();


        foreach($tasks as $task){
            if(Carbon::parse($task->due_date)->isToday()
            ){

                if($task->status=='due'){
                    foreach($task->users as $user){
                    Log::info('Due Date Reminder Email sent to'.$user->email);
                    }

            }
        }

    }
    }
}
