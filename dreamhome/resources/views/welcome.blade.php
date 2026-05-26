<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dream Home</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/vanilla-styles.css') }}">
    <script src="{{ asset('js/welcome.js') }}" defer></script>
</head>

<body class="theme-body">

    <div class="page-wrapper">
        <div class="bg-container">
            <img src="{{ asset('images/welcomebg.jpg') }}" alt="Modern Architecture" class="bg-image">
            <div class="bg-overlay-layer"></div>
        </div>

        <header class="main-header">
    @php
        $type = collect($properties)->pluck('type')->unique()->filter()->sort();
        $rooms = collect($properties)->pluck('rooms')->unique()->filter()->sort();
        $city = collect($properties)->pluck('city')->unique()->filter()->sort();
    @endphp
    
    <form action="{{ url()->current() }}#properties-section" method="GET" class="w-full">
        <div class="search-label">What's your ideal home mood?</div>
        
        <div class="search-controls">
            <div class="search-grid">
                
                <div class="select-wrapper">
                    <select name="type" class="custom-select">
                        <option value="" class="select-option">Property Type</option>
                        @foreach($type as $val)
                            <option value="{{ $val }}" class="select-option" {{ request('type') == $val ? 'selected' : '' }}>
                                {{ strtoupper($val) }}
                            </option>
                        @endforeach
                    </select>
                    <div class="select-icon">
                        <svg class="icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <div class="select-wrapper">
                    <select name="rooms" class="custom-select">
                        <option value="" class="select-option">Rooms</option>
                        @foreach($rooms as $val)
                            <option value="{{ $val }}" class="select-option" {{ request('rooms') == $val ? 'selected' : '' }}>
                                {{ $val }} Rooms
                            </option>
                        @endforeach
                    </select>
                    <div class="select-icon">
                        <svg class="icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <div class="select-wrapper">
                    <select name="price_range" class="custom-select">
                        <option value="" class="select-option">Price Range</option>
                        <option value="0-50000" class="select-option" {{ request('price_range') == '0-50000' ? 'selected' : '' }}>Under ₱50,000</option>
                        <option value="50000-100000" class="select-option" {{ request('price_range') == '50000-100000' ? 'selected' : '' }}>₱50,000 - ₱100,000</option>
                        <option value="100000+" class="select-option" {{ request('price_range') == '100000+' ? 'selected' : '' }}>₱100,000+</option>
                    </select>
                    <div class="select-icon">
                        <svg class="icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <div class="select-wrapper">
                    <select name="city" class="custom-select">
                        <option value="" class="select-option">City</option>
                        @foreach($city as $val)
                            <option value="{{ $val }}" class="select-option" {{ request('city') == $val ? 'selected' : '' }}>
                                {{ strtoupper($val) }}
                            </option>
                        @endforeach
                    </select>
                    <div class="select-icon">
                        <svg class="icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="submit-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>
    </form>

    <div class="auth-links">
    <div class="auth-links-container">
    <a href="{{ url('/portal-select') }}" class="nav-link">Log in</a>
    <a href="{{ url('/client/register') }}" class="nav-link {{ request()->is('client/register') ? 'active' : '' }}">Register</a>
    </div>
    </div>
</header>

        <main class="hero-main">
            <div class="hero-content">
                <h1 class="hero-title-dream">dream</h1>
                <h2 class="hero-title-home">home</h2>
                <div class="hero-btn-wrapper">
                    <a href="#properties-section" class="btn-display-home">
                        Find Display Home
                    </a>
                </div>
            </div>
        </main>
    </div>

    <div id="properties-section" class="mt-8"></div>
    <section id="properties-section" class="properties-section">
        <div class="properties-container">
            <div class="properties-header"> 
                <h2 class="properties-title">Properties</h2>
            </div>

            <div class="slider-wrapper">
                <button id="prev-property-btn" class="slider-nav-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="slider-nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <div class="slider-viewport">
                    @forelse($properties as $index => $property)
                    <div class="property-card card-hidden-right" data-card-index="{{ $index }}">
                        <div class="card-details">
                            <div>
                                <div class="card-id-row">
                                    <span class="card-id-label">Property ID:</span>
                                    <span class="card-id-value">#{{ $property->property_id }}</span>
                                </div>
                                <div class="card-type">
                                    {{ $property->type ?? 'N/A' }}
                                </div>
                            </div>
                            
                            <div class="card-stats">
                                <div class="card-stats-row">
                                    <div>Rooms: <span class="stat-highlight">{{ $property->rooms ?? '—' }}</span></div>
                                    <div class="text-right">
                                        <span class="stat-highlight">₱{{ isset($property->monthly_rent) ? number_format($property->monthly_rent) : '—' }}</span>
                                        <span class="price-month">/ mo</span>
                                    </div>
                                </div>
                                
                                <div class="card-location">
                                    <div class="location-street">
                                        {{ $property->street ?? 'Street & Area' }}{{ isset($property->area) ? ', ' . $property->area : '' }}
                                    </div>
                                    <div class="location-city">
                                        {{ $property->city ?? 'City' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-image-wrapper">
                            <img src="{{ isset($property->image_path) ? asset($property->image_path) : asset('images/csbg.jpg') }}" alt="Property View" class="card-image">
                        </div>
                    </div>
                    @empty
                    <div class="property-card card-active empty-state">
                        </div>
                    @endforelse
                </div>

                <button id="next-property-btn" class="slider-nav-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="slider-nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

</body>
</html>