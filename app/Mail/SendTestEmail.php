<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTestEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var mixed
     */
    public $subject;

    /**
     * @var mixed
     */
    public $body;

    /**
     * SendTestEmail constructor.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->subject = $request->subject;
        $this->body = $request->message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->markdown('mail.send-test-email', [
                'body' => $this->body,
            ]);
    }
}
