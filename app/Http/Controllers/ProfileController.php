<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function __construct(
        protected ProfileService $profileService
    ) {}
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->profileService->update($request->user(), $request->validated());

        return redirect()->route('profile.edite')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        $this->profileService->destroy($user);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
