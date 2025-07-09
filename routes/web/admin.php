<?php

use App\Http\Controllers\WEB\Admin\EmailLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Admin\Auth\AdminLoginController;
use App\Http\Controllers\WEB\Admin\AdminPanelController;
use App\Http\Controllers\WEB\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\WEB\Admin\Patient\PatientController;
use App\Http\Controllers\WEB\Admin\Appointments\AppointmentController;
use App\Http\Controllers\WEB\Admin\Doctor\DoctorController;

// ✅ صفحة تسجيل دخول الأدمن
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);

// ✅ مجموعة راوتات محمية بالأدوار (Role: admin)
Route::middleware(['auth:admin_web', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // ✅ تسجيل الخروج للأدمن
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // ✅ لوحة التحكم الرئيسية للأدمن
    Route::get('/dashboard', [AdminPanelController::class, 'index'])->name('dashboard');

     Route::get('/email_logs', [EmailLogController::class, 'index'])->name('email_logs');
    Route::get('/email_logs/{id}', [EmailLogController::class, 'show'])->name('email_logs.show');

    // ✅ إدارة تخصصات الأطباء - تتطلب صلاحية manage_specialties
    Route::prefix('specialties')->name('specialties.')->middleware('permission:manage_specialties')->group(function () {
        Route::get('/', [SpecialtyController::class, 'index'])->name('index');           // عرض جميع التخصصات
        Route::get('/create', [SpecialtyController::class, 'create'])->name('create');    // صفحة إنشاء تخصص جديد
        Route::post('/', [SpecialtyController::class, 'store'])->name('store');           // حفظ التخصص الجديد
        Route::get('/{id}/edit', [SpecialtyController::class, 'edit'])->name('edit');     // صفحة تعديل تخصص
        Route::put('/{id}', [SpecialtyController::class, 'update'])->name('update');      // حفظ التعديلات
        Route::delete('/{id}', [SpecialtyController::class, 'destroy'])->name('destroy'); // حذف التخصص
    });

    // ✅ إدارة الأطباء - تتطلب صلاحية manage_doctors
    Route::prefix('doctors')->name('doctors.')->middleware('permission:manage_doctors')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('index');                     // عرض جميع الأطباء
        Route::get('/create', [DoctorController::class, 'create'])->name('create');             // صفحة إضافة طبيب
        Route::post('/', [DoctorController::class, 'store'])->name('store');                    // حفظ بيانات الطبيب
        Route::get('/{id}/edit', [DoctorController::class, 'edit'])->name('edit');              // تعديل طبيب
        Route::put('/{id}', [DoctorController::class, 'update'])->name('update');               // حفظ التعديلات
        Route::delete('/{id}', [DoctorController::class, 'destroy'])->name('destroy');          // حذف الطبيب
        Route::patch('/{doctor}/toggle-status', [AdminPanelController::class, 'toggleStatusForDoctor'])->name('toggleStatus'); // تفعيل/إلغاء تفعيل طبيب
    });

    // ✅ إدارة المرضى
    Route::prefix('patients')->name('patients.')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('index'); // عرض قائمة المرضى
    });

    // ✅ إدارة المواعيد (بما فيها المحذوفة مؤقتًا)
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('index');                       // جميع المواعيد
        Route::get('/trashed', [AppointmentController::class, 'trashed'])->name('trashed');            // المواعيد المحذوفة مؤقتًا
        Route::delete('/{id}/force-delete', [AppointmentController::class, 'forceDelete'])->name('forceDelete'); // حذف نهائي لموعد
    });

});
