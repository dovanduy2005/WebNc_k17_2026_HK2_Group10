@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng - AutoLux Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.contracts.index') }}" class="p-2 hover:bg-muted rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold">Đơn #{{ $contract->contract_number }}</h1>
                <p class="text-muted-foreground">Ngày đặt: {{ $contract->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        
        <!-- Status Actions -->
        <div class="flex items-center gap-2">
            <form action="{{ route('admin.contracts.update', $contract) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex items-center bg-card border rounded-lg p-1">
                    <select name="status" class="bg-transparent border-none text-sm font-medium focus:ring-0 cursor-pointer" onchange="this.form.submit()">
                        <option value="pending" {{ $contract->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="confirmed" {{ $contract->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                        <option value="active" {{ $contract->status == 'active' ? 'selected' : '' }}>Đang thực hiện</option>
                        <option value="complete" {{ $contract->status == 'complete' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ $contract->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Scheduling Section -->
    <div class="bg-card p-6 rounded-xl border shadow-sm">
        <h2 class="font-bold text-lg border-b pb-4 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            Lịch hẹn & Bàn giao
        </h2>
        
        <form action="{{ route('admin.contracts.update', $contract) }}" method="POST" class="grid md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="{{ $contract->status }}">
            
            <div class="space-y-2">
                <label class="font-medium text-sm">Lịch hẹn xem xe / Lái thử</label>
                <input type="datetime-local" name="inspection_date" value="{{ $contract->inspection_date ? \Carbon\Carbon::parse($contract->inspection_date)->format('Y-m-d\TH:i') : '' }}" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus:ring-2 focus:ring-primary">
            </div>

            <div class="space-y-2">
                <label class="font-medium text-sm">Lịch bàn giao xe dự kiến</label>
                <input type="datetime-local" name="handover_date" value="{{ $contract->handover_date ? \Carbon\Carbon::parse($contract->handover_date)->format('Y-m-d\TH:i') : '' }}" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus:ring-2 focus:ring-primary">
            </div>

            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="bg-primary text-primary-foreground px-4 py-2 rounded-lg font-bold hover:shadow-lg transition-all text-sm">Cập nhật lịch</button>
            </div>
        </form>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Customer Info -->
        <div class="bg-card p-6 rounded-xl border shadow-sm space-y-4">
            <h2 class="font-bold text-lg border-b pb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Thông tin khách hàng
            </h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-muted-foreground">Họ tên:</span>
                    <span class="font-medium">{{ $contract->user->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-muted-foreground">CCCD:</span>
                    <span class="font-medium">{{ $contract->cccd }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-muted-foreground">Số điện thoại:</span>
                    <span class="font-medium">{{ $contract->phone }}</span>
                </div>
                 <div class="flex justify-between">
                    <span class="text-muted-foreground">Email:</span>
                    <span class="font-medium">{{ $contract->user->email }}</span>
                </div>
                <div class="pt-2">
                    <span class="text-muted-foreground block mb-1">Địa chỉ thường trú:</span>
                    <span class="font-medium block bg-muted/50 p-2 rounded-lg">{{ $contract->buyer_address }}</span>
                </div>
            </div>
        </div>

        <!-- Car Info -->
        <div class="bg-card p-6 rounded-xl border shadow-sm space-y-4">
            <h2 class="font-bold text-lg border-b pb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 13.1v2.9c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/></svg>
                Thông tin xe
            </h2>
            <div class="flex gap-4">
                <div class="w-24 h-16 bg-muted rounded-lg overflow-hidden flex-shrink-0">
                    <img src="{{ Storage::url($contract->car->image) }}" class="w-full h-full object-cover">
                </div>
                <div>
                     <h3 class="font-bold">{{ $contract->car->name }}</h3>
                     <p class="text-sm text-muted-foreground">{{ $contract->car->year }} • {{ $contract->car->status }}</p>
                </div>
            </div>
            <div class="space-y-3 text-sm pt-2">
                 <div class="flex justify-between">
                    <span class="text-muted-foreground">Giá niêm yết:</span>
                    <span class="font-medium">{{ number_format($contract->car->price) }} đ</span>
                </div>
                <div class="flex justify-between items-center pt-2 border-t">
                    <span class="text-base font-bold">Tiền đặt cọc:</span>
                    <span class="text-xl font-bold text-primary">{{ number_format($contract->deposit_amount) }} đ</span>
                </div>
            </div>
        </div>
        
        <!-- Deposit Proof -->
        <div class="bg-card p-6 rounded-xl border shadow-sm space-y-4 md:col-span-2">
             <h2 class="font-bold text-lg border-b pb-4">Minh chứng đặt cọc</h2>
             @if($contract->deposit_image)
                <div class="rounded-xl overflow-hidden border">
                    <img src="{{ Storage::url($contract->deposit_image) }}" class="w-full h-auto max-h-[500px] object-contain bg-black/5">
                </div>
             @else
                <div class="p-8 text-center text-muted-foreground bg-muted/20 rounded-xl">
                    Chưa có ảnh minh chứng đặt cọc.
                </div>
             @endif
        </div>
    </div>
</div>
@endsection
