<?php

namespace App\Jobs;

use App\Mail\SendRegisterConfirmation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SenEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Email Sent to : ". $this->user->email);

        //use chunks
        // User::chunk(5, function ($users) {
        //     foreach ($users as $user) {
        //         //send email
        //         Mail::to($user->email)->send(new SendRegisterConfirmation($user));
        //     }
        // });

        // $users = User::limit(5)->get();
        // foreach ($users as $user) {
        //     //send email
        //     Mail::to($user->email)->send(new SendRegisterConfirmation($user));
        // }
    }
}
