<?php

use App\Http\Controllers\API\Admin\Auth\AdminLoginController;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\API\Admin\AdminController;
<<<<<<< HEAD
use App\Http\Controllers\API\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\API\Doctor\DoctorController;
use App\Http\Controllers\API\Patient\Auth\PatientLoginController;
use App\Http\Controllers\API\Patient\Auth\PatientRegisterController;
use App\Http\Controllers\API\Patient\AppointmentController;
=======
use App\Http\Controllers\API\Admin\Auth\AdminLoginController;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\API\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\API\Doctor\DoctorController;
use App\Http\Controllers\API\Patient\Auth\PatientLoginController;
>>>>>>> 3aa0de5 (SpecialtiesPanel)
use App\Http\Controllers\API\Patient\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
<<<<<<< HEAD


// 🔐 Authentication Routes

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
});

=======
    Route::post('admin/login', [AdminLoginController::class, 'login']);
        Route::post('doctor/login', [DoctorLoginController::class, 'login']);
 Route::post('patient/login', [PatientLoginController::class, 'login']);
Route::prefix('admin')->middleware('auth:admin')->group(function () {
Route::resource('specialties',SpecialtyController::class);
});

Route::prefix('doctor')->middleware('auth:doctor')->group(function () {

});

Route::prefix('patient')->middleware('auth:patient')->group(function () {
   
});
>>>>>>> 3aa0de5 (SpecialtiesPanel)

// 👤 Patient Panel (User)

Route::prefix('patient')->middleware(['auth:user', 'role:user'])->group(function () {
    //  Publicly viewable
    Route::get('specialties', [SpecialtyController::class, 'index']);
    Route::get('specialty/{id}/doctors', [SpecialtyController::class, 'doctors']);

    //  book_appointment
    Route::middleware('permission:book_appointment')->group(function () {
        Route::resource('appointments', AppointmentController::class)->only(['index', 'store']);
        Route::post('appointments/{id}/cancel', [AppointmentController::class, 'cancel']);
    });
});
