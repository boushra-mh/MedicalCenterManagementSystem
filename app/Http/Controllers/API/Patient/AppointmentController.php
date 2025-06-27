<?php

namespace App\Http\Controllers\API\Patient;

use App\Events\AppointmentBooked;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Patient\AppointmentRequest;
use App\Http\Resources\API\Appointment\AppointmentResource;
use App\Listeners\SendAppointmentConfirmationEmail;
use App\Services\AppointmentService;
use App\Traits\ResponceTrait;

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

    public function cancel($id)
    {
        $appointment = $this->appointmentService->cancelAppointment($id);
        return $this->sendResponce(null, 'appointment_canceled_successfully');
    }
}
