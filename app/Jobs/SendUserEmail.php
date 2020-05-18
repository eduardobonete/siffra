<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;

use App\Mail\UserCreated;
use App\User;

class SendUserEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        Redis::throttle('mail')->allow(1)->every(1)->then(function() {
            Mail::send('emails.user.created', array("user" => $this->user), function($message) {
                $message->subject('Cadastro de usuário')
                    ->from(env('MAIL_FROM_ADDRESS'));

                $message->to($this->user->email);
            });
        });
    }
}
