@extends('layouts.admin')

@section('title', 'تعديل بيانات الطبيب')

@section('content')
<div class="container mt-4">
    <h2>تعديل بيانات الطبيب</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $doctor->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $doctor->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="specialties" class="form-label">التخصصات</label>
            <select name="specialties[]" id="specialties" class="form-select" multiple>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" 
                        {{ (in_array($specialty->id, old('specialties', $doctor->specialties->pluck('id')->toArray()))) ? 'selected' : '' }}>
                        {{ $specialty->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">يمكنك اختيار أكثر من تخصص بالضغط على Ctrl أو Cmd</small>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
