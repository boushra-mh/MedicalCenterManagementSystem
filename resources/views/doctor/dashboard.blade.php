<!DOCTYPE html>
<html>
<head><title>Doctor Dashboard</title></head>
<body>
    <h1>Welcome, Dr. {{ auth()->guard('doctor_web')->user()->name }}</h1>

    <form method="POST" action="{{ route('doctor.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
