@extends('layouts.app')

@section('title', 'Gửi phản hồi - AutoLux')

@section('content')
<div class="pt-32 pb-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-10 animate-slide-up">
                <span class="text-primary font-medium mb-4 block">Đóng góp ý kiến</span>
                <h1 class="text-3xl md:text-5xl font-bold mb-4">
                    Gửi phản hồi về
                    <span class="block text-gradient-accent">dịch vụ của chúng tôi</span>
                </h1>
                <p class="text-muted-foreground">
                    Ý kiến của bạn là động lực để AutoLux hoàn thiện hơn mỗi ngày
                </p>
            </div>

            <div class="card-luxury p-8 md:p-10 animate-slide-up" style="animation-delay: 100ms">
                <form action="{{ route('feedback.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div x-data="{ rating: 5, hoverRating: 0 }" class="space-y-4">
                        <label class="text-sm font-medium block">Mức độ hài lòng của bạn <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-2">
                            <template x-for="i in 5">
                                <button type="button" 
                                    @click="rating = i" 
                                    @mouseenter="hoverRating = i" 
                                    @mouseleave="hoverRating = 0"
                                    class="transition-all duration-200 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        width="32" height="32" 
                                        viewBox="0 0 24 24" 
                                        :fill="(hoverRating || rating) >= i ? 'currentColor' : 'none'" 
                                        stroke="currentColor" 
                                        stroke-width="2" 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round"
                                        :class="(hoverRating || rating) >= i ? 'text-yellow-500 scale-110' : 'text-muted-foreground opacity-50'">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                </button>
                            </template>
                            <span class="ml-2 text-sm font-bold text-yellow-500" x-text="rating + '/5 sao'"></span>
                            <input type="hidden" name="rating" :value="rating">
                        </div>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium mb-2 block">Nội dung phản hồi <span class="text-red-500">*</span></label>
                        <textarea name="message" rows="6" placeholder="Chia sẻ trải nghiệm của bạn về dịch vụ, sản phẩm, nhân viên..." class="w-full bg-secondary border border-border rounded-xl p-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all resize-none" required></textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="flex-1 bg-primary text-primary-foreground h-12 rounded-xl font-bold btn-primary-glow flex items-center justify-center gap-2 hover:scale-[1.02] transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            Gửi phản hồi ngay
                        </button>
                        <a href="{{ url('/') }}" class="px-6 h-12 rounded-xl border border-border flex items-center justify-center font-medium hover:bg-secondary transition-colors">
                            Quay lại
                        </a>
                    </div>
                </form>
            </div>

            <!-- Past Feedbacks -->
            @if($pastFeedbacks->isNotEmpty())
            <div class="mt-16 space-y-8 animate-slide-up" style="animation-delay: 200ms">
                <div class="flex items-center gap-4">
                    <h2 class="text-2xl font-bold">Phản hồi của bạn</h2>
                    <div class="h-px flex-1 bg-border"></div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    @foreach($pastFeedbacks as $fb)
                    <div class="card-luxury p-6 rounded-2xl border-border/50 hover:border-primary/30 transition-colors">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-1 text-yellow-500">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="{{ $i <= $fb->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $i <= $fb->rating ? '' : 'text-muted-foreground opacity-30' }}"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    @endfor
                                    <span class="ml-2 text-xs font-bold text-muted-foreground uppercase tracking-widest">{{ $fb->created_at->format('d/m/Y') }}</span>
                                </div>
                                <p class="text-foreground mt-2 leading-relaxed">"{{ $fb->message }}"</p>
                            </div>
                        </div>

                        @if($fb->admin_reply)
                        <div class="mt-4 pt-4 border-t border-border/50">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-bold text-primary italic">Admin phản hồi</span>
                                        <span class="text-[10px] text-muted-foreground">{{ $fb->replied_at->format('H:i d/m/Y') }}</span>
                                    </div>
                                    <p class="text-sm text-foreground italic bg-primary/5 p-3 rounded-xl border-l-2 border-primary">
                                        {{ $fb->admin_reply }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="mt-4 pt-4 border-t border-border/50 flex items-center gap-2 text-muted-foreground">
                            <div class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></div>
                            <span class="text-xs font-medium">Đang chờ Admin phản hồi...</span>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
