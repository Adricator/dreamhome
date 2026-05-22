<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Branch Details - {{ $branch->city }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/branches.css') }}">
</head>

<body style="background-color: #0a0f14;">
    <main class="branch-show-main">

    <div class="branch-back-container">
        <a href="{{ route('branches.index') }}" class="branch-back-link">
            ← Back to Directory
        </a>
    </div>

    <div class="branch-show-card">

        <div class="branch-status-badge">
            Active Branch
        </div>

        <div class="branch-show-header">

            <span class="branch-profile-label">
                Branch Profile: {{ $branch->branch_id ?? 'N/A' }}
            </span>

            <h1 class="branch-show-title">
                {{ $branch->city }}
            </h1>

            <p class="branch-show-subtitle">
                {{ $branch->area }} Regional Office
            </p>

        </div>

        <div class="branch-show-grid">

            <div class="branch-show-left">

                <div>
                    <span class="branch-section-label">
                        Physical Address
                    </span>

                    <p class="branch-address">
                        {{ $branch->street }}<br>

                        <span class="branch-address-highlight">
                            {{ $branch->city }}, {{ $branch->postcode }}
                        </span>
                    </p>
                </div>

                <div class="branch-show-manager">

                    <span class="branch-show-manager-label">
                        Branch Manager
                    </span>

                    @if($branch->manager)

                        <div class="branch-show-manager-info">

                            <span class="branch-show-manager-name">
                                {{ $branch->manager->first_name }}
                                {{ $branch->manager->last_name }}
                            </span>

                            <span class="branch-show-manager-id">
                                {{ $branch->manager->staff_id }}
                            </span>

                        </div>

                    @else

                        <span class="branch-manager-empty">
                            No manager assigned
                        </span>

                    @endif

                </div>

                <div class="branch-contact-grid">

                    <div>
                        <span class="branch-section-label">
                            Telephone
                        </span>

                        <p class="branch-contact-text">
                            {{ $branch->telephone_no }}
                        </p>
                    </div>

                    <div>
                        <span class="branch-section-label">
                            Fax Line
                        </span>

                        <p class="branch-contact-muted">
                            {{ $branch->fax_no }}
                        </p>
                    </div>

                </div>

            </div>

            <div class="branch-management-card">

                <div>
                    <span class="branch-section-label">
                        Management Area
                    </span>

                    <p class="branch-management-area">
                        {{ $branch->area }}
                    </p>
                </div>

                <div class="branch-management-description">
                    <p>
                        This branch oversees property management and staff operations within the
                        <span>{{ $branch->city }}</span>
                        metropolitan area.
                    </p>
                </div>

            </div>

        </div>

        <div class="branch-show-actions">

            <div class="branch-show-buttons">
                <a href="{{ route('branches.edit', $branch) }}" class="branch-edit-button">
                    Edit Branch
                </a>
            </div>

            <form action="{{ route('branches.destroy', $branch) }}"
                method="POST"
                onsubmit="return confirm('Permanent action: Delete this branch office?');">

                @csrf
                @method('DELETE')

                <button type="submit" class="branch-delete-button">
                    Remove Branch
                </button>

            </form>

        </div>

    </div>

    </main>
</body>
</html>