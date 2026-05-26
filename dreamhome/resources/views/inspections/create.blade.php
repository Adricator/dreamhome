<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Inspection - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inspections.css') }}">
</head>
<body>
<main class="inspection-form-container">
    <div class="inspection-form-card">

        <div class="inspection-form-header">
            <div>
                <h1 class="inspection-form-title">add new inspection</h1>
                <p class="inspection-form-subtitle">ENTER THE DETAILS TO RECORD A NEW ESTATE LOG</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="inspection-error-box">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inspections.store') }}" method="POST" class="inspection-form">
            @csrf

            <div class="inspection-form-section">
                <div class="inspection-section-label">Management Assignment</div>
                <div class="inspection-form-grid">
                    
                    <div class="inspection-input-group col-6">
                        <select name="property_id" id="property_id" required>
                            <option value="" disabled selected>-- Choose a Property --</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->property_id }}" {{ old('property_id') == $property->property_id ? 'selected' : '' }}>
                                    {{ $property->property_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="inspection-input-group col-6">
                        <select name="staff_id" id="staff_id" required>
                            <option value="" disabled selected>-- Assign Staff Member --</option>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->staff_id }}" {{ old('staff_id') == $staff->staff_id ? 'selected' : '' }}>
                                    {{ $staff->staff_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <div class="inspection-form-section">
                <div class="inspection-section-label">Log Metrics</div>
                <div class="inspection-form-grid">
                    
                    <div class="inspection-input-group col-4">
                        <input type="date" name="inspection_date" id="inspection_date" value="{{ old('inspection_date') }}" required>
                    </div>

                    <div class="inspection-input-group col-12">
                        <textarea id="comments" name="comments" placeholder="Write inspection notes and condition details here..." required>{{ old('comments') }}</textarea>
                    </div>

                </div>
            </div>

            <hr class="inspection-divider">

            <div class="inspection-form-actions">
                <button type="submit" class="inspection-submit-btn">Publish Listing</button>
                <a href="{{ route('inspections.index') }}" class="inspection-cancel-btn">Cancel</a>
            </div>

        </form>
    </div>
</main>

</body>
</html>