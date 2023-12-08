<?php

namespace App\Jobs;

use App\Services\SmsGatewayService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SmsSendingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    private $receiver;

    /**
     * @var
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * @param $data
     * @return void
     */
    public function __construct($data)
    {
        $this->receiver = $data['receiver'];
        $this->message = $data['message'];
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        try {

            // Validating...
            if(empty($this->receiver) || empty($this->message)){
                throw new \Exception("Receiver & Message can't be empty.");
            }

            $sender = new SmsGatewayService();
            $sender->setReceiver($this->receiver);
            $sender->setMessage($this->message);
            $response = $sender->send();

            if ($response['status'] == 'SUCCESS') {
                logger("SMS Success - to: {$this->receiver} & body: {$this->message}");
            } else {
                logger('SMS Error: ' . $response['error_message']);
            }
        } catch (\Exception $exception) {
            logger($exception);
        }
    }
}
