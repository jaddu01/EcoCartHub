<?php

namespace App\Console\Commands;

use App\Jobs\SendOffersJob;
use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\SendOffers;

class EmailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:offers';

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
        SendOffersJob::dispatch();
    }
}
