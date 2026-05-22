<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Branch - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/branches.css') }}">
</head>
<body style="background-color: #0a1518; ">

<main class="b-reg-container">
    <div class="b-reg-card b-reg-cyan-glow">
        
        <div class="b-reg-header">
            <h1 class="b-reg-title">register new branch</h1>
            <p class="b-reg-subtitle">Establishing a new physical location for the directory</p>
        </div>

        <form action="{{ route('branches.store') }}" method="POST" class="b-reg-form">
            @csrf
            
            <div class="b-reg-grid-dual">
                
                <div class="b-reg-fieldset">
                    <label class="b-reg-group-label">Location Details</label>
                    
                    <div class="b-reg-field-wrapper">
                        <span class="b-reg-input-caption">Street Address</span>
                        <textarea name="street" rows="2" placeholder="e.g., 163 Main St" class="b-reg-control b-reg-textarea">{{ old('street') }}</textarea>
                    </div>

                    <div class="b-reg-grid-inner">
                        <div class="b-reg-field-wrapper">
                            <span class="b-reg-input-caption">City</span>
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="b-reg-control">
                        </div>
                        <div class="b-reg-field-wrapper">
                            <span class="b-reg-input-caption">Postcode</span>
                            <input type="text" name="postcode" value="{{ old('postcode') }}" placeholder="Postcode" class="b-reg-control">
                        </div>
                    </div>
                </div>

                <div class="b-reg-fieldset">
                    <label class="b-reg-group-label">Contact & Region</label>
                    
                    <div class="b-reg-field-wrapper">
                        <span class="b-reg-input-caption">Region / Area</span>
                        <input type="text" name="area" value="{{ old('area') }}" placeholder="e.g., London" class="b-reg-control">
                    </div>

                    <div class="b-reg-grid-inner">
                        <div class="b-reg-field-wrapper">
                            <span class="b-reg-input-caption">Telephone</span>
                            <input type="text" name="telephone_no" value="{{ old('telephone_no') }}" placeholder="Phone No." class="b-reg-control">
                        </div>
                        <div class="b-reg-field-wrapper">
                            <span class="b-reg-input-caption">Fax Number</span>
                            <input type="text" name="fax_no" value="{{ old('fax_no') }}" placeholder="Fax No." class="b-reg-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="b-reg-divider-section">
                <div class="b-reg-grid-bottom">
                    <div class="b-reg-field-wrapper">
                        <label class="b-reg-group-label b-reg-mb-space">Branch Registration ID</label>
                        <input type="text" name="branch_id" value="{{ old('branch_id') }}" placeholder="e.g., B005" class="b-reg-control">
                    </div>
                </div>
            </div>

            <div class="b-reg-actions-row">
                <button type="submit" class="b-reg-btn b-reg-btn-submit">
                    Confirm Registration
                </button>
                <a href="{{ route('branches.index') }}" class="b-reg-btn b-reg-btn-return">
                    Back to List
                </a>
            </div>
        </form>
    </div>
</main>
</body>
</html>