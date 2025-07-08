<?php

namespace App\Http\Controllers\WEB\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DoctorRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('doctor.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $doctor = Doctor::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        $doctor->assignRole('doctor');
        Auth::guard('doctor_web')->login($doctor);

        return redirect()->route('doctor.dashboard');
    }
}
