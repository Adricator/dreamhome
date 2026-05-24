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
<main class="viewing-form-main">

    <section class="viewing-form-card orange-glow">

        <div class="viewing-form-header">
            <div>
                <h1 class="viewing-form-title">Edit Viewing</h1>
                <p class="viewing-form-subtitle orange-text">Update viewing record</p>
            </div>

            <span class="viewing-id-pill">
                {{ $viewing->client_id }} / {{ $viewing->property_id }}
            </span>
        </div>

        @if ($errors->any())
            <div class="viewing-error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('viewings.update', [$viewing->client_id, $viewing->property_id, $viewing->view_date]) }}"
            class="viewing-form"
        >
            @csrf
            @method('PUT')

            <div class="viewing-form-grid">

                <div class="viewing-input-group">
                    <label class="viewing-input-label">Client</label>
                    <select name="client_id" class="viewing-input" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->client_id }}" {{ old('client_id', $viewing->client_id) == $client->client_id ? 'selected' : '' }}>
                                {{ $client->client_id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="viewing-input-group">
                    <label class="viewing-input-label">Property</label>
                    <select name="property_id" class="viewing-input" required>
                        @foreach($properties as $property)
                            <option value="{{ $property->property_id }}" {{ old('property_id', $viewing->property_id) == $property->property_id ? 'selected' : '' }}>
                                {{ $property->property_id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="viewing-input-group">
                    <label class="viewing-input-label">Viewing Date</label>
                    <input
                        type="date"
                        name="view_date"
                        class="viewing-input"
                        value="{{ old('view_date', $viewing->view_date) }}"
                        required
                    >
                </div>

                <div class="viewing-input-group">
                    <label class="viewing-input-label">Staff</label>
                    <select name="staff_id" class="viewing-input">
                        <option value="">Select Staff</option>
                        @foreach($staff as $employee)
                            <option value="{{ $employee->staff_id }}" {{ old('staff_id', $viewing->staff_id) == $employee->staff_id ? 'selected' : '' }}>
                                {{ $employee->staff_id }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="viewing-input-group">
                <label class="viewing-input-label">Comments</label>
                <textarea name="comments" class="viewing-textarea">{{ old('comments', $viewing->comments) }}</textarea>
            </div>

            <div class="viewing-form-actions">
                <button type="submit" class="viewing-submit-button orange-button">
                    Update Viewing
                </button>

                <a href="{{ route('viewings.index') }}" class="viewing-back-button">
                    Cancel
                </a>
            </div>

        </form>

    </section>

</main>

