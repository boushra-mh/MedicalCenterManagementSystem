@extends('layouts.user.user') {{-- تأكد من استخدام الlayout المناسب --}}

@section('title', 'مواعيدي')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">مواعيدي</h2>


    {{-- نموذج الفلترة --}}
    <form method="GET" action="{{ route('user.appointments.index') }}" class="mb-4 row g-3 align-items-center">
        <div class="col-md-3">
            <label for="status" class="form-label">الحالة</label>
            <select name="status" id="status" class="form-select">
                <option value="">الكل</option>
                <option value="pending" @selected(request('status') == 'pending')>معلق</option>
                <option value="confirmed" @selected(request('status') == 'confirmed')>مؤكد</option>
                <option value="canceled" @selected(request('status') == 'canceled')>ملغي</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="date" class="form-label">تاريخ الموعد</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
        </div>

        <div class="col-md-3">
            <label for="from_date" class="form-label">من تاريخ</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>

        <div class="col-md-3">
            <label for="to_date" class="form-label">إلى تاريخ</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>

        <div class="col-md-3">
            <label for="time" class="form-label">الوقت</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ request('time') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">فلترة</button>
            <a href="{{ route('user.appointments.index') }}" class="btn btn-secondary ms-2">إعادة تعيين</a>
        </div>
    </form>

    {{-- رسالة النجاح --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($appointments->isEmpty())
        <div class="alert alert-info text-center">لا توجد مواعيد حالياً.</div>
    @else
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>اسم الطبيب</th>
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
                        <td>{{ $appointment->doctor->name ?? '—' }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>
                            <span class="badge bg-{{ $statusColors[$statusValue] ?? 'secondary' }}">
                                {{ ucfirst(__($statusValue)) }}
                            </span>
                        </td>
                          <td>
                            @if($statusValue === 'pending')
                                <form action="{{ route('user.appointments.destroy', $appointment->id) }}" method="DELETE" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-sm btn-success" type="submit"> 🗑️ حذف </button>
                                </form>

                                <form action="{{ route('user.appointments.cancel', $appointment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من إلغاء الموعد؟');">
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
