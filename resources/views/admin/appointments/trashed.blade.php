@extends('layouts.admin.admin')

@section('title', __('messages.deleted_appointments'))

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-danger">🗑️ {{ __('messages.deleted_appointments_list') }}</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($appointments->isEmpty())
        <div class="alert alert-warning text-center">{{ __('messages.no_deleted_appointments') }}</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('messages.patient_name') }}</th>
                        <th>{{ __('messages.doctor_name') }}</th>
                        <th>{{ __('messages.appointment_date') }}</th>
                        <th>{{ __('messages.time') }}</th>
                        <th>{{ __('messages.deleted_at') }}</th>
                        <th>{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->user?->name ?? '-' }}</td>
                            <td>{{ $appointment->doctor?->name ?? '-' }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->deleted_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.appointments.forceDelete', $appointment->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_force_delete') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        🗑️ {{ __('messages.force_delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
