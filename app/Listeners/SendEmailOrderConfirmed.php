<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Mail\SendOrderConfirmation;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailOrderConfirmed
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
    public function handle(OrderConfirmed $event): void
    {
        try{
            //send order confirmation email
            Log::info('Sending order confirmation email.....');
            Log::info($event->order);
            Mail::to('abody@ecocarthub.com')->send(new SendOrderConfirmation($event->order));
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
}
