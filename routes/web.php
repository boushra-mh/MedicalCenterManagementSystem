<?php

use App\Http\Controllers\Web\Admin\AdminPanelController;
use App\Http\Controllers\Web\Doctor\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WEB\Admin\Auth\AdminDashboardController;
use App\Http\Controllers\WEB\Admin\Auth\AdminLoginController;
use App\Http\Controllers\WEB\User\Auth\UserRegisterController;
use App\Http\Controllers\WEB\Doctor\Auth\DoctorRegisterController;
use App\Http\Controllers\WEB\Doctor\DoctorPanelController;
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

Route::prefix('doctor')->group(function () {
    Route::get('dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');
 Route::get('login', [DoctorLoginController::class, 'showLoginForm'])->name('doctor.login');
    Route::post('login', [DoctorLoginController::class, 'login']);
    Route::post('logout', [DoctorLoginController::class, 'logout'])->name('doctor.logout');
});
// routes/web.php
// routes/web.php




Route::prefix('doctor')->name('doctor.')->middleware('auth:doctor_web')->group(function () {
    // لوحة التحكم (مواعيد اليوم + إحصائيات)
    Route::get('/dashboard', [DoctorPanelController::class, 'dashboard'])->name('dashboard');

    // عرض جميع المواعيد مع فلاتر
    Route::get('/appointments', [DoctorPanelController::class, 'allAppointments'])->name('appointments.index');

    // تأكيد موعد
    Route::post('/appointments/{id}/confirm', [DoctorPanelController::class, 'confirm'])->name('appointments.confirm');

    // إلغاء موعد
    Route::post('/appointments/{id}/cancel', [DoctorPanelController::class, 'cancel'])->name('appointments.cancel');

    // الملف الشخصي للطبيب
    Route::get('/profile', function () {
        return view('doctor.dashboard.profile');
    })->name('profile');
});





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
    Route::prefix('admin/doctors')->name('admin.doctors.')->middleware(['auth:admin_web'])->group(function () {
    Route::get('/', [DoctorController::class, 'index'])->name('index');
    Route::get('/create', [DoctorController::class, 'create'])->name('create');
    Route::post('/', [DoctorController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [DoctorController::class, 'edit'])->name('edit');
    Route::put('/{id}', [DoctorController::class, 'update'])->name('update');
    Route::delete('/{id}', [DoctorController::class, 'destroy'])->name('destroy');
    Route::patch('/{doctor}/toggle-status', [AdminPanelController::class, 'toggleStatusForDoctor'])->name('toggleStatus');

});

