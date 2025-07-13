@php
    use App\Enums\StatusEnum;
@endphp

@extends('layouts.admin.admin')

@section('title', __('messages.doctors_list'))

@section('content')
<div class="container mt-4">
    <h2>{{ __('messages.doctors_list') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_new_doctor') }}</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.specialties') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->email }}</td>
                    <td>
                        @foreach($doctor->specialties as $specialty)
                            <span class="badge bg-info text-dark">{{ $specialty->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <button
                            class="btn btn-sm toggle-status-btn {{ $doctor->status == StatusEnum::Active ? 'btn-success' : 'btn-secondary' }}"
                            data-id="{{ $doctor->id }}">
                            {{ $doctor->status == StatusEnum::Active ? __('messages.active') : __('messages.inactive') }}
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>
                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('{{ __('messages.confirm_delete_doctor') }}');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">{{ __('messages.no_doctors_yet') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.toggle-status-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const doctorId = this.getAttribute('data-id');
            const token = '{{ csrf_token() }}';
            const btn = this;

            fetch(`/admin/doctors/${doctorId}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.json();
            })
            .then(data => {
                if (data.status === 'active') {
                    btn.classList.remove('btn-secondary');
                    btn.classList.add('btn-success');
                    btn.textContent = '{{ __("messages.active") }}';
                } else {
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-secondary');
                    btn.textContent = '{{ __("messages.inactive") }}';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء تحديث الحالة');
            });
        });
    });
});
</script>
@endpush
