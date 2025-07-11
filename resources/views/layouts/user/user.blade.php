<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', __('messages.patient_panel'))</title>

    {{-- Bootstrap RTL or LTR --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap{{ app()->getLocale() === 'ar' ? '.rtl' : '' }}.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Cairo font for Arabic --}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            width: 220px;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-weight: 500;
        }
        .sidebar a:hover {
            background-color: #495057;
            text-decoration: none;
        }
        .content-area {
            flex-grow: 1;
            padding: 20px;
        }
        /* Adjust margin for RTL and LTR */
        [dir="rtl"] .sidebar {
            border-left: 1px solid #495057;
        }
        [dir="ltr"] .sidebar {
            border-right: 1px solid #495057;
        }
    </style>

    @yield('styles')
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('user.dashboard') }}">👨‍⚕️ {{ __('messages.patient_panel') }}</a>

            {{-- Language Switcher --}}
            <div class="dropdown ms-auto">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    🌐 {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('lang.switch', 'ar') }}">العربية</a></li>
                    <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Layout: sidebar + main content --}}
    <div class="d-flex">
        <div class="sidebar p-3">
            <h5 class="text-white mb-4">👨‍⚕️ {{ __('messages.patient') }}</h5>
            <a href="{{ route('user.dashboard') }}">🏠 {{ __('messages.dashboard') }}</a>
            <a href="{{ route('user.appointments.index') }}">📋 {{ __('messages.my_appointments') }}</a>
            <a href="{{ route('user.appointments.create') }}">➕ {{ __('messages.book_appointment') }}</a>
               <!-- 📧 سجل الإيميلات -->
  
            <a class="nav-link {{ request()->routeIs('emails') ? 'active' : '' }}" href="{{ route('emails') }}">
                📧 {{ __('messages.email_logs') }}
            </a>
        
            <a href="{{ route('user.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               🚪 {{ __('messages.logout') }}
            </a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <main class="content-area">
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
