<?php

namespace Modules\AuthUser\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class CreateUserSMSJob implements ShouldQueue
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
     * @throws ConfigurationException|TwilioException
     */
    public function handle()
    {
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_TOKEN");
        $fromNumber = getenv("TWILIO_FROM");
        $twilio = new Client($sid, $token);
//dd($twilio,$this->data['userPhone']->phone);
        $twilio->messages
            ->create(
                $this->data['userPhone']->phone,
                [
                    "body" => "Thank you",
                    "from" => $fromNumber,
                ]
            );

    }
}
