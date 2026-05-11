<?php

namespace App\Repositories\Auth;

use App\Repositories\Base\BaseRepository;

interface AuthRepository extends BaseRepository
{
    public function resetPassword($data);
    public function createUser($data);
    public function changePassword($user,$newPassword);
}
