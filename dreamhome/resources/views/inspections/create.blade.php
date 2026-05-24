<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Inspection - Dream Home</title>
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
        <h1 class="text-3xl font-bold font-['montserrat'] tracking-wide mb-8 text-center text-white lowercase">schedule/log inspection</h1>

        <form action="{{ route('inspections.store') }}" method="POST" class="space-y-6 text-slate-200">
            @csrf

            <div>
                <label class="block text-xs uppercase tracking-wider mb-2 font-bold">Property ID</label>
                <input type="text" name="property_id" required class="w-full bg-black/30 border border-white/20 rounded-xl p-3 focus:outline-none focus:border-white/60 text-white">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider mb-2 font-bold">Inspection Date</label>
                <input type="date" name="inspection_date" required class="w-full bg-black/30 border border-white/20 rounded-xl p-3 focus:outline-none focus:border-white/60 text-white">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider mb-2 font-bold">Assigned Staff ID</label>
                <input type="text" name="staff_id" required class="w-full bg-black/30 border border-white/20 rounded-xl p-3 focus:outline-none focus:border-white/60 text-white">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider mb-2 font-bold">Inspection Comments / Notes</label>
                <textarea name="comments" rows="4" class="w-full bg-black/30 border border-white/20 rounded-xl p-3 focus:outline-none focus:border-white/60 text-white"></textarea>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('inspections.index') }}" class="text-sm opacity-70 hover:opacity-100 transition">Cancel</a>
                <button type="submit" class="bg-white text-black font-bold font-['montserrat'] px-6 py-3 rounded-full hover:bg-neutral-200 transition">Save Log</button>
            </div>
        </form>
    </main>
</body>
</html>