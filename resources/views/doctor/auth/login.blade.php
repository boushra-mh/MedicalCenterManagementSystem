@extends('layouts.doctor.auth')

@section('title', __('messages.doctor_login'))

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>{{ __('messages.doctor_login') }}  </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('doctor.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{__('messages.email')}}</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{__('messages.password')}}</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('messages.doctor_login') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
