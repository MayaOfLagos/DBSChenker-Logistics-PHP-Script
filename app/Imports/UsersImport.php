<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersImport
{
    public function model(array $row)
    {
        if (empty($row['email']) || empty($row['name'])) {
            return null;
        }

        return new User([
            'name'  => $row['name'] ?? null,
            'email' => $row['email'] ?? null,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'username' => $row['username'] ?? null,
            'country' => $row['country'] ?? null,
            'phone' => $row['phone_number'] ?? null,
        ]);
    }
}
