<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome - Client Registration</title>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

    <div class="login-container register-container">
        <div class="login-header">
            <h2>Create Client Account</h2>
            <p>Register your preferences with DreamHome today</p>
        </div>

        <div class="stepper">
            <div class="step-indicator active" id="step-dot-1">1</div>
            <div class="step-indicator" id="step-dot-2">2</div>
        </div>

        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('client.register.submit') }}" id="multi-step-form">
        @csrf   
            <div class="form-step active" id="step-1">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="John">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Doe">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="johndoe@email.com">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required placeholder="••••••••">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••">
                    </div>
                </div>

                <div class="form-options" style="justify-content: flex-end; margin-top: 10px;">
                    <a class="forgot-password" href="{{ route('client.login') }}">
                        Already have an account? Sign in
                    </a>
                </div>

                <button type="button" class="btn-submit" id="next-btn" style="background-color: #0891b2; margin-top: 15px;">
                    Next &rarr;
                </button>
            </div>


            <div class="form-step" id="step-2">
                <div class="form-group">
                    <label for="address">Mailing Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" required placeholder="Street No, City, Province">
                </div>

                <div class="form-group">
                    <label for="telephone_no">Telephone No</label>
                    <input type="text" id="telephone_no" name="telephone_no" value="{{ old('telephone_no') }}" required placeholder="e.g., 09123456789">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="max_rent">Max Monthly Rent</label>
                        <input type="text" id="max_rent" name="max_rent" value="{{ old('max_rent') }}" required placeholder="e.g., 15000">
                    </div>
                    <div class="form-group">
                        <label for="prefer_type">Preferred Layout</label>
                        <select id="prefer_type" name="prefer_type" required>
                            <option value="" disabled selected>Select option...</option>
                            <option value="Flat" {{ old('prefer_type') == 'Flat' ? 'selected' : '' }}>Flat</option>
                            <option value="Studio" {{ old('prefer_type') == 'Studio' ? 'selected' : '' }}>Studio</option>
                            <option value="Apartment" {{ old('prefer_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="Condo" {{ old('prefer_type') == 'Condo' ? 'selected' : '' }}>Condo</option>
                            <option value="House" {{ old('prefer_type') == 'House' ? 'selected' : '' }}>House</option>
                        </select>
                    </div>
                </div>

                <div class="btn-group" style="margin-top: 25px;">
                    <button type="button" class="btn-secondary" id="back-btn">&larr; Back</button>
                    <button type="submit" class="btn-submit" style="background-color: #3490dc; margin: 0;">Register Account</button>
                </div>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const step1 = document.getElementById('step-1');
            const step2 = document.getElementById('step-2');
            const nextBtn = document.getElementById('next-btn');
            const backBtn = document.getElementById('back-btn');
            const dot1 = document.getElementById('step-dot-1');
            const dot2 = document.getElementById('step-dot-2');

            // Handle Next Transition Button Click
            nextBtn.addEventListener('click', function () {
                // Find all required fields strictly within the active Step 1 block
                const inputs = step1.querySelectorAll('input[required]');
                let allValid = true;

                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.reportValidity(); // Alerts native browser tooltip if field is blank
                        allValid = false;
                    }
                });

                // If Step 1 matches rules, animate to step 2 slots
                if (allValid) {
                    step1.classList.remove('active');
                    step2.classList.add('active');
                    
                    dot1.classList.add('completed');
                    dot1.classList.remove('active');
                    dot2.classList.add('active');
                }
            });

            backBtn.addEventListener('click', function () {
                step2.classList.remove('active');
                step1.classList.add('active');
                
                dot1.classList.add('active');
                dot1.classList.remove('completed');
                dot2.classList.remove('active');
            });
        });
    </script>

</body>
</html>