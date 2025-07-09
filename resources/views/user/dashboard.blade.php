@extends('layouts.user.user')

@section('title', 'لوحة التحكم')
@section('styles')
<style>
    .cursor-pointer {
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .cursor-pointer:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        text-decoration: none !important;
    }
     .card {
        color: inherit;
    }
</style>
@endsection
@section('content')
<div class="container">
    <h2 class="mb-4">لوحة التحكم</h2>

    <!-- بطاقات الإحصائيات -->
    <div class="row text-center">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white cursor-pointer">
                <div class="card-body">
                    <h5>كل المواعيد</h5>
                    <h3>{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white cursor-pointer">
                <div class="card-body">
                    <h5>مواعيد مؤكدة</h5>
                    <h3>{{ $stats['confirmed'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white cursor-pointer">
                <div class="card-body">
                    <h5>مواعيد ملغاة</h5>
                    <h3>{{ $stats['canceled'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark cursor-pointer">
                <div class="card-body">
                    <h5>مواعيد معلقة</h5>
                    <h3>{{ $stats['pending'] }}</h3>
                </div>
            </div>
        </div>
    </div>
     {{-- ✅ زر سجل الإيميلات --}}
    <div class="mb-4 text-end">
        <a href="{{ route('emails') }}" class="btn btn-outline-primary shadow-sm">
            📧 عرض سجل الإيميلات المرسلة
        </a>
    </div>

    <!-- جدول مواعيد اليوم -->
    <div class="mt-5">
        <h4>مواعيد اليوم</h4>
        @if($appointmentsToday->isEmpty())
            <div class="alert alert-info">لا يوجد مواعيد اليوم.</div>
        @else
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>الطبيب</th>
                        <th>الوقت</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointmentsToday as $appointment)
                        @php
                            $status = $appointment->status instanceof \BackedEnum
                                ? $appointment->status->value
                                : (string) $appointment->status;

                            $colors = [
                                'pending' => 'warning',
                                'confirmed' => 'success',
                                'canceled' => 'danger'
                            ];
                        @endphp
                        <tr>
                            <td>{{ $appointment->doctor?->name ?? '-' }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>
                                <span class="badge bg-{{ $colors[$status] ?? 'secondary' }}">
                                    {{ __($status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- عرض قائمة التخصصات -->
    <div class="mt-5">
        <h4>التخصصات الطبية</h4>
        @if(!empty($specialties) && $specialties->isNotEmpty())
            <ul class="list-group">
                @foreach($specialties as $specialty)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $specialty->name }}
                        <a href="{{ route('specialties.doctors', $specialty->id) }}" class="btn btn-sm btn-primary">عرض الأطباء</a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info">لا توجد تخصصات متاحة.</div>
        @endif
    </div>
</div>
@endsection
