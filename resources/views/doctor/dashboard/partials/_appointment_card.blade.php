@php
    use App\Enums\AppointementStatus;
@endphp

<div class="card mb-3">
    <div class="card-body">
        <p><strong>{{ __('messages.patient') }}:</strong> {{ $appointment->user->name ?? __('messages.not_available') }}</p>
        <p><strong>{{ __('messages.date') }}:</strong> {{ $appointment->date }}</p>
        <p><strong>{{ __('messages.time') }}:</strong> {{ $appointment->time ?? '-' }}</p>
        <p><strong>{{ __('messages.status') }}:</strong>
            @switch($appointment->status->value)
                @case(AppointementStatus::CONFIRMED->value)
                    {{ __('messages.confirmed') }}
                    @break
                @case(AppointementStatus::PENDING->value)
                    {{ __('messages.pending') }}
                    @break
                @case(AppointementStatus::CANCELLED->value)
                    {{ __('messages.cancelled') }}
                    @break
                @default
                    {{ __('messages.unknown') }}
            @endswitch
        </p>
        
        @if(($appointment->status->value ?? $appointment->status) === AppointementStatus::PENDING->value)
            <form action="{{ route('doctor.appointments.confirm', $appointment->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">✅ {{ __('messages.approve') }}</button>
            </form>

            <form action="{{ route('doctor.appointments.cancel', $appointment->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">❌ {{ __('messages.reject') }}</button>
            </form>
        @endif
    </div>
</div>
