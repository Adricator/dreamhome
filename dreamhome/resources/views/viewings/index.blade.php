<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Viewings - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/viewings.css') }}">
    </head>
<body>
    
    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ route('dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}">Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
                <a href="{{ route('properties.index') }}">Properties</a>
                <a href="{{ route('owners.index') }}">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}">Clients</a>
                <a href="{{ url('/viewings') }}" class="active">Viewings</a>
                
            </div>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-link-btn">
                Log Out
            </button>
        </form>
    </header>
    

        <main class="viewing-main">

    <div class="viewing-header">
        <div>
            <h1 class="viewing-title">viewing directory</h1>
        </div>

        <a href="{{ route('viewings.create') }}" class="new-viewing-button">
            + Add Viewing
        </a>
    </div>

    <form method="GET" action="{{ route('viewings.index') }}" class="viewing-search-form">
        <input
            type="text"
            name="search"
            class="viewing-search-input"
            placeholder="Search client, property, staff..."
            value="{{ request('search') }}"
        >

        <button type="submit" class="viewing-search-button">
            Search
        </button>
    </form>

    @if(session('success'))
        <div class="viewing-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="viewing-grid">
        @forelse($viewings as $viewing)
            <div class="viewing-card">

                <div class="viewing-card-header">
                    <span class="viewing-badge">Viewing</span>
                    <span class="viewing-date">{{ $viewing->property_id }}</span>
                </div>

                <div class="viewing-info">
                    <h2 class="viewing-card-title">
                        {{ $viewing->client_id }}
                    </h2>

                    <p class="viewing-card-subtitle">
                        Date: {{ $viewing->view_date }}
                    </p>
                </div>

                <div class="viewing-details">
                    <div>
                        <span class="viewing-label">Client ID</span>
                        <p class="viewing-value">{{ $viewing->client_id }}</p>
                    </div>

                    <div>
                        <span class="viewing-label">Property ID</span>
                        <p class="viewing-value">{{ $viewing->property_id }}</p>
                    </div>

                    <div>
                        <span class="viewing-label">Staff ID</span>
                        <p class="viewing-value">{{ $viewing->staff_id ?? 'Not assigned' }}</p>
                    </div>

                    <div>
                        <span class="viewing-label">Comments</span>
                        <p class="viewing-value">
                            {{ $viewing->comments ? Str::limit($viewing->comments, 60) : 'No comments' }}
                        </p>
                    </div>
                </div>

               <div class="viewing-actions">
                    <div class="viewing-links">
                        <a href="{{ route('viewings.show', [
    'client_id'   => $viewing->client_id, 
    'property_id' => $viewing->property_id, 
    'view_date'   => $viewing->view_date
]) }}" class="view-link">
                            View
                        </a>

                        <a href="{{ route('viewings.edit', [
    'client_id'   => $viewing->client_id,
    'property_id' => $viewing->property_id,
    'view_date'   => $viewing->view_date
]) }}" class="edit-link">
                            Edit
                        </a>
                    </div>

                    <form action="{{ route('viewings.destroy', [
    'client_id'   => $viewing->client_id ?? $viewing['client_id'],
    'property_id' => $viewing->property_id ?? $viewing['property_id'],
    'view_date'   => $viewing->view_date ?? $viewing['view_date']
]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        class="delete-link"
        onclick="return confirm('Delete this viewing record?')"
    >
        Delete
    </button>
</form>
                </div>

            </div>
        @empty
            <p class="viewing-empty">No viewing records found.</p>
        @endforelse
    </div>

</main>

</body>
</html>
