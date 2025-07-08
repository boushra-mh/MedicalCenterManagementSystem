@extends('doctor.layouts.app')
@section('title', 'الملف الشخصي')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">الملف الشخصي</h5>
    </div>
    <div class="card-body">
        <p><strong>الاسم:</strong> {{ auth('doctor_web')->user()->name }}</p>
        <p><strong>البريد الإلكتروني:</strong> {{ auth('doctor_web')->user()->email }}</p>
        <p><strong>الحالة:</strong>
            @if(auth('doctor_web')->user()->status == \App\Enums\StatusEnum::Active->value)
                <span class="badge bg-success">نشط</span>
            @else
                <span class="badge bg-secondary">غير نشط</span>
            @endif
        </p>

    </div>
</div>
@endsection
