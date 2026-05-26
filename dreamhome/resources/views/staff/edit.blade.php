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
                {{ $staff->staff_id }}
            </span>
        </div>

        <form action="{{ route('staff.update', $staff->staff_id) }}" method="POST" class="creation-form">
            @csrf
            @method('PUT')
            
            <div class="layout-double-column">
                <div class="input-fieldset">
                    <label class="fieldset-heading">Staff Identity</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $staff->first_name) }}" placeholder="First Name" class="form-entry-field" required>
                    <input type="text" name="last_name" value="{{ old('last_name', $staff->last_name) }}" placeholder="Last Name" class="form-entry-field" required>
                    <div class="layout-split-pair">
                        <input type="date" name="dob" value="{{ old('dob', $staff->dob) }}" class="form-entry-field" required>
                        <select name="sex" class="form-entry-field select-dropdown-native" required>
                            <option value="" disabled>Select Sex...</option>
                            @foreach($sex_options as $sex)
                                <option value="{{ $sex }}" {{ old('sex', $staff->sex) == $sex ? 'selected' : '' }}>
                                    {{ ucwords($sex) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="input-fieldset">
                    <label class="fieldset-heading">Contact Details</label>
                    <div class="layout-split-pair">
                        <input type="email" name="email" value="{{ old('email', $staff->email) }}" placeholder="Email Address" class="form-entry-field" required>
                        <input type="tel" name="telephone_no" value="{{ old('telephone_no', $staff->telephone_no) }}" placeholder="Telephone No" class="form-entry-field" required>
                    </div>
                    <textarea name="address" placeholder="Residential Street Address" class="form-entry-field staff-textarea" required>{{ old('address', $staff->address) }}</textarea>
                </div>

                <div class="input-fieldset">
                    <label class="fieldset-heading">Employment Details</label>
                    
                    <select name="position" id="position-select" class="form-entry-field select-dropdown-native" required>
                        <option value="" disabled>Select Position Role...</option>
                        @foreach($positions as $position)
                            <option value="{{ strtolower($position) }}" {{ old('position', $staff->position) == strtolower($position) ? 'selected' : '' }}>
                                {{ ucwords($position) }}
                            </option>
                        @endforeach
                    </select>
                    
                    <div>
                        <input type="number" step="100.00" name="salary" value="{{ old('salary', $staff->salary) }}" placeholder="Monthly Salary" class="form-entry-field" required>
                    </div>
                    
                    <div class="layout-split-pair">
                        <input type="text" name="nin" value="{{ old('nin', $staff->nin) }}" placeholder="Insurance No" class="form-entry-field">
                        
                        <select name="branch_id" id="branch-select" class="form-entry-field select-dropdown-native" required>
                            <option value="" disabled>Select Branch...</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->branch_id }}" {{ old('branch_id', $staff->branch_id) == $branch->branch_id ? 'selected' : '' }}>
                                    {{ $branch->branch_id }} - {{ $branch->city }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="dynamic-fields-container">
                    <div id="fields-manager" class="input-fieldset conditional-field-group">
                        <label class="fieldset-heading">Manager Data</label>
                        <input type="number" step="100" name="car_allowance" value="{{ old('car_allowance', $staff->car_allowance) }}" placeholder="Car Allowance (₱)" class="form-entry-field">
                        <input type="number" step="100" name="performance_bonus" value="{{ old('performance_bonus', $staff->performance_bonus) }}" placeholder="Performance Bonus (₱)" class="form-entry-field">
                    </div>

                    <div id="fields-secretary" class="input-fieldset conditional-field-group">
                        <label class="fieldset-heading">Secretary Data</label>
                        <input type="number" name="typing_speed_wpm" value="{{ old('typing_speed_wpm', $staff->typing_speed_wpm) }}" placeholder="Typing Speed (WPM)" class="form-entry-field">
                    </div>

                    <div id="fields-staff" class="input-fieldset conditional-field-group">
                        <label class="fieldset-heading">Staff Data</label>
                        <select name="supervised_by" id="supervisor-select" class="form-entry-field select-dropdown-native">
                            @if($staff->supervised_by)
                                <option value="{{ $staff->supervised_by }}">
                                    {{ $staff->supervised_by }} - Current Supervisor
                                </option>
                            @else
                                <option value="">-- Select a Branch First --</option>
                            @endif
                        </select>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const branchSelect = document.getElementById('branch-select');
                                const supervisorSelect = document.getElementById('supervisor-select');
                                // Track old supervisor state for preservation logic
                                const initialSupervisor = "{{ old('supervised_by', $staff->supervised_by) }}";

                                function fetchSupervisors(branchId, selectedVal = null) {
                                    if (!branchId) return;
                                    
                                    supervisorSelect.innerHTML = '<option value="">Loading eligible supervisors...</option>';

                                    fetch(`/api/branches/${branchId}/supervisors`)
                                        .then(response => response.json())
                                        .then(data => {
                                            supervisorSelect.innerHTML = '<option value="">-- Select Supervising Manager --</option>';

                                            if (data.length === 0) {
                                                supervisorSelect.innerHTML = '<option value="">No supervisors found at this branch</option>';
                                                return;
                                            }

                                            data.forEach(supervisor => {
                                                const option = document.createElement('option');
                                                option.value = supervisor.staff_id;
                                                option.textContent = `${supervisor.staff_id} - ${supervisor.first_name} ${supervisor.last_name}`;
                                                
                                                if (selectedVal && supervisor.staff_id === selectedVal) {
                                                    option.selected = true;
                                                }
                                                supervisorSelect.appendChild(option);
                                            });
                                        })
                                        .catch(() => {
                                            supervisorSelect.innerHTML = '<option value="">Error fetching supervisors.</option>';
                                        });
                                }

                                // Trigger lookup instantly on page render if a branch is already saved
                                if(branchSelect.value) {
                                    fetchSupervisors(branchSelect.value, initialSupervisor);
                                }

                                branchSelect.addEventListener('change', function () {
                                    fetchSupervisors(this.value);
                                });
                            });
                        </script>
                    </div>

                    <div id="fields-supervisor" class="input-fieldset conditional-field-group">
                        <label class="fieldset-heading">Supervisor Data</label>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const positionSelect = document.getElementById('position-select');
                    const groups = document.querySelectorAll('.conditional-field-group');

                    function toggleRolePanels(selectedRole) {
                        groups.forEach(group => {
                            group.style.display = 'none';
                            group.querySelectorAll('.form-entry-field').forEach(input => {
                                input.disabled = true;
                            });
                        });

                        const targetGroup = document.getElementById(`fields-${selectedRole}`);
                        if (targetGroup) {
                            if (targetGroup.classList.contains('layout-split-pair')) {
                                targetGroup.style.display = 'grid';
                            } else {
                                targetGroup.style.display = 'flex';
                            }

                            targetGroup.querySelectorAll('.form-entry-field').forEach(input => {
                                input.disabled = false;
                            });
                        }
                    }

                    if (positionSelect.value) {
                        toggleRolePanels(positionSelect.value);
                    }

                    positionSelect.addEventListener('change', function () {
                        toggleRolePanels(this.value);
                    });
                });
            </script>

            <div class="input-fieldset">
                <label class="fieldset-heading">Next of Kin Details</label>
                
                <input type="text" name="nok_name" 
                    value="{{ old('nok_name', $staff->nextOfKin->full_name ?? '') }}" 
                    placeholder="Full Name" class="form-entry-field" required>
                    
                <div class="layout-split-pair">
                    <input type="text" name="nok_relationship" 
                        value="{{ old('nok_relationship', $staff->nextOfKin->relationship ?? '') }}" 
                        placeholder="Relationship" class="form-entry-field" required> 
                        
                    <input type="tel" name="nok_telephone_no" 
                        value="{{ old('nok_telephone_no', $staff->nextOfKin->telephone_no ?? '') }}" 
                        placeholder="Contact Number" class="form-entry-field" required>
                </div>
                
                <textarea name="nok_address" placeholder="Residential Address" class="form-entry-field staff-textarea" required>{{ old('nok_address', $staff->nextOfKin->address ?? '') }}</textarea>
            </div>

            <div class="execution-row">
                <button type="submit" class="action-btn action-staff-update-btn">
                    Update Staff Record
                </button>
                <a href="{{ route('staff.index') }}" class="action-btn action-btn-cancel">
                    Cancel Changes
                </a>
            </div>
        </form>
    </div>
</main>
</body>
</html>