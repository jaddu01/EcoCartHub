<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CustomQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom query';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Custom Query started........');
        DB::statement("UPDATE users SET email_verified_at = NUll");
        $this->info('Custom Query Executed Successfully');
    }
}
