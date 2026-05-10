<?php
namespace App\Repositories\Profile;
interface ProfileRepository {
    public function update($user,$data);
}