<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome - View Property</title>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c_properties.css') }}">
</head>
<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h1>DreamHome</h1>
                <span>Client Portal</span>
            </div>
            
            <nav class="sidebar-menu">
                <a href="{{ route('client.dashboard') }}" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    Dashboard
                </a>
                <a href="{{ route('client.properties.index') }}" class="menu-item active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    Properties
                </a>
                <a href="#" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    My Leases
                </a>
                <a href="#" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    Viewings Schedule
                </a>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('client.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
    <div class="property-details-wrapper">
        {{-- Header Section --}}
        <header class="details-header">
            <a href="{{ route('client.properties.index') }}" class="back-nav">&larr; Back to Listings</a>
            <div class="header-content">
                <h2 style="color: #0891b2; font-family: 'Montserrat', sans-serif;">{{ $property->property_id }}</h2>
                {{-- Consistent badge class --}}
                <span class="status-badge status-{{ strtolower($property->status) }}">
                    {{ ucfirst($property->status) }}
                </span>
            </div>
        </header>

        <div class="details-grid">
            <div class="main-info-card">
                <h1 class="address-title">{{ $property->street }}, {{ $property->area }}</h1>
                <p class="location-text">{{ $property->city }}, {{ $property->postcode }}</p>
                
                <div class="specs-grid">
                    <div class="spec-box">
                        <span class="label">Property Type</span>
                        <p class="value">{{ ucfirst($property->type) }}</p>
                    </div>
                    <div class="spec-box">
                        <span class="label">Rooms</span>
                        <p class="value">{{ $property->rooms }} {{ Str::plural('Room', $property->rooms) }}</p>
                    </div>
                    {{-- Added class 'rent-spec-box' for alignment --}}
                    <div class="spec-box rent-spec-box">
                        <span class="label">Monthly Rent</span>
                        <p class="value rent-highlight">₱{{ number_format($property->monthly_rent, 2) }}</p>
                    </div>
                </div>
            </div>

            <aside class="management-card">
                <h3>Management Info</h3>
                <div class="contact-list">
                    <div class="contact-item">
                        <span class="label">Owner</span>
                        <p>{{ $property->owner->first_name }} {{ $property->owner->last_name }}</p>
                    </div>
                    <div class="contact-item">
                        <span class="label">Assigned Staff</span>
                        <p>{{ $property->staff ? $property->staff->first_name . ' ' . $property->staff->last_name : 'No staff assigned' }}</p>
                    </div>
                </div>
                <button class="request-btn">Request Viewing</button>
            </aside>
        </div>
    </div>
</main>
</body>
</html>