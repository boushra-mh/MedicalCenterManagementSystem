@extends('layouts.admin.admin')

@section('title', __('messages.create_specialty'))

@section('content')
<div class="container mt-4">
    <h2>{{ __('messages.create_specialty') }}</h2>

    <form action="{{ route('admin.specialties.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name_en" class="form-label">{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
            @error('name_en') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name_ar" class="form-label">{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
            @error('name_ar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.create') }}</button>
        <a href="{{ route('admin.specialties.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
    </form>
</div>
@endsection
