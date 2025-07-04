<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;

class AdminSevice
{
    /**
     * 🧹 حذف موعد من قاعدة البيانات بشكل دائم
     * يستخدم withTrashed لاسترجاع المواعيد المحذوفة مؤقتًا (soft deletes)
     *
     * @param int $id
     * @return bool
     */
    public function deleteAppointments($id)
    {
            $date = now()->subMonth();
        $appointment = Appointment::where('id', $id)
        ->where('date','<', $date)
            ->withTrashed()
            ->first();
        $appointment->forceDelete();
        return true;
    }

    /**
     * 📊 جلب إحصائيات لوحة تحكم الإدمن
     * تشمل عدد الأطباء، المرضى، المواعيد الكلية، والمواعيد المحذوفة مؤقتًا
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics()
    {
        $doctors = Doctor::count();
        $patients = User::count();
        $appointments = Appointment::count();
        $appointmentsWithTrashed = Appointment::onlyTrashed()->count();

        return response()->json([
            'total_doctors' => $doctors,
            'total_patients' => $patients,
            'total_appointments' => $appointments,
            'total_appointmentsWithTrashed' => $appointmentsWithTrashed
        ]);
    }
    public function toggleDoctorStatus($id )
    {
    $doctor = Doctor::findOrFail($id);

        if ($doctor->status == StatusEnum::Active) {
            $doctor->status = StatusEnum::InActive;
        } elseif($doctor->status == StatusEnum::InActive) {

              $doctor->status = StatusEnum::Active;
        }

        $doctor->save();
     return $doctor;        
    }
}
