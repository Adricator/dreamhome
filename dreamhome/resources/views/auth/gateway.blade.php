<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome - Selection Portal</title>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/gateway.css') }}">
</head>
<body>

    <div class="gw-container">
        <div class="gw-header">
            <h2>DreamHome Portal</h2>
            <p>Select your access privilege down below to continue</p>
        </div>

        <div class="gw-options-grid">
        <a href="{{ route('login') }}" class="gw-role-card">
            <div class="gw-icon-wrapper gw-staff-accent">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h3>Staff & Admin</h3>
            <p>Manage branches, properties, and system operations matrix.</p>
            <span class="gw-action-label">Enter Portal &rarr;</span>
        </a>

    <a href="{{ route('client.login') }}" class="gw-role-card">
        <div class="gw-icon-wrapper gw-client-accent">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
        </div>
        <h3>Client Access</h3>
        <p>View registered preferences, active match leases, and pricing limits.</p>
        <span class="gw-action-label">Enter Portal &rarr;</span>
    </a>
        </div>
    </div>

</body>
</html>