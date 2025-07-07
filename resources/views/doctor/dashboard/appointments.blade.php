@extends('layouts.doctor') {{-- تأكد من استخدام اللayout الصحيح --}}

@section('title', 'قائمة المواعيد')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">قائمة المواعيد</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($appointments->isEmpty())
        <div class="alert alert-info text-center">لا توجد مواعيد حالياً.</div>
    @else
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>اسم المريض</th>
                    <th>تاريخ الموعد</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $statusColors = [
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'canceled' => 'danger',
                    ];
                @endphp

                @foreach($appointments as $appointment)
                    @php
                        $statusValue = $appointment->status instanceof \BackedEnum ? $appointment->status->value : $appointment->status;
                    @endphp
                    <tr>
                        <td>{{ $appointment->user->name ?? '—' }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>
                            <span class="badge bg-{{ $statusColors[$statusValue] ?? 'secondary' }}">
                                {{ ucfirst(__($statusValue)) }}
                            </span>
                        </td>
                        <td>
                            @if($statusValue === 'pending')
                                <form action="{{ route('doctor.appointments.confirm', $appointment->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-sm btn-success" type="submit">✅ تأكيد</button>
                                </form>

                                <form action="{{ route('doctor.appointments.cancel', $appointment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من إلغاء الموعد؟');">
                                    @csrf
                                    <button class="btn btn-sm btn-danger" type="submit">❌ إلغاء</button>
                                </form>
                            @else
                                <span>—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- روابط الصفحات --}}
        <div>
            {{ $appointments->links() }}
        </div>
    @endif
</div>
@endsection
