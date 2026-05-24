<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Inspection - Dream Home</title>

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

<main class="inspection-form-container">

    <div class="inspection-form-card">

        <div class="inspection-form-header">
            <div>
                <h1 class="inspection-form-title">Edit Inspection</h1>
                <p class="inspection-form-subtitle">Update inspection #{{ $inspection->inspection_id }}</p>
            </div>

            <span class="inspection-id-badge">
                ID: {{ $inspection->inspection_id }}
            </span>
        </div>

        @if ($errors->any())
            <div class="inspection-error-box">
                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inspections.update', $inspection) }}" method="POST" class="inspection-form">
            @csrf
            @method('PUT')

            <div class="inspection-form-grid">

                <div class="inspection-input-group">
                    <label for="property_id">Property ID</label>
                    <input
                        type="text"
                        id="property_id"
                        name="property_id"
                        value="{{ old('property_id', $inspection->property_id) }}"
                        required
                    >
                </div>

                <div class="inspection-input-group">
                    <label for="staff_id">Staff ID</label>
                    <input
                        type="text"
                        id="staff_id"
                        name="staff_id"
                        value="{{ old('staff_id', $inspection->staff_id) }}"
                        required
                    >
                </div>

                <div class="inspection-input-group">
                    <label for="date">Inspection Date</label>
                    <input
                        type="date"
                        id="date"
                        name="date"
                        value="{{ old('date', $inspection->date ? \Carbon\Carbon::parse($inspection->date)->format('Y-m-d') : '') }}"
                        required
                    >
                </div>

            </div>

            <div class="inspection-input-group">
                <label for="comment">Comment</label>
                <textarea
                    id="comment"
                    name="comment"
                    rows="5"
                >{{ old('comment', $inspection->comment) }}</textarea>
            </div>

            <div class="inspection-form-actions">
                <button type="submit" class="inspection-submit-btn">
                    Update Inspection
                </button>

                <a href="{{ route('inspections.show', $inspection) }}" class="inspection-cancel-btn">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</main>

</body>
</html>