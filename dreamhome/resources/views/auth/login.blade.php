<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome - Staff Login</title>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <h2>DreamHome Portal</h2>
            <p>Please sign in to access your dashboard</p>
        </div>

        <!-- Display Security Validation Errors if they occur -->
        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Core Laravel Auth Processing Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label Safe for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@email.com">
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>

            <!-- Extras: Remember Me & Forgot Password Links -->
            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit Action -->
            <button type="submit" class="btn-submit">
                Log In
            </button>
        </form>
    </div>

</body>
</html>