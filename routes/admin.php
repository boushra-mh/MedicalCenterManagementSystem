<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Admin\Auth\AdminLoginController;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\API\Doctor\DoctorController;
use App\Http\Controllers\API\Admin\ManagementPanel\AdminManagementPanel;

Route::prefix('admin')
    ->middleware(['auth:admin', 'role:admin'])
    ->group(function () {

        // 🩺 إدارة التخصصات
        Route::middleware('permission:manage_specialties')->group(function () {
            Route::resource('specialties', SpecialtyController::class);
        });

        // 👨‍⚕️ إدارة الأطباء
        Route::middleware('permission:manage_doctors')->group(function () {
            Route::resource('doctors', DoctorController::class);
        });

        // 🧹 حذف دائم لموعد محذوف soft delete
        Route::delete('appointements/{id}/deleteTashedAppointments', [AdminManagementPanel::class, 'deleteTashedAppointments']);

        // 📊 لوحة إحصائيات الإدمن
        Route::get('appointements/AdminStaticsPanel', [AdminManagementPanel::class, 'AdminStaticsPanel']);

        // 📅 مواعيد اليوم
        Route::get('appointements/dailyAppointments', [AdminManagementPanel::class, 'dailyAppointments']);
    });
