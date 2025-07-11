@extends('layouts.doctor.doctor')

@section('title', __('messages.email_log'))

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📧 {{ __('messages.email_log') }}</h2>

    @if($emails->isEmpty())
        <div class="alert alert-info text-center">{{ __('messages.no_emails_yet') }}</div>
    @else
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.to_email') }}</th>
                    <th>{{ __('messages.subject') }}</th>
                    <th>{{ __('messages.content') }}</th>
                    <th>{{ __('messages.sent_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emails as $email)
                    <tr>
                        <td>{{ $email->to_email }}</td>
                        <td>{{ $email->subject }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" data-bs-target="#body{{ $loop->index }}">
                                {{ __('messages.show_content') }}
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
