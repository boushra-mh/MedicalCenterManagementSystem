@component('mail::message')
# Appointment Status Update

Dear {{ $appointment->user->name }},

Your appointment scheduled with Dr. {{ $appointment->doctor->name }} on {{ $appointment->date }} at {{ $appointment->time }} has been **{{ ucfirst($appointment->status->value) }}**.

Thanks,  
{{ config('app.name') }}
@endcomponent
