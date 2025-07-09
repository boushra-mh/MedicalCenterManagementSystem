<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Patient\AppointmentController;
use App\Http\Controllers\API\Admin\Specialty\SpecialtyController;

Route::prefix('patient')
    ->middleware(['auth:user', 'role:user'])
    ->group(function () {

        // 🧬 عرض جميع التخصصات
        Route::get('specialties', [SpecialtyController::class, 'index']);

        // 👨‍⚕️ عرض الأطباء حسب التخصص
        Route::get('specialty/{id}/doctors', [SpecialtyController::class, 'doctors']);

        // ✅ عرض المواعيد المؤكدة
        Route::get('appointments/confirmed', [AppointmentController::class,'getConfirmedAppointment']);

        // ❌ عرض المواعيد الملغاة
        Route::get('appointments/canceled', [AppointmentController::class,'getCancledAppointment']);

        // ⏳ عرض المواعيد قيد الانتظار
        Route::get('appointments/pending', [AppointmentController::class,'getPendingAppointment']);

        // 🔎 فلترة المواعيد
        Route::get('appointments/filter', [AppointmentController::class,'filter']);

        // 🧹 حذف موعد ليصبح مؤرشفاً 
        Route::delete('appointments/{id}/forceDelete', [AppointmentController::class,'forceDelete']);

        // 🗓️ إدارة المواعيد (عرض، حجز، إلغاء) - تتطلب صلاحية `book_appointment`
        Route::middleware('permission:book_appointment')->group(function () {

            // 📃 عرض كل المواعيد
            // ➕ حجز موعد جديد
            Route::resource('appointments', AppointmentController::class)->only(['index', 'store']);

            // 🚫 إلغاء موعد محجوز
            Route::post('appointments/{id}/cancel', [AppointmentController::class, 'cancel']);
        });
});
