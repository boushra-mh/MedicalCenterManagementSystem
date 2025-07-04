<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Patient\AppointmentController;
use App\Http\Controllers\API\Patient\Auth\PatientLoginController;
use App\Http\Controllers\API\Patient\Auth\PatientRegisterController;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;

Route::prefix('patient')->middleware(['auth:user', 'role:user'])->group(function () {
    Route::get('specialties', [SpecialtyController::class, 'index']);
    Route::get('specialty/{id}/doctors', [SpecialtyController::class, 'doctors']);
    Route::get('appointments/confirmed', [AppointmentController::class,'getConfirmedAppointment']);
    Route::get('appointments/canceled', [AppointmentController::class,'getCancledAppointment']);
    Route::get('appointments/pending', [AppointmentController::class,'getPendingAppointment']);
    Route::get('appointments/filter', [AppointmentController::class,'filter']);
    Route::delete('appointments/{id}/forceDelete', [AppointmentController::class,'forceDelete']);

    Route::middleware('permission:book_appointment')->group(function () {
        Route::resource('appointments', AppointmentController::class)->only(['index', 'store']);
        Route::post('appointments/{id}/cancel', [AppointmentController::class, 'cancel']);
    });
});
