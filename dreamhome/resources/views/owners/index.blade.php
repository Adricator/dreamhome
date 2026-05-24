<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owners - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owners.css') }}">
</head>
<body>

    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ route('dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}" >Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
                <a href="{{ route('properties.index') }}">Properties</a>
                <a href="{{ route('owners.index') }}" class="active">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}" >Clients</a>
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
    <main class="od-dir-wrapper">
        @if (session('success'))
            <div class="alert-success-toast" style="background-color: rgba(34, 197, 94, 0.1); border: 1px solid #22c55e; color: #22c55e; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-danger-toast" style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; color: #ef4444; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                <strong>Action Blocked:</strong> {{ session('error') }}
            </div>
        @endif
        <div class="od-dir-top-bar">
            
            <div class="od-dir-title-area">
                <h1 class="od-dir-main-heading">owner directory</h1>
                <form action="{{ route('owners.index') }}" method="GET" class="od-dir-search-form">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search owners..." class="od-dir-search-field">
                    <button type="submit" class="od-dir-search-btn">Search</button>
                </form>
            </div>

            <a href="{{ route('owners.create') }}" class="od-dir-action-register">
                + Register New Owner
            </a>
        </div>

        <div class="od-dir-cards-matrix">
            @foreach($owners as $owner)
            <div class="od-dir-profile-card">
                
                <div class="od-dir-badge-row">
                    <span class="od-dir-id-token">
                        {{ $owner->owner_id }}
                    </span>
                </div>

                <div class="od-dir-identity-block">
                    <h3 class="od-dir-full-name">{{ $owner->first_name }} {{ $owner->last_name }}</h3>
                    <p class="od-dir-role-tag">Property Owner</p>
                </div>

                <div class="od-dir-details-list">
                    <div class="od-dir-info-row">
                        <span class="od-dir-label text-uppercase">Phone</span>
                        <span class="od-dir-value">{{ $owner->telephone_no }}</span>
                    </div>
                    <div class="od-dir-info-row">
                        <span class="od-dir-label text-uppercase">Email</span>
                        <span class="od-dir-value od-dir-truncate-email">{{ $owner->email }}</span>
                    </div>
                </div>

                <div class="od-dir-action-links">
                    <a href="{{ route('owners.show', $owner) }}" class="od-dir-btn-link od-dir-link-cyan">View Details</a>
                    <a href="{{ route('owners.edit', $owner) }}" class="od-dir-btn-link od-dir-link-muted">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>
