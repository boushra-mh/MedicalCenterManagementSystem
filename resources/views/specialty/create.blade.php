@extends('layouts.admin')

@section('title', 'Create Specialty')

@section('content')
<div class="container mt-4">
    <h2>Create New Specialty</h2>

    <form action="{{ route('admin.specialties.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name_en" class="form-label">Name (English)</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
            @error('name_en') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name_ar" class="form-label">Name (Arabic)</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
            @error('name_ar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('admin.specialties.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
