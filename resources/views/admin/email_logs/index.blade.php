@extends('layouts.admin.admin')

@section('title', __('messages.email_logs'))

@section('content')
<div class="container mt-4">
    <h4>📧 {{ __('messages.sent_emails_log') }}</h4>
    <table class="table table-bordered mt-3 text-center">
        <thead class="table-dark">
            <tr>
                <th>{{ __('messages.recipient') }}</th>
                <th>{{ __('messages.subject') }}</th>
                <th>{{ __('messages.date') }}</th>
                <th>{{ __('messages.view') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emails as $email)
                <tr>
                    <td>{{ $email->to_email }}</td>
                    <td>{{ $email->subject }}</td>
                    <td>{{ $email->created_at->format('Y-m-d H:i') }}</td>
                    <td><a href="{{ route('admin.email_logs.show', $email->id) }}" class="btn btn-sm btn-info">{{ __('messages.view') }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $emails->links() }}
</div>
@endsection
