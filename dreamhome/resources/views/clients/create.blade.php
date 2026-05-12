<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Client - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="text-white min-h-screen bg-[#0f172a]">

    <header class="relative z-50 w-full pt-8 flex justify-center">
        <nav class="inline-flex items-center bg-white/10 backdrop-blur-lg border border-white/20 rounded-full px-12 py-3">
            <div class="flex items-left gap-10 text-white uppercase font-bold nav-link text-xs tracking-widest">
                <a href="{{ url('/') }}" class="hover:text-gray-300 transition">Home</a>
                <a href="{{ route('branches.index') }}" class="hover:text-gray-300 transition">Branches</a>
                <a href="{{ route('staff.index') }}" class="hover:text-gray-300 transition">Staff</a>
                <a href="{{ route('properties.index') }}" class="hover:text-gray-300 transition">Properties</a>
                <a href="{{ url('/private-owners') }}" class="hover:text-gray-300 transition">Private Owners</a>
                <a href="{{ url('/inspections') }}" class="hover:text-gray-300 transition">Inspections</a>
                <a href="{{ url('/clients') }}" class="text-cyan-400 transition">Clients</a>
                <a href="{{ url('/viewings') }}" class="hover:text-gray-300 transition">Viewings</a>
                <a href="{{ url('/leases') }}" class="hover:text-gray-300 transition">Leases</a>
            </div>
        </nav>
    </header>

    <main class="max-w-3xl mx-auto px-6 py-16">
        <div class="mb-8">
            <a href="{{ url('/clients') }}" class="group inline-flex items-center text-gray-400 text-[10px] uppercase font-bold tracking-[0.2em] hover:text-cyan-400 transition">
                <span class="mr-2 transform group-hover:-translate-x-1 transition-transform">←</span> Back to Directory
            </a>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
            <div class="px-8 py-8 border-b border-white/10 bg-gradient-to-r from-emerald-900/20 to-transparent">
                <h1 class="text-3xl font-semibold tracking-tight text-white">Register New Client</h1>
                <p class="text-gray-400 text-xs mt-2 uppercase tracking-wider">Initialize a new client record in the Dream Home database</p>
            </div>

            <form action="{{ route('clients.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">First Name</label>
                        <input type="text" name="first_name" placeholder="e.g. John" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm placeholder:text-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Last Name</label>
                        <input type="text" name="last_name" placeholder="e.g. Doe" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm placeholder:text-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Telephone</label>
                        <input type="text" name="telephone_no" placeholder="0123-456-789" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm placeholder:text-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Email Address</label>
                        <input type="email" name="email" placeholder="john.doe@example.com" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm placeholder:text-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Residential Address</label>
                        <input type="text" name="address" placeholder="123 Dream Lane, City, Postcode" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm placeholder:text-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Preferred Property Type</label>
                        <select name="prefer_type" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition appearance-none">
                            <option value="" disabled selected class="bg-[#0f172a]">Select Type...</option>
                            <option value="House" class="bg-[#0f172a]">House</option>
                            <option value="Flat" class="bg-[#0f172a]">Flat</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-cyan-400 uppercase font-bold tracking-widest ml-1">Max Monthly Budget ($)</label>
                        <input type="number" name="max_rent" step="0.01" placeholder="0.00" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition font-bold text-emerald-400">
                    </div>
                </div>

                <div class="pt-8 flex justify-end gap-4 border-t border-white/10 mt-8">
                    <button type="reset" class="text-gray-400 text-[10px] uppercase font-bold tracking-[0.2em] px-6 hover:text-white transition">
                        Clear Form
                    </button>
                    <button type="submit" class="bg-white text-black px-10 py-3 rounded-full text-[10px] uppercase font-bold tracking-[0.2em] hover:bg-cyan-400 transition duration-300 shadow-xl shadow-white/5">
                        Create Entry
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>