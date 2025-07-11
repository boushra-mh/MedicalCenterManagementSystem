@extends('layouts.user.user')

@section('title', __('messages.book_appointment'))

@section('content')
<div class="container mt-4">
    <h2>{{ __('messages.book_appointment') }}</h2>

    <form action="{{ route('user.appointments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">{{ __('messages.appointment_date') }}</label>
            <input type="date" id="date" name="date" class="form-control" required value="{{ old('date') }}">
            @error('date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">{{ __('messages.time') }}</label>
            <input type="time" id="time" name="time" class="form-control" required value="{{ old('time') }}">
            @error('time')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="doctor_id" class="form-label">{{ __('messages.select_doctor') }}</label>
            <select name="doctor_id" id="doctor_id" class="form-select" required>
                <option value="">{{ __('messages.choose_doctor') }}</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
            @error('doctor_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.book') }}</button>
    </form>
</div>
@endsection
