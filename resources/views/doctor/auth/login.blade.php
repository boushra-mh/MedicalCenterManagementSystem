<!DOCTYPE html>
<html>
<head><title>Doctor Login</title></head>
<body>
    <h2>Doctor Login</h2>

    <form method="POST" action="{{ route('doctor.login') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>

    @if ($errors->any())
    <div style="color: red;">{{ $errors->first() }}</div>
    @endif
</body>
</html>
