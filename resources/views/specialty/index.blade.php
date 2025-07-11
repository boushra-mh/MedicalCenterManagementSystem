@extends('layouts.admin.admin')

@section('title', __('messages.specialties'))

@section('content')
<div class="container">
    <h2>{{ __('messages.specialties') }}</h2>

    @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif

    <a href="{{ route('admin.specialties.create') }}" class="btn btn-primary mb-3">
        {{ __('messages.add_new_specialty') }}
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('messages.name_en') }}</th>
                <th>{{ __('messages.name_ar') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($specialties as $specialty)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $specialty->getTranslation('name', 'en') }}</td>
                    <td>{{ $specialty->getTranslation('name', 'ar') }}</td>
                    <td>
                        <a href="{{ route('admin.specialties.edit', $specialty->id) }}" class="btn btn-sm btn-warning">
                            {{ __('messages.edit') }}
                        </a>
                        <form action="{{ route('admin.specialties.destroy', $specialty->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $specialties->links() }}
    </div>
</div>
@endsection
