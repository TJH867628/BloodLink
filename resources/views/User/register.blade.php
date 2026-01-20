<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Link - Register</title>
</head>
<body>
    <h1>Register to Blood Link</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="name">name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        @if(session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif
        <button type="submit">Register</button>
    </form>
</body>
</html>