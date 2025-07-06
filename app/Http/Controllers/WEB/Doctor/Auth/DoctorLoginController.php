<?php

namespace App\Http\Controllers\WEB\Doctor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('doctor.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('doctor_web')->attempt($credentials)) {
            return redirect()->intended(route('doctor.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('doctor_web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('doctor.login');
    }
}
