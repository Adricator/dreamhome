<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($branch) ? 'Edit Branch' : 'Register Branch' }} - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="glass-card rounded-3xl p-10 border-amber-500/20">
            
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h1 class="font-dream text-4xl text-[#d1dcd5]">
                        {{ isset($branch) ? 'edit branch' : 'register branch' }}
                    </h1>
                    <p class="text-amber-500 text-[10px] uppercase tracking-widest mt-2 font-bold">
                        {{ isset($branch) ? "Modifying Branch: " . $branch->branch_id : "Establishing new location" }}
                    </p>
                </div>
                @if(isset($branch))
                <span class="text-[10px] px-4 py-2 bg-white/5 rounded-full border border-white/10 uppercase tracking-tighter">
                    ID: {{ $branch->branch_id }}
                </span>
                @endif
            </div>

            <form action="{{ isset($branch) ? route('branches.update', $branch->branch_id) : route('branches.store') }}" method="POST" class="space-y-8">
                @csrf
                @if(isset($branch)) @method('PUT') @endif
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Location Details</label>
                        
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Street Address</span>
                            <textarea name="street" rows="2" class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-amber-500 focus:outline-none transition">{{ old('street', $branch->street ?? '') }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">City</span>
                                <input type="text" name="city" value="{{ old('city', $branch->city ?? '') }}" class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-amber-500 focus:outline-none transition">
                            </div>
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">Postcode</span>
                                <input type="text" name="postcode" value="{{ old('postcode', $branch->postcode ?? '') }}" class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-amber-500 focus:outline-none transition">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Communication & Area</label>
                        
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Region / Area</span>
                            <input type="text" name="area" value="{{ old('area', $branch->area ?? '') }}" class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-amber-500 focus:outline-none transition">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">Telephone</span>
                                <input type="text" name="telephone_no" value="{{ old('telephone_no', $branch->telephone_no ?? '') }}" class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-amber-500 focus:outline-none transition">
                            </div>
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">Fax Number</span>
                                <input type="text" name="fax_no" value="{{ old('fax_no', $branch->fax_no ?? '') }}" class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-amber-500 focus:outline-none transition">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-white/10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold block mb-2">Branch Registration ID</label>
                            <input type="text" name="branch_id" value="{{ old('branch_id', $branch->branch_id ?? '') }}" 
                                   class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-amber-500 focus:outline-none transition"
                                   {{ isset($branch) ? 'readonly' : '' }}>
                            @if(isset($branch))
                                <p class="text-[8px] text-gray-500 mt-1 ml-2">* Unique Identifier cannot be changed once registered.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="bg-amber-500 hover:bg-amber-400 text-black px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg">
                        {{ isset($branch) ? 'Update Branch' : 'Confirm Registration' }}
                    </button>
                    <a href="{{ route('branches.index') }}" class="border border-white/20 hover:bg-white/5 px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg flex items-center">
                        Back to List
                    </a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>