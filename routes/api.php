<?php

use App\Http\Controllers\API\Admin\Auth\AdminLoginController;
use App\Http\Controllers\API\Doctor\Auth\DoctorLoginController;
use App\Http\Controllers\API\Patient\Auth\PatientLoginController;
use App\Http\Controllers\API\Patient\Auth\PatientRegisterController;


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


