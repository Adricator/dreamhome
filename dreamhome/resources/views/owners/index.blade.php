<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owners - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<body class="text-white min-h-screen">

    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ url('/dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}" >Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
                <a href="{{ route('properties.index') }}">Properties</a>
                <a href="{{ route('owners.index') }}" class="active">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}" >Clients</a>
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
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="font-dream text-5xl text-[#d1dcd5] mb-4">owner directory</h1>
                <form action="{{ route('owners.index') }}" method="GET" class="flex flex-wrap gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search owners..." class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg text-sm w-64 focus:outline-none focus:ring-1 focus:ring-cyan-400 text-white">
                    <button type="submit" class="bg-cyan-600 px-4 py-2 rounded-lg text-xs uppercase font-bold hover:bg-cyan-500">Search</button>
                </form>
            </div>

            <a href="{{ route('owners.create') }}" class="border border-white px-6 py-2 text-[11px] font-semibold uppercase tracking-widest hover:bg-white hover:text-black transition">
                + Register New Owner
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($owners as $owner)
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 hover:border-cyan-500/50 transition-all group">
                <div class="mb-4">
                    <span class="text-[10px] bg-white/10 text-gray-400 px-3 py-1 rounded-full uppercase tracking-tighter">
                        {{ $owner->owner_id }}
                    </span>
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-bold tracking-tight">{{ $owner->first_name }} {{ $owner->last_name }}</h3>
                    <p class="text-cyan-400 text-[10px] uppercase tracking-widest font-semibold mt-1">Property Owner</p>
                </div>

                <div class="space-y-2 mb-6 text-sm text-gray-300">
                    <div class="flex justify-between border-b border-white/5 pb-1">
                        <span class="text-gray-500 text-[10px] uppercase">Phone</span>
                        <span class="text-xs">{{ $owner->telephone_no }}</span>
                    </div>
                    <div class="flex justify-between border-b border-white/5 pb-1">
                        <span class="text-gray-500 text-[10px] uppercase">Email</span>
                        <span class="text-xs truncate ml-4">{{ $owner->email }}</span>
                    </div>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('owners.show', $owner) }}" class="text-cyan-400 hover:text-white text-[10px] uppercase font-bold tracking-widest">View Details</a>
                    <a href="{{ route('owners.edit', $owner) }}" class="text-white/50 hover:text-white text-[10px] uppercase font-bold tracking-widest">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>
