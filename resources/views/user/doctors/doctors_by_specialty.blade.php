@extends('layouts.user.user')

@section('title', __('messages.doctors_in_specialty', ['specialty' => $specialty->name]))

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">{{ __('messages.doctors_in_specialty', ['specialty' => $specialty->name]) }}</h2>

    @if($specialty->doctors->isEmpty())
        <div class="alert alert-warning">{{ __('messages.no_doctors_in_specialty') }}</div>
    @else
        <div class="row">
            @foreach($specialty->doctors as $doctor)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>{{ $doctor->name }}</h5>
                            <p><strong>{{ __('messages.email') }}:</strong> {{ $doctor->email }}</p>
                            <p><strong>{{ __('messages.status') }}:</strong> 
                                <span class="badge bg-{{ $doctor->status->value === 'active' ? 'success' : 'secondary' }}">
                                    {{ $doctor->status->label() }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
