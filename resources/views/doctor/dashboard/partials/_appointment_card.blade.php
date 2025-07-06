<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">المريض: {{ $appointment->patient->name ?? 'غير متوفر' }}</h5>
        <p class="card-text">التاريخ: {{ $appointment->date }}</p>
        <p class="card-text">الوقت: {{ $appointment->start_time }} - {{ $appointment->end_time }}</p>
        <p class="card-text">الحالة:
            @if($appointment->status == \App\Enums\AppointementStatus::PENDING->value)
                <span class="badge bg-warning text-dark">قيد الانتظار</span>
            @elseif($appointment->status == \App\Enums\AppointementStatus::CONFIRMED->value)
                <span class="badge bg-success">مؤكد</span>
            @elseif($appointment->status == \App\Enums\AppointementStatus::CANCELLED->value)
                <span class="badge bg-danger">ملغي</span>
            @endif
        </p>

        @if($appointment->status == \App\Enums\AppointementStatus::PENDING->value)
            <form action="{{ route('doctor.appointments.confirm', $appointment->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-success">تأكيد</button>
            </form>
            <form action="{{ route('doctor.appointments.cancel', $appointment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد؟')">
                @csrf
                <button class="btn btn-sm btn-danger">إلغاء</button>
            </form>
        @endif
    </div>
</div>
