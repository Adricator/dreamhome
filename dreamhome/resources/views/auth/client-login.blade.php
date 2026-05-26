<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome - Client Portal</title>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <h2>Client Login</h2>
            <p>Sign in to view matching leases and preferences</p>
        </div>

        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('client.login.submit') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@email.com">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                    <button type="button" id="password-toggle" class="toggle-password-btn" aria-label="Toggle password visibility">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        
                        <svg id="eye-off-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                    </button>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const passwordInput = document.getElementById('password');
                    const toggleButton = document.getElementById('password-toggle');
                    const eyeIcon = document.getElementById('eye-icon');
                    const eyeOffIcon = document.getElementById('eye-off-icon');

                    toggleButton.addEventListener('click', function() {
                        if (passwordInput.type === 'password') {
                            // Show raw characters
                            passwordInput.type = 'text';
                            
                            // Toggle matching states
                            eyeIcon.style.display = 'block';
                            eyeOffIcon.style.display = 'none';
                        } else {
                            // Mask characters back to hidden dots
                            passwordInput.type = 'password';
                            
                            // Toggle matching states
                            eyeIcon.style.display = 'none';
                            eyeOffIcon.style.display = 'block';
                        }
                    });
                });
            </script>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
                
                <a class="forgot-password" href="{{ route('client.register') }}">
                    Need an account? Register
                </a>
            </div>

            <button type="submit" class="btn-submit" style="background-color: #3490dc;">
                Log In
            </button>
        </form>
    </div>

</body>
</html>