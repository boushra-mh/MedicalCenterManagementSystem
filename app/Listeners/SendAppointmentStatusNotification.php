<?php

namespace App\Listeners;

use App\Events\AppointmentStatusUpdated;
use App\Mail\AppointmentStatusMail;
use App\Models\EmailLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
       EmailLog::create([
            'to_email' => $appointment->user->email,
            'subject' => 'Appointment Status Mail',
            'body' => view('emails.appointment.status', [
                'appointment' => $appointment,
            ])->render(),
            'emailable_type' => get_class($appointment),
            'emailable_id' => $appointment->id,
        ]);
    }
}
