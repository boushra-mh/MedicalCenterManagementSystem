<?php

namespace App\Listeners;

use App\Events\AppointmentBooked;

use App\Mail\AppointmentConfirmedMail;
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


        Mail::to($appointment->user->email)->send(new AppointmentConfirmedMail($appointment));


        Mail::to($appointment->doctor->email)->send(new AppointmentConfirmedMail($appointment));

        // $message=['your appointement details on your email, check it :',$appointment->user->email];
        // self::$message = "Appointment details sent to: {$appointment->user->email}";
        self::$message = 'mailto:' . $appointment->user->email;

    }
    
}
