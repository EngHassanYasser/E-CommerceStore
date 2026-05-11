<?php
namespace App\Repositories\Profile;

use App\Repositories\Base\BaseRepository;

interface ProfileRepository extends BaseRepository{
    public function update($user,$data);
}