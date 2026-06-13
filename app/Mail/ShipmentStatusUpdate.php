<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShipmentStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $shipment;
    public $status;
    public $comment;
    public $settings;

    /**
     * Create a new message instance.
     */
    public function __construct($shipment, $status, $comment, $settings)
    {
        $this->shipment = $shipment;
        $this->status = $status;
        $this->comment = $comment;
        $this->settings = $settings;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = "Shipment Status Update - Tracking #{$this->shipment->trackingnumber}";

        return $this->subject($subject)
                    ->markdown('emails.shipment_status_update')
                    ->with([
                        'shipment' => $this->shipment,
                        'status'   => $this->status,
                        'comment'  => $this->comment,
                        'settings' => $this->settings,
                    ]);
    }
}
