@extends('layouts.admin.admin')

@section('title', 'Edit Specialty')

@section('content')
<div class="container mt-4">
    <h2>Edit Specialty</h2>

    <form action="{{ route('admin.specialties.update', $specialty->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name_en" class="form-label">Name (English)</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $specialty->getTranslation('name', 'en')) }}">
            @error('name_en') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name_ar" class="form-label">Name (Arabic)</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $specialty->getTranslation('name', 'ar')) }}">
            @error('name_ar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.specialties.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
