<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user', 'amount', 'payment_mode', 'status', 'proof', 'plan', 'courier_id', 'track_id',
        'guest_email', 'guest_name'
    ];

    public function duser(){
    	return $this->belongsTo('App\Models\User', 'user');
    }

    public function dplan(){
    	return $this->belongsTo('App\Models\Plans', 'plan');
    }

    public function getNameAttribute(): string
    {
        return $this->guest_name ?? ($this->duser?->name ?? 'N/A');
    }

    public function getEmailAttribute(): string
    {
        return $this->guest_email ?? ($this->duser?->email ?? 'N/A');
    }

    public function getTrackingnumberAttribute(): ?string
    {
        return $this->track_id;
    }
}
