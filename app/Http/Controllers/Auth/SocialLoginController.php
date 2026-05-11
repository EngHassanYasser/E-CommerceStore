<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialLoginService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function __construct(protected SocialLoginService $socialLoginService) {}
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $allowed = ['google', 'facebook','x'];

            if (! in_array($provider, $allowed)) {
                abort(404);
            }
            $provider_user = Socialite::driver($provider)->user();
            $user = $this->socialLoginService->findUserByProvider($provider_user, $provider);

            if (! $user) {
                $user = $this->socialLoginService->createUser($provider_user, $provider);
            }
            Auth::login($user);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['message' => 'Failed to login with ' . $provider . '. Please try again.']);
        }
    }
}
