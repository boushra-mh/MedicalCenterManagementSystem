<?php

namespace App\Http\Controllers\WEB\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;


use App\Models\Appointment;


class DoctorPanelController extends Controller
{
    /**
     * عرض جميع المواعيد للطبيب مع إمكانية الفلترة
     */
    public function allAppointments(Request $request)
    {
        $doctorId = auth('doctor')->id();

        $appointments = Appointment::byDoctor($doctorId)
            ->with('patient')
            ->filter($request->all())
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('doctor.dashboard.appointments', compact('appointments'));
    }

    /**
     * عرض لوحة تحكم الطبيب مع مواعيد اليوم والإحصائيات
     */
    public function dashboard()
    {
        $doctorId = auth('doctor')->id();

        $appointmentsToday = Appointment::byDoctor($doctorId)
            ->appointmentsForToday()
            ->orderBy('date')
            ->get();

        $stats = [
            'today'     => $appointmentsToday->count(),
            'confirmed' => Appointment::byDoctor($doctorId)->confirmed()->count(),
            'cancelled' => Appointment::byDoctor($doctorId)->canceled()->count(),
            'pending'   => Appointment::byDoctor($doctorId)->pending()->count(),
        ];

        return view('doctor.dashboard.dashboard', compact('appointmentsToday', 'stats'));
    }

    /**
     * قبول موعد من قبل الطبيب
     */
    public function confirm($id)
    {
        try {
            app(\App\Services\DoctorService::class)->acceptAppointment($id);
            return redirect()->back()->with('success', 'تم تأكيد الموعد بنجاح.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }

    /**
     * رفض موعد من قبل الطبيب
     */
    public function cancel($id)
    {
        try {
            app(\App\Services\DoctorService::class)->rejectAppointment($id);
            return redirect()->back()->with('success', 'تم إلغاء الموعد.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }
}
