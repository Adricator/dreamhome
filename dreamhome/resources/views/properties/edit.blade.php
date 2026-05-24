<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Owner - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/properties.css') }}">
</head>
<body>
<main class="p-edt-container">
    <div class="p-edt-glass-card">
        
        <div class="p-edt-header">
            <div>
                <h1 class="p-edt-main-title">edit property listing</h1>
                <p class="p-edt-sub-title">Modifying Property: {{ $property->property_id }}</p>
            </div>

            @if(isset($property))
            <span class="p-id-pill">
                ID: {{ $property->property_id }}
            </span>
            @endif
        </div>

        <form action="{{ route('properties.update', $property->property_id) }}" method="POST" class="p-edt-form-layout">
            @csrf
            @method('PUT')
            
            <div class="p-edt-grid-split">

                
                
                <div class="p-edt-field-stack">
                    <label class="p-edt-field-label">Location Details</label>
                    <div class="p-edt-input-group">
                        <span class="p-edt-input-label">Street</span>
                        <input type="text" name="street" value="{{ old('street', $property->street) }}" placeholder="Street Address" class="p-edt-input-text" required>
                    </div>
                        <div class="p-edt-grid-dual">
                            <div class="p-edt-input-group">
                                <span class="p-edt-input-label">City</span>
                                <input type="text" name="city" value="{{ old('city', $property->city) }}" placeholder="City" class="p-edt-input-text">
                            </div>
                            <div class="p-edt-input-group">
                                <span class="p-edt-input-label">Postcode</span>
                                <input type="text" name="postcode" value="{{ old('postcode', $property->postcode) }}" placeholder="Postcode" class="p-edt-input-text">
                            </div>
                        </div>
                </div>

                <div class="p-edt-field-stack">
                    <label class="p-edt-field-label">Specifications & Status</label>
                    <div class="p-edt-grid-dual">
                        <div class="p-edt-input-group">
                            <span class="p-edt-input-label">type</span>
                            <select name="type" class="p-edt-select-menu">
                                <option value="house" @selected(old('type', $property->type) == 'house')>House</option>
                                <option value="flat" @selected(old('type', $property->type) == 'flat')>Flat</option>
                                <option value="bungalow" @selected(old('type', $property->type) == 'bungalow')>Bungalow</option>
                                <option value="apartment" @selected(old('type', $property->type) == 'apartment')>Apartment</option>
                                <option value="condo" @selected(old('type', $property->type) == 'condo')>Condo</option>
                                <option value="studio" @selected(old('type', $property->type) == 'studio')>Studio</option>
                            </select>
                        </div>
                        <div class="p-edt-input-group">
                            <span class="p-edt-input-label">status</span>
                            <select name="status" class="p-edt-select-menu">
                                <option value="available" @selected(old('status', $property->status) == 'available')>Available</option>
                                <option value="rented" @selected(old('status', $property->status) == 'rented')>Rented</option>
                                <option value="maintenance" @selected(old('status', $property->status) == 'maintenance')>Maintenance</option>
                                <option value="reserved" @selected(old('status', $property->status) == 'reserved')>Reserved</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-edt-grid-dual">
                        <div class="p-edt-input-group">
                            <span class="p-edt-input-label">rooms</span>
                            <input type="number" name="rooms" value="{{ old('rooms', $property->rooms) }}" placeholder="Rooms" class="p-edt-input-text">
                        </div>
                        <div class="p-edt-input-group">
                            <span class="p-edt-input-label">area</span>
                            <input type="text" name="area" value="{{ old('area', $property->area) }}" placeholder="Area" class="p-edt-input-text">
                        </div>
                    </div>
                    <div class="p-edt-input-group">
                        <span class="p-edt-input-label">monthly rent</span>
                        <input type="number" name="monthly_rent" value="{{ old('monthly_rent', $property->monthly_rent) }}" placeholder="Rent (₱)" class="p-edt-input-text">
                    </div>
                </div>
            </div>

            <div class="p-edt-management-section">
                <label class="p-edt-field-label p-edt-label-block">Management Assignment</label>
                <div class="p-edt-grid-triad">
                    <div class="p-edt-input-group">
                        <span class="p-edt-input-label">owner</span>
                        <input type="text" name="owner_id" value="{{ old('owner_id', $property->owner_id) }}" placeholder="Owner ID" class="p-edt-input-text">
                    </div>
                    <div class="p-edt-input-group">
                        <span class="p-edt-input-label">staff assigned</span>
                        <input type="text" name="staff_id" value="{{ old('staff_id', $property->staff_id) }}" placeholder="Staff ID" class="p-edt-input-text">
                    </div>
                    <div class="p-edt-input-group">
                        <span class="p-edt-input-label">branch</span>
                        <input type="text" name="branch_id" value="{{ old('branch_id', $property->branch_id) }}" placeholder="Branch ID" class="p-edt-input-text">
                    </div>
                </div>
            </div>

            <div class="p-edt-action-deck">
                <button type="submit" class="p-edt-btn p-edt-btn-submit">
                    Save Changes
                </button>
                <a href="{{ route('properties.show', $property->property_id) }}" class="p-edt-btn p-edt-btn-cancel">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>
</body>
</html>