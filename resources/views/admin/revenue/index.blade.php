@extends('layouts.admin')

@section('title', 'Quản lý doanh thu - AutoLux Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Thống kê doanh thu</h1>
        <div class="flex items-center gap-2 text-muted-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            <span>{{ date('d/m/Y') }}</span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid gap-6 md:grid-cols-3">
        <!-- Weekly -->
        <div class="p-6 bg-card rounded-xl border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-muted-foreground mb-1">Doanh thu Tuần này</p>
                <h3 class="text-2xl font-bold text-primary">{{ number_format($weeklyRevenue) }} đ</h3>
                <p class="text-xs text-muted-foreground mt-1">
                    {{ \Carbon\Carbon::now()->startOfWeek()->format('d/m') }} - {{ \Carbon\Carbon::now()->endOfWeek()->format('d/m') }}
                </p>
            </div>
            <div class="p-3 bg-primary/10 rounded-xl text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            </div>
        </div>

        <!-- Monthly -->
        <div class="p-6 bg-card rounded-xl border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-muted-foreground mb-1">Doanh thu Tháng {{ date('m/Y') }}</p>
                <h3 class="text-2xl font-bold text-blue-600">{{ number_format($monthlyRevenue) }} đ</h3>
            </div>
            <div class="p-3 bg-blue-500/10 rounded-xl text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
            </div>
        </div>

        <!-- Yearly -->
        <div class="p-6 bg-card rounded-xl border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-muted-foreground mb-1">Doanh thu Năm {{ date('Y') }}</p>
                <h3 class="text-2xl font-bold text-green-600">{{ number_format($yearlyRevenue) }} đ</h3>
            </div>
            <div class="p-3 bg-green-500/10 rounded-xl text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-card rounded-xl border shadow-sm">
        <div class="p-6 border-b flex items-center justify-between">
            <h2 class="font-bold text-lg">Lịch sử giao dịch (Đơn đặt cọc)</h2>
            <button class="text-sm text-primary hover:underline font-medium">Xuất báo cáo</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left bg-muted/50 border-b">
                        <th class="py-4 px-6 font-medium text-muted-foreground">Mã HĐ</th>
                        <th class="py-4 px-6 font-medium text-muted-foreground">Ngày giao dịch</th>
                        <th class="py-4 px-6 font-medium text-muted-foreground">Khách hàng</th>
                        <th class="py-4 px-6 font-medium text-muted-foreground">Xe</th>
                        <th class="py-4 px-6 font-medium text-muted-foreground">Số tiền cọc</th>
                        <th class="py-4 px-6 font-medium text-muted-foreground">Trạng thái</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($contracts as $contract)
                    <tr class="hover:bg-muted/50 transition-colors">
                        <td class="py-4 px-6 font-medium">{{ $contract->contract_number }}</td>
                        <td class="py-4 px-6">{{ $contract->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-4 px-6">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $contract->user->name }}</span>
                                <span class="text-xs text-muted-foreground">{{ $contract->phone }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">{{ $contract->car->name }}</td>
                        <td class="py-4 px-6 font-bold text-primary">{{ number_format($contract->deposit_amount) }} đ</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $contract->status == 'signed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $contract->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-muted-foreground">Chưa có giao dịch nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($contracts->hasPages())
            <div class="p-4 border-t">
                {{ $contracts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
