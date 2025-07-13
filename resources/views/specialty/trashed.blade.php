@extends('layouts.admin.admin')

@section('title', __('messages.trashed_specialties'))

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-danger">🗑️ {{ __('messages.trashed_specialties_list') }}</h2>

    @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($specialties->isEmpty())
    <div class="alert alert-warning text-center">{{ __('messages.no_trashed_specialties') }}</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.name_en') }}</th>
                    <th>{{ __('messages.name_ar') }}</th>
                    <th>{{ __('messages.deleted_at') }}</th>
                    <th>{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($specialties as $specialty)
                <tr>
                    <td>{{ $specialty->getTranslation('name', 'en') }}</td>
                    <td>{{ $specialty->getTranslation('name', 'ar') }}</td>

                    <td>{{ $specialty->deleted_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.specialties.forceDelete', $specialty->id) }}" method="POST"
                            onsubmit="return confirm('{{ __('messages.confirm_force_delete') }}');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                🗑️ {{ __('messages.force_delete') }}
                            </button>
                        </form>
                        <form action="{{ route('admin.specialties.restore', $specialty->id) }}" method="POST"
                            onsubmit="return confirm('{{ __('messages.restore') }}');">
                            @csrf
                            <button class="btn btn-sm btn-warning">
                                ♻️ {{ __('messages.restore') }}
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection