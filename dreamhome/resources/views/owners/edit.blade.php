<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Owner - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owners.css') }}">
</head>
<body class="text-white min-h-screen bg-[#0a0a0a]">
<main class="oe-mod-main-layout">
    <div class="oe-mod-glass-card">
        
        <div class="oe-mod-header-row">
            <div class="oe-mod-title-group">
                <h1 class="oe-mod-heading">edit owner</h1>
                <p class="oe-mod-subtitle">
                    Modifying Profile: {{ $owner->owner_id }}
                </p>
            </div>
            <span class="oe-mod-type-badge">
                {{ $owner->owner_id }}
            </span>
        </div>

        <form action="{{ route('owners.update', $owner->owner_id) }}" method="POST" class="oe-mod-form-element">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="owner_id" value="{{ $owner->owner_id }}">

            <div class="oe-mod-split-grid">
                
                <div class="oe-mod-pane-column">
                    <label class="oe-mod-section-title">Personal Information</label>
                    
                    <div class="oe-mod-field-row-2">
                        <div class="oe-mod-input-wrapper">
                            <span class="oe-mod-field-hint">First Name</span>
                            <input type="text" name="first_name" value="{{ $owner->first_name }}" class="oe-mod-text-field">
                        </div>
                        <div class="oe-mod-input-wrapper">
                            <span class="oe-mod-field-hint">Last Name</span>
                            <input type="text" name="last_name" value="{{ $owner->last_name }}" class="oe-mod-text-field">
                        </div>
                    </div>
                    
                    <div class="oe-mod-input-wrapper">
                        <span class="oe-mod-field-hint">Street Address</span>
                        <input type="text" name="address" value="{{ $owner->address }}" class="oe-mod-text-field">
                    </div>
                </div>

                <div class="oe-mod-pane-column">
                    <label class="oe-mod-section-title">Contact Details</label>
                    
                    <div class="oe-mod-input-wrapper">
                        <span class="oe-mod-field-hint">Phone Number</span>
                        <input type="text" name="telephone_no" value="{{ $owner->telephone_no }}" class="oe-mod-text-field">
                    </div>
                    
                    <div class="oe-mod-input-wrapper">
                        <span class="oe-mod-field-hint">Email Address</span>
                        <input type="email" name="email" value="{{ $owner->email }}" class="oe-mod-text-field">
                    </div>
                </div>
            </div>

            <div class="oe-mod-actions-footer">
                <div class="oe-mod-btn-group">
                    <button type="submit" class="oe-mod-btn-submit">
                        Update Owner Profile
                    </button>
                    <a href="{{ route('owners.index') }}" class="oe-mod-btn-cancel">
                        Cancel Changes
                    </a>
                </div>
            </div>
        </form> 
    </div>
</main>
</body>
</html>