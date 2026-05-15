<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\Base\BaseModelRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Str;

class AuthModelRepository  implements AuthRepository
{
    public function resetPassword($data)
    {
        $result = Password::reset(
            $data,
            function ($user) use ($data) {
                $user->forceFill([
                    'password' => Hash::make($data['password']),
                    'remember_token' => Str::random(60),
                ])->save();
                event(new PasswordReset($user));
            }
        );
        return $result;
    }
    public function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function changePassword($user, $newPassword)
    {
         $user->update([
            'password' => Hash::make($newPassword),
        ]);
    }
}
