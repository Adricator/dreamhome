<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Owner - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="text-white min-h-screen bg-[#0a0a0a]">

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="glass-card rounded-3xl p-10 border border-amber-500/20 bg-white/5 backdrop-blur-md">
            
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h1 class="font-dream text-4xl text-[#d1dcd5] lowercase">edit owner</h1>
                    <p class="text-amber-500 text-[10px] uppercase tracking-widest mt-2 font-bold">
                        Modifying Profile: {{ $owner->owner_id }}
                    </p>
                </div>
                <span class="text-[10px] px-4 py-2 bg-white/5 rounded-full border border-white/10 uppercase tracking-tighter">
                    Type: Private Owner
                </span>
            </div>

            <form action="{{ route('owners.update', $owner->owner_id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="owner_id" value="{{ $owner->owner_id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Personal Information</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">First Name</span>
                                <input type="text" name="first_name" value="{{ $owner->first_name }}" 
                                    class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-cyan-400 outline-none transition-all">
                            </div>
                            <div class="space-y-1">
                                <span class="text-[9px] text-gray-500 uppercase ml-2">Last Name</span>
                                <input type="text" name="last_name" value="{{ $owner->last_name }}" 
                                    class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-cyan-400 outline-none transition-all">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Street Address</span>
                            <input type="text" name="address" value="{{ $owner->address }}" 
                                class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-cyan-400 outline-none transition-all">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Contact Details</label>
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Phone Number</span>
                            <input type="text" name="tel_no" value="{{ $owner->tel_no }}" 
                                class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-cyan-400 outline-none transition-all">
                        </div>
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Email Address</span>
                            <input type="email" name="email" value="{{ $owner->email }}" 
                                class="w-full bg-white/5 border border-white/10 p-4 rounded-xl focus:ring-1 focus:ring-cyan-400 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-white/10">
                    <div class="flex flex-col md:flex-row gap-4">
                        <button type="submit" class="bg-amber-500 hover:bg-amber-400 text-black px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg">
                            Update Owner Profile
                        </button>
                        <a href="{{ route('owners.index') }}" class="border border-white/20 hover:bg-white/5 px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg flex items-center justify-center">
                            Cancel Changes
                        </a>
                    </div>
                </div>
            </form>
            
        </div>
    </main>
</body>
</html>