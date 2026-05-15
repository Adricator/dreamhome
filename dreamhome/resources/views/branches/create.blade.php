<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Branch - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <style>
        /* Using the styles from your Staff module reference */
        body { font-family: 'Montserrat', sans-serif; background-color: #0a1518; color: white; }
        .font-dream { font-family: 'Comfortaa', cursive; }
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
        input, textarea { background: rgba(255,255,255,0.05) !important; border: 1px solid rgba(255,255,255,0.1) !important; color: white !important; outline: none; }
        input:focus, textarea:focus { border-color: #22d3ee !important; } /* Cyan focus to match Staff Create */
    </style>
</head>
<body>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="glass-card rounded-3xl p-10 border-cyan-500/20">
            
            <div class="mb-10">
                <h1 class="font-dream text-4xl text-[#d1dcd5]">register new branch</h1>
                <p class="text-cyan-400 text-[10px] uppercase tracking-widest mt-2 font-bold">Establishing a new physical location for the directory</p>
            </div>

            <form action="{{ route('branches.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Location Details</label>
                        
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Street Address</span>
                            <textarea name="street" rows="2" placeholder="e.g., 163 Main St" class="w-full p-4 rounded-xl transition">{{ old('street') }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">City</span>
                                <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="w-full p-4 rounded-xl transition">
                            </div>
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">Postcode</span>
                                <input type="text" name="postcode" value="{{ old('postcode') }}" placeholder="Postcode" class="w-full p-4 rounded-xl transition">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Contact & Region</label>
                        
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Region / Area</span>
                            <input type="text" name="area" value="{{ old('area') }}" placeholder="e.g., London" class="w-full p-4 rounded-xl transition">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">Telephone</span>
                                <input type="text" name="telephone_no" value="{{ old('telephone_no') }}" placeholder="Phone No." class="w-full p-4 rounded-xl transition">
                            </div>
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">Fax Number</span>
                                <input type="text" name="fax_no" value="{{ old('fax_no') }}" placeholder="Fax No." class="w-full p-4 rounded-xl transition">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-white/10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold block mb-2">Branch Registration ID</label>
                            <input type="text" name="branch_id" value="{{ old('branch_id') }}" 
                                   placeholder="e.g., B005"
                                   class="w-full p-4 rounded-xl transition">
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="bg-cyan-500 hover:bg-cyan-400 text-black px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg">
                        Confirm Registration
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