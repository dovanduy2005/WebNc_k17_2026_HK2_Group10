@extends('layouts.app')

@section('title', 'Danh sách hợp đồng - AutoLux')

@section('content')
<div class="min-h-screen bg-background pt-32 pb-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="mb-10 animate-slide-up">
                <h1 class="text-4xl font-bold mb-2">Hợp đồng & Đặt cọc</h1>
                <p class="text-muted-foreground">Theo dõi tiến độ hợp đồng và hóa đơn đặt cọc xe của bạn</p>
            </div>

            @if($contracts->isEmpty())
                <div class="card-luxury p-20 text-center animate-slide-up" style="animation-delay: 100ms">
                    <div class="w-20 h-20 rounded-full bg-secondary flex items-center justify-center mx-auto mb-6 text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Chưa có hợp đồng nào</h3>
                    <p class="text-muted-foreground mb-8">Bạn chưa thực hiện đặt cọc hoặc ký hợp đồng mua xe nào.</p>
                    <a href="{{ url('/cars') }}" class="bg-primary text-primary-foreground px-8 py-3 rounded-xl font-bold btn-primary-glow inline-block transition-all hover:scale-105">
                        Xem danh sách xe
                    </a>
                </div>
            @else
                <div class="grid gap-6 animate-slide-up" style="animation-delay: 100ms">
                    @foreach($contracts as $contract)
                        <div class="card-luxury p-6 flex flex-col md:flex-row items-center gap-6 group hover:border-primary/50 transition-all">
                            <!-- Car Image -->
                            <div class="w-full md:w-48 aspect-[16/10] rounded-xl overflow-hidden flex-shrink-0">
                                @php
                                    $imageUrl = \Illuminate\Support\Str::startsWith($contract->car->image, 'http') 
                                                ? $contract->car->image 
                                                : \Illuminate\Support\Facades\Storage::url($contract->car->image);
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $contract->car->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>

                            <!-- Info -->
                            <div class="flex-grow space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Mã HĐ: {{ $contract->contract_number }}</span>
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $contract->status == 'signed' ? 'bg-green-500/10 text-green-500' : 'bg-primary/10 text-primary' }}">
                                        {{ $contract->status == 'signed' ? 'Đã ký kết' : 'Chờ xử lý' }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold">{{ $contract->car->name }}</h3>
                                <div class="flex flex-wrap gap-4 text-sm text-muted-foreground">
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                        Đặt cọc: {{ number_format($contract->deposit_amount) }} VNĐ
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                        Ngày ký: {{ $contract->created_at->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="w-full md:w-auto flex-shrink-0">
                                <a href="{{ route('contracts.show', $contract->id) }}" class="flex items-center justify-center gap-2 bg-secondary hover:bg-primary hover:text-primary-foreground px-6 py-3 rounded-xl font-bold transition-all w-full md:w-auto">
                                    <span>Xem chi tiết</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
