<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Profile - {{ $staff->first_name }} {{ $staff->last_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
</head>
<body style="flex-direction: column; align-items: center; justify-content: center;">

<main class="profile-container">
    <div class="profile-header">
        <div class="avatar-circle">
            {{ substr($staff->first_name, 0, 1) }}{{ substr($staff->last_name, 0, 1) }}
        </div>
        <div class="header-details">
            <h1 class="profile-name">{{ $staff->first_name }} {{ $staff->last_name }}</h1>
            <div class="badge-group">
                <span class="badge badge-primary">
                    {{ $staff->position }}
                </span>
                <span class="badge badge-secondary">
                    ID: {{ $staff->staff_id }}
                </span>
            </div>
        </div>
    </div>

    <div class="glass-card">
        
    <div class="main-split-layout">

        <div class="staff-metrics-section">
            <h2 class="section-title">Staff Details</h2>
            <div class="grid-two-col">
                
                <div class="info-group">
                    <div>
                        <p class="data-label">Position Type</p>
                        <p class="data-value text-capitalize text-highlight">{{ $staff->position }}</p>
                    </div>
                    <div>
                        <p class="data-label">Date Joined</p>
                        <p class="data-value">{{ \Carbon\Carbon::parse($staff->date_joined)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="data-label">
                            @if(strtolower($staff->position) === 'manager')
                                Managed Branch
                            @else
                                Branch Assignment
                            @endif
                        </p>
                        <p class="data-value">{{ $staff->branch_id }}</p>
                    </div>
                    <div>
                        <p class="data-label">Gender</p>
                        <p class="data-value text-capitalize">{{ $staff->sex }}</p>
                    </div>
                </div>

                <div class="info-group">
                    <div>
                        <p class="data-label">Salary</p>
                        <p class="data-value text-highlight">₱{{ number_format($staff->salary, 2) }}</p>
                    </div>
                    <div>
                        <p class="data-label">Contact Number</p>
                        <p class="data-value">{{ $staff->telephone_no }}</p>
                    </div>
                    <div>
                        <p class="data-label">Insurance (NIN)</p>
                        <p class="data-value font-mono">{{ $staff->nin }}</p>
                    </div>
                    <div>
                        <p class="data-label">Date of Birth</p>
                        <p class="data-value">{{ \Carbon\Carbon::parse($staff->dob)->format('M d, Y') }}</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="role-details-section">
            <h2 class="section-title">
                @if(strtolower($staff->position) === 'manager')
                    Manager Details
                @elseif(strtolower($staff->position) === 'secretary')
                    Secretary Details
                @elseif(strtolower($staff->position) === 'supervisor')
                    Supervisor Details
                @elseif(strtolower($staff->position) === 'staff')
                Supervised By
                @endif
            </h2>

            <div class="info-group">

                @if(strtolower($staff->position) === 'manager')

                    <div>
                        <p class="data-label">Car Allowance</p>
                        <p class="data-value">
                            ₱{{ number_format($staff->car_allowance ?? 0, 2) }}
                        </p>
                    </div>

                    <div>
                        <p class="data-label">Bonus</p>
                        <p class="data-value">
                            ₱{{ number_format($staff->performance_bonus ?? 0, 2) }}
                        </p>
                    </div>

                @elseif(strtolower($staff->position) === 'secretary')

                    <div>
                        <p class="data-label">Typing Speed</p>
                        <p class="data-value">
                            {{ $staff->typing_speed_wpm ?? 'N/A' }} WPM
                        </p>
                    </div>
                    <div>
                        <p class="data-label">Supervisor</p>
                        <p class="data-value">
                            {{ $staff->supervised_by ?? 'Not Assigned' }}
                        </p>
                    </div>

                @elseif(strtolower($staff->position) === 'staff')
                    <div>
                        <p class="data-label">Supervisor</p>
                        <p class="data-value">
                            {{ $staff->supervised_by ?? 'Not Assigned' }}
                        </p>
                    </div>

                @endif

            </div>
        </div>
            
    </div>

    <div class="nok-dropdown-wrapper">
        <details class="nok-accordion">
            <summary class="nok-summary-header">
                <span class="nok-summary-title">Next of Kin Contact Information</span>
                <span class="nok-arrow-icon">▼</span>
            </summary>
            
            <div class="nok-dropdown-content">
                <div class="grid-three-col">
                    <div>
                        <p class="data-label">Full Name</p>
                        <p class="data-value">{{ $staff->nextOfKin->full_name ?? 'Not Assigned' }}</p>
                    </div>
                    <div>
                        <p class="data-label">Relationship</p>
                        <p class="data-value text-capitalize">{{ $staff->nextOfKin->relationship ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="data-label">Emergency Contact</p>
                        <p class="data-value font-mono">{{ $staff->nextOfKin->telephone_no ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </details>
    </div>
    
    <hr class="divider">

    <div class="grid-three-col">
         <div>
            <p class="data-label">Properties Managed</p>
            <p class="data-value">{{ $staff->properties->count() }} Listings</p>
        </div>
        <div></div>
        <div></div>
    </div>

    <div class="action-bar">
        <a href="{{ route('staff.edit', ['staff_id' => $staff->staff_id]) }}" class="btn btn-filled">
            Edit Staff Member
        </a>
        <a href="{{ route('staff.index') }}" class="btn btn-outlined">
            Return to Directory
        </a>
        
        <form action="{{ route('staff.destroy', $staff->staff_id) }}" method="POST" onsubmit="return confirm('Archive this staff record?');" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">
                Delete Record
            </button>
        </form>
    </div>
</div>
</main>
</body>
</html>