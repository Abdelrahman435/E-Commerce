<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'] ?? 'user',
        ]);

        $token = auth()->login($user);

        return [
            'user' => $user->makeHidden(['password']),
            'access_token' => $token,
            'token_type' => 'bearer'
        ];
    }
}
