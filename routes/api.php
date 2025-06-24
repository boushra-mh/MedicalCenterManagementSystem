<?php

use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\Doctor\DoctorController;
use App\Http\Controllers\API\Patient\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});

Route::prefix('doctor')->middleware('auth:doctor')->group(function () {
    Route::get('/profile', [DoctorController::class, 'profile']);
});

Route::prefix('patient')->middleware('auth:patient')->group(function () {
    Route::get('/appointments', [PatientController::class, 'appointments']);
});

