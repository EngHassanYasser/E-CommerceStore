<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ) {}
    public function edit()
    {
        $data = $this->profileService->getEditData();

        return view('dashboard.profile.edite', $data);
    }

    public function update(UpdateProductRequest $request)
    {
        $data=$request->validated();
        $this->profileService->update($request->user(), $data);

        return redirect()->route('profile.edite')->with('success', 'Profile updated successfully');
    }
}
