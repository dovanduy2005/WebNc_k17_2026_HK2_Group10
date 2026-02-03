@php
    // Fetch latest available cars from Database
    $featuredCars = \App\Models\Car::with(['brand', 'category'])
                    ->where('status', 'available')
                    ->latest()
                    ->take(4)
                    ->get();
@endphp

<section class="py-24 bg-secondary/30">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <span class="text-primary font-medium mb-2 block">Xe nổi bật</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Dòng xe <span class="text-gradient-accent">hot</span> nhất
                </h2>
                <p class="text-muted-foreground max-w-lg">
                    Khám phá những mẫu xe được khách hàng yêu thích và đánh giá cao nhất tại showroom
                </p>
            </div>
            <a href="{{ url('/cars') }}" class="group border border-muted-foreground/30 hover:border-primary px-6 py-2 rounded-lg transition-all flex items-center gap-2">
                Xem tất cả xe
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><line x1="5" x2="19" y1="12" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <!-- Cars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredCars as $car)
                <x-car-card :car="$car" />
            @endforeach
        </div>
    </div>
</section>
