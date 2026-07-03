<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegisteredUserRequest;
use App\Providers\RouteServiceProvider;
use App\Services\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function __construct(protected AuthService $authService) {}
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(StoreRegisteredUserRequest $request): RedirectResponse
    // {
    // //    dd($request->validated());
        
    // //     $user = $this->authService->createUser($request->validated());
    // //     event(new UserCreated($user));
    // //     event(new Registered($user));


    // //     Auth::login($user);

    // //     return redirect(RouteServiceProvider::HOME);
    // }
}
