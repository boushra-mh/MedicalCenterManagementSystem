<?php

namespace App\Http\Controllers\API\Admin\ManagementPanel;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Doctor\DoctorResource as DoctorDoctorResource;
use App\Http\Resources\API\Appointment\AppointmentResource;
use App\Http\Resources\API\Doctor\DoctorResource;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\AdminSevice;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class AdminManagementPanel extends Controller
{
    use ResponceTrait;

    public $adminSevice;

    public function __construct(AdminSevice $adminSevice)
    {
        $this->adminSevice = $adminSevice;
    }

    /**
     * 🧹 حذف موعد محذوف (soft deleted) بشكل دائم
     */
    public function deleteTashedAppointments(int $id)
    {
        $this->adminSevice->deleteAppointments($id);
        return $this->sendResponce(null, __("your_Deleted_success"));
    }

    /**
     * 📊 إرجاع إحصائيات لوحة تحكم الإدمن
     */
    public function AdminStaticsPanel()
    {
        $data = $this->adminSevice->statistics();
        return $data;
    }

    /**
     * 📅 جلب مواعيد اليوم لجميع الأطباء
     */
    public function dailyAppointments()
    {
        $data = Appointment::AppointmentsForToday()->get();
        return $this->sendResponce(AppointmentResource::collection($data),__ ('Appointments_for_Today'));
    }

    //  تعطيل او تفعيل حساب طبيب
    public function toggleStatusForDoctor($id)
     {
        $doctor= $this->adminSevice->toggleDoctorStatus($id);


        return $this->sendResponce(new DoctorResource($doctor),__('Status_Updated_Successfully'));
    }
}
