<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $casts = [
        'return_capital'      => 'boolean',
        'should_cancel_plan'  => 'boolean',
        'modules'             => 'array',
        'shipment_statuses'   => 'array',
        'freight_types'       => 'array',
    ];

    public function getShipmentStatusesWithDefault(): array
    {
        return $this->shipment_statuses ?? [
            'Order Confirmed',
            'Picked by Courier',
            'On The Way',
            'Custom Hold',
            'Delivered',
        ];
    }

    public function getFreightTypesWithDefault(): array
    {
        return $this->freight_types ?? [
            'Road Transport',
            'Air Freight',
            'Sea Freight',
            'Rail Transport',
            'Multimodal Transport',
        ];
    }

    // public function getModulesAttribute($value)
    // {
    //     return ucfirst($value);
    // }
}