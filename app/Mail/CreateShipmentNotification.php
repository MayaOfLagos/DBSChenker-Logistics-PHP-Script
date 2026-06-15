<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateShipmentNotification extends Mailable
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

        $subject = "New Shipment — Tracking {$this->shipment->trackingnumber}";


        return $this->subject($subject)
            ->markdown('emails.create_shipment_notification')
            ->with([
                'shipment' => $this->shipment,
                'settings' => $this->settings,
                'deliveryDate' => now()->format('F d, Y'),
            ]);
    }
}
