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

        /**
         * SECTION -
         * هنا يقوم Laravel
         *  بـ إبطال الجلسة الحالية
         *  أي حذف جميع بيانات الجلسة
         *  مثل بيانات المستخدم والرسائل المؤقتة flash data)
         *  منع إعادة استخدام هذه الجلسة في المستقبل
         */
        $request->session()->invalidate();

        /**
         * إعادة إنشاء CSRF token جديد
         * بعد تسجيل الخروج، من الأفضل توليد رمز جديد لتعزيز الأمان
         */
        $request->session()->regenerateToken();

        return redirect()->route('doctor.login');
    }
}
