<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): Renderable
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->back()->withErrors([
            'email' => __('A user with those credentials could not be found'),
        ]);
    }

    public function logout(): Renderable
    {
        return view('auth.logout');
    }

    public function confirmed(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
