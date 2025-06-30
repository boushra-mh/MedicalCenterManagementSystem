<?php

use App\Http\Controllers\API\Admin\Auth\AdminLoginController;
use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\API\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\API\Doctor\DoctorController;

use App\Http\Controllers\API\Patient\Auth\PatientLoginController;
use App\Http\Controllers\API\Patient\Auth\PatientRegisterController;
use App\Http\Controllers\API\Patient\AppointmentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// 🔐 Authentication Routes

/**
 * @group Authentication - Patient
 *
 * Log in as a patient.
 *
 * @bodyParam email string required The patient's email. Example: patient@example.com
 * @bodyParam password string required The patient's password. Example: password
 *
 * @response 200 {
 *   "access_token": "token_string",
 *   "token_type": "Bearer"
 * }
 */
Route::post('patient/register', [PatientRegisterController::class, 'register']);
Route::post('patient/login', [PatientLoginController::class, 'login']);
Route::post('doctor/login', [DoctorLoginController::class, 'login']);
Route::post('admin/login', [AdminLoginController::class, 'login']);


// 👨‍💼 Admin Panel

Route::prefix('admin')->middleware(['auth:admin', 'role:admin'])->group(function () {
    //  manage_specialties
    Route::middleware('permission:manage_specialties')->group(function () {
        Route::resource('specialties', SpecialtyController::class);
    });

    //  manage_doctors
    Route::middleware('permission:manage_doctors')->group(function () {
        Route::resource('doctors', DoctorController::class);
    });
});


// 🧑‍⚕️ Doctor Panel
Route::prefix('doctor')->middleware(['auth:doctor', 'role:doctor'])->group(function () {
    //  view_appointment
    Route::middleware('permission:view_appointment')->group(function () {
        Route::get('appointments', [DoctorController::class, 'doctorAppointments']);
    });
    
    Route::post('appointment/{id}/reject',[DoctorController::class,'reject']);
     Route::post('appointment/{id}/accept',[DoctorController::class,'accept']);
});



// 👤 Patient Panel (User)

Route::prefix('patient')->middleware(['auth:user', 'role:user'])->group(function () {
    //  Publicly viewable
    Route::get('specialties', [SpecialtyController::class, 'index']);
    Route::get('specialty/{id}/doctors', [SpecialtyController::class, 'doctors']);

    //  book_appointment
    Route::middleware('permission:book_appointment')->group(function () {
        /**
 * @group Patient Appointments
 *
 * Get all appointments for the authenticated patient.
 *
 * @authenticated
 */

        /**
 * @group Patient Appointments
 *
 * Book a new appointment.
 *
 * @bodyParam doctor_id int required The ID of the doctor.
 * @bodyParam date date required The date of the appointment (YYYY-MM-DD).
 * @bodyParam time string required Time of appointment (e.g. 10:00).
 * @authenticated
 */
        Route::resource('appointments', AppointmentController::class)->only(['index', 'store']);
        Route::post('appointments/{id}/cancel', [AppointmentController::class, 'cancel']);
    });
});
