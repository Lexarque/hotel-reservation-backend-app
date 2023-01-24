<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\IAM\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\IAM\CreateUserRequest;

class AuthController extends Controller
{
    const ADMIN_ROLE = 'Admin';
    const RECEPTIONIST_ROLE = 'Receptionist';

    /**
     * 
     * @return Inertia
     */
    public function login(): Response
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Use this function to log in the user
     * 
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function authenticate(LoginRequest $request): JsonResponse
    {
        dd($request);
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            if (Auth::user()->role->name == self::ADMIN_ROLE || Auth::user()->role->name == self::RECEPTIONIST_ROLE) {
                // return redirect()->intended('/admin/dashboard');
            } else {
                // return redirect()->intended('/client/dashboard');
            }
        }

        return Response()->json(['message' => 'login failed']);
    }

    /**
     * This function is used to render the regsiter form
     * 
     * @return Response
     */
    public function showRegister(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Use this function to register a new user
     * 
     * @param CreateUserRequest $request
     * @return Redirector|RedirectResponse
     */
    public function register(CreateUserRequest $request): Redirector|RedirectResponse
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        return redirect('/login')->with(['message' => 'Registered Account Successfully']);
    }

    /**
     * This function is used to logout the current authenticated user
     * 
     * @return Redirector|RedirectResponse
     */
    public function logout(): Redirector|RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/client/dashboard');
    }
}
