<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="text-white min-h-screen"> <!-- Added a dark bg for the glass effect -->
    
    <header class="relative z-50 w-full pt-8 flex justify-center">
            <nav class="inline-flex items-center bg-white/10 backdrop-blur-lg border border-white/20 rounded-full px-12 py-3">
                <div class="flex items-left gap-10 text-white uppercase font-bold nav-link">
                    <a href="{{ url('/') }}" class="hover:text-gray-300 transition">Home</a>
                    <a href="{{ route('branches.index') }}" class="hover:text-gray-300 transition">Branches</a>
                    <a href="{{ route('staff.index') }}" class="text-cyan-400 transition">Staff</a>
                    <a href="{{ route('properties.index') }}" class="hover:text-gray-300 transition">Properties</a>
                    <a href="{{ route('owners.index') }}" class="hover:text-gray-300 transition">Owners</a>
                    <a href="{{ url('/inspections') }}" class="hover:text-gray-300 transition">Inspections</a>
                    <a href="{{ url('/clients') }}" class="hover:text-gray-300 transition">Clients</a>
                    <a href="{{ url('/viewings') }}" class="hover:text-gray-300 transition">Viewings</a>
                    <a href="{{ url('/leases') }}" class="hover:text-gray-300 transition">Leases</a>
                </div>
            </nav>
        </header>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="font-dream text-5xl text-[#d1dcd5] mb-4">staff directory</h1>
                <form action="{{ route('staff.index') }}" method="GET" class="flex flex-wrap gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search staff..." class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg text-sm w-64 focus:outline-none focus:ring-1 focus:ring-cyan-400 text-white">
                    <button type="submit" class="bg-cyan-600 px-4 py-2 rounded-lg text-xs uppercase font-bold hover:bg-cyan-500">Search</button>
                </form>
            </div>

            <a href="{{ route('staff.create') }}" class="border border-white px-6 py-2 text-[11px] font-semibold uppercase tracking-widest hover:bg-white hover:text-black transition">
                + New Staff Member
            </a>
        </div>

        <!-- Staff Grid -->
    <!-- Staff Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($staffMembers as $person)
    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 hover:border-cyan-500/50 transition-all group">
        <div class="mb-4">
            <span class="text-[10px] bg-white/10 text-gray-400 px-3 py-1 rounded-full uppercase tracking-tighter">
                {{ $person->staff_id }}
            </span>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-bold tracking-tight">{{ $person->first_name }} {{ $person->last_name }}</h3>
            <p class="text-cyan-400 text-xs uppercase tracking-widest font-semibold">{{ $person->position }}</p>
        </div>

        <div class="space-y-2 mb-6 text-sm text-gray-300">
            <div class="flex justify-between border-b border-white/5 pb-1">
                <span class="text-gray-500 text-[10px] uppercase">Salary</span>
                <span>₱{{ number_format($person->salary) }}</span>
            </div>
            <div class="flex justify-between border-b border-white/5 pb-1">
                <span class="text-gray-500 text-[10px] uppercase">Joined</span>
                <span>{{ $person->date_joined }}</span>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('staff.show', $person) }}" class="text-cyan-400 hover:text-white text-[10px] uppercase font-bold tracking-widest">
                View Profile
            </a>

            <a href="{{ route('staff.edit', $person) }}" class="text-white/50 hover:text-white text-[10px] uppercase font-bold tracking-widest">
                Edit
            </a>
        </div>
    </div> <!-- This was the missing div! -->
    @endforeach
</div>
    </main>
</body>
</html>