<?php

namespace App\Repositories\SocialLogin;

interface SocialLoginRepository
{
    public function createUser($provider_user, $provider);
    public function findUserByProvider($provider_user, $provider);
}
