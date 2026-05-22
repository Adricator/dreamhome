<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Staff - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
</head>
<body>
<main class="form-container">
    <div class="glass-card border-accent">
        <div class="form-header">
            <div>
                <h1 class="page-title">edit staff</h1>
                <p class="subtitle">Modifying Member: {{ $staff->staff_id }}</p>
            </div>
            <span class="status-badge">
                Position: {{ $staff->position }}
            </span>
        </div>

        <form action="{{ route('staff.update', $staff->staff_id) }}" method="POST" class="form-body">
            @csrf
            @method('PUT')
            
            <div class="grid-two-col">
                <div class="field-set">
                    <label class="group-label">Personal Information</label>
                    <div class="grid-input-pair">
                        <input type="text" name="first_name" value="{{ $staff->first_name }}" placeholder="First Name" class="form-control">
                        <input type="text" name="last_name" value="{{ $staff->last_name }}" placeholder="Last Name" class="form-control">
                    </div>
                    <div class="grid-input-pair">
                        <select name="sex" class="form-control select-menu">
                            <option value="male" {{ $staff->sex == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $staff->sex == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <input type="date" name="dob" value="{{ $staff->dob }}" class="form-control">
                    </div>
                </div>

                <div class="field-set">
                    <label class="group-label">Professional Details</label>
                    <!-- <input type="text" name="position" value="{{ $staff->position }}" placeholder="Position" class="form-control"> -->
                    <select name="position" class="form-control select-dropdown-native">
                        <option value="manager" {{ $staff->position === 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="supervisor" {{ $staff->position === 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        <option value="secretary" {{ $staff->position === 'secretary' ? 'selected' : '' }}>Secretary</option>
                        <option value="staff" {{ $staff->position === 'staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                    <div class="grid-input-pair">
                        <input type="number" step="0.01" name="salary" value="{{ $staff->salary }}" placeholder="Salary" class="form-control">
                        <input type="text" name="telephone_no" value="{{ $staff->telephone_no }}" placeholder="Telephone" class="form-control">
                    </div>
                </div>  
            </div>

            <div class="form-footer-section">
                <label class="group-label block-label">Identification & Location</label>
                <div class="grid-two-col gap-6">
                     <div class="input-wrapper">
                        <span class="field-caption">National Insurance Number (NIN)</span>
                        <input type="text" name="nin" value="{{ $staff->nin }}" class="form-control">
                    </div>
                    <div class="input-wrapper">
                        <span class="field-caption">Branch ID</span>
                        <input type="text" name="branch_id" value="{{ $staff->branch_id }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>
                <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>
</body>
</html>