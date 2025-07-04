<?php

namespace App\Http\Controllers\API\Admin\ManagementPanel;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\Appointment\AppointmentResource;
use App\Models\Appointment;
use App\Services\AdminSevice;
use App\Traits\ResponceTrait;

use function PHPUnit\Framework\returnValue;

class AdminManagementPanel extends Controller
{
    use ResponceTrait;

    public $adminSevice;
    public function __construct(AdminSevice $adminSevice)
    {
        $this->adminSevice = $adminSevice;

    }
    public function deleteTashedAppointments(int $id)
    {
        $this->adminSevice->deleteAppointments($id);
        return $this->sendResponce(null,"Deleted_success");

    }
    public function AdminStaticsPanel()
    {
     
       $data= $this->adminSevice->statistics();
       return $data;

    }
    public function dailyAppointments()
    {
 $data= Appointment::AppointmentsForToday()->get();
 return $this->sendResponce(AppointmentResource::collection($data),'Appointments_for_Today');
    }





}
