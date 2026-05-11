<?php

namespace App\Services;

use App\Repositories\Auth\AuthRepository;
use App\Services\BaseService;

class AuthService extends BaseService
{
    public function __construct(protected AuthRepository $authRepository) {}
    public function resetPassword($data)
    {
        return $this->authRepository->resetPassword($data);
    }
    public function createUser($data) {
        return $this->authRepository->createUser($data);
    }
    public function changePassword($user,$newPassword) {
        return $this->authRepository->changePassword($user,$newPassword);
    }
}
