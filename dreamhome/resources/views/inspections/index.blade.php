<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inspections - Dream Home</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inspections.css') }}">
</head>

<body>

<header class="navbar-container">
    <nav class="navbar">
        <div class="navbar-links">
            <a href="{{ url('/dashboard') }}">Home</a>
            <a href="{{ route('branches.index') }}">Branches</a>
            <a href="{{ route('staff.index') }}">Staff</a>
            <a href="{{ route('properties.index') }}">Properties</a>
            <a href="{{ route('owners.index') }}">Owners</a>
            <a href="{{ route('inspections.index') }}" class="active">Inspections</a>
            <a href="{{ url('/clients') }}">Clients</a>
            <a href="{{ url('/viewings') }}">Viewings</a>
            <a href="{{ url('/leases') }}">Leases</a>
        </div>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="logout-link-btn">Log Out</button>
    </form>
</header>

<main class="inspection-main">

    <div class="inspection-header">
        <div class="inspection-header-left">
            <h1 class="inspection-title">Inspection Logs</h1>

            <form action="{{ route('inspections.index') }}" method="GET" class="inspection-search-form">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search inspections..."
                    class="inspection-search-input"
                >

                <button type="submit" class="inspection-search-button">
                    Search
                </button>
            </form>
        </div>

        <a href="{{ route('inspections.create') }}" class="inspection-create-button">
            + New Inspection
        </a>
    </div>

    @if(session('success'))
        <div class="inspection-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="inspection-grid">

        @forelse($inspections as $inspection)

            <div class="inspection-card">

                <div class="inspection-card-top">
                    <span class="inspection-id-badge">
                        Inspection #{{ $inspection->inspection_id }}
                    </span>
                </div>

                <div class="inspection-info">
                    <h3 class="inspection-name">
                        Property: {{ $inspection->property_id }}
                    </h3>

                    <p class="inspection-position">
                        {{ $inspection->date
                            ? \Carbon\Carbon::parse($inspection->date)->format('M d, Y')
                            : 'No Date'
                        }}
                    </p>
                </div>

                <div class="inspection-details">

                    <div class="inspection-detail-row">
                        <span class="inspection-detail-label">Staff ID</span>
                        <span class="inspection-detail-value-hl">
                            {{ $inspection->staff_id }}
                        </span>
                    </div>

                    <div class="inspection-comments">
                        <span class="inspection-detail-label">Comment</span>

                        <p>
                            {{ $inspection->comment ?? 'No comment provided.' }}
                        </p>
                    </div>

                </div>

                <div class="inspection-actions">
                    <a href="{{ route('inspections.show', $inspection) }}" class="inspection-view-link">
                        View
                    </a>

                    <a href="{{ route('inspections.edit', $inspection) }}" class="inspection-edit-link">
                        Edit
                    </a>

                    <form
                        action="{{ route('inspections.destroy', $inspection) }}"
                        method="POST"
                        class="inspection-delete-form"
                        onsubmit="return confirm('Delete this inspection?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="inspection-delete-link">
                            Delete
                        </button>
                    </form>
                </div>

            </div>

        @empty

            <div class="inspection-empty">
                No inspections found.
            </div>

        @endforelse

    </div>

</main>

</body>
</html>