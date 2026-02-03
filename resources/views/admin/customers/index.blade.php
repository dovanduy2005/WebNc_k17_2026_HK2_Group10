@extends('layouts.admin')

@section('title', 'Quản lý khách hàng - AutoLux Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Danh sách khách hàng</h1>
    </div>

    <div class="bg-card border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-muted/50 border-b">
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Khách hàng</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Thông tin liên hệ</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Địa chỉ</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Số đơn hàng</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Ngày tham gia</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-muted/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-muted flex items-center justify-center overflow-hidden">
                                     @if($customer->avatar)
                                        <img src="{{ Storage::url($customer->avatar) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <span class="font-bold text-muted-foreground">{{ substr($customer->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <span class="font-bold">{{ $customer->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium">{{ $customer->email }}</p>
                            <p class="text-xs text-muted-foreground">{{ $customer->phone ?? 'Chưa cập nhật' }}</p>
                        </td>
                        <td class="px-6 py-4 max-w-xs truncate" title="{{ $customer->address }}">
                            {{ $customer->address ?? 'Chưa cập nhật' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary/10 text-primary">
                                {{ $customer->contracts_count }} đơn
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $customer->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-muted-foreground">Chưa có khách hàng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($customers->hasPages())
        <div class="p-4 border-t">
            {{ $customers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
