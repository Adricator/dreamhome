<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inspection View - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
</head>
<body style="color:white;">
    <header class="navbar-container">
        <nav class="navbar"><div class="navbar-links"><a href="{{ route('dashboard') }}">Home</a><a href="{{ route('inspections.index') }}" class="active">Inspections</a></div></nav>
    </header>

    <main class="max-w-2xl mx-auto mt-12 p-8 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-xl m-4">
        <div class="flex justify-between items-start mb-6">
            <div>
                <span class="text-xs font-bold uppercase px-3 py-1 bg-white/20 rounded-full tracking-wider">Log ID: {{ $inspection->inspection_id }}</span>
                <h1 class="text-3xl font-bold font-['montserrat'] tracking-wide mt-3 text-white lowercase">inspection summary</h1>
            </div>
            <a href="{{ route('inspections.edit', $inspection) }}" class="border border-white/40 text-sm font-bold font-['montserrat'] px-4 py-2 rounded-full hover:bg-white/10 transition">Edit Record</a>
        </div>

        <div class="border-t border-white/10 pt-6 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-black/20 p-4 rounded-xl">
                    <span class="block text-neutral-400 text-xs uppercase font-bold tracking-wider mb-1">Target Property ID</span>
                    <span class="text-lg font-semibold text-white">{{ $inspection->property_id }}</span>
                </div>
                <div class="bg-black/20 p-4 rounded-xl">
                    <span class="block text-neutral-400 text-xs uppercase font-bold tracking-wider mb-1">Inspected Date</span>
                    <span class="text-lg font-semibold text-white">{{ $inspection->inspection_date->format('F d, Y') }}</span>
                </div>
            </div>

            <div class="bg-black/20 p-4 rounded-xl">
                <span class="block text-neutral-400 text-xs uppercase font-bold tracking-wider mb-1">Inspector Assigned (Staff ID)</span>
                <span class="text-lg font-semibold text-amber-300">{{ $inspection->staff_id }}</span>
            </div>

            <div class="bg-black/20 p-4 rounded-xl">
                <span class="block text-neutral-400 text-xs uppercase font-bold tracking-wider mb-1">Internal Remarks & Comments</span>
                <p class="text-white mt-2 leading-relaxed whitespace-pre-line">{{ $inspection->comments ?? 'No notes appended to this file entry.' }}</p>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('inspections.index') }}" class="text-sm opacity-70 hover:opacity-100 transition underline">← Back to Overview Directory</a>
        </div>
    </main>
</body>
</html>