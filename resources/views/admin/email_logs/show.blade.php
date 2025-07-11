@extends('layouts.admin.admin')

@section('title', __('messages.email_details'))

@section('content')
<div class="container mt-4">
    <h4>📩 {{ __('messages.email_details') }}</h4>
    <div class="mb-2"><strong>{{ __('messages.to') }}:</strong> {{ $email->to_email }}</div>
    <div class="mb-2"><strong>{{ __('messages.subject') }}:</strong> {{ $email->subject }}</div>
    <div class="mb-2"><strong>{{ __('messages.sent_at') }}:</strong> {{ $email->created_at->format('Y-m-d H:i') }}</div>
    <hr>
    <div class="bg-light p-3">
        {!! $email->body !!}
    </div>
</div>
@endsection
