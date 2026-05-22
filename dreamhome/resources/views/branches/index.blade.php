<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Branches - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/branches.css') }}">
    </head>
<body>
    
    <header class="navbar-container">
        <nav class="navbar">
            <div class="nav-spacer"></div>
            <div class="navbar-links">
                <a href="{{ route('dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}" class="active">Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
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

    <main class="branches-main">
        <div class="branches-header">
            <div>
                <h1 class="branches-title">branch directory</h1>

                <form action="{{ route('branches.index') }}" method="GET" class="branch-search-form">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by city or ID..."
                        class="branch-search-input">

                    <button type="submit" class="branch-search-button">
                        Search
                    </button>
                </form>
            </div>

            <a href="{{ route('branches.create') }}" class="new-branch-button">
                + New Branch
            </a>
        </div>

        <div class="branches-grid">
            @foreach($branches as $branch)

            <div class="branch-card">

                <div class="branch-card-top">
                    <span class="branch-id-badge">
                        Branch ID: {{ $branch->branch_id }}
                    </span>
                </div>

                <div class="branch-info">
                    <h3 class="branch-city">{{ $branch->city }}</h3>

                    <p class="branch-area">
                        {{ $branch->area }}
                    </p>
                </div>

                <div class="branch-details">

                    <div>
                        <span class="branch-label">
                            Street Address:
                        </span>

                        <span class="branch-value">
                            {{ $branch->street }}
                        </span>
                    </div>

                    <div>
                        <span class="branch-label">
                            Contact Number:
                        </span>

                        <span class="branch-value">
                            {{ $branch->telephone_no }}
                        </span>
                    </div>
                    <div class="branch-index-manager">

                        <span class="branch-manager-label">
                            Manager:
                        </span>

                        @if($branch->manager)

                            <div class="branch-manager-info">

                                <span class="branch-manager-name">
                                    {{ $branch->manager->first_name }}
                                    {{ $branch->manager->last_name }}
                                </span>

                                <span class="branch-manager-id">
                                    {{ $branch->manager->staff_id }}
                                </span>

                            </div>

                        @else

                            <span class="branch-manager-empty">
                                No manager assigned
                            </span>

                        @endif

                    </div>
                </div>
                
                <div class="branch-actions">

                    <div class="branch-links">
                        <a href="{{ route('branches.show', $branch->branch_id) }}" class="view-link">
                            View Details
                        </a>

                        <a href="{{ route('branches.edit', $branch->branch_id) }}" class="edit-link">
                            Edit
                        </a>
                    </div>

                    <form action="{{ route('branches.destroy', $branch->branch_id) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this branch?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete-link">
                            Delete
                        </button>
                    </form>
                </div>

            </div>

            @endforeach
        </div>
    </main>
</body>
</html>