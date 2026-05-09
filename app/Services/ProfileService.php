<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Profile\ProfileRepository;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileService
{
    public function __construct(protected ProfileRepository $profileRepository) {}
    public function getEditData()
    {
        return [
            'user' => Auth::user(),
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames()
        ];
    }
    public function destroy(User $user)
    {
        $this->profileRepository->delete($user);
    }
    public function update($user, $data)
    {
        $this->profileRepository->update($user, $data);
    }
}
