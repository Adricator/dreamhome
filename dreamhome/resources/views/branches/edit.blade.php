<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($branch) ? 'Edit Branch' : 'Register Branch' }} - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/branches.css') }}">

</head>
<body>

    <main class="branch-form-main">

    <div class="branch-form-card">

        <div class="branch-form-header">

            <div>
                <h1 class="branch-form-title">
                    {{ isset($branch) ? 'edit branch' : 'register branch' }}
                </h1>

                <p class="branch-form-subtitle">
                    {{ isset($branch) ? "Modifying Branch: " . $branch->branch_id : "Establishing new location" }}
                </p>
            </div>

            @if(isset($branch))
            <span class="branch-id-pill">
                ID: {{ $branch->branch_id }}
            </span>
            @endif

        </div>

        <form action="{{ isset($branch) ? route('branches.update', $branch->branch_id) : route('branches.store') }}"
            method="POST"
            class="branch-form">

            @csrf
            @if(isset($branch))
                @method('PUT')
            @endif

            <div class="branch-form-grid">

                <!-- LEFT COLUMN -->
                <div class="branch-form-section">

                    <label class="branch-section-title">
                        Location Details
                    </label>

                    <div class="branch-input-group">

                        <span class="branch-input-label">
                            Street Address
                        </span>

                        <textarea name="street" rows="2" class="branch-textarea">{{ old('street', $branch->street ?? '') }}</textarea>

                    </div>

                    <div class="branch-two-grid">

                        <div class="branch-input-group">

                            <span class="branch-input-label">
                                City
                            </span>

                            <input type="text"
                                name="city"
                                value="{{ old('city', $branch->city ?? '') }}"
                                class="branch-input">

                        </div>

                        <div class="branch-input-group">

                            <span class="branch-input-label">
                                Postcode
                            </span>

                            <input type="text"
                                name="postcode"
                                value="{{ old('postcode', $branch->postcode ?? '') }}"
                                class="branch-input">

                        </div>

                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="branch-form-section">

                    <label class="branch-section-title">
                        Communication & Area
                    </label>

                    <div class="branch-input-group">

                        <span class="branch-input-label">
                            Region / Area
                        </span>

                        <input type="text"
                            name="area"
                            value="{{ old('area', $branch->area ?? '') }}"
                            class="branch-input">

                    </div>

                    <div class="branch-two-grid">

                        <div class="branch-input-group">

                            <span class="branch-input-label">
                                Telephone
                            </span>

                            <input type="text"
                                name="telephone_no"
                                value="{{ old('telephone_no', $branch->telephone_no ?? '') }}"
                                class="branch-input">

                        </div>

                        <div class="branch-input-group">

                            <span class="branch-input-label">
                                Fax Number
                            </span>

                            <input type="text"
                                name="fax_no"
                                value="{{ old('fax_no', $branch->fax_no ?? '') }}"
                                class="branch-input">

                        </div>

                    </div>

                </div>

            </div>

            <!-- BRANCH ID -->
            <div class="branch-id-section">

                <div class="branch-input-group">

                    <label class="branch-section-title branch-id-title">
                        Branch Registration ID
                    </label>

                    <input type="text"
                        name="branch_id"
                        value="{{ old('branch_id', $branch->branch_id ?? '') }}"
                        class="branch-input"
                        {{ isset($branch) ? 'readonly' : '' }}>

                    @if(isset($branch))
                    <p class="branch-id-note">
                        * Unique Identifier cannot be changed once registered.
                    </p>
                    @endif

                </div>

            </div>

            <!-- ACTIONS -->
            <div class="branch-form-actions">

                <button type="submit" class="branch-submit-button">
                    {{ isset($branch) ? 'Update Branch' : 'Confirm Registration' }}
                </button>

                <a href="{{ route('branches.index') }}" class="branch-back-button">
                    Back to List
                </a>

            </div>

        </form>

    </div>

    </main>

</body>
</html>