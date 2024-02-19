<?php

namespace App\Console\Commands;

use App\Mail\SendOrderConfirmation;
use App\Mail\SendRegisterConfirmation;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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
        $user = User::find(3);
        $this->info('Sending Test Email........');
        // Mail::to('abody@ecocarthub.com')->send(new SendOrderConfirmation());
        try{
            Mail::to('abody@ecocarthub.com')->send(new SendRegisterConfirmation($user));
        }catch(\Exception $e){
            $this->error('Error: '.$e->getMessage());
        }
        $this->info('Test Email Sent Successfully');
    }
}
