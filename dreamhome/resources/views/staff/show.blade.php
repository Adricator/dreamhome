<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Profile - {{ $staff->first_name }} {{ $staff->last_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<body class="min-h-screen flex flex-col items-center justify-center">

    <main class="w-full max-w-3xl px-6 py-12">
        <!-- Profile Header -->
        <div class="flex flex-col md:flex-row items-center gap-8 mb-10">
            <div class="w-32 h-32 rounded-full bg-gradient-to-tr from-cyan-500 to-amber-500 flex items-center justify-center text-4xl font-bold border-4 border-white/10 shadow-2xl">
                {{ substr($staff->first_name, 0, 1) }}{{ substr($staff->last_name, 0, 1) }}
            </div>
            <div class="text-center md:text-left">
                <h1 class="font-dream text-5xl text-[#d1dcd5] mb-2">{{ $staff->first_name }} {{ $staff->last_name }}</h1>
                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                    <span class="bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 px-4 py-1 rounded-full text-[10px] uppercase font-bold tracking-widest">
                        {{ $staff->position }}
                    </span>
                    <span class="bg-white/5 text-gray-400 border border-white/10 px-4 py-1 rounded-full text-[10px] uppercase font-bold tracking-widest">
                        ID: {{ $staff->staff_id }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Detailed Information Card -->
        <div class="glass-card rounded-[2.5rem] p-10 space-y-10">
            
            <!-- Grid 1: Professional & Compensation -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <p class="data-label">Salary</p>
                        <p class="data-value text-2xl font-light text-amber-400">₱{{ number_format($staff->salary, 2) }}</p>
                    </div>
                    <div>
                        <p class="data-label">Date Joined</p>
                        <p class="data-value">{{ \Carbon\Carbon::parse($staff->date_joined)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="data-label">Branch Assignment</p>
                        <p class="data-value">{{ $staff->branch_id }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="data-label">Contact Number</p>
                        <p class="data-value">{{ $staff->telephone_no }}</p>
                    </div>
                    <div>
                        <p class="data-label">Position Type</p>
                        <p class="data-value">{{ $staff->position }}</p>
                    </div>
                    <div>
                        <p class="data-label">Insurance (NIN)</p>
                        <p class="data-value font-mono tracking-tighter">{{ $staff->nin }}</p>
                    </div>
                </div>
            </div>

            <hr class="border-white/10">

            <!-- Grid 2: Personal Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <p class="data-label">Gender</p>
                    <p class="data-value capitalize">{{ $staff->sex }}</p>
                </div>
                <div>
                    <p class="data-label">Date of Birth</p>
                    <p class="data-value">{{ \Carbon\Carbon::parse($staff->dob)->format('M d, Y') }}</p>
                </div>
                 <div>
                    <p class="data-label">Properties Managed</p>
                    <p class="data-value">{{ $staff->properties->count() }} Listings</p>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="{{ route('staff.edit', $staff->staff_id) }}" class="bg-amber-500 hover:bg-amber-400 text-black px-8 py-3 text-[10px] font-bold uppercase tracking-widest transition-all rounded-full">
                    Edit Staff Member
                </a>
                <a href="{{ route('staff.index') }}" class="border border-white/20 hover:bg-white/5 px-8 py-3 text-[10px] font-bold uppercase tracking-widest transition-all rounded-full">
                    Return to Directory
                </a>
                
                <form action="{{ route('staff.destroy', $staff->staff_id) }}" method="POST" onsubmit="return confirm('Archive this staff record?');" class="ml-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-500 text-[10px] uppercase font-bold tracking-widest px-4 py-3">
                        Delete Record
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>