<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TaskWatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:watcher';

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
        $tasks = Task::where('due_date', '<', Carbon::Today())->get();


        foreach ($tasks as $task) {
            $task->update(['status' => 'overdue']);
        }

        $this->info('Task statuses updated successfully.');

        return 0;
    }
}
