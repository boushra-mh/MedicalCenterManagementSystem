<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WEB\Admin\Auth\AdminDashboardController;
use App\Http\Controllers\WEB\Admin\Auth\AdminLoginController;
use App\Http\Controllers\WEB\User\Auth\UserRegisterController;
use App\Http\Controllers\WEB\Doctor\Auth\DoctorRegisterController;
use App\Http\Controllers\WEB\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\WEB\User\Auth\UserLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Admin\Specialty\SpecialtyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Routes for admin login (unauthenticated)
// ✅ routes/web.php

// صفحة تسجيل دخول المشرف
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])
    
    ->name('admin.login');

// عملية تسجيل الدخول
Route::post('admin/login', [AdminLoginController::class, 'login'])
;

// بعد تسجيل الدخول - لوحة التحكم
Route::middleware('auth:admin_web')->prefix('admin')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::prefix('user')->group(function () {
    // صفحة تسجيل جديد
    Route::get('register', [UserRegisterController::class, 'showRegisterForm'])->name('user.register');
    Route::post('register', [UserRegisterController::class, 'register']);

    // صفحة تسجيل دخول
    Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('login', [UserLoginController::class, 'login']);
});

Route::prefix('user')->middleware('auth')->group(function () {
    // صفحة لوحة تحكم المريض
    Route::get('dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // تسجيل خروج
    Route::post('logout', [UserLoginController::class, 'logout'])->name('user.logout');
});
Route::prefix('doctor')->middleware('guest:doctor_web')->group(function () {
    Route::get('register', [DoctorRegisterController::class, 'showRegisterForm'])->name('doctor.register');
    Route::post('register', [DoctorRegisterController::class, 'register']);

    Route::get('login', [DoctorLoginController::class, 'showLoginForm'])->name('doctor.login');
    Route::post('login', [DoctorLoginController::class, 'login']);
});

Route::prefix('doctor')->middleware('auth:doctor_web')->group(function () {
    Route::get('dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');

    Route::post('logout', [DoctorLoginController::class, 'logout'])->name('doctor.logout');
});
// routes/web.php
// routes/web.php



Route::prefix('admin/specialties')
  //  ->middleware(['auth:admin_web'])
    ->name('admin.specialties.')
    ->group(function () {
        Route::get('/', [SpecialtyController::class, 'index'])->name('index');            // 🗂️ قائمة التخصصات
        Route::get('/create', [SpecialtyController::class, 'create'])->name('create');    // ➕ عرض نموذج الإنشاء
        Route::post('/', [SpecialtyController::class, 'store'])->name('store');           // 💾 حفظ تخصص جديد
        Route::get('/{id}/edit', [SpecialtyController::class, 'edit'])->name('edit');     // 🖊️ عرض نموذج التعديل
        Route::put('/{id}', [SpecialtyController::class, 'update'])->name('update');      // 🔄 تحديث التخصص
        Route::delete('/{id}', [SpecialtyController::class, 'destroy'])->name('destroy'); // 🗑️ حذف التخصص
    });
