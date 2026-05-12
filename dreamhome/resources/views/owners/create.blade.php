<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owners - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="text-white min-h-screen">


<div class="max-w-2xl mx-auto bg-white/5 backdrop-blur-xl border border-white/10 p-10 rounded-3xl">
    <h2 class="text-2xl font-bold mb-8 border-b border-white/10 pb-4">Register New Owner</h2>
    
    <form action="{{ route('owners.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-[10px] uppercase tracking-widest text-gray-400">First Name</label>
                <input type="text" name="first_name" class="bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-1 focus:ring-cyan-400 outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-[10px] uppercase tracking-widest text-gray-400">Last Name</label>
                <input type="text" name="last_name" class="bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-1 focus:ring-cyan-400 outline-none">
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-[10px] uppercase tracking-widest text-gray-400">Owner ID</label>
            <input type="text" name="owner_id" placeholder="e.g. CO123" class="bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-1 focus:ring-cyan-400 outline-none">
        </div>

        <div class="flex flex-col gap-2">
            <label class="text-[10px] uppercase tracking-widest text-gray-400">Address</label>
            <textarea name="address" rows="3" class="bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-1 focus:ring-cyan-400 outline-none"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-[10px] uppercase tracking-widest text-gray-400">Telephone</label>
                <input type="text" name="telephone_no" class="bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-1 focus:ring-cyan-400 outline-none">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-[10px] uppercase tracking-widest text-gray-400">Email Address</label>
                <input type="email" name="email" class="bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-1 focus:ring-cyan-400 outline-none">
            </div>
        </div>

        <div class="pt-6 flex gap-4">
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-500 px-8 py-3 rounded-full text-xs font-bold uppercase tracking-widest transition">Save Owner</button>
            <a href="{{ route('owners.index') }}" class="px-8 py-3 rounded-full text-xs font-bold uppercase tracking-widest border border-white/20 hover:bg-white/10 transition text-center">Cancel</a>
        </div>
    </form>
</div>