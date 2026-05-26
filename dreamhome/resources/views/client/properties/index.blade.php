<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome - Browse Properties</title>
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
            <header class="content-header">
                <div class="user-greeting">
                    <h2>Browse Properties</h2>
                    <p>Explore custom matches tailored for you or discover our full inventory collection.</p>
                </div>
                <div class="avatar-box">
                    <span>{{ substr($client->first_name, 0, 1) }}{{ substr($client->last_name, 0, 1) }}</span>
                </div>
            </header>

            {{-- SECTION 1: MATCHED PROPERTIES --}}
            <section class="properties-section">
                <div class="section-title-container" style="margin-bottom: 1.5rem;">
                    <h3 style="font-family: 'Montserrat', sans-serif; font-size: 1.4rem; color: #ffffff; font-weight: 600;">Matched for You</h3>
                    <p style="font-size: 0.875rem; color: #64748b;">
                        Showing spaces matching your preference for <strong>{{ ucfirst($client->prefer_type ?? 'Any Layout') }}s</strong> under <strong>₱{{ number_format($client->max_rent ?? 0, 2) }}</strong>
                    </p>
                </div>

                @if($matchedProperties->isEmpty())
                    <div class="empty-state-card" style="background: #0f172a; border: 1px dashed #334155; border-radius: 12px; padding: 2rem; text-align: center; margin-bottom: 3rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 0.5rem;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <p style="color: #64748b; font-size: 0.95rem;">No exact properties meet your preferred criteria right now.</p>
                    </div>
                @else
                    <div class="properties-grid" style="margin-bottom: 3rem;">
                        @foreach($matchedProperties as $property)
                            <div class="property-card" style="border: 2px solid #3b82f6;">
                                <div class="property-badge status-{{ strtolower($property->status) }}">
                                    {{ ucfirst($property->status) }}
                                </div>
                                
                                <div class="property-body">
                                    <span class="property-id-tag">{{ $property->property_id }} <span style="color: #3b82f6; font-weight: 600; font-size: 0.75rem; margin-left: 0.5rem;">★ Best Match</span></span>
                                    <h3 class="property-address">{{ $property->street }}, {{ $property->area }}</h3>
                                    <p class="property-location">{{ $property->city }}, {{ $property->postcode }}</p>
                                    
                                    <div class="property-specs">

                                        <div class="spec-pill">
                                            {{-- Display Type here instead --}}
                                            <span>{{ ucfirst($property->type) }}</span>
                                        </div>
                                        <div class="spec-pill">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                                            <span>{{ $property->rooms }} {{ Str::plural('Room', $property->rooms) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="property-footer">
                                    <div class="property-rent-box">
                                        <span class="rent-label">Monthly Rent</span>
                                        <span class="rent-value">₱{{ number_format($property->monthly_rent, 2) }}</span>
                                    </div>
                                    <a href="{{ route('client.properties.show', $property->property_id) }}" class="btn-action-view">
                                        Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <hr style="border: 0; height: 1px; background: #334155; margin: 3rem 0;">

            {{-- SECTION 2: ALL PROPERTIES --}}
            <section class="properties-section">
                <div class="section-title-container" style="margin-bottom: 1.5rem;">
                    <h3 style="font-family: 'Montserrat', sans-serif; font-size: 1.4rem; color: #ffffff; font-weight: 600;">All Properties</h3>
                    <p style="font-size: 0.875rem; color: #64748b;">Browse through our comprehensive real estate portfolio inventory</p>
                </div>

                @if($allProperties->isEmpty())
                    <div class="empty-state-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                        <p>No available spaces match our catalog inventory at this moment.</p>
                    </div>
                @else
                    <div class="properties-grid">
                        @foreach($allProperties as $property)
                            <div class="property-card">
                            <div class="property-badge status-{{ strtolower($property->status) }}">
                                {{ ucfirst($property->status) }}
                            </div>
                                
                                <div class="property-body">
                                    <span class="property-id-tag">{{ $property->property_id }}</span>
                                    <h3 class="property-address">{{ $property->street }}, {{ $property->area }}</h3>
                                    <p class="property-location">{{ $property->city }}, {{ $property->postcode }}</p>
                                    
                                    <div class="property-specs">
                                        <div class="spec-pill">
                                            {{-- Display Type here instead --}}
                                            <span>{{ ucfirst($property->type) }}</span>
                                        </div>
                                        <div class="spec-pill">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                                            <span>{{ $property->rooms }} {{ Str::plural('Room', $property->rooms) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="property-footer">
                                    <div class="property-rent-box">
                                        <span class="rent-label">Monthly Rent</span>
                                        <span class="rent-value">₱{{ number_format($property->monthly_rent, 2) }}</span>
                                    </div>
                                    <a href="{{ route('client.properties.show', $property->property_id) }}" class="btn-action-view">
                                        Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>
        </main>
    </div>
</body>
</html>