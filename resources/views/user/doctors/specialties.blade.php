@extends('layouts.user')

@section('title', 'اختر التخصص')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">اختر التخصص لرؤية الأطباء</h2>
    <ul class="list-group">
        @foreach($specialties as $specialty)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $specialty->name }}
                <a href="{{ route('user.specialties.doctors', $specialty->id) }}" class="btn btn-sm btn-primary">عرض الأطباء</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
