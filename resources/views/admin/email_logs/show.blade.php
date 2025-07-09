@extends('layouts.admin.admin')

@section('title', 'تفاصيل الإيميل')

@section('content')
<div class="container mt-4">
    <h4>📩 تفاصيل الرسالة</h4>
    <div class="mb-2"><strong>إلى:</strong> {{ $email->to_email }}</div>
    <div class="mb-2"><strong>الموضوع:</strong> {{ $email->subject }}</div>
    <div class="mb-2"><strong>أُرسلت في:</strong> {{ $email->created_at->format('Y-m-d H:i') }}</div>
    <hr>
    <div class="bg-light p-3">
        {!! $email->body !!}
    </div>
</div>
@endsection
s