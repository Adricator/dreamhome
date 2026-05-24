<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owners - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owners.css') }}">
</head>
<body>
<main class="os-det-container">
    <div class="os-det-inner-wrapper">
        <div class="os-det-back-navigation">
            <a href="{{ route('owners.index') }}" class="os-det-back-link">← Back to List</a>
        </div>

        <div class="os-det-profile-panel">
            <div class="os-det-panel-body">
                
                <div class="os-det-profile-header">
                    <div class="os-det-header-title-group">
                        <span class="os-det-id-badge">{{ $owner->owner_id }}</span>
                        <h1 class="os-det-full-name">{{ $owner->first_name }} {{ $owner->last_name }}</h1>
                    </div>
                </div>

                <div class="os-det-layout-grid">
                    
                    <div class="os-det-meta-fields-column">
                        <div class="os-det-field-group">
                            <h4 class="os-det-section-subtitle">Contact Information</h4>
                            <p class="os-det-telephone-display">{{ $owner->telephone_no }}</p>
                            <p class="os-det-email-display">{{ $owner->email }}</p>
                        </div>
                        <div class="os-det-field-group">
                            <h4 class="os-det-section-subtitle">Primary Address</h4>
                            <p class="os-det-address-display">{{ $owner->address }}</p>
                        </div>
                    </div>
                    
                    <div class="os-det-stats-column-box">
                        <h4 class="os-det-stats-title">Properties Owned</h4>
                        <div class="os-det-stats-counter">{{ $owner->properties_count }}</div>
                        <a href="{{ route('properties.create', ['owner_id' => $owner->owner_id]) }}" class="os-det-add-prop-btn">
                            + Add Property
                        </a>
                    </div>
                </div>
                <hr class="divider">
                <!-- make a div here
                <div class="action-bar">
                    <a href="http://127.0.0.1:8000/staff/ST0001/edit" class="btn btn-filled">
                        Edit Staff Member
                    </a>
                    <a href="http://127.0.0.1:8000/staff" class="btn btn-outlined">
                        Return to Directory
                    </a>
                    
                    <form action="http://127.0.0.1:8000/staff/ST0001" method="POST" onsubmit="return confirm('Archive this staff record?');" class="delete-form">
                        <input type="hidden" name="_token" value="UEOfTIatvUJRFyzaWbABjzBxfdfBzruCRb7Xxudx" autocomplete="off">            <input type="hidden" name="_method" value="DELETE">            <button type="submit" class="btn-delete">
                            Delete Record
                        </button>
                    </form>
                </div> 
                    THIS IS JUST A REFERENCE FROM staff but give the code for owner side-->
                    <!-- I am curently woking with owner/show.balde.php -->
                <div class="os-actions">
                    <div class="os-action-buttons">
                        <a href="{{ route('owners.edit', $owner->owner_id) }}" class="os-edit-button">
                            Edit Owner
                        </a>
                    </div>
                    <form action="{{ route('owners.destroy', $owner->owner_id) }}" 
                        method="POST" 
                        onsubmit="return confirm('Permanent action: Delete this owner record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="os-delete-button">
                            Delete Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>