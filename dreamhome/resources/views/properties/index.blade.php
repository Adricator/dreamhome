<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Properties - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<body class="text-white min-h-screen">

    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ route('dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}" >Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
                <a href="{{ route('properties.index') }}" class="active">Properties</a>
                <a href="{{ route('owners.index') }}">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}">Clients</a>
                <a href="{{ url('/viewings') }}">Viewings</a>
                <a href="{{ url('/leases') }}">Leases</a>
            </div>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-link-btn">
                Log Out
            </button>
        </form>
    </header>


    <main class="max-w-7xl mx-auto px-6 py-12">
        <!-- Header & Search Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="font-dream text-5xl text-[#d1dcd5] mb-4">property directory</h1>
                <form action="{{ route('properties.index') }}" method="GET" class="flex flex-wrap gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by street or ID..." class="px-4 py-2 rounded-lg text-sm w-64 focus:outline-none focus:ring-1 focus:ring-cyan-400">
                   <select name="type" class="px-4 py-2 rounded-lg bg-[#0f172a] text-sm focus:outline-none">
                    <option value="">All Types</option>
                    <option value="House" @selected(request('type') == 'House')>House</option>
                    <option value="Apartment" @selected(request('type') == 'Apartment')>Apartment</option>
                    <option value="Condo" @selected(request('type') == 'Condo')>Condo</option>
                    <option value="Flat" @selected(request('type') == 'Flat')>Flat</option>
                </select>

                 <select name="status" class="px-4 py-2 rounded-lg bg-[#0f172a] text-sm focus:outline-none">
                <option value="">All Statuses</option>
                <option value="Available" @selected(request('status') == 'Available')>Available</option>
                <option value="Rented" @selected(request('status') == 'Rented')>Rented</option>
                <option value="Maintenance" @selected(request('status') == 'Maintenance')>Maintenance</option>
                
                </select>
                    <button type="submit" class="bg-cyan-600 px-4 py-2 rounded-lg text-xs uppercase font-bold hover:bg-cyan-500">Filter</button>
                </form>
            </div>
            
            <a href="{{ route('properties.create') }}" class="border border-white px-6 py-2 text-[11px] font-semibold uppercase tracking-widest hover:bg-white hover:text-black transition">
                + Add Property
            </a>
        </div>

        <!-- Property Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($properties as $property)
            <div class="glass-card rounded-2xl p-6 hover:border-white/40 transition-all group flex flex-col">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[10px] bg-cyan-500/20 text-cyan-300 px-3 py-1 rounded-full uppercase tracking-tighter">
                        {{ $property->status }} | {{ $property->type }}
                    </span>
                    <h3 class="text-2xl font-light">₱{{ number_format($property->monthly_rent) }}<span class="text-xs text-gray-500">/mo</span></h3>
                </div>

                <div class="space-y-1 mb-4">
                    <p class="text-gray-500 text-sm">Property ID: {{ $property->property_id }}</p>
                    <p class="text-xl font-semibold tracking-tight">{{ $property->street }}</p>
                    <p class="text-gray-400 text-sm uppercase tracking-widest">{{ $property->city }}, {{ $property->postcode }}</p>
                    
                </div>

                <!-- New Data Points -->
                <div class="grid grid-cols-2 gap-4 py-4 border-y border-white/10 my-4 text-[11px] uppercase tracking-wider text-gray-300">
                    <div><span class="text-gray-500 block">Rooms:</span> {{ $property->rooms }}</div>
                    <div><span class="text-gray-500 block">Area:</span> {{ $property->area }}</div>
                    <div><span class="text-gray-500 block">Owner ID:</span> {{ $property->owner_id }}</div>
                    <div><span class="text-gray-500 block">Staff | Branch ID:</span> {{ $property->staff_id }} | {{ $property->branch_id }}</div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-auto pt-4 flex justify-between items-center">
                    <div class="flex gap-4">
                        <a href="{{ route('properties.show', $property->property_id) }}" class="text-cyan-400 hover:text-white text-[10px] uppercase font-bold tracking-widest">View</a>
                        <a href="{{ route('properties.edit', $property->property_id) }}" class="text-white hover:text-cyan-400 text-[10px] uppercase font-bold tracking-widest">Edit</a>
                    </div>
                    
                    <form action="{{ route('properties.destroy', $property->property_id) }}" method="POST" onsubmit="return confirm('Delete this property?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 text-[10px] uppercase font-bold tracking-widest">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>