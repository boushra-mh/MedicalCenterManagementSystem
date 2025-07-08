@extends('layouts.user.user')

@section('title', 'حجز موعد جديد')

@section('content')
<div class="container mt-4">
    <h2>حجز موعد جديد</h2>

    <form action="{{ route('user.appointments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">تاريخ الموعد</label>
            <input type="date" id="date" name="date" class="form-control" required value="{{ old('date') }}">
            @error('date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">وقت الموعد</label>
            <input type="time" id="time" name="time" class="form-control" required value="{{ old('time') }}">
            @error('time')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

       <div class="mb-3">
    <label for="doctor_id" class="form-label">اختر الطبيب</label>
    <select name="doctor_id" id="doctor_id" class="form-select" required>
        <option value="">-- اختر الطبيب --</option>
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

        
        <button type="submit" class="btn btn-primary">حجز</button>
    </form>
</div>
@endsection
