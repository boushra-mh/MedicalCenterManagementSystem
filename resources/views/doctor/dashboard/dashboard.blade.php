@extends('doctor.layouts.app')
@section('title', 'لوحة الطبيب')

@section('content')
<div class="container mt-4">
    <h2>مرحباً بك في لوحة الطبيب</h2>

    <h4 class="mt-4">📅 مواعيد اليوم</h4>

    @if($appointmentsToday->isEmpty())
        <p>لا يوجد مواعيد مجدولة لليوم.</p>
    @else
        <div class="row">
            @foreach($appointmentsToday as $appointment)
                @include('doctor.dashboard.partials._appointment_card', ['appointment' => $appointment])
            @endforeach
        </div>
    @endif
</div>
@endsection
