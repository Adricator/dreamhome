<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Branch Details - {{ $branch->city }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/branches.css') }}">
</head>

<!-- <body class="bg-[#0a0f14] text-white font-montserrat">
    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="mb-8">
            <a href="{{ route('branches.index') }}" class="text-cyan-400 text-[10px] uppercase font-bold tracking-[0.2em] hover:text-white transition">
                ← Back to Directory
            </a>
        </div>

        <div class="glass-card rounded-3xl p-10 overflow-hidden relative border border-white/10 bg-white/5 backdrop-blur-xl">
            <div class="absolute top-0 right-0 px-8 py-2 bg-cyan-500 text-black text-[10px] font-bold uppercase tracking-widest rounded-bl-2xl">
                Active Branch
            </div>

            <div class="mb-12">
                <span class="data-label text-gray-500 text-[10px] uppercase tracking-widest">Branch Profile: {{ $branch->branch_id ?? 'N/A' }}</span>
                <h1 class="font-dream text-5xl text-[#d1dcd5] mt-2">{{ $branch->city }}</h1>
                <p class="text-gray-400 uppercase tracking-[0.3em] text-sm mt-2">{{ $branch->area }} Regional Office</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
                <div class="space-y-8">
                    <div>
                        <span class="data-label text-gray-500 text-[10px] uppercase tracking-widest">Physical Address</span>
                        <p class="text-2xl font-light text-white leading-relaxed mt-2">
                            {{ $branch->street }}<br>
                            <span class="text-cyan-400">{{ $branch->city }}, {{ $branch->postcode }}</span>
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <span class="data-label text-gray-500 text-[10px] uppercase tracking-widest">Telephone</span>
                            <p class="text-lg font-semibold text-white mt-1">{{ $branch->telephone_no }}</p>
                        </div>
                        <div>
                            <span class="data-label text-gray-500 text-[10px] uppercase tracking-widest">Fax Line</span>
                            <p class="text-lg font-semibold text-white/60 mt-1">{{ $branch->fax_no }}</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-8 bg-white/5 p-8 rounded-2xl border border-white/5">
                    <div>
                        <span class="data-label text-gray-500 text-[10px] uppercase tracking-widest">Management Area</span>
                        <p class="text-2xl text-cyan-400 mt-1">{{ $branch->area }}</p>
                    </div>
                    
                    <div class="pt-6 border-t border-white/10">
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest leading-relaxed">
                            This branch oversees property management and staff operations within the <span class="text-white">{{ $branch->city }}</span> metropolitan area.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-12 flex items-center justify-between pt-8 border-t border-white/10">
                <div class="flex gap-4">
                    <a href="{{ route('branches.edit', $branch) }}" class="bg-white text-black px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-cyan-400 transition rounded-lg">
                        Edit Branch
                    </a>
                </div>
                
                <form action="{{ route('branches.destroy', $branch) }}" method="POST" onsubmit="return confirm('Permanent action: Delete this branch office?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-400 text-[10px] uppercase font-bold tracking-[0.2em] transition">
                        Remove Branch
                    </button>
                </form>
            </div>
        </div>
    </main>
</body> -->
<body style="background-color: #0a0f14;">
    <main class="branch-show-main">

    <div class="branch-back-container">
        <a href="{{ route('branches.index') }}" class="branch-back-link">
            ← Back to Directory
        </a>
    </div>

    <div class="branch-show-card">

        <div class="branch-status-badge">
            Active Branch
        </div>

        <div class="branch-show-header">

            <span class="branch-profile-label">
                Branch Profile: {{ $branch->branch_id ?? 'N/A' }}
            </span>

            <h1 class="branch-show-title">
                {{ $branch->city }}
            </h1>

            <p class="branch-show-subtitle">
                {{ $branch->area }} Regional Office
            </p>

        </div>

        <div class="branch-show-grid">

            <div class="branch-show-left">

                <div>
                    <span class="branch-section-label">
                        Physical Address
                    </span>

                    <p class="branch-address">
                        {{ $branch->street }}<br>

                        <span class="branch-address-highlight">
                            {{ $branch->city }}, {{ $branch->postcode }}
                        </span>
                    </p>
                </div>

                <div class="branch-show-manager">

                    <span class="branch-show-manager-label">
                        Branch Manager
                    </span>

                    @if($branch->manager)

                        <div class="branch-show-manager-info">

                            <span class="branch-show-manager-name">
                                {{ $branch->manager->first_name }}
                                {{ $branch->manager->last_name }}
                            </span>

                            <span class="branch-show-manager-id">
                                {{ $branch->manager->staff_id }}
                            </span>

                        </div>

                    @else

                        <span class="branch-manager-empty">
                            No manager assigned
                        </span>

                    @endif

                </div>

                <div class="branch-contact-grid">

                    <div>
                        <span class="branch-section-label">
                            Telephone
                        </span>

                        <p class="branch-contact-text">
                            {{ $branch->telephone_no }}
                        </p>
                    </div>

                    <div>
                        <span class="branch-section-label">
                            Fax Line
                        </span>

                        <p class="branch-contact-muted">
                            {{ $branch->fax_no }}
                        </p>
                    </div>

                </div>

            </div>

            <div class="branch-management-card">

                <div>
                    <span class="branch-section-label">
                        Management Area
                    </span>

                    <p class="branch-management-area">
                        {{ $branch->area }}
                    </p>
                </div>

                <div class="branch-management-description">
                    <p>
                        This branch oversees property management and staff operations within the
                        <span>{{ $branch->city }}</span>
                        metropolitan area.
                    </p>
                </div>

            </div>

        </div>

        <div class="branch-show-actions">

            <div class="branch-show-buttons">
                <a href="{{ route('branches.edit', $branch) }}" class="branch-edit-button">
                    Edit Branch
                </a>
            </div>

            <form action="{{ route('branches.destroy', $branch) }}"
                method="POST"
                onsubmit="return confirm('Permanent action: Delete this branch office?');">

                @csrf
                @method('DELETE')

                <button type="submit" class="branch-delete-button">
                    Remove Branch
                </button>

            </form>

        </div>

    </div>

    </main>
</body>
</html>