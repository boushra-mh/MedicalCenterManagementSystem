<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Doctor\DoctorController;

Route::prefix('doctor')
    ->middleware(['auth:doctor', 'role:doctor'])
    ->group(function () {

        // 🔒 مواعيد الطبيب مع صلاحية view_appointment
        Route::middleware('permission:view_appointment')->group(function () {
            Route::get('appointments', [DoctorController::class, 'doctorAppointments']);
            Route::get('appointments/appointmentsForToday', [DoctorController::class, 'appointmentsForToday']);
        });

        // ✅ استعلامات خاصة بالحالة أو التصفية
        Route::get('appointments/confirmed', [DoctorController::class, 'getConfirmedAppointment']);
        Route::get('appointments/canceled', [DoctorController::class, 'getCancledAppointment']);
        Route::get('appointments/filter', [DoctorController::class, 'filter']);

        // ❌ رفض أو ✅ قبول موعد
        Route::post('appointment/{id}/reject', [DoctorController::class, 'reject']);
        Route::post('appointment/{id}/accept', [DoctorController::class, 'accept']);
    });
