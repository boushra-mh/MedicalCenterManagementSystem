<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\User\UserDashboardController;
use App\Http\Controllers\WEB\User\Auth\UserLoginController;
use App\Http\Controllers\WEB\User\Auth\UserRegisterController;
use App\Http\Controllers\WEB\User\UserAppointmentController;

Route::prefix('user')->group(function () {
    // ✅ راوتات تسجيل جديد ودخول للمريض (User)
    Route::get('register', [UserRegisterController::class, 'showRegisterForm'])->name('user.register'); // صفحة تسجيل جديد
    Route::post('register', [UserRegisterController::class, 'register']);                                // إرسال التسجيل

    Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('user.login');              // صفحة تسجيل دخول
    Route::post('login', [UserLoginController::class, 'login']);                                         // إرسال بيانات الدخول

    // ✅ راوتات محمية للمريض المسجل - تتطلب التوثيق والدور user
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::post('logout', [UserLoginController::class, 'logout'])->name('user.logout');              // تسجيل الخروج

        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');       // لوحة تحكم المريض

        // ✅ عرض الأطباء حسب التخصص
        Route::get('specialties/{id}/doctors', [UserDashboardController::class, 'showDoctors'])->name('specialties.doctors');

        // ✅ إدارة المواعيد الخاصة بالمريض
        Route::prefix('appointments')->name('user.appointments.')->group(function () {
            Route::get('/', [UserAppointmentController::class, 'index'])->name('index');                   // عرض جميع المواعيد
            Route::get('/create', [UserAppointmentController::class, 'create'])->name('create');           // حجز موعد جديد
            Route::post('/', [UserAppointmentController::class, 'store'])->name('store');                  // حفظ الموعد
            Route::post('/{id}/cancel', [UserAppointmentController::class, 'cancel'])->name('cancel');     // إلغاء موعد
            Route::delete('/{id}', [UserAppointmentController::class, 'destroy'])->name('destroy');        // حذف الموعد نهائيًا
        });
    });
});
