<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\Voter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendApplicationFormLinkEmail extends Mailable implements ShouldQueue
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
     * SendApplicationFormLinkEmail constructor.
     * @param EmailTemplate $emailTemplate
     * @param Voter $voter
     */
    public function __construct(EmailTemplate $emailTemplate, Voter $voter)
    {
        $url = config('app.online_application_form_url');
        $this->url = trim($url, '/');

        $this->body = $emailTemplate->body;
        $this->subject = $emailTemplate->subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->markdown('mail.send-application-form-link-email', [
                'url' => $this->url,
                'body' => $this->body,
            ]);
    }
}
