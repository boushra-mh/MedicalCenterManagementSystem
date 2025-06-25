<?php

use App\Http\Controllers\API\Admin\AdminController;

use App\Http\Controllers\API\Doctor\DoctorController;

use App\Http\Controllers\API\Admin\Auth\AdminLoginController;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;
use App\Http\Controllers\API\Doctor\Auth\DoctorLoginController;

use App\Http\Controllers\API\Patient\Auth\PatientLoginController;

use App\Http\Controllers\API\Patient\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 Route::post('patient/login', [PatientLoginController::class, 'login']);
  Route::post('doctor/login', [DoctorLoginController::class, 'login']);
  Route::post('admin/login', [AdminLoginController::class, 'login']);


Route::prefix('doctor')->middleware('auth:doctor')->group(function () {
   
});



Route::prefix('admin')->middleware('auth:admin')->group(function () {
Route::resource('specialties',SpecialtyController::class);
Route::resource('doctors',DoctorController::class);
});



Route::prefix('patient')->middleware('auth:patient')->group(function () {
   

});


