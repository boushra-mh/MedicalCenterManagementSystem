@extends('doctor.layouts.app')
@section('title', 'كل المواعيد')

@section('content')
<div class="container mt-4">
    <h2>كل المواعيد</h2>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-4">
            <label class="form-label">الحالة</label>
            <select name="status" class="form-select">
                <option value="">الكل</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">التاريخ</label>
            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
        </div>
        <div class="col-md-4 align-self-end">
            <button class="btn btn-primary">تصفية</button>
        </div>
    </form>

    @foreach($appointments as $appointment)
        @include('doctor.dashboard.partials._appointment_card', ['appointment' => $appointment])
    @endforeach

    {{ $appointments->withQueryString()->links() }}
</div>
@endsection
