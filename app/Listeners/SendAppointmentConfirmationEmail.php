<?php

namespace App\Listeners;

use App\Events\AppointmentBooked;

use App\Mail\AppointmentConfirmedMail;
use App\Models\EmailLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PgSql\Lob;

class SendAppointmentConfirmationEmail
{
      public static $message = null;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
     

public function handle(AppointmentBooked $event): void
{
    $appointment = $event->appointment;

    // إرسال الإيميل للمريض
    Mail::to($appointment->user->email)->send(new AppointmentConfirmedMail($appointment));

    // تسجيل الإيميل للمريض في الجدول
    EmailLog::create([
        'to_email' => $appointment->user->email,
        'subject' => 'Appointment Confirmed Mail',
        'body' => view('emails.appointments.confirmed', [
            'appointment' => $appointment,
            'user' => $appointment->user,
            'doctor' => $appointment->doctor,
        ])->render(),
        'emailable_type' => get_class($appointment),
        'emailable_id' => $appointment->id,
    ]);
    Log::info('EmailLog created for: ' . $appointment->user->email);

    // إرسال الإيميل للطبيب
    Mail::to($appointment->doctor->email)->send(new AppointmentConfirmedMail($appointment));

    // تسجيل الإيميل للطبيب في الجدول
    EmailLog::create([
        'to_email' => $appointment->doctor->email,
        'subject' => 'Appointment Confirmed Mail',
        'body' => view('emails.appointments.confirmed', [
            'appointment' => $appointment,
            'user' => $appointment->user,
            'doctor' => $appointment->doctor,
        ])->render(),
        'emailable_type' => get_class($appointment),
        'emailable_id' => $appointment->id,
    ]);

    // حفظ رسالة بسيطة (اختيارية)
    self::$message = 'mailto:' . $appointment->user->email;
}

    
}
