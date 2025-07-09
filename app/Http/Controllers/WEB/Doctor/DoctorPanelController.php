<?php

namespace App\Http\Controllers\WEB\Doctor;

use App\Events\AppointmentStatusUpdated;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\DoctorService;
use Illuminate\Http\Request;
use App\Models\EmailLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DoctorPanelController extends Controller
{
    /**
     * عرض جميع المواعيد للطبيب مع إمكانية الفلترة
     */
    public $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function allAppointments(Request $request)
    {
        $doctorId = auth('doctor_web')->id();

        $appointments = Appointment::byDoctor($doctorId)
            ->with('user')
            ->filter($request->all())
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('doctor.dashboard.appointments', compact('appointments'));
    }

    /**
     * عرض لوحة تحكم الطبيب مع مواعيد اليوم والإحصائيات
     */
    public function dashboard(Request $request)
    {
        $doctorId = auth('doctor_web')->id();

        $appointmentsToday = Appointment::byDoctor($doctorId)
            ->appointmentsForToday()
            ->with(relations: 'user')
            ->orderBy('date')
            ->get();

        $stats = [
            'today' => $appointmentsToday->count(),
            'confirmed' => Appointment::byDoctor($doctorId)->confirmed()->count(),
            'cancelled' => Appointment::byDoctor($doctorId)->canceled()->count(),
            'pending' => Appointment::byDoctor($doctorId)->pending()->count(),
        ];

        return view('doctor.dashboard.dashboard', compact('appointmentsToday', 'stats'));
    }

    /**
     * قبول موعد من قبل الطبيب
     */
    public function confirm($id)
    {
        try {
            if (!Auth::guard('doctor_web')->check()) {
                return redirect()->back()->with('error', 'يجب تسجيل الدخول كطبيب أولاً.');
            }

           $doctor= $this->doctorService->acceptAppointment($id);
            event(new AppointmentStatusUpdated($doctor));

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
            if (!Auth::guard('doctor_web')->check()) {
                return redirect()->back()->with('error', 'يجب تسجيل الدخول كطبيب أولاً.');
            }
           $doctor= $this->doctorService->rejectAppointment($id);
              event(new AppointmentStatusUpdated($doctor));
            return redirect()->back()->with('success', 'تم إلغاء الموعد.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }
    

public function emails()
{
    $doctorEmail = auth('doctor_web')->user()->email;

    $emails = EmailLog::where('to_email', $doctorEmail)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('doctor.dashboard.emails', compact('emails'));
}

}
