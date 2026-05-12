<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Property - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #0a1518; color: white; }
        .font-dream { font-family: 'Comfortaa', cursive; }
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
        input, select { background: rgba(255,255,255,0.05) !important; border: 1px solid rgba(255,255,255,0.1) !important; color: white !important; outline: none; }
        input:focus { border-color: #22d3ee !important; }
    </style>
</head>
<body>

    <header class="w-full pt-8 flex justify-center sticky top-0 z-50">
        <nav class="inline-flex items-center bg-white/10 backdrop-blur-lg border border-white/20 rounded-full px-12 py-3">
            <div class="flex items-center gap-10 text-white uppercase font-bold text-[10px] tracking-[0.15em]">
                <a href="{{ url('/') }}" class="hover:text-gray-400">Home</a>
                <a href="{{ route('properties.index') }}" class="hover:text-gray-400">Properties</a>
                <a href="{{ url('/branches') }}" class="hover:text-gray-400">Branches</a>
                <a href="{{ url('/register') }}" class="hover:text-gray-400">Registration</a>
            </div>
        </nav>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="glass-card rounded-3xl p-10">
            <div class="mb-10">
                <h1 class="font-dream text-4xl text-[#d1dcd5]">add new property</h1>
                <p class="text-gray-500 text-xs uppercase tracking-widest mt-2">Enter the details to list a new estate</p>
            </div>

            <form action="{{ route('properties.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Primary Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-cyan-400 font-bold">Location</label>
                        <input type="text" name="street" placeholder="Street Address" class="w-full p-4 rounded-xl" required>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="city" placeholder="City" class="w-full p-4 rounded-xl">
                            <input type="text" name="postcode" placeholder="Postcode" class="w-full p-4 rounded-xl">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-cyan-400 font-bold">Specifications</label>
                        <div class="grid grid-cols-2 gap-4">
                            <select name="type" class="w-full p-4 rounded-xl">
                                <option value="House">House</option>
                                <option value="Flat">Flat</option>
                                <option value="Bungalow">Bungalow</option>
                            </select>
                            <input type="number" name="rooms" placeholder="Rooms" class="w-full p-4 rounded-xl">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" name="monthly_rent" placeholder="Rent (₱)" class="w-full p-4 rounded-xl">
                            <input type="text" name="area" placeholder="Area" class="w-full p-4 rounded-xl">
                        </div>
                    </div>
                </div>

                <!-- Management IDs -->
                <div class="pt-8 border-t border-white/10">
                    <label class="text-[10px] uppercase tracking-widest text-cyan-400 font-bold block mb-4">Management Assignment</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <input type="text" name="owner_id" placeholder="Owner ID" class="w-full p-4 rounded-xl">
                        <input type="text" name="staff_id" placeholder="Staff ID" class="w-full p-4 rounded-xl">
                        <input type="text" name="branch_id" placeholder="Branch ID" class="w-full p-4 rounded-xl">
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="bg-cyan-500 hover:bg-cyan-400 text-black px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg">
                        Publish Listing
                    </button>
                    <a href="{{ route('properties.index') }}" class="border border-white/20 hover:bg-white/5 px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg flex items-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>