<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\WEB\Doctor\DoctorPanelController;

// ✅ راوتات تسجيل دخول وخروج الطبيب
Route::prefix('doctor')->group(function () {
    Route::get('login', [DoctorLoginController::class, 'showLoginForm'])->name('doctor.login'); // صفحة تسجيل الدخول
    Route::post('login', [DoctorLoginController::class, 'login']);                              // إرسال بيانات الدخول
    Route::post('logout', [DoctorLoginController::class, 'logout'])->name('doctor.logout');     // تسجيل الخروج
});

// ✅ راوتات محمية للطبيب المسجّل - تتطلب التوثيق والدور doctor
Route::prefix('doctor')->name('doctor.')->middleware(['auth:doctor_web', 'role:doctor'])->group(function () {
    Route::get('/emails', [DoctorPanelController::class, 'emails'])->name('emails');


    
    Route::get('/dashboard', [DoctorPanelController::class, 'dashboard'])->name('dashboard');                     // لوحة تحكم الطبيب
    Route::get('/appointments', [DoctorPanelController::class, 'allAppointments'])->name('appointments.index');   // جميع المواعيد
    Route::post('/appointments/{id}/confirm', [DoctorPanelController::class, 'confirm'])->name('appointments.confirm'); // تأكيد الموعد
    Route::post('/appointments/{id}/cancel', [DoctorPanelController::class, 'cancel'])->name('appointments.cancel');   // إلغاء الموعد
    
    // ✅ ملف شخصي للطبيب (اختياري)
    Route::get('/profile', function () {
        return view('doctor.dashboard.profile');
    })->name('profile');

});
