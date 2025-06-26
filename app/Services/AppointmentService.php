<?php

namespace App\Services;

use App\Enums\AppointementStatus;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
   public function bookAppointment(array $data): Appointment
    {

        $validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }


        $exists = Appointment::where('doctor_id', $data['doctor_id'])
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
      public function cancelAppointment(int $id): bool
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = AppointementStatus::CANCELLED->value;
        return $appointment->save();
    }
     public function getAppointmentsByUser(int $userId)
    {
        return Appointment::where('user_id', $userId)->get();
    }

    public function getAppointmentsByDoctor(int $doctorId)
    {
        return Appointment::where('doctor_id', $doctorId)->get();
    }


}
