<?php

namespace App\Services;

use App\Enums\AppointementStatus;
use App\Enums\StatusEnum;
use App\Enums\UserRole;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Validation\ValidationException;

class DoctorService
{
    /**
     * استرجاع طبيب حسب الـ ID
     */
    public function getById($id)
    {
        return Doctor::where("id", $id)->first();
    }

    /**
     * استرجاع جميع الأطباء
     */
    public function getAllDoctors()
    {
        return Doctor::all(); 
    }

    /**
     * إنشاء طبيب جديد وربطه بالتخصصات إن وجدت
     * وتعيين الدور كطبيب
     */
    public function create(array $data)
    {
        $doctor = Doctor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status'=>StatusEnum::Active->value
        ]);
        $doctor->save();

        if (!empty($data['specialties'])) {
            $doctor->specialties()->sync($data['specialties']);
        }

        $doctor->assignRole(UserRole::DOCTOR);
        return $doctor;
    }

    /**
     * البحث عن طبيب بواسطة الـ ID (يستخدم نفس getById)
     */
    public function find($id)
    {
        return $this->getById($id);
    }

    /**
     * تحديث بيانات الطبيب وربط التخصصات الجديدة إن وجدت
     */
    public function update(array $data, $id)
    {
        $doctor = $this->getById($id);
        $doctor->update($data);
        if (isset($data['specialties'])) {
            $doctor->specialties()->sync($data['specialties']);
        }
        return $doctor;
    }

    /**
     * حذف الطبيب (soft delete بشكل افتراضي في Laravel)
     */
    public function delete($id)
    {
        $this->getById($id)->delete();
        return true;
    }

    /**
     * رفض موعد من قبل الطبيب 
     * تتحقق أن الموعد موجود وهو في الحالة "قيد الانتظار"
     * ثم يتم تحديث الحالة إلى ملغي
     */
    public function rejectAppointment($id)
    {   $doctor = auth('doctor')->id() ?? auth('doctor_web')->id() ;

        $appointment = Appointment::byDoctor($doctor)
            ->where('id', $id)
            ->pending()
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

    /**
     * قبول موعد من قبل الطبيب
     * تتحقق أن الموعد موجود وهو في الحالة "قيد الانتظار"
     * ثم يتم تحديث الحالة إلى مؤكد
     */
    public function acceptAppointment($id)
    {
       $doctor = auth('doctor')->id() ?? auth('doctor_web')->id() ;



        $appointment = Appointment::byDoctor($doctor)
            ->where('id', $id)
            ->pending()
            ->first();

        if (!$appointment) {
            throw ValidationException::withMessages([
                'appointment' => 'Appointment not found or cannot be accepted.',
            ]);
        }

        $appointment->status = AppointementStatus::CONFIRMED->value;
        $appointment->save();
        return $appointment;
    }
}
