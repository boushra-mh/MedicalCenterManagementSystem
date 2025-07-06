@php
    use App\Enums\AppointementStatus;
@endphp

<div class="card mb-3">
    <div class="card-body">
        <p><strong>المريض:</strong> {{ $appointment->user->name ?? 'غير متوفر' }}</p>
        <p><strong>التاريخ:</strong> {{ $appointment->date }}</p>
        <p><strong>الوقت:</strong> {{ $appointment->time ?? '-' }}</p>
        <p><strong>الحالة:</strong>
            @switch($appointment->status->value)
                @case(AppointementStatus::CONFIRMED->value)
                    مؤكد
                    @break
                @case(AppointementStatus::PENDING->value)
                    قيد الانتظار
                    @break
                @case(AppointementStatus::CANCELLED->value)
                    ملغي
                    @break
                @default
                    غير معروف
            @endswitch
        </p>
        
        @if(($appointment->status->value ?? $appointment->status) === AppointementStatus::PENDING->value)
            <form action="{{ route('doctor.appointments.confirm', $appointment->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">✅ موافقة</button>
            </form>

            <form action="{{ route('doctor.appointments.cancel', $appointment->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">❌ رفض</button>
            </form>
        @endif
    </div>
</div>
