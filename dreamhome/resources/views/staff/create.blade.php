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

            <form action="{{ route('staff.store') }}" method="POST" class="creation-form">
                @csrf
                
                <div class="layout-double-column">
                    <div class="input-fieldset">
                        <label class="fieldset-heading">Staff Identity</label>
                        <input type="text" name="staff_id" placeholder="Staff ID (e.g., SL21)" class="form-entry-field">
                        <div class="layout-split-pair">
                            <input type="text" name="first_name" placeholder="First Name" class="form-entry-field">
                            <input type="text" name="last_name" placeholder="Last Name" class="form-entry-field">
                        </div>
                    </div>

                    <div class="input-fieldset">
                        <label class="fieldset-heading">Employment Details</label>
                        <input type="text" name="position" placeholder="Position (e.g., Manager)" class="form-entry-field">
                        <div class="layout-split-pair">
                            <input type="number" step="0.01" name="salary" placeholder="Monthly Salary" class="form-entry-field">
                            <input type="date" name="date_joined" class="form-entry-field">
                        </div>
                    </div>
                </div>

                <div class="creation-footer-divider">
                    <div class="layout-triple-column">
                        <div class="stacked-input-group">
                            <span class="meta-caption">NIN</span>
                            <input type="text" name="nin" placeholder="Insurance No" class="form-entry-field">
                        </div>
                        <div class="stacked-input-group">
                            <span class="meta-caption">Sex</span>
                            <select name="sex" class="form-entry-field select-dropdown-native">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="stacked-input-group">
                            <span class="meta-caption">Branch</span>
                            <input type="text" name="branch_id" placeholder="B00x" class="form-entry-field">
                        </div>
                    </div>
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