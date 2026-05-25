<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inspection Details - Dream Home</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inspections.css') }}">
</head>
<body>
<main class="inspection-show-container">

    <div class="inspection-show-header">
        <div>
            <h1 class="inspection-show-title">Inspection Details</h1>
            <p class="inspection-show-subtitle">Inspection #{{ $inspection->inspection_id }}</p>
        </div>

        <span class="inspection-id-badge">
            {{ $inspection->date
                ? \Carbon\Carbon::parse($inspection->date)->format('M d, Y')
                : 'No Date'
            }}
        </span>
    </div>

    @if(session('success'))
        <div class="inspection-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="inspection-show-card">

        <div class="inspection-show-grid">

            <div class="inspection-show-item">
                <span>Property ID</span>
                <p>{{ $inspection->property_id }}</p>
            </div>

            <div class="inspection-show-item">
                <span>Staff ID</span>
                <p>{{ $inspection->staff_id }}</p>
            </div>

            <div class="inspection-show-item">
                <span>Inspection Date</span>
                <p>
                    {{ $inspection->date
                        ? \Carbon\Carbon::parse($inspection->date)->format('M d, Y')
                        : 'No Date'
                    }}
                </p>
            </div>

        </div>

        <hr class="inspection-divider">

        <div class="inspection-show-comments">
            <span>Comment</span>
            <p>{{ $inspection->comment ?? 'No comment provided.' }}</p>
        </div>

        <div class="inspection-show-actions">

            <a href="{{ route('inspections.index') }}" class="inspection-cancel-btn">
                Back
            </a>

            <a href="{{ route('inspections.edit', $inspection) }}" class="inspection-submit-btn">
                Edit
            </a>

            <form action="{{ route('inspections.destroy', $inspection) }}" method="POST" onsubmit="return confirm('Delete this inspection?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="inspection-danger-btn">
                    Delete
                </button>
            </form>

        </div>

    </div>

</main>

</body>
</html>