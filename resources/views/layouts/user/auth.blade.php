<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'تسجيل دخول المريض')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #e9f7ef;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.login') }}">لوحة تحكم المريض</a>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
