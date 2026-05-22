<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Property - {{ $property->street }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/properties.css') }}">
<body>
<main class="p-show-container">
    <div class="p-show-glass-card">
        
        <div class="p-show-status-ribbon">
            {{ $property->status }}
        </div>

        <div class="p-show-hero-header">
            <span class="p-show-data-label">Property Profile: {{ $property->property_id }}</span>
            <h1 class="p-show-main-title">{{ $property->street }}</h1>
            <p class="p-show-text-location">{{ $property->city }}, {{ $property->postcode }}</p>
        </div>

        <div class="p-show-details-grid">
            
            <div class="p-show-col-left">
                <div class="p-show-pricing-block">
                    <span class="p-show-data-label">Monthly Rental</span>
                    <p class="p-show-text-price">₱{{ number_format($property->monthly_rent) }}<span class="p-show-price-period"> / month</span></p>
                </div>
                
                <div class="p-show-sub-matrix">
                    <div>
                        <span class="p-show-data-label">Property Type</span>
                        <p class="p-show-data-value">{{ $property->type }}</p>
                    </div>
                    <div>
                        <span class="p-show-data-label">Total Rooms</span>
                        <p class="p-show-data-value">{{ $property->rooms }} Bedrooms</p>
                    </div>
                </div>
            </div>

            <div class="p-show-col-right-box">
                <div class="p-show-box-row">
                    <span class="p-show-data-label">Area</span>
                    <p class="p-show-data-value p-show-size-large">{{ $property->area }}</p>
                </div>
                
                <div class="p-show-system-triad">
                    <div>
                        <span class="p-show-data-label">Owner</span>
                        <p class="p-show-text-mono-id">{{ $property->owner_id }}</p>
                    </div>
                    <div>
                        <span class="p-show-data-label">Staff</span>
                        <p class="p-show-text-mono-id">{{ $property->staff_id }}</p>
                    </div>
                    <div>
                        <span class="p-show-data-label">Branch</span>
                        <p class="p-show-text-mono-id">{{ $property->branch_id }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-show-marketing-section">
            <h3 class="p-show-section-title">Marketing & Ads</h3>
            
            @if($property->advertisements->isEmpty())
                <div class="p-show-empty-state">
                    <p class="p-show-text-empty">No advertisement history found.</p>
                </div>
            @else
                <div class="p-show-table-wrapper">
                    <table class="p-show-data-table">
                        <thead>
                            <tr class="p-show-table-head-row">
                                <th class="p-show-th">ID</th>
                                <th class="p-show-th">Media Source</th>
                                <th class="p-show-th">Date</th>
                                <th class="p-show-th p-show-text-right">Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($property->advertisements as $ad)
                                <tr class="p-show-table-body-row">
                                    <td class="p-show-td p-show-td-id">{{ $ad->ad_id }}</td>
                                    <td class="p-show-td">{{ $ad->media_source }}</td>
                                    <td class="p-show-td p-show-td-muted">{{ $ad->date_advertised }}</td>
                                    <td class="p-show-td p-show-text-right p-show-td-cost">₱{{ number_format($ad->cost, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="p-show-action-deck">
            <div class="p-show-btn-group-left">
                <a href="{{ route('properties.edit', $property->property_id) }}" class="p-show-btn p-show-btn-primary">
                    Edit Property
                </a>
                <a href="{{ route('properties.index') }}" class="p-show-btn p-show-btn-secondary">
                    Back to List
                </a>
            </div>
            
            <form action="{{ route('properties.destroy', $property->property_id) }}" method="POST" onsubmit="return confirm('Permanent action: Delete this property?');" class="p-show-delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-show-btn-remove">
                    Remove Listing
                </button>
            </form>
        </div>
    </div>
</main>
</body>
</html>