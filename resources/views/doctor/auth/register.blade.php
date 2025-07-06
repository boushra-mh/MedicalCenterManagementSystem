<!DOCTYPE html>
<html>
<head><title>Doctor Register</title></head>
<body>
    <h2>Doctor Register</h2>

    <form method="POST" action="{{ route('doctor.register') }}">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required><br>

        <button type="submit">Register</button>
    </form>

    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>
</html>
