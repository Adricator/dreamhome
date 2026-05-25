<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Profile - Dream Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

</head>
<body class="text-white min-h-screen bg-[#0f172a]">
    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="mb-8">
            <a href="{{ url('/clients') }}" class="group inline-flex items-center text-cyan-400 text-[10px] uppercase font-bold tracking-[0.2em] hover:text-white transition">
                <span class="mr-2 transform group-hover:-translate-x-1 transition-transform">←</span> Back to Directory
            </a>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
            <div class="px-8 py-10 border-b border-white/10 bg-gradient-to-br from-white/5 to-transparent">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <span class="text-cyan-400 text-[10px] uppercase font-bold tracking-[0.3em] mb-2 block">Client Profile</span>
                        <h1 class="text-4xl font-semibold tracking-tight text-white">{{ $client->first_name }} {{ $client->last_name }}</h1>
                    </div>
                    <div class="bg-white/10 border border-white/20 px-4 py-2 rounded-xl">
                        <span class="block text-[9px] text-gray-400 uppercase tracking-widest mb-1">System ID</span>
                        <span class="font-mono text-cyan-300 font-bold">#{{ $client->client_id }}</span>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    @php
                        $details = [
                            'Contact Information' => [
                                'Telephone' => $client->telephone_no,
                                'Email Address' => $client->email,
                                'Current Address' => $client->address,
                            ],
                            'Rental Preferences' => [
                                'Preferred Type' => $client->prefer_type,
                                'Maximum Budget' => '$' . number_format($client->max_rent, 2),
                            ]
                        ];
                    @endphp

                    @foreach($details as $section => $fields)
                    <div class="space-y-6">
                        <h3 class="text-[11px] uppercase tracking-[0.2em] text-gray-500 font-bold border-b border-white/5 pb-2">{{ $section }}</h3>
                        <div class="space-y-4">
                            @foreach($fields as $label => $value)
                            <div>
                                <label class="text-[10px] text-gray-500 uppercase tracking-wider block mb-1">{{ $label }}</label>
                                <p class="text-sm {{ str_contains($label, 'Budget') ? 'text-emerald-400 font-bold' : 'text-gray-200' }}">
                                    {{ $value }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-black/40 px-8 py-6 flex justify-between items-center border-t border-white/5">
                <form action="{{ route('clients.destroy', $client->client_id) }}" method="POST" onsubmit="return confirm('Archive this client record?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400/60 hover:text-red-400 text-[10px] uppercase font-bold tracking-widest transition">
                        Delete Record
                    </button>
                </form>

                <div class="flex gap-4">
                    <a href="{{ route('clients.edit', $client->client_id) }}" class="bg-white text-black px-8 py-3 rounded-full text-[10px] uppercase font-bold tracking-widest hover:bg-cyan-400 hover:text-black transition duration-300">
                        Edit Details
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>