<?php
namespace App\Services;

use App\Repositories\SocialLogin\SocialLoginRepository;

class SocialLoginService extends BaseService{
    public function __construct(protected SocialLoginRepository $socialLoginRepository){}
    public function createUser($provider_user, $provider) {
        return $this->socialLoginRepository->createUser($provider_user,$provider);
    }
        public function findUserByProvider($provider_user, $provider) {
            return $this->socialLoginRepository->findUserByProvider($provider_user,$provider);
        }
}