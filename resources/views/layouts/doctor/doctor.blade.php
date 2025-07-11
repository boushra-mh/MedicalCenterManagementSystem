<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', __('messages.doctor_panel'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap RTL أو LTR حسب اللغة --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap{{ app()->getLocale() === 'ar' ? '.rtl' : '' }}.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>

    @yield('styles')
</head>
<body>
    {{-- الشريط العلوي --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('doctor.dashboard') }}">
                {{ __('messages.doctor_panel') }}
            </a>

            {{-- اختيار اللغة --}}
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

    {{-- المحتوى الكامل مع الشريط الجانبي --}}
    <div class="d-flex">
        @include('layouts.partials.doctor-sidebar')
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    {{-- JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</b
