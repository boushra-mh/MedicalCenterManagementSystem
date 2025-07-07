@extends('layouts.admin')

@section('title', 'قائمة المواعيد')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">جميع المواعيد</h2>

    @if($appointments->isEmpty())
        <div class="alert alert-info text-center">لا يوجد مواعيد حالياً.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>المريض</th>
                    <th>الطبيب</th>
                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->user?->name ?? '-' }}</td>
                        <td>{{ $appointment->doctor?->name ?? '-' }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ $appointment->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
