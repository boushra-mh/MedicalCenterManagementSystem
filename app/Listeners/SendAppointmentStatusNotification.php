<?php

namespace App\Listeners;

use App\Events\AppointmentStatusUpdated;
use App\Mail\AppointmentStatusMail;
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
    }
}
