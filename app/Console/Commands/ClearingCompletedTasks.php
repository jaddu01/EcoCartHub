<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class ClearingCompletedTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'completed:tasks';

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
        $tasks=Task::where('status','completed')->get();
        foreach($tasks as $task){
        $task->users()->detach();
        $task->delete();
    }
}
}
