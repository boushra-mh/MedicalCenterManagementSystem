@component('mail::message')
 {{ __('Appointment Confirmation') }}

{{ __('Dear') }} {{ $user->name }},

{{ __('Your appointment has been booked successfully.') }}

{{ __('Appointment Details:') }}

- {{ __('Doctor') }}: {{ $doctor->name }}
- {{ __('Date') }}: {{ $appointment->date }}
- {{ __('Time') }}: {{ $appointment->time }}

{{ __('Thank you for choosing our medical center!') }}

@endcomponent
