@extends('layouts.admin')

@section('title', 'قائمة الأطباء')

@section('content')
<div class="container mt-4">
    <h2>قائمة الأطباء</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary mb-3">إضافة طبيب جديد</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>التخصصات</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
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
                        @if($doctor->status == \App\Enums\StatusEnum::Active->value)
                            <span class="badge bg-success">نشط</span>
                        @else
                            <span class="badge bg-secondary">غير نشط</span>
                        @endif
                    </td>
                    <td>
                        <!-- زر التبديل -->
                        <form action="{{ route('admin.doctors.toggleStatus', $doctor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-outline-primary" type="submit">
                                @if($doctor->status == \App\Enums\StatusEnum::Active->value)
                                    تعطيل
                                @else
                                    تفعيل
                                @endif
                            </button>
                        </form>

                        <!-- زر التعديل -->
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-sm btn-warning">تعديل</a>

                        <!-- زر الحذف -->
                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطبيب؟');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">لا يوجد أطباء حتى الآن.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
