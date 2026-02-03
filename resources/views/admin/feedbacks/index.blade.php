@extends('layouts.admin')

@section('title', 'Quản lý phản hồi - AutoLux Admin')

@section('content')
<div class="space-y-6" x-data="{ tab: 'consultations' }">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold">Quản lý phản hồi & Tư vấn</h1>
            <p class="text-muted-foreground">Theo dõi và phản hồi ý kiến khách hàng</p>
        </div>
        
        <!-- Tabs -->
        <div class="flex p-1 bg-muted rounded-xl gap-1">
            <button @click="tab = 'consultations'" 
                :class="tab === 'consultations' ? 'bg-background shadow-sm text-foreground' : 'text-muted-foreground hover:text-foreground'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-all">
                Yêu cầu tư vấn ({{ $consultations->count() }})
            </button>
            <button @click="tab = 'feedbacks'" 
                :class="tab === 'feedbacks' ? 'bg-background shadow-sm text-foreground' : 'text-muted-foreground hover:text-foreground'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-all">
                Phản hồi khách hàng ({{ $feedbacks->count() }})
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-500 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Consultation Requests Table -->
    <div x-show="tab === 'consultations'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="card-luxury bg-card rounded-xl border shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-muted/50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-bold">Thông tin khách hàng</th>
                            <th class="px-6 py-4 font-bold">Dòng xe quan tâm</th>
                            <th class="px-6 py-4 font-bold">Nội dung yêu cầu</th>
                            <th class="px-6 py-4 font-bold">Thời gian</th>
                            <th class="px-6 py-4 font-bold text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($consultations as $item)
                        <tr class="hover:bg-muted/50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-bold text-foreground">{{ $item->name }}</p>
                                    <p class="text-xs text-muted-foreground flex items-center gap-1 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                        {{ $item->phone }}
                                    </p>
                                    @if($item->email)
                                    <p class="text-xs text-muted-foreground flex items-center gap-1 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                        {{ $item->email }}
                                    </p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-primary/10 text-primary rounded-lg text-xs font-semibold">
                                    {{ $item->car_interested ?? 'Chưa xác định' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-muted-foreground line-clamp-2 max-w-xs">{{ $item->message ?? 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-4 text-muted-foreground text-xs whitespace-nowrap">
                                {{ $item->created_at->format('H:i d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.feedbacks.consultation.destroy', $item) }}" method="POST" onsubmit="return confirm('Xóa yêu cầu tư vấn này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-destructive hover:bg-destructive/10 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-muted-foreground">
                                Chưa có yêu cầu tư vấn nào.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Feedbacks Table -->
    <div x-show="tab === 'feedbacks'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="card-luxury bg-card rounded-xl border shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-muted/50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-bold">Khách hàng</th>
                            <th class="px-6 py-4 font-bold">Nội dung phản hồi</th>
                            <th class="px-6 py-4 font-bold text-center">Đánh giá</th>
                            <th class="px-6 py-4 font-bold">Thời gian</th>
                            <th class="px-6 py-4 font-bold text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($feedbacks as $feedback)
                        <tr class="hover:bg-muted/50 transition-colors" x-data="{ showReplyForm: false }">
                            <td class="px-6 py-4 align-top">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 text-primary font-bold">
                                        {{ substr($feedback->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold">{{ $feedback->user->name }}</p>
                                        <p class="text-xs text-muted-foreground">{{ $feedback->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-4">
                                    <!-- Customer Message -->
                                    <div class="p-3 bg-secondary/30 rounded-lg border border-border/50">
                                        <p class="text-foreground leading-relaxed">{{ $feedback->message }}</p>
                                    </div>

                                    <!-- Admin Reply Display -->
                                    @if($feedback->admin_reply)
                                    <div class="ml-6 p-3 bg-primary/5 border-l-2 border-primary rounded-r-lg relative">
                                        <span class="absolute -top-2.5 left-2 px-2 bg-background text-[10px] font-bold text-primary uppercase tracking-wider">Admin trả lời</span>
                                        <p class="text-sm text-foreground italic">"{{ $feedback->admin_reply }}"</p>
                                        <p class="text-[10px] text-muted-foreground mt-2 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            {{ $feedback->replied_at->format('H:i d/m/Y') }}
                                        </p>
                                    </div>
                                    @endif

                                    <!-- Reply Form (Alpine.js) -->
                                    <div x-show="showReplyForm" x-transition class="ml-6 space-y-3">
                                        <form action="{{ route('admin.feedbacks.reply', $feedback) }}" method="POST">
                                            @csrf
                                            <textarea name="admin_reply" rows="3" placeholder="Nhập nội dung trả lời..." class="w-full bg-background border border-border rounded-xl p-3 text-sm focus:outline-none focus:ring-1 focus:ring-primary transition-all" required>{{ $feedback->admin_reply }}</textarea>
                                            <div class="flex justify-end gap-2 mt-2">
                                                <button type="button" @click="showReplyForm = false" class="px-3 py-1.5 text-xs font-medium text-muted-foreground hover:text-foreground transition-colors">Hủy</button>
                                                <button type="submit" class="px-3 py-1.5 bg-primary text-primary-foreground text-xs font-bold rounded-lg btn-primary-glow">Gửi trả lời</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-top">
                                <div class="flex items-center justify-center gap-0.5 text-yellow-500">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="{{ $i <= $feedback->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $i <= $feedback->rating ? '' : 'text-muted-foreground opacity-30' }}"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4 text-muted-foreground text-xs align-top whitespace-nowrap">
                                {{ $feedback->created_at->format('H:i d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-center align-top">
                                <div class="flex items-center justify-center gap-1">
                                    <button @click="showReplyForm = !showReplyForm" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" :title="showReplyForm ? 'Đóng form' : 'Trả lời'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa phản hồi này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-destructive hover:bg-destructive/10 rounded-lg transition-colors" title="Xóa">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-muted-foreground">
                                Chưa có phản hồi nào.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
