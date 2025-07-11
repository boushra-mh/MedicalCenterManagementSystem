<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\User\UserDashboardController;
use App\Http\Controllers\WEB\User\Auth\UserLoginController;
use App\Http\Controllers\WEB\User\Auth\UserRegisterController;
use App\Http\Controllers\WEB\User\UserAppointmentController;

// 👤 راوتات خاصة بالمستخدم (المريض)
Route::prefix('user')->group(function () {

    // 📝 تسجيل مستخدم جديد (تسجيل حساب)
    Route::get('register', [UserRegisterController::class, 'showRegisterForm'])->name('user.register');  // صفحة التسجيل
    Route::post('register', [UserRegisterController::class, 'register']);                                // إرسال بيانات التسجيل

    // 🔐 تسجيل دخول المستخدم
    Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('user.login');              // صفحة تسجيل الدخول
    Route::post('login', [UserLoginController::class, 'login']);                                         // إرسال بيانات الدخول

    // 🔒 راوتات محمية للمستخدم المسجّل - تتطلب توثيق + دور user
    Route::middleware(['auth', 'role:user'])->group(function () {

        // 📧 عرض رسائل البريد الإلكتروني للمستخدم
        Route::get('/emails', [UserDashboardController::class, 'emails'])->name('emails');

        // 📬 عرض حالة المواعيد ورسائل التأكيد والإشعارات
        Route::get('/appointment_status', [UserDashboardController::class, 'showEmailsStatus'])->name('appointment_status');

        // 🚪 تسجيل خروج المستخدم
        Route::post('logout', [UserLoginController::class, 'logout'])->name('user.logout');

        // 📊 لوحة تحكم المستخدم (المريض)
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

        // 🩺 عرض الأطباء حسب التخصص
        Route::get('specialties/{id}/doctors', [UserDashboardController::class, 'showDoctors'])->name('specialties.doctors');

        // 📅 إدارة مواعيد المستخدم (المريض)
        Route::prefix('appointments')->name('user.appointments.')->group(function () {
            Route::get('/', [UserAppointmentController::class, 'index'])->name('index');                   // عرض جميع المواعيد
            Route::get('/create', [UserAppointmentController::class, 'create'])->name('create');           // صفحة حجز موعد جديد
            Route::post('/', [UserAppointmentController::class, 'store'])->name('store');                  // حفظ الموعد الجديد
            Route::post('/{id}/cancel', [UserAppointmentController::class, 'cancel'])->name('cancel');     // إلغاء موعد
            Route::delete('/{id}', [UserAppointmentController::class, 'destroy'])->name('destroy');        // حذف الموعد نهائيًا
        });
    });
});
