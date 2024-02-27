<?php

namespace App\Jobs;

use App\Mail\SendOffers as MailSendOffers;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;



class SendOffersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Log::info("Email Sent to : ". $this->user->email);
        // Mail::to($this->user->email)->send(new MailSendOffers());

        $users = User::limit(5)->get();
        foreach ($users as $user) {
        //send email
        // Mail::to($user->email)->send(new MailSendOffers());
        Log::info('Email Sent');
        }

    }
}
