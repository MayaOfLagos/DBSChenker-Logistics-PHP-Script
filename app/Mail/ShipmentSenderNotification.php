<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShipmentSenderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $shipment;
    public $settings;

    public function __construct($shipment, $settings)
    {
        $this->shipment = $shipment;
        $this->settings = $settings;
    }

    public function build()
    {
        return $this->subject("Shipment Dispatched — Tracking {$this->shipment->trackingnumber}")
            ->markdown('emails.shipment_sender_notification')
            ->with([
                'shipment' => $this->shipment,
                'settings' => $this->settings,
            ]);
    }
}
