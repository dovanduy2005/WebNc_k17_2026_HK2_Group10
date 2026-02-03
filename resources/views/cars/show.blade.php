@extends('layouts.app')

@section('title', $car->name . ' - AutoLux')

@section('content')
<div class="pt-28 pb-20">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-muted-foreground mb-8">
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Trang chủ</a>
            <span>/</span>
            <a href="{{ url('/cars') }}" class="hover:text-primary transition-colors">Danh sách xe</a>
            <span>/</span>
            <span class="text-foreground">{{ $car->name }}</span>
        </div>

        <!-- Back Button -->
        <a href="{{ url('/cars') }}" class="inline-flex items-center gap-2 text-muted-foreground hover:text-primary transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" x2="5" y1="12" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Quay lại
        </a>

        @php
            $images = $car->images ?? [];
            if ($car->image && !in_array($car->image, $images)) {
                array_unshift($images, $car->image);
            }
            // Map images to correct URL
            $images = array_map(function($img) {
                return \Illuminate\Support\Str::startsWith($img, 'http') ? $img : \Illuminate\Support\Facades\Storage::url($img);
            }, $images);
            $isFavorite = auth()->check() && auth()->user()->favorites()->where('car_id', $car->id)->exists();
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12" x-data="{ currentImage: 0, images: {{ json_encode($images) }}, isFavorite: {{ $isFavorite ? 'true' : 'false' }} }">
            <!-- Gallery -->
            <div class="space-y-4">
                <div class="relative aspect-[16/10] rounded-2xl overflow-hidden card-luxury">
                    <template x-for="(img, index) in images" :key="index">
                        <img x-show="currentImage === index" :src="img" alt="{{ $car->name }}" class="w-full h-full object-cover" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100">
                    </template>
                    
                    <!-- Navigation -->
                    <template x-if="images.length > 1">
                        <div class="absolute inset-0 flex items-center justify-between p-4">
                            <button @click="currentImage = (currentImage === 0) ? images.length - 1 : currentImage - 1" class="w-10 h-10 bg-background/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-background transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                            </button>
                            <button @click="currentImage = (currentImage === images.length - 1) ? 0 : currentImage + 1" class="w-10 h-10 bg-background/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-background transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                        </div>
                    </template>

                    <!-- Badges -->
                    <div class="absolute top-4 left-4 flex gap-2">
                        @if($car->is_hot)
                            <span class="bg-primary text-primary-foreground px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider">Hot</span>
                        @endif
                        @if($car->discount)
                            <span class="bg-green-600 text-white px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider">-{{ $car->discount }}%</span>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="absolute top-4 right-4 flex gap-2">
                        @auth
                            <button @click.prevent="isFavorite = !isFavorite; fetch('{{ route('favorites.toggle', $car->id) }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })"
                                    class="w-10 h-10 rounded-full backdrop-blur-md flex items-center justify-center transition-all duration-300 hover:scale-110 active:scale-95"
                                    :class="isFavorite ? 'bg-primary text-white shadow-lg' : 'bg-background/80 text-foreground/70 hover:bg-background'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" :fill="isFavorite ? 'currentColor' : 'none'" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                                </svg>
                            </button>
                        @else
                            <a href="{{ url('/auth') }}" class="w-10 h-10 bg-background/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-background transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Thumbnails -->
                <div class="flex gap-3 overflow-x-auto pb-2">
                    <template x-for="(img, index) in images" :key="index">
                        <button @click="currentImage = index" class="flex-shrink-0 w-24 aspect-video rounded-lg overflow-hidden border-2 transition-all" :class="currentImage === index ? 'border-primary' : 'border-transparent opacity-60 hover:opacity-100'">
                            <img :src="img" alt="" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Details -->
            <div class="space-y-8">
                <!-- Header -->
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="px-3 py-1 bg-secondary rounded-lg text-sm font-medium">{{ $car->brand->name ?? 'N/A' }}</span>
                        <span class="text-muted-foreground">{{ $car->category->name ?? 'N/A' }} • {{ $car->year }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $car->name }}</h1>
                    <p class="text-muted-foreground leading-relaxed">{{ $car->description }}</p>
                </div>

                <!-- Price -->
                <div class="card-luxury rounded-2xl p-6">
                    <div class="flex items-end justify-between">
                        <div>
                            <p class="text-sm text-muted-foreground mb-1">Giá bán</p>
                            <p class="text-3xl font-bold text-primary">{{ \App\Helpers\CarHelper::formatPrice($car->price) }}</p>
                            @if($car->discount)
                                <p class="text-sm text-muted-foreground line-through mt-1">
                                    {{ \App\Helpers\CarHelper::formatPrice($car->price * (1 + $car->discount / 100)) }}
                                </p>
                            @endif
                        </div>
                        <span class="text-green-500 border border-green-500/50 px-3 py-1 rounded-full text-xs font-medium">
                            Còn hàng
                        </span>
                    </div>
                </div>

                <!-- Specs -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Thông số kỹ thuật</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 p-4 bg-secondary/50 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                            <div>
                                <p class="text-xs text-muted-foreground">Động cơ</p>
                                <p class="font-medium text-sm">{{ $car->engine ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-4 bg-secondary/50 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                            <div>
                                <p class="text-xs text-muted-foreground">Công suất</p>
                                <p class="font-medium text-sm">{{ $car->power ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-4 bg-secondary/50 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M3 22L15 22"/><path d="M9 22L9 7"/><path d="M9 7L15 7L15 22"/><path d="M15 7L17 7A2 2 0 0 1 19 9L19 22"/><path d="M9 12L15 12"/><path d="M9 16L15 16"/><path d="M6 7L9 7"/></svg>
                            <div>
                                <p class="text-xs text-muted-foreground">Nhiên liệu</p>
                                <p class="font-medium text-sm">{{ $car->fuel ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-4 bg-secondary/50 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <div>
                                <p class="text-xs text-muted-foreground">Số chỗ</p>
                                <p class="font-medium text-sm">{{ $car->seats ?? 'N/A' }} chỗ</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                @if($car->features)
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tính năng nổi bật</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($car->features as $feature)
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded-full bg-primary/20 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <span class="text-sm">{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- CTA -->
                <div class="flex flex-col sm:flex-row gap-4" x-data="{ orderModal: false }">
                    @auth
                        <a href="{{ route('contracts.create', ['car_id' => $car->id]) }}" class="flex-1 bg-primary text-primary-foreground h-14 rounded-xl font-bold btn-primary-glow flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                            Đặt mua ngay
                        </a>
                    @else
                        <button @click="orderModal = true" class="flex-1 bg-primary text-primary-foreground h-14 rounded-xl font-bold btn-primary-glow flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                            Đặt mua ngay
                        </button>
                    @endauth
                    
                    <a href="tel:02462918118" class="flex-1 border border-border hover:border-primary h-14 rounded-xl font-bold flex items-center justify-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Liên hệ tư vấn
                    </a>

                    <!-- Simple Modal with Alpine -->
                    <div x-show="orderModal" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" style="display: none;">
                        <div @click.away="orderModal = false" class="bg-card border border-border w-full max-w-lg rounded-2xl p-8 shadow-2xl relative">
                            <button @click="orderModal = false" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                            </button>
                            <h2 class="text-2xl font-bold mb-6">Đặt mua xe</h2>
                            <div class="space-y-4">
                                <div class="p-4 bg-secondary/50 rounded-xl">
                                    <h4 class="font-semibold">{{ $car->name }}</h4>
                                    <p class="text-primary font-bold">{{ \App\Helpers\CarHelper::formatPrice($car->price) }}</p>
                                </div>
                                <div class="p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl">
                                    <p class="text-sm text-yellow-500">
                                        Vui lòng đăng nhập để thực hiện đặt mua xe trực tuyến.
                                    </p>
                                </div>
                                <div class="flex flex-col gap-3">
                                    <a href="{{ url('/auth') }}" class="w-full bg-primary text-primary-foreground py-3 rounded-xl font-bold text-center btn-primary-glow">
                                        Đăng nhập ngay
                                    </a>
                                    <button @click="orderModal = false" class="w-full py-3 text-muted-foreground hover:text-foreground font-medium">
                                        Hủy bỏ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
