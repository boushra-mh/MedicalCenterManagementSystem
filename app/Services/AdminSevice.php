<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;

class AdminSevice
{
    public function deleteAppointments($id)
    {
        $appointment = Appointment::where('id', $id)
            ->withTrashed()
            ->first();
        $appointment->forceDelete();
        return true;
    }
    public function statistics()
    {
        $doctors = Doctor::count();
        $patients = User::count();
        $appointments = Appointment::count();
        $appointmentsWithTrashed=Appointment::onlyTrashed()->count();
           return response()->json([
        'total_doctors' => $doctors,
        'total_patients' => $patients,
        'total_appointments' => $appointments,
        'total_appointmentsWithTrashed'=> $appointmentsWithTrashed
    ]);
    }
   
}
