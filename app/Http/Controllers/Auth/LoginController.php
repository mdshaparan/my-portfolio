<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Brute-force protection: 5 failed attempts = 1 minute lockout
        $key = Str::lower($credentials['email']) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => "Too many attempts. Please try again in {$seconds} seconds."]);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            return redirect()->intended('/my-dashboard');
        }

        RateLimiter::hit($key, 60);

        return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'Email ba password thik na.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/shaparan-panel-7x9k')->with('message', 'You have been logged out.');
    }
}
