<!DOCTYPE html>
<html lang="en">
<head>
    <!-- (Same Head as Edit) -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Staff - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #0a1518; color: white; }
        .font-dream { font-family: 'Comfortaa', cursive; }
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
        input, select { background: rgba(255,255,255,0.05) !important; border: 1px solid rgba(255,255,255,0.1) !important; color: white !important; outline: none; }
        input:focus { border-color: #22d3ee !important; } /* Cyan focus for Create */
    </style>
</head>
<body>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="glass-card rounded-3xl p-10 border-cyan-500/20">
            <div class="mb-10">
                <h1 class="font-dream text-4xl text-[#d1dcd5]">add new staff</h1>
                <p class="text-cyan-400 text-[10px] uppercase tracking-widest mt-2 font-bold">Enter the details of the new team member</p>
            </div>

            <form action="{{ route('staff.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Identity Section -->
                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Staff Identity</label>
                        <input type="text" name="staff_id" placeholder="Staff ID (e.g., SL21)" class="w-full p-4 rounded-xl">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="first_name" placeholder="First Name" class="w-full p-4 rounded-xl">
                            <input type="text" name="last_name" placeholder="Last Name" class="w-full p-4 rounded-xl">
                        </div>
                    </div>

                    <!-- Job Section -->
                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Employment Details</label>
                        <input type="text" name="position" placeholder="Position (e.g., Manager)" class="w-full p-4 rounded-xl">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="0.01" name="salary" placeholder="Monthly Salary" class="w-full p-4 rounded-xl">
                            <input type="date" name="date_joined" class="w-full p-4 rounded-xl">
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="pt-8 border-t border-white/10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">NIN</span>
                            <input type="text" name="nin" placeholder="Insurance No" class="w-full p-4 rounded-xl">
                        </div>
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Sex</span>
                            <select name="sex" class="w-full p-4 rounded-xl bg-[#0f172a] ">
                                <option value="male" class="bg-[#0f172a]">Male</option>
                                <option value="female" class="bg-[#0f172a]">Female</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Branch</span>
                            <input type="text" name="branch_id" placeholder="B00x" class="w-full p-4 rounded-xl">
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="bg-cyan-500 hover:bg-cyan-400 text-black px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg">
                        Register Staff
                    </button>
                    <a href="{{ route('staff.index') }}" class="border border-white/20 hover:bg-white/5 px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg flex items-center">
                        Back to List
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>