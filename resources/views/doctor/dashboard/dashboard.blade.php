@extends('layouts.doctor.doctor')

@section('title', 'لوحة التحكم')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">لوحة تحكم الطبيب</h2>

    {{-- ✅ بطاقات الإحصائيات --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-info text-white shadow-sm">
                <div class="card-body">
                    <h6>مواعيد اليوم</h6>
                    <h4>{{ $stats['today'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white shadow-sm">
                <div class="card-body">
                    <h6>المؤكدة</h6>
                    <h4>{{ $stats['confirmed'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white shadow-sm">
                <div class="card-body">
                    <h6>الملغاة</h6>
                    <h4>{{ $stats['cancelled'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark shadow-sm">
                <div class="card-body">
                    <h6>المعلّقة</h6>
                    <h4>{{ $stats['pending'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ نموذج التصفية --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('doctor.dashboard') }}" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select">
                        <option value="">كل الحالات</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>معلقة</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>مؤكدة</option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>ملغاة</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">تاريخ الموعد</label>
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">الوقت</label>
                    <input type="time" name="time" class="form-control" value="{{ request('time') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">من تاريخ</label>
                    <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">إلى تاريخ</label>
                    <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                </div>

                <div class="col-md-1 d-grid">
                    <button type="submit" class="btn btn-primary">🔍</button>
                </div>
                <div class="col-md-1 d-grid">
                    <a href="{{ route('doctor.dashboard') }}" class="btn btn-secondary">🔄</a>
                </div>
            </form>
        </div>
    </div>

    {{-- ✅ جدول مواعيد اليوم --}}
    <h5 class="mb-3">مواعيد اليوم</h5>
    @if($appointmentsToday->isEmpty())
        <div class="alert alert-info text-center">لا توجد مواعيد لليوم.</div>
    @else
        <table class="table table-bordered table-striped text-center align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>اسم المريض</th>
                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
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

                @foreach($appointmentsToday as $appointment)
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
