@extends('layouts.doctor.doctor')

@section('title', __('messages.doctor_dashboard'))

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
<div class="container mt-4">
    <h2 class="mb-4">{{ __('messages.doctor_dashboard') }}</h2>

    {{-- ✅ بطاقات الإحصائيات --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-info text-white shadow-sm cursor-pointer">
                <div class="card-body">
                    <h6>{{ __('messages.today_appointments') }}</h6>
                    <h4>{{ $stats['today'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white shadow-sm cursor-pointer">
                <div class="card-body">
                    <h6>{{ __('messages.confirmed') }}</h6>
                    <h4>{{ $stats['confirmed'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white shadow-sm cursor-pointer">
                <div class="card-body">
                    <h6>{{ __('messages.cancelled') }}</h6>
                    <h4>{{ $stats['cancelled'] }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark shadow-sm cursor-pointer">
                <div class="card-body">
                    <h6>{{ __('messages.pending') }}</h6>
                    <h4>{{ $stats['pending'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ جدول مواعيد اليوم --}}
    <h5 class="mb-3">{{ __('messages.today_appointments') }}</h5>
    @if($appointmentsToday->isEmpty())
        <div class="alert alert-info text-center">{{ __('messages.no_appointments_today') }}</div>
    @else
        <table class="table table-bordered table-striped text-center align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.patient_name') }}</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.time') }}</th>
                    <th>{{ __('messages.status') }}</th>
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
                                {{ ucfirst(__("messages.$statusValue")) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
