@props(['car'])

@php
    $isObject = is_object($car);
    $id = $isObject ? $car->id : $car['id'];
    
    // Check favorites
    $isFavorite = auth()->check() && auth()->user()->favorites()->where('car_id', $id)->exists();
    
    // Basic props
    $isHot = $isObject ? ($car->is_hot ?? false) : ($car['is_hot'] ?? $car['isHot'] ?? false);
    $discount = $isObject ? ($car->discount ?? null) : ($car['discount'] ?? null);
    $name = $isObject ? $car->name : $car['name'];
    
    // Relations/Fields
    $brand = $isObject ? ($car->brand->name ?? $car->brand_name ?? 'N/A') : ($car['brand'] ?? 'N/A');
    $type = $isObject ? ($car->category->name ?? $car->type ?? 'N/A') : ($car['type'] ?? 'N/A');
    $year = $isObject ? $car->year : $car['year'];
    $price = $isObject ? $car->price : $car['price'];
    
    // Image
    $rawImage = $isObject ? $car->image : $car['image'];
    $image = \Illuminate\Support\Str::startsWith($rawImage, 'http') 
            ? $rawImage 
            : \Illuminate\Support\Facades\Storage::url($rawImage);
    
    // Specs
    $power = $isObject ? ($car->power ?? 'N/A') : ($car['power'] ?? $car['specs']['power'] ?? 'N/A');
    $fuel = $isObject ? ($car->fuel ?? 'N/A') : ($car['fuel'] ?? $car['specs']['fuel'] ?? 'N/A');
    $seats = $isObject ? ($car->seats ?? 'N/A') : ($car['seats'] ?? $car['specs']['seats'] ?? 'N/A');
@endphp

<div class="group relative card-luxury rounded-2xl overflow-hidden transition-all duration-500 hover:-translate-y-2 block">
    <!-- Favorite Button -->
    <div class="absolute top-4 left-4 z-20">
        @auth
            <form action="{{ route('favorites.toggle', $id) }}" method="POST" x-data="{ isFavorite: {{ $isFavorite ? 'true' : 'false' }} }">
                @csrf
                <button type="submit" 
                        @click.prevent="isFavorite = !isFavorite; fetch('{{ route('favorites.toggle', $id) }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })"
                        class="w-10 h-10 rounded-full backdrop-blur-md flex items-center justify-center transition-all duration-300 hover:scale-110 active:scale-95"
                        :class="isFavorite ? 'bg-primary text-white shadow-lg' : 'bg-background/50 text-foreground/70 hover:bg-background/80'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" :fill="isFavorite ? 'currentColor' : 'none'" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                    </svg>
                </button>
            </form>
        @else
            <a href="{{ url('/auth') }}" class="w-10 h-10 rounded-full bg-background/50 backdrop-blur-md flex items-center justify-center text-foreground/70 hover:bg-background/80 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                </svg>
            </a>
        @endauth
    </div>

    <a href="{{ url('/cars/' . $id) }}" class="block p-0">
        <!-- Image -->
        <div class="relative aspect-[16/10] overflow-hidden">
            <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent"></div>
            
            <!-- Badges -->
            <div class="absolute top-4 right-4 flex flex-col items-end gap-2">
                @if($isHot)
                    <span class="bg-primary text-primary-foreground text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-md shadow-lg">
                        Hot
                    </span>
                @endif
                @if($discount)
                    <span class="bg-green-600 text-white text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-md shadow-lg">
                        -{{ $discount }}%
                    </span>
                @endif
                <span class="px-3 py-1.5 bg-background/80 backdrop-blur-sm rounded-lg text-xs font-medium text-foreground shadow-sm">
                    {{ $brand }}
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-foreground group-hover:text-primary transition-colors line-clamp-1">
                    {{ $name }}
                </h3>
                <p class="text-sm text-muted-foreground mt-1">{{ $type }} • {{ $year }}</p>
            </div>

            <!-- Specs -->
            <div class="flex items-center gap-4 mb-5 pb-5 border-b border-border">
                <div class="flex items-center gap-1.5 text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                    <span class="text-xs">{{ $power }}</span>
                </div>
                <div class="flex items-center gap-1.5 text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 22L15 22"/><path d="M9 22L9 7"/><path d="M9 7L15 7L15 22"/><path d="M15 7L17 7A2 2 0 0 1 19 9L19 22"/><path d="M9 12L15 12"/><path d="M9 16L15 16"/><path d="M6 7L9 7"/></svg>
                    <span class="text-xs">{{ $fuel }}</span>
                </div>
                <div class="flex items-center gap-1.5 text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span class="text-xs">{{ $seats }} chỗ</span>
                </div>
            </div>

            <!-- Price & CTA -->
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-muted-foreground">Giá từ</p>
                    <p class="text-xl font-bold text-primary">{{ \App\Helpers\CarHelper::formatPrice($price) }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary group-hover:text-primary-foreground transition-colors"><line x1="5" x2="19" y1="12" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </div>
            </div>
        </div>
    </a>
</div>
