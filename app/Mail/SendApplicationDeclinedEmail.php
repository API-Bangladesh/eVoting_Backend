<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendApplicationDeclinedEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var mixed
     */
    public $body;

    /**
     * DeclinedReasonMail constructor.
     *
     * @param $applicationSubmission
     */
    public function __construct($applicationSubmission)
    {
        $this->body = $applicationSubmission->declined_reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your online application is declined.')
            ->markdown('mail.send-application-declined-email', [
                'body' => $this->body,
            ]);
    }

}
