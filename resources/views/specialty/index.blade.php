@extends('layouts.admin.admin')
@section('content')
<div class="container">
    <h2>التخصصات</h2>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <a href="{{ route('admin.specialties.create') }}" class="btn btn-primary mb-3">إضافة تخصص جديد</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم باللغة الانجليزية</th>
                <th>الاسم باللغة العربية</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($specialties as $specialty)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $specialty->getTranslation('name', 'en') }}</td>
                    <td>{{ $specialty->getTranslation('name', 'ar') }}</td>
                    <td>
                        <a href="{{ route('admin.specialties.edit', $specialty->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.specialties.destroy', $specialty->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
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
