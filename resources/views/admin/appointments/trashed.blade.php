@extends('layouts.admin')

@section('title', 'المواعيد المحذوفة مؤقتاً')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-danger">🗑️ قائمة المواعيد المحذوفة مؤقتاً</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($appointments->isEmpty())
        <div class="alert alert-warning text-center">لا يوجد مواعيد محذوفة حالياً.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>اسم المريض</th>
                        <th>اسم الطبيب</th>
                        <th>تاريخ الموعد</th>
                        <th>الوقت</th>
                        <th>تاريخ الحذف</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->user?->name ?? '-' }}</td>
                            <td>{{ $appointment->doctor?->name ?? '-' }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->deleted_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.appointments.forceDelete', $appointment->id) }}" method="POST" onsubmit="return confirm('⚠️ هل أنت متأكد أنك تريد حذف هذا الموعد نهائياً؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        حذف نهائي 🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
