<?php

namespace Modules\AuthUser\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CreateUserMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::send('AuthUser.resources.views.mail.userCreatedEmail', ['data' => $this->data], function ($m) {
            $m->subject('Thank you');
            $m->from(env('TEST_EMAIL'), env('TEST_MAIL_FROM_NAME'));
            $m->to($this->data['user']->email);
        });
    }
}
