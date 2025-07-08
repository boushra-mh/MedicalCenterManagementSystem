<?php

use App\Http\Controllers\WEB\User\UserDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WEB\Admin\Auth\AdminLoginController;
use App\Http\Controllers\WEB\Admin\AdminPanelController;
use App\Http\Controllers\WEB\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\WEB\Doctor\DoctorPanelController;
use App\Http\Controllers\WEB\Doctor\DoctorController;
use App\Http\Controllers\WEB\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\WEB\Doctor\Auth\DoctorRegisterController;
use App\Http\Controllers\WEB\User\Auth\UserLoginController;
use App\Http\Controllers\WEB\User\Auth\UserRegisterController;
use App\Http\Controllers\WEB\Admin\Patient\PatientController;
use App\Http\Controllers\WEB\Admin\Appointments\AppointmentController;
use App\Http\Controllers\WEB\User\UserAppointmentController ;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// صفحة داشبورد افتراضية (للمستخدمين المسجلين عبر Laravel Breeze مثلاً)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// في routes/web.php

Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }

    session(['locale' => $locale]);
    return back();
})->name('lang.switch');
 

require __DIR__.'/auth.php';

/**
 * ✅ ADMIN Routes
 */

// تسجيل دخول الأدمن
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);

// لوحة تحكم الأدمن والمصادقة
Route::middleware('auth:admin_web')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminPanelController::class, 'index'])->name('dashboard');

    // تخصصات الأطباء
    Route::prefix('specialties')->name('specialties.')->group(function () {
        Route::get('/', [SpecialtyController::class, 'index'])->name('index');
        Route::get('/create', [SpecialtyController::class, 'create'])->name('create');
        Route::post('/', [SpecialtyController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SpecialtyController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SpecialtyController::class, 'update'])->name('update');
        Route::delete('/{id}', [SpecialtyController::class, 'destroy'])->name('destroy');
    });

    // إدارة الأطباء
    Route::prefix('doctors')->name('doctors.')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('index');
        Route::get('/create', [DoctorController::class, 'create'])->name('create');
        Route::post('/', [DoctorController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DoctorController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DoctorController::class, 'update'])->name('update');
        Route::delete('/{id}', [DoctorController::class, 'destroy'])->name('destroy');
        Route::patch('/{doctor}/toggle-status', [AdminPanelController::class, 'toggleStatusForDoctor'])->name('toggleStatus');
    });

    // إدارة المرضى
    Route::prefix('patients')->name('patients.')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('index');
    });

    // إدارة المواعيد
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('index');
        Route::get('/trashed', [AppointmentController::class, 'trashed'])->name('trashed');
        Route::delete('/{id}/force-delete', [AppointmentController::class, 'forceDelete'])->name('forceDelete');
    });
});

/**
 * ✅ USER (PATIENT) Routes
 */
Route::prefix('user')->group(function () {
    // تسجيل جديد وتسجيل الدخول
    Route::get('register', [UserRegisterController::class, 'showRegisterForm'])->name('user.register');
    Route::post('register', [UserRegisterController::class, 'register']);

    Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('login', [UserLoginController::class, 'login']);

    // مصادقة المستخدم
    Route::middleware('auth')->group(function () {
        Route::post('logout', [UserLoginController::class, 'logout'])->name('user.logout');

        // لوحة التحكم
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
            // عرض صفحة اختيار التخصص
    //Route::get('specialties', [UserDashboardController::class, 'index'])->name('specialties.index');

    // عرض الأطباء ضمن تخصص معيّن
    Route::get('specialties/{id}/doctors', [UserDashboardController::class, 'showDoctors'])->name('specialties.doctors');

        // المواعيد مع إضافة البريفكس للاسم 'user.'
        Route::prefix('appointments')->name('user.appointments.')->group(function () {
            Route::get('/', [UserAppointmentController::class, 'index'])->name('index');
            Route::get('/create', [UserAppointmentController::class, 'create'])->name('create');
            Route::post('/', [UserAppointmentController::class, 'store'])->name('store');
            Route::post('/{id}/cancel', [UserAppointmentController::class, 'cancel'])->name('cancel');
            Route::delete('/{id}', [UserAppointmentController::class, 'destroy'])->name('destroy');

        });
    });
});


/**
 * ✅ DOCTOR Routes
 */
Route::prefix('doctor')->group(function () {
    Route::get('login', [DoctorLoginController::class, 'showLoginForm'])->name('doctor.login');
    Route::post('login', [DoctorLoginController::class, 'login']);
    Route::post('logout', [DoctorLoginController::class, 'logout'])->name('doctor.logout');
});

Route::prefix('doctor')->name('doctor.')->middleware('auth:doctor_web')->group(function () {
    Route::get('/dashboard', [DoctorPanelController::class, 'dashboard'])->name('dashboard');
    Route::get('/appointments', [DoctorPanelController::class, 'allAppointments'])->name('appointments.index');
    Route::post('/appointments/{id}/confirm', [DoctorPanelController::class, 'confirm'])->name('appointments.confirm');
    Route::post('/appointments/{id}/cancel', [DoctorPanelController::class, 'cancel'])->name('appointments.cancel');
    Route::get('/profile', function () {
        return view('doctor.dashboard.profile');
    })->name('profile');
});
