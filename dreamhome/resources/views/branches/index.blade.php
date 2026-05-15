<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Branches - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/branches.css') }}">
    </head>
<body>
    
    <header class="navbar-container">
        <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('branches.index') }}" class="active">Branches</a>
                <a href="{{ route('staff.index') }}">Staff</a>
                <a href="{{ route('properties.index') }}">Properties</a>
                <a href="{{ route('owners.index') }}">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}">Clients</a>
                <a href="{{ url('/viewings') }}">Viewings</a>
                <a href="{{ url('/leases') }}">Leases</a>
            </div>
        </nav>
    </header>
    
      <!-- <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <h1 class="font-dream text-5xl text-[#d1dcd5] mb-4">branch directory</h1>
                <form action="{{ route('branches.index') }}" method="GET" class="flex flex-wrap gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by city or ID..." class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg text-sm w-64 focus:outline-none focus:ring-1 focus:ring-cyan-400 text-white placeholder-gray-400">
                    <button type="submit" class="bg-cyan-600 px-4 py-2 rounded-lg text-xs uppercase font-bold hover:bg-cyan-500 transition">Search</button>
                </form>
            </div>

            <a href="{{ route('branches.create') }}" class="border border-white px-6 py-2 text-[11px] font-semibold uppercase tracking-widest hover:bg-white hover:text-black transition">
                + New Branch
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($branches as $branch)
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 hover:border-white/40 transition-all group flex flex-col">
                
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[10px] bg-cyan-500/20 text-cyan-300 px-3 py-1 rounded-full uppercase tracking-tighter">
                        Branch ID: {{ $branch->branch_id }}
                    </span>
                </div>

                <div class="space-y-1 mb-4">
                    <h3 class="text-2xl font-semibold tracking-tight">{{ $branch->city }}</h3>
                    <p class="text-cyan-400 text-xs uppercase tracking-widest font-bold">{{ $branch->area }}</p>
                </div>

                <div class="grid grid-cols-1 gap-3 py-4 border-y border-white/10 my-4 text-[11px] uppercase tracking-wider text-gray-300">
                    <div>
                        <span class="text-gray-500 block mb-1">Street Address:</span> 
                        <span class="text-sm normal-case">{{ $branch->street }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block mb-1">Contact Number:</span> 
                        <span class="text-sm">{{ $branch->telephone_no }}</span>
                    </div>
                </div>

                <div class="mt-auto pt-4 flex justify-between items-center">
                    <div class="flex gap-4">
                        <a href="{{ route('branches.show', $branch->branch_id) }}" class="text-cyan-400 hover:text-white text-[10px] uppercase font-bold tracking-widest transition">View Details</a>
                        <a href="{{ route('branches.edit', $branch->branch_id) }}" class="text-white hover:text-cyan-400 text-[10px] uppercase font-bold tracking-widest transition">Edit</a>
                    </div>

                    <form action="{{ route('branches.destroy', $branch->branch_id) }}" method="POST" onsubmit="return confirm('Delete this branch?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 text-[10px] uppercase font-bold tracking-widest transition">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </main> -->

    <main class="branches-main">
        <div class="branches-header">
            <div>
                <h1 class="branches-title">branch directory</h1>

                <form action="{{ route('branches.index') }}" method="GET" class="branch-search-form">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by city or ID..."
                        class="branch-search-input">

                    <button type="submit" class="branch-search-button">
                        Search
                    </button>
                </form>
            </div>

            <a href="{{ route('branches.create') }}" class="new-branch-button">
                + New Branch
            </a>
        </div>

        <div class="branches-grid">
            @foreach($branches as $branch)

            <div class="branch-card">

                <div class="branch-card-top">
                    <span class="branch-id-badge">
                        Branch ID: {{ $branch->branch_id }}
                    </span>
                </div>

                <div class="branch-info">
                    <h3 class="branch-city">{{ $branch->city }}</h3>

                    <p class="branch-area">
                        {{ $branch->area }}
                    </p>
                </div>

                <div class="branch-details">

                    <div>
                        <span class="branch-label">
                            Street Address:
                        </span>

                        <span class="branch-value">
                            {{ $branch->street }}
                        </span>
                    </div>

                    <div>
                        <span class="branch-label">
                            Contact Number:
                        </span>

                        <span class="branch-value">
                            {{ $branch->telephone_no }}
                        </span>
                    </div>
                    <div class="branch-index-manager">

                        <span class="branch-manager-label">
                            Manager:
                        </span>

                        @if($branch->manager)

                            <div class="branch-manager-info">

                                <span class="branch-manager-name">
                                    {{ $branch->manager->first_name }}
                                    {{ $branch->manager->last_name }}
                                </span>

                                <span class="branch-manager-id">
                                    {{ $branch->manager->staff_id }}
                                </span>

                            </div>

                        @else

                            <span class="branch-manager-empty">
                                No manager assigned
                            </span>

                        @endif

                    </div>
                </div>
                
                <div class="branch-actions">

                    <div class="branch-links">
                        <a href="{{ route('branches.show', $branch->branch_id) }}" class="view-link">
                            View Details
                        </a>

                        <a href="{{ route('branches.edit', $branch->branch_id) }}" class="edit-link">
                            Edit
                        </a>
                    </div>

                    <form action="{{ route('branches.destroy', $branch->branch_id) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this branch?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete-link">
                            Delete
                        </button>
                    </form>
                </div>

            </div>

            @endforeach
        </div>
    </main>
</body>
</html>