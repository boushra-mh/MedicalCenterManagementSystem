@extends('layouts.user.auth')

@section('title',__('messages.patient_login'))

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4> {{ __('messages.patient_login') }} </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.email') }} </label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.password') }} </label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">{{__('messages.patient_login')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
