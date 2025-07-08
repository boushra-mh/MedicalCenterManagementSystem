<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'لوحة الطبيب')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body>
    {{-- شريط علوي --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('doctor.dashboard') }}">Doctor Panel</a>
        </div>
    </nav>

    {{-- المحتوى الكامل مع الشريط الجانبي --}}
    <div class="d-flex">
        @include('layouts.partials.doctor-sidebar')
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
