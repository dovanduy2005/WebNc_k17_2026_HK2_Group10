@extends('layouts.app')

@section('title', 'Hoàn tất thủ tục đặt mua - AutoLux')

@section('content')
<div class="min-h-screen bg-secondary/30 pt-32 pb-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-10 text-center animate-slide-up">
                <h1 class="text-4xl font-bold mb-2">Thủ tục đặt mua xe</h1>
                <p class="text-muted-foreground">Vui lòng cung cấp thông tin để chúng tôi lập hợp đồng thỏa thuận đặt cọc</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Car Summary -->
                <div class="lg:col-span-1 space-y-6 animate-slide-up" style="animation-delay: 100ms">
                    <div class="card-luxury p-6 space-y-4">
@php
    $imageUrl = \Illuminate\Support\Str::startsWith($carModel->image, 'http') 
                ? $carModel->image 
                : \Illuminate\Support\Facades\Storage::url($carModel->image);
@endphp

<div class="aspect-video rounded-xl overflow-hidden">
    <img src="{{ $imageUrl }}" alt="{{ $carModel->name }}" class="w-full h-full object-cover">
</div>
<div>
    <h3 class="font-bold text-xl">{{ $carModel->name }}</h3>
    <p class="text-sm text-muted-foreground">{{ $carModel->brand->name ?? 'N/A' }} • {{ $carModel->year }}</p>
</div>
                        <div class="pt-4 border-t border-border">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-muted-foreground">Giá bán:</span>
                                <span class="font-bold">{{ number_format($carModel->price) }} VNĐ</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-muted-foreground">Số tiền cọc:</span>
                                <span class="font-bold text-primary">300,000,000 VNĐ</span>
                            </div>
                        </div>
                        <div class="p-4 bg-primary/5 rounded-xl border border-primary/10">
                            <p class="text-xs text-primary leading-relaxed">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline mb-1 mr-1"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                Khoản tiền cọc này sẽ được trừ trực tiếp vào giá trị xe khi ký hợp đồng mua bán chính thức.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Order Form -->
                <div class="lg:col-span-2 animate-slide-up" style="animation-delay: 200ms">
                    <div class="card-luxury p-8">
                        <form action="{{ route('contracts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $carModel->id }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-medium mb-2 block">Họ và tên người mua</label>
                                    <input type="text" value="{{ Auth::user()->name }}" disabled class="w-full h-12 bg-secondary/50 border border-border rounded-xl px-4 text-muted-foreground cursor-not-allowed">
                                </div>
                                <div>
                                    <label class="text-sm font-medium mb-2 block">Số CCCD / Passport <span class="text-red-500">*</span></label>
                                    <input type="text" name="cccd" required placeholder="Nhập số CCCD (9-12 số)" class="w-full h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all @error('cccd') border-destructive @enderror">
                                    @error('cccd') <p class="text-xs text-destructive mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium mb-2 block">Số điện thoại liên hệ *</label>
                                <input type="tel" name="phone" value="{{ Auth::user()->phone }}" required placeholder="09xx xxx xxx" class="w-full h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all @error('phone') border-destructive @enderror">
                                @error('phone') <p class="text-xs text-destructive mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="text-sm font-medium mb-2 block">Địa chỉ thường trú (Để ghi vào HĐ) *</label>
                                <textarea name="buyer_address" required placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố" class="w-full bg-secondary border border-border rounded-xl p-4 min-h-[100px] focus:outline-none focus:ring-1 focus:ring-primary transition-all @error('buyer_address') border-destructive @enderror">{{ Auth::user()->address }}</textarea>
                                @error('buyer_address') <p class="text-xs text-destructive mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="h-px bg-border my-8"></div>

                            <div>
                                <label class="text-sm font-medium mb-4 block">Ảnh chụp minh chứng đã chuyển khoản đặt cọc *</label>
                                <div class="relative group" x-data="{ preview: null }">
                                    <input type="file" name="deposit_image" accept="image/*" required @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { preview = e.target.result }; reader.readAsDataURL(file); }" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="border-2 border-dashed border-border group-hover:border-primary transition-colors rounded-2xl p-8 flex flex-col items-center justify-center bg-secondary/30 relative">
                                        <template x-if="!preview">
                                            <div class="text-center">
                                                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-4 text-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                                                </div>
                                                <p class="font-bold">Nhấn để tải ảnh lên hoặc kéo thả</p>
                                                <p class="text-xs text-muted-foreground mt-1">Hỗ trợ JPG, PNG (Tối đa 2MB)</p>
                                            </div>
                                        </template>
                                        <template x-if="preview">
                                            <img :src="preview" class="max-h-64 rounded-lg shadow-lg">
                                        </template>
                                    </div>
                                </div>
                                @error('deposit_image') <p class="text-xs text-destructive mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="pt-6">
                                <button type="submit" class="w-full bg-primary text-primary-foreground h-16 rounded-xl font-bold btn-primary-glow flex items-center justify-center gap-3">
                                    <span>Xác nhận và Hoàn tất đặt mua</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </button>
                                <p class="text-center text-xs text-muted-foreground mt-4 leading-relaxed">
                                    Bằng việc nhấn xác nhận, bạn đồng ý với các <a href="#" class="text-primary hover:underline">Điều khoản đặt cọc</a> và <a href="#" class="text-primary hover:underline">Chính sách bảo mật</a> của AutoLux.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
