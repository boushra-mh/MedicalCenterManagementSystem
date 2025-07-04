<?php

namespace App\Http\Controllers\API\Doctor;

use App\Events\AppointmentStatusUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Doctor\DoctorRequest;
use App\Http\Resources\API\Appointment\AppointmentResource;
use App\Http\Resources\API\Doctor\DoctorResource;
use App\Models\Appointment;
use App\Services\AdminSevice;
use App\Services\AppointmentService;
use App\Services\DoctorService;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use ResponceTrait;

    protected $doctorService;
    protected $appointmentService;
   

    public function __construct(AppointmentService $appointmentService, DoctorService $doctorService)
    {
        $this->appointmentService = $appointmentService;
        $this->doctorService = $doctorService;
       
    }

    /**
     * 📋 عرض جميع الأطباء (للاستخدام من قبل الإدمن)
     */
    public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();
        return $this->sendResponce(DoctorResource::collection($doctors), 'Doctors_retrieved_successfully');
    }

    /**
     * ➕ إنشاء طبيب جديد (يُستخدم من قبل الإدمن)
     */
    public function store(DoctorRequest $request)
    {
        $doctor = $this->doctorService->create($request->validated());
        return $this->sendResponce(new DoctorResource($doctor), 'Doctor_stored_successfully');
    }

    /**
     * 👁️ عرض بيانات طبيب محدد
     */
    public function show(string $id)
    {
        $doctor = $this->doctorService->find($id);
        return $this->sendResponce(new DoctorResource($doctor), 'Doctor_retrived_successfully');
    }

    /**
     * ✏️ تحديث بيانات طبيب محدد
     */
    public function update(DoctorRequest $request, string $id)
    {
        $doctor = $this->doctorService->update($request->validated(), $id);
        return $this->sendResponce(new DoctorResource($doctor), 'Doctor_updated_successfully');
    }

    /**
     * 🗑️ حذف طبيب
     */
    public function destroy(string $id)
    {
        $this->doctorService->delete($id);
        return $this->sendResponce(null, 'Doctor_deleted_successfully');
    }

    /**
     * 📅 عرض مواعيد الطبيب الحالية
     */
    public function doctorAppointments()
    {
        $doctor_id = auth('doctor')->id();
        $appointments = $this->appointmentService->getAppointmentsByDoctor($doctor_id);
        return $this->sendResponce(AppointmentResource::collection($appointments), 'You_appointments');
    }

    /**
     * ❌ رفض موعد من قبل الطبيب
     */
    public function reject(string $id)
    {
        $appointment = $this->doctorService->rejectAppointment($id);
        event(new AppointmentStatusUpdated($appointment));
        return $this->sendResponce(null, 'you_reject_to_this_appointment_successfully');
    }

    /**
     * ✅ قبول موعد من قبل الطبيب
     */
    public function accept(string $id)
    {
        $appointment = $this->doctorService->acceptAppointment($id);
        event(new AppointmentStatusUpdated($appointment));
        return $this->sendResponce(null, 'you_accept_to_this_appointment_successfully');
    }

    /**
     * ✅ عرض المواعيد المؤكدة للطبيب
     */
    public function getConfirmedAppointment()
    {
        $doctor_id = auth('doctor')->id();
        $appointments = Appointment::ByDoctor($doctor_id)->confirmed()->get();
        return $this->sendResponce(AppointmentResource::collection($appointments), 'your_Appointment_confirmed');
    }

    /**
     * ❌ عرض المواعيد الملغاة للطبيب
     */
    public function getCancledAppointment()
    {
        $doctor_id = auth('doctor')->id();
        $appointments = Appointment::ByDoctor($doctor_id)->Canceled()->get();
        return $this->sendResponce(AppointmentResource::collection($appointments), 'your_Appointment_canceled');
    }

    /**
     * 🔎 تصفية المواعيد حسب الفلاتر (تاريخ، حالة، ...إلخ)
     */
    public function filter(Request $request)
    {
        $doctor_id = auth('doctor')->id();
        $appointments = Appointment::ByDoctor($doctor_id)->filter($request->all())->get();
        return $this->sendResponce(AppointmentResource::collection($appointments), '');
    }

    /**
     * 📆 عرض مواعيد اليوم للطبيب
     */
    public function appointmentsForToday()
    {
        $doctor_id = auth('doctor')->id();
        $appointments = Appointment::ByDoctor($doctor_id)
            ->AppointmentsForToday()
            ->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponce(AppointmentResource::collection($appointments), 'your_appointments_for_today');
    }

}
