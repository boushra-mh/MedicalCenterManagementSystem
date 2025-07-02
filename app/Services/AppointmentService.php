<?php

namespace App\Services;

use App\Enums\AppointementStatus;
use App\Models\Appointment;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
        protected  $allowedSlots ;
         public function __construct()
    {
        $this->allowedSlots = Config::get('appointments.allowed_slots', []);
    }
    

    public function bookAppointment(array $data): Appointment
    {

        
          if (!in_array($data['time'], $this->allowedSlots)) {
            throw ValidationException::withMessages([
                'time' => 'The selected time is outside the allowed working hours.',
            ]);
        }

        

        $exists = Appointment::byDoctor($data['doctor_id'])
            ->where('date', $data['date'])
            ->where('time', $data['time'])
            ->whereIn('status', [AppointementStatus::PENDING->value, AppointementStatus::CONFIRMED->value])
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages(['time' => 'This time slot is already booked.']);
        }

        $appointment = Appointment::create([
            'user_id' => $data['user_id'],
            'doctor_id' => $data['doctor_id'],
            'date' => $data['date'],
            'time' => $data['time'],
            'status' => AppointementStatus::PENDING->value,
        ]);

        return $appointment;
    }

    public function cancelAppointment(int $id)
    {
        $appointment = Appointment::findOrFail($id);
        $user = auth('user')->id();
        if ($user == $appointment->user_id) {
            $appointment->status = AppointementStatus::CANCELLED->value;
            return $appointment->save();
        } elseif ($user != $appointment->user_id) {
            throw ValidationException::withMessages([
                'user_id' => 'You are not authorized to cancel this appointment.'
            ]);
        }
    }

    public function getAppointmentsByUser(int $userId)
    {
        return Appointment::byUser( $userId)->get();
    }

    public function getAppointmentsByDoctor(int $doctorId)
    {
        return Appointment::byDoctor( $doctorId)->get();
    }
}
