<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Staff - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<body>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="glass-card rounded-3xl p-10 border-amber-500/20">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h1 class="font-dream text-4xl text-[#d1dcd5]">edit staff</h1>
                    <p class="text-amber-500 text-[10px] uppercase tracking-widest mt-2 font-bold">Modifying Member: {{ $staff->staff_id }}</p>
                </div>
                <span class="text-[10px] px-4 py-2 bg-white/5 rounded-full border border-white/10 uppercase tracking-tighter">
                    Position: {{ $staff->position }}
                </span>
            </div>

            <form action="{{ route('staff.update', $staff->staff_id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Personal Info -->
                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Personal Information</label>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="first_name" value="{{ $staff->first_name }}" placeholder="First Name" class="w-full p-4 rounded-xl">
                            <input type="text" name="last_name" value="{{ $staff->last_name }}" placeholder="Last Name" class="w-full p-4 rounded-xl">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <select name="sex" class="w-full p-4 rounded-xl">
                                <option value="male" {{ $staff->sex == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $staff->sex == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <input type="date" name="dob" value="{{ $staff->dob }}" class="w-full p-4 rounded-xl">
                        </div>
                    </div>

                    <!-- Professional Info -->
                    <div class="space-y-4">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Professional Details</label>
                        <input type="text" name="position" value="{{ $staff->position }}" placeholder="Position" class="w-full p-4 rounded-xl">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="0.01" name="salary" value="{{ $staff->salary }}" placeholder="Salary" class="w-full p-4 rounded-xl">
                            <input type="text" name="telephone_no" value="{{ $staff->telephone_no }}" placeholder="Telephone" class="w-full p-4 rounded-xl">
                        </div>
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="pt-8 border-t border-white/10">
                    <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold block mb-4">Identification & Location</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                         <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">National Insurance Number (NIN)</span>
                            <input type="text" name="nin" value="{{ $staff->nin }}" class="w-full p-4 rounded-xl">
                        </div>
                        <div class="space-y-1">
                            <span class="text-[9px] text-gray-500 uppercase ml-2">Branch ID</span>
                            <input type="text" name="branch_id" value="{{ $staff->branch_id }}" class="w-full p-4 rounded-xl">
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="bg-amber-500 hover:bg-amber-400 text-black px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg">
                        Save Changes
                    </button>
                    <a href="{{ route('staff.index') }}" class="border border-white/20 hover:bg-white/5 px-10 py-4 text-xs font-bold uppercase tracking-widest transition-all rounded-lg flex items-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>