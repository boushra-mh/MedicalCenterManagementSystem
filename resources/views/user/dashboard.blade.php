<!DOCTYPE html>
<html>
<head><title>User Dashboard</title></head>
<body>
    <h1>Welcome, {{ auth()->user()->name }}</h1>

    <form method="POST" action="{{ route('user.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
