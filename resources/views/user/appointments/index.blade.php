@extends('layouts.user')

@section('title', 'مواعيدي')

@section('content')
<div class="container mt-4">
    <h2>مواعيدي</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('user.appointments.create') }}" class="btn btn-primary mb-3">حجز موعد جديد</a>

    @if($appointments->isEmpty())
        <div class="alert alert-info">لا توجد مواعيد حتى الآن.</div>
    @else
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    @php
                        $status = $appointment->status->value;
                    @endphp
                    <tr>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ __($status) }}</td>
                    <td>
    @if($status === 'pending')
        <form action="{{ route('user.appointments.cancel', $appointment->id) }}" method="POST" onsubmit="return confirm('هل تريد إلغاء الموعد؟');" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-warning btn-sm">إلغاء</button>
        </form>

        <form action="{{ route('user.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('هل تريد حذف الموعد نهائيًا؟');" style="display:inline-block; margin-right: 5px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
        </form>
    @else
        -
    @endif
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $appointments->links() }}
    @endif
</div>
@endsection
