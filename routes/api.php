<?php

use App\Http\Controllers\API\Admin\Auth\AdminLoginController;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\API\Doctor\DoctorController;
use App\Http\Controllers\API\Patient\Auth\PatientLoginController;
use App\Http\Controllers\API\Patient\Auth\patientRegisterController;
use App\Http\Controllers\API\Patient\AppointmentController;
use App\Http\Controllers\API\Patient\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 🔐 Authentication Routes
Route::post('patient/register', [PatientRegisterController::class, 'register']);
Route::post('patient/login', [PatientLoginController::class, 'login']);
Route::post('doctor/login', [DoctorLoginController::class, 'login']);
Route::post('admin/login', [AdminLoginController::class, 'login']);

// 🧑‍⚕️ Doctor Panel
Route::prefix('doctor')->middleware('auth:doctor')->group(function () {
    Route::get('appointments', [DoctorController::class, 'doctorAppointments']);
});

// 👨‍💼 Admin Panel
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('doctors', DoctorController::class);
});

// 👤 Patient Panel
Route::prefix('patient')->middleware('auth:user')->group(function () {
    Route::get('specialties', [SpecialtyController::class, 'index']);
    Route::get('specialty/{id}/doctors', [SpecialtyController::class, 'doctors']);
    Route::resource('appointments', AppointmentController::class)->only(['index', 'store']);
    Route::post('appointments/{id}/cancel', [AppointmentController::class, 'cancel']);
});
