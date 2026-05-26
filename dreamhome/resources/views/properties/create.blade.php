<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Property - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/properties.css') }}">
</head>
<body style="background-color: #0a1518;">
<main class="p-crt-container">
    <div class="p-crt-glass-card">
        
        <div class="p-crt-header">
            <h1 class="p-crt-main-title">add new property</h1>
            <p class="p-crt-sub-title">Enter the details to list a new estate</p>
        </div>

        <form action="{{ route('properties.store') }}" method="POST" class="p-crt-form-layout">
            @csrf
            
            <div class="p-crt-grid-split">
                
                <div class="p-crt-field-stack">
                    <label class="p-crt-field-label">Location</label>
                    <input type="text" name="street" placeholder="Street Address" class="p-crt-input-text" required>
                    <div class="p-crt-grid-dual">
                        <input type="text" name="city" placeholder="City" class="p-crt-input-text">
                        <input type="text" name="postcode" placeholder="Postcode" class="p-crt-input-text">
                    </div>
                </div>

                <div class="p-crt-field-stack">
                    <label class="p-crt-field-label">Specifications</label>
                    <div class="p-crt-grid-dual">
                    <select name="type" class="p-crt-select-menu" required>
                        <option value="" disabled selected>-- Select Type --</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                        <input type="number" name="rooms" placeholder="Rooms" class="p-crt-input-text">
                    </div>
                    <div class="p-crt-grid-dual">
                        <input type="number" name="monthly_rent" placeholder="Rent (₱)" class="p-crt-input-text">
                        <input type="text" name="area" placeholder="Area" class="p-crt-input-text">
                    </div>
                </div>
            </div>

            <div class="p-crt-management-section">
                <label class="p-crt-field-label p-crt-label-block">Management Assignment</label>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const branchSelect = document.getElementById('branch-select-prop');
                        const staffSelect = document.getElementById('staff-select-prop');

                        if (branchSelect && staffSelect) {
                            branchSelect.addEventListener('change', function () {
                                const branchId = this.value;
                                staffSelect.innerHTML = '<option value="">Loading assigned staff...</option>';

                                if (!branchId) {
                                    staffSelect.innerHTML = '<option value="">-- Select a Branch First --</option>';
                                    return;
                                }
                                fetch(`/api/branches/${branchId}/staff`)
                                    .then(response => {
                                        if (!response.ok) throw new Error('Network error fetching staff elements');
                                        return response.json();
                                    })
                                    .then(data => {
                                        staffSelect.innerHTML = '<option value="">-- Choose Staff Member --</option>';

                                        if (data.length === 0) {
                                            staffSelect.innerHTML = '<option value="">No staff members found here</option>';
                                            return;
                                        }
                                        data.forEach(staff => {
                                            const option = document.createElement('option');
                                            option.value = staff.staff_id;
                                            option.textContent = `${staff.staff_id} - ${staff.first_name} ${staff.last_name} (${staff.position})`;
                                            staffSelect.appendChild(option);
                                        });
                                    })
                                    .catch(error => {
                                        console.error('Fetch Error:', error);
                                        staffSelect.innerHTML = '<option value="">Error fetching staff. Try again.</option>';
                                    });
                            });
                        }
                    });
                    </script>
                <div class="p-crt-grid-triad">
                    
                    <select name="owner_id" class="p-crt-input-text">
                        <option value="">-- Choose an Owner --</option>
                        @foreach($owners as $owner)
                            <option value="{{ $owner->owner_id }}" 
                                {{ old('owner_id', $selectedOwnerId) == $owner->owner_id ? 'selected' : '' }}>
                                {{ $owner->owner_id }} - {{ $owner->first_name }} {{ $owner->last_name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="branch_id" id="branch-select-prop" class="p-crt-input-text" required>
                        <option value="" disabled selected>-- Select a Branch --</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->branch_id }}" {{ old('branch_id') == $branch->branch_id ? 'selected' : '' }}>
                                {{ $branch->branch_id }} - {{ $branch->city }}
                            </option>
                        @endforeach
                    </select>

                    <select name="staff_id" id="staff-select-prop" class="p-crt-input-text" required>
                        <option value="">-- Select a Branch First --</option>
                    </select>

                </div>
            </div>

            <div class="p-crt-action-deck">
                <button type="submit" class="p-crt-btn p-crt-btn-submit">
                    Publish Listing
                </button>
                <a href="{{ route('properties.index') }}" class="p-crt-btn p-crt-btn-cancel">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>
</body>
</html>