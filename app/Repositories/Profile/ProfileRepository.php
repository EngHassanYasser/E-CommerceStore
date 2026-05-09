<?php
namespace App\Repositories\Profile;
interface ProfileRepository {
    public function update($user,$data);
    public function delete($user);
}