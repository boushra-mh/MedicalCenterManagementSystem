@extends('layouts.user.user')

@section('title', __('messages.choose_specialty'))

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">{{ __('messages.choose_specialty') }}</h2>
    <ul class="list-group">
        @foreach($specialties as $specialty)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $specialty->name }}
                <a href="{{ route('user.specialties.doctors', $specialty->id) }}" class="btn btn-sm btn-primary">
                    {{ __('messages.view_doctors') }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
