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

<main class="viewing-show-main">

    <div class="viewing-back-container">
        <a href="{{ route('viewings.index') }}" class="viewing-back-link">
            ← Back to Viewings
        </a>
    </div>

    <section class="viewing-show-card">

        <div class="viewing-status-badge">
            Viewing Record
        </div>

        <div class="viewing-show-header">
            <span class="viewing-profile-label">Client Property Viewing</span>

            <h1 class="viewing-show-title">
                {{ $viewing->client_id }}
            </h1>

            <p class="viewing-show-subtitle">
                {{ $viewing->property_id }} / {{ $viewing->view_date }}
            </p>
        </div>

        <div class="viewing-show-grid">

            <div class="viewing-show-left">
                <div>
                    <span class="viewing-section-label">Client ID</span>
                    <p class="viewing-large-text">{{ $viewing->client_id }}</p>
                </div>

                <div>
                    <span class="viewing-section-label">Property ID</span>
                    <p class="viewing-large-text viewing-highlight">{{ $viewing->property_id }}</p>
                </div>

                <div>
                    <span class="viewing-section-label">Staff ID</span>
                    <p class="viewing-large-text">{{ $viewing->staff_id ?? 'Not assigned' }}</p>
                </div>
            </div>

            <div class="viewing-management-card">
                <div>
                    <span class="viewing-section-label">Viewing Date</span>
                    <p class="viewing-management-area">{{ $viewing->view_date }}</p>
                </div>

                <div class="viewing-description">
                    <p>
                        Comments:
                        <span>{{ $viewing->comments ?? 'No comments provided.' }}</span>
                    </p>
                </div>
            </div>

        </div>

        <div class="viewing-show-actions">
            <a
                href="{{ route('viewings.edit', [$viewing->client_id, $viewing->property_id, $viewing->view_date]) }}"
                class="viewing-edit-button"
            >
                Edit Viewing
            </a>

            <form
                method="POST"
                action="{{ route('viewings.destroy', [$viewing->client_id, $viewing->property_id, $viewing->view_date]) }}"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="viewing-delete-button"
                    onclick="return confirm('Delete this viewing record?')"
                >
                    Delete Record
                </button>
            </form>
        </div>

    </section>

</main>

