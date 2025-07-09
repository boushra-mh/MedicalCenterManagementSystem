@extends('layouts.admin.admin')

@section('title', 'سجل الإيميلات')

@section('content')
<div class="container mt-4">
    <h4>📧 سجل الرسائل المرسلة</h4>
    <table class="table table-bordered mt-3 text-center">
        <thead class="table-dark">
            <tr>
                <th>المرسل إليه</th>
                <th>الموضوع</th>
                <th>التاريخ</th>
                <th>عرض</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emails as $email)
                <tr>
                    <td>{{ $email->to_email }}</td>
                    <td>{{ $email->subject }}</td>
                    <td>{{ $email->created_at->format('Y-m-d H:i') }}</td>
                    <td><a href="{{ route('admin.email_logs.show', $email->id) }}" class="btn btn-sm btn-info">عرض</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $emails->links() }}
</div>
@endsection
