<?php

namespace App\Console\Commands;

use App\Mail\SendOrderConfirmation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send test email to the user.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sending Test Email........');
        Mail::to('abody@ecocarthub.com')->send(new SendOrderConfirmation());
        $this->info('Test Email Sent Successfully');
    }
}
