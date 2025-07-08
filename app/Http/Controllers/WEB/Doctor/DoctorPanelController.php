<?php

namespace App\Http\Controllers\WEB\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;


use App\Models\Appointment;
use App\Services\DoctorService;
use Illuminate\Support\Facades\Auth;

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
            
            ->filter($request->all())
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
        if (!Auth::guard('doctor_web')->check()) {
            return redirect()->back()->with('error', 'يجب تسجيل الدخول كطبيب أولاً.');
        }

        $appointment = $this->doctorService->acceptAppointment($id);

        // إذا وصلت هنا، يعني تم التحديث بنجاح
        return redirect()->back()->with('success', 'تم تأكيد الموعد بنجاح.');
    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->errors());
    } catch (\Exception $e) {
        // خطأ عام - نجرب نعرف شو الخطأ
        return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
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
            $this->doctorService->rejectAppointment($id);
            return redirect()->back()->with('success', 'تم إلغاء الموعد.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }
}
