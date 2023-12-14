<?php

namespace App\Jobs;

use App\Mail\SendMailable;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CustomerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     private $user;
    public function __construct(
        $user
    )
    {
       $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // $foundUser = User::find($user->email); // Use a different variable name

        // if ($foundUser) {
        //     Mail::to($foundUser->email)->send(new SendMailable($foundUser));
        // }
        Mail::to($this->user->email)->send(new SendMailable($this->user));

    }
}
