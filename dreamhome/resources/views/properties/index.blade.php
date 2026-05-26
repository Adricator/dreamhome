<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Properties - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/properties.css') }}">
</head>
<body>

    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ url('/dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}" >Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
                <a href="{{ route('properties.index') }}" class="active">Properties</a>
                <a href="{{ route('owners.index') }}">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}">Clients</a>
                <a href="{{ url('/viewings') }}">Viewings</a>
                <a href="{{ url('/leases') }}">Leases</a>
            </div>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-link-btn">
                Log Out
            </button>
        </form>
    </header>

    <main class="p-dir-container">
    
    <div class="p-dir-topbar">
        <div class="p-dir-meta-left">
            <h1 class="p-dir-main-title">property directory</h1>
            
            <form action="{{ route('properties.index') }}" method="GET" class="p-dir-filter-form" id="propertyFilterForm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by street or ID..." class="p-dir-search-input">
                <button type="submit" class="p-dir-btn-filter">Search</button>
                
                <select name="type" class="p-dir-select-menu" onchange="this.form.submit()">
                    <option value="">All Types</option>
                    <option value="house" @selected(request('type') == 'house')>House</option>
                    <option value="apartment" @selected(request('type') == 'apartment')>Apartment</option>
                    <option value="condo" @selected(request('type') == 'condo')>Condo</option>
                    <option value="flat" @selected(request('type') == 'flat')>Flat</option>
                    <option value="studio" @selected(request('type') == 'studio')>Studio</option>
                </select>

                <select name="status" class="p-dir-select-menu" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="available" @selected(request('status') == 'available')>Available</option>
                    <option value="rented" @selected(request('status') == 'rented')>Rented</option>
                    <option value="maintenance" @selected(request('status') == 'maintenance')>Maintenance</option>
                </select>
            </form>
        </div>
        
        <a href="{{ route('properties.create') }}" class="p-dir-btn-add">
            + Add Property
        </a>
    </div>

    <div class="p-dir-card-grid">
        @foreach($properties as $property)
        <div class="p-dir-glass-card">
            
            <div class="p-dir-card-header">
                <span class="p-dir-badge-status">
                    {{ $property->status }} | {{ $property->type }}
                </span>
                <h3 class="p-dir-price-tag">
                    ₱{{ number_format($property->monthly_rent) }}<span class="p-dir-price-period">/mo</span>
                </h3>
            </div>

            <div class="p-dir-location-block">
                <p class="p-dir-text-id">Property ID: {{ $property->property_id }}</p>
                <p class="p-dir-text-street">{{ $property->street }}</p>
                <p class="p-dir-text-city">{{ $property->city }}, {{ $property->postcode }}</p>
            </div>

            <div class="p-dir-specs-matrix">
                <div class="p-dir-matrix-cell"><span class="p-dir-cell-label">Rooms:</span> {{ $property->rooms }}</div>
                <div class="p-dir-matrix-cell"><span class="p-dir-cell-label">Area:</span> {{ $property->area }}</div>
                <div class="p-dir-matrix-cell"><span class="p-dir-cell-label">Owner ID:</span> {{ $property->owner_id }}</div>
                <div class="p-dir-matrix-cell"><span class="p-dir-cell-label">Staff | Branch ID:</span> {{ $property->staff_id }} | {{ $property->branch_id }}</div>
            </div>

            <div class="p-dir-card-actions">
                <div class="p-dir-links-group">
                    <a href="{{ route('properties.show', $property->property_id) }}" class="p-dir-action-link p-dir-link-cyan">View</a>
                    <a href="{{ route('properties.edit', $property->property_id) }}" class="p-dir-action-link p-dir-link-white">Edit</a>
                </div>
                
                <form action="{{ route('properties.destroy', $property->property_id) }}" method="POST" onsubmit="return confirm('Delete this property?');" class="p-dir-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-dir-btn-delete">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</main>
    
</body>
</html>