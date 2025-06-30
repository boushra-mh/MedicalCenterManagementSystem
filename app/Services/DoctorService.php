<?php

namespace App\Services;

use App\Enums\AppointementStatus;
use App\Enums\UserRole;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Validation\ValidationException;

class DoctorService
{
    public function getById($id)
    {
        return Doctor::where("id", $id)->first();
    }
    public function getAllDoctors()
    {
       
        return   Doctor::all(); 
    }
    public function create(array $data)
    {
     $doctor = Doctor::create([
    'name' => $data['name'],
    'email' => $data['email'],
    'password' => bcrypt($data['password']),
]);

    if (!empty($data['specialties'])) {
            $doctor->specialties()->sync($data['specialties']);
        }

         $doctor->assignRole(UserRole::DOCTOR);
        return $doctor;

    }
    public function find($id)
    {
        return $this->getById($id);
    }
    public function update(array $data, $id)
    {
        $doctor = $this->getById($id);
        $doctor->update($data);
         if (isset($data['specialties'])) {
            $doctor->specialties()->sync($data['specialties']);
        }
        return $doctor;
    }
    public function delete($id)
    {
        $this->getById($id)->delete();

        return true;
    }
    public function rejectAppointment($id)
    {
        $doctor = auth('doctor')->user()->id;

        $appointment= Appointment::where('doctor_id', $doctor)
        ->where('id', $id)
        ->where('status', AppointementStatus::PENDING->value)
        ->first();
          if (!$appointment) {
        throw ValidationException::withMessages([
            'appointment' => 'Appointment not found or cannot be rejected.',
        ]);
    }
          $appointment->status = AppointementStatus::CANCELLED->value;
          $appointment->save();
          return $appointment;
    }

    public function acceptAppointment($id)
    {
          $doctor = auth('doctor')->user()->id;

        $appointment= Appointment::where('doctor_id', $doctor)
        ->where('id', $id)
        ->where('status', AppointementStatus::PENDING->value)
        ->first();
          if (!$appointment) {
        throw ValidationException::withMessages([
            'appointment' => 'Appointment not found or cannot be rejected.',
        ]);
    }
          $appointment->status = AppointementStatus::CONFIRMED->value;
          $appointment->save();
          return $appointment;

    }
}

