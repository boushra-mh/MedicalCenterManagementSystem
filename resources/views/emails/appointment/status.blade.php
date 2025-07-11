@component('mail::message')
# {{ __('messages.appointment_status_updated') }}

{{ __('messages.hello_user', ['name' => $appointment->user?->name ?? __('messages.user')]) }}

{{ __('messages.appointment_updated_to', [
    'doctor' => $appointment->doctor?->name ?? __('messages.the_doctor'),
    'date' => $appointment->date,
    'time' => $appointment->time,
    'status' => ucfirst(__("messages." . ($appointment->status?->value ?? 'unknown')))
]) }}

{{ __('messages.thank_you_for_using', ['app' => config('app.name')]) }}

@component('mail::button', ['url' => route('appointment.status', $appointment->id)])
{{ __('messages.view_appointment_details') }}
@endcomponent

{{ __('messages.regards') }},  
{{ config('app.name') }}
@endcomponent
