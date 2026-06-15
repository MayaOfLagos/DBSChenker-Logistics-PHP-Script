<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $formData;
    public bool $isAdmin;

    public function __construct(array $formData, bool $isAdmin)
    {
        $this->formData = $formData;
        $this->isAdmin  = $isAdmin;
    }

    public function build()
    {
        if ($this->isAdmin) {
            return $this->subject('New Contact Enquiry — ' . ($this->formData['subject'] ?? 'General'))
                        ->markdown('emails.contact-form-admin');
        }

        return $this->subject('We received your message — DB Schenker')
                    ->markdown('emails.contact-form-reply');
    }
}
