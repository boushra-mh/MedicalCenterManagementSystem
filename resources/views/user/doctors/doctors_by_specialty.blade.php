@extends('layouts.user')

@section('title', 'الأطباء - ' . $specialty->name)

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">الأطباء في تخصص {{ $specialty->name }}</h2>

    @if($specialty->doctors->isEmpty())
        <div class="alert alert-warning">لا يوجد أطباء حاليًا في هذا التخصص.</div>
    @else
        <div class="row">
            @foreach($specialty->doctors as $doctor)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>{{ $doctor->name }}</h5>
                            <p><strong>البريد:</strong> {{ $doctor->email }}</p>
                            <p><strong>الحالة:</strong> 
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
