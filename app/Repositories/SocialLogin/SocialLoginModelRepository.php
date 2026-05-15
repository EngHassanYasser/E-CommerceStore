<?php

namespace App\Repositories\SocialLogin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;

class SocialLoginModelRepository  implements SocialLoginRepository
{
    public function createUser($provider_user, $provider)
    {
        return  User::create([
            'name' => $provider_user->name,
            'email' => $provider_user->email,
            'provider' => $provider,
            'provider_id' => $provider_user->id,
            'password' => Hash::make(Str::random(16)),
            'provider_token' => $provider_user->token,
        ]);
    }
    public function findUserByProvider($provider_user, $provider)
    {
        return User::where([
            'provider' => $provider,
            'provider_id' => $provider_user->id,
        ])->first();
    }
}
