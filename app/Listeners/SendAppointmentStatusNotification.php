<?php

namespace App\Listeners;

use App\Events\AppointmentStatusUpdated;
use App\Mail\AppointmentStatusMail;
use App\Models\EmailLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Markdown;

class SendAppointmentStatusNotification
{
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
    public function handle(AppointmentStatusUpdated $event): void
    {
        $appointment = $event->appointment->load('user', 'doctor');


    Mail::to($appointment->user->email)->send(new AppointmentStatusMail($appointment));
        // توليد نسخة HTML من البريد
    $html = view('emails.appointment.status', [
    'appointment' => $appointment,
])->render();
       EmailLog::create([
            'to_email' => $appointment->user->email,
            'subject' => 'Appointment Status Mail',
                'body' => $html,
            'emailable_type' => get_class($appointment),
            'emailable_id' => $appointment->id,
        ]);
    }
}
