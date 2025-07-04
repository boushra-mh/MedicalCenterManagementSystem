<?php

namespace App\Http\Controllers\API\Patient;

use App\Events\AppointmentBooked;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Patient\AppointmentRequest;
use App\Http\Resources\API\Appointment\AppointmentResource;
use App\Listeners\SendAppointmentConfirmationEmail;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use ResponceTrait;

    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    /**
     * عرض كل المواعيد الخاصة بالمريض المسجل
     */
    public function index()
    {
        $userId = auth('user')->id();
        $appointment = $this->appointmentService->getAppointmentsByUser($userId);

        return $this->sendResponce(AppointmentResource::collection($appointment), 'Appointments_retrieved');
    }

    /**
     * حجز موعد جديد بواسطة المريض
     * مع التحقق من صحة البيانات وإرسال حدث حجز الموعد
     */
    public function store(AppointmentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('user')->id();
        $appointment = $this->appointmentService->bookAppointment($data);
        event(new AppointmentBooked($appointment));
        $message = SendAppointmentConfirmationEmail::$message;
        return $this->sendResponce(['appointment' => new AppointmentResource($appointment), 'event_message' => $message], 'appointment_booked_successfully');
    }

    /**
     * حذف موعد بشكل مؤرشف (Force Delete) فقط إذا كان المريض يملك الموعد
     */
    public function forceDelete($id)
    {
        $user_id = auth('user')->id();
        $this->appointmentService->deleteByUser($user_id, $id);

        return $this->sendResponce(null, 'Appointment permanently deleted');
    }

    /**
     * إلغاء موعد من قبل المريض
     */
    public function cancel($id)
    {
        $this->appointmentService->cancelAppointment($id);
        return $this->sendResponce(null, 'appointment_canceled_successfully');
    }

    /**
     * جلب المواعيد المؤكدة الخاصة بالمريض
     */
    public function getConfirmedAppointment()
    {
        $user_id = auth('user')->id();
        $appointments = Appointment::ByUser($user_id)->confirmed()->get();

        return $this->sendResponce(AppointmentResource::collection($appointments), 'your_Appointment');
    }

    /**
     * جلب المواعيد الملغاة الخاصة بالمريض
     */
    public function getCancledAppointment()
    {
        $user_id = auth('user')->id();
        $appointments = Appointment::ByUser($user_id)->Canceled()->get();

        return $this->sendResponce(AppointmentResource::collection($appointments), 'your_Appointment_canceled');
    }

    /**
     * جلب المواعيد المعلقة (قيد الانتظار) الخاصة بالمريض
     */
    public function getPendingAppointment()
    {
        $user_id = auth('user')->id();
        $appointments = Appointment::ByUser($user_id)->pending()->get();

        return $this->sendResponce(AppointmentResource::collection($appointments), 'your_Appointment_Pending');
    }

    /**
     * تصفية المواعيد حسب شروط معينة يرسلها المريض (مثل التاريخ، الحالة، ...الخ)
     */
    public function filter(Request $request)
    {
        $user_id = auth('user')->id();
        $appointments = Appointment::ByUser($user_id)->filter($request->all())->get();

        return $this->sendResponce(AppointmentResource::collection($appointments), '');
    }
}
