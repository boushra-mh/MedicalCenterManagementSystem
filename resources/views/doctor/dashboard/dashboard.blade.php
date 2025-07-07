@extends('layouts.doctor')

@section('title', 'لوحة التحكم')

@section('content')
<div class="container">
    <h2 class="mb-4">لوحة التحكم - إحصائيات اليوم</h2>

    <div class="row text-center">
        <div class="col-md-3">
            <div class="card bg-info text-white mb-3">
                <div class="card-body">
                    <h5>مواعيد اليوم</h5>
                    <h2>{{ $stats['today'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5>المؤكدة</h5>
                    <h2>{{ $stats['confirmed'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white mb-3">
                <div class="card-body">
                    <h5>الملغاة</h5>
                    <h2>{{ $stats['cancelled'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark mb-3">
                <div class="card-body">
                    <h5>المعلقة</h5>
                    <h2>{{ $stats['pending'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <h4>📅 مواعيد اليوم</h4>
    @if($appointmentsToday->isEmpty())
        <p class="text-muted">لا توجد مواعيد اليوم.</p>
    @else
        <ul class="list-group">
            @foreach($appointmentsToday as $appointment)
                <li class="list-group-item d-flex justify-content-between">
                    {{ $appointment->user?->name ?? 'مريض غير معروف' }}
                    <span>{{ $appointment->date }} | {{ $appointment->time }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
