<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inspection Details - Dream Home</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inspections.css') }}">
    
    <style>
        body { font-family: 'montserrat', sans-serif; }
    </style>
</head>
<<<<<<< HEAD

<body class="bg-[#0f1523] text-white min-h-screen p-8 flex justify-center items-start pt-16">

    <main class="w-full max-w-[900px]">

        <div class="mb-8">
            <a href="{{ route('inspections.index') }}" class="text-cyan-400 text-sm font-bold tracking-[0.15em] uppercase hover:text-cyan-300 transition-colors flex items-center gap-2">
                <span>&larr;</span> Back to list
=======
<body>
<main class="inspection-show-container">

    <div class="inspection-show-header">
        <div>
            <h1 class="inspection-show-title">Inspection Details</h1>
            <p class="inspection-show-subtitle">Inspection #{{ $inspection->inspection_id }}</p>
        </div>

        <span class="inspection-id-badge">
            {{ $inspection->date
                ? \Carbon\Carbon::parse($inspection->date)->format('M d, Y')
                : 'No Date'
            }}
        </span>
    </div>

    @if(session('success'))
        <div class="inspection-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="inspection-show-card">

        <div class="inspection-show-grid">

            <div class="inspection-show-item">
                <span>Property ID</span>
                <p>{{ $inspection->property_id }}</p>
            </div>

            <div class="inspection-show-item">
                <span>Staff ID</span>
                <p>{{ $inspection->staff_id }}</p>
            </div>

            <div class="inspection-show-item">
                <span>Inspection Date</span>
                <p>
                    {{ $inspection->date
                        ? \Carbon\Carbon::parse($inspection->date)->format('M d, Y')
                        : 'No Date'
                    }}
                </p>
            </div>

        </div>

        <hr class="inspection-divider">

        <div class="inspection-show-comments">
            <span>Comment</span>
            <p>{{ $inspection->comment ?? 'No comment provided.' }}</p>
        </div>

        <div class="inspection-show-actions">

            <a href="{{ route('inspections.index') }}" class="inspection-cancel-btn">
                Back
>>>>>>> 16cb75eea5500eace47c0e997143c6b567fb5520
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-900/50 border border-green-500 text-green-200 px-6 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#1e2634] rounded-3xl p-12 shadow-2xl border border-slate-700/40">

            <div class="inline-block px-5 py-1.5 rounded-full bg-[#163a4a] text-cyan-400 text-xs font-bold tracking-widest mb-6">
                INS{{ str_pad($inspection->inspection_id, 3, '0', STR_PAD_LEFT) }}
            </div>

            <h1 class="text-5xl font-bold mb-12 tracking-tight text-white">Inspection Details</h1>

            <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-12">

                <div class="flex-1 space-y-8">
                    <div>
                        <h3 class="text-slate-400 text-[10px] font-bold tracking-widest uppercase mb-3">Property ID</h3>
                        <p class="text-xl text-gray-100">{{ $inspection->property_id }}</p>
                    </div>

                    <div>
                        <h3 class="text-slate-400 text-[10px] font-bold tracking-widest uppercase mb-3">Staff ID</h3>
                        <p class="text-xl text-gray-100">{{ $inspection->staff_id }}</p>
                    </div>

                    <div>
                        <h3 class="text-slate-400 text-[10px] font-bold tracking-widest uppercase mb-3">Inspection Date</h3>
                        <p class="text-xl text-gray-100">
                            {{ $inspection->inspection_date 
                                ? \Carbon\Carbon::parse($inspection->inspection_date)->format('M d, Y') 
                                : 'No Date' 
                            }}
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-[380px] bg-[#283243] rounded-2xl p-8 border border-slate-600/20 flex flex-col justify-center items-center text-center shadow-inner">
                    <h3 class="text-cyan-500 text-[10px] font-bold tracking-widest uppercase mb-6">Inspection Comments</h3>
                    
                    <p class="text-1xl font-light text-white mb-8">
                        {{ $inspection->comments ?? 'No comment provided.' }}
                    </p>

                    <div class="w-full px-4 py-3 rounded-lg border border-[#3b4c5e] text-cyan-400 text-xs font-bold tracking-widest uppercase bg-[#212c3b] cursor-default">
                        Status: Logged
                    </div>
                </div>

            </div>

            <hr class="border-slate-700/60 mb-8">

            <div class="flex justify-between items-center">
                
                <a href="{{ route('inspections.edit', $inspection) }}" class="bg-white text-black px-8 py-3.5 rounded-lg font-bold text-xs tracking-[0.15em] uppercase hover:bg-gray-200 transition-colors shadow-md">
                    Edit Record
                </a>

                <form action="{{ route('inspections.destroy', $inspection) }}" method="POST" onsubmit="return confirm('Delete this inspection?')" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-[#e26d6d] font-bold text-xs tracking-[0.15em] uppercase hover:text-red-400 transition-colors">
                        Delete Record
                    </button>
                </form>

            </div>

        </div>

    </main>

</body>
</html>