<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;

class PasswordController extends Controller
{
    public function __construct(protected AuthService $authService) {}
    /**
     * Update the user's password.
     */
    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();

        $this->authService->changePassword($user, $data['password']);

        return back()->with('status', 'password-updated');
    }
}
