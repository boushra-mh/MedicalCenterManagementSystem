@extends('layouts.admin.admin')

@section('title', __('messages.admin_panel'))

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
    a > .card {
        color: inherit;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">{{ __('messages.admin_panel') }}</h2>
        <span class="text-muted">{{ __('messages.welcome_message') }}</span>
    </div>

    <div class="row g-4">
        <!-- عدد الأطباء -->
        <div class="col-md-3">
            <a href="{{ route('admin.doctors.index') }}" class="text-decoration-none">
                <div class="card bg-primary text-white shadow-sm cursor-pointer">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge fs-1 mb-2"></i>
                        <h5>{{ __('messages.total_doctors') }}</h5>
                        <h3>{{ $statsArray['total_doctors'] }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <!-- عدد المرضى -->
        <div class="col-md-3">
            <a href="{{ route('admin.patients.index') }}" class="text-decoration-none">
                <div class="card bg-success text-white shadow-sm cursor-pointer">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 mb-2"></i>
                        <h5>{{ __('messages.total_patients') }}</h5>
                        <h3>{{ $statsArray['total_patients'] }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <!-- عدد المواعيد -->
        <div class="col-md-3">
            <a href="{{ route('admin.appointments.index') }}" class="text-decoration-none">
                <div class="card bg-info text-white shadow-sm cursor-pointer">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check fs-1 mb-2"></i>
                        <h5>{{ __('messages.total_appointments') }}</h5>
                        <h3>{{ $statsArray['total_appointments'] }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <!-- عدد المحذوفة -->
        <div class="col-md-3">
            <a href="{{ route('admin.appointments.trashed') }}" class="text-decoration-none">
                <div class="card bg-danger text-white shadow-sm cursor-pointer">
                    <div class="card-body text-center">
                        <i class="bi bi-trash fs-1 mb-2"></i>
                        <h5>{{ __('messages.trashed_appointments') }}</h5>
                        <h3>{{ $statsArray['total_appointmentsWithTrashed'] }}</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- رسم بياني -->
    <div class="card mt-5 shadow-sm">
        <div class="card-header bg-light fw-bold">
            {{ __('messages.chart_title') }}
        </div>
        <div class="card-body d-flex justify-content-center">
            <div style="width: 320px; height: 320px;">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                '{{ __('messages.total_doctors') }}',
                '{{ __('messages.total_patients') }}',
                '{{ __('messages.total_appointments') }}',
                '{{ __('messages.trashed_appointments') }}'
            ],
            datasets: [{
                data: [
                    {{ $statsArray['total_doctors'] }},
                    {{ $statsArray['total_patients'] }},
                    {{ $statsArray['total_appointments'] }},
                    {{ $statsArray['total_appointmentsWithTrashed'] }}
                ],
                backgroundColor: ['#0d6efd', '#198754', '#0dcaf0', '#dc3545'],
                borderColor: '#fff',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            return `${label}: ${value}`;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
