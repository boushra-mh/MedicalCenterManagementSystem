

<h3>{{ __('messages.appointment_status_updated') }}</h3>

<p>
    {{ __('messages.hello_user', ['name' => $appointment->user?->name ?? __('messages.user')]) }}
</p>

<p>
    {{ __('messages.appointment_updated_to', [
        'doctor' => $appointment->doctor?->name ?? __('messages.the_doctor'),
        'date' => $appointment->date,
        'time' => $appointment->time,
        'status' => ucfirst(__("messages." . ($appointment->status?->value ?? 'unknown')))
    ]) }}
</p>

<p>{{ __('messages.thank_you_for_using', ['app' => config('app.name')]) }}</p>

<p><strong>{{ __('messages.regards') }}</strong>,<br>{{ config('app.name') }}</p>
