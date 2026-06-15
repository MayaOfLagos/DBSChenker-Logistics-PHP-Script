<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintFormMail extends Mailable
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
            return $this->subject('New Complaint Report — ' . ($this->formData['type'] ?? 'General'))
                        ->markdown('emails.complaint-form-admin');
        }

        return $this->subject('Your complaint has been received — DB Schenker')
                    ->markdown('emails.complaint-form-reply');
    }
}
