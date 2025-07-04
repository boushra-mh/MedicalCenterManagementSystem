<?php

namespace App\Services;

use App\Enums\AppointementStatus;
use App\Models\Appointment;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
    protected $allowedSlots;

    public function __construct()
    {
        // استدعاء الأوقات المسموح بها من ملف الإعدادات config/appointments.php
        $this->allowedSlots = Config::get('appointments.allowed_slots', []);
    }

    /**
     * حجز موعد جديد مع التحقق من صلاحية الوقت وعدم تعارضه مع مواعيد أخرى مؤكدة أو معلقة
     *
     * @param array $data
     * @return Appointment
     * @throws ValidationException
     */
    public function bookAppointment(array $data): Appointment
    {
        // التحقق من أن الوقت المختار ضمن الأوقات المسموح بها
        if (!in_array($data['time'], $this->allowedSlots)) {
            throw ValidationException::withMessages([
                'time' => 'The selected time is outside the allowed working hours.',
            ]);
        }

        // التحقق من عدم وجود موعد محجوز مسبقًا في نفس الوقت والتاريخ لنفس الطبيب
        $exists = Appointment::byDoctor($data['doctor_id'])
            ->where('date', $data['date'])
            ->where('time', $data['time'])
            
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages(['time' => 'This time slot is already booked.']);
        }

        // إنشاء الموعد مع حالة مبدئية معلقة (Pending)
        $appointment = Appointment::create([
            'user_id' => $data['user_id'],
            'doctor_id' => $data['doctor_id'],
            'date' => $data['date'],
            'time' => $data['time'],
            'status' => AppointementStatus::PENDING->value,
        ]);

        return $appointment;
    }

    /**
     * إلغاء موعد بواسطة المستخدم إذا كان هو صاحب الموعد فقط
     *
     * @param int $id
     * @return bool
     * @throws ValidationException
     */
    public function cancelAppointment(int $id)
    {
        $appointment = Appointment::findOrFail($id);
        $user = auth('user')->id();

        // التحقق من ملكية الموعد للمستخدم قبل الإلغاء
        if ($user == $appointment->user_id) {
            $appointment->status = AppointementStatus::CANCELLED->value;
            return $appointment->save();
        } else {
            throw ValidationException::withMessages([
                'user_id' => 'You are not authorized to cancel this appointment.'
            ]);
        }
    }

    /**
     * جلب كل المواعيد الخاصة بمستخدم معين (المريض)
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAppointmentsByUser(int $userId)
    {
        return Appointment::byUser($userId)->get();
    }

    /**
     * جلب كل المواعيد الخاصة بطبيب معين
     *
     * @param int $doctorId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAppointmentsByDoctor(int $doctorId)
    {
        return Appointment::byDoctor($doctorId)->get();
    }

    /**
     * حذف موعد من قبل المستخدم فقط إذا كان في حالة معلقة (pending)
     *
     * @param int $userId
     * @param int $appointmentId
     * @return bool|null
     * @throws ValidationException
     */
    public function deleteByUser($userId, $appointmentId)
    {
        $appointment = Appointment::byUser($userId)
            ->where('id', $appointmentId)
            ->pending()
            ->first();

        if (!$appointment) {
            throw ValidationException::withMessages([
                'appointment' => 'Appointment is not pending or not found.',
            ]);
        }

        return $appointment->delete();
    }
}
