@extends('layouts.admin')

@section('title', 'Quản lý xe - AutoLux Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Danh sách xe</h1>
        <a href="{{ route('admin.cars.create') }}" class="flex items-center gap-2 bg-primary text-primary-foreground px-4 py-2 rounded-xl font-bold hover:shadow-lg transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Thêm xe mới
        </a>
    </div>

    <div class="bg-card border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-muted/50 border-b">
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Hình ảnh</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Tên xe</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Thương hiệu</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Giá bán</th>
                        <th class="px-6 py-4 text-left font-medium text-muted-foreground">Trạng thái</th>
                        <th class="px-6 py-4 text-right font-medium text-muted-foreground">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($cars as $car)
                    <tr class="hover:bg-muted/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="w-20 h-14 rounded-lg bg-muted overflow-hidden">
                                @if($car->image)
                                    <img src="{{ Storage::url($car->image) }}" alt="" class="w-full h-full object-cover">
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold">{{ $car->name }}</p>
                            <p class="text-xs text-muted-foreground">{{ $car->year }} • {{ $car->engine ?? 'N/A' }}</p>
                        </td>
                        <td class="px-6 py-4">{{ $car->brand->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-primary font-bold">{{ number_format($car->price) }} đ</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $car->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $car->status === 'available' ? 'Đang bán' : 'Đã bán' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.cars.edit', $car) }}" class="p-2 hover:bg-muted rounded-lg text-blue-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                                </a>
                                <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa xe này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-muted rounded-lg text-red-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-muted-foreground">Chưa có xe nào trong hệ thống.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($cars->hasPages())
        <div class="p-4 border-t">
            {{ $cars->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
