<?php
namespace App\Repositories\Profile;

use App\Models\Profile;
use App\Repositories\BaseModelRepository;
use App\Repositories\Profile\ProfileRepository;

class ProfileModelRepository extends BaseModelRepository implements ProfileRepository
{
    public function __construct(Profile $profile)
    {
        return parent::__construct($profile);
    }
    public function update($user, $data)
    {
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        return $user->profile->fill($data)->save();
    }
}
