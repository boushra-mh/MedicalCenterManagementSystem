@extends('layouts.admin.admin')

@section('title', __('messages.appointments_list'))

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ __('messages.all_appointments') }}</h2>

    @if($appointments->isEmpty())
        <div class="alert alert-info text-center">{{ __('messages.no_appointments') }}</div>
    @else
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>{{ __('messages.patient') }}</th>
                    <th>{{ __('messages.doctor') }}</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.time') }}</th>
                    <th>{{ __('messages.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->user?->name ?? '-' }}</td>
                        <td>{{ $appointment->doctor?->name ?? '-' }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                       <td>{{ __('messages.' . $appointment->status->value) }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $appointments->links() }}
        </div>
    @endif
</div>
@endsection
