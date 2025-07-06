<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة الطبيب')</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- ✅ الشريط العلوي -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('doctor.dashboard') }}">لوحة الطبيب</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDoctor"
                aria-controls="navbarDoctor" aria-expanded="false" aria-label="تبديل القائمة">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarDoctor">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}"
                           href="{{ route('doctor.dashboard') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('doctor.appointments.index') ? 'active' : '' }}"
                           href="{{ route('doctor.appointments.index') }}">كل المواعيد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('doctor.profile') ? 'active' : '' }}"
                           href="{{ route('doctor.profile') }}">الملف الشخصي</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white" style="text-decoration: none;">تسجيل الخروج</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ محتوى الصفحة -->
    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
