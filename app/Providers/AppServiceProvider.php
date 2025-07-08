<?php

namespace App\Providers;

use App\Events\AppointmentBooked;
use App\Events\AppointmentStatusUpdated;
use App\Listeners\SendAppointmentConfirmationEmail;
use App\Listeners\SendAppointmentStatusNotification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
           Event::listen(
        AppointmentBooked::class,
        SendAppointmentConfirmationEmail ::class
    );
    Event::listen(
        AppointmentStatusUpdated::class,

SendAppointmentStatusNotification ::class
    );
    Paginator::useBootstrap(); 

      
    }
}
