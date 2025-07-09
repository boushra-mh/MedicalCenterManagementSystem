@extends('layouts.doctor.doctor')

@section('title', 'سجل الإيميلات')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📧 سجل الرسائل الإلكترونية</h2>

    @if($emails->isEmpty())
        <div class="alert alert-info text-center">لا توجد رسائل حالياً.</div>
    @else
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>البريد المستلم</th>
                    <th>العنوان</th>
                    <th>المحتوى</th>
                    <th>تاريخ الإرسال</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emails as $email)
                    <tr>
                        <td>{{ $email->to_email }}</td>
                        <td>{{ $email->subject }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" data-bs-target="#body{{ $loop->index }}">
                                عرض المحتوى
                            </button>
                            <div id="body{{ $loop->index }}" class="collapse mt-2 text-start">
                                {!! $email->body !!}
                            </div>
                        </td>
                        <td>{{ $email->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $emails->links() }}
    @endif
</div>
@endsection
