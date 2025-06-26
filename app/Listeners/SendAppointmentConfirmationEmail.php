<?php

namespace App\Listeners;

use App\Events\AppointmentBooked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
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
             $msg = 'AppointmentBooked event fired for appointment ID: ' . $event->appointment->id;
        Log::info($msg);

        // خزّن الرسالة للاختبا
        self::$message = $msg;

    }
}
