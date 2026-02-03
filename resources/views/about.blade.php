@extends('layouts.app')

@section('title', 'Về chúng tôi - AutoLux')

@section('content')
<div class="pt-32 pb-20">
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <section class="relative overflow-hidden mb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-primary font-medium mb-4 block">Về chúng tôi</span>
                    <h1 class="text-3xl md:text-5xl font-bold mb-6">
                        Showroom xe cao cấp
                        <span class="block text-gradient-accent">hàng đầu Việt Nam</span>
                    </h1>
                    <p class="text-muted-foreground text-lg leading-relaxed mb-8">
                        AutoLux tự hào là đại lý chính hãng của các thương hiệu xe hơi hàng đầu thế giới tại Việt Nam. Với hơn 15 năm kinh nghiệm, chúng tôi cam kết mang đến cho khách hàng những trải nghiệm mua xe tốt nhất.
                    </p>
                    <div class="w-20 h-1 bg-primary rounded-full"></div>
                </div>
                <div class="relative">
    <div class="aspect-[4/3] rounded-3xl overflow-hidden card-luxury group">
        <img
            src="https://static.danhgiaxe.com/data/201525/5lamborghini-aventador-a-lamborghini-should-neither-be-boring-nor-conventionally-beautiful-fortunately-the-flagship-aventador-isnt_4813.jpg"
            class="w-full h-full object-cover absolute inset-0 transition-opacity duration-700 opacity-100 group-hover:opacity-0"
        >
        <img
            src="https://thienthanhlimo.com/wp-content/uploads/2022/05/101-anh-sieu-xe-4k-tai-free-lam-hinh-nen-dt-may-tinh-3.jpg"
            class="w-full h-full object-cover absolute inset-0 transition-opacity duration-700 opacity-0 group-hover:opacity-100"
        >

    </div>
</div>

            </div>
        </section>

        <!-- Stats -->
        @php
            $stats = [
                ['icon' => 'car', 'value' => '500+', 'label' => 'Xe đã bán'],
                ['icon' => 'users', 'value' => '1000+', 'label' => 'Khách hàng'],
                ['icon' => 'award', 'value' => '15+', 'label' => 'Năm kinh nghiệm'],
                ['icon' => 'clock', 'value' => '24/7', 'label' => 'Hỗ trợ'],
            ];
        @endphp
        <section class="py-16 bg-secondary/30 mb-20 rounded-3xl overflow-hidden">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($stats as $stat)
                    <div class="text-center px-4">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-primary/10 flex items-center justify-center">
                            @if($stat['icon'] == 'car')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 13.1v2.9c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/></svg>
                            @elseif($stat['icon'] == 'users')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            @elseif($stat['icon'] == 'award')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            @elseif($stat['icon'] == 'clock')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            @endif
                        </div>
                        <p class="text-3xl md:text-4xl font-bold text-gradient-accent mb-2">{{ $stat['value'] }}</p>
                        <p class="text-muted-foreground">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Values -->
        @php
            $values = [
                [
                    'icon' => 'target',
                    'title' => 'Sứ mệnh',
                    'description' => 'Mang đến cho khách hàng Việt Nam những chiếc xe chất lượng cao với giá cả hợp lý nhất, cùng dịch vụ chăm sóc khách hàng tận tâm.',
                ],
                [
                    'icon' => 'eye',
                    'title' => 'Tầm nhìn',
                    'description' => 'Trở thành showroom xe hơi hàng đầu Việt Nam, được khách hàng tin tưởng lựa chọn đầu tiên khi tìm kiếm xe chất lượng.',
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Cam kết chất lượng',
                    'description' => '100% xe được kiểm tra kỹ lưỡng trước khi bàn giao. Bảo hành chính hãng, hỗ trợ sau bán hàng trọn đời.',
                ],
                [
                    'icon' => 'thumbs-up',
                    'title' => 'Uy tín hàng đầu',
                    'description' => '15 năm hoạt động với hàng nghìn khách hàng hài lòng. Cam kết minh bạch, không phát sinh chi phí ẩn.',
                ],
            ];
        @endphp
        <section class="mb-20">
            <div class="text-center mb-12">
                <span class="text-primary font-medium mb-2 block">Giá trị cốt lõi</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Điều làm nên <span class="text-gradient-accent">sự khác biệt</span>
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($values as $value)
                    <div class="card-luxury rounded-2xl p-8 transition-all duration-500 hover:-translate-y-2">
                        <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6 text-primary">
                            @if($value['icon'] == 'target')
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            @elseif($value['icon'] == 'eye')
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            @elseif($value['icon'] == 'shield')
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            @elseif($value['icon'] == 'thumbs-up')
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-semibold mb-3">{{ $value['title'] }}</h3>
                        <p class="text-muted-foreground leading-relaxed">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Why Choose Us -->
        <section>
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-primary/20 via-primary/10 to-primary/20 border border-primary/30">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,hsl(var(--primary)/0.15),transparent_50% text-foreground)]"></div>
                <div class="relative p-8 md:p-16">
                    <div class="max-w-2xl">
                        <h2 class="text-2xl md:text-3xl font-bold mb-6">
                            Tại sao chọn AutoLux?
                        </h2>
                        <ul class="space-y-4">
                            @php
                                $reasons = [
                                    "Đại lý chính hãng với nguồn xe đảm bảo 100%",
                                    "Đội ngũ tư vấn chuyên nghiệp, am hiểu sản phẩm",
                                    "Thủ tục nhanh gọn, hỗ trợ trả góp linh hoạt",
                                    "Dịch vụ hậu mãi chu đáo, bảo hành toàn quốc",
                                    "Showroom hiện đại, không gian trải nghiệm đẳng cấp",
                                ];
                            @endphp
                            @foreach($reasons as $index => $reason)
                                <li class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-primary flex items-center justify-center flex-shrink-0">
                                        <span class="text-primary-foreground text-sm font-bold">{{ $index + 1 }}</span>
                                    </div>
                                    <span class="text-foreground/90">{{ $reason }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
