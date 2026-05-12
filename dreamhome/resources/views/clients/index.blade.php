<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clients - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="text-white min-h-screen">

    <header class="relative z-50 w-full pt-8 flex justify-center">
            <nav class="inline-flex items-center bg-white/10 backdrop-blur-lg border border-white/20 rounded-full px-12 py-3">
                <div class="flex items-left gap-10 text-white uppercase font-bold nav-link">
                    <a href="{{ url('/') }}" class="hover:text-gray-300 transition">Home</a>
                    <a href="{{ route('branches.index') }}" class="hover:text-gray-300 transition">Branches</a>
                    <a href="{{ route('staff.index') }}" class="hover:text-gray-300 transition">Staff</a>
                    <a href="{{ route('properties.index') }}" class="hover:text-gray-300 transition">Properties</a>
                    <a href="{{ route('owners.index') }}" class="hover:text-gray-300 transition">Owners</a>
                    <a href="{{ url('/inspections') }}" class="hover:text-gray-300 transition">Inspections</a>
                    <a href="{{ route('clients.index') }}" class="text-cyan-400 transition">Clients</a>
                    <a href="{{ url('/viewings') }}" class="hover:text-gray-300 transition">Viewings</a>
                    <a href="{{ url('/leases') }}" class="hover:text-gray-300 transition">Leases</a>
                </div>
            </nav>
        </header>
       <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="font-dream text-5xl text-[#d1dcd5] mb-4">client directory</h1>
                <form action="{{ url('/clients') }}" method="GET" class="flex flex-wrap gap-3">
    <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}" 
        placeholder="Search by name or ID..." 
        class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg text-sm w-64 focus:outline-none focus:ring-1 focus:ring-cyan-400 text-white placeholder-gray-400"
    >
    <button type="submit" class="bg-cyan-600 px-4 py-2 rounded-lg text-xs uppercase font-bold hover:bg-cyan-500 transition">
        Search
    </button>
</form>
            </div>

            <a href="{{ route('clients.create') }}" class="border border-white px-6 py-2 text-[11px] font-semibold uppercase tracking-widest hover:bg-white hover:text-black transition">
                + Register Client
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($clients as $client)
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 hover:border-white/40 transition-all group flex flex-col">
                
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[10px] bg-cyan-500/20 text-cyan-300 px-3 py-1 rounded-full uppercase tracking-tighter">
                        ID: {{ $client->client_id }}
                    </span>
                </div>

                <div class="space-y-1 mb-4">
                    <h3 class="text-2xl font-semibold tracking-tight">{{ $client->first_name }} {{ $client->last_name }}</h3>
                    <p class="text-cyan-400 text-xs uppercase tracking-widest font-bold">{{ $client->prefer_type }} Preference</p>
                </div>

                <div class="grid grid-cols-1 gap-3 py-4 border-y border-white/10 my-4 text-[11px] uppercase tracking-wider text-gray-300">
                    <div>
                        <span class="text-gray-500 block mb-1">Telephone:</span> 
                        <span class="text-sm normal-case">{{ $client->telephone_no }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block mb-1">Email:</span> 
                        <span class="text-sm normal-case truncate block">{{ $client->email }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block mb-1">Max Budget:</span> 
                        <span class="text-sm font-bold text-white">${{ number_format($client->max_rent, 0) }}</span>
                    </div>
                </div>

                <div class="mt-auto pt-4 flex justify-between items-center">
                    <div class="flex gap-4">
                        <a href="{{ route('clients.show', $client->client_id) }}" class="text-cyan-400 hover:text-white text-[10px] uppercase font-bold tracking-widest transition">Details</a>
                        <a href="{{ route('clients.edit', $client->client_id) }}" class="text-white hover:text-cyan-400 text-[10px] uppercase font-bold tracking-widest transition">Edit</a>
                    </div>

                    <form action="{{ route('clients.destroy', $client->client_id) }}" method="POST" onsubmit="return confirm('Archive this client record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400/60 hover:text-red-400 text-[10px] uppercase font-bold tracking-widest transition">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>