<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- Bootstrap 5 RTL أو LTR حسب اللغة --}}
    @if(app()->getLocale() == 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- أي CSS إضافي --}}
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .cursor-pointer {
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .cursor-pointer:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            text-decoration: none !important;
        }
        a > .card {
            color: inherit;
        }
    </style>

    @yield('styles')
</head>

<body>
    {{-- رأس الصفحة (Navbar علوي ثابت) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">لوحة الإدارة</a>

            {{-- زر تغيير اللغة --}}
            <div class="dropdown ms-auto">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    🌐 {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('lang.switch', 'ar') }}">العربية</a></li>
                    <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- محتوى الصفحة مقسم إلى Sidebar ومحتوى رئيسي --}}
    <div class="d-flex">
        {{-- الشريط الجانبي --}}
        @include('layouts.partials.admin-sidebar')

        {{-- محتوى الصفحة --}}
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    {{-- ملفات JS --}}
    @if(app()->getLocale() == 'ar')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @else
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endif

    @yield('scripts')
</body>
</html>
