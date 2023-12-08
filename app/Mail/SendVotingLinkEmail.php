<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVotingLinkEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $url;

    /**
     * @var mixed
     */
    public $subject;

    /**
     * @var mixed
     */
    public $body;

    /**
     * Constructor.
     *
     * @param EmailTemplate $emailTemplate
     * @param $token
     */
    public function __construct(EmailTemplate $emailTemplate, $token)
    {
        $this->url = trim(config('app.online_voting_url'), '/') . '/?token=' . $token;

        $this->subject = $emailTemplate->subject;
        $this->body = $emailTemplate->body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->markdown('mail.send-voting-link-email', [
                'url' => $this->url,
                'body' => $this->body,
            ]);
    }
}
