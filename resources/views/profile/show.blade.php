@extends('layouts.app')

@section('title', 'Thông tin cá nhân - AutoLux')

@section('content')
<div class="min-h-screen bg-background pt-32 pb-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-10 animate-slide-up">
                <h1 class="text-4xl font-bold mb-2">Hồ sơ của tôi</h1>
                <p class="text-muted-foreground">Quản lý thông tin cá nhân và địa chỉ nhận hàng của bạn</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left: Avatar & Quick Info -->
                <div class="lg:col-span-1 space-y-6 animate-slide-up" style="animation-delay: 100ms">
                    <div class="card-luxury p-8 flex flex-col items-center text-center">
                        <div class="relative group mb-6">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-primary/20 bg-secondary">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </div>
                                @endif
                            </div>
                            <label for="avatar_file" class="absolute bottom-0 right-0 w-10 h-10 bg-primary text-primary-foreground rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                            </label>
                        </div>
                        <h2 class="text-xl font-bold mb-1">{{ $user->name }}</h2>
                        <p class="text-sm text-muted-foreground mb-4">{{ $user->email }}</p>
                    </div>

                    <div class="card-luxury p-6 space-y-4">
                        <h3 class="font-bold border-b border-border pb-2">Thống kê</h3>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted-foreground">Đơn hàng</span>
                            <span class="font-medium text-foreground">{{ $stats['contracts_count'] }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted-foreground">Xe yêu thích</span>
                            <span class="font-medium text-foreground">{{ $stats['favorites_count'] }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted-foreground">Lịch hẹn</span>
                            <span class="font-medium text-foreground">{{ $stats['bookings_count'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="lg:col-span-2 animate-slide-up" style="animation-delay: 200ms">
                    <div class="card-luxury p-8">
                        <form action="{{ url('/profile') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            <input type="file" id="avatar_file" name="avatar_file" class="hidden" onchange="this.form.submit()">

                            <div class="space-y-6">
                                <h3 class="text-xl font-bold flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Thông tin cá nhân
                                </h3>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-muted-foreground">Họ và tên</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required placeholder="Nhập họ tên" class="w-full h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-muted-foreground">Email</label>
                                        <input type="email" value="{{ $user->email }}" disabled class="w-full h-12 bg-background border border-border rounded-xl px-4 text-muted-foreground cursor-not-allowed">
                                        <p class="text-[10px] text-muted-foreground">Email không thể thay đổi</p>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium text-muted-foreground">Số điện thoại</label>
                                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Nhập số điện thoại" class="w-full h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <h3 class="text-xl font-bold flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    Địa chỉ đầy đủ
                                </h3>
                                
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-muted-foreground">Địa chỉ nhận hàng / Giao dịch</label>
                                    <textarea name="address" rows="4" placeholder="Nhập địa chỉ chi tiết (Số nhà, đường, phường, quận, thành phố...)" class="w-full bg-secondary border border-border rounded-xl p-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-border flex justify-end">
                                <button type="submit" class="bg-primary text-primary-foreground px-8 py-3 rounded-xl font-bold btn-primary-glow flex items-center gap-2 transition-all hover:scale-105 active:scale-95">
                                    <span>Lưu thay đổi</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- My Orders Section -->
            @if($contracts->count() > 0)
            <div class="mt-8 animate-slide-up" style="animation-delay: 300ms">
                <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    Đơn hàng của tôi
                </h2>
                
                <div class="space-y-4">
                    @foreach($contracts as $contract)
                    <div class="card-luxury p-6 flex flex-col md:flex-row gap-6 relative overflow-hidden group">
                        <!-- Car Image -->
                        <div class="w-full md:w-48 aspect-video rounded-xl overflow-hidden flex-shrink-0">
                            @php
                                $imageUrl = \Illuminate\Support\Str::startsWith($contract->car->image, 'http') 
                                            ? $contract->car->image 
                                            : \Illuminate\Support\Facades\Storage::url($contract->car->image);
                            @endphp
                            <img src="{{ $imageUrl }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Content -->
                        <div class="flex-grow space-y-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="text-xs font-bold text-primary uppercase tracking-wider mb-1 block">#{{ $contract->contract_number }}</span>
                                    <h3 class="text-xl font-bold">{{ $contract->car->name }}</h3>
                                    <p class="text-muted-foreground text-sm">{{ $contract->car->year }} • {{ $contract->car->brand->name ?? 'Xe' }}</p>
                                </div>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-500/10 text-yellow-500',
                                        'confirmed' => 'bg-blue-500/10 text-blue-500',
                                        'active' => 'bg-primary/10 text-primary',
                                        'complete' => 'bg-green-500/10 text-green-500',
                                        'cancelled' => 'bg-red-500/10 text-red-500',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Chờ xử lý',
                                        'confirmed' => 'Đã xác nhận',
                                        'active' => 'Đang thực hiện',
                                        'complete' => 'Hoàn thành',
                                        'cancelled' => 'Đã hủy',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClasses[$contract->status] ?? 'bg-secondary text-muted-foreground' }}">
                                    {{ $statusLabels[$contract->status] ?? $contract->status }}
                                </span>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4 pt-2 border-t border-border/50">
                                <div class="space-y-1">
                                    <span class="text-xs text-muted-foreground font-medium uppercase">Ngày giao dịch</span>
                                    <p class="font-medium">{{ $contract->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="space-y-1">
                                    <span class="text-xs text-muted-foreground font-medium uppercase">Tiền cọc</span>
                                    <p class="font-bold text-primary">{{ number_format($contract->deposit_amount) }} đ</p>
                                </div>
                                @if($contract->inspection_date)
                                <div class="space-y-1">
                                    <span class="text-xs text-muted-foreground font-medium uppercase flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                        Lịch xem xe
                                    </span>
                                    <p class="font-medium text-blue-500">{{ \Carbon\Carbon::parse($contract->inspection_date)->format('H:i - d/m/Y') }}</p>
                                </div>
                                @endif
                                @if($contract->handover_date)
                                <div class="space-y-1">
                                    <span class="text-xs text-muted-foreground font-medium uppercase flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 13.1v2.9c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/></svg>
                                        Lịch nhận xe
                                    </span>
                                    <p class="font-medium text-green-500">{{ \Carbon\Carbon::parse($contract->handover_date)->format('H:i - d/m/Y') }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
