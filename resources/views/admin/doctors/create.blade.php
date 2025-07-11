@extends('layouts.admin.admin')

@section('title', __('messages.add_doctor'))

@section('content')
<div class="container mt-4">
    <h2>{{ __('messages.add_doctor') }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.doctors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="specialties" class="form-label">{{ __('messages.specialties') }}</label>
            <select name="specialties[]" id="specialties" class="form-select" multiple>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ (collect(old('specialties'))->contains($specialty->id)) ? 'selected' : '' }}>
                        {{ $specialty->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">{{ __('messages.select_multiple_hint') }}</small>
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</div>
@endsection
