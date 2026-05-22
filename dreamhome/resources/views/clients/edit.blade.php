<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Client - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<body class="text-white min-h-screen bg-[#0f172a]">

    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ route('dashboard') }}">Home</a>
                <a href="{{ route('branches.index') }}" >Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
                <a href="{{ route('properties.index') }}">Properties</a>
                <a href="{{ route('owners.index') }}">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}" class="active">Clients</a>
                <a href="{{ url('/viewings') }}">Viewings</a>
                <a href="{{ url('/leases') }}">Leases</a>
            </div>
        </nav>
    </header>

    <main class="max-w-3xl mx-auto px-6 py-16">
        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('clients.show', $client->client_id) }}" class="group inline-flex items-center text-gray-400 text-[10px] uppercase font-bold tracking-[0.2em] hover:text-cyan-400 transition">
                <span class="mr-2 transform group-hover:-translate-x-1 transition-transform">←</span> Cancel & Exit
            </a>
            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Modifying Record #{{ $client->client_id }}</span>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
            <div class="px-8 py-8 border-b border-white/10 bg-gradient-to-r from-cyan-900/20 to-transparent">
                <h1 class="text-3xl font-semibold tracking-tight text-white">Edit Client Details</h1>
                <p class="text-gray-400 text-xs mt-2 uppercase tracking-wider">Update the information for {{ $client->first_name }} {{ $client->last_name }}</p>
            </div>

            <form action="{{ route('clients.update', $client->client_id) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $client->first_name) }}" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $client->last_name) }}" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Telephone</label>
                        <input type="text" name="telephone_no" value="{{ old('telephone_no', $client->telephone_no) }}" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $client->email) }}" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Current Address</label>
                        <input type="text" name="address" value="{{ old('address', $client->address) }}" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Preferred Type</label>
                        <select name="prefer_type" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition appearance-none">
                            <option value="House" {{ $client->prefer_type == 'House' ? 'selected' : '' }} class="bg-[#0f172a]">House</option>
                            <option value="Flat" {{ $client->prefer_type == 'Flat' ? 'selected' : '' }} class="bg-[#0f172a]">Flat</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Max Budget ($)</label>
                        <input type="number" name="max_rent" step="0.01" value="{{ old('max_rent', $client->max_rent) }}" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition font-bold text-emerald-400">
                    </div>
                </div>

                <div class="pt-8 flex justify-end gap-4 border-t border-white/10 mt-8">
                    <button type="submit" class="bg-cyan-600 text-white px-10 py-3 rounded-full text-[10px] uppercase font-bold tracking-[0.2em] hover:bg-cyan-400 hover:text-black transition duration-300 shadow-lg shadow-cyan-500/20">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>