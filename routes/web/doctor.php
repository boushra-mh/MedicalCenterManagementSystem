<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\WEB\Doctor\DoctorPanelController;

// 🔐 راوتات تسجيل دخول وخروج الطبيب
Route::prefix('doctor')->group(function () {

    // 🔑 صفحة تسجيل دخول الطبيب
    Route::get('login', [DoctorLoginController::class, 'showLoginForm'])->name('doctor.login');

    // 🚪 إرسال بيانات تسجيل الدخول
    Route::post('login', [DoctorLoginController::class, 'login']);

    // 🔒 تسجيل خروج الطبيب
    Route::post('logout', [DoctorLoginController::class, 'logout'])->name('doctor.logout');
});

// 👨‍⚕️ راوتات محمية للطبيب المسجّل - تتطلب التوثيق والدور doctor
Route::prefix('doctor')
    ->name('doctor.')
    ->middleware(['auth:doctor_web', 'role:doctor'])
    ->group(function () {

        // 📧 عرض رسائل البريد الإلكتروني للطبيب
        Route::get('/emails', [DoctorPanelController::class, 'emails'])->name('emails');

        // 📊 لوحة تحكم الطبيب الرئيسية
        Route::get('/dashboard', [DoctorPanelController::class, 'dashboard'])->name('dashboard');

        // 📅 عرض جميع مواعيد الطبيب
        Route::get('/appointments', [DoctorPanelController::class, 'allAppointments'])->name('appointments.index');

        // ✅ تأكيد موعد معين
        Route::post('/appointments/{id}/confirm', [DoctorPanelController::class, 'confirm'])->name('appointments.confirm');

        // ❌ إلغاء موعد معين
        Route::post('/appointments/{id}/cancel', [DoctorPanelController::class, 'cancel'])->name('appointments.cancel');

        // 👤 صفحة الملف الشخصي للطبيب (اختياري)
        Route::get('/profile', function () {
            return view('doctor.dashboard.profile');
        })->name('profile');
    });
