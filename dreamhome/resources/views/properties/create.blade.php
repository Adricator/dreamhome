<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Property - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/properties.css') }}">
</head>
<body style="background-color: #0a1518;">
<main class="p-crt-container">
    <div class="p-crt-glass-card">
        
        <div class="p-crt-header">
            <h1 class="p-crt-main-title">add new property</h1>
            <p class="p-crt-sub-title">Enter the details to list a new estate</p>
        </div>

        <form action="{{ route('properties.store') }}" method="POST" class="p-crt-form-layout">
            @csrf
            
            <div class="p-crt-grid-split">
                
                <div class="p-crt-field-stack">
                    <label class="p-crt-field-label">Location</label>
                    <input type="text" name="street" placeholder="Street Address" class="p-crt-input-text" required>
                    <div class="p-crt-grid-dual">
                        <input type="text" name="city" placeholder="City" class="p-crt-input-text">
                        <input type="text" name="postcode" placeholder="Postcode" class="p-crt-input-text">
                    </div>
                </div>

                <div class="p-crt-field-stack">
                    <label class="p-crt-field-label">Specifications</label>
                    <div class="p-crt-grid-dual">
                        <select name="type" class="p-crt-select-menu">
                            <option value="house">House</option>
                            <option value="flat">Flat</option>
                            <option value="bungalow">Bungalow</option>
                        </select>
                        <input type="number" name="rooms" placeholder="Rooms" class="p-crt-input-text">
                    </div>
                    <div class="p-crt-grid-dual">
                        <input type="number" name="monthly_rent" placeholder="Rent (₱)" class="p-crt-input-text">
                        <input type="text" name="area" placeholder="Area" class="p-crt-input-text">
                    </div>
                </div>
            </div>

            <div class="p-crt-management-section">
                <label class="p-crt-field-label p-crt-label-block">Management Assignment</label>
                <div class="p-crt-grid-triad">
                <select name="owner_id" class="p-crt-input-text">
                    <option value="">-- Choose an Owner --</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner->owner_id }}" 
                            {{ old('owner_id', $selectedOwnerId) == $owner->owner_id ? 'selected' : '' }}>
                            {{ $owner->owner_id }} - {{ $owner->first_name }} {{ $owner->last_name }}
                        </option>
                    @endforeach
                </select>
                    <input type="text" name="staff_id" placeholder="Staff ID" class="p-crt-input-text">
                    <input type="text" name="branch_id" placeholder="Branch ID" class="p-crt-input-text">
                </div>
            </div>

            <div class="p-crt-action-deck">
                <button type="submit" class="p-crt-btn p-crt-btn-submit">
                    Publish Listing
                </button>
                <a href="{{ route('properties.index') }}" class="p-crt-btn p-crt-btn-cancel">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>
</body>
</html>