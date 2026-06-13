<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $url, $attachment, $body, $subject, $recipient, $salutaion;

    /**
     * Create a new message instance.
     */
    public function __construct($body, $subject, $recipient, $url = null, $attachment = null, $salutaion = null)
    {
        $this->url =  $url;
        $this->attachment = $attachment;
        $this->body =  $body;
        $this->subject = $subject;
        $this->recipient = $recipient;
        $this->salutaion = $salutaion;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Use your Blade template but pass the raw HTML body
        $email = $this->markdown('emails.NewNotification', [
            'url' => $this->url,
            'attachment' => $this->attachment,
            'body' => $this->body,
            'recipient' => $this->recipient,
            'salutation' => $this->salutaion,
        ])
        ->subject($this->subject);

        // Attach file if provided
        if ($this->attachment) {
            $email->attach($this->attachment);
        }

        return $email;
    }
}
