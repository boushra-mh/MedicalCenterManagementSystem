<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\API\Doctor\DoctorController;
use App\Http\Controllers\API\Admin\ManagementPanel\AdminManagementPanel;

Route::prefix('admin')
    ->middleware(['auth:admin', 'role:admin'])
    ->group(function () {

        // 🩺 إدارة التخصصات - تتطلب صلاحية manage_specialties
        Route::middleware('permission:manage_specialties')->group(function () {
            Route::resource('specialties', SpecialtyController::class);
        });

        // 👨‍⚕️ إدارة الأطباء - تتطلب صلاحية manage_doctors
        Route::middleware('permission:manage_doctors')->group(function () {
            Route::resource('doctors', DoctorController::class);
        });

        // 🧹 حذف دائم لموعد محذوف (soft deleted)
        Route::delete('appointments/{id}/deleteTashedAppointments', [AdminManagementPanel::class, 'deleteTashedAppointments']);

        // 📊 عرض لوحة الإحصائيات للإدمن
        Route::get('appointments/AdminStaticsPanel', [AdminManagementPanel::class, 'AdminStaticsPanel']);

        // 📅 عرض مواعيد اليوم
        Route::get('appointments/dailyAppointments', [AdminManagementPanel::class, 'dailyAppointments']);

        //👨‍⚕️ تحديث حالة الحساب الخاصة بالطبيب
        Route::post('toggle-Status-For-Doctor/{id}', [AdminManagementPanel::class,'toggleStatusForDoctor']);
    });
