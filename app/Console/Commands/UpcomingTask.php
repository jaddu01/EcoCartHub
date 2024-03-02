<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpcomingTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upcoming:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::with('users')->where('due_date','>',Carbon::today())
        ->where('due_date','<=',Carbon::tomorrow())->where('status', 'due')->get();

        foreach($tasks as $task){
            foreach($task->users as $user){
                Log::info('Upcoming Task Email Sent to'. $user->email);
            }
    }
}
}
