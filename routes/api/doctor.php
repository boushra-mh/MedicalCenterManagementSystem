<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Doctor\DoctorController;

Route::prefix('doctor')
    ->middleware(['auth:doctor', 'role:doctor'])
    ->group(function () {

        // 👨‍⚕️ عرض المواعيد - تتطلب صلاحية view_appointment
        Route::middleware('permission:view_appointment')->group(function () {

            // 📅 عرض جميع مواعيد الطبيب
            Route::get('appointments', [DoctorController::class, 'doctorAppointments']);

            // 📆 عرض مواعيد اليوم الحالي
            Route::get('appointments/appointmentsForToday', [DoctorController::class, 'appointmentsForToday']);
        });

        // ✅ عرض المواعيد المؤكدة
        Route::get('appointments/confirmed', [DoctorController::class, 'getConfirmedAppointment']);

        // ❌ عرض المواعيد الملغاة
        Route::get('appointments/canceled', [DoctorController::class, 'getCancledAppointment']);

        // 🔎 فلترة المواعيد حسب الحالة أو التاريخ
        Route::get('appointments/filter', [DoctorController::class, 'filter']);

        // 🚫 رفض موعد
        Route::post('appointment/{id}/reject', [DoctorController::class, 'reject']);

        // ✅ قبول موعد
        Route::post('appointment/{id}/accept', [DoctorController::class, 'accept']);
    });
