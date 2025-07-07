<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- Bootstrap 5 RTL --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- أي CSS إضافي --}}
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body>
    {{-- ✅ رأس الصفحة (Navbar علوي ثابت) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">لوحة الإدارة</a>
        </div>
    </nav>

    {{-- ✅ محتوى الصفحة مقسم إلى Sidebar ومحتوى رئيسي --}}
    <div class="d-flex">
        {{-- ✅ الشريط الجانبي --}}
        @include('layouts.partials.admin-sidebar')

        {{-- ✅ محتوى الصفحة --}}
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    {{-- ✅ ملفات JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
