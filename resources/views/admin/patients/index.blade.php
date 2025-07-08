@extends('layouts.admin.admin')

@section('title', 'قائمة المرضى')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">قائمة المرضى</h2>

    @if($patients->isEmpty())
        <div class="alert alert-warning text-center">لا يوجد مرضى حالياً.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>تاريخ التسجيل</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
