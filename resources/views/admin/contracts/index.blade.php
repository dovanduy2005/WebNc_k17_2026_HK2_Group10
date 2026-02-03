@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng - AutoLux Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Danh sách đơn hàng</h1>
    </div>

    <div class="bg-card border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-muted/50 border-b">
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Mã đơn</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Khách hàng</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Xe đặt cọc</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Tiền cọc</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Ngày tạo</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Trạng thái</th>
                        <th class="px-6 py-4 text-right font-medium text-muted-foreground">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($contracts as $contract)
                    <tr class="hover:bg-muted/50 transition-colors">
                        <td class="px-6 py-4 font-bold">{{ $contract->contract_number }}</td>
                        <td class="px-6 py-4">
                            <p class="font-medium">{{ $contract->user->name }}</p>
                            <p class="text-xs text-muted-foreground">{{ $contract->phone }}</p>
                        </td>
                        <td class="px-6 py-4">{{ $contract->car->name }}</td>
                        <td class="px-6 py-4 font-bold text-primary">{{ number_format($contract->deposit_amount) }} đ</td>
                        <td class="px-6 py-4">{{ $contract->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-blue-100 text-blue-800',
                                    'active' => 'bg-green-100 text-green-800',
                                    'complete' => 'bg-emerald-100 text-emerald-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusLabels = [
                                    'pending' => 'Chờ xử lý',
                                    'confirmed' => 'Đã xác nhận',
                                    'active' => 'Đang thực hiện',
                                    'complete' => 'Hoàn thành',
                                    'cancelled' => 'Đã hủy',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$contract->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $statusLabels[$contract->status] ?? $contract->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.contracts.show', $contract) }}" class="text-primary font-bold hover:underline">Chi tiết</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-muted-foreground">Chưa có đơn hàng nào.</td>
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
