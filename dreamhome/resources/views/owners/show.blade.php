<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owners - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<body class="text-white min-h-screen">

<main class="max-w-4xl mx-auto px-6 py-16">
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('owners.index') }}" class="text-cyan-400 text-xs uppercase font-bold tracking-widest">← Back to List</a>
    </div>

    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden">
        <div class="p-12">
            <div class="flex justify-between items-start mb-12">
                <div>
                    <span class="text-xs bg-cyan-500/20 text-cyan-400 px-4 py-1 rounded-full uppercase font-bold tracking-tighter">{{ $owner->owner_id }}</span>
                    <h1 class="text-5xl font-bold mt-4">{{ $owner->first_name }} {{ $owner->last_name }}</h1>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('owners.edit', $owner) }}" class="border border-white/20 px-6 py-2 rounded-lg text-[10px] uppercase font-bold hover:bg-white hover:text-black transition">Edit</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="space-y-6">
                    <div>
                        <h4 class="text-[10px] uppercase tracking-[0.2em] text-gray-500 mb-2">Contact Information</h4>
                        <p class="text-lg">{{ $owner->telephone_no }}</p>
                        <p class="text-cyan-400">{{ $owner->email }}</p>
                    </div>
                    <div>
                        <h4 class="text-[10px] uppercase tracking-[0.2em] text-gray-500 mb-2">Primary Address</h4>
                        <p class="text-gray-300 leading-relaxed">{{ $owner->address }}</p>
                    </div>
                </div>
                
                <div class="bg-white/5 rounded-2xl p-6 border border-white/5">
                    <h4 class="text-[10px] uppercase tracking-[0.2em] text-cyan-400 mb-4">Quick Stats</h4>
                    <div class="text-3xl font-light mb-1">04</div>
                    <div class="text-[10px] uppercase text-gray-500 tracking-widest">Properties Owned</div>
                </div>
            </div>
        </div>
    </div>
</div>