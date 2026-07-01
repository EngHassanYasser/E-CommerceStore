<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileService
{
    public function getEditData()
    {
        return [
            'user' => Auth::user(),
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames()
        ];
    }
    public function delete(User $user)
    {
        return User::delete($user);
    }
    public function Update($user, $data)
    {
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        return $user->profile->fill($data)->save();
    }
}
