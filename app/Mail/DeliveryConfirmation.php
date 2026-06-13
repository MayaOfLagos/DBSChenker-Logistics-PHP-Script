<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeliveryConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $shipment;
    public $settings;

    /**
     * Create a new message instance.
     */
    public function __construct($shipment, $settings)
    {
        $this->shipment = $shipment;
        $this->settings = $settings;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = "Package Delivered - Tracking #{$this->shipment->trackingnumber}";

        return $this->subject($subject)
                    ->markdown('emails.delivery_confirmation')
                    ->with([
                        'shipment' => $this->shipment,
                        'settings' => $this->settings,
                        'deliveryDate' => now()->format('F d, Y'),
                    ]);
    }
}
