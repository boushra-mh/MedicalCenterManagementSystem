@extends('layouts.user.auth')

@section('title', 'تسجيل دخول المريض')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4>تسجيل دخول المريض</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">دخول</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
