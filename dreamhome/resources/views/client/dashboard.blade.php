<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome - Client Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c_dashboard.css') }}">
</head>
<body>

    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h1>DreamHome</h1>
                <span>Client Portal</span>
            </div>
            
            <nav class="sidebar-menu">
                <a href="{{ route('client.dashboard') }}" class="menu-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    Dashboard
                </a>
                
                <a href="{{ route('client.properties.index') }}" class="menu-item {{ request()->routeIs('client.properties.*') ? 'active' : '' }}">
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
                    <h2>Welcome back, {{ auth()->guard('client')->user()->first_name }}!</h2>
                    <p>Client ID: <strong class="text-cyan">{{ auth()->guard('client')->user()->client_id }}</strong></p>
                </div>
                <div class="avatar-box">
                    <span>{{ substr(auth()->guard('client')->user()->first_name, 0, 1) }}{{ substr(auth()->guard('client')->user()->last_name, 0, 1) }}</span>
                </div>
            </header>

            <section class="metrics-grid">
                <div class="metric-card">
                    <h3>Preferred Type</h3>
                    <p class="metric-value">{{ strtoupper(auth()->guard('client')->user()->prefer_type ?? 'None Set') }}</p>
                </div>
                <div class="metric-card">
                    <h3>Max Budget limit</h3>
                    <p class="metric-value">₱{{ number_format(auth()->guard('client')->user()->max_rent, 2) }}</p>
                </div>
                <div class="metric-card">
                    <h3>Active Lease Records</h3>
                    <p class="metric-value">{{ auth()->guard('client')->user()->leases ? auth()->guard('client')->user()->leases()->count() : 0 }}</p>
                </div>
            </section>

            <section class="dashboard-details">
                <div class="details-card">
                    <div class="card-title-bar" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <h3>Profile Registration Details</h3>
                        <a href="{{ route('client.profile.edit') }}" class="btn-edit-profile" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; background: #00e5ff; color: #0f172a; text-decoration: none; font-weight: 600; font-size: 0.85rem; border-radius: 4px; transition: opacity 0.2s;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"></path></svg>
                            Edit Profile
                        </a>
                    </div>
                    <div class="profile-info-list">
                        <div class="info-row">
                            <span class="info-label">Full Name:</span>
                            <span class="info-data">{{ auth()->guard('client')->user()->first_name }} {{ auth()->guard('client')->user()->last_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Registered Email:</span>
                            <span class="info-data">{{ auth()->guard('client')->user()->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Telephone Number:</span>
                            <span class="info-data">{{ auth()->guard('client')->user()->telephone_no }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Current Address:</span>
                            <span class="info-data">{{ auth()->guard('client')->user()->address }}</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>
</html>