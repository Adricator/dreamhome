<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Inspection - Dream Home</title>
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
        <h1 class="text-3xl font-bold font-['montserrat'] tracking-wide mb-8 text-center text-white lowercase">edit inspection record #{{ $inspection->inspection_id }}</h1>

        <form action="{{ route('inspections.update', $inspection) }}" method="POST" class="space-y-6 text-slate-200">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs uppercase tracking-wider mb-2 font-bold">Property ID</label>
                <input type="text" name="property_id" value="{{ $inspection->property_id }}" required class="w-full bg-black/30 border border-white/20 rounded-xl p-3 focus:outline-none focus:border-white/60 text-white">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider mb-2 font-bold">Inspection Date</label>
                <input type="date" name="inspection_date" value="{{ $inspection->inspection_date->format('Y-m-23') }}" required class="w-full bg-black/30 border border-white/20 rounded-xl p-3 focus:outline-none focus:border-white/60 text-white">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider mb-2 font-bold">Assigned Staff ID</label>
                <input type="text" name="staff_id" value="{{ $inspection->staff_id }}" required class="w-full bg-black/30 border border-white/20 rounded-xl p-3 focus:outline-none focus:border-white/60 text-white">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider mb-2 font-bold">Inspection Comments / Notes</label>
                <textarea name="comments" rows="4" class="w-full bg-black/30 border border-white/20 rounded-xl p-3 focus:outline-none focus:border-white/60 text-white">{{ $inspection->comments }}</textarea>
            </div>

            <div class="flex items-center justify-between pt-4">
                <button type="button" onclick="document.getElementById('delete-form').submit();" class="text-red-400 hover:text-red-300 text-sm font-semibold underline">Delete Log Entry</button>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('inspections.index') }}" class="text-sm opacity-70 hover:opacity-100 transition">Cancel</a>
                    <button type="submit" class="bg-white text-black font-bold font-['montserrat'] px-6 py-3 rounded-full hover:bg-neutral-200 transition">Update Log</button>
                </div>
            </div>
        </form>

        <form id="delete-form" action="{{ route('inspections.destroy', $inspection) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </main>
</body>
</html>