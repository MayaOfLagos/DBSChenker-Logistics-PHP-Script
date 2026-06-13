<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';

    protected $fillable = [
        'firstName', 'lastName', 'email', 'email_verified_at', 'password',
        'token_2fa_expiry', 'enable_2fa', 'token_2fa', 'pass_2fa',
        'phone', 'dashboard_style', 'password_token', 'acnt_type_active',
        'status', 'type',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
