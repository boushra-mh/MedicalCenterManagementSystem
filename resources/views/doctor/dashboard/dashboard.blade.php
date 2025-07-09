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
