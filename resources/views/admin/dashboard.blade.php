@extends('layouts.admin')

@section('title', 'Dashboard - AutoLux Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-muted-foreground">{{ date('d/m/Y') }}</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <div class="p-6 bg-card rounded-xl border shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-primary/10 rounded-lg text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 13.1v2.9c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Tổng số xe</p>
                    <h3 class="text-2xl font-bold">{{ $totalCars }}</h3>
                </div>
            </div>
        </div>

        <div class="p-6 bg-card rounded-xl border shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-500/10 rounded-lg text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Khách hàng</p>
                    <h3 class="text-2xl font-bold">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <div class="p-6 bg-card rounded-xl border shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-500/10 rounded-lg text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Đơn hàng mới</p>
                    <h3 class="text-2xl font-bold">{{ $totalContracts }}</h3>
                </div>
            </div>
        </div>

        <div class="p-6 bg-card rounded-xl border shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-yellow-500/10 rounded-lg text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Tổng doanh thu</p>
                    <h3 class="text-2xl font-bold">{{ number_format($revenue) }} đ</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="p-6 bg-card rounded-xl border shadow-sm col-span-2">
            <h3 class="text-lg font-bold mb-4">Đơn đặt cọc gần đây</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="pb-3 font-medium text-muted-foreground">Mã HĐ</th>
                            <th class="pb-3 font-medium text-muted-foreground">Khách hàng</th>
                            <th class="pb-3 font-medium text-muted-foreground">Xe</th>
                            <th class="pb-3 font-medium text-muted-foreground">Tiền cọc</th>
                            <th class="pb-3 font-medium text-muted-foreground">Ngày đặt</th>
                            <th class="pb-3 font-medium text-muted-foreground">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($recentContracts as $contract)
                        <tr>
                            <td class="py-3 font-medium">{{ $contract->contract_number }}</td>
                            <td class="py-3">{{ $contract->user->name }}</td>
                            <td class="py-3">{{ $contract->car->name }}</td>
                            <td class="py-3">{{ number_format($contract->deposit_amount) }} đ</td>
                            <td class="py-3">{{ $contract->created_at->format('d/m/Y') }}</td>
                            <td class="py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $contract->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-muted-foreground">Chưa có đơn hàng nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
