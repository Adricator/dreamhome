<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dream Home</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>

<body class="antialiased bg-black overflow-hidden">
    <div class="relative min-h-screen w-full flex flex-col">


        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            {{-- Use asset() helper to ensure the path is correct in Laravel --}}
            <img src="{{ asset('images/welcomebg.jpg') }}" alt="Modern Architecture" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-overlay"></div>
        </div>



        <!-- Navigation -->

        <header class="relative z-50 w-full pt-8 px-10 flex items-center">
    
    <div class="flex-1 flex justify-start">
        <a href="{{ url('/search') }}" class="group flex items-center justify-center w-10 h-10 bg-white/10 backdrop-blur-md border border-white/20 rounded-full hover:bg-white/20 transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-5 h-5 group-hover:scale-110 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </a>
    </div>

   <nav class="navbar">
            <div class="navbar-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('branches.index') }}" >Branches</a>
                <a href="{{ route('staff.index') }}" >Staff</a>
                <a href="{{ route('properties.index') }}">Properties</a>
                <a href="{{ route('owners.index') }}">Owners</a>
                <a href="{{ url('/inspections') }}">Inspections</a>
                <a href="{{ url('/clients') }}">Clients</a>
                <a href="{{ url('/viewings') }}">Viewings</a>
                <a href="{{ url('/leases') }}">Leases</a>
            </div>
        </nav>

    <div class="flex-1 flex justify-end items-center gap-6">
         @if (Route::has('login'))
    @auth
        <a href="{{ url('/dashboard') }}" class="text-white text-[8px] tracking-widest font-bold uppercase border border-white px-3 py-1.5 rounded-full hover:bg-white hover:text-black transition-all">Dashboard</a>
     @endauth   
    @endif
    </div>
</header>



        <!-- Main Content -->

        <main class="relative z-10 flex-1 flex flex-col justify-center px-12 md:px-32 lg:px-48">

            <div class="flex flex-col">

                <h1 class="font-dream text-[#d1dcd5] text-[120px] md:text-[170px] leading-[0.75] font-light">

                    dream

                </h1>

                

                <h2 class="font-home text-white text-[65px] md:text-[105px] font-light uppercase tracking-[0.45em] leading-tight">

                    home

                </h2>



                <div class="mt-8">

                    <a href="{{ route('branches.index') }}" class="inline-block border border-white px-5 py-2 text-white text-[11px] font-semibold uppercase tracking-[0.1em] hover:bg-white hover:text-cyan-900 transition-all duration-300">

                        explore listings

                    </a>
                </div>

            </div>

        </main>



    </div>



</body>

</html>
