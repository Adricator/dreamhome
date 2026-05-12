<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Property - {{ $property->street }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="glass-card rounded-3xl p-10 overflow-hidden relative">
            <div class="absolute top-0 right-0 px-8 py-2 bg-cyan-500 text-black text-[10px] font-bold uppercase tracking-widest rounded-bl-2xl">
                {{ $property->status }}
            </div>

            <div class="mb-12">
                <span class="data-label">Property Profile: {{ $property->property_id }}</span>
                <h1 class="font-dream text-5xl text-[#d1dcd5] mt-2">{{ $property->street }}</h1>
                <p class="text-gray-400 uppercase tracking-[0.3em] text-sm mt-2">{{ $property->city }}, {{ $property->postcode }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
                <div class="space-y-8">
                    <div>
                        <span class="data-label">Monthly Rental</span>
                        <p class="text-4xl font-light text-cyan-400">₱{{ number_format($property->monthly_rent) }}<span class="text-sm text-gray-500"> / month</span></p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <span class="data-label">Property Type</span>
                            <p class="data-value">{{ $property->type }}</p>
                        </div>
                        <div>
                            <span class="data-label">Total Rooms</span>
                            <p class="data-value">{{ $property->rooms }} Bedrooms</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-8 bg-white/5 p-6 rounded-2xl border border-white/5">
                    <div>
                        <span class="data-label">Area</span>
                       <p class="data-value text-2xl">{{ $property->area }}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <span class="data-label">Owner</span>
                            <p class="text-xs uppercase">{{ $property->owner_id }}</p>
                        </div>
                        <div>
                            <span class="data-label">Staff</span>
                            <p class="text-xs uppercase">{{ $property->staff_id }}</p>
                        </div>
                        <div>
                            <span class="data-label">Branch</span>
                            <p class="text-xs uppercase">{{ $property->branch_id }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADVERTISEMENTS SECTION - Styled to match -->
            <div class="pt-12 border-t border-white/10">
                <h3 class="font-dream text-2xl text-[#d1dcd5] mb-6">Marketing & Ads</h3>
                
                @if($property->advertisements->isEmpty())
                    <div class="bg-white/5 p-8 rounded-xl text-center border border-dashed border-white/10">
                        <p class="text-gray-500 text-xs uppercase tracking-widest">No advertisement history found.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-separate border-spacing-y-2">
                            <thead>
                                <tr class="text-gray-500 text-[10px] uppercase tracking-widest">
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Media Source</th>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2 text-right">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($property->advertisements as $ad)
                                    <tr class="bg-white/5 hover:bg-white/10 transition-colors">
                                        <td class="px-4 py-3 rounded-l-lg text-xs font-mono text-cyan-400">{{ $ad->ad_id }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $ad->media_source }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-400">{{ $ad->date_advertised }}</td>
                                        <!-- FIXED: Changed number_with_precision to number_format -->
                                        <td class="px-4 py-3 rounded-r-lg text-right font-bold">₱{{ number_format($ad->cost, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Footer Actions -->
            <div class="mt-12 flex items-center justify-between pt-8 border-t border-white/10">
                <div class="flex gap-4">
                    <a href="{{ route('properties.edit', $property->property_id) }}" class="bg-white text-black px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-cyan-400 transition rounded-lg">
                        Edit Property
                    </a>
                    <a href="{{ route('properties.index') }}" class="border border-white/20 px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-white/10 transition rounded-lg">
                        Back to List
                    </a>
                </div>
                
                <form action="{{ route('properties.destroy', $property->property_id) }}" method="POST" onsubmit="return confirm('Permanent action: Delete this property?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-400 text-[10px] uppercase font-bold tracking-[0.2em]">
                        Remove Listing
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>