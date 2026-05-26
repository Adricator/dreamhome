<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clients - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
</head>
<body>
    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ url('/dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}" >Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
                <a href="{{ route('properties.index') }}">Properties</a>
                <a href="{{ route('owners.index') }}">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}" class="active">Clients</a>
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

    <main class="client-directory-scope cd-container">
        <div class="cd-header-block">
            <div>
                <h1 class="cd-main-title">client directory</h1>
                
                <form action="{{ url('/clients') }}" method="GET" class="cd-search-form">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search by name or ID..." 
                        class="cd-search-input"
                    >
                    <button type="submit" class="cd-btn-search">Search</button>
                </form>
            </div>

            <a href="{{ route('clients.create') }}" class="cd-btn-register">
                + Register Client
            </a>
        </div>

        <div class="cd-card-grid">
            @foreach($clients as $client)
            <div class="cd-client-card">
                
                <div class="cd-card-top">
                    <span class="cd-badge-id">
                        ID: {{ $client->client_id }}
                    </span>
                </div>

                <div class="cd-card-identity">
                    <h3 class="cd-client-name">{{ $client->first_name }} {{ $client->last_name }}</h3>
                    <p class="cd-preference-tag">{{ $client->prefer_type }} Preference</p>
                </div>

                <div class="cd-info-matrix">
                    <div class="cd-matrix-row">
                        <span class="cd-matrix-label">Telephone:</span> 
                        <span class="cd-matrix-value cd-normal-case">{{ $client->telephone_no }}</span>
                    </div>
                    <div class="cd-matrix-row">
                        <span class="cd-matrix-label">Email:</span> 
                        <span class="cd-matrix-value cd-normal-case cd-truncate">{{ $client->email }}</span>
                    </div>
                    <div class="cd-matrix-row">
                        <span class="cd-matrix-label">Max Budget:</span> 
                        <span class="cd-matrix-value cd-price-highlight">₱{{ number_format($client->max_rent, 0) }}</span>
                    </div>
                </div>

                <div class="cd-card-actions">
                    <div class="cd-action-group-left">
                        <a href="{{ route('clients.show', $client->client_id) }}" class="cd-link-details">View Details</a>
                        <a href="{{ route('clients.edit', $client->client_id) }}" class="cd-link-edit">Edit</a>
                    </div>

                    <form action="{{ route('clients.destroy', $client->client_id) }}" method="POST" onsubmit="return confirm('Archive this client record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cd-btn-delete">Delete</button>
                    </form>
                </div>
                
            </div>
            @endforeach
        </div>

    </main>
</body>
</html>