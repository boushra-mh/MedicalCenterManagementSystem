<?php

use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// التبديل بين اللغات
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) abort(400);
    session(['locale' => $locale]);
    return back();
})->name('lang.switch');

// استدعاء ملفات الروتس المفصولة
require __DIR__.'/admin_web.php';
require __DIR__.'/doctor_web.php';
require __DIR__.'/patient_web.php';
