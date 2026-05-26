<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Inspection - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inspections.css') }}">
</head>
<body>
<<<<<<< HEAD

=======
>>>>>>> 16cb75eea5500eace47c0e997143c6b567fb5520
<main class="inspection-form-container">
    <div class="inspection-form-card">

        <div class="inspection-form-header">
            <div>
                <h1 class="inspection-form-title">modify inspection</h1>
                <p class="inspection-form-subtitle">UPDATE RECORDS AND RETROFIT ACCOUNTABILITY LOGS</p>
            </div>
            <div>
                <span class="inspection-id-badge">ID: #{{ $inspection->inspection_id }}</span>
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

        <form action="{{ route('inspections.update', ['inspection_id' => $inspection->inspection_id]) }}" method="POST" class="inspection-form">
            @csrf
            @method('PUT')

            <div class="inspection-form-section">
                <div class="inspection-section-label">Management Assignment</div>
                <div class="inspection-form-grid">
                    
                    <div class="inspection-input-group col-6">
                        <select name="property_id" id="property_id" required>
                            @foreach($properties as $property)
                                <option value="{{ $property->property_id }}" {{ (old('property_id', $inspection->property_id) == $property->property_id) ? 'selected' : '' }}>
                                    {{ $property->property_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="inspection-input-group col-6">
                        <select name="staff_id" id="staff_id" required>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->staff_id }}" {{ (old('staff_id', $inspection->staff_id) == $staff->staff_id) ? 'selected' : '' }}>
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
                        <input type="date" name="inspection_date" id="inspection_date" value="{{ old('inspection_date', $inspection->inspection_date) }}" required>
                    </div>

                    <div class="inspection-input-group col-12">
                        <textarea id="comments" name="comments" placeholder="Write inspection notes and condition details here..." required>{{ old('comments', $inspection->comments) }}</textarea>
                    </div>

                </div>
            </div>

            <hr class="inspection-divider">

            <div class="inspection-form-actions">
                <button type="submit" class="inspection-submit-btn">Save Changes</button>
                <a href="{{ route('inspections.index') }}" class="inspection-cancel-btn">Cancel</a>
            </div>

        </form>
    </div>
</main>

</body>
</html>