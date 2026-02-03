@extends('layouts.app')

@section('title', 'Xe yêu thích - AutoLux')

@section('content')
<section class="py-32 bg-secondary/30 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 animate-slide-up">
            <div>
                <span class="text-primary font-medium mb-2 block">Yêu thích</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Bộ sưu tập <span class="text-gradient-accent">xe yêu thích</span>
                </h2>
                <p class="text-muted-foreground max-w-lg">
                    Danh sách những mẫu xe sang bạn đã lưu lại để theo dõi và so sánh
                </p>
            </div>
            <a href="{{ url('/cars') }}" class="group border border-muted-foreground/30 hover:border-primary px-6 py-2 rounded-lg transition-all flex items-center gap-2">
                Tiếp tục xem xe
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><line x1="5" x2="19" y1="12" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        @if($cars->isEmpty())
            <div class="card-luxury p-20 text-center animate-slide-up" style="animation-delay: 100ms">
                <div class="w-20 h-20 rounded-full bg-secondary flex items-center justify-center mx-auto mb-6 text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-2">Chưa có xe yêu thích</h3>
                <p class="text-muted-foreground mb-8">Hãy khám phá bộ sưu tập xe của chúng tôi và nhấn tim để lưu lại.</p>
                <a href="{{ url('/cars') }}" class="bg-primary text-primary-foreground px-8 py-3 rounded-xl font-bold btn-primary-glow inline-block transition-all hover:scale-105">
                    Khám phá ngay
                </a>
            </div>
        @else
            <!-- Cars Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up" style="animation-delay: 100ms">
                @foreach($cars as $car)
                    <x-car-card :car="$car" />
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
