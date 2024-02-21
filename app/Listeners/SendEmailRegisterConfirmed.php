<?php

namespace App\Listeners;

use App\Events\RegisterConfirmed;
use App\Mail\SendRegisterConfirmation;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class SendEmailRegisterConfirmed
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
    public function handle(RegisterConfirmed $event): void
    {
        try{

            Log::info('Sending Register confirmation email.....');
            Log::info($event->user);
            Mail::to('abody@ecocarthub.com')->send(new SendRegisterConfirmation($event->user));
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
}
