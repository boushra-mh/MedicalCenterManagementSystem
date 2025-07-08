@extends('layouts.admin.auth')

@section('title', 'تسجيل دخول الإدارة')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4>تسجيل دخول الإدارة</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('admin/login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
