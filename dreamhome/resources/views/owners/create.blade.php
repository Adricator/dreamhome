<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owners - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owners.css') }}">
</head>
<body>

<div class="or-reg-form-container">
    <h2 class="or-reg-form-title">Register New Owner</h2>
    
    <form action="{{ route('owners.store') }}" method="POST" class="or-reg-form-element">
        @csrf
        
        <div class="or-reg-form-grid-2">
            <div class="or-reg-input-group">
                <label class="or-reg-field-label">First Name</label>
                <input type="text" name="first_name" class="or-reg-input-field">
            </div>
            <div class="or-reg-input-group">
                <label class="or-reg-field-label">Last Name</label>
                <input type="text" name="last_name" class="or-reg-input-field">
            </div>
        </div>
        <div class="or-reg-input-group">
            <label class="or-reg-field-label">Address</label>
            <textarea name="address" rows="3" class="or-reg-textarea-field"></textarea>
        </div>

        <div class="or-reg-form-grid-2">
            <div class="or-reg-input-group">
                <label class="or-reg-field-label">Telephone</label>
                <input type="text" name="telephone_no" class="or-reg-input-field">
            </div>
            <div class="or-reg-input-group">
                <label class="or-reg-field-label">Email Address</label>
                <input type="email" name="email" class="or-reg-input-field">
            </div>
        </div>

        <div class="or-reg-form-actions">
            <button type="submit" class="or-reg-btn-submit">Save Owner</button>
            <a href="{{ route('owners.index') }}" class="or-reg-btn-cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>