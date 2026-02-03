@extends('layouts.app')

@section('title', 'Liên hệ - AutoLux')

@section('content')
<div class="pt-32 pb-20">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16">
            <span class="text-primary font-medium mb-4 block">Liên hệ</span>
            <h1 class="text-3xl md:text-5xl font-bold mb-4">
                Chúng tôi luôn sẵn sàng
                <span class="block text-gradient-accent">hỗ trợ bạn</span>
            </h1>
            <p class="text-muted-foreground max-w-lg mx-auto">
                Hãy để lại thông tin, đội ngũ tư vấn viên của AutoLux sẽ liên hệ ngay với bạn
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
            <!-- Contact Info -->
            <div class="lg:col-span-2 space-y-6">
                @php
                    $contactInfo = [
                        ['icon' => 'phone', 'title' => 'Hotline', 'value' => '024 6291 8118', 'description' => 'Gọi ngay để được tư vấn'],
                        ['icon' => 'mail', 'title' => 'Email', 'value' => 'info@autolux.vn', 'description' => 'Gửi email cho chúng tôi'],
                        ['icon' => 'map-pin', 'title' => 'Địa chỉ', 'value' => 'Đại Học Phenikaa', 'description' => 'Yên Nghĩa, Hà Đông, Hà Nội'],
                        ['icon' => 'clock', 'title' => 'Giờ làm việc', 'value' => '8:00 - 20:00', 'description' => 'Thứ 2 - Chủ nhật'],
                    ];
                @endphp

                @foreach($contactInfo as $item)
                    <div class="card-luxury rounded-2xl p-6 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 text-primary">
                            @if($item['icon'] == 'phone')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            @elseif($item['icon'] == 'mail')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            @elseif($item['icon'] == 'map-pin')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            @elseif($item['icon'] == 'clock')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-muted-foreground mb-1">{{ $item['title'] }}</p>
                            <p class="text-lg font-semibold mb-1">{{ $item['value'] }}</p>
                            <p class="text-sm text-muted-foreground">{{ $item['description'] }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Google Map -->
                <div class="card-luxury rounded-2xl overflow-hidden aspect-video relative group shadow-lg border border-border/50">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.7483780373406!2d105.7460678759535!3d20.96263529004454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313452efff3456d3%3A0x51e717abb1488da1!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBQaGVuaWthYQ!5e0!3m2!1svi!2s!4v1705050000000!5m2!1svi!2s" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="transition-all duration-700 opacity-100">
                    </iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-3">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-primary/10 border border-primary/20 rounded-2xl text-primary animate-slide-up">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                <div class="card-luxury rounded-3xl p-8 md:p-10">
                    <h2 class="text-2xl font-bold mb-2">Gửi yêu cầu tư vấn</h2>
                    <p class="text-muted-foreground mb-8">
                        Điền thông tin bên dưới, chúng tôi sẽ liên hệ trong 30 phút
                    </p>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm font-medium mb-2 block">Họ và tên *</label>
                                <input type="text" name="name" placeholder="Nguyễn Văn A" required class="w-full h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                            </div>
                            <div>
                                <label class="text-sm font-medium mb-2 block">Số điện thoại *</label>
                                <input type="tel" name="phone" placeholder="0901 234 567" required class="w-full h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium mb-2 block">Email</label>
                            <input type="email" name="email" placeholder="email@example.com" class="w-full h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                        </div>

                        <div>
                            <label class="text-sm font-medium mb-2 block">Dòng xe quan tâm</label>
                            <input type="text" name="car_interested" placeholder="VD: Mercedes S-Class, BMW X7..." class="w-full h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                        </div>

                        <div>
                            <label class="text-sm font-medium mb-2 block">Nội dung yêu cầu</label>
                                <textarea name="message" placeholder="Nhập nội dung yêu cầu của bạn..." class="w-full bg-secondary border border-border rounded-xl p-4 min-h-[120px] focus:outline-none focus:ring-1 focus:ring-primary transition-all"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-primary text-primary-foreground h-14 rounded-xl font-bold btn-primary-glow flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            Gửi yêu cầu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
