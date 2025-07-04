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

    public function index()
    {
        $userId = auth('user')->id();
        $appointment = $this->appointmentService->getAppointmentsByUser($userId);

        return $this->sendResponce(AppointmentResource::collection($appointment), 'Appointments_retrieved');
    }

    public function store(AppointmentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('user')->id();
        $appointment = $this->appointmentService->bookAppointment($data);
        event(new AppointmentBooked($appointment));
        $message = SendAppointmentConfirmationEmail::$message;
        return $this->sendResponce(['appointment' => new AppointmentResource($appointment), 'event_message' => $message], 'appointment_booked_successfully');
    }

  
  public function forceDelete($id)
{
    $user_id = auth('user')->id();

    $this->appointmentService->deleteByUser($user_id, $id);

    return $this->sendResponce(null, 'Appointment permanently deleted');
}



    public function cancel($id)
    {
       $this->appointmentService->cancelAppointment($id);
        return $this->sendResponce(null, 'appointment_canceled_successfully');
    }

        public function getConfirmedAppointment()
{
    $user_id=auth('user')->id();

    $appointments=Appointment::ByUser( $user_id)->confirmed()->get();

    return $this->sendResponce(AppointmentResource::collection($appointments),'your_Appointment');
}
public function getCancledAppointment()
{
     $user_id=auth('user')->id();

    $appointments=Appointment::ByUser( $user_id)->Canceled()->get();

    return $this->sendResponce(AppointmentResource::collection($appointments),'your_Appointment_canceled');

}
public function getPendingAppointment()
{
     $user_id=auth('user')->id();

    $appointments=Appointment::ByUser( $user_id)->pending()->get();

    return $this->sendResponce(AppointmentResource::collection($appointments),'your_Appointment_Pending');

}
public function filter(Request $request)
{
      $user_id=auth('user')->id();
     $appointments=Appointment::ByUser( $user_id)->filter($request->all())->get();
     return $this->sendResponce(AppointmentResource::collection($appointments),'');


}
}
