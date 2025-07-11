@extends('layouts.admin.admin')

@section('title', __('messages.patients_list'))

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ __('messages.patients_list') }}</h2>

    @if($patients->isEmpty())
        <div class="alert alert-warning text-center">{{ __('messages.no_patients_yet') }}</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.registration_date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $patients->links() }}
        </div>
    @endif

</div>
@endsection
