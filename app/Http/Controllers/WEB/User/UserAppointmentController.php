<?php

namespace App\Http\Controllers\WEB\User;

use App\Events\AppointmentBooked;
use App\Http\Controllers\Controller;
// لو عندك طلب تحقق مخصص
use App\Http\Requests\API\Patient\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    /**
     * 📋 عرض قائمة المواعيد
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $appointments = Appointment::ByUser($userId)
            ->filter($request->all())
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('user.appointments.index', compact('appointments'));
    }

    /**
     * ➕ عرض نموذج إنشاء موعد جديد
     */
    public function create()
    {
        $doctors = Doctor::where('status', 'active')->get();

        return view('user.appointments.create', compact('doctors'));
    }

    /**
     * 💾 حفظ موعد جديد
     */
    public function store(AppointmentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

       $appointment= $this->appointmentService->bookAppointment($data);
        event(new AppointmentBooked($appointment));


        return redirect()->route('user.appointments.index')->with('success', 'تم حجز الموعد بنجاح');
    }

    // 🧹 إلغاء موعد
    public function cancel($id)
    {
        $userId = Auth::id();
        $appointment = Appointment::where('id', $id)->where('user_id', $userId)->firstOrFail();

        $this->appointmentService->cancelAppointment($appointment->id);

        return redirect()->back()->with('success', 'تم إلغاء الموعد بنجاح');
    }

    /**
     * 🗑️ حذف طبيب
     * باستخدام  ال sofyDelete
     */
    public function destroy($id)
    {
        $userId = auth('user')->id();

        $this->appointmentService->deleteByUser($userId, $id);

        return redirect()->back()->with('success', 'تم حذف الموعد بنجاح.');
    }
}
