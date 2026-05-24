<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
</head>
<body style="color:white;"> <!-- Added a dark bg for the glass effect -->
    
    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ url('/dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}" >Branches</a>
                <a href="{{ route('staff.index') }}" class="active">Staff</a>
                <a href="{{ route('properties.index') }}">Properties</a>
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

    <main class="staff-main">
        <div class="staff-header">
            <div class="staff-header-left">
                <h1 class="staff-title">staff directory</h1>
                <form action="{{ route('staff.index') }}" method="GET" class="staff-search-form">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search staff..."
                        class="staff-search-input">
                    <button type="submit" class="staff-search-button">
                        Search
                    </button>
                </form>
            </div>
            <a href="{{ route('staff.create') }}" class="staff-create-button">
                + New Staff Member
            </a>
        </div>

        <div class="staff-grid">
            @foreach($staffMembers as $person)
            <div class="staff-card">
                <div class="staff-card-top">
                    <span class="staff-id-badge">
                        {{ $person->staff_id }}
                    </span>
                </div>
                <div class="staff-info">
                    <h3 class="staff-name">
                        {{ $person->first_name }}
                        {{ $person->last_name }}
                    </h3>
                    <p class="staff-position">
                        {{ $person->position }}
                    </p>
                </div>

                <div class="staff-details">

                    <div class="staff-detail-row">
                        <span class="staff-detail-label">Salary</span>
                        <span class="staff-detail-value">₱{{ number_format($person->salary) }}</span>
                    </div>

                    <div class="staff-detail-row">
                        <span class="staff-detail-label">
                            @if(strtolower($person->position) === 'manager')
                                Managed Branch
                            @else
                                Branch
                            @endif
                        </span>
                        
                        <span class="staff-detail-value-hl">
                            {{ $person->branch_id }}
                        </span>
                    </div>

                    @if(in_array(strtolower($person->position), ['staff', 'secretary']))
                        <div class="staff-detail-row">
                            <span class="staff-detail-label">Supervisor</span>
                            <span class="staff-detail-value-hl">
                                {{ $person->supervised_by }}
                            </span>
                        </div>
                    @else
                        <div class="staff-detail-row">
                            <span class="staff-detail-label">Supervisor</span>
                            <span class="staff-detail-value">&mdash;</span>
                        </div>
                    @endif
                </div>

                <div class="staff-actions">

                    <a href="{{ route('staff.show', $person) }}" class="staff-view-link">
                        View Profile
                    </a>

                    <a href="{{ route('staff.edit', $person) }}" class="staff-edit-link">
                        Edit
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>