<!DOCTYPE html>
<html lang="en">
<head>
    <!-- (Same Head as Edit) -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Staff - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
</head>
<body style="background-color: #0a1518; ">
    <main class="create-container">
        <div class="glass-card cyan-accent">
            <div class="creation-header">
                <h1 class="creation-title">add new staff</h1>
                <p class="creation-subtitle">Enter the details of the new team member</p>
            </div>
            @if ($errors->any())
                <div class="input-fieldset" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem;">
                    <label class="fieldset-heading" style="color: #ef4444;">Form Registration Blocked</label>
                    <ul style="color: #fca5a5; margin: 0.5rem 0 0 1.25rem; padding: 0; font-size: 0.9rem; line-height: 1.5;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('staff.store') }}" method="POST" class="creation-form">
                @csrf
                
                <div class="layout-double-column">
                    <div class="input-fieldset">
                        <label class="fieldset-heading">Staff Identity</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $staff->first_name ?? '') }}" placeholder="First Name" class="form-entry-field">
                        <input type="text" name="last_name" value="{{ old('last_name', $staff->last_name ?? '') }}" placeholder="Last Name" class="form-entry-field">
                        <div class="layout-split-pair">
                            <input type="date" name="dob" value="{{ old('dob', $staff->dob ?? '') }}" placeholder="Date of Birth" class="form-entry-field" required>
                            <select name="sex" class="form-entry-field select-dropdown-native" required>
                                <option value="" disabled selected>Select Sex...</option>
                                @foreach($sex_options as $sex)
                                    <option value="{{ $sex }}">{{ ucwords($sex) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input-fieldset">
                        <label class="fieldset-heading">Contact Details</label>
                        <div class="layout-split-pair">
                            <input type="email" name="email" placeholder="Email Address" class="form-entry-field">
                            <input type="tel" name="telephone_no" placeholder="Telephone No" class="form-entry-field">
                        </div>
                        <textarea type="text" name="address" placeholder="Residential Street Address" class="form-entry-field staff-textarea"></textarea>
                    </div>
                    <div class="input-fieldset">
                        <label class="fieldset-heading">Employment Details</label>
                        <select name="position" id="position-select" class="form-entry-field select-dropdown-native" required>
                            <option value="" disabled selected>Select Position Role...</option>
                            @foreach($positions as $position)
                                <option value="{{ strtolower($position) }}">{{ ucwords($position) }}</option>
                            @endforeach
                        </select>
                        <div>
                            <input type="number" step="100.00" name="salary" placeholder="Monthly Salary" class="form-entry-field">
                        </div>
                        <div class="layout-split-pair">
                            <input type="text" name="nin" placeholder="Insurance No" class="form-entry-field">
                            <input type="text" name="branch_id" placeholder="BR00x" class="form-entry-field">
                        </div>
                    </div>
                    <div id="dynamic-fields-container">
                        <div id="fields-manager" class="input-fieldset conditional-field-group">
                            <label class="fieldset-heading">Manager Data</label>
                            <input type="number" step="100" name="car_allowance" placeholder="Car Allowance (₱)" class="form-entry-field">
                            <input type="number" step="100" name="performance_bonus" placeholder="Performance Bonus (₱)" class="form-entry-field">
                        </div>

                        <div id="fields-secretary" class="input-fieldset conditional-field-group">
                            <label class="fieldset-heading">Secretary Data</label>
                            <input type="number" name="typing_speed_wpm" placeholder="Typing Speed (WPM)" class="form-entry-field">
                        </div>

                        <div id="fields-staff" class="input-fieldset conditional-field-group">
                            <label class="fieldset-heading">Staff Data</label>
                            <input type="text" name="supervised_by" placeholder="Supervising Manager ID (e.g., ST0001)" class="form-entry-field">
                        </div>
                        <div id="fields-supervisor" class="input-fieldset conditional-field-group">
                            <label class="fieldset-heading">Supervisor Data</label>
                        </div>
                    </div>
                </div>
                <!-- add a next of kin details here next_of_kin(full_name, relationship, address, telephone_no)-->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const positionSelect = document.getElementById('position-select');
                        const groups = document.querySelectorAll('.conditional-field-group');
                        positionSelect.addEventListener('change', function () {
                            const selectedRole = this.value;
                            // 1. Hide all sub-conditional component inputs instantly
                            groups.forEach(group => {
                                group.style.display = 'none';
                        
                                // Disable hidden inputs so they are completely skipped during request array payload submission
                                group.querySelectorAll('.form-entry-field').forEach(input => {
                                    input.disabled = true;
                                });
                            });
                            // 2. Identify target matching node element block 
                            const targetGroup = document.getElementById(`fields-${selectedRole}`);
                            
                            if (targetGroup) {
                                // Restore presentation behavior mapping to your CSS requirements
                                if (targetGroup.classList.contains('layout-split-pair')) {
                                    targetGroup.style.display = 'grid'; // Retains split columns for manager inputs
                                } else {
                                    targetGroup.style.display = 'flex'; // Keeps full rows for staff/secretary inputs
                                }

                                // Enable fields so Laravel can process them upon request submission
                                targetGroup.querySelectorAll('.form-entry-field').forEach(input => {
                                    input.disabled = false;
                                });
                            }
                        });
                    });
                </script>
                <div class="input-fieldset">
                    <label class="fieldset-heading">Next of Kin Details</label>
                    <input type="text" name="nok_name" value="{{ old('nok_name') }}" placeholder="Full Name" class="form-entry-field" required>
                    <div class="layout-split-pair">
                        <input type="text" name="nok_relationship" value="{{ old('nok_relationship') }}" placeholder="Relationship (e.g., Spouse, Parent)" class="form-entry-field" required>
                        <input type="tel" name="nok_telephone_no" value="{{ old('nok_telephone_no') }}" placeholder="Contact Number" class="form-entry-field" required>
                    </div>
                    <textarea name="nok_address" placeholder="Residential Address" class="form-entry-field staff-textarea" required>{{ old('nok_address') }}</textarea>
                </div>
                <div class="execution-row">
                    <button type="submit" class="action-btn action-btn-submit">
                        Register Staff
                    </button>
                    <a href="{{ route('staff.index') }}" class="action-btn action-btn-cancel">
                        Back to List
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>