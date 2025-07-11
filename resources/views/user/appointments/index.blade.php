@extends('layouts.user.user')

@section('title', __('messages.my_appointments'))

@section('styles')
<style>
    /* تحسين مظهر الأزرار والأيقونات */
    .action-btn {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 1.2rem;
        margin: 0 4px;
        transition: color 0.3s ease;
    }
    .action-btn.delete {
        color: #28a745; /* أخضر */
    }
    .action-btn.delete:hover {
        color: #19692c;
    }
    .action-btn.cancel {
        color: #dc3545; /* أحمر */
    }
    .action-btn.cancel:hover {
        color: #8a1c1c;
    }
    tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">{{ __('messages.my_appointments') }}</h2>

    {{-- نموذج الفلترة --}}
    <form method="GET" action="{{ route('user.appointments.index') }}" class="mb-4 row g-3 align-items-center">
        <div class="col-md-3">
            <label for="status" class="form-label">{{ __('messages.status') }}</label>
            <select name="status" id="status" class="form-select">
                <option value="">{{ __('messages.all') ?? 'الكل' }}</option>
                <option value="pending" @selected(request('status') == 'pending')>{{ __('messages.pending') }}</option>
                <option value="confirmed" @selected(request('status') == 'confirmed')>{{ __('messages.confirmed') }}</option>
                <option value="canceled" @selected(request('status') == 'canceled')>{{ __('messages.canceled') }}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="date" class="form-label">{{ __('messages.appointment_date') }}</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
        </div>

        <div class="col-md-3">
            <label for="from_date" class="form-label">{{ __('messages.from_date') ?? 'من تاريخ' }}</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>

        <div class="col-md-3">
            <label for="to_date" class="form-label">{{ __('messages.to_date') ?? 'إلى تاريخ' }}</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>

        <div class="col-md-3">
            <label for="time" class="form-label">{{ __('messages.time') }}</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ request('time') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">{{ __('messages.filter') }}</button>
            <a href="{{ route('user.appointments.index') }}" class="btn btn-secondary ms-2">{{ __('messages.reset') }}</a>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($appointments->isEmpty())
        <div class="alert alert-info text-center">{{ __('messages.no_appointments') }}</div>
    @else
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.doctor_name') }}</th>
                    <th>{{ __('messages.appointment_date') }}</th>
                    <th>{{ __('messages.time') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.actions') }}</th>
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
                                {{ ucfirst(__("messages.$statusValue")) }}
                            </span>
                        </td>
                        <td>
                            @if($statusValue === 'pending')
                                <form action="{{ route('user.appointments.destroy', $appointment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('messages.are_you_sure_delete') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-btn delete" type="submit" title="{{ __('messages.delete') }}">
                                        🗑️
                                    </button>
                                </form>

                                <form action="{{ route('user.appointments.cancel', $appointment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('messages.are_you_sure_cancel') }}');">
                                    @csrf
                                    <button class="action-btn cancel" type="submit" title="{{ __('messages.cancel') }}">
                                        ❌
                                    </button>
                                </form>
                            @else
                                <span>—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $appointments->links() }}
        </div>
    @endif
</div>
@endsection
