<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'لوحة المريض')</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>

    @yield('styles')
</head>
<body>

    <div class="d-flex">
        <!-- الشريط الجانبي -->
        <div class="sidebar p-3">
      <h5 class="text-white mb-4">👨‍⚕️ {{ __('messages.patient') }}</h5>
<a href="{{ route('user.dashboard') }}">🏠 {{ __('messages.dashboard') }}</a>
<a href="{{ route('user.appointments.index') }}">📋 {{ __('messages.my_appointments') }}</a>
<a href="{{ route('user.appointments.create') }}">➕ {{ __('messages.book_appointment') }}</a>
<a href="{{ route('user.logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   🚪 {{ __('messages.logout') }}
</a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- محتوى الصفحة -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
